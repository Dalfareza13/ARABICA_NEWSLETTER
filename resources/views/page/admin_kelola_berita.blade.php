<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Berita - Admin PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <style>
        :root { 
            --pln-blue: #005691; 
            --pln-dark: #002d5d; 
            --pln-yellow: #ffc107; 
        }
        body { background-color: #f4f7f6; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Sidebar Styling */
        .sidebar { 
            background: var(--pln-blue); 
            min-height: 100vh; 
            color: white; 
            transition: all 0.3s ease-in-out; 
            z-index: 1050;
        }
        .sidebar-header { padding: 20px; text-align: center; background: rgba(0,0,0,0.1); }
        .sidebar-header img { max-width: 100%; height: auto; max-height: 60px; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 25px; display: block; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar a.active { background: var(--pln-dark); color: white; border-left: 4px solid var(--pln-yellow); }
        .sidebar a:hover:not(.active) { background: rgba(255,255,255,0.1); color: white; }
        
        /* Main Content Styling */
        .main-content { padding: 20px; min-height: 100vh; transition: all 0.3s; }
        
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

        /* Container & Table */
        .table-container { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: none; }
        
        /* RESPONSIVE TABLE STRATEGY */
        @media (max-width: 767.98px) {
            .mobile-nav { display: flex; align-items: center; justify-content: space-between; }
            .sidebar { position: fixed; left: -100%; width: 280px; }
            .sidebar.show { left: 0; box-shadow: 10px 0 15px rgba(0,0,0,0.1) !important; }
            .main-content { padding: 20px 15px; }
            h2 { font-size: 1.4rem; }

            /* Ubah Tabel menjadi Kartu */
            .table-responsive { border: none; }
            thead { display: none; } /* Sembunyikan Header */
            
            table, tbody, tr, td { display: block; width: 100%; }
            tr { 
                margin-bottom: 20px; 
                border: 1px solid #eee; 
                border-radius: 12px; 
                padding: 10px; 
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            }
            td { 
                text-align: right; 
                padding: 10px 12px; 
                border: none; 
                display: flex; 
                justify-content: space-between; 
                align-items: center;
                border-bottom: 1px solid #f9f9f9;
            }
            td:last-child { border-bottom: none; }
            
            /* Gunakan data-label untuk keterangan */
            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: var(--pln-blue);
                font-size: 0.8rem;
                text-transform: uppercase;
            }
            
            td img { width: 100px !important; height: 60px !important; }
            .btn-group-mobile { display: flex; gap: 10px; justify-content: flex-end; }
        }

        @media (min-width: 768px) {
            .main-content { padding: 40px; }
        }

        /* Overlay */
        #sidebarOverlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5); z-index: 1045; display: none;
        }
        #sidebarOverlay.active { display: block; }
    </style>
</head>
<body>

<div class="mobile-nav shadow-sm">
    <div class="d-flex align-items-center">
        <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo" style="height: 30px;">
        <span class="ms-2 fw-bold">Admin PLN</span>
    </div>
    <button class="btn text-white" id="toggleSidebar">
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
                <a href="{{ url('/') }}" class="nav-link-item"><i class="fas fa-home me-2"></i> Lihat Web</a>
                <a href="{{ route('admin.dashboard') }}" class="nav-link-item"><i class="fas fa-plus-circle me-2"></i> Tambah Berita</a>
                <a href="{{ route('admin.kelola_berita') }}" class="nav-link-item active"><i class="fas fa-tasks me-2"></i> Kelola Berita</a>
                
                <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px; padding-left: 20px;">
                    @csrf
                    <button type="submit" class="btn btn-link text-white text-decoration-none p-0 nav-link-item">
                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                    </button>
                </form>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            <div class="container-fluid">
                <h2 class="fw-bold mb-4" style="color: var(--pln-dark);">Daftar Berita Terbit</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="table-container shadow-sm">
                    <div class="table-responsive border-0">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Gambar</th>
                                    <th class="text-start">Judul Berita</th>
                                    <th>Tanggal Post</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berita as $key => $d)
                                <tr class="text-center">
                                    <td data-label="No">{{ $key + 1 }}</td>
                                    <td data-label="Gambar">
                                        <img src="{{ asset('assets/' . $d->gambar) }}" style="width: 70px; height: 45px; object-fit: cover; border-radius: 6px;">
                                    </td>
                                    <td data-label="Judul" class="text-start fw-bold">{{ $d->judul }}</td>
                                    <td data-label="Tanggal">{{ date('d M Y', strtotime($d->tanggal)) }}</td>
                                    <td data-label="Aksi">
                                        <div class="btn-group-mobile d-flex justify-content-center gap-2">
                                            <button class="btn btn-warning btn-sm rounded shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                                <i class="fas fa-edit text-white"></i>
                                            </button>
                                            
                                            <form action="{{ route('berita.delete', $d->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm px-3">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                            <form action="{{ route('berita.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf 
                                                @method('PUT')
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold" style="color: var(--pln-dark);">Perbarui Berita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label fw-bold small">Judul Berita</label>
                                                        <input type="text" name="judul" class="form-control border-2" value="{{ $d->judul }}" required>
                                                    </div>
                                                    <div class="mb-3 text-start">
                                                        <label class="form-label fw-bold small">Tanggal Terbit</label>
                                                        <input type="date" name="tanggal" class="form-control border-2" value="{{ $d->tanggal }}" required>
                                                    </div>
                                                    <div class="mb-0 text-start">
                                                        <label class="form-label fw-bold small">Ganti Gambar</label>
                                                        <input type="file" name="gambar" class="form-control border-2" accept="image/*">
                                                        <div class="mt-2 p-2 bg-light rounded border border-dashed">
                                                            <small class="text-muted">File: <code>{{ $d->gambar }}</code></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 px-4">
                                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Data berita belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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

    function toggleMenu() {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('active');
        document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
    }

    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMenu();
    });

    overlay.addEventListener('click', toggleMenu);
</script>
</body>
</html>