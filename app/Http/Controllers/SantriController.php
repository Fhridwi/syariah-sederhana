<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Http\Requests\StoreSantriRequest;
use App\Http\Requests\UpdateSantriRequest;
use App\Models\Program;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Santri::query();

    if ($request->filled('cari')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->cari . '%')
              ->orWhere('nis', 'like', '%' . $request->cari . '%');
        });
    }

    if ($request->filled('angkatan')) {
        $query->where('angkatan', $request->angkatan);
    }

    if ($request->filled('jk')) {
        $query->where('jenis_kelamin', $request->jk);
    }

    $santri = $query->paginate(10);
    $santri->appends(request()->query());

    $angkatanList = Santri::select('angkatan')->distinct()->pluck('angkatan');

    return view('admin.datasantri.santri_index', compact('santri', 'angkatanList'));
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolah = Sekolah::all();
        $program = Program::all();

        return view('admin.dataSantri.santri_form', compact('sekolah', 'program'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSantriRequest $request)
    {
        $data = $request->validated();

        // Cek jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = 'santri-' . Str::slug($data['nama']) . '-' . time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/foto-santri', $namaFile);

            // Simpan path ke database
            $data['foto'] = $namaFile;
        }

        Santri::create($data);

        return redirect()->route('datasantri.index')->with('success', 'Data santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $santri = Santri::findOrFail($id);

        return view('admin.dataSantri.santri_show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $sekolah = Sekolah::pluck('nama_sekolah');
        $program = Program::pluck('nama_program');

        return view('admin.dataSantri.santri_edit', compact('santri','sekolah', 'program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSantriRequest $request, $id)
{

    $santri = Santri::findOrFail($id);

    // Memastikan nis yang baru unik
    $request->validate([
        'nis' => [
            'required',
            'string',
            'max:20',
            Rule::unique('santris')->ignore($santri->id),
        ]
    ]);

    $santri->nis = $request->nis;
    $santri->nama = $request->nama;
    $santri->jenis_kelamin = $request->jenis_kelamin;
    $santri->angkatan = $request->angkatan;
    $santri->tempat_lahir = $request->tempat_lahir;
    $santri->tanggal_lahir = $request->tanggal_lahir;
    $santri->alamat = $request->alamat;
    $santri->program = $request->program;
    $santri->sekolah_formal = $request->sekolah_formal;
    $santri->madrasah_diniyah = $request->madrasah_diniyah;
    $santri->telepon_orang_tua = $request->telepon_orang_tua;
    $santri->status_santri = $request->status_santri;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $namaFile = 'santri-' . Str::slug($request->nama) . '-' . time() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('public/foto-santri', $namaFile);
        $santri->foto = $namaFile;
    }

    $santri->save();

    return redirect()->route('datasantri.index')->with('success', 'Data santri berhasil diperbarui.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $santri = Santri::findOrFail($id);
    
    // Cek jika ada foto dan foto ada di dalam storage
    if ($santri->foto && Storage::exists('public/foto-santri/' . $santri->foto)) {
        Storage::delete('public/foto-santri/' . $santri->foto);
    }

    // Hapus data santri
    $santri->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('datasantri.index')->with('success', 'Data santri berhasil dihapus.');
}


}
