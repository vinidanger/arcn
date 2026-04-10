<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Changelog — Arcn Solutions</title>
    <meta name="description" content="Histórico completo de atualizações dos sistemas Arcn.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #07080d;
            --bg2:     #0d0f1a;
            --card:    #111320;
            --border:  rgba(255,255,255,.07);
            --primary: #6c63ff;
            --cyan:    #00d4ff;
            --pink:    #ff6584;
            --green:   #00e5a0;
            --text:    #e8eaf6;
            --muted:   #7b80a0;
        }

        html { scroll-behavior: smooth; overflow-x: hidden; width: 100%; }
        body {
            background: var(--bg); color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6; overflow-x: clip; width: 100%;
        }
        body::before {
            content: ''; position: fixed; inset: 0; opacity: .022;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 999;
            display: flex; align-items: center; justify-content: space-between;
            gap: .75rem; width: 100%; box-sizing: border-box;
            padding: max(1.2rem, env(safe-area-inset-top, 0px)) max(6%, env(safe-area-inset-right, 0px)) 1.2rem max(6%, env(safe-area-inset-left, 0px));
            background: rgba(7,8,13,.92);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid var(--border);
            transform: translateZ(0);
        }
        .logo img { max-width: min(160px, 46vw); height: auto; max-height: 32px; object-fit: contain; }
        .logo { text-decoration: none; flex-shrink: 1; }
        .btn-nav {
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; text-decoration: none; padding: .6rem 1.4rem;
            border-radius: 50px; font-size: .875rem; font-weight: 600;
            transition: opacity .2s, transform .2s; flex-shrink: 0; white-space: nowrap;
        }
        .btn-nav:hover { opacity: .85; transform: translateY(-1px); }

        /* ── HERO ── */
        .cl-hero {
            padding: 10rem 6% 5rem; text-align: center;
            position: relative; overflow: hidden;
        }
        .orb { position: absolute; border-radius: 50%; filter: blur(90px); pointer-events: none; animation: float 9s ease-in-out infinite; }
        .orb-a { width:400px;height:400px;background:rgba(108,99,255,.12);top:-8%;left:-8%; }
        .orb-b { width:300px;height:300px;background:rgba(0,212,255,.08);bottom:0;right:-5%;animation-delay:-4s; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-24px)} }

        .cl-label {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(108,99,255,.11); border: 1px solid rgba(108,99,255,.28);
            padding: .38rem 1rem; border-radius: 50px;
            font-size: .78rem; font-weight: 600; color: #a89fff;
            letter-spacing: .07em; text-transform: uppercase;
            margin-bottom: 1.5rem; position: relative; z-index: 1;
        }
        .cl-label-dot { width:6px;height:6px;border-radius:50%;background:var(--primary);border-radius:50%;animation:blink 2s infinite;display:block; }
        @keyframes blink { 0%,100%{opacity:1}50%{opacity:.35} }

        .cl-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(2.4rem, 6vw, 4.2rem);
            font-weight: 800; line-height: 1.1; letter-spacing: -.03em;
            position: relative; z-index: 1; margin-bottom: 1rem;
        }
        .g {
            background: linear-gradient(135deg, var(--primary) 0%, var(--cyan) 55%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .cl-sub { color: var(--muted); font-size: 1.05rem; max-width: 520px; margin: 0 auto 2.5rem; position: relative; z-index: 1; }

        .cl-stats { display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap; position: relative; z-index: 1; }
        .cl-stat { text-align: center; }
        .cl-stat-n {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 2rem; font-weight: 800; letter-spacing: -.03em;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .cl-stat-l { font-size: .8rem; color: var(--muted); font-weight: 500; }

        .divider { height: 1px; background: var(--border); }

        /* ── PRODUCT TABS ── */
        .cl-tabs {
            display: flex; justify-content: center; gap: .75rem; flex-wrap: wrap;
            padding: 2.5rem 6% 0;
        }
        .cl-tab {
            display: flex; align-items: center; gap: .5rem;
            background: transparent; border: 1px solid var(--border);
            color: var(--muted); padding: .55rem 1.3rem; border-radius: 50px;
            font-size: .9rem; font-weight: 600; cursor: pointer;
            transition: all .2s; font-family: inherit;
        }
        .cl-tab img { height: 20px; width: auto; object-fit: contain; }
        .cl-tab:hover { border-color: rgba(108,99,255,.4); color: var(--text); }
        .cl-tab.active {
            background: rgba(108,99,255,.15); border-color: rgba(108,99,255,.5); color: #fff;
            box-shadow: 0 0 20px rgba(108,99,255,.15);
        }

        /* ── FILTERS ── */
        .cl-filters {
            display: flex; justify-content: center; gap: .5rem; flex-wrap: wrap;
            padding: 1.25rem 6% 0;
        }
        .cl-filter {
            background: transparent; border: 1px solid var(--border);
            color: var(--muted); padding: .32rem .85rem; border-radius: 50px;
            font-size: .78rem; font-weight: 600; cursor: pointer;
            transition: all .2s; font-family: inherit;
        }
        .cl-filter:hover { border-color: rgba(108,99,255,.4); color: var(--text); }
        .cl-filter.active { background: rgba(108,99,255,.15); border-color: rgba(108,99,255,.5); color: #a89fff; }
        .cl-filter[data-type="1"].active { background: rgba(255,101,132,.12); border-color: rgba(255,101,132,.4); color: var(--pink); }
        .cl-filter[data-type="3"].active { background: rgba(0,212,255,.1); border-color: rgba(0,212,255,.3); color: var(--cyan); }

        /* ── TIMELINE ── */
        .cl-section { display: none; }
        .cl-section.active { display: block; }

        .cl-timeline {
            max-width: 780px; margin: 2.5rem auto 6rem;
            padding: 0 6%; position: relative;
        }
        .cl-timeline::before {
            content: ''; position: absolute; top: 0; bottom: 0;
            left: calc(6% + 18px); width: 2px;
            background: linear-gradient(to bottom, transparent, rgba(108,99,255,.25) 5%, rgba(108,99,255,.12) 90%, transparent);
        }

        /* ── ACCORDION CARD ── */
        .cl-card {
            display: grid; grid-template-columns: 38px 1fr;
            gap: 0 1.5rem; padding: 0 0 1.5rem 0;
        }
        .cl-card:last-child { padding-bottom: 0; }

        .cl-dot {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--card); border: 2px solid rgba(108,99,255,.35);
            display: flex; align-items: center; justify-content: center;
            position: relative; z-index: 1; box-shadow: 0 0 0 4px rgba(108,99,255,.07);
            margin-top: 4px; flex-shrink: 0;
        }
        .cl-dot-icon { font-size: .85rem; }

        .cl-body {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            transition: border-color .2s;
        }
        .cl-body:hover { border-color: rgba(108,99,255,.22); }

        /* header clicável */
        .cl-header {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; padding: 1.25rem 1.5rem;
            cursor: pointer; user-select: none;
            list-style: none;
        }
        .cl-header-left { display: flex; align-items: center; gap: .9rem; flex-wrap: wrap; }
        .cl-version {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.15rem; font-weight: 800; letter-spacing: -.02em;
        }
        .cl-date { font-size: .8rem; color: var(--muted); font-weight: 500; }

        .cl-header-right { display: flex; align-items: center; gap: .75rem; flex-shrink: 0; }
        .cl-count {
            font-size: .75rem; color: var(--muted); font-weight: 600;
            background: rgba(255,255,255,.05); border: 1px solid var(--border);
            padding: .18rem .6rem; border-radius: 50px;
            white-space: nowrap;
        }
        .cl-chevron {
            width: 20px; height: 20px; color: var(--muted);
            transition: transform .3s cubic-bezier(.4,0,.2,1);
            flex-shrink: 0;
        }
        .cl-card.open .cl-chevron { transform: rotate(180deg); }

        /* conteúdo colapsável */
        .cl-collapse {
            max-height: 0; overflow: hidden;
            transition: max-height .35s cubic-bezier(.4,0,.2,1);
        }
        .cl-card.open .cl-collapse { max-height: 2000px; }

        .cl-items {
            display: flex; flex-direction: column; gap: .5rem;
            padding: 0 1.5rem 1.4rem;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }
        .cl-item {
            display: flex; align-items: center; gap: .65rem;
            font-size: .9rem; line-height: 1.4;
        }
        .cl-tag {
            flex-shrink: 0; font-size: .67rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase;
            padding: .15rem .55rem; border-radius: 50px; border: 1px solid;
        }
        .cl-tag-0 { color: var(--primary); background: rgba(108,99,255,.12); border-color: rgba(108,99,255,.3); }
        .cl-tag-1 { color: var(--pink); background: rgba(255,101,132,.1); border-color: rgba(255,101,132,.3); }
        .cl-tag-3 { color: var(--cyan); background: rgba(0,212,255,.08); border-color: rgba(0,212,255,.25); }

        .cl-empty { text-align: center; color: var(--muted); padding: 4rem 0; font-size: 1rem; }

        /* ── FOOTER ── */
        footer { background: var(--bg2); border-top: 1px solid var(--border); padding: 3rem 6% 2rem; }
        .fbot { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .fbot p { font-size: .82rem; color: var(--muted); }
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

        @media (max-width: 600px) {
            .cl-timeline::before { left: calc(6% + 14px); }
            .cl-dot { width: 30px; height: 30px; }
            .cl-card { grid-template-columns: 30px 1fr; gap: 0 .9rem; }
            .cl-header { padding: 1rem 1.2rem; }
            .cl-items { padding: 0 1.2rem 1.2rem; padding-top: .9rem; }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions">
    </a>
    <a href="/delivery" class="btn-nav">&#8592; Voltar</a>
</nav>

<!-- HERO -->
<section class="cl-hero">
    <div class="orb orb-a"></div>
    <div class="orb orb-b"></div>
    <div class="cl-label"><span class="cl-label-dot"></span>Arcn Solutions</div>
    <h1 class="cl-title">Histórico de<br><span class="g">Atualizações</span></h1>
    <p class="cl-sub">Acompanhe todas as novidades, melhorias e correções dos nossos sistemas.</p>

    @php
        $countVersions = count($packages) + count($flowPackages);
        $totalNew = $totalFix = $totalImp = 0;
        foreach (array_merge($packages, $flowPackages) as $pkg) {
            foreach (preg_split('/;\s*/', trim($pkg['changelog'])) as $item) {
                $item = trim($item); if (!$item) continue;
                $type = (int)(explode(':', $item)[1] ?? 0);
                if ($type === 0) $totalNew++;
                elseif ($type === 1) $totalFix++;
                elseif ($type === 3) $totalImp++;
            }
        }
    @endphp

    <div class="cl-stats">
        <div class="cl-stat"><div class="cl-stat-n">{{ $countVersions }}</div><div class="cl-stat-l">versões</div></div>
        <div class="cl-stat"><div class="cl-stat-n">{{ $totalNew }}</div><div class="cl-stat-l">novidades</div></div>
        <div class="cl-stat"><div class="cl-stat-n">{{ $totalImp }}</div><div class="cl-stat-l">melhorias</div></div>
        <div class="cl-stat"><div class="cl-stat-n">{{ $totalFix }}</div><div class="cl-stat-l">correções</div></div>
    </div>
</section>

<div class="divider"></div>

<!-- PRODUCT TABS -->
<div class="cl-tabs">
    <button class="cl-tab active" data-section="multicardapios">
        Multi-Cardápios
    </button>
    <button class="cl-tab" data-section="flowpilot">
        <img src="{{ asset('storage/images/flow_pilot/logo.png') }}" alt="FlowPilot">
        FlowPilot
    </button>
</div>

<!-- FILTERS -->
<div class="cl-filters">
    <button class="cl-filter active" data-type="all">Todos</button>
    <button class="cl-filter" data-type="0">✨ Novidades</button>
    <button class="cl-filter" data-type="3">⚡ Melhorias</button>
    <button class="cl-filter" data-type="1">🐛 Correções</button>
</div>

<!-- MULTI-CARDÁPIOS -->
<div class="cl-section active" id="section-multicardapios">
    <div class="cl-timeline">
        @forelse ($packages as $i => $pkg)
            @php
                $items = array_filter(array_map('trim', preg_split('/;\s*/', trim($pkg['changelog']))));
                $date  = \Carbon\Carbon::parse($pkg['date'])->locale('pt_BR')->isoFormat('D MMM YYYY');
                $count = count($items);
            @endphp
            <div class="cl-card {{ $i === 0 ? 'open' : '' }}" data-version="{{ $pkg['version'] }}">
                <div class="cl-dot"><span class="cl-dot-icon">📦</span></div>
                <div class="cl-body">
                    <div class="cl-header">
                        <div class="cl-header-left">
                            <span class="cl-version">v{{ $pkg['version'] }}</span>
                            <span class="cl-date">{{ $date }}</span>
                        </div>
                        <div class="cl-header-right">
                            <span class="cl-count">{{ $count }} {{ $count === 1 ? 'item' : 'itens' }}</span>
                            <svg class="cl-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>
                    <div class="cl-collapse">
                        <div class="cl-items">
                            @foreach ($items as $item)
                                @php
                                    $parts = explode(':', $item);
                                    $name  = trim($parts[0]);
                                    $type  = (int)(trim($parts[1] ?? '0'));
                                    $labels = [0 => 'Novo', 1 => 'Correção', 3 => 'Melhoria'];
                                @endphp
                                <div class="cl-item" data-type="{{ $type }}">
                                    <span class="cl-tag cl-tag-{{ $type }}">{{ $labels[$type] ?? 'Novo' }}</span>
                                    <span>{{ $name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="cl-empty">Não foi possível carregar as atualizações.</div>
        @endforelse
    </div>
</div>

<!-- FLOWPILOT -->
<div class="cl-section" id="section-flowpilot">
    <div class="cl-timeline">
        @forelse ($flowPackages as $i => $pkg)
            @php
                $items = array_filter(array_map('trim', preg_split('/;\s*/', trim($pkg['changelog']))));
                $date  = \Carbon\Carbon::parse($pkg['released_at'])->locale('pt_BR')->isoFormat('D MMM YYYY');
                $count = count($items);
            @endphp
            <div class="cl-card {{ $i === 0 ? 'open' : '' }}" data-version="{{ $pkg['version'] }}">
                <div class="cl-dot"><span class="cl-dot-icon">📦</span></div>
                <div class="cl-body">
                    <div class="cl-header">
                        <div class="cl-header-left">
                            <span class="cl-version">v{{ $pkg['version'] }}</span>
                            <span class="cl-date">{{ $date }}</span>
                        </div>
                        <div class="cl-header-right">
                            <span class="cl-count">{{ $count }} {{ $count === 1 ? 'item' : 'itens' }}</span>
                            <svg class="cl-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>
                    <div class="cl-collapse">
                        <div class="cl-items">
                            @foreach ($items as $item)
                                @php
                                    $parts = explode(':', $item);
                                    $name  = trim($parts[0]);
                                    $type  = (int)(trim($parts[1] ?? '0'));
                                    $labels = [0 => 'Novo', 1 => 'Correção', 3 => 'Melhoria'];
                                @endphp
                                <div class="cl-item" data-type="{{ $type }}">
                                    <span class="cl-tag cl-tag-{{ $type }}">{{ $labels[$type] ?? 'Novo' }}</span>
                                    <span>{{ $name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="cl-empty">Não foi possível carregar as atualizações.</div>
        @endforelse
    </div>
</div>

<!-- FOOTER -->
<footer>
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

<script>
document.getElementById('yr').textContent = new Date().getFullYear();

// Accordion
document.querySelectorAll('.cl-header').forEach(function(header) {
    header.addEventListener('click', function() {
        var card = header.closest('.cl-card');
        card.classList.toggle('open');
    });
});

// Product tabs
document.querySelectorAll('.cl-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.cl-tab').forEach(function(t){ t.classList.remove('active'); });
        document.querySelectorAll('.cl-section').forEach(function(s){ s.classList.remove('active'); });
        tab.classList.add('active');
        document.getElementById('section-' + tab.dataset.section).classList.add('active');
        // reset filtros
        document.querySelectorAll('.cl-filter').forEach(function(f){ f.classList.remove('active'); });
        document.querySelector('.cl-filter[data-type="all"]').classList.add('active');
        applyFilter('all');
    });
});

// Filtros
function applyFilter(type) {
    var activeSection = document.querySelector('.cl-section.active');
    activeSection.querySelectorAll('.cl-card').forEach(function(card) {
        if (type === 'all') {
            card.style.display = '';
            card.querySelectorAll('.cl-item').forEach(function(i){ i.style.display = ''; });
            return;
        }
        var items = card.querySelectorAll('.cl-item');
        var hasMatch = false;
        items.forEach(function(item) {
            var show = item.dataset.type === type;
            item.style.display = show ? '' : 'none';
            if (show) hasMatch = true;
        });
        card.style.display = hasMatch ? '' : 'none';
    });
}

document.querySelectorAll('.cl-filter').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.cl-filter').forEach(function(b){ b.classList.remove('active'); });
        btn.classList.add('active');
        applyFilter(btn.dataset.type);
    });
});
</script>

</body>
</html>
