<?php

namespace App\Services;

use App\Models\ServiceHealthEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServiceHealthRefresher
{
    private const LICENSE_STATUS_URL = 'https://license.arcn.com.br/app_delivery_license/status.php';
    //private const LICENSE_STATUS_URL = 'http://147.79.81.133/app_delivery_license/status.php';

    /** Mesmo host para Fluxy e xBarcly — uma única requisição HTTP atende os dois. */
    private const FLUXY_XBARCLY_CHECK_URL = 'http://147.79.81.133';

    private const DEGRADED_MS = 2000;

    public function refresh(): void
    {
        $checkedAt = now();

        $license = $this->checkLicenseEndpoint();
        $fluxyXbarcly = $this->checkHttpSite(self::FLUXY_XBARCLY_CHECK_URL);

        $rows = [
            $this->row('delivery', 'Delivery', 'Licenças & delivery', 'HTTP', self::LICENSE_STATUS_URL, $license, $checkedAt),
            $this->row('flowpilot', 'FlowPilot', 'Licenças & delivery', 'HTTP', self::LICENSE_STATUS_URL, $license, $checkedAt),
            $this->row('waiterpilot', 'WaiterPilot', 'Licenças & delivery', 'HTTP', self::LICENSE_STATUS_URL, $license, $checkedAt),
            $this->row('fluxy', 'Fluxy', 'Sites públicos', 'HTTP', self::FLUXY_XBARCLY_CHECK_URL, $fluxyXbarcly, $checkedAt),
            $this->row('xbarcly', 'xBarcly', 'Sites públicos', 'HTTP', self::FLUXY_XBARCLY_CHECK_URL, $fluxyXbarcly, $checkedAt),
        ];

        DB::transaction(function () use ($rows) {
            foreach ($rows as $data) {
                ServiceHealthEntry::query()->updateOrCreate(
                    ['service_key' => $data['service_key']],
                    $data
                );
            }
        });
    }

    /**
     * @param  array{status: string, ms: int|null, detail: string, raw_status: string|null}  $result
     * @return array<string, mixed>
     */
    private function row(string $key, string $name, string $group, string $type, string $target, array $result, \Illuminate\Support\Carbon $checkedAt): array
    {
        return [
            'service_key' => $key,
            'name' => $name,
            'group_label' => $group,
            'check_type' => $type,
            'target' => $target,
            'status' => $result['status'],
            'latency_ms' => $result['ms'],
            'detail' => $result['detail'],
            'raw_status' => $result['raw_status'],
            'checked_at' => $checkedAt,
        ];
    }

    /**
     * @return array{status: string, ms: int|null, detail: string, raw_status: string|null}
     */
    private function checkLicenseEndpoint(): array
    {
        $start = microtime(true);

        try {
            $response = Http::timeout(10)
                ->connectTimeout(5)
                ->get(self::LICENSE_STATUS_URL);

            //$this->logLicenseEndpointCacheHeaders($response);

            $ms = (int) round((microtime(true) - $start) * 1000);

            if (! $response->successful()) {
                return [
                    'status' => 'down',
                    'ms' => $ms,
                    'detail' => 'HTTP '.$response->status(),
                    'raw_status' => null,
                ];
            }

            $json = $response->json();
            $apiStatus = is_array($json) ? ($json['status'] ?? null) : null;
            $ok = $apiStatus === 'ok';

            if (! $ok) {
                return [
                    'status' => 'degraded',
                    'ms' => $ms,
                    'detail' => 'Resposta fora do esperado (esperado status ok).',
                    'raw_status' => is_string($apiStatus) ? $apiStatus : json_encode($json),
                ];
            }

            if ($ms >= self::DEGRADED_MS) {
                return [
                    'status' => 'degraded',
                    'ms' => $ms,
                    'detail' => 'Serviço OK, porém com latência elevada.',
                    'raw_status' => 'ok',
                ];
            }

            return [
                'status' => 'operational',
                'ms' => $ms,
                'detail' => 'Endpoint de status respondeu OK.',
                'raw_status' => 'ok',
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'down',
                'ms' => null,
                'detail' => 'Falha na requisição: '.$e->getMessage(),
                'raw_status' => null,
            ];
        }
    }

    /**
     * Registra cabeçalhos úteis para inspecionar cache na Cloudflare e no servidor de origem.
     */
    private function logLicenseEndpointCacheHeaders(\Illuminate\Http\Client\Response $response): void
    {
        $h = fn (string $name): ?string => $response->header($name);

        Log::info('license_status.cache_headers', [
            'url' => self::LICENSE_STATUS_URL,
            'http_status' => $response->status(),
            'cf_cache_status' => $h('CF-Cache-Status'),
            'cf_ray' => $h('CF-Ray'),
            'age' => $h('Age'),
            'cache_control' => $h('Cache-Control'),
            'expires' => $h('Expires'),
            'etag' => $h('ETag'),
            'last_modified' => $h('Last-Modified'),
            'x_cache' => $h('X-Cache'),
            'x_cache_status' => $h('X-Cache-Status'),
            'x_served_by' => $h('X-Served-By'),
            'via' => $h('Via'),
            'server' => $h('Server'),
            'cdn_cache_control' => $h('CDN-Cache-Control'),
            'response' => $this->licenseResponseForLog($response),
        ]);
    }

    /**
     * Corpo da resposta para log: JSON como array associativo; senão texto (limitado).
     *
     * @return array<string, mixed>|string
     */
    private function licenseResponseForLog(\Illuminate\Http\Client\Response $response): array|string
    {
        $raw = $response->body();

        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        $max = 4096;

        return strlen($raw) > $max ? substr($raw, 0, $max).'…' : $raw;
    }

    /**
     * @return array{status: string, ms: int|null, detail: string, raw_status: string|null}
     */
    private function checkHttpSite(string $url): array
    {
        $start = microtime(true);

        try {
            $response = Http::timeout(12)
                ->connectTimeout(6)
                ->withHeaders(['User-Agent' => 'ArcnStatusMonitor/1.0'])
                ->get($url);

            $ms = (int) round((microtime(true) - $start) * 1000);
            $code = $response->status();

            if ($response->successful()) {
                if ($ms >= self::DEGRADED_MS) {
                    return [
                        'status' => 'degraded',
                        'ms' => $ms,
                        'detail' => "HTTP {$code}, latência elevada.",
                        'raw_status' => (string) $code,
                    ];
                }

                return [
                    'status' => 'operational',
                    'ms' => $ms,
                    'detail' => "Site respondeu HTTP {$code}.",
                    'raw_status' => (string) $code,
                ];
            }

            if ($response->redirect()) {
                return [
                    'status' => 'degraded',
                    'ms' => $ms,
                    'detail' => "Redirecionamento HTTP {$code} (verifique URL final).",
                    'raw_status' => (string) $code,
                ];
            }

            if ($code >= 500) {
                return [
                    'status' => 'down',
                    'ms' => $ms,
                    'detail' => "Erro no servidor HTTP {$code}.",
                    'raw_status' => (string) $code,
                ];
            }

            return [
                'status' => 'degraded',
                'ms' => $ms,
                'detail' => "Resposta HTTP {$code}.",
                'raw_status' => (string) $code,
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'down',
                'ms' => null,
                'detail' => 'Falha na requisição: '.$e->getMessage(),
                'raw_status' => null,
            ];
        }
    }
}
