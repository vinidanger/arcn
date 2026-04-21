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
            /* WhatsApp brand (WCore) */
            --wa:      #25d366;
            --wa-teal: #128c7e;
            --text:   #e8eaf6;
            --muted:  #7b80a0;
            --r:      18px;
            /* Cards produtos — superfície & ritmo */
            --card-radius: 22px;
            --card-edge: rgba(255,255,255,.055);
            --card-inner-top: rgba(255,255,255,.045);
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
            background: linear-gradient(165deg, rgba(255,255,255,.06) 0%, rgba(14,16,24,.92) 100%);
            border: 1px solid var(--card-edge);
            border-radius: 100px;
            padding: .48rem 1.15rem;
            font-size: .78rem; font-weight: 600; letter-spacing: .02em;
            color: #aeb4d4;
            box-shadow: 0 1px 0 rgba(255,255,255,.04) inset;
            transition: border-color .35s, transform .35s, box-shadow .35s;
        }
        .strip-item:hover {
            border-color: rgba(108,99,255,.28);
            box-shadow: 0 1px 0 rgba(255,255,255,.06) inset, 0 12px 32px -18px rgba(108,99,255,.2);
            transform: translateY(-1px);
        }
        .strip-dot {
            width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(255,255,255,.06);
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

        /* ── PRODUTOS — showcase (split + tiles + área de imagem) ── */
        #produtos { background: var(--bg); }

        .product-showcase {
            margin-top: 3rem;
            max-width: 1180px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            min-width: 0;
        }

        .product-tiles {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
            min-width: 0;
        }

        .pblock {
            position: relative;
            display: block;
            overflow: hidden;
            border-radius: var(--card-radius);
            border: 1px solid var(--card-edge);
            background:
                linear-gradient(155deg, var(--card-inner-top) 0%, transparent 46%),
                linear-gradient(180deg, #16182a 0%, #0c0e16 100%);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.45) inset,
                0 1px 0 rgba(255,255,255,.04) inset,
                0 28px 56px -32px rgba(0,0,0,.75);
            text-decoration: none;
            color: inherit;
            isolation: isolate;
            transition: transform .45s cubic-bezier(.22, 1, .36, 1), border-color .4s, box-shadow .45s;
        }
        .pblock:hover {
            transform: translateY(-3px);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.4) inset,
                0 1px 0 rgba(255,255,255,.06) inset,
                0 36px 72px -36px rgba(0,0,0,.85);
        }

        .pblock::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(ellipse 90% 55% at 100% -8%, rgba(255,255,255,.06), transparent 52%);
            pointer-events: none;
            z-index: 0;
            opacity: .65;
        }

        /* Destaque em duas colunas: texto | imagem */
        .pblock--split {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.08fr);
            gap: clamp(1.5rem, 3.5vw, 2.75rem);
            align-items: center;
            padding: clamp(1.75rem, 3vw, 2.6rem) clamp(1.75rem, 3vw, 2.75rem);
        }
        /* Desktop: imagem à esquerda, texto à direita */
        .pblock--split-reverse .pblock__visual { order: 1; }
        .pblock--split-reverse .pblock__body { order: 2; }

        /* Três colunas: só conteúdo (sem área de foto) */
        .pblock--compact {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 1.45rem 1.4rem 1.5rem;
        }
        .pblock--compact .pblock__body {
            padding: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .pblock__visual {
            position: relative;
            z-index: 1;
            min-width: 0;
        }

        /* Moldura tipo “tela” + slot para screenshot */
        .pblock__frame {
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(165deg, rgba(255,255,255,.06) 0%, rgba(8,10,18,.94) 100%);
            border: 1px solid rgba(255,255,255,.08);
            box-shadow:
                0 1px 0 rgba(255,255,255,.06) inset,
                0 20px 50px -28px rgba(0,0,0,.85);
            transition: transform .5s cubic-bezier(.22, 1, .36, 1), box-shadow .45s;
        }
        .pblock:hover .pblock__frame {
            transform: translateY(-2px) scale(1.01);
            box-shadow:
                0 1px 0 rgba(255,255,255,.08) inset,
                0 28px 60px -30px rgba(0,0,0,.9);
        }
        .pblock--split .pblock__frame { aspect-ratio: 5 / 3; min-height: 200px; }

        /* Galeria — carrossel de slides (setas + indicadores) */
        .pblock__slider {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .pblock__slider-viewport {
            --slides: 1;
            --index: 0;
            overflow: hidden;
            position: relative;
            width: 100%;
            flex: 1;
            min-height: 160px;
            background: rgba(0,0,0,.22);
            isolation: isolate;
            contain: paint;
            border-radius: 0 0 12px 12px;
        }
        @supports (overflow: clip) {
            .pblock__slider-viewport { overflow: clip; }
        }
        .pblock__slider-track {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: minmax(0, calc(100% / var(--slides)));
            height: 100%;
            width: calc(var(--slides) * 100%);
            min-width: 0;
            transform: translate3d(calc(var(--index) * -100% / var(--slides)), 0, 0);
            transition: transform 0.48s cubic-bezier(.22, 1, .36, 1);
            will-change: transform;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
        .pblock__slider-slide {
            margin: 0;
            padding: 0;
            min-width: 0;
            min-height: 160px;
            height: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }
        .pblock__slider-slide img {
            width: 100%;
            height: 100%;
            min-height: 160px;
            max-width: 100%;
            object-fit: cover;
            object-position: top center;
            display: block;
            cursor: zoom-in;
        }
        .pblock__slider-nav {
            position: absolute;
            inset: 0;
            z-index: 4;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 .35rem;
        }
        .pblock__slider-btn {
            pointer-events: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(10,12,22,.72);
            color: rgba(255,255,255,.88);
            cursor: pointer;
            transition: background .2s, border-color .2s, opacity .2s, transform .2s;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .pblock__slider-btn:hover:not(:disabled) {
            background: rgba(108,99,255,.25);
            border-color: rgba(108,99,255,.4);
            transform: scale(1.04);
        }
        .pblock__slider-btn:disabled {
            opacity: .28;
            cursor: default;
        }
        .pblock__slider-btn svg {
            width: 18px;
            height: 18px;
            display: block;
        }
        .pblock__slider-dots {
            position: absolute;
            bottom: .65rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: .4rem;
            pointer-events: auto;
            padding: .35rem .55rem;
            border-radius: 100px;
            background: rgba(0,0,0,.4);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(6px);
        }
        .pblock__slider-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            padding: 0;
            border: none;
            background: rgba(255,255,255,.28);
            cursor: pointer;
            transition: background .2s, transform .2s;
        }
        .pblock__slider-dot.is-active {
            background: rgba(255,255,255,.92);
            transform: scale(1.15);
        }
        .pblock--hue-p .pblock__slider-btn:hover:not(:disabled) {
            background: rgba(108,99,255,.28);
            border-color: rgba(108,99,255,.42);
        }
        .pblock--hue-wa .pblock__slider-btn:hover:not(:disabled) {
            background: rgba(37,211,102,.22);
            border-color: rgba(37,211,102,.38);
        }
        .pblock__shot--gallery {
            position: relative;
            padding: 0;
            background: rgba(0,0,0,.28);
            overflow: hidden;
        }

        /* Lightbox — ampliação ao clicar nas imagens do carrossel */
        .img-lightbox {
            position: fixed;
            inset: 0;
            z-index: 2500;
            display: grid;
            grid-template: 1fr / 1fr;
            place-items: center;
            padding: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-right)) max(1rem, env(safe-area-inset-bottom)) max(1rem, env(safe-area-inset-left));
            box-sizing: border-box;
        }
        .img-lightbox[hidden] {
            display: none !important;
        }
        .img-lightbox__backdrop {
            grid-area: 1 / 1;
            align-self: stretch;
            justify-self: stretch;
            width: 100%;
            height: 100%;
            border: none;
            padding: 0;
            margin: 0;
            background: rgba(4, 5, 10, .88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            cursor: zoom-out;
        }
        .img-lightbox__stack {
            grid-area: 1 / 1;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: min(96vw, 1680px);
            max-height: min(92vh, 1200px);
            margin: 0 auto;
            padding-top: 2.75rem;
            box-sizing: border-box;
            pointer-events: none;
        }
        .img-lightbox__close {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(15,17,28,.92);
            color: rgba(255,255,255,.9);
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s, border-color .2s;
            pointer-events: auto;
        }
        .img-lightbox__close:hover {
            background: rgba(108,99,255,.25);
            border-color: rgba(108,99,255,.4);
        }
        .img-lightbox__figure {
            margin: 0;
            max-width: 100%;
            max-height: min(88vh, 1100px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .img-lightbox__figure img {
            max-width: 100%;
            max-height: min(88vh, 1100px);
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 24px 80px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.06);
            display: block;
            pointer-events: auto;
        }

        .pblock__chrome {
            display: flex;
            align-items: center;
            gap: .35rem;
            padding: .55rem .75rem;
            background: rgba(0,0,0,.35);
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .pblock__dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: rgba(255,255,255,.12);
        }
        .pblock__dot:nth-child(1) { background: rgba(255,95,87,.85); }
        .pblock__dot:nth-child(2) { background: rgba(255,189,46,.9); }
        .pblock__dot:nth-child(3) { background: rgba(52,199,89,.85); }
        .pblock__url {
            flex: 1;
            margin-left: .35rem;
            font-size: .62rem;
            letter-spacing: .06em;
            color: rgba(255,255,255,.35);
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pblock__shot {
            position: relative;
            flex: 1;
            min-height: 0;
            display: flex;
            align-items: stretch;
            justify-content: center;
            background: rgba(0,0,0,.2);
        }
        .pblock--split .pblock__shot { min-height: 140px; }
        .pblock__shot:not(.pblock__shot--gallery) img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            display: block;
        }
        .pblock__empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .65rem;
            padding: 1.5rem 1rem 1.75rem;
            text-align: center;
            min-height: 140px;
        }
        .pblock__empty-icon {
            font-size: 2rem;
            line-height: 1;
            opacity: .85;
        }
        .pblock__empty-cap {
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(255,255,255,.32);
            max-width: 14rem;
            line-height: 1.45;
        }
        .pblock__empty-path {
            font-size: .62rem;
            color: rgba(255,255,255,.22);
            font-family: ui-monospace, monospace;
            word-break: break-all;
            padding: 0 .75rem;
        }

        .pblock__body {
            position: relative;
            z-index: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }
        .pblock--split .pblock__body { padding: 0; }

        .pblock__head {
            display: flex;
            align-items: flex-start;
            gap: .85rem;
            margin-bottom: .5rem;
        }

        .picon {
            width: 52px;
            height: 52px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,.07);
            box-shadow:
                0 1px 0 rgba(255,255,255,.07) inset,
                0 8px 24px -12px rgba(0,0,0,.45);
        }
        .pi-p  { background: linear-gradient(165deg, rgba(108,99,255,.22), rgba(108,99,255,.06)); }
        .pi-cy { background: linear-gradient(165deg, rgba(0,212,255,.18), rgba(0,212,255,.05)); }
        .pi-gr { background: linear-gradient(165deg, rgba(0,229,160,.17), rgba(0,229,160,.05)); }
        .pi-or { background: linear-gradient(165deg, rgba(255,159,67,.18), rgba(255,159,67,.05)); }
        .pi-wa { background: linear-gradient(165deg, rgba(37,211,102,.2), rgba(37,211,102,.06)); }
        .pi-pk { background: linear-gradient(165deg, rgba(255,101,132,.17), rgba(255,101,132,.05)); }

        .pblock__titles { min-width: 0; flex: 1; }
        .pname {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.26rem;
            font-weight: 800;
            letter-spacing: -.03em;
            line-height: 1.2;
            margin-bottom: .25rem;
        }
        .pname a {
            color: inherit;
            text-decoration: none;
            transition: opacity .2s;
        }
        .pname a:hover { opacity: .88; }
        .pname-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-wrap: wrap;
            margin-bottom: .25rem;
        }
        .pname-row .pname { margin-bottom: 0; }
        .pdomain {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .04em;
            padding: .2rem .58rem;
            border-radius: 100px;
            line-height: 1.35;
        }
        .pcat {
            font-size: .66rem;
            font-weight: 600;
            letter-spacing: .14em;
            text-transform: uppercase;
            margin-bottom: .65rem;
            opacity: .92;
        }
        .pcat.cp  { color: var(--p); }
        .pcat.ccy { color: var(--cyan); }
        .pcat.cgr { color: var(--green); }
        .pcat.cor { color: var(--orange); }
        .pcat.cwa { color: var(--wa); }
        .pcat.cpk { color: var(--pink); }

        .pdesc {
            color: #949ab8;
            font-size: .88rem;
            line-height: 1.72;
            margin-bottom: 1rem;
            flex: 1;
        }

        .ptags {
            display: flex;
            flex-wrap: wrap;
            gap: .38rem;
            margin-bottom: 1.1rem;
        }
        .ptag {
            font-size: .64rem;
            font-weight: 500;
            letter-spacing: .03em;
            padding: .32rem .68rem;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,.065);
            background: rgba(255,255,255,.035);
            color: #9aa1c4;
            transition: border-color .25s, background .25s;
        }
        .pblock:hover .ptag {
            border-color: rgba(255,255,255,.1);
            background: rgba(255,255,255,.045);
        }

        .plink {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .01em;
            text-decoration: none;
            margin-top: auto;
            align-self: flex-start;
            padding: .35rem 0;
            border-bottom: 1px solid transparent;
            transition: gap .35s cubic-bezier(.22, 1, .36, 1), border-color .3s;
        }
        .plink svg {
            flex-shrink: 0;
            opacity: .9;
            transition: transform .35s cubic-bezier(.22, 1, .36, 1);
        }
        .plink.lp  { color: #a39dff; }
        .plink.lcy { color: #5ee7ff; }
        .plink.lgr { color: #4df5c4; }
        .plink.lor { color: #ffc48a; }
        .plink.lwa { color: #5ce696; }
        .plink.lpk { color: #ff8ba0; }
        .plink:hover {
            gap: .62rem;
            border-bottom-color: currentColor;
        }
        .plink:hover svg { transform: translateX(3px); }

        /* Acentos por produto */
        .pblock--hue-p  { border-color: rgba(108,99,255,.14); }
        .pblock--hue-p:hover  {
            border-color: rgba(108,99,255,.32);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.38) inset,
                0 1px 0 rgba(255,255,255,.05) inset,
                0 40px 80px -40px rgba(0,0,0,.8),
                0 0 80px -28px rgba(108,99,255,.2);
        }
        .pblock--hue-cy { border-color: rgba(0,212,255,.12); }
        .pblock--hue-cy:hover {
            border-color: rgba(0,212,255,.3);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.38) inset,
                0 1px 0 rgba(255,255,255,.05) inset,
                0 40px 80px -40px rgba(0,0,0,.8),
                0 0 72px -30px rgba(0,212,255,.14);
        }
        .pblock--hue-gr { border-color: rgba(0,229,160,.11); }
        .pblock--hue-gr:hover {
            border-color: rgba(0,229,160,.28);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.38) inset,
                0 1px 0 rgba(255,255,255,.05) inset,
                0 40px 80px -40px rgba(0,0,0,.8),
                0 0 72px -30px rgba(0,229,160,.12);
        }
        .pblock--hue-wa { border-color: rgba(37,211,102,.14); }
        .pblock--hue-wa:hover {
            border-color: rgba(37,211,102,.35);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.38) inset,
                0 1px 0 rgba(255,255,255,.05) inset,
                0 40px 80px -40px rgba(0,0,0,.8),
                0 0 76px -28px rgba(37,211,102,.16);
        }
        .pblock--hue-pk { border-color: rgba(255,101,132,.13); }
        .pblock--hue-pk:hover {
            border-color: rgba(255,101,132,.32);
            box-shadow:
                0 0 0 1px rgba(0,0,0,.38) inset,
                0 1px 0 rgba(255,255,255,.05) inset,
                0 40px 80px -40px rgba(0,0,0,.8),
                0 0 76px -28px rgba(255,101,132,.14);
        }

        .pblock::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            z-index: 2;
            opacity: .88;
        }
        .pblock--hue-p::before  { background: linear-gradient(90deg, transparent 2%, var(--p) 38%, var(--cyan) 72%, transparent 98%); }
        .pblock--hue-cy::before { background: linear-gradient(90deg, transparent 2%, var(--cyan) 45%, #00c4b4 78%, transparent 98%); }
        .pblock--hue-gr::before { background: linear-gradient(90deg, transparent 2%, var(--green) 42%, rgba(0,212,255,.75) 75%, transparent 98%); }
        .pblock--hue-wa::before { background: linear-gradient(90deg, transparent 2%, var(--wa) 42%, var(--wa-teal) 76%, transparent 98%); }
        .pblock--hue-pk::before { background: linear-gradient(90deg, transparent 2%, #ea1d2c 40%, var(--pink) 78%, transparent 98%); }

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
            .product-tiles { grid-template-columns: 1fr 1fr; }
            .pblock--split,
            .pblock--split-reverse {
                grid-template-columns: 1fr;
                padding: 1.5rem 1.35rem;
            }
            .pblock--split .pblock__visual,
            .pblock--split-reverse .pblock__visual { order: -1; }
            .pblock--split .pblock__body,
            .pblock--split-reverse .pblock__body { order: 0; }
            .why-grid { grid-template-columns: 1fr; }
            .fgrid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .site-header { padding: 1rem max(5%, env(safe-area-inset-left, 0px)) 1rem max(5%, env(safe-area-inset-right, 0px)); }
            section { padding: 4rem 5%; }
            .hero { padding: 7rem 5% 4rem; }
            .product-tiles { grid-template-columns: 1fr; }
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
        APIs e automação no WhatsApp com o <strong style="color:var(--text)">WCore</strong>
        (parceria oficial com a Meta). Tecnologia que trabalha enquanto você foca no seu negócio.
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
            <span class="strip-dot" style="background:var(--wa)"></span>
            WCore
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

    @php
        $productGallery = function (string $slug): array {
            $urls = [];
            $dir = public_path('storage/images/products/'.$slug);
            if (is_dir($dir)) {
                $ok = ['webp', 'jpg', 'jpeg', 'png'];
                $names = [];
                foreach (scandir($dir) ?: [] as $f) {
                    if ($f === '.' || $f === '..') {
                        continue;
                    }
                    $full = $dir.DIRECTORY_SEPARATOR.$f;
                    if (! is_file($full)) {
                        continue;
                    }
                    $e = strtolower((string) pathinfo($f, PATHINFO_EXTENSION));
                    if (! in_array($e, $ok, true)) {
                        continue;
                    }
                    $names[] = $f;
                }
                natcasesort($names);
                foreach ($names as $f) {
                    $urls[] = asset('storage/images/products/'.$slug.'/'.rawurlencode($f));
                }
            }
            if (count($urls) === 0) {
                foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
                    $rel = 'storage/images/products/'.$slug.'.'.$ext;
                    if (file_exists(public_path($rel))) {
                        return [asset($rel)];
                    }
                }
            }

            return array_values($urls);
        };
    @endphp

    <div class="product-showcase">

        @php $deliveryUrls = $productGallery('delivery'); $deliveryCount = count($deliveryUrls); @endphp
        <article class="pblock pblock--split pblock--hue-p">
            <div class="pblock__body">
                <div class="pblock__head">
                    <div class="picon pi-p" aria-hidden="true">&#x1F37D;&#xFE0F;</div>
                    <div class="pblock__titles">
                        <div class="pname"><a href="/delivery">Sistema de Delivery</a></div>
                        <div class="pcat cp">Restaurantes &amp; Food Service</div>
                    </div>
                </div>
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
                    <span class="ptag">Pix &amp; Marketplace</span>
                    <span class="ptag">Sem mensalidade</span>
                </div>
                <a href="/delivery" class="plink lp">
                    Ver detalhes
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="pblock__visual">
                <div class="pblock__frame">
                    <div class="pblock__chrome" aria-hidden="true">
                        <span class="pblock__dot"></span><span class="pblock__dot"></span><span class="pblock__dot"></span>
                        <span class="pblock__url">arcn.com.br / delivery</span>
                    </div>
                    <div class="pblock__shot pblock__shot--gallery">
                        @if($deliveryCount > 0)
                            <div class="pblock__slider js-product-slider" data-slide-count="{{ $deliveryCount }}">
                                <div class="pblock__slider-viewport" style="--slides: {{ $deliveryCount }}; --index: 0;" role="region" aria-roledescription="Carrossel" aria-label="Imagens do Sistema de Delivery">
                                    <div class="pblock__slider-track">
                                        @foreach($deliveryUrls as $idx => $u)
                                            <figure class="pblock__slider-slide">
                                                <img src="{{ $u }}" alt="Sistema de Delivery — slide {{ $idx + 1 }}" loading="lazy" decoding="async" width="800" height="480">
                                            </figure>
                                        @endforeach
                                    </div>
                                </div>
                                @if($deliveryCount > 1)
                                    <div class="pblock__slider-nav">
                                        <button type="button" class="pblock__slider-btn pblock__slider-btn--prev" data-slider-prev aria-label="Slide anterior">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                                        </button>
                                        <button type="button" class="pblock__slider-btn pblock__slider-btn--next" data-slider-next aria-label="Próximo slide">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                                        </button>
                                        <div class="pblock__slider-dots" role="tablist" aria-label="Selecionar slide">
                                            @foreach($deliveryUrls as $idx => $u)
                                                <button type="button" class="pblock__slider-dot{{ $idx === 0 ? ' is-active' : '' }}" data-slider-dot data-slide-index="{{ $idx }}" role="tab" aria-label="Slide {{ $idx + 1 }}" aria-current="{{ $idx === 0 ? 'true' : 'false' }}"></button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="pblock__empty">
                                <span class="pblock__empty-icon" aria-hidden="true">&#x1F4F8;</span>
                                <span class="pblock__empty-cap">Galeria de imagens</span>
                                <span class="pblock__empty-path">storage/images/products/delivery/</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>

        <div class="product-tiles">
            <a href="https://fluxy.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pblock pblock--compact pblock--hue-cy">
                <div class="pblock__body">
                    <div class="pblock__head">
                        <div class="picon pi-cy" style="padding:.4rem">
                            <img src="{{ asset('storage/images/fluxy/logo.png') }}" alt="Fluxy" width="36" height="36" style="width:36px;height:36px;object-fit:contain;display:block" decoding="async">
                        </div>
                        <div class="pblock__titles">
                <div class="pname-row">
                                <span class="pname">Fluxy</span>
                    <span class="pdomain" style="color:var(--cyan);background:rgba(0,212,255,.08);border:1px solid rgba(0,212,255,.2)">fluxy.arcn.com.br</span>
                </div>
                <div class="pcat ccy">App de Entregas</div>
                        </div>
                    </div>
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
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

            <a href="https://xbarcly.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pblock pblock--compact pblock--hue-gr">
                <div class="pblock__body">
                    <div class="pblock__head">
                        <div class="picon pi-gr" style="padding:.4rem">
                            <img src="{{ asset('storage/images/xbarcly/logo.png') }}" alt="xBarcly" width="36" height="36" style="width:36px;height:36px;object-fit:contain;display:block" decoding="async">
                        </div>
                        <div class="pblock__titles">
                <div class="pname-row">
                                <span class="pname">xBarcly</span>
                    <span class="pdomain" style="color:var(--green);background:rgba(0,229,160,.08);border:1px solid rgba(0,229,160,.2)">xbarcly.arcn.com.br</span>
                </div>
                <div class="pcat cgr">API de Código de Barras</div>
                        </div>
                    </div>
                <p class="pdesc">
                    Consulta EAN para qualquer sistema. Informações completas de produtos pelo código de barras — ideal para PDVs, estoque e e-commerce.
                </p>
                <div class="ptags">
                        <span class="ptag">EAN-13 &amp; EAN-8</span>
                    <span class="ptag">REST API</span>
                    <span class="ptag">Fácil integração</span>
                </div>
                <span class="plink lgr">
                    Acessar
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

            <a href="https://ihub.arcn.com.br" target="_blank" rel="noopener noreferrer" class="pblock pblock--compact pblock--hue-pk">
                <div class="pblock__body">
                    <div class="pblock__head">
                        <div class="picon pi-pk" style="padding:.4rem">
                            <img src="{{ asset('storage/images/ihub/logo.png') }}" alt="" width="36" height="36" style="width:36px;height:36px;object-fit:contain;display:block" decoding="async">
            </div>
                        <div class="pblock__titles">
                <div class="pname-row">
                                <span class="pname">iHub</span>
                    <span class="pdomain" style="color:var(--pink);background:rgba(255,101,132,.08);border:1px solid rgba(255,101,132,.22)">ihub.arcn.com.br</span>
                </div>
                <div class="pcat cpk">Integração iFood</div>
                        </div>
                    </div>
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
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>
        </div>

        @php $wcoreUrls = $productGallery('wcore'); $wcoreCount = count($wcoreUrls); @endphp
        <article class="pblock pblock--split pblock--split-reverse pblock--hue-wa">
            <div class="pblock__body">
                <div class="pblock__head">
                    <div class="picon pi-wa" style="padding:.4rem">
                        <img src="{{ asset('storage/images/wcore/logo.png') }}" alt="" width="36" height="36" style="width:36px;height:36px;object-fit:contain;display:block" decoding="async">
                    </div>
                    <div class="pblock__titles">
                        <div class="pname-row">
                            <span class="pname"><a href="https://wcore.cloud" target="_blank" rel="noopener noreferrer">WCore</a></span>
                            <span class="pdomain" style="color:var(--wa);background:rgba(37,211,102,.1);border:1px solid rgba(37,211,102,.28)">wcore.cloud</span>
                        </div>
                        <div class="pcat cwa">WhatsApp Business API</div>
                    </div>
                </div>
                <p class="pdesc">
                    Automação e atendimento na WhatsApp Business API: mensagens, chatbot, IA e multi-atendimento.
                    <strong style="color:var(--text)">Parceria oficial com a Meta</strong> — infraestrutura alinhada ao ecossistema WhatsApp para empresas que precisam escalar com segurança.
                </p>
                <div class="ptags">
                    <span class="ptag">Parceiro oficial Meta</span>
                    <span class="ptag">Cloud API</span>
                    <span class="ptag">Chatbot &amp; IA</span>
                    <span class="ptag">Multi-atendimento</span>
                </div>
                <a href="https://wcore.cloud" target="_blank" rel="noopener noreferrer" class="plink lwa">
                    Acessar
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="pblock__visual">
                <div class="pblock__frame">
                    <div class="pblock__chrome" aria-hidden="true">
                        <span class="pblock__dot"></span><span class="pblock__dot"></span><span class="pblock__dot"></span>
                        <span class="pblock__url">wcore.cloud</span>
        </div>
                    <div class="pblock__shot pblock__shot--gallery">
                        @if($wcoreCount > 0)
                            <div class="pblock__slider js-product-slider" data-slide-count="{{ $wcoreCount }}">
                                <div class="pblock__slider-viewport" style="--slides: {{ $wcoreCount }}; --index: 0;" role="region" aria-roledescription="Carrossel" aria-label="Imagens do WCore">
                                    <div class="pblock__slider-track">
                                        @foreach($wcoreUrls as $idx => $u)
                                            <figure class="pblock__slider-slide">
                                                <img src="{{ $u }}" alt="WCore — slide {{ $idx + 1 }}" loading="lazy" decoding="async" width="800" height="480">
                                            </figure>
                                        @endforeach
                                    </div>
                                </div>
                                @if($wcoreCount > 1)
                                    <div class="pblock__slider-nav">
                                        <button type="button" class="pblock__slider-btn pblock__slider-btn--prev" data-slider-prev aria-label="Slide anterior">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
                                        </button>
                                        <button type="button" class="pblock__slider-btn pblock__slider-btn--next" data-slider-next aria-label="Próximo slide">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                                        </button>
                                        <div class="pblock__slider-dots" role="tablist" aria-label="Selecionar slide">
                                            @foreach($wcoreUrls as $idx => $u)
                                                <button type="button" class="pblock__slider-dot{{ $idx === 0 ? ' is-active' : '' }}" data-slider-dot data-slide-index="{{ $idx }}" role="tab" aria-label="Slide {{ $idx + 1 }}" aria-current="{{ $idx === 0 ? 'true' : 'false' }}"></button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="pblock__empty">
                                <img src="{{ asset('storage/images/wcore/logo.png') }}" alt="" width="48" height="48" style="width:48px;height:48px;object-fit:contain;opacity:.95" decoding="async">
                                <span class="pblock__empty-cap">Galeria de imagens</span>
                                <span class="pblock__empty-path">storage/images/products/wcore/</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>

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
                <li><a href="https://wcore.cloud" target="_blank" rel="noopener noreferrer">WCore</a></li>
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

<div id="img-lightbox" class="img-lightbox" hidden role="dialog" aria-modal="true" aria-label="Imagem ampliada">
    <button type="button" class="img-lightbox__backdrop" aria-label="Fechar visualização ampliada"></button>
    <div class="img-lightbox__stack">
        <button type="button" class="img-lightbox__close" aria-label="Fechar">&times;</button>
        <figure class="img-lightbox__figure">
            <img id="img-lightbox-img" src="" alt="" decoding="async">
        </figure>
    </div>
</div>

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

(function () {
    var AUTOPLAY_MS = 5500;
    var prefersReducedMotion = window.matchMedia
        ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
        : false;
    document.querySelectorAll('.js-product-slider').forEach(function (root) {
        var vp = root.querySelector('.pblock__slider-viewport');
        var prev = root.querySelector('[data-slider-prev]');
        var next = root.querySelector('[data-slider-next]');
        var dots = root.querySelectorAll('[data-slider-dot]');
        if (!vp) return;
        var slides = parseInt(root.getAttribute('data-slide-count'), 10) || 1;
        var index = 0;
        var timer = null;

        function apply() {
            vp.style.setProperty('--index', String(index));
            if (prev) prev.disabled = slides <= 1;
            if (next) next.disabled = slides <= 1;
            dots.forEach(function (d, i) {
                var on = i === index;
                d.classList.toggle('is-active', on);
                d.setAttribute('aria-current', on ? 'true' : 'false');
            });
        }

        function goNext() {
            index = (index + 1) % slides;
            apply();
        }

        function goPrev() {
            index = (index - 1 + slides) % slides;
            apply();
        }

        function stopAutoplay() {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        }

        function startAutoplay() {
            stopAutoplay();
            if (slides < 2 || prefersReducedMotion) return;
            timer = setInterval(goNext, AUTOPLAY_MS);
        }

        function restartAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        apply();
        startAutoplay();

        if (prev) {
            prev.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                goPrev();
                restartAutoplay();
            });
        }
        if (next) {
            next.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                goNext();
                restartAutoplay();
            });
        }
        dots.forEach(function (d) {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var j = parseInt(d.getAttribute('data-slide-index'), 10);
                if (!isNaN(j)) {
                    index = j;
                    apply();
                    restartAutoplay();
                }
            });
        });

        document.addEventListener('visibilitychange', function () {
            if (document.hidden) stopAutoplay();
            else startAutoplay();
        });

        root.addEventListener('mouseenter', stopAutoplay);
        root.addEventListener('mouseleave', startAutoplay);
    });
})();

(function () {
    var lb = document.getElementById('img-lightbox');
    var lbImg = document.getElementById('img-lightbox-img');
    if (!lb || !lbImg) return;
    var backdrop = lb.querySelector('.img-lightbox__backdrop');
    var btnClose = lb.querySelector('.img-lightbox__close');

    function openLightbox(src, alt) {
        if (!src) return;
        lbImg.src = src;
        lbImg.alt = alt || '';
        lb.hidden = false;
        /* Só trava overflow — sem position:fixed + scrollTo (evita scroll “infinito” / animação com scroll-behavior: smooth) */
        document.documentElement.style.setProperty('overflow', 'hidden');
        document.body.style.setProperty('overflow', 'hidden');
        if (btnClose) {
            try {
                btnClose.focus({ preventScroll: true });
            } catch (err) {
                btnClose.focus();
            }
        }
    }

    function closeLightbox() {
        if (lb.hidden) return;
        if (document.activeElement && lb.contains(document.activeElement)) {
            document.activeElement.blur();
        }
        lb.hidden = true;
        lbImg.removeAttribute('src');
        lbImg.alt = '';
        document.documentElement.style.removeProperty('overflow');
        document.body.style.removeProperty('overflow');
    }

    document.addEventListener('click', function (e) {
        var t = e.target;
        if (!t || t.tagName !== 'IMG') return;
        if (!t.closest || !t.closest('.js-product-slider')) return;
        if (!t.closest('.pblock__slider-slide')) return;
        e.preventDefault();
        e.stopPropagation();
        openLightbox(t.getAttribute('src') || t.src, t.getAttribute('alt') || '');
    }, true);

    if (backdrop) backdrop.addEventListener('click', closeLightbox);
    if (btnClose) btnClose.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape' || lb.hidden) return;
        e.preventDefault();
        e.stopImmediatePropagation();
        closeLightbox();
    }, true);
})();
</script>
</body>
</html>
