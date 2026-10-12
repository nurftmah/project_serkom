<?php
namespace App\Http\Controllers;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;
class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::orderBy('tahun_ajaran', 'desc')->get();
        return view('admin.prestasi.index', compact('prestasis'));
    }
    public function create()
    {
        return view('admin.prestasi.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_ajaran' => 'required|integer',
        ],[
            'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
            'nama_prestasi.string' => 'Nama prestasi harus berupa teks.',
            'nama_prestasi.max' => 'Nama prestasi maksimal 40 karakter.',
            'deskripsi.required' => 'Deskripsi prestasi wajib diisi.',
            'deskripsi.string' => 'Deskripsi prestasi harus berupa teks.',
            'foto.required' => 'Foto prestasi wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'tahun_ajaran.integer' => 'Tahun ajaran harus berupa angka.',
        ]);
        $namaFoto = basename($request->file('foto')->store('prestasi', 'public'));
        Prestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'slug' => Str::slug($request->nama_prestasi),
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);
        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }
    public function edit($id)
    {
        try {
            $idPrestasi = Crypt::decryptString($id);
            $prestasi = Prestasi::where('id_prestasi', $idPrestasi)->first();
            if (!$prestasi) {
                return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
            }
            return view('admin.prestasi.edit', compact('prestasi'));
        } catch (DecryptException $e) {
            return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $idPrestasi = Crypt::decryptString($id);
            $prestasi = Prestasi::where('id_prestasi', $idPrestasi)->first();
            if (!$prestasi) {
                return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
            }
            $request->validate([
                'nama_prestasi' => 'required|string|max:40',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'tahun_ajaran' => 'required|integer',
            ],[
                'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
                'nama_prestasi.string' => 'Nama prestasi harus berupa teks.',
                'nama_prestasi.max' => 'Nama prestasi maksimal 40 karakter.',
                'deskripsi.required' => 'Deskripsi prestasi wajib diisi.',
                'deskripsi.string' => 'Deskripsi prestasi harus berupa teks.',
                'foto.image' => 'File yang diunggah harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
                'foto.max' => 'Ukuran foto maksimal 2 MB.',
                'tahun_ajaran.required' => 'Tahun ajaran wajib diisi.',
                'tahun_ajaran.integer' => 'Tahun ajaran harus berupa angka.',
            ]);
            $namaFoto = $prestasi->foto;
            if ($request->hasFile('foto')) {
                $fotoBaru = $request->file('foto')->store('prestasi', 'public');
                $namaFoto = basename($fotoBaru);
                if ($prestasi->foto) {
                    Storage::disk('public')->delete('prestasi/' . $prestasi->foto);
                }
            }
            $prestasi->update([
                'nama_prestasi' => $request->nama_prestasi,
                'slug' => Str::slug($request->nama_prestasi),
                'deskripsi' => $request->deskripsi,
                'foto' => $namaFoto,
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);
            return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
        }
    }
    public function destroy($id)
    {
        try {
            $idPrestasi = Crypt::decryptString($id);
            $prestasi = Prestasi::where('id_prestasi', $idPrestasi)->first();
            if (!$prestasi) {
                return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
            }
            if ($prestasi->foto) {
                Storage::disk('public')->delete('prestasi/' . $prestasi->foto);
            }
            $prestasi->delete();
            return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.prestasi.index')->with('error', 'Data prestasi tidak ditemukan.');
        }
    }
}
