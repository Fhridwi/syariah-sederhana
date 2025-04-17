@extends('template.app')

@section('content')
<div class="card">
    <div class="col-md-12 card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Data Jenis Pembayaran</h3>
        <a href="{{ route('jenis-pembayaran.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Jenis Pembayaran
        </a>
    </div>

    <div class="card-body">
        <!-- Filter & Search Form -->
        <form action="{{ route('jenis-pembayaran.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <select name="tahun_ajaran_id" class="form-control">
                    <option value="">Semua Tahun Ajaran</option>
                    @foreach($tahunList as $t)
                        <option value="{{ $t->id }}" {{ request('tahun_ajaran_id') == $t->id ? 'selected' : '' }}>
                            {{ $t->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Cari nama pembayaran..." value="{{ request('q') }}">
            </div>
            <div class="col-md-4">
                <button class="btn btn-secondary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                <a href="{{ route('jenis-pembayaran.index') }}" class="btn btn-light">Reset</a>
            </div>
        </form>

        <!-- Tabel -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>POS</th>
                    <th>Tahun Ajaran</th>
                    <th>Nama Pembayaran</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->posTagihan->nama }}</td>
                    <td>{{ $item->tahunAjaran->tahun }}</td>
                    <td>{{ $item->nama_pembayaran }}</td>
                    <td>{{ ucfirst($item->tipe) }}</td>
                    <td>
                        <a href="{{ route('jenis-pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis-pembayaran.destroy', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
