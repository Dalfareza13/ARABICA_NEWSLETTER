<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi Query Dasar
        $query = Berita::query();

        // 2. Terapkan Filter (Search, Bulan, Tahun)
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        /**
         * PERBAIKAN DI SINI:
         * Kita harus melakukan CLONE query sebelum paginate() dieksekusi.
         * Urutan: Ambil semua data dulu untuk Flipbook, baru jalankan paginate untuk Grid.
         */
        
        // Ambil SEMUA data sesuai filter untuk Flipbook (Tanpa limit 9)
        $semua_berita = (clone $query)->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();

        // Ambil data TERBATAS untuk Grid Utama (Hanya 9 per halaman)
        $data_berita = $query->orderBy('tanggal', 'desc')
                             ->orderBy('id', 'desc')
                             ->paginate(9)
                             ->withQueryString();

        return view('index', [
            'data_berita'  => $data_berita,
            'semua_berita' => $semua_berita,
            'search'       => $request->query('search', ''),
            'bulan'        => $request->query('bulan', ''),
            'tahun'        => $request->query('tahun', ''),
        ]);
    }

    public function admin()
    {
        return view('page.admin');
    }

    public function kelolaBerita()
    {
        // Konsisten menggunakan sorting tanggal terbaru
        $berita = Berita::orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();
        return view('page.admin_kelola_berita', compact('berita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $file      = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            
            // Pastikan folder tujuan ada
            if (!File::isDirectory(public_path('assets/berita'))) {
                File::makeDirectory(public_path('assets/berita'), 0755, true);
            }

            $file->move(public_path('assets/berita'), $nama_file);

            Berita::create([
                'judul'   => $request->judul,
                'tanggal' => $request->tanggal,
                'gambar'  => $nama_file,
            ]);

            return redirect()->route('admin.kelola_berita')
                             ->with('success', 'Berita berhasil diterbitkan!');
        }

        return back()->withErrors(['gambar' => 'Gagal mengunggah gambar']);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $oldPath = public_path('assets/berita/' . $berita->gambar);
            if (!empty($berita->gambar) && File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file      = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/berita'), $nama_file);
            $berita->gambar = $nama_file;
        }

        $berita->judul   = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->save();

        return back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $path   = public_path('assets/berita/' . $berita->gambar);

        if (!empty($berita->gambar) && File::exists($path)) {
            File::delete($path);
        }

        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}