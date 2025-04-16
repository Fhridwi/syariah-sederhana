<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Http\Requests\StoreSantriRequest;
use App\Http\Requests\UpdateSantriRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.dataSantri.santri_form');
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
    public function show(Santri $santri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSantriRequest $request, Santri $santri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        //
    }
}
