@extends('template.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tarif Pembayaran</h3>
        <a href="{{ route('tarif-pembayaran.create') }}" class="btn btn-primary float-right">Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Pembayaran</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->jenisPembayaran->nama_pembayaran }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('tarif-pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tarif-pembayaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
