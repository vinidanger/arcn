<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status dos serviços — Arcn Solutions</title>
    <meta name="description" content="Status dos sistemas Arcn: medição HTTP no máximo a cada 10 minutos; entre medições usa o último resultado gravado.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #07080d;
            --bg2: #0d0f1a;
            --card: #111320;
            --border: rgba(255,255,255,.07);
            --p: #6c63ff;
            --cyan: #00d4ff;
            --text: #e8eaf6;
            --muted: #7b80a0;
            --ok: #22c55e;
            --warn: #f59e0b;
            --bad: #ef4444;
            --r: 18px;
        }
        html { scroll-behavior: smooth; overflow-x: hidden; }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            opacity: .022;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            pointer-events: none;
        }
        nav {
            position: sticky; top: 0; z-index: 50;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 6%;
            background: rgba(7,8,13,.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .logo { display: block; }
        .logo img { height: 32px; width: auto; display: block; max-width: min(160px, 46vw); object-fit: contain; }
        main { position: relative; z-index: 1; padding: 3rem 6% 5rem; max-width: 960px; margin: 0 auto; }
        .st-head { margin-bottom: 2.5rem; }
        .st-label {
            font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--p); margin-bottom: .6rem;
        }
        h1 {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(1.85rem, 4vw, 2.75rem);
            font-weight: 800; letter-spacing: -.02em; line-height: 1.15; margin-bottom: .75rem;
        }
        .g {
            background: linear-gradient(135deg, var(--p) 0%, var(--cyan) 60%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .st-meta { color: var(--muted); font-size: .9rem; display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
        .legend {
            display: flex; flex-wrap: wrap; gap: 1.25rem; margin: 2rem 0 1.5rem;
            padding: 1rem 1.25rem;
            background: var(--card); border: 1px solid var(--border); border-radius: var(--r);
        }
        .legend-item { display: flex; align-items: center; gap: .55rem; font-size: .82rem; color: var(--muted); }
        .sq { width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0; }
        .sq--ok { background: var(--ok); box-shadow: 0 0 12px rgba(34,197,94,.35); }
        .sq--warn { background: var(--warn); box-shadow: 0 0 12px rgba(245,158,11,.35); }
        .sq--bad { background: var(--bad); box-shadow: 0 0 12px rgba(239,68,68,.35); }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem; margin-bottom: 2.5rem;
        }
        .sum-card {
            background: var(--card); border: 1px solid var(--border); border-radius: 14px;
            padding: 1.15rem 1rem; text-align: center;
        }
        .sum-card .sq { margin: 0 auto .65rem; width: 14px; height: 14px; border-radius: 4px; }
        .sum-name { font-weight: 700; font-size: .88rem; margin-bottom: .2rem; }
        .sum-ms { font-size: .78rem; color: var(--muted); font-variant-numeric: tabular-nums; }
        .table-wrap {
            background: var(--card); border: 1px solid var(--border); border-radius: var(--r); overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; font-size: .88rem; }
        th, td { padding: 1rem 1.1rem; text-align: left; border-bottom: 1px solid var(--border); vertical-align: middle; }
        th { color: var(--muted); font-weight: 600; font-size: .72rem; text-transform: uppercase; letter-spacing: .06em; background: rgba(0,0,0,.2); }
        tr:last-child td { border-bottom: none; }
        td .row-top { display: flex; align-items: center; gap: .65rem; }
        .svc-name { font-weight: 700; }
        .mono { font-family: ui-monospace, monospace; font-size: .78rem; color: var(--muted); word-break: break-all; }
        .ms-val { font-variant-numeric: tabular-nums; font-weight: 600; color: var(--text); }
        .ms-na { color: var(--muted); font-weight: 500; }
        .foot-note { margin-top: 2rem; font-size: .78rem; color: var(--muted); line-height: 1.65; }
        .st-empty {
            background: var(--card); border: 1px solid var(--border); border-radius: var(--r);
            padding: 2rem 1.5rem; text-align: center; color: var(--muted); font-size: .95rem; margin-bottom: 2rem;
        }
        .st-empty strong { color: var(--text); }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions">
    </div>
</nav>

<main>
    <header class="st-head">
        <p class="st-label">Infraestrutura</p>
        <h1>Status dos <span class="g">serviços</span></h1>
        <div class="st-meta">
            @if ($hasData && $checkedAt)
                <span>Última medição: <strong style="color:var(--text);font-weight:600">{{ $checkedAt }}</strong>
                    @if (!empty($servedFromCache))
                        <span style="font-weight:500;opacity:.9"> — dados em cache (nova medição só após 10 min)</span>
                    @endif
                </span>
            @else
                <span><strong style="color:var(--text);font-weight:600">Sem dados no banco ainda.</strong> Confira se a migration foi executada.</span>
            @endif
        </div>
    </header>

    @unless ($hasData)
        <div class="st-empty">
            <p>Rode <strong>php artisan migrate</strong> e recarregue. Se o erro persistir, use <strong>php artisan service-health:refresh</strong> no terminal para ver a exceção.</p>
        </div>
    @endunless

    @if ($hasData)
    <div class="legend">
        <div class="legend-item"><span class="sq sq--ok"></span> Operacional</div>
        <div class="legend-item"><span class="sq sq--warn"></span> Degradado (lento ou resposta parcial)</div>
        <div class="legend-item"><span class="sq sq--bad"></span> Indisponível</div>
    </div>

    <div class="summary-grid">
        @foreach ($services as $s)
            @php
                $sq = $s['status'] === 'operational' ? 'ok' : ($s['status'] === 'degraded' ? 'warn' : 'bad');
            @endphp
            <div class="sum-card">
                <div class="sq sq--{{ $sq }}"></div>
                <div class="sum-name">{{ $s['name'] }}</div>
                <div class="sum-ms">
                    @if ($s['ms'] !== null)
                        {{ $s['ms'] }} ms
                    @else
                        —
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Sistema</th>
                    <th>Indicador</th>
                    <th>Latência</th>
                    <th>Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $s)
                    @php
                        $sq = $s['status'] === 'operational' ? 'ok' : ($s['status'] === 'degraded' ? 'warn' : 'bad');
                    @endphp
                    <tr>
                        <td>
                            <div class="row-top">
                                <span class="sq sq--{{ $sq }}" style="margin-top:2px"></span>
                                <div>
                                    <div class="svc-name">{{ $s['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($s['status'] === 'operational')
                                <span style="color:var(--ok);font-weight:600">Operacional</span>
                            @elseif ($s['status'] === 'degraded')
                                <span style="color:var(--warn);font-weight:600">Degradado</span>
                            @else
                                <span style="color:var(--bad);font-weight:600">Indisponível</span>
                            @endif
                        </td>
                        <td>
                            @if ($s['ms'] !== null)
                                <span class="ms-val">{{ $s['ms'] }} ms</span>
                            @else
                                <span class="ms-na">—</span>
                            @endif
                        </td>
                        <td>
                            @if ($s['status'] === 'operational')
                                <span style="color:var(--ok);font-weight:600">OK</span>
                            @elseif ($s['status'] === 'degraded')
                                <span style="color:var(--warn);font-weight:600">Lento</span>
                            @else
                                <span style="color:var(--bad);font-weight:600">Não</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <p class="foot-note">
        As medições são realizadas a cada 10 minutos.
    </p>
</main>

</body>
</html>
