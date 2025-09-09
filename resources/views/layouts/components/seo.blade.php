<title>{{ $seo->title ?? '' }}</title>
<meta name="description" content="{{ $seo->description ?? '' }}">
<meta property="og:title" content="{{ $seo->ogTitle ?? '' }}">
<meta property="og:description" content="{{ $seo->ogDescription ?? '' }}">
<meta property="og:image" content="{{ $seo->ogImage ?? '' }}">
<meta property="og:url" content="{{ $seo->ogUrl ?? '' }}">
<meta property="og:type" content="{{ $seo->ogType ?? '' }}">
<meta property="og:site_name" content="{{ $seo->ogSiteName ?? '' }}">

<link rel="canonical" href="{{ $seo->ogUrl ?? '' }}">
