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
                        <input type="text" name="nis" id="nis" class="form-control" required placeholder="Masukkan Nomor Induk Santri">
                    </div>

                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan nama lengkap santri">
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="form-control" required placeholder="Contoh: 2022/2023">
                    </div>

                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir santri">
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap santri"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="program" class="form-label">Program</label>
                        <input type="text" name="program" id="program" class="form-control" placeholder="Contoh: Tahfidz, Takhassus, dll">
                    </div>

                    <div class="col-md-6">
                        <label for="sekolah_formal" class="form-label">Sekolah Formal</label>
                        <input type="text" name="sekolah_formal" id="sekolah_formal" class="form-control" placeholder="Contoh: SMA 1 Madiun">
                    </div>

                    <div class="col-md-6">
                        <label for="madrasah_diniyah" class="form-label">Madrasah Diniyah</label>
                        <input type="text" name="madrasah_diniyah" id="madrasah_diniyah" class="form-control" placeholder="Contoh: Madin Nurul Huda">
                    </div>

                    <div class="col-md-6">
                        <label for="telepon_orang_tua" class="form-label">Telepon Orang Tua</label>
                        <input type="text" name="telepon_orang_tua" id="telepon_orang_tua" class="form-control" placeholder="Masukkan nomor HP aktif orang tua">
                    </div>

                    <div class="col-md-6">
                        <label for="foto" class="form-label">Pas Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control p-1">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status_santri" class="form-label">Status Santri</label>
                        <select name="status_santri" id="status_santri" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="alumni">Alumni</option>
                        </select>
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
