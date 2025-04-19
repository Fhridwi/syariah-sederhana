@extends('template.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">PEMBAYARAN SANTRI</h3>
            </div>
            <div class="card-body">
                {{-- TAHUN AJARAN  --}}
                {{-- FORM PENCARIAN SANTRI --}} 
                <form action="{{ route('pembayaran.create') }}" method="GET" class="form-inline mb-3">
                    <div class="form-group mr-2">
                        <label for="santri" class="mr-2">Cari Santri</label>
                        <input type="text" name="tahun" id="tahun" class="form-control mx-2" value="{{ $tahunAjarans }}" readonly>
                        <input type="text" class="form-control" id="santri" name="santri" placeholder="Nama atau NIS" value="{{ request('santri') }}">
                    </div>
                    <button type="submit" class="btn btn-success">Cari</button>
                </form>
                <div class="mt-3">
                    <a href="{{ route('tagihan.create') }}" class="btn btn-warning">
                        <i class="fas fa-sync"></i> Reset Pencarian
                    </a>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($santri)
<div class="row mt-4">
    <div class="col-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">INFO SANTRI</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr><td>Nama</td><td>:</td><td>{{ $santri->nama }}</td></tr>
                        <tr><td>NIS</td><td>:</td><td>{{ $santri->nis }}</td></tr>
                        <tr><td>TTL</td><td>:</td><td>{{ $santri->tempat_lahir }}, {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d M Y') }}</td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><td>Program</td><td>:</td><td>{{ $santri->program }}</td></tr>
                        <tr><td>Angkatan</td><td>:</td><td>{{ $santri->angkatan }}</td></tr>
                        <tr><td>Status</td><td>:</td><td><span class="badge badge-success">{{ ucfirst($santri->status_santri) }}</span></td></tr>
                        <tr><td>No. WA Orang Tua</td><td>:</td><td>{{ $santri->telepon_orang_tua }}</td></tr>
                        <tr><td>Tahun Ajaran</td><td>:</td><td>{{ $tahunAjarans }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-header bg-warning">
                <h3 class="card-title">PEMBAYARAN TAGIHAN BULANAN</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tagihan</th>
                            <th>Tgl. Bayar</th>
                            <th>Opsi</th>
                            <th>Bayar</th>
                            <th>Cetak</th>
                            <th>WA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bulanan as $tagihan)
                            @php
                                $pembayaran = $tagihan->pembayaran;
                                $sudahBayar = $pembayaran !== null;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tagihan->bulan_tagihan }}</td>
                                <td>Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                <td>
                                    @if ($sudahBayar)
                                        {{ $pembayaran->tanggal_pembayaran->format('Y-m-d') }}
                                    @else
                                        <input type="date" name="tanggal_pembayaran" class="form-control form-control-sm"
                                            form="formBayar{{ $tagihan->id }}" value="{{ now()->format('Y-m-d') }}">
                                    @endif
                                </td>
                                                                <td>
                                    @if (!$sudahBayar)
                                        <select name="metode_pembayaran" class="form-control form-control-sm" form="formBayar{{ $tagihan->id }}">
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    @else
                                        <span class="badge badge-{{ $pembayaran->metode_pembayaran == 'Transfer' ? 'primary' : 'success' }}">
                                            {{ $pembayaran->metode_pembayaran }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$sudahBayar)
                                        <form action="{{ route('pembayaran.store') }}" method="POST" id="formBayar{{ $tagihan->id }}">
                                            @csrf
                                            <input type="hidden" name="tagihan_id" value="{{ $santri->id }}">
                                            <input type="hidden" name="santri_id" value="{{ $santri->id }}">
                                            <input type="hidden" name="nominal_pembayaran" value="{{ $tagihan->nominal }}">
                                            <input type="hidden" name="tanggal_pembayaran" value="{{ now()->format('Y-m-d') }}">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled><i class="fas fa-check"></i></button>
                                    @endif
                                </td>
                                <td>
                                    @if ($sudahBayar)
                                        <a href="{{ route('pembayaran.cetak', $pembayaran->id) }}" class="btn btn-sm btn-info"><i class="fas fa-print"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($sudahBayar)
                                        <a href="https://wa.me/{{ $santri->telepon_orang_tua }}?text=Assalamualaikum, tagihan bulan {{ $tagihan->bulan }} sebesar Rp{{ number_format($tagihan->nominal, 0, ',', '.') }} sudah dibayarkan. Terima kasih." target="_blank" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

                             
@endsection
