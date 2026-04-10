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
            gap: 1rem;
            padding: 1.2rem 6%;
            background: rgba(7,8,13,.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .logo { display: block; }
        .logo img { height: 32px; width: auto; display: block; max-width: min(160px, 46vw); object-fit: contain; }
        .btn-back {
            flex-shrink: 0;
            display: inline-flex; align-items: center; gap: .45rem;
            color: var(--muted); text-decoration: none; font-size: .875rem; font-weight: 600;
            padding: .55rem 1.15rem; border-radius: 50px;
            border: 1px solid var(--border); background: var(--card);
            transition: color .2s, border-color .2s, background .2s;
        }
        .btn-back:hover { color: var(--text); border-color: rgba(255,255,255,.12); background: rgba(255,255,255,.03); }
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

        footer {
            background: var(--bg); border-top: 1px solid var(--border);
            padding: 3rem 6% 2rem; position: relative; z-index: 1;
        }
        .fgrid {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem; margin-bottom: 2.5rem;
        }
        .fbrand p { color: var(--muted); font-size: .88rem; max-width: 270px; line-height: 1.65; margin-top: .65rem; }
        .fcol h4 { font-weight: 700; font-size: .88rem; margin-bottom: 1.1rem; }
        .fcol ul { list-style: none; display: flex; flex-direction: column; gap: .55rem; }
        .fcol ul a { color: var(--muted); text-decoration: none; font-size: .85rem; transition: color .2s; }
        .fcol ul a:hover { color: var(--text); }
        .fbot {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
            padding-top: 1.4rem; border-top: 1px solid var(--border);
        }
        .fbot p { color: var(--muted); font-size: .8rem; }
        .socials { display: flex; gap: .65rem; flex-wrap: wrap; align-items: center; }
        .soc {
            width: 38px; height: 38px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none;
            background: var(--card);
            border: 1px solid var(--border);
            transition: transform .2s, border-color .2s, background .2s, color .2s;
        }
        .soc svg { width: 18px; height: 18px; display: block; flex-shrink: 0; }
        .soc:hover { transform: translateY(-2px); }
        .soc--instagram {
            background: rgba(188, 24, 136, 0.07);
            border-color: rgba(188, 24, 136, 0.18);
            color: #9a87a8;
        }
        .soc--instagram:hover {
            background: rgba(188, 24, 136, 0.12);
            border-color: rgba(188, 24, 136, 0.28);
            color: #b8a4c4;
        }
        .soc--whatsapp {
            background: rgba(37, 211, 102, 0.07);
            border-color: rgba(37, 211, 102, 0.18);
            color: #6d9e8a;
        }
        .soc--whatsapp:hover {
            background: rgba(37, 211, 102, 0.12);
            border-color: rgba(37, 211, 102, 0.28);
            color: #8bb8a0;
        }
        .soc--youtube {
            background: rgba(255, 70, 70, 0.06);
            border-color: rgba(255, 90, 90, 0.16);
            color: #a88282;
        }
        .soc--youtube:hover {
            background: rgba(255, 70, 70, 0.11);
            border-color: rgba(255, 90, 90, 0.26);
            color: #c49a9a;
        }
        @media (max-width: 900px) {
            .fgrid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .fgrid { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="logo" style="-webkit-text-fill-color:initial">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="32" style="display:block">
    </a>
    <a href="{{ url('/') }}" class="btn-back" aria-label="Voltar à página principal">← Voltar ao site</a>
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

<footer>
    <div class="fgrid">
        <div class="fbrand">
            <a href="{{ url('/') }}" class="logo" style="-webkit-text-fill-color:initial">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="28" style="display:block">
            </a>
            <p>Software moderno para negócios que crescem. Produtos prontos, suporte real e tecnologia que funciona.</p>
        </div>
        <div class="fcol">
            <h4>Produtos</h4>
            <ul>
                <li><a href="{{ url('/delivery') }}">Sistema de Delivery</a></li>
                <li><a href="https://fluxy.arcn.com.br" target="_blank" rel="noopener noreferrer">Fluxy</a></li>
                <li><a href="https://xbarcly.arcn.com.br" target="_blank" rel="noopener noreferrer">xBarcly</a></li>
                <li><a href="{{ url('/') }}#produtos">WhatsApp API</a></li>
            </ul>
        </div>
        <div class="fcol">
            <h4>Empresa</h4>
            <ul>
                <li><a href="{{ url('/') }}#sobre">Sobre nós</a></li>
                <li><a href="{{ url('/') }}#contato">Contato</a></li>
                <li><a href="{{ url('/status') }}">Status dos serviços</a></li>
            </ul>
        </div>
        <div class="fcol">
            <h4>Contato</h4>
            <ul>
                <li><a href="https://wa.me/5515998215892" target="_blank" rel="noopener noreferrer">WhatsApp</a></li>
                <li><a href="https://instagram.com/arcndev" target="_blank" rel="noopener noreferrer">@arcndev</a></li>
                <li><a href="https://www.youtube.com/@arcnsolutions" target="_blank" rel="noopener noreferrer">YouTube</a></li>
            </ul>
        </div>
    </div>
    <div class="fbot">
        <p>&copy; <span id="yr"></span> Arcn Solutions. Todos os direitos reservados.</p>
        <div class="socials">
            <a href="https://instagram.com/arcndev" target="_blank" rel="noopener noreferrer" class="soc soc--instagram" aria-label="Instagram">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="https://wa.me/5515998215892" target="_blank" rel="noopener noreferrer" class="soc soc--whatsapp" aria-label="WhatsApp">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.104 1.523 5.831L0 24l6.335-1.502A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.014-1.378l-.36-.214-3.731.979.996-3.648-.234-.374A9.79 9.79 0 012.182 12c0-5.424 4.41-9.836 9.836-9.836S21.818 6.576 21.818 12c0 5.424-4.412 9.818-9.818 9.818z"/></svg>
            </a>
            <a href="https://www.youtube.com/@arcnsolutions" target="_blank" rel="noopener noreferrer" class="soc soc--youtube" aria-label="YouTube">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136c.502-1.883.502-5.813.502-5.813s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
        </div>
    </div>
</footer>

<script>document.getElementById('yr').textContent = new Date().getFullYear();</script>
</body>
</html>
