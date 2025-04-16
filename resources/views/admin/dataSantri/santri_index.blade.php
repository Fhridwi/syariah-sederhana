@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Santri</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Sekolah</th>
                            <th>No. Telepon Ortu</th>
                            <th style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data statis -->
                        <tr>
                            <td>1.</td>
                            <td>123456</td>
                            <td>Ahmad Fauzi</td>
                            <td>Laki-laki</td>
                            <td>SMP Islam Al-Falah</td>
                            <td>081234567890</td>
                            <td>
                                <a href="{{ route('santri.edit', $s->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('santri.show', $s->id) }}" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('santri.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        <!-- Ulangi baris di atas untuk setiap santri -->
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          <!-- Pagination -->
            {{-- <div class="d-flex justify-content-end mt-3">
                {{ $data->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
