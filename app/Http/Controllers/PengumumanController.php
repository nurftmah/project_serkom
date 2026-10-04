<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('tanggal', 'desc')->get();

        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Publish,Draft',
        ]);

        if (!Auth::check()) {
            return back()->with('error', 'User belum login.');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $pengumuman = Pengumuman::find($id);

            if (!$pengumuman) {
                return redirect()
                    ->route('admin.pengumuman.index')
                    ->with('error', 'Data pengumuman tidak ditemukan.');
            }

            return view('admin.pengumuman.edit', compact('pengumuman'));

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = Crypt::decryptString($id);

            $pengumuman = Pengumuman::find($id);

            if (!$pengumuman) {
                return redirect()
                    ->route('admin.pengumuman.index')
                    ->with('error', 'Data pengumuman tidak ditemukan.');
            }

            $request->validate([
                'judul' => 'required|max:50',
                'isi' => 'required',
                'tanggal' => 'required|date',
                'status' => 'required|in:Publish,Draft',
            ]);

            $pengumuman->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => $request->tanggal,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil diperbarui.');

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decryptString($id);

            $pengumuman = Pengumuman::find($id);

            if (!$pengumuman) {
                return redirect()
                    ->route('admin.pengumuman.index')
                    ->with('error', 'Data pengumuman tidak ditemukan.');
            }

            $pengumuman->delete();

            return redirect()
                ->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil dihapus.');

        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }
    }
}