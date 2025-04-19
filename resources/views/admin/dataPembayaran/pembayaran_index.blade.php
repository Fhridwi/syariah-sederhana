@extends('template.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pembayaran Santri</h3>
                    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus me-1"></i> Tambah Pembayaran
                    </a>
                </div>
                
                <div class="card-body table-responsive">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Jenis Tagihan</th>
                                <th>Nominal</th>
                                <th>Tanggal Bayar</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Bukti Transfer</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayarans as $index => $pembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pembayaran->santri->nama ?? '-' }}</td>
                                    <td>{{ $pembayaran->tagihan->jenisPembayaran->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($pembayaran->nominal_pembayaran, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') }}</td>
                                    <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($pembayaran->status == 'terima') bg-success 
                                            @elseif($pembayaran->status == 'pending') bg-warning 
                                            @else bg-danger 
                                            @endif">
                                            {{ ucfirst($pembayaran->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($pembayaran->bukti_transfer)
                                            <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-info">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Belum ada data pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
