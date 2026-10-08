<?php
namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'slug' => 'required|max:100|unique:beritas,slug',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $folder = public_path('uploads/berita');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $namaGambar);
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($slug)
    {
        $berita = Berita::with('user')
            ->where('slug', $slug)
            ->first();

        if (!$berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        $request->validate([
            'judul' => 'required|max:50',
            'slug' => 'required|max:100|unique:beritas,slug,' . $berita->id_berita . ',id_berita',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Publish,Draft',
        ]);

        $namaGambar = $berita->gambar;

        if ($request->hasFile('gambar')) {

            if (
                $berita->gambar &&
                file_exists(public_path('uploads/berita/' . $berita->gambar))
            ) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $folder = public_path('uploads/berita');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $namaGambar);
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->slug),
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $namaGambar,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (
            $berita->gambar &&
            file_exists(public_path('uploads/berita/' . $berita->gambar))
        ) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function show($slug)
    {
        $berita = Berita::with('user')
            ->where('slug', $slug)
            ->where('status', 'Publish')
            ->firstOrFail();

        return view('landing.detail-berita', compact('berita'));
    }
}
