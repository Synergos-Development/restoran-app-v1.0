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

      :root {
        --brand: #F97316;
        --muted: #6B7280;
        --bg: #FBFBFA;
        --space-1: 0.25rem; /*4*/
        --space-2: 0.5rem;  /*8*/
        --space-3: 0.75rem; /*12*/
        --space-4: 1rem;    /*16*/
        --space-5: 1.5rem;  /*24*/
        --space-6: 2rem;    /*32*/
        --radius-sm: 0.375rem;
        --radius-md: 0.5rem;
        --shadow-sm: 0 6px 18px rgba(15,23,42,0.06);
      }
      body { font-family: var(--font-sans), ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background-color: var(--bg); color: #0f172a; }
      .container { max-width: 1200px; margin-left: auto; margin-right: auto; }
      .hero { background: linear-gradient(90deg, rgba(249,115,22,0.06), rgba(255,255,255,0)); }

      /* Typography scale */
      .type-h1 { font-size: 2.5rem; line-height: 1.05; font-weight: 800; }
      .type-h2 { font-size: 1.75rem; line-height: 1.15; font-weight: 700; }
      .type-h3 { font-size: 1.125rem; line-height: 1.3; font-weight: 600; }
      .type-body { font-size: 1rem; line-height: 1.6; }

      /* Spacing helpers */
      .g-1 { gap: var(--space-1); }
      .g-2 { gap: var(--space-2); }
      .g-3 { gap: var(--space-3); }
      .g-4 { gap: var(--space-4); }

      .btn-primary { background-color: var(--brand); color: white; padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); display:inline-flex; align-items:center; justify-content:center; }
      .card { background-color: white; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); }

      /* Aspect ratio helper (4:3) */
      .ratio-4-3 { position: relative; width: 100%; }
      .ratio-4-3::before { content: ''; display:block; padding-bottom: 75%; }
      .ratio-4-3 > * { position: absolute; inset: 0; }

      /* Image overlay */
      .img-gradient { background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.45) 100%); }

      @media (max-width:768px){ .type-h1 { font-size: 1.8rem; } .type-h2 { font-size: 1.4rem; } }

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
