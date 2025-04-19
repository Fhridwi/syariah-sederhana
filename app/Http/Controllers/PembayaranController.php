<?php

namespace App\Http\Controllers;

use App\Models\angkatan;
use App\Models\Pembayaran;
use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    private $viewIndex = 'pembayaran_index';
    private $viewForm = 'pembayaran_form';
    private $viewEdit = 'pembayaran_Edit';
    private $viewShow = 'pembayaran_Show';
    private $route = 'admin.dataPembayaran';
    private $routePrefix = 'pembayaran';

    public function index()
    {
        $pembayarans = Pembayaran::with(['santri', 'tagihan'])->latest()->get();
        return view( $this->route. '.' . $this->viewIndex, compact('pembayarans'));
    }

    public function create(Request $request)
    {
        $santri = null;
        $bulanan = collect(); 

        if ($request->has('santri') && $request->santri != '') {
            $santri = Santri::where('nama', 'like', '%' . $request->santri . '%')
                            ->orWhere('nis', 'like', '%' . $request->santri . '%')
                            ->first();
        
            if ($santri) {
                $bulanan = Tagihan::with(['jenisPembayaran', 'pembayaran'])
                            ->where('santri_id', $santri->id)
                            ->whereHas('jenisPembayaran', function ($q) {
                                $q->where('periode', 'bulanan');
                            })->get();
            }
        }
    
        $tahunAjarans = angkatan::where('status', 'aktif')->pluck('tahun')->last();
    
        return view($this->route . '.' . $this->viewForm, compact('bulanan', 'santri', 'tahunAjarans'));
    }
    
    

    public function store(Request $request)
    {

        dd($request);
        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'santri_id' => 'required|exists:santris,id',
            'nominal_pembayaran' => 'required|integer|min:1',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|in:pending,terima,tolak',
            'keterangan_status' => 'nullable|string',
        ]);

        $buktiTransferPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Pembayaran::create([
            'id' => Str::uuid(),
            'nomor_pembayaran' => 'PAY-' . strtoupper(Str::random(10)),
            'tagihan_id' => $request->tagihan_id,
            'santri_id' => $request->santri_id,
            'nominal_pembayaran' => $request->nominal_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'penerima' => Auth::user()->name,
            'bukti_transfer' => $buktiTransferPath,
            'status' => Auth::check() ? 'terima' : 'pending',
            'keterangan_status' => $request->keterangan_status,
        ]);
        

        return redirect()->route($this->route . '.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['santri', 'tagihan'])->findOrFail($id);
        return view($this->route. '.' . $this->viewShow, compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $santris = Santri::where('status_santri', 'aktif')->get();
        $tagihans = Tagihan::with('santri')->get();
        return view($this->route. '.' . $this->viewEdit, compact('pembayaran', 'santris', 'tagihans'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'santri_id' => 'required|exists:santri,id',
            'nominal_pembayaran' => 'required|integer|min:1',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string|max:50',
            'bank_pengirim' => 'nullable|string|max:100',
            'nama_pengirim' => 'nullable|string|max:100',
            'penerima' => 'required|string|max:100',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|in:pending,terima,tolak',
            'keterangan_status' => 'nullable|string',
        ]);

        if ($request->hasFile('bukti_transfer')) {
            if ($pembayaran->bukti_transfer) {
                Storage::disk('public')->delete($pembayaran->bukti_transfer);
            }
            $pembayaran->bukti_transfer = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        $pembayaran->update([
            'tagihan_id' => $request->tagihan_id,
            'santri_id' => $request->santri_id,
            'nominal_pembayaran' => $request->nominal_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bank_pengirim' => $request->bank_pengirim,
            'nama_pengirim' => $request->nama_pengirim,
            'penerima' => $request->penerima,
            'status' => $request->status ?? 'pending',
            'keterangan_status' => $request->keterangan_status,
        ]);

        return redirect()->route($this->routePrefix . '.index')->with('success', 'Data pembayaran diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }

        $pembayaran->delete();

        return redirect()->route($this->routePrefix . '.index')->with('success', 'Data pembayaran dihapus.');
    }
}
