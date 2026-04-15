<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arcn Solutions — Software que impulsiona negócios</title>
    <meta name="description" content="Arcn Solutions cria produtos de software modernos para negócios que querem crescer. Delivery, gestão, APIs e automação.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:     #07080d;
            --bg2:    #0d0f1a;
            --card:   #111320;
            --border: rgba(255,255,255,.07);
            --p:      #6c63ff;
            --cyan:   #00d4ff;
            --pink:   #ff6584;
            --green:  #00e5a0;
            --orange: #ff9f43;
            --text:   #e8eaf6;
            --muted:  #7b80a0;
            --r:      18px;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            overscroll-behavior-x: none;
        }
        html.nav-menu-open,
        html.nav-menu-open body {
            overflow: hidden;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            overscroll-behavior-x: none;
        }

        /* Tudo que não for fixed fica aqui — corta overflow lateral sem brigar com o header */
        .page-wrap {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            position: relative;
            min-height: 100%;
        }

        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            opacity: .022;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* ── NAV (header sem backdrop-filter/transform no wrapper — senão o painel fixed fica “preso” à faixa) ── */
        .site-header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.65rem;
            padding: 1.2rem max(1rem, env(safe-area-inset-left, 0px)) 1.2rem max(1rem, env(safe-area-inset-right, 0px));
            background: rgba(7,8,13,.94);
            border-bottom: 1px solid var(--border);
            box-sizing: border-box;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }
        .site-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.65rem;
            flex: 0 1 auto;
            min-width: 0;
        }
        .logo {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.5rem; font-weight: 800;
            background: linear-gradient(135deg, var(--p), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            letter-spacing: -.02em; text-decoration: none;
            flex: 1 1 auto;
            min-width: 0;
            display: flex;
            align-items: center;
        }
        .logo img {
            max-width: min(148px, calc(100vw - 4.5rem));
            height: auto;
            max-height: 32px;
            width: auto;
            object-fit: contain;
            display: block;
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
            gap: clamp(0.75rem, 2vw, 2rem);
            flex: 1;
            justify-content: flex-end;
            min-width: 0;
        }
        .nav-links {
            display: flex;
            gap: clamp(0.75rem, 2vw, 2rem);
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
            min-width: 0;
        }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: .9rem; font-weight: 500; transition: color .2s; }
        .nav-links a:hover { color: #fff; }
        .btn-nav {
            background: linear-gradient(135deg, var(--p), var(--cyan));
            color: #fff; text-decoration: none; padding: .6rem 1.4rem;
            border-radius: 50px; font-size: .875rem; font-weight: 600;
            transition: opacity .2s, transform .2s;
            flex-shrink: 0;
            white-space: nowrap;
        }
        .btn-nav:hover { opacity: .85; transform: translateY(-1px); }

        /* ── ORB (blur vaza da caixa — orbs ficam num layer com overflow:hidden) ── */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(72px); pointer-events: none;
            animation: float 9s ease-in-out infinite;
        }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-28px)} }

        .hero-decor {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
            contain: paint;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 9rem 6% 6rem;
            position: relative; z-index: 1;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .hero-decor .o1 { width:500px;height:500px;background:rgba(108,99,255,.13);top:0;left:-10%; }
        .hero-decor .o2 { width:350px;height:350px;background:rgba(0,212,255,.09);bottom:5%;right:-8%;animation-delay:-4s; }
        .hero-decor .o3 { width:280px;height:280px;background:rgba(0,229,160,.07);top:60%;left:35%;animation-delay:-2s; }

        .badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(108,99,255,.1); border: 1px solid rgba(108,99,255,.25);
            padding: .38rem 1rem; border-radius: 50px;
            font-size: .78rem; font-weight: 600; color: #a89fff;
            letter-spacing: .07em; text-transform: uppercase;
            margin-bottom: 1.5rem; position: relative; z-index: 1;
        }
        .bdot { width:6px;height:6px;border-radius:50%;background:var(--p);display:block;animation:blink 2s infinite; }
        @keyframes blink { 0%,100%{opacity:1}50%{opacity:.35} }

        h1 {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(2.8rem, 7vw, 5.6rem);
            font-weight: 800; line-height: 1.07;
            letter-spacing: -.03em;
            position: relative; z-index: 1; margin-bottom: 1.4rem;
        }
        .g {
            background: linear-gradient(135deg, var(--p) 0%, var(--cyan) 55%, #b388ff 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .hero-sub {
            font-size: clamp(.95rem, 2vw, 1.18rem);
            color: var(--muted); max-width: 620px; margin: 0 auto 2.5rem;
            position: relative; z-index: 1;
        }

        .hero-cta {
            display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
            position: relative; z-index: 1; margin-bottom: 4.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--p), var(--cyan));
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

        /* Products mini-preview strip */
        .product-strip {
            display: flex; gap: 1rem; justify-content: center; flex-wrap: nowrap;
            position: relative; z-index: 1;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            padding: 0 0.25rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-gutter: stable;
        }
        .strip-item {
            display: flex; align-items: center; gap: .55rem;
            flex-shrink: 0;
            background: var(--card); border: 1px solid var(--border);
            border-radius: 50px; padding: .5rem 1.1rem;
            font-size: .82rem; font-weight: 600; color: #c0c4d8;
            transition: border-color .2s;
        }
        .strip-item:hover { border-color: rgba(108,99,255,.35); }
        .strip-dot {
            width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0;
        }

        /* ── SECTION COMMON ── */
        section {
            padding: 6rem 6%;
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .slabel { font-size: .75rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--p); margin-bottom: .7rem; }
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

        /* ── PRODUCTS GRID ── */
        #produtos { background: var(--bg); }

        .pgrid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem; margin-top: 3.5rem;
            min-width: 0;
        }

        .pcard {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 2.2rem;
            position: relative; overflow: hidden;
            transition: transform .3s, border-color .3s, box-shadow .3s;
            text-decoration: none; color: inherit;
            display: flex; flex-direction: column; gap: 1.2rem;
            min-width: 0;
        }
        .pcard:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,.4);
        }
        .pcard.span-full { grid-column: 1 / -1; flex-direction: row; align-items: flex-start; gap: 2.5rem; }

        /* color accents per product */
        .pcard.c-p  { border-color: rgba(108,99,255,.2); }
        .pcard.c-p:hover  { border-color: rgba(108,99,255,.5); box-shadow: 0 20px 60px rgba(0,0,0,.4), 0 0 40px rgba(108,99,255,.1); }
        .pcard.c-cy { border-color: rgba(0,212,255,.15); }
        .pcard.c-cy:hover { border-color: rgba(0,212,255,.45); box-shadow: 0 20px 60px rgba(0,0,0,.4), 0 0 40px rgba(0,212,255,.08); }
        .pcard.c-gr { border-color: rgba(0,229,160,.15); }
        .pcard.c-gr:hover { border-color: rgba(0,229,160,.45); box-shadow: 0 20px 60px rgba(0,0,0,.4), 0 0 40px rgba(0,229,160,.08); }
        .pcard.c-or { border-color: rgba(255,159,67,.15); }
        .pcard.c-or:hover { border-color: rgba(255,159,67,.45); box-shadow: 0 20px 60px rgba(0,0,0,.4), 0 0 40px rgba(255,159,67,.08); }
        .pcard.c-pk { border-color: rgba(255,101,132,.18); }
        .pcard.c-pk:hover { border-color: rgba(255,101,132,.45); box-shadow: 0 20px 60px rgba(0,0,0,.4), 0 0 40px rgba(255,101,132,.1); }

        .pcard::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        }
        .pcard.c-p::before  { background: linear-gradient(90deg, var(--p), var(--cyan)); }
        .pcard.c-cy::before { background: linear-gradient(90deg, var(--cyan), #00ffcc); }
        .pcard.c-gr::before { background: linear-gradient(90deg, var(--green), #00d4ff); }
        .pcard.c-or::before { background: linear-gradient(90deg, var(--orange), var(--pink)); }
        .pcard.c-pk::before { background: linear-gradient(90deg, #ea1d2c, var(--pink)); }

        .picon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; flex-shrink: 0;
        }
        .pi-p  { background: rgba(108,99,255,.14); }
        .pi-cy { background: rgba(0,212,255,.11); }
        .pi-gr { background: rgba(0,229,160,.11); }
        .pi-or { background: rgba(255,159,67,.11); }
        .pi-pk { background: rgba(255,101,132,.1); }

        .pcard-body { flex: 1; display: flex; flex-direction: column; }

        .pname {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.4rem; font-weight: 800; letter-spacing: -.02em; margin-bottom: .3rem;
        }
        .pname-row {
            display: flex; align-items: center; gap: .55rem; flex-wrap: wrap; margin-bottom: .3rem;
        }
        .pname-row .pname { margin-bottom: 0; }
        .pdomain {
            font-size: .7rem; font-weight: 600;
            padding: .18rem .55rem; border-radius: 50px;
            line-height: 1.3;
        }
        .pcat { font-size: .78rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; margin-bottom: .75rem; }
        .pcat.cp  { color: var(--p); }
        .pcat.ccy { color: var(--cyan); }
        .pcat.cgr { color: var(--green); }
        .pcat.cor { color: var(--orange); }
        .pcat.cpk { color: var(--pink); }

        .pdesc { color: var(--muted); font-size: .92rem; line-height: 1.65; margin-bottom: 1.2rem; flex: 1; }

        .ptags { display: flex; flex-wrap: wrap; gap: .45rem; margin-bottom: 1.4rem; }
        .ptag {
            font-size: .72rem; font-weight: 600; padding: .25rem .65rem;
            border-radius: 50px; border: 1px solid var(--border);
            color: var(--muted);
        }

        .plink {
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: .85rem; font-weight: 700; text-decoration: none;
            transition: gap .2s;
            margin-top: auto; align-self: flex-start;
        }
        .plink.lp  { color: var(--p); }
        .plink.lcy { color: var(--cyan); }
        .plink.lgr { color: var(--green); }
        .plink.lor { color: var(--orange); }
        .plink.lpk { color: var(--pink); }
        .plink:hover { gap: .7rem; }

        /* ── WHY ── */
        #sobre { background: var(--bg2); }
        .why-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 4rem; align-items: center; margin-top: 3rem;
            min-width: 0;
        }
        .why-items { display: flex; flex-direction: column; gap: 1.7rem; }
        .wi { display: flex; gap: .95rem; }
        .wicon {
            flex-shrink: 0; width: 42px; height: 42px; border-radius: 11px;
            background: rgba(108,99,255,.11); border: 1px solid rgba(108,99,255,.18);
            display: flex; align-items: center; justify-content: center; font-size: 1.15rem;
        }
        .wi h4 { font-weight: 700; margin-bottom: .22rem; }
        .wi p  { color: var(--muted); font-size: .88rem; }

        .nums-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: .9rem;
            min-width: 0;
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--r); padding: 2rem;
        }
        .ncard {
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 11px; padding: 1.2rem; text-align: center;
        }
        .ncard.full { grid-column: 1/-1; }
        .nval {
            font-family: 'Bricolage Grotesque', sans-serif; font-size: 2rem; font-weight: 800;
            background: linear-gradient(135deg, var(--p), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .nlbl { font-size: .75rem; color: var(--muted); margin-top: .2rem; font-weight: 500; text-transform: uppercase; letter-spacing: .06em; }

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
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .fgrid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1fr);
            gap: 3rem; margin-bottom: 2.5rem;
            min-width: 0;
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

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .site-header {
                gap: 0.5rem;
                padding: max(1rem, env(safe-area-inset-top, 0px)) max(0.75rem, env(safe-area-inset-right, 0px)) 1rem max(0.75rem, env(safe-area-inset-left, 0px));
            }
            .site-header-bar {
                flex: 1 1 auto;
                min-width: 0;
                width: 100%;
                max-width: 100%;
            }
            .logo img {
                max-width: min(132px, calc(100vw - 3.75rem));
            }
            .site-header .logo,
            .site-header .nav-toggle {
                position: relative;
                z-index: 1102;
            }
            .nav-toggle { display: inline-flex; }
            /* Painel fora do fluxo: só a barra (logo + toggle) entra no flex — evita cortar o hambúrguer */
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
                flex: none !important;
                margin: 0;
                display: flex;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                gap: 0;
                padding: calc(4.75rem + env(safe-area-inset-top, 0px)) max(6%, env(safe-area-inset-right, 0px)) 2rem max(6%, env(safe-area-inset-left, 0px));
                background: rgba(7,8,13,.98);
                border: none;
                border-bottom: none;
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
            .nav-panel .nav-links li {
                border-bottom: 1px solid var(--border);
            }
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
            .pgrid { grid-template-columns: 1fr 1fr; }
            .pcard.span-full { flex-direction: column; }
            .why-grid { grid-template-columns: 1fr; }
            .fgrid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .site-header { padding: 1rem max(5%, env(safe-area-inset-left, 0px)) 1rem max(5%, env(safe-area-inset-right, 0px)); }
            section { padding: 4rem 5%; }
            .hero { padding: 7rem 5% 4rem; }
            .pgrid { grid-template-columns: 1fr; }
            .cta-box { padding: 2.5rem 1.5rem; }
            .fgrid { grid-template-columns: 1fr; gap: 2rem; }
            .hero-decor .orb { display: none; }
        }
    </style>
</head>
<body>

<header class="site-header" id="site-nav">
    <div class="site-header-bar">
    <a href="/" class="logo" style="-webkit-text-fill-color:initial">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="32" style="display:block">
    </a>
    <button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="Abrir menu">
        <span class="nav-toggle-lines" aria-hidden="true"><span></span><span></span><span></span></span>
    </button>
    </div>
    <div class="nav-panel" id="primary-nav">
        <ul class="nav-links">
            <li><a href="#produtos">Produtos</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#contato">Contato</a></li>
            <li><a href="{{ url('/status') }}">Status</a></li>
        </ul>
        <a href="https://wa.me/5515998215892" target="_blank" rel="noopener noreferrer" class="btn-nav">Fale Conosco</a>
    </div>
</header>

<div class="page-wrap">

<!-- HERO -->
<section class="hero">
    <div class="hero-decor" aria-hidden="true">
        <div class="orb o1"></div>
        <div class="orb o2"></div>
        <div class="orb o3"></div>
    </div>

    <div class="badge">
        <span class="bdot"></span>
        Soluções de software para negócios
    </div>

    <h1>
        Software moderno para<br>
        <span class="g">negócios que crescem</span>
    </h1>

    <p class="hero-sub">
        Desenvolvemos produtos digitais prontos para uso — do cardápio online ao app de entregas,
        APIs e automação via WhatsApp. Tecnologia que trabalha enquanto você foca no seu negócio.
    </p>

    <div class="hero-cta">
        <a href="#produtos" class="btn-primary">
            Conhecer Produtos
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="https://wa.me/5515998215892" target="_blank" class="btn-ghost">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a3.178 3.178 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479s1.065 2.875 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.104 1.523 5.831L0 24l6.335-1.502A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.014-1.378l-.36-.214-3.731.979.996-3.648-.234-.374A9.79 9.79 0 012.182 12c0-5.424 4.41-9.836 9.836-9.836S21.818 6.576 21.818 12c0 5.424-4.412 9.818-9.818 9.818z"/></svg>
            Falar no WhatsApp
        </a>
    </div>

    <!-- product strip -->
    <div class="product-strip">
        <div class="strip-item">
            <span class="strip-dot" style="background:var(--p)"></span>
            Multi-Cardápios
        </div>
        <div class="strip-item">
            <span class="strip-dot" style="background:var(--cyan)"></span>
            Fluxy
        </div>
        <div class="strip-item">
            <span class="strip-dot" style="background:var(--green)"></span>
            xBarcly
        </div>
        <div class="strip-item">
            <span class="strip-dot" style="background:var(--orange)"></span>
            WhatsApp API
        </div>
        <div class="strip-item">
            <span class="strip-dot" style="background:var(--pink)"></span>
            iHub
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- PRODUTOS -->
<section id="produtos">
    <div class="center">
        <p class="slabel">Nossos Produtos</p>
        <h2 class="stitle">Um ecossistema de soluções</h2>
        <p class="ssub">Cada produto foi construído para resolver problemas reais. Prontos para usar, fáceis de integrar.</p>
    </div>

    <div class="pgrid">

        <!-- Sistema de Delivery — destaque principal (largura total) -->
        <a href="/delivery" class="pcard c-p span-full">
            <div class="picon pi-p" style="margin-top:.2rem">&#x1F37D;&#xFE0F;</div>
            <div class="pcard-body">
                <div class="pname">Sistema de Delivery</div>
                <div class="pcat cp">Restaurantes & Food Service</div>
                <p class="pdesc">
                    Ecossistema completo para restaurantes: cardápio digital com pedidos online
                    (<strong style="color:var(--text)">Multi-Cardápios</strong>), gestor de pedidos em tempo real para a cozinha
                    (<strong style="color:var(--text)">FlowPilot</strong>) e app mobile do garçom para comandas digitais
                    (<strong style="color:var(--text)">WaiterPilot</strong>). Tudo integrado, sem mensalidade.
                </p>
                <div class="ptags">
                    <span class="ptag">Cardápio Digital</span>
                    <span class="ptag">Pedidos Online</span>
                    <span class="ptag">Gestor de Cozinha</span>
                    <span class="ptag">App do Garçom</span>
                    <span class="ptag">PWA</span>
                    <span class="ptag">Pix & Marketplace</span>
                    <span class="ptag">Sem mensalidade</span>
                </div>
                <span class="plink lp">
                    Ver detalhes
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

        <!-- Fluxy -->
        <a href="https://fluxy.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pcard c-cy">
            <div class="picon pi-cy">&#x1F6F5;</div>
            <div class="pcard-body">
                <div class="pname-row">
                    <div class="pname">Fluxy</div>
                    <span class="pdomain" style="color:var(--cyan);background:rgba(0,212,255,.08);border:1px solid rgba(0,212,255,.2)">fluxy.arcn.com.br</span>
                </div>
                <div class="pcat ccy">App de Entregas</div>
                <p class="pdesc">
                    Conecta empresas a entregadores de confiança. Solicite entregas, rastreie em tempo real e gerencie toda a logística.
                </p>
                <div class="ptags">
                    <span class="ptag">Rastreamento</span>
                    <span class="ptag">Entregadores</span>
                    <span class="ptag">Automação</span>
                    <span class="ptag">Painel</span>
                </div>
                <span class="plink lcy">
                    Acessar
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

        <!-- xBarcly -->
        <a href="https://xbarcly.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pcard c-gr">
            <div class="picon pi-gr">&#x1F4F7;</div>
            <div class="pcard-body">
                <div class="pname-row">
                    <div class="pname">xBarcly</div>
                    <span class="pdomain" style="color:var(--green);background:rgba(0,229,160,.08);border:1px solid rgba(0,229,160,.2)">xbarcly.arcn.com.br</span>
                </div>
                <div class="pcat cgr">API de Código de Barras</div>
                <p class="pdesc">
                    Consulta EAN para qualquer sistema. Informações completas de produtos pelo código de barras — ideal para PDVs, estoque e e-commerce.
                </p>
                <div class="ptags">
                    <span class="ptag">EAN-13 & EAN-8</span>
                    <span class="ptag">REST API</span>
                    <span class="ptag">Fácil integração</span>
                </div>
                <span class="plink lgr">
                    Acessar
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

        <!-- iHub -->
        <a href="https://ihub.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pcard c-pk">
            <div class="picon pi-pk" style="padding:.45rem">
                <img src="{{ asset('storage/images/ihub/logo.png') }}" alt="iHub" width="40" height="40" style="width:40px;height:40px;object-fit:contain;display:block" decoding="async">
            </div>
            <div class="pcard-body">
                <div class="pname-row">
                    <div class="pname">iHub</div>
                    <span class="pdomain" style="color:var(--pink);background:rgba(255,101,132,.08);border:1px solid rgba(255,101,132,.22)">ihub.arcn.com.br</span>
                </div>
                <div class="pcat cpk">Integração iFood</div>
                <p class="pdesc">
                    Conecte seu sistema ao iFood sem desenvolver a API. Pedidos e eventos via webhook, homologado pelo iFood, com retry automático.
                </p>
                <div class="ptags">
                    <span class="ptag">Homologado iFood</span>
                    <span class="ptag">Webhook</span>
                    <span class="ptag">Eventos real-time</span>
                    <span class="ptag">R$ 49/mês</span>
                </div>
                <span class="plink lpk">
                    Conhecer
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

        <!-- WhatsApp API — em breve (largura total) -->
        <div class="pcard c-or span-full">
            <div class="picon pi-or" style="margin-top:.2rem">&#x1F4AC;</div>
            <div class="pcard-body">
                <div class="pname">WhatsApp API</div>
                <div class="pcat cor">Automação & Atendimento</div>
                <p class="pdesc">
                    Automação completa via WhatsApp: saudações automáticas, chatbot inteligente, chat com IA integrada e multi-atendimento. Atenda mais clientes com menos esforço.
                </p>
                <div class="ptags">
                    <span class="ptag">Mensagens automáticas</span>
                    <span class="ptag">Chatbot</span>
                    <span class="ptag">Chat com IA</span>
                    <span class="ptag">Multi-atendimento</span>
                    <span class="ptag">Em breve</span>
                </div>
                <span class="plink lor">
                    Entrar na lista de espera
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>

    </div>
</section>

<div class="divider"></div>

<!-- SOBRE -->
<section id="sobre">
    <div class="why-grid">
        <div>
            <p class="slabel">Por que Arcn?</p>
            <h2 class="stitle">Software sério,<br>sem enrolação</h2>
            <p class="ssub" style="margin-bottom:2.4rem">
                Somos uma empresa de software focada em entregar produtos que funcionam de verdade —
                com suporte humano, tecnologia moderna e preço justo.
            </p>
            <div class="why-items">
                <div class="wi">
                    <div class="wicon">&#x1F4E6;</div>
                    <div>
                        <h4>Produtos prontos para usar</h4>
                        <p>Sem desenvolvimento customizado caro. Nossos sistemas são maduros, testados e instalados rapidamente.</p>
                    </div>
                </div>
                <div class="wi">
                    <div class="wicon">&#x1F527;</div>
                    <div>
                        <h4>Suporte humano 24/7</h4>
                        <p>Equipe real disponível a qualquer hora. Sem bot de suporte, sem ticket que demora dias.</p>
                    </div>
                </div>
                <div class="wi">
                    <div class="wicon">&#x1F4B0;</div>
                    <div>
                        <h4>Preço justo e transparente</h4>
                        <p>Sem surpresas na fatura. Planos claros, sem taxa oculta e opção de pagamento único com licença vitalícia.</p>
                    </div>
                </div>
                <div class="wi">
                    <div class="wicon">&#x1F680;</div>
                    <div>
                        <h4>Ecossistema em expansão</h4>
                        <p>Novos produtos e integrações chegando. Uma empresa que cresce junto com seus clientes.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="nums-grid">
            <div class="ncard">
                <div class="nval">5</div>
                <div class="nlbl">Produtos</div>
            </div>
            <div class="ncard">
                <div class="nval">24/7</div>
                <div class="nlbl">Suporte</div>
            </div>
            <div class="ncard full">
                <div class="nval" style="font-size:1.5rem">R$0 mensalidade</div>
                <div class="nlbl">no plano base — pague só o que usar</div>
            </div>
            <div class="ncard">
                <div class="nval">&#8734;</div>
                <div class="nlbl">Licença</div>
            </div>
            <div class="ncard">
                <div class="nval">PWA</div>
                <div class="nlbl">Tecnologia</div>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<!-- CTA -->
<section id="contato">
    <div class="cta-box">
        <h2 class="cta-title">Qual solução faz sentido<br><span class="g">para o seu negócio?</span></h2>
        <p class="cta-sub">Fale com a gente e descubra o produto certo para o seu caso.</p>
        <div class="cta-btns">
            <a href="https://wa.me/5515998215892?text=Ol%C3%A1!%20Gostaria%20de%20conhecer%20as%20solu%C3%A7%C3%B5es%20da%20Arcn." target="_blank" class="wa-btn">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a3.178 3.178 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479s1.065 2.875 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.104 1.523 5.831L0 24l6.335-1.502A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.014-1.378l-.36-.214-3.731.979.996-3.648-.234-.374A9.79 9.79 0 012.182 12c0-5.424 4.41-9.836 9.836-9.836S21.818 6.576 21.818 12c0 5.424-4.412 9.818-9.818 9.818z"/></svg>
                Falar no WhatsApp
            </a>
            <a href="#produtos" class="btn-ghost">Explorar Produtos</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="fgrid">
        <div class="fbrand">
            <a href="/" class="logo" style="-webkit-text-fill-color:initial">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Arcn Solutions" height="28" style="display:block">
            </a>
            <p>Software moderno para negócios que crescem. Produtos prontos, suporte real e tecnologia que funciona.</p>
        </div>
        <div class="fcol">
            <h4>Produtos</h4>
            <ul>
                <li><a href="/delivery">Sistema de Delivery</a></li>
                <li><a href="https://fluxy.arcn.com.br" target="_blank">Fluxy</a></li>
                <li><a href="https://xbarcly.arcn.com.br" target="_blank">xBarcly</a></li>
                <li><a href="https://ihub.arcn.com.br" target="_blank" rel="noopener noreferrer">iHub</a></li>
                <li><a href="#produtos">WhatsApp API</a></li>
            </ul>
        </div>
        <div class="fcol">
            <h4>Empresa</h4>
            <ul>
                <li><a href="#sobre">Sobre nós</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="{{ url('/status') }}">Status dos serviços</a></li>
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

</div><!-- /.page-wrap -->

<script>document.getElementById('yr').textContent = new Date().getFullYear();</script>
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
