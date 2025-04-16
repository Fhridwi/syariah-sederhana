@extends('template.app')

@section('content')
<div class="card">
    <div class="card-header">{{ isset($jenis_pembayaran) ? 'Edit' : 'Tambah' }} Jenis Pembayaran</div>
    <div class="card-body">
        <form action="{{ isset($jenis_pembayaran) ? route('jenis-pembayaran.update', $jenis_pembayaran->id) : route('jenis-pembayaran.store') }}" method="POST">
            @csrf
            @if(isset($jenis_pembayaran))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label>POS Tagihan</label>
                <select name="pos_tagihan_id" class="form-control" required>
                    <option value="">Pilih POS</option>
                    @foreach($pos as $p)
                        <option value="{{ $p->id }}" {{ (isset($jenis_pembayaran) && $jenis_pembayaran->pos_tagihan_id == $p->id) ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tahun Ajaran</label>
                <select class="form-control" disabled>
                    <option value="">{{ $jenis_pembayaran->tahunAjaran->tahun ?? 'Pilih Tahun' }}</option>
                </select>
                <input type="hidden" name="tahun_ajaran_id" value="{{ $jenis_pembayaran->tahun_ajaran_id ?? $tahun->id }}">
            </div>
            

            <div class="mb-3">
                <label>Nama Pembayaran</label>
                <input type="text" name="nama_pembayaran" class="form-control" required
                    value="{{ old('nama_pembayaran', $jenis_pembayaran->nama_pembayaran ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Tipe</label>
                <select class="form-control" disabled>
                    <option value="bulanan" {{ (old('tipe', $jenis_pembayaran->tipe ?? '') == 'bulanan') ? 'selected' : '' }}>Bulanan</option>
                    <option value="bebas" {{ (old('tipe', $jenis_pembayaran->tipe ?? '') == 'bebas') ? 'selected' : '' }}>Bebas</option>
                </select>
                <input type="hidden" name="tipe" value="{{ old('tipe', $jenis_pembayaran->tipe ?? '') }}">
            </div>
            

            <button class="btn btn-success" type="submit">Simpan</button>
        </form>
    </div>
</div>
@endsection
