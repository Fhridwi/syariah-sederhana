@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Data Santri</h3>
            </div>

        <!-- Filter Form -->
<form action="{{ route('datasantri.index') }}" method="GET" class="row g-3 p-3 align-items-end">
    <div class="col-md-3">
        <label for="cari" class="form-label">Cari Nama / NIS</label>
        <input type="text" name="cari" id="cari" value="{{ request('cari') }}" class="form-control" placeholder="Nama atau NIS">
    </div>

    <div class="col-md-2">
        <label for="angkatan" class="form-label">Filter Angkatan</label>
        <select name="angkatan" id="angkatan" class="form-control">
            <option value="">Semua</option>
            @foreach($angkatanList as $angkatan)
                <option value="{{ $angkatan }}" {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                    {{ $angkatan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label for="jk" class="form-label">Jenis Kelamin</label>
        <select name="jk" id="jk" class="form-control">
            <option value="">Semua</option>
            <option value="L" {{ request('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ request('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-filter me-1"></i> Filter
        </button>
    </div>

    <div class="mx-2">
        <a href="#" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Import Excel
        </a>
    </div>
    <div class="">
        <a href="{{ route('datasantri.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Data Santri
        </a>
    </div>
    
</form>

            <!-- Table -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Sekolah</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santri as $key => $s)
                            <tr class="text-center">
                                <td>{{ $santri->firstItem() + $key }}.</td>
                                <td>{{ $s->nis }}</td>
                                <td class="text-start">{{ strtoupper($s->nama) }}</td>
                                <td>{{ $s->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                                <td class="text-start">{{ strtoupper($s->sekolah_formal) }}</td>
                                <td>{{ $s->angkatan }}</td>
                                <td>
                                    <span class="badge {{ $s->status_santri == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ strtoupper($s->status_santri) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('datasantri.edit', $s->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('datasantri.show', $s->id) }}" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('datasantri.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data santri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $santri->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
