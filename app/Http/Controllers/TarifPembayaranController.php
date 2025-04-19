<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\TarifPembayaran;
use Illuminate\Http\Request;

class TarifPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TarifPembayaran::with('jenisPembayaran')->get();
        return view('admin.tarifPembayaran.tarif_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = JenisPembayaran::all();
        return view('admin.tarifPembayaran.tarif_form', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'jenis_pembayaran_id' => 'required',
        'nominal' => 'required|numeric'
    ]);

    TarifPembayaran::create($request->all());

    return redirect()->route('tarif-pembayaran.index')->with('success', 'Tarif berhasil ditambahkan.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TarifPembayaran $tarif_pembayaran)
{
    $jenis = JenisPembayaran::all();
    return view('admin.tarifPembayaran.tarif_edit', [
        'tarif' => $tarif_pembayaran,
        'jenis' => $jenis
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TarifPembayaran $tarif_pembayaran)
{
    $request->validate([
        'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
        'nominal' => 'required|numeric'
    ]);

    $tarif_pembayaran->update($request->all());

    return redirect()->route('tarif-pembayaran.index')->with('success', 'Tarif berhasil diperbarui.');
}

public function destroy(TarifPembayaran $tarif_pembayaran)
{
    $tarif_pembayaran->delete();
    return back()->with('success', 'Tarif berhasil dihapus.');
}
}
