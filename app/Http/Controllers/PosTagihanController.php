<?php

namespace App\Http\Controllers;

use App\Models\PosTagihan;
use Illuminate\Http\Request;

class PosTagihanController extends Controller
{
    public function index()
    {
        $data = PosTagihan::latest()->paginate(10);
        return view('admin.posTagihan.pos_index', compact('data'));
    }

    public function create()
    {
        return view('admin.posTagihan.pos_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        PosTagihan::create($request->only('nama'));

        return redirect()->route('postagihan.index')->with('success', 'Pos tagihan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $posTagihan = PosTagihan::findOrFail($id);
        return view('admin.posTagihan.pos_edit', compact('posTagihan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $posTagihan = PosTagihan::findOrFail($id);

        $posTagihan->update($request->only('nama'));

        return redirect()->route('postagihan.index')->with('success', 'Pos tagihan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $posTagihan = PosTagihan::findOrFail($id);

        $posTagihan->delete();
        return redirect()->route('postagihan.index')->with('success', 'Pos tagihan berhasil dihapus.');
    }
}
