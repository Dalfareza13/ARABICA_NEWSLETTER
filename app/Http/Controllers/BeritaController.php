<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index(Request $request) {
        $query = Berita::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        // Ambil data dengan pagination
        $data_berita = $query->orderBy('tanggal', 'desc')->paginate(9)->withQueryString();

        return view('index', [
            'data_berita' => $data_berita,
            'search'      => $request->query('search', ''),
            'bulan'       => $request->query('bulan', ''),
            'tahun'       => $request->query('tahun', '')
        ]);
    }

    public function admin() {
        return view('page.admin'); 
    }

    public function kelolaBerita() {
        $berita = Berita::orderBy('tanggal', 'desc')->get();
        return view('page.admin_kelola_berita', compact('berita'));
    }

    public function store(Request $request) {
        // Tambahkan validasi agar tidak error jika input kosong
        $request->validate([
            'judul'   => 'required|max:255',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets'), $nama_file);

            Berita::create([
                'judul'   => $request->judul,
                'tanggal' => $request->tanggal,
                'gambar'  => $nama_file,
            ]);

            return redirect()->route('admin.kelola_berita')->with('success', 'Berita berhasil diterbitkan!');
        }
        
        return back()->withErrors(['gambar' => 'Gagal mengunggah gambar']);
    }

    public function update(Request $request, $id) {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul'   => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            $oldPath = public_path('assets/' . $berita->gambar);
            if (!empty($berita->gambar) && File::exists($oldPath)) { 
                File::delete($oldPath); 
            }
            
            $file = $request->file('gambar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets'), $nama_file);
            $berita->gambar = $nama_file;
        }

        $berita->judul = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->save();

        return back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id) {
        $berita = Berita::findOrFail($id);
        $path = public_path('assets/' . $berita->gambar);
        
        if (!empty($berita->gambar) && File::exists($path)) { 
            File::delete($path); 
        }
        
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}