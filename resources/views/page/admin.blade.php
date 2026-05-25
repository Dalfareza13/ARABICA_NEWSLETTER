<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - PLN UP3 Jambi</title>
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
        }

        /* Sidebar Styling */
        .sidebar {
            background: var(--pln-blue);
            min-height: 100vh;
            color: white;
            transition: all 0.3s ease-in-out;
            z-index: 1050;
            /* Di atas backdrop bootstrap */
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

        /* Responsivitas Mobile */
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

            .btn-publish {
                width: 100%;
                border-radius: 10px !important;
            }
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 40px;
            }
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .btn-publish {
            background-color: var(--pln-dark);
            color: white;
            transition: 0.3s;
            border: none;
        }

        .btn-publish:hover {
            background-color: #001a35;
            transform: translateY(-2px);
        }

        /* Custom Overlay */
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
    </style>
</head>

<body>

    <div class="mobile-nav shadow-sm">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo" style="height: 30px;">
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
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-item active"><i class="fas fa-plus-circle me-2"></i> Tambah Berita</a>
                    <a href="{{ route('admin.kelola_berita') }}" class="nav-link-item"><i class="fas fa-tasks me-2"></i> Kelola Berita</a>
                    <a href="{{ route('admin.profil') }}" class="nav-link-item"><i class="fas fa-building me-2"></i> Profil Perusahaan</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin-top: 30px; padding-left: 20px;">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="btn btn-link text-white text-decoration-none p-0 nav-link-item">
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
                                    popup: 'animate__animated animate__fadeInDown' // Animasi masuk
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp' // Animasi keluar
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Animasi loading sebelum submit
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
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary p-3 rounded-circle text-white me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-newspaper fa-lg"></i>
                                </div>
                                <h2 class="fw-bold m-0" style="color: var(--pln-dark);">Input Berita</h2>
                            </div>

                            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Judul Berita</label>
                                    <input type="text" name="judul" class="form-control border-2 @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Masukkan judul..." required>
                                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control border-2" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Gambar Utama</label>
                                    <input type="file" name="gambar" class="form-control border-2 @error('gambar') is-invalid @enderror" accept="image/*" required>
                                    <div class="form-text">Maksimal 5MB (JPG/PNG).</div>
                                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-publish btn-lg px-4 py-2 fw-bold rounded-pill shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i> PUBLISH
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const navLinks = document.querySelectorAll('.nav-link-item');

        function toggleMenu() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
            // Kunci scroll body saat menu terbuka di mobile
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }

        // Event listener untuk tombol buka/tutup
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        // Event listener untuk klik di luar sidebar (overlay)
        overlay.addEventListener('click', toggleMenu);

        // FIX: Pastikan link bisa diklik dan menutup menu
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    // Beri sedikit delay agar user sempat melihat feedback klik sebelum pindah halaman
                    setTimeout(() => {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }, 100);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>