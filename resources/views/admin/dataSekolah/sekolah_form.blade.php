@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Sekolah Formal</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('sekolahformal.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah') }}" placeholder="Masukkan nama sekolah" required>
                        @error('nama_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat sekolah" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenjang" class="form-label">jenjang</label>
                        <input type="text" name="jenjang" id="jenjang" class="form-control @error('jenjang') is-invalid @enderror" value="{{ old('jenjang') }}" placeholder="Masukkan nomor kontak (opsional)">
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
