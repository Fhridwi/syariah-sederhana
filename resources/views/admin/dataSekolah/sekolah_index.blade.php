

@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Sekolah Formal</h3>
                <a href="{{ route('sekolahformal.create') }}" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus me-1"></i> Tambah Sekolah
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sekolahFormals as $key => $sekolah)
                            <tr>
                                <td>{{ $sekolahFormals->firstItem() + $key }}</td>
                                <td>{{ $sekolah->nama_sekolah }}</td>
                                <td>{{ $sekolah->alamat }}</td>
                                <td>{{ $sekolah->kontak }}</td>
                                <td>
                                    <a href="{{ route('sekolahformal.edit', $sekolah->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('sekolahformal.destroy', $sekolah->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sekolah ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data sekolah formal</td>
                            </tr>
                        @endforelse
                    </tbody>                    
                </table>
                {{ $sekolahFormals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
