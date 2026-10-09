<?php
namespace App\Http\Controllers;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
class GuruController extends Controller
{
    public function index(Request $request)
    {
        $mapels = Guru::select('mapel')->distinct()->orderBy('mapel')->get();
        $query = Guru::query();
        if ($request->filled('mapel')) {
            $query->where('mapel', $request->mapel);
        }
        $gurus = $query->orderBy('nama_guru', 'asc')->get();
        return view('admin.guru.index', compact('gurus', 'mapels'));
    }
    public function publicIndex()
    {
        $gurus = Guru::orderBy('nama_guru', 'asc')->get();
        return view('landing.guru', compact('gurus'));
    }
    public function show($id)
    {
        try {
            $idGuru = Crypt::decryptString($id);
            $guru = Guru::where('id_guru', $idGuru)->first();
            if (!$guru) {
                return redirect()->route('guru.public')->with('error', 'Data guru tidak ditemukan.');
            }
            return view('landing.detail-guru', compact('guru'));
        } catch (DecryptException $e) {
            return redirect()->route('guru.public')->with('error', 'Data guru tidak ditemukan.');
        }
    }
    public function create()
    {
        return view('admin.guru.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|max:40',
            'nip' => 'required|max:15',
            'mapel' => 'required|max:40',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $namaFoto = $request->file('foto')->store('guru', 'public');
        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => basename($namaFoto),
        ]);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }
    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::find($id);
            if (!$guru) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }
            return view('admin.guru.edit', compact('guru'));
        } catch (DecryptException $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::find($id);
            if (!$guru) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }
            $request->validate([
                'nama_guru' => 'required|max:40',
                'nip' => 'required|max:15',
                'mapel' => 'required|max:40',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $namaFoto = $guru->foto;
            if ($request->hasFile('foto')) {
                $fotoBaru = $request->file('foto')->store('guru', 'public');
                $namaFoto = basename($fotoBaru);
                if ($guru->foto) {
                    Storage::disk('public')->delete('guru/' . $guru->foto);
                }
            }
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'nip' => $request->nip,
                'mapel' => $request->mapel,
                'foto' => $namaFoto,
            ]);
            return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }
    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $guru = Guru::find($id);
            if (!$guru) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }
            if ($guru->foto) {
                Storage::disk('public')->delete('guru/' . $guru->foto);
            }
            $guru->delete();
            return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (DecryptException $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }
}
