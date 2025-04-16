<?php

namespace App\Http\Controllers;

use App\Models\angkatan;
use App\Models\JenisPembayaran;
use App\Models\PosTagihan;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisPembayaran::with(['posTagihan', 'tahunAjaran']);
    
        if ($request->filled('tahun_ajaran_id')) {
            $query->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }
    
        if ($request->filled('q')) {
            $query->where('nama_pembayaran', 'like', '%' . $request->q . '%');
        }
    
        $data = $query->latest()->get();
        $tahunList = angkatan::orderBy('tahun', 'desc')->get();
    
        return view('admin.jenisPembayaran.jenis_index', compact('data', 'tahunList'));
    }

public function create()
{
    $pos = PosTagihan::all();
    $tahun = angkatan::where('status', 'aktif')->get();
    return view('admin.jenisPembayaran.jenis_form', compact('pos', 'tahun'));
}

public function store(Request $request)
{
    $request->validate([
        'pos_tagihan_id' => 'required',
        'tahun_ajaran_id' => 'required',
        'nama_pembayaran' => 'required|string',
        'tipe' => 'required|in:bulanan,bebas',
    ]);

    JenisPembayaran::create($request->all());

    return redirect()->route('jenis-pembayaran.index')->with('success', 'Jenis pembayaran berhasil ditambahkan.');
}

public function edit(JenisPembayaran $jenis_pembayaran)
{
    $pos = PosTagihan::all();
    $tahun = angkatan::all();
    return view('admin.jenisPembayaran.jenis_edit', compact('jenis_pembayaran', 'pos', 'tahun'));
}

public function update(Request $request, JenisPembayaran $jenis_pembayaran)
{
    $request->validate([
        'pos_tagihan_id' => 'required',
        'tahun_ajaran_id' => 'required',
        'nama_pembayaran' => 'required|string',
        'tipe' => 'required|in:bulanan,bebas',
    ]);

    $jenis_pembayaran->update($request->all());

    return redirect()->route('jenis-pembayaran.index')->with('success', 'Jenis pembayaran berhasil diperbarui.');
}

public function destroy(JenisPembayaran $jenis_pembayaran)
{
    $jenis_pembayaran->delete();
    return back()->with('success', 'Jenis pembayaran berhasil dihapus.');
}

}
