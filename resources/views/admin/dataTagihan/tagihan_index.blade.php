@extends('template.app')

@section('content')
<section class="content">
    {{-- TAGIHAN BULANAN --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Tagihan santri</h3>
                    <a href="{{ route('tagihan.create') }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus me-1"></i> Tambah Sekolah
                    </a>
                </div>
                
                <div class="card-body">
                    <form method="GET" action="{{ route('tagihan.index') }}" class="row mb-3">
                        <div class="col-md-3">
                            <label>Program</label>
                            <select class="form-control" name="program" onchange="this.form.submit()">
                                <option value="">Semua Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program }}" {{ request('program') == $program ? 'selected' : '' }}>{{ $program }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select class="form-control" name="status" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Lunas</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <a href="{{ route('tagihan.index') }}" class="btn btn-default">Reset</a>
                        </div>
                    </form>

                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark">
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Program</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihanBulanan as $santriId => $group)
                                @php
                                    $santri = $group->first()->santri;
                                    $tahun = $group->first()->angkatan->tahun;
                                @endphp
                                <tr class="santri-row" data-santri="{{ $santriId }}">
                                    <td>
                                        <button class="btn btn-sm btn-toggle-detail" data-santri="{{ $santriId }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>{{ $santri->nis }}</td>
                                    <td>{{ strtoupper($santri->nama) }}</td>
                                    <td>{{ $santri->program }}</td>
                                    <td>{{ $tahun }}</td>
                                    <td>
                                        <a href="{{ route('tagihan.edit', $santri->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tagihan.destroy', $santri->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin hapus?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                <tr class="detail-row" id="detail-{{ $santriId }}" style="display: none;">
                                    <td colspan="6">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>Jenis</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($group->sortBy('bulan_tagihan') as $tagihan)
                                                    <tr>
                                                        <td>{{ ucfirst($tagihan->bulan_tagihan) }}</td>
                                                        <td>{{ $tagihan->jenisPembayaran->nama_pembayaran }}</td>
                                                        <td>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                                        <td>
                                                            <span class="badge {{ $tagihan->status == 'lunas' ? 'badge-success' : 'badge-danger' }}">
                                                                {{ strtoupper($tagihan->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm d-flex justify-content-center gap-2 flex-wrap">
                                                                @if($santri->telpon_orang_tua)
                                                                <button class="btn btn-success kirim-wa" 
                                                                        data-santri="{{ $santriId }}"
                                                                        data-nama="{{ $santri->nama }}"
                                                                        data-telpon="{{ $santri->telpon_orang_tua }}"
                                                                        title="Kirim WhatsApp">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </button>
                                                                @endif
                                                                @if($santri->email_orang_tua)
                                                                <button class="btn btn-danger kirim-email" 
                                                                        data-santri="{{ $santriId }}"
                                                                        data-nama="{{ $santri->nama }}"
                                                                        data-email="{{ $santri->email_orang_tua }}"
                                                                        title="Kirim Email">
                                                                    <i class="fas fa-envelope"></i>
                                                                </button>
                                                                @endif
                                                                <a href="{{ route('tagihan.create', ['santri_id' => $santri->id]) }}" 
                                                                   class="btn btn-primary" title="Tambah Tagihan">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                                <button class="btn btn-info cetak-tagihan" 
                                                                        data-santri="{{ $santriId }}"
                                                                        title="Cetak Tagihan">
                                                                    <i class="fas fa-print"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- TAGIHAN LAINNYA --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tagihan Lainnya / Bebas</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark">
                            <tr>
                                <th>#</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Program</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tagihanLainnya->groupBy('santri_id') as $santriId => $group)
                                @php
                                    $santri = $group->first()->santri;
                                    $tahun = $group->first()->angkatan->tahun;
                                @endphp
                                <tr class="santri-row" data-santri="lain-{{ $santriId }}">
                                    <td>
                                        <button class="btn btn-sm btn-toggle-detail" data-santri="lain-{{ $santriId }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                    <td>{{ $santri->nis }}</td>
                                    <td>{{ strtoupper($santri->nama) }}</td>
                                    <td>{{ $santri->program }}</td>
                                    <td>{{ $tahun }}</td>
                                    <td>
                                        <a href="{{ route('tagihan.edit', $santri->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tagihan.destroy', $santri->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin hapus?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                <tr class="detail-row" id="detail-lain-{{ $santriId }}" style="display: none;">
                                    <td colspan="6">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Jenis</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($group as $tagihan)
                                                    <tr>
                                                        <td>{{ $tagihan->jenisPembayaran->nama_pembayaran }}</td>
                                                        <td>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                                        <td>
                                                            <span class="badge {{ $tagihan->status == 'lunas' ? 'badge-success' : 'badge-danger' }}">
                                                                {{ strtoupper($tagihan->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm d-flex justify-content-center gap-2 flex-wrap">
                                                                @if($santri->telpon_orang_tua)
                                                                <button class="btn btn-success kirim-wa" 
                                                                        data-santri="{{ $santriId }}"
                                                                        data-nama="{{ $santri->nama }}"
                                                                        data-telpon="{{ $santri->telpon_orang_tua }}"
                                                                        title="Kirim WhatsApp">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </button>
                                                                @endif
                                                                @if($santri->email_orang_tua)
                                                                <button class="btn btn-danger kirim-email" 
                                                                        data-santri="{{ $santriId }}"
                                                                        data-nama="{{ $santri->nama }}"
                                                                        data-email="{{ $santri->email_orang_tua }}"
                                                                        title="Kirim Email">
                                                                    <i class="fas fa-envelope"></i>
                                                                </button>
                                                                @endif
                                                                <a href="{{ route('tagihan.create', ['santri_id' => $santri->id]) }}" 
                                                                   class="btn btn-primary" title="Tambah Tagihan">
                                                                    <i class="fas fa-plus"></i>
                                                                </a>
                                                                <button class="btn btn-info cetak-tagihan" 
                                                                        data-santri="{{ $santriId }}"
                                                                        title="Cetak Tagihan">
                                                                    <i class="fas fa-print"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</section>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.btn-toggle-detail');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const santriId = this.dataset.santri;
            const detailRow = document.getElementById('detail-' + santriId);
            const icon = this.querySelector('i');

            const isVisible = detailRow.style.display === 'table-row';

            // Sembunyikan semua detail dulu
            document.querySelectorAll('.detail-row').forEach(row => row.style.display = 'none');
            document.querySelectorAll('.btn-toggle-detail i').forEach(ic => {
                ic.classList.remove('fa-minus');
                ic.classList.add('fa-plus');
            });

            // Kalau sebelumnya belum tampil, tampilkan
            if (!isVisible) {
                detailRow.style.display = 'table-row';
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        });
    });
});

</script>
@endsection
