<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tentang Kami - PLN UP3 JAMBI</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary: #00a2e9;
            --secondary: #ffc107;
            --dark-blue: #005691;
            --orange-pln: #ff6600;
            --light-bg: #f4f7f9;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .navbar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ══════════════════════════════════════════
           TOPBAR
        ══════════════════════════════════════════ */
        .topbar {
            background: #f8f9fa;
            font-size: 13px;
            border-bottom: 1px solid #eee;
        }

        /* ══════════════════════════════════════════
           NAVBAR — Desktop unchanged, Mobile = Drawer
        ══════════════════════════════════════════ */
        .navbar {
            padding: 15px 0;
            transition: all .3s;
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            font-weight: 600;
            color: #444 !important;
            transition: .3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important;
        }

        @media (max-width:991px) {
            .navbar-collapse {
                display: none !important;
            }
        }

        /* ── CUSTOM HAMBURGER BUTTON ── */
        .drawer-toggle {
            background: none;
            border: none;
            cursor: pointer;
            width: 44px;
            height: 44px;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            border-radius: 10px;
            transition: background .2s;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }

        .drawer-toggle span {
            display: block;
            width: 24px;
            height: 2.5px;
            background: #333;
            border-radius: 4px;
            transition: all .3s;
        }

        .drawer-toggle.open span:nth-child(1) {
            transform: translateY(7.5px) rotate(45deg);
        }

        .drawer-toggle.open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .drawer-toggle.open span:nth-child(3) {
            transform: translateY(-7.5px) rotate(-45deg);
        }

        @media (max-width:991px) {
            .drawer-toggle {
                display: flex;
            }
        }

        /* ── DRAWER OVERLAY ── */
        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: opacity .3s, visibility .3s;
            -webkit-tap-highlight-color: transparent;
        }

        .drawer-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* ── DRAWER PANEL ── */
        .drawer-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: min(300px, 80vw);
            height: 100%;
            height: 100dvh;
            background: #fff;
            z-index: 1050;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4, 0, .2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            box-shadow: -8px 0 40px rgba(0, 0, 0, .15);
        }

        .drawer-panel.open {
            transform: translateX(0);
        }

        .drawer-header {
            background: linear-gradient(135deg, #005691, #00a2e9);
            padding: 20px 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .drawer-header .drawer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .drawer-header .drawer-logo img {
            height: 36px;
            filter: brightness(0) invert(1);
        }

        .drawer-header .drawer-logo-text h3 {
            color: #fff;
            font-size: .95rem;
            font-weight: 800;
            margin: 0;
        }

        .drawer-header .drawer-logo-text small {
            color: rgba(255, 255, 255, .7);
            font-size: .65rem;
            letter-spacing: 1px;
            display: block;
        }

        .drawer-close {
            background: rgba(255, 255, 255, .2);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            flex-shrink: 0;
            -webkit-tap-highlight-color: transparent;
            transition: background .2s;
        }

        .drawer-close:hover {
            background: rgba(255, 255, 255, .35);
        }

        .drawer-body {
            flex: 1;
            padding: 10px 0;
        }

        .drawer-nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px 22px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: .95rem;
            border-left: 3px solid transparent;
            transition: all .2s;
            -webkit-tap-highlight-color: transparent;
        }

        .drawer-nav-item:hover,
        .drawer-nav-item.active {
            background: #f0f7ff;
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .drawer-nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
            color: var(--primary);
            flex-shrink: 0;
        }

        .drawer-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 8px 16px;
        }

        .drawer-footer {
            padding: 16px 22px;
            border-top: 1px solid #f0f0f0;
            flex-shrink: 0;
        }

        .drawer-footer .pln-mobile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #005691, #00a2e9);
            color: #fff;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: .85rem;
            font-weight: 600;
            transition: opacity .2s;
            -webkit-tap-highlight-color: transparent;
        }

        .drawer-footer .pln-mobile-btn:hover {
            opacity: .9;
        }

        .drawer-footer .pln-mobile-btn img {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
           SIDEBAR STICKY (Desktop)
        ══════════════════════════════════════════ */
        .sidebar {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: -webkit-sticky;
            position: sticky;
            top: 100px;
            z-index: 10;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-weight: 600;
        }

        .sidebar-link i {
            width: 30px;
            color: var(--primary);
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: #00a2e9 !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(0, 162, 233, 0.4);
            transform: translateX(5px);
        }

        .sidebar-link:hover i,
        .sidebar-link.active i {
            color: white !important;
        }

        /* Responsive Fix untuk Sidebar */
        @media (max-width: 991px) {
            .sidebar {
                position: relative;
                top: 0;
                margin-bottom: 30px;
            }
        }

        /* ══════════════════════════════════════════
           CONTENT CARDS
        ══════════════════════════════════════════ */
        .about-card {
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .about-card {
                padding: 25px 20px;
                border-radius: 20px;
            }
        }

        .section-badge {
            display: inline-block;
            padding: 5px 15px;
            background: rgba(0, 162, 233, 0.1);
            color: var(--primary);
            border-radius: 50px;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .mission-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .mission-icon {
            color: var(--primary);
            margin-right: 15px;
            margin-top: 5px;
            font-size: 1.2rem;
        }

        .mission-text {
            flex: 1;
        }

        .transform-box {
            background: #f8fbfe;
            border-radius: 15px;
            padding: 20px;
            border-top: 4px solid var(--primary);
            height: 100%;
            transition: 0.3s;
        }

        .transform-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        /* ══════════════════════════════════════════
           HEADER MINI
        ══════════════════════════════════════════ */
        .header-mini {
            background: linear-gradient(135deg, var(--dark-blue), var(--primary));
            padding: 60px 0;
            color: white;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px;
        }

        @media (max-width: 768px) {
            .header-mini {
                padding: 40px 0;
                border-radius: 0 0 30px 30px;
            }

            .header-mini h1 {
                font-size: 2rem !important;
            }
        }

        /* ══════════════════════════════════════════
           MARQUEE
        ══════════════════════════════════════════ */
        marquee {
            background: var(--secondary);
            color: #000;
            padding: 10px 0;
            font-weight: 700;
            font-size: .85rem;
        }

        /* ══════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════ */
        .main-footer {
            background-color: #1a8a9d;
            color: white;
            padding: 60px 0 0 0;
            font-size: 0.85rem;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .footer-title {
            font-weight: 700;
            margin-bottom: 25px;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .text-description {
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
        }

        .footer-link-list {
            list-style: none;
            padding: 0;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-bottom: 12px;
        }

        .footer-link:hover {
            color: #ffffff;
            transform: translateX(5px);
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.85rem;
            flex-shrink: 0;
            color: white;
            transform: translateY(-2px);
        }

        .social-icon {
            width: 38px;
            height: 38px;
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-icon:hover {
            transform: translateX(5px);
            filter: brightness(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .bg-telp {
            background-color: #4db34d;
        }

        .bg-phone {
            background-color: #e62e8a;
        }

        .bg-email {
            background-color: #f7941d;
        }

        .bg-facebook {
            background-color: #3b5998;
        }

        .bg-twitter {
            background-color: #55acee;
        }

        .bg-instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #bc1888);
        }

        .bg-tiktok {
            background-color: #000000;
        }

        .bg-youtube {
            background-color: #fc2a2a;
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.15);
            padding: 25px 0;
            margin-top: 50px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ══════════════════════════════════════════
           MOBILE RESPONSIVE
        ══════════════════════════════════════════ */
        @media (max-width: 768px) {
            .main-footer {
                text-align: left;
                padding: 40px 0 0;
            }

            .footer-title {
                font-size: .9rem;
                margin-bottom: 20px;
            }

            .text-description {
                font-size: .8rem;
            }

            .contact-item {
                font-size: .85rem;
            }
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
                    <small class="text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">KELISTRIKAN
                        JAMBI</small>
                </div>
            </a>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('tentang.kami') }}" class="nav-link active">Tentang Kami</a></li>
                    <li class="nav-item ms-lg-3 d-flex align-items-center">
                        <a href="https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id"
                            id="pln-mobile-link" title="PLN Mobile" target="_blank">
                            <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile"
                                style="width: 35px; height: 35px; border-radius: 10px; object-fit: cover; box-shadow: 0 4px 8px rgba(0,0,0,0.15); transition: transform 0.2s;">
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-light border text-dark rounded-circle d-flex align-items-center justify-content-center"
                            style="width:42px; height:42px;">
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
            <button class="drawer-close" id="drawerClose" aria-label="Tutup menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="drawer-body">
            <a href="{{ url('/') }}" class="drawer-nav-item"><i class="fas fa-home"></i><span>Beranda</span></a>
            <a href="{{ route('tentang.kami') }}" class="drawer-nav-item active"><i class="fas fa-building"></i><span>Tentang Kami</span></a>
            <div class="drawer-divider"></div>
            <a href="{{ route('profil.detail') }}" class="drawer-nav-item"><i class="fas fa-user"></i><span>Profil</span></a>
            <a href="{{ route('tentang.kami') }}" class="drawer-nav-item"><i class="fas fa-handshake"></i><span>Budaya PLN</span></a>
            <div class="drawer-divider"></div>
            <a href="{{ route('login') }}" class="drawer-nav-item"><i class="fas fa-user-lock"></i><span>Admin Login</span></a>
        </nav>
        <div class="drawer-footer">
            <a href="#" id="pln-mobile-link-drawer" class="pln-mobile-btn" target="_blank">
                <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile">
                <div>
                    <div style="font-size:.8rem;font-weight:700;">PLN Mobile</div>
                    <div style="font-size:.7rem;opacity:.8;">Download Sekarang</div>
                </div>
                <i class="fas fa-external-link-alt ms-auto" style="font-size:.8rem;opacity:.7;"></i>
            </a>
        </div>
    </div>

    <marquee scrollamount="6">⚡ LAYANAN LISTRIK JAMBI KINI LEBIH MUDAH DENGAN APLIKASI PLN MOBILE — DOWNLOAD DI
        PLAYSTORE & APPSTORE ⚡</marquee>

    <div class="header-mini text-center animate__animated animate__fadeIn">
        <div class="container">
            <h1 class="fw-800 display-5">PLN UP3 JAMBI</h1>
            <p class="opacity-75">Mengenal lebih dekat PLN Unit Pelaksana Pelayanan Pelanggan Jambi</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div id="sidebar-nav" class="sidebar animate__animated animate__fadeInLeft">
                    <h6 class="fw-bold mb-4 text-uppercase small text-muted">Navigasi Profil</h6>
                    <nav class="nav flex-column p-0">
                        <a href="#siapa-kami" class="sidebar-link active">
                            <i class="fas fa-handshake"></i> BUDAYA PLN
                        </a>
                        <a href="{{ route('profil.detail') }}" class="sidebar-link">
                            <i class="fas fa-user"></i> PROFIL
                        </a>
                    </nav>
                    <hr>
                    <div class="p-2 text-center">
                        <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="40" class="mb-2 opacity-50">
                        <p class="small text-muted mb-0">Terus Terang Melayani Negeri</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div id="siapa-kami" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Siapa Kami</span>
                    <h2 class="fw-800 mb-4">Menerangi Jambi, Menggerakkan Ekonomi</h2>
                    <p class="lead text-muted">PLN UP3 Jambi berkomitmen untuk menyediakan energi handal bagi seluruh
                        pelosok Jambi, mendukung pertumbuhan industri, dan meningkatkan kualitas hidup masyarakat
                        melalui layanan kelistrikan terbaik.</p>
                </div>

                <div id="visi" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Visi & Misi</span>
                    <div class="mb-5">
                        <h4 class="fw-bold text-dark"><i class="fas fa-eye text-warning me-2"></i> Visi Kami</h4>
                        <blockquote class="blockquote bg-light p-4 rounded-3 border-start border-primary border-5">
                            <p class="fw-bold mb-0">"MENJADI TOP 500 GLOBAL COMPANY DAN #1 PILIHAN PELANGGAN UNTUK
                                SOLUSI ENERGI"</p>
                        </blockquote>
                    </div>

                    <h5 class="fw-bold mb-3">Misi Kami:</h5>
                    <div class="mission-item">
                        <div class="mission-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="mission-text">Menjalankan bisnis kelistrikan dan bidang lain yang terkait,
                            berorientasi pada kepuasan pelanggan.</div>
                    </div>
                    <div class="mission-item">
                        <div class="mission-icon"><i class="fas fa-lightbulb"></i></div>
                        <div class="mission-text">Menjadikan tenaga listrik sebagai media untuk meningkatkan kualitas
                            kehidupan masyarakat.</div>
                    </div>
                    <div class="mission-item">
                        <div class="mission-icon"><i class="fas fa-leaf"></i></div>
                        <div class="mission-text">Menjalankan kegiatan usaha yang berwawasan lingkungan.</div>
                    </div>
                </div>

                <div id="transformasi" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Strategi Masa Depan</span>
                    <h4 class="fw-bold mb-4">3 Fokus Transformasi 2.0</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="transform-box">
                                <h6 class="fw-bold text-primary"><i class="fas fa-chart-line me-2"></i> Growth</h6>
                                <p class="small text-muted mb-0">Pertumbuhan demand listrik dan bisnis beyond kWh.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="transform-box">
                                <h6 class="fw-bold text-primary"><i class="fas fa-microchip me-2"></i> Digital</h6>
                                <p class="small text-muted mb-0">Pengalaman pelanggan excellent dan keunggulan
                                    operasional.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="transform-box">
                                <h6 class="fw-bold text-primary"><i class="fas fa-leaf me-2"></i> NZE</h6>
                                <p class="small text-muted mb-0">Memimpin transisi energi Indonesia menuju ekonomi
                                    hijau.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="akhlak" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Core Values BUMN</span>
                    <h4 class="fw-bold mb-4">Tata Nilai AKHLAK</h4>

                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="p-4 rounded-4 shadow-sm h-100"
                                style="background: linear-gradient(135deg, #005691, #00a2e9); color: white;">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">A</div>
                                        <span class="fw-bold small">AMANAH</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">K</div>
                                        <span class="fw-bold small">KOMPETEN</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">H</div>
                                        <span class="fw-bold small">HARMONIS</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">L</div>
                                        <span class="fw-bold small">LOYAL</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">A</div>
                                        <span class="fw-bold small">ADAPTIF</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; flex-shrink: 0;">K</div>
                                        <span class="fw-bold small">KOLABORATIF</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div
                                        class="p-3 border-start border-4 border-info bg-light rounded-3 h-100 shadow-sm">
                                        <h6 class="fw-bold text-dark small mb-2">AMANAH</h6>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-clock text-primary me-1"></i> Bekerja Tepat Waktu</p>
                                        <p class="text-muted mb-0" style="font-size: 11px;"><i
                                                class="fas fa-file-contract text-primary me-1"></i> Bekerja Sesuai
                                            Standar/aturan</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div
                                        class="p-3 border-start border-4 border-info bg-light rounded-3 h-100 shadow-sm">
                                        <h6 class="fw-bold text-dark small mb-2">KOMPETEN</h6>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-trophy text-primary me-1"></i> Eksekusi Berkualitas
                                            sampai tuntas</p>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-lightbulb text-primary me-1"></i> Terus Berinovasi</p>
                                        <p class="text-muted mb-0" style="font-size: 11px;"><i
                                                class="fas fa-book-reader text-primary me-1"></i> Terus Belajar</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div
                                        class="p-3 border-start border-4 border-info bg-light rounded-3 h-100 shadow-sm">
                                        <h6 class="fw-bold text-dark small mb-2">ADAPTIF</h6>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-shield-alt text-primary me-1"></i> Proaktif memantau
                                            Risiko</p>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-comment-dots text-primary me-1"></i> Proaktif memberi
                                            solusi</p>
                                        <p class="text-muted mb-0" style="font-size: 11px;"><i
                                                class="fas fa-hand-point-up text-primary me-1"></i> Praktik tunjuk
                                            sebut tenaga teknik</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div
                                        class="p-3 border-start border-4 border-info bg-light rounded-3 h-100 shadow-sm">
                                        <h6 class="fw-bold text-dark small mb-2">KOLABORATIF</h6>
                                        <p class="text-muted mb-1" style="font-size: 11px;"><i
                                                class="fas fa-handshake text-primary me-1"></i> Kolaborasi untuk nilai
                                            tambah</p>
                                        <p class="text-muted mb-0" style="font-size: 11px;"><i
                                                class="fas fa-users-cog text-primary me-1"></i> Berani berpendapat
                                            (meritokrasi ide)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="budaya-keselamatan" class="about-card animate__animated animate__fadeInUp">
                    <div id="tumit-kaka" class="about-card animate__animated animate__fadeInUp">
                        <span class="section-badge">Keselamatan Kerja</span>
                        <h4 class="fw-bold mb-3">Sasaran Budaya & TUMIT KAKA</h4>
                        <p class="text-muted small mb-4">Untuk mewujudkan Zero Accident, Divisi Operasi Distribusi
                            Sumatera dan Kalimantan serta Unit Induk Distribusi Sumatera Selatan, Jambi, dan Bengkulu
                            membudayakan 7 Komitmen Keselamatan Kerja (TUMIT KAKA), siap untuk:
                        </p>

                        <div class="row g-3">
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-user-check text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">1. Disiplin SDM Kompeten</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-file-signature text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">2. Disiplin WP, JSA, HIRARC</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-clipboard-check text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">3. Disiplin SOP & IK</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-hard-hat text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">4. Disiplin APD</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-tools text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">5. Disiplin Peralatan</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-user-shield text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">6. Checklist Pengamanan</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div
                                    class="d-flex align-items-center p-3 bg-light rounded-3 h-100 shadow-sm border-bottom border-primary border-3">
                                    <i class="fas fa-broadcast-tower text-primary fs-4 me-3"></i>
                                    <span class="fw-bold small">7. Disiplin Komunikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="integritas" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Etika & Integritas</span>

                    <div class="mb-5">
                        <h4 class="fw-bold text-dark"><i class="fas fa-handshake text-primary me-2"></i> Reminder SMAP
                        </h4>
                        <blockquote class="blockquote bg-light p-4 rounded-3 border-start border-primary border-5">
                            <p class="small mb-0 text-muted" style="text-align: justify;">
                                Sesuai Komitmen PLN dalam menegakkan Prinsip Tata Kelola Perusahaan yang baik (Good
                                Corporate Governance - GCG) serta penerapan Sistem Manajemen Anti Penyuapan (SMAP) SNI
                                ISO 37001 : 2016 di lingkungan PT PLN (Persero), dengan ini diberitahukan kepada seluruh
                                Dewan Komisaris, Direksi, Pegawai PLN Group dan atau keluarganya untuk tidak menerima
                                hadiah atau gratifikasi dalam bentuk apapun, baik secara langsung maupun tidak langsung
                                yang terkait dengan jabatannya.
                            </p>
                        </blockquote>
                    </div>

                    <h5 class="fw-bold mb-4">Prinsip 4 NO's:</h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mission-item h-100">
                                <div class="mission-icon bg-danger text-white"><i class="fas fa-ban"></i></div>
                                <div class="mission-text">
                                    <strong class="d-block text-danger">NO BRIBERY</strong>
                                    <small class="text-muted">Tidak boleh ada suap menyuap dan pemerasan.</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mission-item h-100">
                                <div class="mission-icon bg-danger text-white"><i class="fas fa-undo"></i></div>
                                <div class="mission-text">
                                    <strong class="d-block text-danger">NO KICKBACK</strong>
                                    <small class="text-muted">Tidak boleh ada komisi atau tanda terima kasih dalam
                                        bentuk apapun.</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mission-item h-100">
                                <div class="mission-icon bg-danger text-white"><i class="fas fa-gift"></i></div>
                                <div class="mission-text">
                                    <strong class="d-block text-danger">NO GIFT</strong>
                                    <small class="text-muted">Tidak boleh ada hadiah/gratifikasi yang bertentangan
                                        dengan peraturan.</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mission-item h-100">
                                <div class="mission-icon bg-danger text-white"><i class="fas fa-glass-cheers"></i>
                                </div>
                                <div class="mission-text">
                                    <strong class="d-block text-danger">NO LUXURIOUS HOSPITALITY</strong>
                                    <small class="text-muted">Tidak boleh ada penyambutan dan jamuan yang
                                        berlebihan.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 pe-lg-5">
                    <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="60" class="mb-4" alt="Logo PLN"
                        loading="lazy">
                    <p class="text-description"><strong>PT PLN (Persero) UP3 Jambi</strong> berkomitmen memberikan
                        pelayanan kelistrikan handal untuk Jambi yang lebih terang.</p>
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
                <div class="col-lg-3 pe-lg-5">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="contact-item">
                        <div class="contact-icon bg-telp"><i class="fas fa-map-marker-alt"></i></div><span>Jl.
                            Jenderal Urip Sumoharjo No.2, Jambi</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon bg-phone"><i class="fas fa-phone-alt"></i></div><span>Call Center:
                            123</span>
                    </div>
                </div>
                <div class="col-lg-3 pe-lg-1">
                    <h5 class="footer-title">Ikuti Kami</h5>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.instagram.com/plnjambi/"
                            target="_blank" class="social-icon bg-instagram me-3"><i
                                class="fab fa-instagram"></i></a><span class="text-white">plnjambi</span></div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.facebook.com/mang.hemat"
                            target="_blank" class="social-icon bg-facebook me-3"><i
                                class="fab fa-facebook-f"></i></a><span class="text-white">plnjambi</span></div>
                   <div class="d-flex align-items-center mb-3">
                        <a href="https://x.com/JambiPln" target="_blank" 
                           class="social-icon me-3 d-flex align-items-center justify-content-center" 
                           style="background-color: #000; width: 38px; height: 38px; border-radius: 8px; text-decoration: none;">

                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" fill="white">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                            </svg>

                        </a>
                        <span class="text-white">plnjambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.tiktok.com/@pln.up3.jambi"
                            target="_blank" class="social-icon bg-tiktok me-3"><i class="fab fa-tiktok"></i></a><span
                            class="text-white">pln.up3.jambi</span></div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.youtube.com/@PLNUP3_JAMBI"
                            class="social-icon bg-youtube me-3"><i class="fab fa-youtube"></i></a><span
                            class="text-white">PLN UP3 Jambi Official</span></div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container text-center">
                <p class="mb-0 small opacity-75">© {{ date('Y') }} <strong>PT PLN (Persero) UP3 Jambi</strong>.
                    All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // PLN Mobile Link Detection
        (function() {
            var ua = navigator.userAgent || navigator.vendor || window.opera;
            var url = /iPad|iPhone|iPod/.test(ua) && !window.MSStream ?
                "https://apps.apple.com/nz/app/pln-mobile/id1299581030" :
                "https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id";
            var l = document.getElementById("pln-mobile-link");
            var ld = document.getElementById("pln-mobile-link-drawer");
            if (l) l.href = url;
            if (ld) ld.href = url;
        })();

        // Drawer Menu Functionality
        (function() {
            var toggle = document.getElementById('drawerToggle');
            var panel = document.getElementById('drawerPanel');
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
                a.addEventListener('click', function() {
                    setTimeout(closeDrawer, 100);
                });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && panel.classList.contains('open')) closeDrawer();
            });
        })();

        // Sidebar Active Link
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>