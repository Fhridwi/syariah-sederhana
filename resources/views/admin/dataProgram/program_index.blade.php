{{-- resources/views/program/index.blade.php --}}
@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Program Pesantren</h3>
                <a href="{{ route('program.create') }}" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus me-1"></i> Tambah Program
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Deskripsi Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $key => $program)
                            <tr>
                                <td>{{ $programs->firstItem() + $key }}.</td>
                                <td>{{ $program->nama_program }}</td>
                                <td>{{ $program->deskripsi_program }}</td>
                                <td class="text-center">
                                    <a href="{{ route('program.edit', $program->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('program.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada program.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
