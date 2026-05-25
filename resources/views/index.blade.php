<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>PLN UP3 JAMBI - Berita PLN Edition</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    {{-- ══ DNS PREFETCH ══ --}}
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://use.fontawesome.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- ══ FONT ══ --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    {{-- ══ Bootstrap async ══ --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></noscript>

    {{-- ══ FontAwesome async ══ --}}
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"></noscript>

    {{-- ══ Animate.css async ══ --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></noscript>

    {{-- ══ jQuery + turn.js: lazy load hanya saat flipbook dibuka ══ --}}
    <script>
        var _jqLoaded = false;
        function _loadFlipbookDeps(cb) {
            if (_jqLoaded) { cb && cb(); return; }
            var s1 = document.createElement('script');
            s1.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
            s1.onload = function() {
                var s2 = document.createElement('script');
                s2.src = 'https://cdn.jsdelivr.net/gh/blasten/turn.js@master/turn.js';
                s2.onload = function() { _jqLoaded = true; cb && cb(); };
                document.head.appendChild(s2);
            };
            document.head.appendChild(s1);
        }
    </script>

    <style>
        /* ══════════════════════════════════════════
           CRITICAL CSS
        ══════════════════════════════════════════ */
        :root {
            --primary: #00a2e9;
            --secondary: #ffc107;
            --dark-blue: #005691;
            --orange-pln: #ff6600;
            --light-bg: #f8f9fa;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #333;
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
        }

        h1, h2, h5, .navbar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ── TOPBAR ── */
        .topbar {
            background: #f8f9fa;
            font-size: 13px;
            border-bottom: 1px solid #eee;
        }

        /* ── NAVBAR ── */
        .navbar { padding: 15px 0; transition: all .3s; }
        .navbar-brand img { height: 40px; }
        .nav-link { font-weight: 600; color: #444 !important; transition: .3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }

        @media(max-width:991px) { .navbar-collapse { display: none !important; } }

        /* ── DRAWER TOGGLE ── */
        .drawer-toggle {
            background: none; border: none; cursor: pointer;
            width: 44px; height: 44px; display: none;
            flex-direction: column; justify-content: center;
            align-items: center; gap: 5px; border-radius: 10px;
            transition: background .2s; padding: 0;
            -webkit-tap-highlight-color: transparent;
        }
        .drawer-toggle span {
            display: block; width: 24px; height: 2.5px;
            background: #333; border-radius: 4px; transition: all .3s;
        }
        .drawer-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
        .drawer-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .drawer-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }
        @media(max-width:991px) { .drawer-toggle { display: flex; } }

        /* ── DRAWER OVERLAY ── */
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,.5);
            z-index: 1040; opacity: 0; visibility: hidden;
            transition: opacity .3s, visibility .3s;
            -webkit-tap-highlight-color: transparent;
        }
        .drawer-overlay.show { opacity: 1; visibility: visible; }

        /* ── DRAWER PANEL ── */
        .drawer-panel {
            position: fixed; top: 0; right: 0;
            width: min(300px, 80vw); height: 100%; height: 100dvh;
            background: #fff; z-index: 1050;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4,0,.2,1);
            display: flex; flex-direction: column;
            overflow-y: auto; -webkit-overflow-scrolling: touch;
            box-shadow: -8px 0 40px rgba(0,0,0,.15);
        }
        .drawer-panel.open { transform: translateX(0); }

        .drawer-header {
            background: linear-gradient(135deg, #005691, #00a2e9);
            padding: 20px 20px 24px;
            display: flex; align-items: center;
            justify-content: space-between; flex-shrink: 0;
        }
        .drawer-header .drawer-logo { display: flex; align-items: center; gap: 12px; }
        .drawer-header .drawer-logo img { height: 36px; filter: brightness(0) invert(1); }
        .drawer-header .drawer-logo-text h3 { color: #fff; font-size: .95rem; font-weight: 800; margin: 0; }
        .drawer-header .drawer-logo-text small { color: rgba(255,255,255,.7); font-size: .65rem; letter-spacing: 1px; display: block; }

        .drawer-close {
            background: rgba(255,255,255,.2); border: none; color: #fff;
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px; flex-shrink: 0;
            -webkit-tap-highlight-color: transparent; transition: background .2s;
        }
        .drawer-close:hover { background: rgba(255,255,255,.35); }

        .drawer-body { flex: 1; padding: 10px 0; }

        .drawer-nav-item {
            display: flex; align-items: center; gap: 14px;
            padding: 15px 22px; color: #333; text-decoration: none;
            font-weight: 600; font-size: .95rem;
            border-left: 3px solid transparent; transition: all .2s;
            -webkit-tap-highlight-color: transparent;
        }
        .drawer-nav-item:hover, .drawer-nav-item.active {
            background: #f0f7ff; color: var(--primary); border-left-color: var(--primary);
        }
        .drawer-nav-item i { width: 20px; text-align: center; font-size: 1rem; color: var(--primary); flex-shrink: 0; }
        .drawer-divider { height: 1px; background: #f0f0f0; margin: 8px 16px; }

        .drawer-footer { padding: 16px 22px; border-top: 1px solid #f0f0f0; flex-shrink: 0; }
        .drawer-footer .pln-mobile-btn {
            display: flex; align-items: center; gap: 12px;
            background: linear-gradient(135deg, #005691, #00a2e9);
            color: #fff; text-decoration: none; border-radius: 14px;
            padding: 12px 16px; font-size: .85rem; font-weight: 600;
            transition: opacity .2s; -webkit-tap-highlight-color: transparent;
        }
        .drawer-footer .pln-mobile-btn:hover { opacity: .9; }
        .drawer-footer .pln-mobile-btn img {
            width: 36px; height: 36px; border-radius: 10px;
            object-fit: cover; flex-shrink: 0;
        }

        /* ── CAROUSEL ── */
        /* Scope khusus carousel agar tidak mencemari selector lain */
        #plnSlider .carousel-item video {
            width: 100%; height: auto; object-fit: contain;
            padding-left: 120px; padding-right: 120px;
        }
        #plnSlider .carousel-item img {
            width: 100%; height: 80vh;
            object-fit: contain; padding-left: 20px; padding-right: 20px;
        }
        .carousel-caption {
            bottom: 25%; text-align: center; width: 100%; left: 0; padding: 0 15px;
        }
        .carousel-caption h1 {
            font-size: calc(1.8rem + 2vw); font-weight: 800;
            letter-spacing: 15px; text-transform: uppercase;
        }
        @media(max-width:768px) {
            #plnSlider .carousel-item video {
                height: auto !important; max-height: 60vh;
                padding-left: 10px; padding-right: 10px; object-fit: contain !important;
            }
            #plnSlider .carousel-item img {
                width: 100%; height: 50vh; object-fit: cover; padding: 0;
            }
            .carousel-caption { top: 50% !important; left: 50% !important; transform: translate(-50%,-50%) !important; }
            .carousel-caption h1 { letter-spacing: 2px; font-size: 1.5rem; }
        }

        /* ── MARQUEE ── */
        marquee { background: var(--secondary); padding: 10px 0; font-weight: 700; color: #000; font-size: .85rem; }

        /* ── SECTION TITLE ── */
        .section-title {
            color: var(--dark-blue); font-weight: 800;
            margin-bottom: 40px; position: relative; font-size: 2rem;
        }
        .section-title::after {
            content: ''; width: 60px; height: 5px; background: var(--orange-pln);
            position: absolute; bottom: -12px; left: 50%;
            transform: translateX(-50%); border-radius: 10px;
        }
        @media(max-width:768px) { .section-title { font-size: 1.5rem; } }

        /* ── SEARCH & FILTER ── */
        .filter-wrapper {
            background: #fff; border-radius: 50px; padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            border: 1px solid #f0f0f0; display: flex; align-items: center;
        }
        .filter-wrapper input, .filter-wrapper select {
            border: none; background: transparent; padding: 10px 15px; outline: none;
        }
        .filter-wrapper input { flex-grow: 1; border-right: 1px solid #eee; }
        .filter-wrapper select { width: 150px; border-right: 1px solid #eee; color: #666; cursor: pointer; }
        .filter-wrapper .btn-search {
            background: var(--primary); color: white; border-radius: 50%;
            width: 45px; height: 45px; display: flex; align-items: center;
            justify-content: center; border: none; margin-left: 10px;
            transition: .3s; flex-shrink: 0; cursor: pointer;
        }
        .filter-wrapper .btn-search:hover { transform: scale(1.1); background: var(--dark-blue); }
        .btn-refresh {
            width: 45px; height: 45px; border-radius: 50%; border: 1px solid #ddd;
            display: flex; align-items: center; justify-content: center;
            color: #888; text-decoration: none; margin-left: 10px; transition: .3s; flex-shrink: 0;
        }
        .btn-refresh:hover { background: #f8f9fa; color: var(--primary); }
        @media(max-width:992px) {
            .filter-wrapper { border-radius: 20px; flex-direction: column; padding: 15px; }
            .filter-wrapper input, .filter-wrapper select { width: 100%; border-right: none; border-bottom: 1px solid #eee; }
            .filter-wrapper .btn-search { width: 100%; border-radius: 10px; margin-top: 10px; margin-left: 0; height: 44px; }
            .btn-refresh { width: 100%; margin-left: 0; margin-top: 10px; border-radius: 10px; height: 44px; }
        }

        /* ── MASONRY + SKELETON ── */
        .masonry-columns { column-count: 3; column-gap: 20px; }
        @media(max-width:992px) { .masonry-columns { column-count: 2; } }
        @media(max-width:576px) { .masonry-columns { column-count: 1; } }

        .masonry-item {
            break-inside: avoid; margin-bottom: 20px; position: relative;
            border-radius: 16px; overflow: hidden; transition: transform .4s;
            box-shadow: 0 4px 15px rgba(0,0,0,.08); cursor: pointer;
            background: #e9ecef; min-height: 200px;
        }
        .masonry-item:hover { transform: translateY(-8px); }
        .masonry-item:active { transform: translateY(-4px); }
        .masonry-item img {
            width: 100%; display: block;
            opacity: 0; transition: opacity .4s ease;
        }
        .masonry-content {
            position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,.95), transparent); color: white;
        }

        /* ── SKELETON SHIMMER ── */
        .skeleton-wrap {
            position: absolute; inset: 0;
            background: linear-gradient(90deg, #e9ecef 25%, #f8f9fa 50%, #e9ecef 75%);
            background-size: 400% 100%; animation: shimmer 1.4s infinite;
            border-radius: 16px; z-index: 1; transition: opacity .3s;
        }
        .masonry-item.img-ready .skeleton-wrap { opacity: 0; pointer-events: none; }
        .masonry-item.img-ready img { opacity: 1; }
        @keyframes shimmer {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ══════════════════════════════════════════
           FLIPBOOK MODAL
        ══════════════════════════════════════════ */
        #flipbookModal .modal-dialog { max-width: 100vw; width: 100vw; margin: 0; }
        #flipbookModal .modal-content {
            border: none; border-radius: 0; background: #1a1a2e;
            min-height: 100vh; min-height: 100dvh;
        }
        #flipbookModal .modal-body {
            padding: 0; display: flex; flex-direction: column;
            height: 100vh; height: 100dvh;
        }

        /* ── TOOLBAR ── */
        .fb-toolbar {
            background: #111827; color: white; padding: 6px 8px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 4px; border-bottom: 1px solid #374151;
            user-select: none; flex-shrink: 0; z-index: 10;
            -webkit-user-select: none; flex-wrap: nowrap; min-height: 48px;
        }
        .fb-toolbar-group { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
        .fb-toolbar-group:nth-child(2) { flex-shrink: 1; }
        .fb-toolbar button {
            background: transparent; border: none; color: #9ca3af;
            font-size: 14px; cursor: pointer; padding: 6px 7px;
            border-radius: 8px; transition: all .2s;
            -webkit-tap-highlight-color: transparent; touch-action: manipulation;
            min-width: 32px; min-height: 32px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .fb-toolbar button:hover { color: white; background: rgba(255,255,255,.1); }
        .fb-toolbar button:active { background: rgba(255,255,255,.2); }

        .fb-page-info {
            background: #374151; color: #f9fafb; padding: 4px 8px;
            border-radius: 6px; font-size: 11px; font-weight: 700;
            min-width: 54px; text-align: center; letter-spacing: .5px;
            white-space: nowrap; flex-shrink: 0;
        }
        .fb-title-bar {
            font-size: 12px; color: #6b7280; max-width: 220px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: none;
        }
        @media(min-width:768px) { .fb-title-bar { display: block; } }

        .fb-hide-md { display: none !important; }
        @media(min-width:768px) { .fb-hide-md { display: flex !important; } }
        @media(max-width:399px) {
            .fb-hide-xs { display: none !important; }
            .fb-toolbar button { padding: 5px; font-size: 13px; min-width: 28px; min-height: 28px; }
            .fb-page-info { min-width: 46px; font-size: 10px; padding: 3px 6px; }
        }

        /* ── VIEWPORT & BOOK ── */
        #fb-viewport {
            flex: 1; display: flex; justify-content: center; align-items: center;
            overflow: hidden; position: relative; touch-action: pan-y;
            -webkit-touch-callout: none; -webkit-user-select: none; user-select: none;
        }
        #fb-book-wrap {
            transition: transform .3s ease; transform-origin: center center;
            display: flex; justify-content: center; align-items: center;
        }
        #fb-book { box-shadow: 0 25px 80px rgba(0,0,0,.8); }
        .fb-page { background: #fff; overflow: hidden; position: relative; }
        .fb-page-inner {
            width: 100%; height: 100%; display: flex;
            flex-direction: column; position: relative; overflow: hidden;
        }
        .fb-page-inner img {
            width: 100%; height: 100%; object-fit: cover;
            pointer-events: none; user-select: none;
            -webkit-user-drag: none; -webkit-touch-callout: none;
            display: block; flex-shrink: 0;
        }

        /* ── COVER ── */
        .fb-cover {
            background: linear-gradient(145deg, #005691 0%, #00a2e9 60%, #0dcaf0 100%);
            display: flex; flex-direction: column; justify-content: center;
            align-items: center; color: white; text-align: center;
            padding: 40px 30px; position: relative; overflow: hidden;
        }
        .fb-cover::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .fb-cover h2 {
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800;
            font-size: 1.6rem; margin: 0 0 8px; position: relative;
        }
        .fb-cover p { font-size: .85rem; opacity: .8; margin: 0; position: relative; }

        /* ── CAPTION ── */
        .fb-caption {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 18px 16px 14px;
            background: linear-gradient(to top, rgba(0,0,0,.92) 0%, rgba(0,0,0,.4) 70%, transparent 100%);
            color: #fff;
        }
        .fb-caption .fb-cap-date { font-size: .7rem; color: #fbbf24; font-weight: 700; margin-bottom: 4px; display: block; }
        .fb-caption .fb-cap-title {
            font-family: 'Plus Jakarta Sans', sans-serif; font-size: .85rem;
            font-weight: 700; line-height: 1.3; margin: 0;
        }
        .fb-pg-num {
            position: absolute; top: 10px; right: 12px;
            background: rgba(0,0,0,.5); color: #fff; font-size: .65rem;
            font-weight: 700; border-radius: 20px; padding: 2px 8px;
        }

        /* ── NAV ARROWS ── */
        .fb-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: rgba(255,255,255,.15); border: none;
            width: 40px; height: 40px; border-radius: 50%; z-index: 100;
            cursor: pointer; color: white; font-size: 15px;
            backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
            transition: all .2s; display: flex; align-items: center;
            justify-content: center; -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }
        .fb-nav:hover { background: rgba(255,255,255,.3); transform: translateY(-50%) scale(1.1); }
        .fb-nav:active { background: rgba(255,255,255,.4); }
        #fb-prev { left: 10px; }
        #fb-next { right: 10px; }
        @media(max-width:480px) {
            .fb-nav { width: 36px; height: 36px; font-size: 13px; }
            #fb-prev { left: 5px; }
            #fb-next { right: 5px; }
        }

        /* ══════════════════════════════════════════
           THUMBNAIL STRIP — PERBAIKAN LENGKAP
           Tambahan: nomor halaman + label aktif
        ══════════════════════════════════════════ */
        #fb-thumbs {
            background: #0f172a;
            padding: 6px 10px;
            display: none;
            gap: 5px;
            overflow-x: auto;
            flex-shrink: 0;
            scrollbar-width: thin;
            scrollbar-color: #374151 transparent;
            -webkit-overflow-scrolling: touch;
            align-items: flex-end;  /* rata bawah agar label nomor rapi */
            max-height: 100px;
        }
        #fb-thumbs::-webkit-scrollbar { height: 4px; }
        #fb-thumbs::-webkit-scrollbar-track { background: transparent; }
        #fb-thumbs::-webkit-scrollbar-thumb { background: #374151; border-radius: 4px; }
        #fb-thumbs.show { display: flex; }

        /* Wrapper per thumbnail: gambar + nomor di bawah */
        .fb-thumb-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            flex-shrink: 0;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }

        .fb-thumb {
            flex-shrink: 0;
            width: 48px;
            height: 64px;
            border-radius: 5px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: all .2s;
            opacity: .55;
            position: relative;
        }
        /* Hover & active state thumbnail */
        .fb-thumb-wrap:hover .fb-thumb {
            border-color: var(--primary);
            opacity: 1;
            transform: translateY(-2px);
        }
        .fb-thumb-wrap.active .fb-thumb {
            border-color: var(--primary);
            opacity: 1;
            box-shadow: 0 0 0 2px rgba(0,162,233,.5);
        }
        /* Indikator "AKTIF" di sudut thumbnail */
        .fb-thumb-wrap.active .fb-thumb::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,162,233,.18);
            pointer-events: none;
        }
        .fb-thumb img {
            width: 100%; height: 100%; object-fit: cover;
            pointer-events: none; display: block;
        }
        .fb-thumb-cover {
            background: linear-gradient(135deg, #005691, #00a2e9);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px; width: 100%; height: 100%;
        }
        /* Label nomor halaman di bawah thumbnail */
        .fb-thumb-label {
            font-size: 9px;
            font-weight: 700;
            color: #6b7280;
            text-align: center;
            line-height: 1;
            letter-spacing: .3px;
            transition: color .2s;
            white-space: nowrap;
        }
        .fb-thumb-wrap:hover .fb-thumb-label { color: var(--primary); }
        .fb-thumb-wrap.active .fb-thumb-label { color: var(--primary); }

        /* ── LOADING ── */
        #fb-loading {
            position: absolute; inset: 0; background: #1a1a2e;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: white; z-index: 50;
        }
        #fb-loading .fb-spinner {
            width: 48px; height: 48px;
            border: 4px solid rgba(255,255,255,.15);
            border-top-color: var(--primary); border-radius: 50%;
            animation: spin .8s linear infinite; margin-bottom: 16px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── SINGLE PAGE (mobile) ── */
        .fb-single-container {
            width: 100%; height: 100%; display: flex;
            justify-content: center; align-items: center; padding: 10px;
        }
        .fb-single-page {
            position: relative; border-radius: 12px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.8); background: #fff; max-height: 100%;
        }
        .fb-single-page img {
            display: block; width: 100%; height: 100%; object-fit: cover;
            pointer-events: none; -webkit-user-drag: none;
            -webkit-touch-callout: none; user-select: none;
        }
        .fb-single-cover {
            background: linear-gradient(145deg, #005691 0%, #00a2e9 60%, #0dcaf0 100%);
            display: flex; flex-direction: column; justify-content: center;
            align-items: center; color: white; text-align: center;
            padding: 40px 30px; width: 100%; height: 100%;
        }

        /* ══ PRINT ══ */
        #print-section { display: none; }
        @media print {
            body > *:not(#print-section) { display: none !important; }
            #print-section { display: block !important; }
            @page { margin: 0; size: A4 portrait; }
            html, body {
                margin: 0 !important; padding: 0 !important; width: 100%;
                height: auto; background: #fff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .print-page {
                width: 210mm; height: 297mm; page-break-after: always;
                page-break-inside: avoid; display: flex; flex-direction: column;
                overflow: hidden; position: relative; box-sizing: border-box; background: #fff;
            }
            .print-page:last-child { page-break-after: auto; }
            .print-cover {
                background: linear-gradient(145deg, #005691, #00a2e9) !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color: white !important; justify-content: center !important;
                align-items: center !important; text-align: center !important; padding: 0 !important;
            }
            .print-cover * { color: white !important; }
            .print-header {
                flex-shrink: 0; width: 100%; padding: 6mm 12mm 4mm;
                display: flex; justify-content: space-between; align-items: center;
                border-bottom: 1px solid #ddd; font-size: 8pt; color: #888;
                background: #fff; box-sizing: border-box;
            }
            .print-img-wrap { flex: 1; width: 100%; overflow: hidden; position: relative; }
            .print-img-wrap img {
                width: 100%; height: 100%; object-fit: contain;
                display: block; position: absolute; top: 0; left: 0;
            }
            .print-caption {
                flex-shrink: 0; width: 100%; padding: 5mm 12mm 6mm;
                background: #fff; box-sizing: border-box; border-top: 2px solid #00a2e9;
            }
            .print-caption h3 {
                font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13pt;
                font-weight: 800; margin: 0 0 2mm; color: #111 !important; line-height: 1.3;
            }
            .print-caption p { font-size: 9pt; color: #555 !important; margin: 0; }
        }

        /* ══ FOOTER ══ */
        .main-footer { background-color: #1a8a9d; color: white; padding: 60px 0 0; font-size: .85rem; }
        .footer-title {
            font-weight: 700; margin-bottom: 25px; text-transform: uppercase;
            font-size: .95rem; letter-spacing: 1px; color: #fff;
        }
        .text-description { line-height: 1.6; color: rgba(255,255,255,.9); margin-bottom: 20px; }
        .footer-link-list { list-style: none; padding: 0; }
        .footer-link {
            color: rgba(255,255,255,.85); text-decoration: none;
            transition: all .3s ease; display: inline-block; margin-bottom: 12px;
        }
        .footer-link:hover { color: #fff; transform: translateX(5px); }
        .contact-item { display: flex; align-items: center; margin-bottom: 15px; gap: 15px; }
        .contact-icon {
            width: 30px; height: 30px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin-right: 15px; font-size: .85rem; flex-shrink: 0;
            color: white; transform: translateY(-2px);
        }
        .social-icon {
            width: 38px; height: 38px; color: white; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: all .3s ease; font-size: 1.1rem;
        }
        .social-icon:hover { transform: translateX(5px); filter: brightness(1.1); box-shadow: 0 5px 15px rgba(0,0,0,.3); }
        .bg-telp  { background-color: #4db34d; }
        .bg-phone { background-color: #e62e8a; }
        .bg-email { background-color: #f7941d; }
        .bg-facebook  { background-color: #3b5998; }
        .bg-twitter   { background-color: #55acee; }
        .bg-instagram { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#bc1888); }
        .bg-tiktok { background-color: #000; }
        .bg-youtube { background-color: #fc2a2a; }
        .footer-bottom {
            background: rgba(0,0,0,.15); padding: 25px 0; margin-top: 50px;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .map-container {
            border-radius: 24px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,.1); border: 8px solid #fff;
        }
        @media(max-width:768px) {
            .map-container { border-width: 4px; }
            .map-container iframe { height: 280px; }
        }
    </style>
</head>

<body>

    <!-- ══ TOPBAR ══ -->
    <div class="container-fluid topbar py-2 d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt text-primary me-2"></i> 123 (Contact Center)</span>
                <span><i class="fas fa-envelope text-primary me-2"></i> info@plnjambi.id</span>
            </div>
            <div class="fw-bold text-secondary">
                <i class="far fa-clock me-1"></i>
                <?php date_default_timezone_set('Asia/Jakarta'); echo date('l, d F Y'); ?>
            </div>
        </div>
    </div>

    <!-- ══ NAVBAR ══ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN">
                <div class="ms-3 lh-1">
                    <h1 class="h5 m-0 text-primary fw-800">PLN UP3 JAMBI</h1>
                    <small class="text-muted fw-bold" style="font-size:10px;letter-spacing:1px;">KELISTRIKAN JAMBI</small>
                </div>
            </a>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link active">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('tentang.kami') }}" class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                    <li class="nav-item ms-lg-3 d-flex align-items-center">
                        <a href="https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id" id="pln-mobile-link" title="PLN Mobile" target="_blank">
                            <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile" style="width:35px;height:35px;border-radius:10px;object-fit:cover;box-shadow:0 4px 8px rgba(0,0,0,.15);transition:transform .2s;">
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light border text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                            <i class="fas fa-user-lock"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="drawer-toggle" id="drawerToggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ══ MOBILE DRAWER ══ -->
    <div class="drawer-overlay" id="drawerOverlay"></div>
    <div class="drawer-panel" id="drawerPanel" role="dialog" aria-modal="true" aria-label="Menu Navigasi">
        <div class="drawer-header">
            <div class="drawer-logo">
                <div class="drawer-logo-text">
                    <h3>PLN UP3 JAMBI</h3>
                    <small>KELISTRIKAN JAMBI</small>
                </div>
            </div>
            <button class="drawer-close" id="drawerClose" aria-label="Tutup menu"><i class="fas fa-times"></i></button>
        </div>
        <nav class="drawer-body">
            <a href="{{ url('/') }}" class="drawer-nav-item active"><i class="fas fa-home"></i><span>Beranda</span></a>
            <a href="{{ route('tentang.kami') }}" class="drawer-nav-item"><i class="fas fa-building"></i><span>Tentang Kami</span></a>
            <div class="drawer-divider"></div>
            <a href="#berita" class="drawer-nav-item" id="drawerBeritaLink"><i class="fas fa-newspaper"></i><span>Berita Terkini</span></a>
            <div class="drawer-divider"></div>
            <a href="{{ route('login') }}" class="drawer-nav-item"><i class="fas fa-user-lock"></i><span>Admin Login</span></a>
        </nav>
        <div class="drawer-footer">
            <a href="#" id="pln-mobile-link-drawer" class="pln-mobile-btn" target="_blank">
                <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile" width="36" height="36">
                <div>
                    <div style="font-size:.8rem;font-weight:700;">PLN Mobile</div>
                    <div style="font-size:.7rem;opacity:.8;">Download Sekarang</div>
                </div>
                <i class="fas fa-external-link-alt ms-auto" style="font-size:.8rem;opacity:.7;"></i>
            </a>
        </div>
    </div>

    <script>
        /* ── PLN Mobile link — deteksi iOS vs Android ── */
        (function() {
            var ua = navigator.userAgent || navigator.vendor || window.opera;
            var url = /iPad|iPhone|iPod/.test(ua) && !window.MSStream
                ? 'https://apps.apple.com/nz/app/pln-mobile/id1299581030'
                : 'https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id';
            var l  = document.getElementById('pln-mobile-link');
            var ld = document.getElementById('pln-mobile-link-drawer');
            if (l)  l.href  = url;
            if (ld) ld.href = url;
        })();

        /* ── Drawer ── */
        (function() {
            var toggle  = document.getElementById('drawerToggle');
            var panel   = document.getElementById('drawerPanel');
            var overlay = document.getElementById('drawerOverlay');
            var closeBtn = document.getElementById('drawerClose');

            function openDrawer() {
                panel.classList.add('open');
                overlay.classList.add('show');
                toggle.classList.add('open');
                toggle.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }
            function closeDrawer() {
                panel.classList.remove('open');
                overlay.classList.remove('show');
                toggle.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                panel.classList.contains('open') ? closeDrawer() : openDrawer();
            });
            overlay.addEventListener('click', closeDrawer);
            closeBtn.addEventListener('click', closeDrawer);
            panel.querySelectorAll('.drawer-nav-item').forEach(function(a) {
                a.addEventListener('click', function() { setTimeout(closeDrawer, 100); });
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && panel.classList.contains('open')) closeDrawer();
            });
        })();
    </script>

    <marquee scrollamount="6">⚡ LAYANAN LISTRIK JAMBI KINI LEBIH MUDAH DENGAN APLIKASI PLN MOBILE — DOWNLOAD DI PLAYSTORE &amp; APPSTORE ⚡</marquee>

    <!-- ══ CAROUSEL ══ -->
    <div id="plnSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background:#f8f9fa;">
                <img
                    src="https://www.dropbox.com/scl/fi/f5l5co6xu2uzeat1uquas/Arabica.gif?rlkey=u3x1ac4ecieo0vzku1jsbp4rz&st=eqttbcux&raw=1"
                    alt="Animasi PLN UP3 Jambi"
                    class="d-block w-100"
                    style="object-fit:contain;max-height:500px;width:100%;padding:0;">
            </div>
        </div>
    </div>
    <!-- /CAROUSEL -->

    <!-- ══ BERITA ══ -->
    <div class="container py-5" id="berita">
        <div class="text-center mb-5">
            <h2 class="section-title">Galeri Berita Terkini</h2>
        </div>

        <!-- Search / Filter -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                <form action="{{ url('/') }}" method="GET" class="d-flex flex-column flex-md-row align-items-center">
                    <div class="filter-wrapper flex-grow-1 w-100">
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ $search }}" class="w-100">
                        <select name="bulan">
                            <option value="">Semua Bulan</option>
                            @php $m_list=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; @endphp
                            @foreach ($m_list as $k => $m)
                                <option value="{{ $k + 1 }}" {{ $bulan == $k + 1 ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                        <select name="tahun">
                            <option value="">Tahun</option>
                            @for ($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn-search d-none d-md-flex" aria-label="Cari"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="d-flex w-100 d-md-none mt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1 rounded-3 py-2 me-2">Cari</button>
                        <a href="{{ url('/') }}#berita" class="btn btn-outline-secondary rounded-3 py-2"><i class="fas fa-sync-alt"></i></a>
                    </div>
                    <a href="{{ url('/') }}#berita" class="btn-refresh d-none d-md-flex" title="Reset"><i class="fas fa-sync-alt"></i></a>
                </form>
            </div>
        </div>

        <!-- Masonry Grid -->
        <div class="masonry-columns animate__animated animate__fadeIn">
            @if ($data_berita->count() > 0)
                @foreach ($data_berita as $index => $d)
                    @php
                        $imgSrc     = asset('assets/berita/' . $d->gambar);
                        $aboveFold  = $index < 3;
                        $placeholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E";
                    @endphp
                    <div class="masonry-item" onclick="openFlipbook({{ $index }})" role="button" tabindex="0"
                        aria-label="Buka berita: {{ $d->judul }}"
                        onkeydown="if(event.key==='Enter'||event.key===' ')openFlipbook({{ $index }})">
                        <div class="skeleton-wrap" aria-hidden="true"></div>
                        @if ($aboveFold)
                            <img src="{{ $imgSrc }}" alt="{{ $d->judul }}" loading="eager" decoding="async" fetchpriority="high"
                                onload="this.closest('.masonry-item').classList.add('img-ready')">
                        @else
                            <img src="{{ $placeholder }}" data-src="{{ $imgSrc }}" alt="{{ $d->judul }}" loading="lazy" decoding="async"
                                onload="if(this.src.indexOf('data:image')<0)this.closest('.masonry-item').classList.add('img-ready')">
                        @endif
                        <div class="masonry-content">
                            <small class="text-warning fw-bold d-block mb-1">
                                <i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d M Y') }}
                            </small>
                            <h5 class="m-0">{{ $d->judul }}</h5>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center w-100 py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25" loading="lazy" alt="">
                    <p class="text-muted">Tidak ada berita yang ditemukan.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if ($data_berita->hasPages())
            @php
                $current = $data_berita->currentPage();
                $last    = $data_berita->lastPage();
                $window  = 4;
                $start   = max(1, $current - 1);
                $end     = min($last, $start + $window - 1);
                if ($end - $start < $window - 1) { $start = max(1, $end - $window + 1); }
            @endphp
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Navigasi halaman">
                    <ul class="pagination mb-0 gap-2">
                        <li class="page-item {{ $current == 1 ? 'disabled' : '' }}">
                            <a class="page-link rounded-3 border-0 shadow-sm px-3 py-2" style="background:{{ $current==1?'#f8f9fa':'#fff' }};color:{{ $current==1?'#6c757d':'#333' }};min-width:44px;text-align:center;"
                               href="{{ $current > 1 ? $data_berita->url(1) : '#' }}" aria-label="Halaman pertama">
                                <i class="fas fa-angle-double-left"></i></a>
                        </li>
                        <li class="page-item {{ $current == 1 ? 'disabled' : '' }}">
                            <a class="page-link rounded-3 border-0 shadow-sm px-3 py-2" style="background:{{ $current==1?'#f8f9fa':'#fff' }};color:{{ $current==1?'#6c757d':'#333' }};min-width:44px;text-align:center;"
                               href="{{ $current > 1 ? $data_berita->url($current - 1) : '#' }}" aria-label="Halaman sebelumnya">
                                <i class="fas fa-angle-left"></i></a>
                        </li>
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $i == $current ? 'active' : '' }}">
                                <a class="page-link rounded-3 border-0 shadow-sm px-3 py-2 fw-semibold"
                                   style="background:{{ $i==$current?'var(--primary)':'#fff' }};color:{{ $i==$current?'#fff':'#333' }};min-width:44px;text-align:center;"
                                   href="{{ $data_berita->url($i) }}" aria-label="Halaman {{ $i }}" {{ $i==$current?'aria-current=page':'' }}>{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $current == $last ? 'disabled' : '' }}">
                            <a class="page-link rounded-3 border-0 shadow-sm px-3 py-2" style="background:{{ $current==$last?'#f8f9fa':'#fff' }};color:{{ $current==$last?'#6c757d':'#333' }};min-width:44px;text-align:center;"
                               href="{{ $current < $last ? $data_berita->url($current + 1) : '#' }}" aria-label="Halaman berikutnya">
                                <i class="fas fa-angle-right"></i></a>
                        </li>
                        <li class="page-item {{ $current == $last ? 'disabled' : '' }}">
                            <a class="page-link rounded-3 border-0 shadow-sm px-3 py-2" style="background:{{ $current==$last?'#f8f9fa':'#fff' }};color:{{ $current==$last?'#6c757d':'#333' }};min-width:44px;text-align:center;"
                               href="{{ $current < $last ? $data_berita->url($last) : '#' }}" aria-label="Halaman terakhir">
                                <i class="fas fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
    <!-- /BERITA -->

    <!-- ══ LOKASI ══ -->
    <div class="container py-5">
        <div class="card p-4 p-lg-5" style="border-radius:24px;border:none;box-shadow:0 10px 40px rgba(0,0,0,.08);">
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <h2 class="fw-800 mb-4 text-dark" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;">Lokasi Kantor</h2>
                    <div class="mb-4">
                        <div class="d-flex mb-4">
                            <i class="fas fa-map-marker-alt text-danger me-3 mt-1 fs-5 flex-shrink-0"></i>
                            <p class="text-secondary mb-0" style="font-size:.95rem;line-height:1.6;">Jl. Jenderal Urip Sumoharjo No.2, Sungai Putri, Kec. Danau Tlk., Kota Jambi, Jambi 36122</p>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-clock text-primary me-3 mt-1 fs-5 flex-shrink-0"></i>
                            <div class="text-secondary" style="font-size:.95rem;"><strong class="text-dark">Jam Layanan:</strong><br>Senin - Jumat: 08.00 - 16.00 WIB</div>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-headset text-warning me-3 mt-1 fs-5 flex-shrink-0"></i>
                            <div class="text-secondary" style="font-size:.95rem;"><strong class="text-dark">Contact Center:</strong><br>123 (Kode Area + 123)</div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <a href="https://maps.google.com/?q=Kantor+PLN+UP3+Jambi" target="_blank" rel="noopener" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                        <i class="fas fa-directions me-2"></i>Petunjuk Arah
                    </a>
                </div>
                <div class="col-lg-8">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.243542283921!2d103.587217374033!3d-1.6101132362624472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2586f5a6626deb%3A0x38b891b00cae7790!2sKantor%20PLN%20UP3%20Jambi!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                            width="100%" height="400" style="border:0;display:block;" allowfullscreen="" loading="lazy" title="Peta Kantor PLN UP3 Jambi"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /LOKASI -->

    <!-- ══ FLIPBOOK MODAL ══ -->
    <div class="modal fade" id="flipbookModal" tabindex="-1" data-bs-backdrop="static" aria-label="Galeri Berita">
        <div class="modal-dialog modal-dialog-centered" style="max-width:100vw;width:100vw;margin:0;">
            <div class="modal-content" style="border:none;border-radius:0;background:#1a1a2e;min-height:100vh;min-height:100dvh;">
                <div class="modal-body p-0 d-flex flex-column" style="height:100vh;height:100dvh;">

                    <div id="fb-loading">
                        <div class="fb-spinner"></div>
                        <p style="color:#9ca3af;font-size:.9rem;">Memuat galeri berita…</p>
                    </div>

                    <div class="fb-toolbar">
                        {{-- GRUP KIRI --}}
                        <div class="fb-toolbar-group">
                            <button onclick="fbClose()" title="Tutup" aria-label="Tutup"><i class="fas fa-times"></i></button>
                            <div style="width:1px;height:20px;background:#374151;" class="fb-hide-md" aria-hidden="true"></div>
                            <button onclick="fbZoomIn()" title="Perbesar" class="fb-hide-md" aria-label="Perbesar"><i class="fas fa-search-plus"></i></button>
                            <button onclick="fbZoomOut()" title="Perkecil" class="fb-hide-md" aria-label="Perkecil"><i class="fas fa-search-minus"></i></button>
                            <button onclick="fbToggleThumbs()" title="Thumbnail" class="fb-hide-xs" aria-label="Tampilkan thumbnail"><i class="fas fa-th-large"></i></button>
                            <button onclick="fbToggleAutoPlay()" id="fb-play-btn" title="Putar Otomatis" class="fb-hide-xs" aria-label="Putar otomatis"><i class="fas fa-play-circle"></i></button>
                        </div>
                        {{-- GRUP TENGAH --}}
                        <div class="fb-toolbar-group">
                            <button onclick="fbFirst()" title="Halaman Pertama" class="fb-hide-md" aria-label="Halaman pertama"><i class="fas fa-step-backward"></i></button>
                            <button onclick="fbPrev()" title="Sebelumnya" aria-label="Halaman sebelumnya"><i class="fas fa-arrow-left"></i></button>
                            <div class="fb-page-info" id="fb-page-display" aria-live="polite">1/1</div>
                            <button onclick="fbNext()" title="Berikutnya" aria-label="Halaman berikutnya"><i class="fas fa-arrow-right"></i></button>
                            <button onclick="fbLast()" title="Halaman Terakhir" class="fb-hide-md" aria-label="Halaman terakhir"><i class="fas fa-step-forward"></i></button>
                        </div>
                        {{-- GRUP KANAN --}}
                        <div class="fb-toolbar-group">
                            <div class="fb-title-bar" id="fb-title-bar">Berita PLN Jambi</div>
                            <div style="width:1px;height:20px;background:#374151;" class="fb-hide-md" aria-hidden="true"></div>
                            <button onclick="fbPrintAll()" title="Export PDF" style="color:#ef4444;"
                                onmouseenter="this.style.color='#fff'" onmouseleave="this.style.color='#ef4444'" aria-label="Export PDF">
                                <i class="fas fa-file-pdf"></i></button>
                            <button onclick="fbToggleFullScreen()" title="Layar Penuh" aria-label="Layar penuh"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>

                    <div id="fb-thumbs" role="listbox" aria-label="Navigasi thumbnail"></div>

                    <div id="fb-viewport">
                        <button class="fb-nav" id="fb-prev" onclick="fbPrev()" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
                        <button class="fb-nav" id="fb-next" onclick="fbNext()" aria-label="Berikutnya"><i class="fas fa-chevron-right"></i></button>
                        <div id="fb-book-wrap">
                            <div id="fb-book"></div>
                        </div>
                        <div id="fb-single-wrap" style="display:none;width:100%;height:100%;">
                            <div class="fb-single-container">
                                <div class="fb-single-page" id="fb-single-page-el"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /FLIPBOOK MODAL -->

    <!-- ══ PRINT SECTION ══ -->
    <div id="print-section" aria-hidden="true">
        <div class="print-page print-cover">
            <div style="font-size:64pt;color:white;">⚡</div>
            <h1 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:28pt;font-weight:800;margin:16px 0 8px;color:white;">PLN UP3 JAMBI</h1>
            <p style="font-size:14pt;opacity:.85;color:white;">Galeri Berita Terkini</p>
            <p style="font-size:10pt;opacity:.6;margin-top:8px;color:white;">
                {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }} &nbsp;·&nbsp; {{ $semua_berita->count() }} Berita
            </p>
        </div>
        @foreach ($semua_berita as $i => $b)
            <div class="print-page">
                <div class="print-header">
                    <span>PLN UP3 JAMBI — Galeri Berita</span>
                    <span>Berita {{ $i + 1 }} / {{ $semua_berita->count() }}</span>
                </div>
                <div class="print-img-wrap">
                    <img src="{{ asset('assets/berita/' . $b->gambar) }}" alt="{{ $b->judul }}">
                </div>
                <div class="print-caption">
                    <h3>{{ $b->judul }}</h3>
                    <p>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ══ FOOTER ══ -->
    <footer class="main-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 pe-lg-5">
                    <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="60" class="mb-4" alt="Logo PLN" loading="lazy">
                    <p class="text-description"><strong>PT PLN (Persero) UP3 Jambi</strong> berkomitmen memberikan pelayanan kelistrikan handal untuk Jambi yang lebih terang.</p>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Navigasi</h5>
                    <ul class="footer-link-list">
                        <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                        <li><a href="#berita" class="footer-link">Berita Terkini</a></li>
                        <li><a href="#" class="footer-link">Galeri Foto</a></li>
                        <li><a href="{{ route('tentang.kami') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('profil.detail') }}" class="footer-link">Profil</a></li>
                        <li><a href="{{ route('tentang.kami') }}" class="footer-link">Budaya PLN</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="contact-item">
                        <div class="contact-icon bg-telp"><i class="fas fa-map-marker-alt"></i></div>
                        <span>Jl. Jenderal Urip Sumoharjo No.2, Jambi</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon bg-phone"><i class="fas fa-phone-alt"></i></div>
                        <span>Call Center: 123</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h5 class="footer-title">Ikuti Kami</h5>
                    <div class="d-flex align-items-center mb-3">
                        <a href="https://www.instagram.com/plnjambi/" target="_blank" rel="noopener" class="social-icon bg-instagram me-3" aria-label="Instagram PLN Jambi"><i class="fab fa-instagram"></i></a>
                        <span class="text-white">plnjambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <a href="https://www.facebook.com/mang.hemat" target="_blank" rel="noopener" class="social-icon bg-facebook me-3" aria-label="Facebook PLN Jambi"><i class="fab fa-facebook-f"></i></a>
                        <span class="text-white">plnjambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <a href="https://x.com/JambiPln" target="_blank" rel="noopener" aria-label="X (Twitter) PLN Jambi"
                           class="social-icon me-3 d-flex align-items-center justify-content-center"
                           style="background-color:#000;width:38px;height:38px;border-radius:8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" fill="white" aria-hidden="true">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                            </svg>
                        </a>
                        <span class="text-white">plnjambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <a href="https://www.tiktok.com/@pln.up3.jambi" target="_blank" rel="noopener" class="social-icon bg-tiktok me-3" aria-label="TikTok PLN UP3 Jambi"><i class="fab fa-tiktok"></i></a>
                        <span class="text-white">pln.up3.jambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <a href="https://www.youtube.com/@PLNUP3_JAMBI" target="_blank" rel="noopener" class="social-icon bg-youtube me-3" aria-label="YouTube PLN UP3 Jambi"><i class="fab fa-youtube"></i></a>
                        <span class="text-white">PLN UP3 Jambi Official</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container text-center">
                <p class="mb-0 small opacity-75">© {{ date('Y') }} <strong>PT PLN (Persero) UP3 Jambi</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <!-- Bootstrap JS — defer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <script>
    /* ════════════════════════════════════════════════════════════
       CSS ANIMASI FLIP MOBILE — inject sekali ke <head>
    ════════════════════════════════════════════════════════════ */
    (function() {
        var s = document.createElement('style');
        s.textContent = [
            '#fb-single-page-el { perspective:1200px; transform-style:preserve-3d; }',
            '@keyframes fb-enter-right { 0%{opacity:0;transform:translateX(60px) rotateY(-12deg) scale(.96)} 60%{opacity:1;transform:translateX(-6px) rotateY(2deg) scale(1.005)} 100%{opacity:1;transform:translateX(0) rotateY(0) scale(1)} }',
            '@keyframes fb-enter-left  { 0%{opacity:0;transform:translateX(-60px) rotateY(12deg) scale(.96)} 60%{opacity:1;transform:translateX(6px) rotateY(-2deg) scale(1.005)} 100%{opacity:1;transform:translateX(0) rotateY(0) scale(1)} }',
            '@keyframes fb-exit-left   { 0%{opacity:1;transform:translateX(0) rotateY(0) scale(1)} 100%{opacity:0;transform:translateX(-60px) rotateY(12deg) scale(.96)} }',
            '@keyframes fb-exit-right  { 0%{opacity:1;transform:translateX(0) rotateY(0) scale(1)} 100%{opacity:0;transform:translateX(60px) rotateY(-12deg) scale(.96)} }',
            '.fb-anim-enter-right{animation:fb-enter-right .42s cubic-bezier(.25,.46,.45,.94) forwards}',
            '.fb-anim-enter-left {animation:fb-enter-left  .42s cubic-bezier(.25,.46,.45,.94) forwards}',
            '.fb-anim-exit-left  {animation:fb-exit-left   .22s cubic-bezier(.55,0,.1,1)      forwards}',
            '.fb-anim-exit-right {animation:fb-exit-right  .22s cubic-bezier(.55,0,.1,1)      forwards}',
            '@keyframes fb-cover-in { 0%{opacity:0;transform:scale(.9) rotateY(-8deg)} 100%{opacity:1;transform:scale(1) rotateY(0)} }',
            '.fb-anim-cover{animation:fb-cover-in .5s cubic-bezier(.25,.46,.45,.94) forwards}',
            '@keyframes fb-shadow-sweep-r { 0%{background:linear-gradient(to left,rgba(0,0,0,.18) 0%,transparent 50%);opacity:1} 100%{opacity:0} }',
            '@keyframes fb-shadow-sweep-l { 0%{background:linear-gradient(to right,rgba(0,0,0,.18) 0%,transparent 50%);opacity:1} 100%{opacity:0} }',
            '.fb-page-shadow{position:absolute;inset:0;border-radius:12px;pointer-events:none;z-index:10}',
            '.fb-page-shadow.sweep-r{animation:fb-shadow-sweep-r .42s ease forwards}',
            '.fb-page-shadow.sweep-l{animation:fb-shadow-sweep-l .42s ease forwards}',
        ].join('\n');
        document.head.appendChild(s);
    })();

    /* ════════════════════════════════════════════════════════════
       DATA BLADE
    ════════════════════════════════════════════════════════════ */
    var semuaBerita = {!! json_encode(
        $semua_berita->values()->map(fn($b) => [
            'id'      => $b->id,
            'judul'   => $b->judul,
            'gambar'  => $b->gambar,
            'tanggal' => $b->tanggal,
        ])
    ) !!};
    var dataBerita = {!! json_encode(
        array_values(
            $data_berita->map(fn($b) => [
                'id'      => $b->id,
                'judul'   => $b->judul,
                'gambar'  => $b->gambar,
                'tanggal' => $b->tanggal,
            ])->toArray()
        )
    ) !!};

    /* ════════════════════════════════════════════════════════════
       LAZY LOAD MASONRY — IntersectionObserver
    ════════════════════════════════════════════════════════════ */
    (function() {
        var imgs = document.querySelectorAll('img[data-src]');
        if (!imgs.length) return;
        if (!('IntersectionObserver' in window)) {
            imgs.forEach(function(img) { img.src = img.dataset.src; });
            return;
        }
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;
                var img = entry.target.querySelector('img[data-src]');
                if (!img) return;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                obs.unobserve(entry.target);
            });
        }, { rootMargin: '300px 0px', threshold: 0 });
        document.querySelectorAll('.masonry-item').forEach(function(item) { obs.observe(item); });
    })();

    /* ════════════════════════════════════════════════════════════
       FLIPBOOK STATE
    ════════════════════════════════════════════════════════════ */
    var fbZoom           = 1;
    var fbAutoPlay       = null;
    var fbBookInited     = false;
    var fbMobileInited   = false;
    var fbTotalPages     = 0;
    var fbOpenedAt       = 0;
    var fbModalInstance  = null;   /* simpan instance tunggal, hindari memory leak */
    var fbMobilePage     = 0;
    var fbMobileAnimating = false;
    var fbSwipeSetup     = false;  /* flag: cegah duplikasi event listener swipe */

    /* ── Preload gambar ── */
    var _imgCache = {};
    function preloadImg(src) {
        if (_imgCache[src]) return;
        var img = new Image(); img.src = src; _imgCache[src] = img;
    }
    function preloadAround(idx) {
        for (var i = idx; i < Math.min(idx + 3, semuaBerita.length); i++) {
            preloadImg('/assets/berita/' + semuaBerita[i].gambar);
        }
    }

    /* ════════════════════════════════════════════════════════════
       OPEN FLIPBOOK
    ════════════════════════════════════════════════════════════ */
    function openFlipbook(gridIndex) {
        var clickedId = dataBerita[gridIndex] ? dataBerita[gridIndex].id : null;
        var allIndex  = semuaBerita.findIndex(function(b) { return b.id === clickedId; });
        fbOpenedAt    = allIndex >= 0 ? allIndex : 0;

        /* Buat instance Bootstrap Modal hanya sekali */
        if (!fbModalInstance) {
            fbModalInstance = new bootstrap.Modal(document.getElementById('flipbookModal'));
        }
        fbModalInstance.show();
        document.getElementById('fb-loading').style.display = 'flex';
        document.body.style.overflow = 'hidden';
        preloadAround(fbOpenedAt);

        if (isMobile()) {
            document.getElementById('fb-book-wrap').style.display  = 'none';
            document.getElementById('fb-single-wrap').style.display = 'block';
            fbMobilePage = fbOpenedAt + 1;
            setTimeout(function() {
                document.getElementById('fb-loading').style.display = 'none';
                renderMobilePage(fbMobilePage, 'none');
                buildThumbs();
                fbMobileInited = true;
                if (!fbSwipeSetup) { setupSwipe(); fbSwipeSetup = true; }
            }, 180);
        } else {
            document.getElementById('fb-book-wrap').style.display  = '';
            document.getElementById('fb-single-wrap').style.display = 'none';
            _loadFlipbookDeps(function() {
                if (!fbBookInited) {
                    buildFlipbook();
                } else {
                    setTimeout(function() {
                        jumpToNews(fbOpenedAt);
                        document.getElementById('fb-loading').style.display = 'none';
                    }, 120);
                }
            });
        }
    }

    function fbClose() {
        if (fbAutoPlay) { clearInterval(fbAutoPlay); fbAutoPlay = null; fbResetPlayBtn(); }
        if (fbModalInstance) fbModalInstance.hide();
        document.body.style.overflow = '';
    }

    function isMobile() {
        return window.innerWidth < 768 || ('ontouchstart' in window && window.innerWidth < 992);
    }

    /* ════════════════════════════════════════════════════════════
       MOBILE VIEWER — ANIMASI FLIP
       dir: 'next' | 'prev' | 'none'
    ════════════════════════════════════════════════════════════ */
    function getMobileTotal() { return semuaBerita.length + 1; }

    function renderMobilePage(page, dir) {
        page = Math.max(0, Math.min(page, getMobileTotal() - 1));
        if (dir === undefined) dir = 'next';
        if (fbMobileAnimating && dir !== 'none') return;

        var el = document.getElementById('fb-single-page-el');
        var vp = document.getElementById('fb-viewport');

        var vw = vp.offsetWidth - 20, vh = vp.offsetHeight - 20;
        var ratio = 1.4, pw, ph;
        if (vw * ratio <= vh) { pw = vw; ph = Math.round(vw * ratio); }
        else { ph = vh; pw = Math.round(vh / ratio); }

        var newHTML = buildMobilePageHTML(page, pw, ph);

        if (dir === 'none') {
            fbMobilePage = page;
            el.style.width  = pw + 'px';
            el.style.height = ph + 'px';
            el.innerHTML    = newHTML;
            el.className    = '';
            void el.offsetWidth;
            el.classList.add(page === 0 ? 'fb-anim-cover' : 'fb-anim-enter-right');
            updateFbPageInfoMobile(page);
            updateThumbActive(page);
            updateTitleBarMobile(page);
            preloadAround(page);
            return;
        }

        fbMobileAnimating = true;
        var exitClass = dir === 'next' ? 'fb-anim-exit-left' : 'fb-anim-exit-right';
        el.className = '';
        void el.offsetWidth;
        el.classList.add(exitClass);

        var oldShadow = el.querySelector('.fb-page-shadow');
        if (oldShadow) oldShadow.remove();
        var shadow = document.createElement('div');
        shadow.className = 'fb-page-shadow ' + (dir === 'next' ? 'sweep-r' : 'sweep-l');
        el.appendChild(shadow);

        setTimeout(function() {
            fbMobilePage    = page;
            el.style.width  = pw + 'px';
            el.style.height = ph + 'px';
            el.innerHTML    = newHTML;
            el.className    = '';
            void el.offsetWidth;
            el.classList.add(page === 0 ? 'fb-anim-cover' : (dir === 'next' ? 'fb-anim-enter-right' : 'fb-anim-enter-left'));
            updateFbPageInfoMobile(page);
            updateThumbActive(page);
            updateTitleBarMobile(page);
            preloadAround(page);
            setTimeout(function() { fbMobileAnimating = false; }, 450);
        }, 230);
    }

    function buildMobilePageHTML(page, pw, ph) {
        if (page === 0) {
            return '<div class="fb-single-cover" style="border-radius:12px;width:' + pw + 'px;height:' + ph + 'px;">' +
                '<div style="font-size:48px;margin-bottom:14px;">⚡</div>' +
                '<h2 style="font-family:\'Plus Jakarta Sans\',sans-serif;font-weight:800;font-size:1.3rem;margin:0 0 6px;color:#fff;">PLN UP3 JAMBI</h2>' +
                '<p style="font-size:.8rem;opacity:.85;margin:0;color:#fff;">Galeri Berita Terkini</p>' +
                '<div style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:20px;padding:3px 14px;font-size:.7rem;margin-top:14px;color:#fff;">' +
                new Date().toLocaleDateString('id-ID',{year:'numeric',month:'long',day:'numeric'}) + '</div>' +
                '<div style="background:var(--primary);color:white;border-radius:50%;width:64px;height:64px;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:16px auto 0;">' +
                '<span style="font-size:1.3rem;font-weight:800;line-height:1;">' + semuaBerita.length + '</span>' +
                '<span style="font-size:.55rem;opacity:.8;">BERITA</span></div></div>';
        }
        var b   = semuaBerita[page - 1];
        var tgl = new Date(b.tanggal).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
        return '<div class="fb-page-inner" style="border-radius:12px;overflow:hidden;width:' + pw + 'px;height:' + ph + 'px;position:relative;">' +
            '<img src="/assets/berita/' + b.gambar + '" alt="' + escHtml(b.judul) + '"' +
            ' loading="eager" decoding="async"' +
            ' style="width:100%;height:100%;object-fit:cover;display:block;-webkit-user-drag:none;user-select:none;pointer-events:none;"' +
            ' onerror="this.src=\'https://placehold.co/400x560/1a1a4e/fff?text=Foto+Tidak+Tersedia\'">' +
            '<div class="fb-caption">' +
            '<span class="fb-cap-date"><i class="far fa-calendar-alt me-1"></i>' + tgl + '</span>' +
            '<p class="fb-cap-title">' + escHtml(b.judul) + '</p></div>' +
            '<div class="fb-pg-num">' + page + '</div></div>';
    }

    function updateFbPageInfoMobile(page) {
        document.getElementById('fb-page-display').textContent =
            page === 0 ? 'Cover' : (page + ' / ' + semuaBerita.length);
    }
    function updateTitleBarMobile(page) {
        document.getElementById('fb-title-bar').textContent =
            (page > 0 && semuaBerita[page - 1]) ? semuaBerita[page - 1].judul : 'Berita PLN UP3 Jambi';
    }

    /* ════════════════════════════════════════════════════════════
       DESKTOP FLIPBOOK (turn.js)
    ════════════════════════════════════════════════════════════ */
    function buildFlipbook() {
        var book = document.getElementById('fb-book');
        book.innerHTML = '';
        book.appendChild(makeCoverLeft());
        book.appendChild(makeCoverRight());
        semuaBerita.forEach(function(b, i) { book.appendChild(makeNewsPage(b, i)); });

        fbTotalPages = 2 + semuaBerita.length;
        var sz = calcBookSize();
        $(book).turn({
            width: sz.w, height: sz.h, autoCenter: true,
            duration: 800, gradients: true, elevation: 50,
            when: {
                turned: function(e, page) {
                    updateFbPageInfo(page);
                    updateThumbActive(page - 1);
                    updateTitleBar(page);
                    if (page >= 3) preloadAround(page - 2);
                }
            }
        });
        fbBookInited = true;
        buildThumbs();
        document.querySelectorAll('.fb-page').forEach(function(p) {
            p.style.width  = (sz.w / 2) + 'px';
            p.style.height = sz.h + 'px';
        });
        setTimeout(function() {
            document.getElementById('fb-loading').style.display = 'none';
            updateFbPageInfo(1);
            jumpToNews(fbOpenedAt);
        }, 280);
        if (!fbSwipeSetup) { setupSwipe(); fbSwipeSetup = true; }
        document.addEventListener('dragstart',   function(e) { e.preventDefault(); });
        document.addEventListener('contextmenu', function(e) { e.preventDefault(); });
    }

    function calcBookSize() {
        var vw = window.innerWidth, vh = window.innerHeight - 60;
        var maxW = Math.min(vw - 60, 1000), maxH = vh - 30;
        var pageH = Math.min(Math.round(maxW / 2 * 1.38), maxH);
        var pageW = Math.round(pageH / 1.38) * 2;
        return { w: pageW, h: pageH };
    }

    function makeCoverLeft() {
        var d = document.createElement('div');
        d.className = 'fb-page';
        d.innerHTML = '<div class="fb-cover" style="width:100%;height:100%;">' +
            '<div style="position:absolute;inset:0;opacity:.07;background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:24px 24px;"></div>' +
            '<div style="font-size:52px;margin-bottom:16px;position:relative;">⚡</div>' +
            '<h2 style="font-family:\'Plus Jakarta Sans\',sans-serif;font-weight:800;font-size:1.5rem;margin:0 0 8px;position:relative;">PLN UP3 JAMBI</h2>' +
            '<p style="font-size:.85rem;opacity:.85;margin:0;position:relative;">Galeri Berita Terkini</p>' +
            '<div style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:20px;padding:4px 16px;font-size:.75rem;margin-top:16px;position:relative;">' +
            new Date().toLocaleDateString('id-ID',{year:'numeric',month:'long',day:'numeric'}) + '</div></div>';
        return d;
    }

    function makeCoverRight() {
        var d = document.createElement('div');
        d.className = 'fb-page';
        d.innerHTML =
            '<div style="width:100%;height:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;background:linear-gradient(145deg,#0a0a2e,#1a1a4e);color:white;text-align:center;padding:40px 30px;">' +
            '<div style="background:var(--primary);color:white;border-radius:50%;width:80px;height:80px;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:0 auto 20px;">' +
            '<span style="font-size:1.6rem;font-weight:800;line-height:1;">' + semuaBerita.length + '</span>' +
            '<span style="font-size:.6rem;opacity:.8;">BERITA</span></div>' +
            '<h3 style="font-family:\'Plus Jakarta Sans\',sans-serif;font-weight:800;font-size:1.1rem;margin-bottom:12px;">Daftar Berita</h3>' +
            '<p style="font-size:.8rem;color:#9ca3af;line-height:1.6;max-width:240px;">Klik gambar di beranda untuk langsung membuka halaman berita terkait.</p></div>';
        return d;
    }

    function makeNewsPage(b, i) {
        var d   = document.createElement('div');
        d.className = 'fb-page';
        var tgl = new Date(b.tanggal).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
        d.innerHTML = '<div class="fb-page-inner">' +
            '<img src="/assets/berita/' + b.gambar + '" alt="' + escHtml(b.judul) + '"' +
            ' loading="lazy" decoding="async"' +
            ' onerror="this.src=\'https://placehold.co/400x560/1a1a4e/fff?text=Foto+Tidak+Tersedia\'">' +
            '<div class="fb-caption">' +
            '<span class="fb-cap-date"><i class="far fa-calendar-alt me-1"></i>' + tgl + '</span>' +
            '<p class="fb-cap-title">' + escHtml(b.judul) + '</p></div>' +
            '<div class="fb-pg-num">' + (i + 1) + '</div></div>';
        return d;
    }

    function escHtml(s) {
        return String(s)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function jumpToNews(idx) {
        if (!fbBookInited) return;
        var p = idx + 3;
        $('#fb-book').turn('page', p);
        updateFbPageInfo(p);
        updateThumbActive(p - 1);
        updateTitleBar(p);
    }

    function updateFbPageInfo(page) {
        var lbl = page === 1 ? 'Cover' : page === 2 ? 'Daftar' : ('Berita ' + (page - 2) + ' / ' + semuaBerita.length);
        document.getElementById('fb-page-display').textContent = lbl;
    }
    function updateTitleBar(page) {
        document.getElementById('fb-title-bar').textContent =
            (page >= 3 && semuaBerita[page - 3]) ? semuaBerita[page - 3].judul : 'Berita PLN UP3 Jambi';
    }

    /* ════════════════════════════════════════════════════════════
       THUMBNAILS — dengan nomor halaman + penanda aktif
    ════════════════════════════════════════════════════════════ */
    function buildThumbs() {
        var strip = document.getElementById('fb-thumbs');
        strip.innerHTML = '';

        /* ── Cover thumbnail ── */
        var covWrap = document.createElement('div');
        covWrap.className   = 'fb-thumb-wrap active';
        covWrap.setAttribute('role', 'option');
        covWrap.setAttribute('aria-label', 'Cover');
        covWrap.setAttribute('aria-selected', 'true');
        covWrap.innerHTML =
            '<div class="fb-thumb"><div class="fb-thumb-cover">⚡</div></div>' +
            '<div class="fb-thumb-label">Cover</div>';
        covWrap.onclick = function() {
            isMobile() ? renderMobilePage(0, 'prev') : $('#fb-book').turn('page', 1);
        };
        strip.appendChild(covWrap);

        /* ── Per-berita thumbnail ── */
        semuaBerita.forEach(function(b, i) {
            var wrap = document.createElement('div');
            wrap.className = 'fb-thumb-wrap';
            wrap.id        = 'fb-th-' + (i + 1);
            wrap.setAttribute('role', 'option');
            wrap.setAttribute('aria-label', 'Berita ' + (i + 1));
            wrap.setAttribute('aria-selected', 'false');
            wrap.innerHTML =
                '<div class="fb-thumb">' +
                '<img src="/assets/berita/' + b.gambar + '" alt="" loading="lazy" decoding="async"' +
                ' onerror="this.src=\'https://placehold.co/48x64/1a1a4e/fff?text=' + (i+1) + '\'">' +
                '</div>' +
                '<div class="fb-thumb-label">' + (i + 1) + '</div>';
            wrap.onclick = (function(idx) {
                return function() {
                    if (isMobile()) {
                        var dir = (idx + 1) > fbMobilePage ? 'next' : 'prev';
                        renderMobilePage(idx + 1, dir);
                    } else {
                        jumpToNews(idx);
                    }
                };
            })(i);
            strip.appendChild(wrap);
        });
    }

    function updateThumbActive(zeroPage) {
        var wraps = document.querySelectorAll('.fb-thumb-wrap');
        wraps.forEach(function(w, i) {
            var isActive = (i === zeroPage);
            w.classList.toggle('active', isActive);
            w.setAttribute('aria-selected', isActive ? 'true' : 'false');
            if (isActive) w.scrollIntoView({ block:'nearest', inline:'center', behavior:'smooth' });
        });
    }

    /* ════════════════════════════════════════════════════════════
       CONTROLS
    ════════════════════════════════════════════════════════════ */
    function fbNext() {
        if (isMobile()) { renderMobilePage(fbMobilePage + 1, 'next'); }
        else { $('#fb-book').turn('next'); }
    }
    function fbPrev() {
        if (isMobile()) { renderMobilePage(fbMobilePage - 1, 'prev'); }
        else { $('#fb-book').turn('previous'); }
    }
    function fbFirst() { isMobile() ? renderMobilePage(0, 'prev') : $('#fb-book').turn('page', 1); }
    function fbLast()  { isMobile() ? renderMobilePage(getMobileTotal() - 1, 'next') : $('#fb-book').turn('page', fbTotalPages); }

    function fbZoomIn()  { if (fbZoom < 2)  { fbZoom += .2; applyFbZoom(); } }
    function fbZoomOut() { if (fbZoom > .6) { fbZoom -= .2; applyFbZoom(); } }
    function applyFbZoom() {
        var wrap = isMobile()
            ? document.getElementById('fb-single-wrap')
            : document.getElementById('fb-book-wrap');
        wrap.style.transform = 'scale(' + fbZoom + ')';
    }

    function fbToggleFullScreen() {
        if (!document.fullscreenElement) document.documentElement.requestFullscreen().catch(function(){});
        else document.exitFullscreen();
    }
    function fbToggleThumbs() { document.getElementById('fb-thumbs').classList.toggle('show'); }
    function fbResetPlayBtn() { document.getElementById('fb-play-btn').innerHTML = '<i class="fas fa-play-circle"></i>'; }
    function fbToggleAutoPlay() {
        if (fbAutoPlay) { clearInterval(fbAutoPlay); fbAutoPlay = null; fbResetPlayBtn(); }
        else { document.getElementById('fb-play-btn').innerHTML = '<i class="fas fa-pause-circle"></i>'; fbAutoPlay = setInterval(fbNext, 3000); }
    }

    /* ── PRINT ── */
    function fbPrintAll() {
        if (fbModalInstance) fbModalInstance.hide();
        setTimeout(function() {
            window.print();
            window.addEventListener('afterprint', function onAP() {
                window.removeEventListener('afterprint', onAP);
                if (fbModalInstance) fbModalInstance.show();
            });
        }, 400);
    }

    /* ════════════════════════════════════════════════════════════
       SWIPE — attach sekali, cegah duplikasi
    ════════════════════════════════════════════════════════════ */
    var _sX = 0, _sY = 0, _sActive = false;
    var _mDown = false, _mX = 0;

    function setupSwipe() {
        var vp = document.getElementById('fb-viewport');
        vp.addEventListener('touchstart', function(e) {
            _sX = e.touches[0].clientX; _sY = e.touches[0].clientY; _sActive = true;
        }, { passive: true });
        vp.addEventListener('touchend', function(e) {
            if (!_sActive) return; _sActive = false;
            var dx = _sX - e.changedTouches[0].clientX;
            var dy = Math.abs(_sY - e.changedTouches[0].clientY);
            if (Math.abs(dx) > 40 && Math.abs(dx) > dy) { dx > 0 ? fbNext() : fbPrev(); }
        }, { passive: true });
        vp.addEventListener('touchmove', function(e) {
            if (!_sActive) return;
            var dx = Math.abs(_sX - e.touches[0].clientX);
            var dy = Math.abs(_sY - e.touches[0].clientY);
            if (dx > dy && dx > 10) e.preventDefault();
        }, { passive: false });
        vp.addEventListener('mousedown', function(e) { _mDown = true; _mX = e.clientX; });
        vp.addEventListener('mouseup',   function(e) {
            if (!_mDown) return; _mDown = false;
            var dx = _mX - e.clientX;
            if (Math.abs(dx) > 50) { dx > 0 ? fbNext() : fbPrev(); }
        });
    }

    /* ── RESIZE ── */
    var _rt;
    window.addEventListener('resize', function() {
        clearTimeout(_rt);
        _rt = setTimeout(function() {
            if (isMobile()) {
                if (fbMobileInited) renderMobilePage(fbMobilePage, 'none');
            } else {
                if (!fbBookInited) return;
                var sz = calcBookSize();
                $('#fb-book').turn('size', sz.w, sz.h);
                document.querySelectorAll('.fb-page').forEach(function(p) {
                    p.style.width  = (sz.w / 2) + 'px';
                    p.style.height = sz.h + 'px';
                });
            }
        }, 150);
    });

    /* ── KEYBOARD ── */
    document.addEventListener('keydown', function(e) {
        var m = document.getElementById('flipbookModal');
        if (!m || !m.classList.contains('show')) return;
        if (e.key === 'ArrowRight') fbNext();
        if (e.key === 'ArrowLeft')  fbPrev();
        if (e.key === 'Escape')     fbClose();
    });

    /* ── RESET SAAT MODAL DITUTUP ── */
    document.getElementById('flipbookModal').addEventListener('hidden.bs.modal', function() {
        if (fbAutoPlay) { clearInterval(fbAutoPlay); fbAutoPlay = null; fbResetPlayBtn(); }
        fbZoom            = 1;
        fbMobileAnimating = false;
        document.getElementById('fb-book-wrap').style.transform   = '';
        document.getElementById('fb-single-wrap').style.transform = '';
        document.getElementById('fb-thumbs').classList.remove('show');
        document.body.style.overflow = '';
    });
    </script>

</body>
</html>