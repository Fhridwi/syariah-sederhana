@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tahun Ajaran</h3>
                <a href="{{ route('angkatan.create') }}" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus me-1"></i> Tambah Tahun Ajaran
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'aktif')
                                        <form action="{{ route('angkatan.setAktif', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Sedang Aktif">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('angkatan.setAktif', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm" title="Klik untuk aktifkan">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                
                                <td>
                                    <a href="{{ route('angkatan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('angkatan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data tahun ajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
