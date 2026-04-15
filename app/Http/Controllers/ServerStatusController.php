<?php

namespace App\Http\Controllers;

use App\Models\ServiceHealthEntry;
use App\Services\ServiceHealthRefresher;
use Illuminate\Support\Carbon;

class ServerStatusController extends Controller
{
    private const ORDER = ['delivery', 'flowpilot', 'waiterpilot', 'fluxy', 'xbarcly', 'ihub'];

    /** Intervalo mínimo entre medições HTTP (evita rajadas; origem/Cloudflare já cacheiam). */
    private const REFRESH_INTERVAL_SECONDS = 20;

    public function __invoke(ServiceHealthRefresher $refresher)
    {
        $lastCheckedAt = ServiceHealthEntry::query()
            ->whereIn('service_key', self::ORDER)
            ->max('checked_at');

        $needsRefresh = $lastCheckedAt === null
            || Carbon::parse($lastCheckedAt)->lte(now()->subSeconds(self::REFRESH_INTERVAL_SECONDS));

        if ($needsRefresh) {
            $refresher->refresh();
        }

        $byKey = ServiceHealthEntry::query()->whereIn('service_key', self::ORDER)->get()->keyBy('service_key');

        $services = [];
        foreach (self::ORDER as $key) {
            $e = $byKey->get($key);
            if ($e === null) {
                continue;
            }
            $services[] = [
                'name' => $e->name,
                'group' => $e->group_label,
                'check' => $e->check_type,
                'target' => $e->target,
                'status' => $e->status,
                'ms' => $e->latency_ms,
                'detail' => $e->detail ?? '',
                'raw_status' => $e->raw_status,
            ];
        }

        $checkedAt = $byKey->pluck('checked_at')->filter()->max();
        $checkedAtFormatted = $checkedAt
            ? $checkedAt->timezone(config('app.timezone', 'America/Sao_Paulo'))->format('d/m/Y H:i:s')
            : null;

        $hasData = count($services) > 0;

        return view('status', [
            'services' => $services,
            'checkedAt' => $checkedAtFormatted,
            'hasData' => $hasData,
            'servedFromCache' => ! $needsRefresh && $hasData,
        ]);
    }
}
