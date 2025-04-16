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

                        <div class="col-md-6">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" name="nis" id="nis" class="form-control" required
                                value="{{ $santri->nis }}">
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" required
                                value="{{ $santri->nama }}">
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="L" {{ $santri->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $santri->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" name="angkatan" id="angkatan" class="form-control" required
                                value="{{ $santri->angkatan }}">
                        </div>

                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                value="{{ $santri->tempat_lahir }}">
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                value="{{ $santri->tanggal_lahir }}">
                        </div>

                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="2">{{ $santri->alamat }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="program" class="form-label">Program</label>
                            <input type="text" name="program" id="program" class="form-control"
                                value="{{ $santri->program }}">
                        </div>

                        <div class="col-md-6">
                            <label for="sekolah_formal" class="form-label">Sekolah Formal</label>
                            <input type="text" name="sekolah_formal" id="sekolah_formal" class="form-control"
                                value="{{ $santri->sekolah_formal }}">
                        </div>

                        <div class="col-md-6">
                            <label for="madrasah_diniyah" class="form-label">Madrasah Diniyah</label>
                            <input type="text" name="madrasah_diniyah" id="madrasah_diniyah" class="form-control"
                                value="{{ $santri->madrasah_diniyah }}">
                        </div>

                        <div class="col-md-6">
                            <label for="telepon_orang_tua" class="form-label">Telepon Orang Tua</label>
                            <input type="text" name="telepon_orang_tua" id="telepon_orang_tua" class="form-control"
                                value="{{ $santri->telepon_orang_tua }}">
                        </div>

                        <div class="col-md-6">
                            <label for="foto" class="form-label">Pas Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control p-1">
                            @if ($santri->foto)
                                <small class="text-muted">Foto saat ini: {{ $santri->foto }}</small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status_santri" class="form-label">Status Santri</label>
                            <select name="status_santri" id="status_santri" class="form-control" required>
                                <option value="aktif" {{ $santri->status_santri == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="alumni" {{ $santri->status_santri == 'alumni' ? 'selected' : '' }}>Alumni</option>
                            </select>
                        </div>

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
