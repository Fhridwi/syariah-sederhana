@extends('template.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Data Santri</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('datasantri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" required placeholder="Masukkan Nomor Induk Santri">
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap santri">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan') }}" required placeholder="Contoh: 2022/2023">
                        @error('angkatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir santri">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" placeholder="Masukkan alamat lengkap santri">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="program" class="form-label">Program</label>
                        <select name="program" id="program" class="form-control @error('program') is-invalid @enderror" required>
                            <option value="">-- Pilih Program --</option>
                            @foreach($program as $p)
                                <option value="{{ $p->nama_program }}" {{ old('program') == $p->id ? 'selected' : '' }}>{{ $p->nama_program }}</option>
                            @endforeach
                        </select>
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="sekolah" class="form-label">Sekolah Formal</label>
                        <select name="sekolah_formal" class="form-control @error('sekolah') is-invalid @enderror" required>
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach($sekolah as $s)
                                <option value="{{ $s->nama_sekolah }}" {{ old('sekolah') == $s->nama_sekolah ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                            @endforeach
                        </select>
                        @error('sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="madrasah_diniyah" class="form-label">Madrasah Diniyah</label>
                        <input type="text" name="madrasah_diniyah" id="madrasah_diniyah" class="form-control @error('madrasah_diniyah') is-invalid @enderror" value="{{ old('madrasah_diniyah') }}" placeholder="Contoh: Madin Nurul Huda">
                        @error('madrasah_diniyah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telepon_orang_tua" class="form-label">Telepon Orang Tua</label>
                        <input type="text" name="telepon_orang_tua" id="telepon_orang_tua" class="form-control @error('telepon_orang_tua') is-invalid @enderror" value="{{ old('telepon_orang_tua') }}" placeholder="Masukkan nomor HP aktif orang tua">
                        @error('telepon_orang_tua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="foto" class="form-label">Pas Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control p-1 @error('foto') is-invalid @enderror">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status_santri" class="form-label">Status Santri</label>
                        <select name="status_santri" id="status_santri" class="form-control @error('status_santri') is-invalid @enderror" required>
                            <option value="aktif" {{ old('status_santri') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="alumni" {{ old('status_santri') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        </select>
                        @error('status_santri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 text-end">
                        <a href="{{ route('datasantri.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
