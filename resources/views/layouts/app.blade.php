<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Savoria')</title>
    <meta name="description" content="Savoria - Premium restaurant experience">
    <meta property="og:title" content="Savoria">
    <meta property="og:description" content="Rasakan Pengalaman Kuliner Terbaik">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/hero.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Built assets (Vite) -->
    <link rel="stylesheet" href="/build/assets/app-DrsHY0gh.css">
    <script defer src="/build/assets/app-BvRk9kiK.js"></script>
    <!-- Fallback CDN if Tailwind is not available -->
    <script>if(!window.tailwind){document.write('<script src="https://cdn.tailwindcss.com"><\/script>')}</script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
      /* Skip link visible on keyboard focus */
      .skip-link { position: absolute; left: -999px; top: auto; }
      .skip-link:focus { left: 1rem; top: 1rem; z-index: 60; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <a href="#main-content" class="skip-link">Skip to content</a>
    @include('partials.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="container mx-auto px-4 py-6 text-center text-sm text-gray-500">© {{ date('Y') }} Savoria</div>
    </footer>
</body>
</html>
