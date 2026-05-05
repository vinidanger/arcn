<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <x-seo
        title="Arcn Solutions — Soluções Digitais para Restaurantes"
        description="Cardápio digital, gestor de pedidos e app do garçom para impulsionar seu restaurante. Sem mensalidade."
        path="/delivery"
        image="/images/og-delivery.png"
        keywords="cardápio digital, gestão de restaurante, pedidos delivery, app garçom, Arcn Solutions"
    />
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
            --text:    #e8eaf6;
            --muted:   #7b80a0;
            --r:       18px;
            /* Altura aproximada do nav fixo + safe area — evita título escondido ao abrir #âncora */
            --nav-scroll-pad: calc(5.5rem + env(safe-area-inset-top, 0px));
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: var(--nav-scroll-pad);
            overflow-x: hidden;
            width: 100%;
        }
        html.nav-menu-open, html.nav-menu-open body { overflow: hidden; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            overflow-x: clip;
            width: 100%;
            max-width: 100%;
        }

        /* noise */
        body::before {
            content: '';
            position: fixed; inset: 0;
            opacity: .022;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }

        /* ── NAV (sem backdrop-filter/transform no header — painel mobile fixed cobre a tela) ── */
        .site-header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            display: flex; align-items: center; justify-content: space-between;
            gap: .75rem;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            padding: max(1.2rem, env(safe-area-inset-top, 0px)) max(6%, env(safe-area-inset-right, 0px)) 1.2rem max(6%, env(safe-area-inset-left, 0px));
            background: rgba(7,8,13,.94);
            border-bottom: 1px solid var(--border);
        }
        .site-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex: 0 1 auto;
            min-width: 0;
        }
        .logo {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.5rem; font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            letter-spacing: -.02em; text-decoration: none;
            flex: 1 1 auto;
            min-width: 0;
            display: flex;
            align-items: center;
        }
        .logo img {
            max-width: min(160px, 46vw);
            height: auto;
            max-height: 32px;
            width: auto;
            object-fit: contain;
        }
        .nav-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            padding: 0;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
            color: var(--text);
            cursor: pointer;
            flex-shrink: 0;
            transition: border-color .2s, background .2s;
        }
        .nav-toggle:hover { border-color: rgba(255,255,255,.12); background: rgba(255,255,255,.04); }
        .nav-toggle-lines { display: flex; flex-direction: column; gap: 5px; width: 20px; }
        .nav-toggle-lines span {
            display: block; height: 2px; width: 100%; background: var(--text);
            border-radius: 1px; transition: transform .22s ease, opacity .22s;
        }
        .site-header.nav-open .nav-toggle-lines span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .site-header.nav-open .nav-toggle-lines span:nth-child(2) { opacity: 0; }
        .site-header.nav-open .nav-toggle-lines span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        .nav-panel {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex: 1;
            justify-content: flex-end;
            min-width: 0;
        }
        .nav-links { display: flex; gap: 2rem; list-style: none; align-items: center; margin: 0; padding: 0; }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: .9rem; font-weight: 500; transition: color .2s; }
        .nav-links a:hover { color: #fff; }
        .btn-nav {
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; text-decoration: none; padding: .6rem 1.4rem;
            border-radius: 50px; font-size: .875rem; font-weight: 600;
            transition: opacity .2s, transform .2s;
            flex-shrink: 0;
            white-space: nowrap;
        }
        .btn-nav:hover { opacity: .85; transform: translateY(-1px); }

        /* ── ORB HELPERS ── */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); pointer-events: none;
            animation: float 9s ease-in-out infinite;
        }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-28px)} }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 9rem 6% 6rem;
            position: relative; z-index: 1;
            overflow: hidden;
        }
        .hero .orb-a { width:420px;height:420px;background:rgba(108,99,255,.14);top:8%;left:-6%; }
        .hero .orb-b { width:320px;height:320px;background:rgba(0,212,255,.09);bottom:12%;right:-5%;animation-delay:-4.5s; }
        .hero .orb-c { width:240px;height:240px;background:rgba(255,101,132,.07);top:55%;left:38%;animation-delay:-2s; }

        .badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(108,99,255,.11); border: 1px solid rgba(108,99,255,.28);
            padding: .38rem 1rem; border-radius: 50px;
            font-size: .78rem; font-weight: 600; color: #a89fff;
            letter-spacing: .07em; text-transform: uppercase;
            margin-bottom: 1.5rem; position: relative; z-index: 1;
        }
        .badge-dot { width:6px;height:6px;border-radius:50%;background:var(--primary);display:block;animation:blink 2s infinite; }
        @keyframes blink { 0%,100%{opacity:1}50%{opacity:.35} }

        .hero-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(2.8rem, 7vw, 5.4rem);
            font-weight: 800; line-height: 1.07;
            letter-spacing: -.03em;
            position: relative; z-index: 1; margin-bottom: 1.4rem;
        }
        .g {
            background: linear-gradient(135deg, var(--primary) 0%, var(--cyan) 55%, #b388ff 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .hero-sub {
            font-size: clamp(.95rem, 2vw, 1.18rem);
            color: var(--muted); max-width: 580px; margin: 0 auto 2.5rem;
            position: relative; z-index: 1;
        }

        .hero-cta {
            display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
            position: relative; z-index: 1; margin-bottom: 4rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; text-decoration: none; padding: .9rem 2rem; border-radius: 50px;
            font-size: 1rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: .5rem;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 0 32px rgba(108,99,255,.38);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 0 55px rgba(108,99,255,.52); }

        .btn-ghost {
            background: transparent; border: 1px solid var(--border);
            color: var(--text); text-decoration: none; padding: .9rem 2rem;
            border-radius: 50px; font-size: 1rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: .5rem;
            transition: border-color .2s, background .2s;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,.28); background: rgba(255,255,255,.04); }

        .hero-stats {
            display: flex; gap: 3rem; justify-content: center; flex-wrap: wrap;
            position: relative; z-index: 1;
        }
        .stat-num {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 2rem; font-weight: 800;
            background: linear-gradient(135deg,#fff,var(--muted));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
            text-align: center;
        }
        .stat-lbl { font-size: .78rem; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: .06em; text-align: center; }

        /* ── SECTION COMMON ── */
        section { padding: 6rem 6%; position: relative; z-index: 1; }
        .slabel { font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--primary); margin-bottom: .7rem; }
        .stitle {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(1.9rem, 4vw, 3rem);
            font-weight: 800; letter-spacing: -.02em; line-height: 1.12; margin-bottom: 1rem;
        }
        .ssub { color: var(--muted); max-width: 540px; font-size: 1.03rem; }
        .center { text-align: center; }
        .center .ssub { margin: 0 auto; }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            margin: 0 6%;
        }

        /* ── PRODUCTS ── */
        .products-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 310px), 1fr));
            gap: 1.5rem; margin-top: 3.5rem;
        }
        .pcard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 2.4rem;
            position: relative; overflow: hidden;
            transition: transform .3s, border-color .3s, box-shadow .3s;
        }
        .pcard:hover {
            transform: translateY(-6px);
            border-color: rgba(108,99,255,.38);
            box-shadow: 0 20px 60px rgba(0,0,0,.38), 0 0 36px rgba(108,99,255,.08);
        }
        .pcard.feat {
            border-color: rgba(108,99,255,.45);
            background: linear-gradient(145deg,#141628,#111320);
        }
        .pcard.feat::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--cyan));
        }
        .feat-tag {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; font-size: .7rem; font-weight: 700;
            letter-spacing: .08em; text-transform: uppercase;
            padding: .22rem .75rem; border-radius: 50px; margin-bottom: 1.2rem;
        }
        .picon {
            width: 54px; height: 54px; border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; margin-bottom: 1.4rem;
        }
        .pi-menu   { background: rgba(108,99,255,.14); }
        .pi-flow   { background: rgba(0,212,255,.11); }
        .pi-waiter { background: rgba(255,101,132,.11); }
        /* Mesmo quadrado 54×54 dos emojis — só a logo encolhe por dentro */
        .picon-logo {
            padding: 8px;
            box-sizing: border-box;
        }
        .picon-logo img {
            display: block;
            width: auto;
            height: auto;
            max-width: 38px;
            max-height: 38px;
            object-fit: contain;
        }

        .pname {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.45rem; font-weight: 800;
            letter-spacing: -.02em; margin-bottom: .35rem;
        }
        .ptag { font-size: .83rem; color: var(--primary); font-weight: 600; margin-bottom: .9rem; }
        .pdesc { color: var(--muted); font-size: .93rem; line-height: 1.65; margin-bottom: 1.65rem; }

        .pfeatures { list-style: none; display: flex; flex-direction: column; gap: .55rem; }
        .pfeatures li { display: flex; align-items: flex-start; gap: .6rem; font-size: .88rem; color: #c0c4d8; }
        .ck {
            flex-shrink: 0; margin-top: 2px;
            width: 17px; height: 17px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .ck-p { background: rgba(108,99,255,.15); }
        .ck-c { background: rgba(0,212,255,.12); }
        .ck-pk { background: rgba(255,101,132,.12); }

        /* ── MOCKUP ── */
        #preview { background: var(--bg2); overflow: clip; }
        .mockup-scene {
            display: flex; align-items: flex-end; justify-content: center;
            margin: 4rem auto 0; position: relative;
            max-width: 860px;
        }
        .mockup-scene::before {
            content: '';
            position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%);
            width: 80%; height: 200px;
            background: radial-gradient(ellipse, rgba(108,99,255,.2) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── DESKTOP ── */
        .desktop-wrap { position: relative; z-index: 2; flex-shrink: 0; }
        .desktop-frame {
            width: 620px;
            background: #1a1b26;
            border-radius: 14px 14px 0 0;
            border: 2px solid #2a2b3a;
            box-shadow: 0 40px 80px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.04);
            overflow: hidden;
        }
        .df-bar {
            background: #13141f; padding: .55rem .85rem;
            display: flex; align-items: center; gap: .6rem;
            border-bottom: 1px solid #2a2b3a;
        }
        .df-dot { width: 11px; height: 11px; border-radius: 50%; }
        .df-dot.r { background: #ff5f57; }
        .df-dot.y { background: #febc2e; }
        .df-dot.g { background: #28c840; }
        .df-url {
            flex: 1; margin: 0 .8rem;
            background: #1e1f2e; border-radius: 6px;
            padding: .28rem .85rem; font-size: .72rem; color: var(--muted);
            font-family: monospace; text-align: center;
        }
        .df-screen { overflow: hidden; line-height: 0; }
        .df-screen img { width: 100%; display: block; }

        .desktop-stand {
            width: 110px; height: 14px; background: #1a1b26;
            border: 2px solid #2a2b3a; border-top: none;
            margin: 0 auto; border-radius: 0 0 4px 4px;
        }
        .desktop-base {
            width: 190px; height: 7px;
            background: #1a1b26; border: 2px solid #2a2b3a;
            margin: 0 auto; border-radius: 4px;
        }

        /* ── PHONE ── */
        .phone-wrap {
            position: relative; z-index: 3; flex-shrink: 0;
            margin-left: -70px; margin-bottom: 28px;
        }
        .phone-frame {
            width: 195px;
            background: #111;
            border-radius: 36px;
            border: 7px solid #1e1e1e;
            box-shadow: 0 30px 70px rgba(0,0,0,.75),
                        inset 0 0 0 1px rgba(255,255,255,.07),
                        0 0 0 1px rgba(255,255,255,.04);
            overflow: hidden;
            position: relative;
        }
        .phone-notch {
            position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            width: 70px; height: 22px; background: #111;
            border-radius: 0 0 16px 16px; z-index: 10;
        }
        .pf-screen { line-height: 0; }
        .pf-screen img { width: 100%; display: block; }

        /* caption */
        .mockup-bullets {
            display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap;
            margin-top: 3rem;
        }
        .mbullet { display: flex; align-items: center; gap: .55rem; font-size: .85rem; color: var(--muted); }
        .mbullet-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--primary); flex-shrink: 0; }

        @media (max-width: 900px) {
            .mockup-scene { display: none; }
        }

        /* ── MOCKUP MOBILE SLIDER ── */
        .mock-slider { display: none; margin-top: 2.5rem; }
        @media (max-width: 900px) { .mock-slider { display: block; } }

        .mock-outer { overflow: hidden; }
        .mock-track {
            display: flex;
            transition: transform .4s cubic-bezier(.4,0,.2,1);
            will-change: transform;
        }
        .mock-slide {
            min-width: 100%;
            box-sizing: border-box;
            padding: 0 5%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .mock-slide-label {
            font-size: .78rem; font-weight: 600; letter-spacing: .08em;
            text-transform: uppercase; color: var(--muted);
            margin-bottom: 1.2rem;
        }
        /* desktop frame dentro do slide mobile */
        .mock-slide .desktop-frame { width: 100%; }
        /* phone frame dentro do slide mobile */
        .mock-slide .phone-frame { width: 220px; }
        .mock-slide .phone-wrap { margin: 0; position: relative; }
        .mock-slide .phone-notch {
            position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            width: 70px; height: 22px; background: #111;
            border-radius: 0 0 16px 16px; z-index: 10;
        }

        /* ── SWIPE DOTS ── */
        .swipe-dots {
            display: none; justify-content: center; gap: .5rem;
            margin-top: 1rem;
        }
        .swipe-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: rgba(255,255,255,.25); transition: background .3s, width .3s;
        }
        .swipe-dot.active { background: var(--primary); width: 18px; border-radius: 4px; }
        @media (max-width: 900px) { .swipe-dots { display: flex; } }

        /* ── HOW IT WORKS ── */
        #como-funciona { background: var(--bg2); }
        .steps-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 210px), 1fr));
            gap: 2rem; margin-top: 3.5rem;
        }
        .step { text-align: center; padding: 2rem 1.5rem; }
        .step-num {
            width: 50px; height: 50px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.15rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem;
            box-shadow: 0 0 28px rgba(108,99,255,.38);
        }
        .step h3 { font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.05rem; font-weight: 700; margin-bottom: .45rem; }
        .step p { color: var(--muted); font-size: .88rem; }

        /* ── WHY ── */
        .why-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 4rem; align-items: center; margin-top: 3rem;
        }
        .why-items { display: flex; flex-direction: column; gap: 1.7rem; }
        .why-item { display: flex; gap: .95rem; }
        .wicon {
            flex-shrink: 0; width: 42px; height: 42px; border-radius: 11px;
            background: rgba(108,99,255,.11); border: 1px solid rgba(108,99,255,.18);
            display: flex; align-items: center; justify-content: center; font-size: 1.15rem;
        }
        .why-item h4 { font-weight: 700; margin-bottom: .22rem; }
        .why-item p { color: var(--muted); font-size: .88rem; }

        .metrics {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 2.2rem;
            display: grid; grid-template-columns: 1fr 1fr; gap: .9rem;
        }
        .mcard {
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 11px; padding: 1.2rem; text-align: center;
        }
        .mcard.full { grid-column: 1/-1; }
        .mval {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.9rem; font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .mlbl { font-size: .75rem; color: var(--muted); margin-top: .2rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; }

        /* ── PRICING ── */
        #planos { background: var(--bg2); }
        .pricing-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 270px), 1fr));
            gap: 1.5rem; margin-top: 3.5rem;
        }
        .prcard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 2.2rem;
            transition: transform .3s, box-shadow .3s;
            display: flex; flex-direction: column;
        }
        .prcard:hover { transform: translateY(-4px); box-shadow: 0 18px 48px rgba(0,0,0,.32); }
        .prcard.hi {
            border-color: rgba(108,99,255,.45);
            background: linear-gradient(145deg,#141628,#111320);
            position: relative;
        }
        .prcard.hi::before {
            content: 'Mais Popular'; position: absolute; top: -13px; left: 50%; transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; font-size: .7rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            padding: .28rem .95rem; border-radius: 50px; white-space: nowrap;
        }
        .prcard.top {
            border-color: rgba(0,212,255,.4);
            background: linear-gradient(145deg,#0d1a20,#0d1118);
            position: relative;
        }
        .prcard.top::before {
            content: 'Completo'; position: absolute; top: -13px; left: 50%; transform: translateX(-50%);
            background: linear-gradient(135deg, var(--cyan), #00ffcc);
            color: #07080d; font-size: .7rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            padding: .28rem .95rem; border-radius: 50px; white-space: nowrap;
        }
        .prname { font-family: 'Bricolage Grotesque', sans-serif; font-size: 1.18rem; font-weight: 700; margin-bottom: .65rem; }
        .prdesc { color: var(--muted); font-size: .86rem; margin-bottom: 1.4rem; min-height: 2.4rem; }
        .prprice { font-family: 'Bricolage Grotesque', sans-serif; font-size: 2.7rem; font-weight: 800; letter-spacing: -.03em; margin-bottom: .2rem; }
        .prprice sup { font-size: 1.1rem; vertical-align: super; color: var(--muted); }
        .prprice sub { font-size: .9rem; font-weight: 500; color: var(--muted); }
        .prori { font-size: .83rem; color: var(--muted); text-decoration: line-through; margin-bottom: .28rem; }
        .prins { font-size: .83rem; color: var(--primary); font-weight: 600; margin-bottom: 1.4rem; }
        .pronce { font-size: .76rem; color: var(--muted); }
        .prfeat { list-style: none; display: flex; flex-direction: column; gap: .6rem; margin-bottom: 1.8rem; flex: 1; }
        .prfeat li { display: flex; align-items: flex-start; gap: .6rem; font-size: .86rem; color: #c0c4d8; }
        .prfeat li svg { flex-shrink: 0; margin-top: 2px; }
        .prbtn {
            display: block; text-align: center; text-decoration: none;
            padding: .82rem; border-radius: 50px; font-size: .88rem; font-weight: 600;
            transition: opacity .2s, transform .2s; margin-top: auto;
        }
        .prbtn.pri {
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff; box-shadow: 0 0 22px rgba(108,99,255,.32);
        }
        .prbtn.pri:hover { opacity: .87; transform: translateY(-1px); }
        .prbtn.cyan {
            background: linear-gradient(135deg, var(--cyan), #00ffcc);
            color: #07080d; box-shadow: 0 0 22px rgba(0,212,255,.28);
        }
        .prbtn.cyan:hover { opacity: .87; transform: translateY(-1px); }
        .prbtn.out { border: 1px solid var(--border); color: var(--text); }
        .prbtn.out:hover { border-color: rgba(255,255,255,.24); background: rgba(255,255,255,.04); }

        /* ── TESTIMONIALS ── */
        .tgrid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 270px), 1fr));
            gap: 1.5rem; margin-top: 3.5rem;
        }
        .tcard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 1.9rem;
            transition: transform .3s;
        }
        .tcard:hover { transform: translateY(-3px); }
        .stars { color: #fbbf24; font-size: .88rem; margin-bottom: .9rem; letter-spacing: .1em; }
        .ttext { color: #d0d4e8; font-size: .93rem; line-height: 1.7; margin-bottom: 1.4rem; font-style: italic; }
        .tauthor { display: flex; align-items: center; gap: .7rem; }
        .tavatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: .85rem;
        }
        .taname { font-weight: 600; font-size: .88rem; }
        .tarole { font-size: .75rem; color: var(--muted); }

        /* ── CTA ── */
        #contato { background: var(--bg); }
        .cta-box {
            background: linear-gradient(135deg,#0f1024,#14163a);
            border: 1px solid rgba(108,99,255,.28); border-radius: 24px;
            padding: 4rem; text-align: center; position: relative; overflow: hidden;
        }
        .cta-box::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at center top, rgba(108,99,255,.18) 0%, transparent 60%);
            pointer-events: none;
        }
        .cta-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(1.7rem, 4vw, 2.9rem); font-weight: 800; letter-spacing: -.02em;
            margin-bottom: .9rem; position: relative;
        }
        .cta-sub { color: var(--muted); font-size: 1.02rem; margin-bottom: 2.4rem; position: relative; }
        .cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; position: relative; }

        .wa-btn {
            display: inline-flex; align-items: center; gap: .55rem;
            background: #25D366; color: #fff; text-decoration: none;
            padding: .88rem 1.9rem; border-radius: 50px; font-size: .98rem; font-weight: 600;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 0 28px rgba(37,211,102,.28);
        }
        .wa-btn:hover { transform: translateY(-2px); box-shadow: 0 0 48px rgba(37,211,102,.42); }

        /* ── FOOTER ── */
        footer {
            background: var(--bg); border-top: 1px solid var(--border);
            padding: 3rem 6% 2rem; position: relative; z-index: 1;
        }
        .fgrid {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem; margin-bottom: 2.5rem;
        }
        .fbrand .logo { font-size: 1.7rem; margin-bottom: .65rem; display: block; }
        .fbrand p { color: var(--muted); font-size: .88rem; max-width: 270px; line-height: 1.65; }
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
        /* Tons discretos alinhados ao tema escuro — só um véu da cor da marca */
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

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .site-header-bar {
                flex: 1 1 auto;
                min-width: 0;
                width: 100%;
                max-width: 100%;
            }
            .site-header .logo,
            .site-header .nav-toggle {
                position: relative;
                z-index: 1102;
            }
            .nav-toggle { display: inline-flex; }
            .nav-panel {
                position: fixed;
                inset: 0;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                z-index: 1100;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                gap: 0;
                flex: none !important;
                margin: 0;
                padding: calc(4.75rem + env(safe-area-inset-top, 0px)) max(6%, env(safe-area-inset-right, 0px)) 2rem max(6%, env(safe-area-inset-left, 0px));
                background: rgba(7,8,13,.98);
                overflow-x: hidden;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity .22s ease, visibility .22s;
            }
            .site-header.nav-open .nav-panel {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }
            .nav-panel .nav-links {
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                width: 100%;
            }
            .nav-panel .nav-links li { border-bottom: 1px solid var(--border); }
            .nav-panel .nav-links a {
                display: block;
                padding: 1.05rem 0;
                font-size: 1.05rem;
            }
            .nav-panel .btn-nav {
                margin-top: 1.35rem;
                width: 100%;
                justify-content: center;
                text-align: center;
                display: inline-flex;
                align-items: center;
                box-sizing: border-box;
            }
            .why-grid { grid-template-columns: 1fr; }
            .fgrid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            :root {
                --nav-scroll-pad: calc(4.5rem + env(safe-area-inset-top, 0px));
            }
            .site-header {
                padding: max(1rem, env(safe-area-inset-top, 0px)) max(5%, env(safe-area-inset-right, 0px)) 1rem max(5%, env(safe-area-inset-left, 0px));
                background: rgba(7,8,13,.97);
            }
            .btn-nav { padding: .55rem 1rem; font-size: .8rem; }
            section { padding: 4rem 5%; }
            .hero { padding: 7rem 5% 4rem; }
            .hero-stats { gap: 2rem; }
            .cta-box { padding: 2.5rem 1.5rem; }
            .fgrid { grid-template-columns: 1fr; gap: 2rem; }
            .orb { display: none; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<header class="site-header" id="site-nav">
    <div class="site-header-bar">
    <a href="{{ url('/delivery') }}" class="logo" style="-webkit-text-fill-color:initial">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="32" style="display:block">
    </a>
    <button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Abrir menu">
        <span class="nav-toggle-lines" aria-hidden="true"><span></span><span></span><span></span></span>
    </button>
    </div>
    <div class="nav-panel" id="primary-nav">
        <ul class="nav-links">
            <li><a href="#produtos">Produtos</a></li>
            <li><a href="#como-funciona">Como Funciona</a></li>
            <li><a href="#vantagens">Vantagens</a></li>
            <li><a href="#planos">Planos</a></li>
            <li><a href="{{ url('/delivery/changelog') }}">Changelog</a></li>
        </ul>
        <a href="https://wa.me/5515998215892" target="_blank" rel="noopener noreferrer" class="btn-nav">Fale Conosco</a>
    </div>
</header>

<!-- HERO -->
<section class="hero">
    <div class="orb orb-a"></div>
    <div class="orb orb-b"></div>
    <div class="orb orb-c"></div>

    <div class="badge">
        <span class="badge-dot"></span>
        Oportunidade de Negócio
    </div>

    <h1 class="hero-title">
        Venda sistemas para<br>
        <span class="g">qualquer</span><br>
        <span id="typewriter"></span><span class="cursor">|</span>
    </h1>

    <p class="hero-sub">
        Adquira o sistema uma vez, revenda planos recorrentes para lanchonetes,
        pizzarias e restaurantes — e construa uma renda mensal previsível.
    </p>

    <div class="hero-cta">
        <a href="https://wa.me/5515998215892" target="_blank" class="btn-primary">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.104 1.523 5.831L0 24l6.335-1.502A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.014-1.378l-.36-.214-3.731.979.996-3.648-.234-.374A9.79 9.79 0 012.182 12c0-5.424 4.41-9.836 9.836-9.836S21.818 6.576 21.818 12c0 5.424-4.412 9.818-9.818 9.818z"/></svg>
            Quero Começar
        </a>
        <a href="#como-funciona" class="btn-ghost">
            Como funciona
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="hero-stats">
        <div>
            <div class="stat-num">&#8734;</div>
            <div class="stat-lbl">Lojistas por conta</div>
        </div>
        <div>
            <div class="stat-num">100%</div>
            <div class="stat-lbl">Margem sua</div>
        </div>
        <div>
            <div class="stat-num">24/7</div>
            <div class="stat-lbl">Suporte técnico</div>
        </div>
        <div>
            <div class="stat-num">R$490</div>
            <div class="stat-lbl">Adesão única</div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- PRODUTOS -->
<section id="produtos">
    <div class="center">
        <p class="slabel">O que você revende</p>
        <h2 class="stitle">Três produtos.<br>Um portfólio completo.</h2>
        <p class="ssub">Você oferece ao seu cliente final um ecossistema completo — cardápio, gestão e atendimento em um único pacote, com integração com o <strong style="font-weight:600;color:var(--text)">iFood</strong> para centralizar pedidos do delivery.</p>
    </div>

    <div class="products-grid">

        <!-- Multi-Cardápios -->
        <div class="pcard feat">
            <div class="picon pi-menu">&#x1F37D;&#xFE0F;</div>
            <div class="pname">Multi-Cardápios</div>
            <div class="ptag">Cardápio digital com pedidos online</div>
            <p class="pdesc">
                Sistema completo de cardápio digital e pedidos online, com <strong style="font-weight:600;color:var(--text)">integração com o iFood</strong>. Seus clientes acessam pelo celular, fazem pedidos e pagam — e os pedidos vindos do iFood entram no mesmo fluxo, sem planilha nem atalho.
            </p>
            <ul class="pfeatures">
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Produtos, categorias e pedidos ilimitados</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Integração com iFood — pedidos centralizados no painel</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Pix, MercadoPago, PagSeguro, GerênciaNet</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Geolocalização Google Maps + cashback</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Impressão automática de pedidos</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Painel administrativo completo</li>
                <li><span class="ck ck-p"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#6c63ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>PWA — funciona como app, sem instalar</li>
            </ul>
        </div>

        <!-- FlowPilot -->
        <div class="pcard">
            <div class="picon pi-flow picon-logo">
                <img src="{{ asset('storage/images/flow_pilot/logo.png') }}" alt="FlowPilot" loading="lazy">
            </div>
            <div class="pname">FlowPilot</div>
            <div class="ptag" style="color:var(--cyan)">Gestor de Pedidos inteligente</div>
            <p class="pdesc">
                Sistema desktop de gestão de pedidos em tempo real para cozinha e caixa. Controle total do fluxo de trabalho, do preparo à entrega, com alertas automáticos.
            </p>
            <ul class="pfeatures">
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Pedidos em tempo real na tela</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Pedidos do iFood no mesmo fluxo (cozinha e caixa)</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Controle de status por etapas</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Alertas sonoros para novos pedidos</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Relatórios e histórico completo</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Interface intuitiva para a cozinha</li>
                <li><span class="ck ck-c"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#00d4ff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Integrado ao Multi-Cardápios</li>
            </ul>
        </div>

        <!-- WaiterPilot -->
        <div class="pcard">
            <div class="picon pi-waiter picon-logo">
                <img src="{{ asset('storage/images/waiter_pilot/logo.png') }}" alt="WaiterPilot" loading="lazy">
            </div>
            <div class="pname">WaiterPilot</div>
            <div class="ptag" style="color:var(--pink)">App do Garçom para mobile</div>
            <p class="pdesc">
                App mobile para seus garçons anotarem pedidos na mesa e enviarem para a cozinha em tempo real. Mais agilidade e zero erros no atendimento presencial.
            </p>
            <ul class="pfeatures">
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>App Android e iOS (Flutter)</li>
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Comandas digitais por mesa</li>
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Envio de pedidos à cozinha em tempo real</li>
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Cardápio visual para o garçom</li>
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Histórico de pedidos por mesa</li>
                <li><span class="ck ck-pk"><svg width="10" height="10" viewBox="0 0 12 12" fill="none"><polyline points="2 6 5 9 10 3" stroke="#ff6584" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Interface rápida e offline-first</li>
            </ul>
        </div>

    </div>
</section>

<div class="divider"></div>

<!-- MOCKUP PREVIEW -->
<section id="preview">
    <div class="center">
        <p class="slabel">O produto que você entrega</p>
        <h2 class="stitle">Seus clientes vão amar.<br>Você vai lucrar.</h2>
        <p class="ssub">Interface moderna e responsiva que impressiona — seus lojistas vendem mais e você mantém a recorrência.</p>
    </div>

    <div class="mockup-scene">

        <!-- DESKTOP -->
        <div class="desktop-wrap">
            <div class="desktop-frame">
                <div class="df-bar">
                    <div class="df-dot r"></div>
                    <div class="df-dot y"></div>
                    <div class="df-dot g"></div>
                    <div class="df-url">&#x1F512; sualojaonline.com.br</div>
                </div>
                <div class="df-screen">
                    <img src="{{ asset('storage/images/pc-cardapio.png') }}" alt="Cardápio Digital — Desktop" class="fscreen">
                </div>
            </div>
            <div class="desktop-stand"></div>
            <div class="desktop-base"></div>
        </div>

        <!-- PHONE -->
        <div class="phone-wrap">
            <div class="phone-notch"></div>
            <div class="phone-frame">
                <div class="pf-screen">
                    <img src="{{ asset('storage/images/mobile-cardapio.png') }}" alt="Cardápio Digital — Mobile" class="fscreen">
                </div>
            </div>
        </div>

    </div>

    <!-- MOBILE SLIDER -->
    <div class="mock-slider">
        <div class="mock-outer">
            <div class="mock-track" id="mockTrack">

                <!-- Slide 1: Desktop -->
                <div class="mock-slide">
                    <p class="mock-slide-label">Versão Desktop</p>
                    <div class="desktop-frame">
                        <div class="df-bar">
                            <div class="df-dot r"></div>
                            <div class="df-dot y"></div>
                            <div class="df-dot g"></div>
                            <div class="df-url">&#x1F512; sualojaonline.com.br</div>
                        </div>
                        <div class="df-screen">
                            <img src="{{ asset('storage/images/pc-cardapio.png') }}" alt="Desktop">
                        </div>
                    </div>
                    <div class="desktop-stand"></div>
                    <div class="desktop-base"></div>
                </div>

                <!-- Slide 2: Mobile -->
                <div class="mock-slide">
                    <p class="mock-slide-label">Versão Mobile</p>
                    <div class="phone-wrap">
                        <div class="phone-notch"></div>
                        <div class="phone-frame">
                            <div class="pf-screen">
                                <img src="{{ asset('storage/images/mobile-cardapio.png') }}" alt="Mobile">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="swipe-dots">
            <span class="swipe-dot active"></span>
            <span class="swipe-dot"></span>
        </div>
    </div>

    <!-- bullets -->
    <div class="mockup-bullets">
        <div class="mbullet"><span class="mbullet-dot"></span>Interface totalmente customizável</div>
        <div class="mbullet"><span class="mbullet-dot" style="background:var(--cyan)"></span>Funciona como app sem instalar (PWA)</div>
        <div class="mbullet"><span class="mbullet-dot" style="background:var(--pink)"></span>100% responsivo — mobile e desktop</div>
        <div class="mbullet"><span class="mbullet-dot" style="background:#ea1d2c"></span>Integração com iFood</div>
    </div>
</section>

<div class="divider"></div>

<!-- FEATURES SHOWCASE -->
<section id="funcionalidades">
    <div class="center">
        <p class="slabel">Funcionalidades</p>
        <h2 class="stitle">Tudo que seu cliente<br>precisa em um sistema</h2>
        <p class="ssub">Do pedido online à cozinha, do PDV ao app do garçom — um ecossistema completo para entregar ao seu lojista.</p>
    </div>

    <!-- Tabs -->
    <div class="ftabs">
        <button class="ftab active" data-tab="pizza">
            <span class="ftab-icon">&#x1F355;</span>
            <span class="ftab-label">Monte sua Pizza</span>
        </button>
        <button class="ftab" data-tab="kds">
            <span class="ftab-icon">&#x1F4FA;</span>
            <span class="ftab-label">KDS — Cozinha</span>
        </button>
        <button class="ftab" data-tab="pdv">
            <span class="ftab-icon">&#x1F4B3;</span>
            <span class="ftab-label">PDV — Caixa</span>
        </button>
        <button class="ftab" data-tab="flow">
            <img src="{{ asset('storage/images/flow_pilot/logo.png') }}" class="ftab-logo" alt="FlowPilot">
            <span class="ftab-label">FlowPilot</span>
        </button>
        <button class="ftab" data-tab="waiter">
            <img src="{{ asset('storage/images/waiter_pilot/logo.png') }}" class="ftab-logo" alt="WaiterPilot">
            <span class="ftab-label">WaiterPilot</span>
        </button>
    </div>

    <!-- Panels -->
    <div class="fpanel active" id="tab-pizza">
        <div class="fpanel-info">
            <div class="fpanel-tag" style="color:var(--primary);background:rgba(108,99,255,.1);border-color:rgba(108,99,255,.2)">Cardápio Digital</div>
            <h3 class="fpanel-title">Monte sua Pizza</h3>
            <p class="fpanel-desc">Seu cliente monta a pizza do jeito que quiser: escolhe o tamanho, combina sabores e adiciona bordas. Tudo visual, intuitivo e sem erro de pedido.</p>
            <ul class="fpanel-list">
                <li>Sabores ilimitados por metade</li>
                <li>Tamanhos configuráveis pelo lojista</li>
                <li>Cálculo automático de preço</li>
                <li>Fotos e descrições por produto</li>
            </ul>
        </div>
        <div class="fpanel-screens">
            <div class="fslider">
                <div class="fslider-track">
                    <img src="{{ asset('storage/images/make_pizza/1.png') }}" alt="Monte sua Pizza - Passo 1" class="fslide">
                    <img src="{{ asset('storage/images/make_pizza/2.png') }}" alt="Monte sua Pizza - Passo 2" class="fslide">
                    <img src="{{ asset('storage/images/make_pizza/3.png') }}" alt="Monte sua Pizza - Passo 3" class="fslide">
                    <img src="{{ asset('storage/images/make_pizza/4.png') }}" alt="Monte sua Pizza - Passo 4" class="fslide">
                </div>
                <button class="fslider-btn prev" aria-label="Anterior">&#8592;</button>
                <button class="fslider-btn next" aria-label="Próximo">&#8594;</button>
                <div class="fslider-dots"></div>
            </div>
        </div>
    </div>

    <div class="fpanel" id="tab-kds">
        <div class="fpanel-info">
            <div class="fpanel-tag" style="color:var(--cyan);background:rgba(0,212,255,.08);border-color:rgba(0,212,255,.2)">KDS — Kitchen Display</div>
            <h3 class="fpanel-title">Cozinha em tempo real</h3>
            <p class="fpanel-desc">Os pedidos chegam na tela da cozinha assim que são feitos. A equipe vê, prepara e marca como pronto — sem papel, sem grito e sem erro.</p>
            <ul class="fpanel-list">
                <li>Pedidos em tempo real sem refresh</li>
                <li>Status: recebido → preparando → pronto</li>
                <li>Alerta sonoro para novos pedidos</li>
                <li>Histórico e tempo de preparo</li>
            </ul>
        </div>
        <div class="fpanel-screens">
            <img src="{{ asset('storage/images/kds/1.png') }}" alt="KDS — Kitchen Display System" class="fscreen single">
        </div>
    </div>

    <div class="fpanel" id="tab-pdv">
        <div class="fpanel-info">
            <div class="fpanel-tag" style="color:var(--green);background:rgba(0,229,160,.08);border-color:rgba(0,229,160,.2)">PDV — Ponto de Venda</div>
            <h3 class="fpanel-title">Caixa completo e integrado</h3>
            <p class="fpanel-desc">PDV moderno direto no navegador. O operador de caixa lança pedidos, aplica descontos, registra pagamentos e fecha o dia — tudo integrado ao sistema.</p>
            <ul class="fpanel-list">
                <li>Lançamento rápido de produtos</li>
                <li>Múltiplas formas de pagamento</li>
                <li>Integrado ao cardápio e ao KDS</li>
                <li>Relatório de vendas por período</li>
            </ul>
        </div>
        <div class="fpanel-screens">
            <img src="{{ asset('storage/images/pdv/pdv.png') }}" alt="PDV — Ponto de Venda" class="fscreen single">
        </div>
    </div>

    <div class="fpanel" id="tab-flow">
        <div class="fpanel-info">
            <div class="fpanel-tag" style="color:var(--pink);background:rgba(255,101,132,.08);border-color:rgba(255,101,132,.2)">Gestor de Pedidos</div>
            <div class="fpanel-logo-row">
                <img src="{{ asset('storage/images/flow_pilot/logo.png') }}" class="fpanel-logo" alt="FlowPilot">
                <h3 class="fpanel-title">FlowPilot</h3>
            </div>
            <p class="fpanel-desc">Painel completo para o lojista acompanhar todos os pedidos em tempo real — do recebimento à entrega, com controle total do fluxo de operação.</p>
            <ul class="fpanel-list">
                <li>Visão geral de todos os pedidos ativos</li>
                <li>Atualização de status em tempo real</li>
                <li>Filtros por canal, status e horário</li>
                <li>Notificações automáticas ao cliente</li>
            </ul>
        </div>
        <div class="fpanel-screens">
            <div class="fslider wide">
                <div class="fslider-track">
                    @for ($i = 1; $i <= 8; $i++)
                    <img src="{{ asset('storage/images/flow_pilot/' . $i . '.png') }}" alt="FlowPilot - {{ $i }}" class="fslide">
                    @endfor
                </div>
                <button class="fslider-btn prev" aria-label="Anterior">&#8592;</button>
                <button class="fslider-btn next" aria-label="Próximo">&#8594;</button>
                <div class="fslider-dots"></div>
            </div>
        </div>
    </div>

    <div class="fpanel" id="tab-waiter">
        <div class="fpanel-info">
            <div class="fpanel-tag" style="color:#a78bfa;background:rgba(167,139,250,.08);border-color:rgba(167,139,250,.2)">App do Garçom</div>
            <div class="fpanel-logo-row">
                <img src="{{ asset('storage/images/waiter_pilot/logo.png') }}" class="fpanel-logo" alt="WaiterPilot">
                <h3 class="fpanel-title">WaiterPilot</h3>
            </div>
            <p class="fpanel-desc">App mobile para garçons anotarem pedidos direto na mesa e enviarem para a cozinha em tempo real. Menos erro, mais agilidade no salão.</p>
            <ul class="fpanel-list">
                <li>Pedidos por mesa via app Android/iOS</li>
                <li>Envio direto ao KDS da cozinha</li>
                <li>Cardápio visual para o garçom</li>
                <li>Histórico de comandas por mesa</li>
            </ul>
        </div>
        <div class="fpanel-screens">
            <div class="fslider">
                <div class="fslider-track">
                    <img src="{{ asset('storage/images/waiter_pilot/1.png') }}" alt="WaiterPilot - 1" class="fslide">
                    <img src="{{ asset('storage/images/waiter_pilot/2.png') }}" alt="WaiterPilot - 2" class="fslide">
                </div>
                <button class="fslider-btn prev" aria-label="Anterior">&#8592;</button>
                <button class="fslider-btn next" aria-label="Próximo">&#8594;</button>
                <div class="fslider-dots"></div>
            </div>
        </div>
    </div>
</section>

<style>
    #funcionalidades { background: var(--bg2); }

    .ftabs {
        display: flex; gap: .75rem; justify-content: center; flex-wrap: wrap;
        margin-top: 3rem; margin-bottom: 2.5rem;
    }
    .ftab {
        display: flex; align-items: center; gap: .6rem;
        background: var(--card); border: 1px solid var(--border);
        color: var(--muted); padding: .7rem 1.4rem; border-radius: 50px;
        font-size: .9rem; font-weight: 600; cursor: pointer;
        transition: all .2s; font-family: inherit;
    }
    .ftab:hover { border-color: rgba(108,99,255,.35); color: var(--text); }
    .ftab.active {
        background: linear-gradient(135deg, var(--primary), var(--cyan));
        border-color: transparent; color: #fff;
        box-shadow: 0 0 24px rgba(108,99,255,.35);
    }
    .ftab-icon { font-size: 1.1rem; }
    .ftab-logo { height: 22px; width: auto; object-fit: contain; display: block; }
    .fpanel-logo-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .9rem; }
    .fpanel-logo-row .fpanel-title { margin-bottom: 0; }
    .fpanel-logo { height: 28px; width: auto; object-fit: contain; }

    .fpanel {
        display: none;
        grid-template-columns: 1fr 1.6fr;
        gap: 3.5rem; align-items: center;
        animation: fadeIn .35s ease;
    }
    .fpanel.active { display: grid; }
    @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }

    .fpanel-tag {
        display: inline-block; font-size: .72rem; font-weight: 700;
        letter-spacing: .08em; text-transform: uppercase;
        padding: .28rem .8rem; border-radius: 50px; border: 1px solid;
        margin-bottom: 1rem;
    }
    .fpanel-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800;
        letter-spacing: -.02em; line-height: 1.15; margin-bottom: .9rem;
    }
    .fpanel-desc { color: var(--muted); font-size: .98rem; line-height: 1.7; margin-bottom: 1.5rem; }
    .fpanel-list {
        list-style: none; display: flex; flex-direction: column; gap: .6rem;
    }
    .fpanel-list li {
        display: flex; align-items: center; gap: .6rem;
        font-size: .92rem; color: #c0c4d8;
    }
    .fpanel-list li::before {
        content: ''; flex-shrink: 0;
        width: 18px; height: 18px; border-radius: 50%;
        background: rgba(108,99,255,.15);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 12 12'%3E%3Cpolyline points='2 6 5 9 10 3' stroke='%236c63ff' stroke-width='1.8' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: center;
    }

    /* screens */
    .fpanel-screens { position: relative; }

    .fscreen {
        border-radius: 14px;
        box-shadow: 0 20px 60px rgba(0,0,0,.5), 0 0 0 1px rgba(255,255,255,.06);
        width: 100%; display: block;
    }
    .fscreen.single { max-height: 420px; width: auto; max-width: 100%; margin: 0 auto; }

    /* slider */
    .fslider {
        position: relative; overflow: hidden;
        border-radius: 14px;
        box-shadow: 0 20px 60px rgba(0,0,0,.5), 0 0 0 1px rgba(255,255,255,.06);
        max-width: 260px;
        margin: 0 auto;
    }
    .fslider.wide {
        max-width: 100%;
    }
    .fslider-track {
        display: flex;
        transition: transform .4s cubic-bezier(.4,0,.2,1);
    }
    .fslide {
        width: 100%; flex-shrink: 0;
        display: block; border-radius: 0;
    }
    .fslider-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(7,8,13,.65); backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,.1); color: #fff;
        width: 38px; height: 38px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; cursor: pointer;
        transition: background .2s, transform .2s;
        z-index: 5;
    }
    .fslider-btn:hover { background: rgba(108,99,255,.6); transform: translateY(-50%) scale(1.08); }
    .fslider-btn.prev { left: .75rem; }
    .fslider-btn.next { right: .75rem; }
    .fslider-dots {
        position: absolute; bottom: .75rem; left: 50%; transform: translateX(-50%);
        display: flex; gap: .4rem; z-index: 5;
    }
    .fslider-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: rgba(255,255,255,.35); cursor: pointer;
        transition: background .2s, width .2s; border: none;
    }
    .fslider-dot.active {
        background: #fff; width: 20px; border-radius: 4px;
    }

    @media (max-width: 900px) {
        .fpanel { grid-template-columns: 1fr; }
        .fpanel-screens { order: -1; }
        .fscreen.single { max-height: 300px; }
    }

    /* ── LIGHTBOX ── */
    .fslide, .fscreen { cursor: zoom-in; }
    #lightbox {
        display: none; position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,.88);
        align-items: center; justify-content: center;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        animation: lbFadeIn .2s ease;
    }
    #lightbox.open { display: flex; }
    #lightbox img {
        max-width: 92vw; max-height: 90vh;
        border-radius: 10px;
        box-shadow: 0 30px 80px rgba(0,0,0,.7);
        animation: lbZoomIn .25s cubic-bezier(.4,0,.2,1);
    }
    #lightbox-close {
        position: absolute; top: 1.2rem; right: 1.4rem;
        color: #fff; font-size: 1.8rem; line-height: 1;
        cursor: pointer; opacity: .7; transition: opacity .2s;
        background: none; border: none; padding: .25rem .5rem;
    }
    #lightbox-close:hover { opacity: 1; }
    @keyframes lbFadeIn  { from { opacity: 0; } to { opacity: 1; } }
    @keyframes lbZoomIn  { from { transform: scale(.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
</style>

<!-- LIGHTBOX -->
<div id="lightbox">
    <button id="lightbox-close" aria-label="Fechar">&times;</button>
    <img id="lightbox-img" src="" alt="">
</div>

<script>
// Tabs
document.querySelectorAll('.ftab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.ftab').forEach(function(t){ t.classList.remove('active'); });
        document.querySelectorAll('.fpanel').forEach(function(p){ p.classList.remove('active'); });
        tab.classList.add('active');
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
    });
});

// Sliders
document.querySelectorAll('.fslider').forEach(function(slider) {
    var track  = slider.querySelector('.fslider-track');
    var slides = slider.querySelectorAll('.fslide');
    var dotsEl = slider.querySelector('.fslider-dots');
    var cur    = 0;

    // build dots
    slides.forEach(function(_, i) {
        var d = document.createElement('button');
        d.className = 'fslider-dot' + (i === 0 ? ' active' : '');
        d.addEventListener('click', function(){ go(i); });
        dotsEl.appendChild(d);
    });

    function go(n) {
        cur = (n + slides.length) % slides.length;
        track.style.transform = 'translateX(-' + (cur * 100) + '%)';
        slider.querySelectorAll('.fslider-dot').forEach(function(d, i){
            d.classList.toggle('active', i === cur);
        });
    }

    slider.querySelector('.prev').addEventListener('click', function(){ go(cur - 1); });
    slider.querySelector('.next').addEventListener('click', function(){ go(cur + 1); });

    // auto-advance every 3s
    setInterval(function(){ go(cur + 1); }, 3000);
});

// Lightbox
(function(){
    var lb    = document.getElementById('lightbox');
    var lbImg = document.getElementById('lightbox-img');
    var lbClose = document.getElementById('lightbox-close');

    document.querySelectorAll('.fslide, .fscreen').forEach(function(img){
        img.addEventListener('click', function(){
            lbImg.src = img.src;
            lbImg.alt = img.alt;
            lb.classList.add('open');
        });
    });

    function close(){ lb.classList.remove('open'); lbImg.src = ''; }
    lbClose.addEventListener('click', close);
    lb.addEventListener('click', function(e){ if (e.target === lb) close(); });
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape') close(); });
})();
</script>

<div class="divider"></div>

<!-- COMO FUNCIONA -->
<section id="como-funciona">
    <div class="center">
        <p class="slabel">Como Funciona</p>
        <h2 class="stitle">Do zero à receita<br>em 4 passos</h2>
        <p class="ssub">Você não precisa saber programar. Nós cuidamos da tecnologia, você cuida das vendas.</p>
    </div>
    <div class="steps-grid">
        <div class="step">
            <div class="step-num">01</div>
            <h3>Você adquire o sistema</h3>
            <p>Pague uma vez e tenha a licença do sistema completo. Nós instalamos e configuramos tudo para você.</p>
        </div>
        <div class="step">
            <div class="step-num">02</div>
            <h3>Cadastra seus lojistas</h3>
            <p>Configure uma loja para cada cliente — restaurante, pizzaria, lanchonete — com a identidade visual de cada um.</p>
        </div>
        <div class="step">
            <div class="step-num">03</div>
            <h3>Cobra o plano mensal</h3>
            <p>Defina o valor que quiser cobrar de cada lojista. A recorrência fica no seu bolso, não no nosso.</p>
        </div>
        <div class="step">
            <div class="step-num">04</div>
            <h3>Escala a carteira</h3>
            <p>Quanto mais lojistas você cadastra, maior sua renda mensal. Sem limite de clientes no sistema.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- VANTAGENS -->
<section id="vantagens">
    <div class="why-grid">
        <div>
            <p class="slabel">Por que revender com a Arcn?</p>
            <h2 class="stitle">Seu negócio,<br>nossa tecnologia</h2>
            <p class="ssub" style="margin-bottom:2.4rem;">
                Você foca em vender e atender seus clientes. Nós cuidamos de toda a infraestrutura, atualizações e suporte técnico.
            </p>
            <div class="why-items">
                <div class="why-item">
                    <div class="wicon">&#x1F4B0;</div>
                    <div>
                        <h4>Renda recorrente no seu bolso</h4>
                        <p>Você define o preço do plano para seus lojistas. A diferença entre o que cobra e o que paga fica inteiramente com você.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="wicon">&#x1F4B3;</div>
                    <div>
                        <h4>Sem limite de clientes</h4>
                        <p>Cadastre quantos lojistas quiser no mesmo sistema. Cada novo cliente = mais receita mensal sem custo adicional.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="wicon">&#x1F3F7;&#xFE0F;</div>
                    <div>
                        <h4>Produto white-label</h4>
                        <p>Cada loja é configurada com a identidade visual do lojista. Você entrega um produto profissional e personalizado.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="wicon">&#x1F6E0;&#xFE0F;</div>
                    <div>
                        <h4>Suporte técnico incluso</h4>
                        <p>Qualquer problema técnico, nós resolvemos. Você nunca fica na mão na frente do seu cliente.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="metrics">
            <div class="mcard">
                <div class="mval">&#8734;</div>
                <div class="mlbl">Lojistas cadastrados</div>
            </div>
            <div class="mcard">
                <div class="mval">24/7</div>
                <div class="mlbl">Suporte técnico</div>
            </div>
            <div class="mcard full">
                <div class="mval" style="font-size:1.55rem;">Você define o preço</div>
                <div class="mlbl">Cobre o que quiser dos seus lojistas</div>
            </div>
            <div class="mcard">
                <div class="mval">3</div>
                <div class="mlbl">Produtos inclusos</div>
            </div>
            <div class="mcard">
                <div class="mval">100%</div>
                <div class="mlbl">Sua margem</div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- PLANOS -->
<section id="planos">
    <div class="center">
        <p class="slabel">Seu investimento como revendedor</p>
        <h2 class="stitle">Quanto você paga.<br>O resto é lucro seu.</h2>
        <p class="ssub">Esses são os planos que você contrata conosco. O que cobrar dos seus lojistas é decisão sua.</p>
    </div>

    <div class="pricing-grid">

        <!-- Plano Free / Pay per Update -->
        <div class="prcard">
            <div class="prname">Gratuito</div>
            <div class="prdesc">Acesso completo ao sistema. Pague apenas quando quiser atualizar — totalmente opcional.</div>
            <div class="prprice">R$<span style="font-size:1rem;font-weight:500;color:var(--muted)"> 0</span></div>
            <div class="pronce" style="margin-bottom:.5rem">para sempre</div>
            <div style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:8px;padding:.35rem .75rem;font-size:.78rem;color:var(--muted);margin-bottom:1.2rem">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Adesão: R$ 490,00
            </div>
            <ul class="prfeat">
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Acesso total ao sistema</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Atualizações opcionais (cobradas individualmente)</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Suporte padrão</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Sem vínculo — atualize quando quiser</li>
            </ul>
            <a href="https://wa.me/5515998215892?text=Ol%C3%A1!%20Quero%20contratar%20o%20sistema%20Arcn." target="_blank" class="prbtn out">Começar Grátis</a>
        </div>

        <!-- Plano Core -->
        <div class="prcard hi">
            <div class="prname">&#x1F539; Plano Core</div>
            <div class="prdesc">Ideal para quem quer sempre a versão mais recente e suporte prioritário.</div>
            <div class="prprice"><sup>R$</sup>149<sub>/mês</sub></div>
            <div class="prins">cobrado mensalmente</div>
            <div style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:8px;padding:.35rem .75rem;font-size:.78rem;color:var(--muted);margin-bottom:.4rem">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Adesão: R$ 490,00
            </div>
            <ul class="prfeat">
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Atualizações gratuitas</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Suporte prioritário</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Acesso a sorteios exclusivos</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>25% OFF em addons</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6c63ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>20% OFF em templates</li>
            </ul>
            <a href="https://wa.me/5515998215892?text=Ol%C3%A1!%20Quero%20o%20Plano%20Core." target="_blank" class="prbtn pri">Assinar Core</a>
        </div>

        <!-- Plano Advanced -->
        <div class="prcard top">
            <div class="prname">&#x1F539; Plano Advanced</div>
            <div class="prdesc">Para quem quer o máximo: addons e templates inclusos sem custo extra.</div>
            <div class="prprice"><sup>R$</sup>210<sub>/mês</sub></div>
            <div class="prins" style="color:var(--cyan)">cobrado mensalmente</div>
            <div style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(0,212,255,.08);border:1px solid rgba(0,212,255,.2);border-radius:8px;padding:.35rem .75rem;font-size:.78rem;color:var(--cyan);margin-bottom:.4rem;font-weight:600">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Adesão isenta
            </div>
            <ul class="prfeat">
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Atualizações gratuitas</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Suporte prioritário</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Uso de cupons no sistema</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Acesso a sorteios exclusivos</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Uso gratuito de addons</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>50% OFF para comprar addons em definitivo</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Uso gratuito de templates</li>
                <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00d4ff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>40% OFF para comprar templates em definitivo</li>
            </ul>
            <a href="https://wa.me/5515998215892?text=Ol%C3%A1!%20Quero%20o%20Plano%20Advanced." target="_blank" class="prbtn cyan">Assinar Advanced</a>
        </div>

    </div>
</section>

<div class="divider"></div>

<!-- DEPOIMENTOS -->
<section id="depoimentos">
    <div class="center">
        <p class="slabel">Depoimentos</p>
        <h2 class="stitle">Quem já revende<br>com a Arcn</h2>
        <p class="ssub">Revendedores que construíram uma carteira de clientes e renda recorrente com o sistema.</p>
    </div>
    <div class="tgrid">
        <div class="tcard">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="ttext">"Comecei com 3 clientes e hoje tenho 18 lanchonetes na minha carteira. O sistema não dá trabalho — quando tem dúvida técnica, a Arcn resolve na hora."</p>
            <div class="tauthor">
                <div class="tavatar">MR</div>
                <div>
                    <div class="taname">Marcos Ribeiro</div>
                    <div class="tarole">Revendedor — São Paulo / SP</div>
                </div>
            </div>
        </div>
        <div class="tcard">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="ttext">"Minha renda com o sistema já paga minhas contas fixas todo mês. Tenho 9 restaurantes ativos e pretendo dobrar esse número ainda esse ano."</p>
            <div class="tauthor">
                <div class="tavatar">AC</div>
                <div>
                    <div class="taname">Ana Carvalho</div>
                    <div class="tarole">Revendedora — Rio de Janeiro / RJ</div>
                </div>
            </div>
        </div>
        <div class="tcard">
            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <p class="ttext">"O que me convenceu foi poder cobrar o que eu quiser dos meus clientes. Hoje cobro R$197/mês por loja e tenho 11 ativos. Faz sentido demais."</p>
            <div class="tauthor">
                <div class="tavatar">FS</div>
                <div>
                    <div class="taname">Fernando Souza</div>
                    <div class="tarole">Revendedor — Belo Horizonte / MG</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- CTA -->
<section id="contato">
    <div class="cta-box">
        <h2 class="cta-title">Pronto para ter sua própria<br><span class="g">carteira de clientes?</span></h2>
        <p class="cta-sub">Fale com a gente pelo WhatsApp e entenda como começar a revender hoje.</p>
        <div class="cta-btns">
            <a href="https://wa.me/5515998215892?text=Ol%C3%A1!%20Gostaria%20de%20saber%20mais%20sobre%20as%20solu%C3%A7%C3%B5es%20da%20Arcn." target="_blank" class="wa-btn">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.104 1.523 5.831L0 24l6.335-1.502A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.014-1.378l-.36-.214-3.731.979.996-3.648-.234-.374A9.79 9.79 0 012.182 12c0-5.424 4.41-9.836 9.836-9.836S21.818 6.576 21.818 12c0 5.424-4.412 9.818-9.818 9.818z"/></svg>
                Falar no WhatsApp
            </a>
            <a href="#planos" class="btn-ghost">Ver Planos</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="fgrid">
        <div class="fbrand">
            <a href="{{ url('/delivery') }}" class="logo" style="-webkit-text-fill-color:initial">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="32" style="display:block">
            </a>
            <p>As melhores soluções digitais para o seu negócio. Tecnologia acessível, sem complicação e sem mensalidade.</p>
        </div>
        <div class="fcol">
            <h4>Produtos</h4>
            <ul>
                <li><a href="#produtos">Multi-Cardápios</a></li>
                <li><a href="#produtos">FlowPilot</a></li>
                <li><a href="#produtos">WaiterPilot</a></li>
            </ul>
        </div>
        <div class="fcol">
            <h4>Empresa</h4>
            <ul>
                <li><a href="#vantagens">Sobre nós</a></li>
                <li><a href="#depoimentos">Depoimentos</a></li>
                <li><a href="#planos">Planos</a></li>
            </ul>
        </div>
        <div class="fcol">
            <h4>Contato</h4>
            <ul>
                <li><a href="https://wa.me/5515998215892" target="_blank">WhatsApp</a></li>
                <li><a href="https://instagram.com/arcndev" target="_blank">@arcndev</a></li>
                <li><a href="https://www.youtube.com/@arcnsolutions" target="_blank">YouTube</a></li>
            </ul>
        </div>
    </div>
    <div class="fbot">
        <p>&copy; <span id="yr"></span> Arcn Solutions · CNPJ 62.644.264/0001-35 · Todos os direitos reservados.</p>
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

/* Mockup mobile slider */
(function(){
    var track  = document.getElementById('mockTrack');
    var outer  = track && track.parentElement;
    var dots   = document.querySelectorAll('.swipe-dot');
    if (!track) return;
    var total = track.children.length, startX = 0;
    var cur = window.innerWidth <= 900 ? 1 : 0;

    function go(idx) {
        cur = Math.max(0, Math.min(total - 1, idx));
        track.style.transform = 'translateX(-' + (cur * 100) + '%)';
        dots.forEach(function(d, i){ d.classList.toggle('active', i === cur); });
    }

    go(cur);
    var startY = 0;
    outer.addEventListener('touchstart', function(e){
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    }, { passive: true });
    outer.addEventListener('touchmove', function(e){
        var dx = Math.abs(e.touches[0].clientX - startX);
        var dy = Math.abs(e.touches[0].clientY - startY);
        if (dx > dy) e.preventDefault();
    }, { passive: false });
    outer.addEventListener('touchend', function(e){
        var dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) > 40) go(cur + (dx < 0 ? 1 : -1));
    }, { passive: true });
})();
/* URL terminando em "#" (ex.: /delivery#): remove o fragmento vazio e evita scroll/compositing estranhos com nav fixa */
(function () {
    var h = window.location.href;
    if (h.endsWith('#')) {
        history.replaceState(null, '', h.slice(0, -1));
    }
})();
</script>
<style>
    .cursor {
        display: inline-block;
        color: var(--primary);
        font-weight: 300;
        animation: blink-cursor .7s step-end infinite;
        margin-left: 2px;
    }
    @keyframes blink-cursor { 0%,100%{opacity:1} 50%{opacity:0} }
</style>
<script>
(function() {
    const words = [
        'restaurante',
        'lanchonete',
        'pizzaria',
        'hamburgueria',
        'cafeteria',
        'bar',
        'food truck',
        'doceria',
        'açaíteria',
        'delivery',
    ];

    const el = document.getElementById('typewriter');
    let wi = 0, ci = 0, deleting = false;

    const TYPE_SPEED   = 80;
    const DELETE_SPEED = 45;
    const PAUSE_END    = 1800;
    const PAUSE_START  = 300;

    function tick() {
        const word = words[wi];

        if (!deleting) {
            el.textContent = word.slice(0, ++ci);
            if (ci === word.length) {
                deleting = true;
                setTimeout(tick, PAUSE_END);
                return;
            }
        } else {
            el.textContent = word.slice(0, --ci);
            if (ci === 0) {
                deleting = false;
                wi = (wi + 1) % words.length;
                setTimeout(tick, PAUSE_START);
                return;
            }
        }

        setTimeout(tick, deleting ? DELETE_SPEED : TYPE_SPEED);
    }

    tick();
})();
</script>
<script>
(function () {
    var root = document.getElementById('site-nav');
    if (!root) return;
    var btn = document.getElementById('nav-toggle');
    var panel = document.getElementById('primary-nav');
    if (!btn || !panel) return;
    function setOpen(open) {
        root.classList.toggle('nav-open', open);
        document.documentElement.classList.toggle('nav-menu-open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        btn.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
    }
    btn.addEventListener('click', function () {
        setOpen(!root.classList.contains('nav-open'));
    });
    panel.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () { setOpen(false); });
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setOpen(false);
    });
})();
</script>
</body>
</html>
