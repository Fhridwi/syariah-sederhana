@extends('template.app')
@section('content')
<div class="card">
    <div class="card-header">{{ isset($tarif) ? 'Edit' : 'Tambah' }} Tarif Pembayaran</div>
    <div class="card-body">
        <form method="POST" action="{{ isset($tarif) ? route('tarif-pembayaran.update', $tarif->id) : route('tarif-pembayaran.store') }}">
            @csrf
            @if(isset($tarif)) @method('PUT') @endif

            <div class="mb-3">
                <label>Jenis Pembayaran</label>
                <select name="jenis_pembayaran_id" class="form-control" required>
                    <option value="">Pilih Jenis</option>
                    @foreach($jenis as $j)
                        <option value="{{ $j->id }}" {{ (isset($tarif) && $tarif->jenis_pembayaran_id == $j->id) ? 'selected' : '' }}>
                            {{ $j->nama_pembayaran }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label>Nominal</label>
                <input type="number" name="nominal" class="form-control" value="{{ old('nominal', $tarif->nominal ?? '') }}" required>
            </div>

            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
