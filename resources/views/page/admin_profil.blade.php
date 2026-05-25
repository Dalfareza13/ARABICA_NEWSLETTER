<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Perusahaan - Admin PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <style>
        :root {
            --pln-blue: #005691;
            --pln-dark: #002d5d;
            --pln-yellow: #ffc107;
        }

        body {
            background-color: #f4f7f6;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            background: var(--pln-blue);
            min-height: 100vh;
            color: white;
            transition: all 0.3s ease-in-out;
            z-index: 1050;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar-header img {
            max-width: 100%;
            height: auto;
            max-height: 60px;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 15px 25px;
            display: block;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar a.active {
            background: var(--pln-dark);
            color: white;
            border-left: 4px solid var(--pln-yellow);
        }

        .sidebar a:hover:not(.active) {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* Main Content Styling */
        .main-content {
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Navbar Mobile */
        .mobile-nav {
            display: none;
            background: var(--pln-blue);
            color: white;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1040;
        }

        .mobile-nav img {
            height: 30px;
        }

        /* Card Styling */
        .card {
            border-radius: 15px;
            border: none;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Preview Container */
        .preview-container {
            min-height: 180px;
            border: 2px dashed #ddd;
            background: #fafafa;
            border-radius: 10px;
            overflow: hidden;
        }

        .preview-container img {
            max-height: 180px;
            object-fit: contain;
        }

        /* Button Styling */
        .btn-lg {
            transition: all 0.3s;
        }

        .btn-lg:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* RESPONSIVE MOBILE STRATEGY */
        @media (max-width: 767.98px) {
            .mobile-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar {
                position: fixed;
                left: -100%;
                width: 280px;
                box-shadow: none !important;
            }

            .sidebar.show {
                left: 0;
                box-shadow: 10px 0 15px rgba(0, 0, 0, 0.1) !important;
            }

            .main-content {
                padding: 20px 15px;
            }

            h2 {
                font-size: 1.3rem;
            }

            .card {
                margin-bottom: 20px;
            }

            .card-body {
                padding: 20px !important;
            }

            /* Stack Layout Mobile */
            .row.align-items-center {
                flex-direction: column;
            }

            .col-md-4,
            .col-md-8 {
                width: 100%;
                max-width: 100%;
            }

            .preview-container {
                min-height: 150px;
                margin-bottom: 20px;
            }

            .preview-container img {
                max-height: 150px;
            }

            /* Button Full Width on Mobile */
            .btn-lg {
                width: 100%;
                margin-top: 10px;
            }

            /* Icon Badge Mobile */
            .bg-warning,
            .bg-info,
            .bg-primary,
            .bg-success {
                width: 45px !important;
                height: 45px !important;
            }

            .bg-warning i,
            .bg-info i,
            .bg-primary i,
            .bg-success i {
                font-size: 1rem !important;
            }
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 40px;
            }
        }

        /* Overlay */
        #sidebarOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            display: none;
        }

        #sidebarOverlay.active {
            display: block;
        }

        /* Image Loading Effect */
        img.lazy {
            opacity: 0;
            transition: opacity 0.3s;
        }

        img.lazy.loaded {
            opacity: 1;
        }

        /* Empty State Icon */
        .text-muted i {
            opacity: 0.5;
        }
    </style>
</head>

<body>

    <div class="mobile-nav shadow-sm">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo" loading="lazy" decoding="async">
            <span class="ms-2 fw-bold">Admin PLN</span>
        </div>
        <button class="btn text-white" id="toggleSidebar" aria-label="Menu">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <div id="sidebarOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 px-0 sidebar shadow" id="sidebarMenu">
                <div class="sidebar-header d-none d-md-block">
                    <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN">
                    <p class="mt-2 fw-bold mb-0 small text-uppercase">Admin PLN Jambi</p>
                </div>

                <div class="nav-links mt-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-item"><i
                            class="fas fa-plus-circle me-2"></i> Tambah Berita</a>
                    <a href="{{ route('admin.kelola_berita') }}" class="nav-link-item"><i
                            class="fas fa-tasks me-2"></i> Kelola Berita</a>
                    <a href="{{ route('admin.profil') }}" class="nav-link-item active"><i
                            class="fas fa-building me-2"></i> Profil Perusahaan</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        style="margin-top: 30px; padding-left: 20px;">
                        @csrf
                        <button type="button" onclick="confirmLogout()"
                            class="btn btn-link text-white text-decoration-none p-0 nav-link-item">
                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                        </button>
                    </form>
                    <script>
                        function confirmLogout() {
                            Swal.fire({
                                title: 'Ingin Keluar?',
                                text: "Pastikan semua pekerjaan Anda telah tersimpan.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, Keluar!',
                                cancelButtonText: 'Batal',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        title: 'Sedang Keluar...',
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading()
                                        }
                                    });
                                    document.getElementById('logout-form').submit();
                                }
                            })
                        }
                    </script>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="container-fluid">
                    <h2 class="fw-bold mb-4" style="color: var(--pln-dark);">Manajemen Profil Perusahaan</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3 shadow-sm"
                            role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- STRUKTUR ORGANISASI UP3 -->
                    <div class="card border-start border-warning border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-warning p-3 rounded-circle text-dark me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-sitemap fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Struktur Organisasi UP3</h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar struktur manajemen utama PLN UP3 Jambi.</p>

                            <form action="{{ route('admin.profil.update_struktur') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview UP3:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_struktur) && $gambar_struktur)
                                                <img id="mainPreview" src="{{ asset($gambar_struktur) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Struktur UP3">
                                            @else
                                                <div id="noImageText" class="text-muted small text-center">
                                                    <i class="fas fa-image fa-3x d-block mb-2"></i>
                                                    Belum ada gambar
                                                </div>
                                                <img id="mainPreview" src=""
                                                    class="img-fluid rounded shadow-sm lazy d-none" loading="lazy"
                                                    decoding="async">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Gambar UP3</label>
                                            <input type="file" name="gambar_struktur" id="inputGambar"
                                                class="form-control border-2 @error('gambar_struktur') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-danger">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_struktur')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-warning btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-dark">
                                            <i class="fas fa-save me-2"></i> UPDATE UP3
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- STRUKTUR ORGANISASI ULP -->
                    <div class="card border-start border-info border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-info p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-map-marked-alt fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Struktur Organisasi ULP</h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar struktur Unit Layanan Pelanggan (ULP) Jambi.</p>

                            <form action="{{ route('admin.profil.update_ulp') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview ULP:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_ulp) && $gambar_ulp)
                                                <img id="ulpPreview" src="{{ asset($gambar_ulp) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Struktur ULP">
                                            @else
                                                <div id="noUlpImageText" class="text-muted small text-center">
                                                    <i class="fas fa-image fa-3x d-block mb-2"></i>
                                                    Belum ada gambar ULP
                                                </div>
                                                <img id="ulpPreview" src=""
                                                    class="img-fluid rounded shadow-sm lazy d-none" loading="lazy"
                                                    decoding="async">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Struktur ULP</label>
                                            <input type="file" name="gambar_ulp" id="inputGambarUlp"
                                                class="form-control border-2 @error('gambar_ulp') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-info">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_ulp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-info btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-white">
                                            <i class="fas fa-save me-2"></i> UPDATE ULP
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- DATA PENGUSAHAAN UP3 -->
                    <div class="card border-start border-info border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-info p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-chart-line fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Data Pengusahaan UP3 Jambi
                                </h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar infografis pengusahaan UP3 Jambi.</p>

                            <form action="{{ route('admin.profil.update_pengusahaan') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview Data:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_pengusahaan) && $gambar_pengusahaan)
                                                <img id="pengusahaanPreview" src="{{ asset($gambar_pengusahaan) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Data Pengusahaan">
                                            @else
                                                <div id="noPengusahaanText" class="text-muted small text-center">
                                                    <i class="fas fa-file-invoice-dollar fa-3x d-block mb-2"></i>
                                                    Belum ada data pengusahaan
                                                </div>
                                                <img id="pengusahaanPreview" src=""
                                                    class="img-fluid rounded shadow-sm d-none">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Infografis Pengusahaan</label>
                                            <input type="file" name="gambar_pengusahaan" id="inputPengusahaan"
                                                class="form-control border-2 @error('gambar_pengusahaan') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-info">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_pengusahaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-info btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-white">
                                            <i class="fas fa-save me-2"></i> UPDATE PENGUSAHAAN
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- SISTEM KELISTRIKAN UP3 -->
                    <div class="card border-start border-primary border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-bolt fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Sistem Kelistrikan UP3 Jambi
                                </h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar skema sistem kelistrikan UP3 Jambi.</p>

                            <form action="{{ route('admin.profil.update_kelistrikan') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview Sistem:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_kelistrikan) && $gambar_kelistrikan)
                                                <img id="kelistrikanPreview" src="{{ asset($gambar_kelistrikan) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Sistem Kelistrikan">
                                            @else
                                                <div id="noKelistrikanText" class="text-muted small text-center">
                                                    <i class="fas fa-network-wired fa-3x d-block mb-2"></i>
                                                    Belum ada gambar sistem
                                                </div>
                                                <img id="kelistrikanPreview" src=""
                                                    class="img-fluid rounded shadow-sm d-none">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Skema Kelistrikan</label>
                                            <input type="file" name="gambar_kelistrikan" id="inputKelistrikan"
                                                class="form-control border-2 @error('gambar_kelistrikan') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-primary">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_kelistrikan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-white">
                                            <i class="fas fa-save me-2"></i> UPDATE KELISTRIKAN
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- LAPORAN TAHUNAN PENGUSAHAAN -->
                    <div class="card border-start border-success border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-chart-bar fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Laporan Tahunan Pengusahaan
                                </h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar grafik laporan tahunan pengusahaan.</p>

                            <form action="{{ route('admin.profil.update_pengusahaan_tahunan') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview Tahunan:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_pengusahaan_tahunan) && $gambar_pengusahaan_tahunan)
                                                <img id="pengusahaanTahunanPreview"
                                                    src="{{ asset($gambar_pengusahaan_tahunan) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Laporan Tahunan">
                                            @else
                                                <div id="noTahunanText" class="text-muted small text-center">
                                                    <i class="fas fa-file-chart-line fa-3x d-block mb-2"></i>
                                                    Belum ada data tahunan
                                                </div>
                                                <img id="pengusahaanTahunanPreview" src=""
                                                    class="img-fluid rounded shadow-sm d-none">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Grafik Tahunan</label>
                                            <input type="file" name="gambar_pengusahaan_tahunan" id="inputTahunan"
                                                class="form-control border-2 @error('gambar_pengusahaan_tahunan') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-success">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_pengusahaan_tahunan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-success btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-white">
                                            <i class="fas fa-save me-2"></i> UPDATE TAHUNAN
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- OPERATING DISTRIBUTION SYSTEM -->
                    <div class="card border-start border-primary border-4">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-project-diagram fa-lg"></i>
                                </div>
                                <h3 class="fw-bold m-0" style="color: var(--pln-dark);">Operating Distribution System
                                </h3>
                            </div>
                            <p class="text-muted mb-4">Update gambar diagram sistem distribusi operasional.</p>

                            <form action="{{ route('admin.profil.update_operating_system') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                                        <label class="d-block fw-bold mb-2 text-start">Preview Sistem:</label>
                                        <div
                                            class="preview-container p-2 d-flex align-items-center justify-content-center">
                                            @if (isset($gambar_operating_system) && $gambar_operating_system)
                                                <img id="operatingSystemPreview"
                                                    src="{{ asset($gambar_operating_system) }}"
                                                    class="img-fluid rounded shadow-sm lazy" loading="lazy"
                                                    decoding="async" alt="Operating System">
                                            @else
                                                <div id="noOperatingText" class="text-muted small text-center">
                                                    <i class="fas fa-network-wired fa-3x d-block mb-2"></i>
                                                    Belum ada diagram sistem
                                                </div>
                                                <img id="operatingSystemPreview" src=""
                                                    class="img-fluid rounded shadow-sm d-none">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih File Diagram Distribusi</label>
                                            <input type="file" name="gambar_operating_system" id="inputOperating"
                                                class="form-control border-2 @error('gambar_operating_system') is-invalid @enderror"
                                                accept="image/*" required>
                                            <div class="form-text text-primary">Maks 3MB (JPG/PNG).</div>
                                            @error('gambar_operating_system')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm text-white">
                                            <i class="fas fa-save me-2"></i> UPDATE SISTEM
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- SIDEBAR TOGGLE LOGIC ---
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const navLinks = document.querySelectorAll('.nav-link-item');

        function toggleMenu() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMenu();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', toggleMenu);
        }

        // Close sidebar when nav link clicked on mobile
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    setTimeout(() => {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }, 100);
                }
            });
        });

        // --- LIVE PREVIEW LOGIC ---
        function setupPreview(inputId, previewId, textId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const text = document.getElementById(textId);

            if (input && preview) {
                input.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        // Validate file size (3MB)
                        if (file.size > 3 * 1024 * 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'File Terlalu Besar',
                                text: 'Ukuran file maksimal 3MB',
                                confirmButtonColor: '#d33'
                            });
                            this.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            preview.classList.remove('d-none');
                            preview.classList.add('lazy', 'loaded');
                            if (text) text.classList.add('d-none');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        }

        // Setup all preview handlers
        setupPreview('inputGambar', 'mainPreview', 'noImageText');
        setupPreview('inputGambarUlp', 'ulpPreview', 'noUlpImageText');
        setupPreview('inputPengusahaan', 'pengusahaanPreview', 'noPengusahaanText');
        setupPreview('inputKelistrikan', 'kelistrikanPreview', 'noKelistrikanText');
        setupPreview('inputTahunan', 'pengusahaanTahunanPreview', 'noTahunanText');
        setupPreview('inputOperating', 'operatingSystemPreview', 'noOperatingText');

        // --- IMAGE LAZY LOADING ---
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll("img.lazy");
            images.forEach(img => {
                if (img.complete) {
                    img.classList.add("loaded");
                } else {
                    img.addEventListener("load", function () {
                        img.classList.add("loaded");
                    });
                }
            });
        });
    </script>
</body>

</html>