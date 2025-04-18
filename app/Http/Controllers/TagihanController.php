<?php

namespace App\Http\Controllers;

use App\Models\angkatan;
use App\Models\Tagihan;
use App\Models\Santri;
use App\Models\JenisPembayaran;
use App\Models\Program;
use App\Models\TarifPembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagihanController extends Controller
{
    public function index(Request $request)
{
    $query = Santri::with(['tagihans.jenisPembayaran']); // Hapus pembayarans dari sini

    // Filter tetap sama
    if ($request->filled('program')) {
        $query->where('program', $request->program);
    }

    if ($request->filled('tahun_ajaran')) {
        $query->whereHas('tagihans', function($q) use ($request) {
            $q->where('tahun_ajaran', $request->tahun_ajaran);
        });
    }

    $santris = $query->get();

    $programs = Santri::select('program')->distinct()->pluck('program');
    $tahunAjarans = Tagihan::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

    return view('admin.dataTagihan.tagihan_index', compact('santris', 'programs', 'tahunAjarans'));
}

    

    public function create()
    {
        $santris = Santri::all();
        $jenisPembayarans = JenisPembayaran::all();
        $tarifPembayarans = TarifPembayaran::all();
        $tahunAjarans     = Angkatan::where('status', 'aktif')->get();
        return view('admin.dataTagihan.tagihan_form', compact('santris', 'jenisPembayarans', 'tarifPembayarans', 'tahunAjarans'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'jenis_pembayaran_id' => 'required',
            'tarif_pembayaran_id' => 'required',
            'nominal' => 'required|integer',
            'periode' => 'required|in:bulanan,semesteran,tahunan',
            'tahun_ajaran' => 'required',
        ]);
    
        $bulanMap = [
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
        ];
    
        $tahunAjaranModel = angkatan::findOrFail($request->tahun_ajaran);
        $tahunAjaran = explode('/', $tahunAjaranModel->tahun);
    
        if (count($tahunAjaran) !== 2) {
            return back()->withErrors(['tahun_ajaran' => 'Format tahun ajaran tidak valid.']);
        }
    
        $tahun1 = $tahunAjaran[0];
        $tahun2 = $tahunAjaran[1];
    
        // Jika santri_id adalah "all", ambil semua santri
        $santris = $request->santri_id === 'all'
            ? Santri::all()
            : Santri::where('id', $request->santri_id)->get();
    
        foreach ($santris as $santri) {
            if ($request->periode === 'bulanan') {
                foreach ($bulanMap as $index => $bulan) {
                    $tahun = $index < 6 ? $tahun1 : $tahun2;
                    $tanggalTempo = Carbon::createFromDate($tahun, ($index + 7 > 12 ? $index - 5 : $index + 7 - 6), 10);
    
                    Tagihan::create([
                        'id' => Str::uuid(),
                        'santri_id' => $santri->id,
                        'jenis_pembayaran_id' => $request->jenis_pembayaran_id,
                        'tarif_pembayaran_id' => $request->tarif_pembayaran_id,
                        'nominal' => $request->nominal,
                        'periode' => 'bulanan',
                        'bulan_tagihan' => $bulan . ' ' . $tahun,
                        'jatuh_tempo' => $tanggalTempo->format('Y-m-d'),
                        'status' => 'belum',
                        'tahun_ajaran' => $request->tahun_ajaran,
                    ]);
                }
            } elseif ($request->periode === 'semesteran') {
                $semesters = ['Semester 1', 'Semester 2'];
                foreach ($semesters as $i => $semester) {
                    $tahun = $i == 0 ? $tahun1 : $tahun2;
                    $jatuhTempo = Carbon::createFromDate($tahun, $i == 0 ? 8 : 2, 10);
    
                    Tagihan::create([
                        'id' => Str::uuid(),
                        'santri_id' => $santri->id,
                        'jenis_pembayaran_id' => $request->jenis_pembayaran_id,
                        'tarif_pembayaran_id' => $request->tarif_pembayaran_id,
                        'nominal' => $request->nominal,
                        'periode' => 'semesteran',
                        'bulan_tagihan' => $semester . ' ' . $tahun,
                        'jatuh_tempo' => $jatuhTempo,
                        'status' => 'belum',
                        'tahun_ajaran' => $request->tahun_ajaran,
                    ]);
                }
            } else {
                $jatuhTempo = Carbon::createFromDate($tahun1, 7, 10);
    
                Tagihan::create([
                    'id' => Str::uuid(),
                    'santri_id' => $santri->id,
                    'jenis_pembayaran_id' => $request->jenis_pembayaran_id,
                    'tarif_pembayaran_id' => $request->tarif_pembayaran_id,
                    'nominal' => $request->nominal,
                    'periode' => 'tahunan',
                    'bulan_tagihan' => $request->tahun_ajaran,
                    'jatuh_tempo' => $jatuhTempo,
                    'status' => 'belum',
                    'tahun_ajaran' => $request->tahun_ajaran,
                ]);
            }
        }
    
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibuat.');
    }
    
    

    public function destroy(string $id)
    {
        $tagihan = Tagihan::find($id);
        
        if (!$tagihan) {
            return redirect()->route('tagihan.index')
                ->with('error', 'Tagihan tidak ditemukan.');
        }
        
        $tagihan->delete();
        
        return redirect()->route('tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }
}
