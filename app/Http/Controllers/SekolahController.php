<?php
namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolahFormals = Sekolah::latest()->paginate(10);
        return view('admin.dataSekolah.sekolah_index', compact('sekolahFormals'));
    }

    public function create()
    {
        return view('admin.dataSekolah.sekolah_form');
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        Sekolah::create($request->all());
        return redirect()->route('sekolahformal.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sekolahFormal = Sekolah::findOrFail($id);
        return view('admin.dataSekolah.sekolah_edit', compact('sekolahFormal'));
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request);
        $sekolahFormal = Sekolah::findOrFail($id);
        $sekolahFormal->update($request->all());
        return redirect()->route('sekolahformal.index')->with('success', 'Sekolah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sekolahFormal = Sekolah::findOrFail($id);
        $sekolahFormal->delete();
        return redirect()->route('sekolahformal.index')->with('success', 'Sekolah berhasil dihapus.');
    }

    protected function validateData(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
        ]);
    }
}
