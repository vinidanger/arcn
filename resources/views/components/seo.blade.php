@props([
    'title',
    'description',
    'path' => null,
    'image' => null,
    'keywords' => null,
    'type' => 'website',
    'robots' => 'index, follow',
])

@php
    $canonicalPath = $path ?? '/' . ltrim(request()->path(), '/');
    $canonicalPath = $canonicalPath === '/' ? '/' : '/' . trim($canonicalPath, '/');
    $canonicalUrl = url($canonicalPath);
    $siteUrl = rtrim(config('app.url'), '/');
    $siteName = config('seo.site_name');
    $ogImage = $image
        ? (filter_var($image, FILTER_VALIDATE_URL) ? $image : url('/' . ltrim($image, '/')))
        : url('/images/og-arcn.png');

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                'name' => 'Arcn Solutions',
                'url' => $siteUrl,
                'logo' => url('/images/android-chrome-512x512.png'),
                'description' => 'Arcn Solutions desenvolve software para negócios: delivery, gestão, APIs e automação.',
            ],
            [
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => $siteUrl,
                'inLanguage' => 'pt-BR',
            ],
            [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl.'#webpage',
                'url' => $canonicalUrl,
                'name' => $title,
                'description' => $description,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'url' => $siteUrl,
                    'name' => $siteName,
                ],
            ],
        ],
    ];
@endphp
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
@if ($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<meta name="author" content="Arcn Solutions">
<meta name="theme-color" content="#07080d">
<link rel="canonical" href="{{ $canonicalUrl }}">

<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/favicon-48x48.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">

<meta property="og:locale" content="pt_BR">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@if ($tw = config('seo.twitter_site'))
    <meta name="twitter:site" content="{{ $tw }}">
@endif

@if ($g = config('seo.google_site_verification'))
    <meta name="google-site-verification" content="{{ $g }}">
@endif

<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
