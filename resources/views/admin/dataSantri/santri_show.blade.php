@extends('template.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Detail Santri</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto Santri -->
                        <div class="col-md-3 text-center">
                            @if ($santri->foto)
                                <img src="{{ asset('storage/foto-santri/' . $santri->foto) }}" alt="Foto Santri" class="img-thumbnail" width="200">
                            @else
                                <p><em>Foto tidak tersedia</em></p>
                            @endif
                        </div>

                        <!-- Data Santri -->
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $santri->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIS</th>
                                        <td>{{ $santri->nis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>{{ $santri->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $santri->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program</th>
                                        <td>{{ $santri->program }}</td>
                                    </tr>
                                    <tr>
                                        <th>Angkatan</th>
                                        <td>{{ $santri->angkatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sekolah Formal</th>
                                        <td>{{ $santri->sekolah_formal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Madrasah Diniyah</th>
                                        <td>{{ $santri->madrasah_diniyah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon Orang Tua</th>
                                        <td>{{ $santri->telepon_orang_tua }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Santri</th>
                                        <td>{{ $santri->status_santri == 'aktif' ? 'Aktif' : 'Alumni' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('datasantri.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar Santri</a>

                        <div>
                            <a href="" class="btn btn-primary btn-sm">Cetak</a>
                            <a href="mailto:{{ $santri->telepon_orang_tua }}" class="btn btn-info btn-sm">Kirim ke Orang Tua</a>
                            <button class="btn btn-warning btn-sm" onclick="alert('Fitur Lain Akan Ditambahkan!')">Fitur Lain</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
