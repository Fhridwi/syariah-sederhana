@extends('template.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Data Santri</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('datasantri.update', $santri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- NIS --}}
                    <div class="col-md-6">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
                            value="{{ old('nis', $santri->nis) }}" required>
                        @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $santri->nama) }}" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Angkatan --}}
                    <div class="col-md-6">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                            value="{{ old('angkatan', $santri->angkatan) }}" required>
                        @error('angkatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            value="{{ old('tempat_lahir', $santri->tempat_lahir) }}">
                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}">
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            rows="2">{{ old('alamat', $santri->alamat) }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Program --}}
                    <div class="col-md-6">
                        <label for="program" class="form-label">Program</label>
                        <select name="program" id="program" class="form-control @error('program') is-invalid @enderror">
                            @foreach ($program as $program)
                                <option value="{{ $program }}" {{ old('program', $santri->program) == $program ? 'selected' : '' }}>
                                    {{ $program }}
                                </option>
                            @endforeach
                        </select>
                        @error('program') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Sekolah Formal --}}
                    <div class="col-md-6">
                        <label for="sekolah_formal" class="form-label">Sekolah Formal</label>
                        <select name="sekolah_formal" id="sekolah_formal" class="form-control @error('sekolah_formal') is-invalid @enderror">
                            @foreach ($sekolah as $sekolah)
                                <option value="{{ $sekolah }}" {{ old('sekolah_formal', $santri->sekolah_formal) == $sekolah ? 'selected' : '' }}>
                                    {{ $sekolah }}
                                </option>
                            @endforeach
                        </select>
                        @error('sekolah_formal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Madrasah Diniyah --}}
                    <div class="col-md-6">
                        <label for="madrasah_diniyah" class="form-label">Madrasah Diniyah</label>
                        <input type="text" name="madrasah_diniyah" id="madrasah_diniyah"
                            class="form-control @error('madrasah_diniyah') is-invalid @enderror"
                            value="{{ old('madrasah_diniyah', $santri->madrasah_diniyah) }}">
                        @error('madrasah_diniyah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Telepon Orang Tua --}}
                    <div class="col-md-6">
                        <label for="telepon_orang_tua" class="form-label">Telepon Orang Tua</label>
                        <input type="text" name="telepon_orang_tua" id="telepon_orang_tua"
                            class="form-control @error('telepon_orang_tua') is-invalid @enderror"
                            value="{{ old('telepon_orang_tua', $santri->telepon_orang_tua) }}">
                        @error('telepon_orang_tua') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Pas Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control p-1 @error('foto') is-invalid @enderror">
                        @if ($santri->foto)
                            <small class="text-muted">Foto saat ini: {{ $santri->foto }}</small>
                        @endif
                        @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Status Santri --}}
                    <div class="col-md-6 mb-3">
                        <label for="status_santri" class="form-label">Status Santri</label>
                        <select name="status_santri" id="status_santri" class="form-control @error('status_santri') is-invalid @enderror" required>
                            <option value="aktif" {{ old('status_santri', $santri->status_santri) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="alumni" {{ old('status_santri', $santri->status_santri) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        </select>
                        @error('status_santri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="col-12 text-end">
                        <a href="{{ route('datasantri.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
