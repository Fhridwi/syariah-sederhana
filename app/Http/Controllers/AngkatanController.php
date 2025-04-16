<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    public function index()
    {
        $data = Angkatan::orderBy('tahun', 'desc')->get();
        return view('admin.dataTahun.tahun_index', compact('data'));
    }

    public function create()
    {
        return view('admin.dataTahun.tahun_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        Angkatan::create($request->all());

        return redirect()->route('angkatan.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $tahun_ajaran = Angkatan::findOrFail($id);
        return view('admin.dataTahun.tahun_edit', compact('tahun_ajaran'));
    }
    
    public function update(Request $request, Angkatan $tahun_ajaran)
    {
        $request->validate([
            'tahun' => 'required|string|max:9',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);
    
        $tahun_ajaran->update([
            'tahun' => $request->tahun,
            'status' => $request->status,
        ]);
    
        return redirect()->route('angkatan.index')->with('success', 'Tahun ajaran berhasil diperbarui.');
    }
    

    public function destroy(string $id)
    {

        $tahun_ajaran = Angkatan::findOrFail($id);
        $tahun_ajaran->delete();
        return redirect()->route('angkatan.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    }

    public function setAktif($id)
{
    Angkatan::query()->update(['status' => 'tidak_aktif']);
    Angkatan::where('id', $id)->update(['status' => 'aktif']);

    return redirect()->back();
}

}
