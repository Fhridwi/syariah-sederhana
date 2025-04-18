@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Tagihan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tagihan.store') }}" method="POST">
                    @csrf

                    {{-- Santri --}}
                    <div class="mb-3">
                        <label for="santri_id" class="form-label">Santri</label>
                        <select name="santri_id" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            <option value="all">-- Semua Santri --</option>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->id }}">{{ $santri->nama }} - {{ $santri->nis }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenis Pembayaran --}}
                    <div class="mb-3">
                        <label for="jenis_pembayaran_id" class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran_id" class="form-control" required>
                            <option value="">-- Pilih Jenis Pembayaran --</option>
                            @foreach ($jenisPembayarans as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_pembayaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tarif Pembayaran --}}
                    <div class="mb-3">
                        <label for="tarif_pembayaran_id" class="form-label">Tarif Pembayaran</label>
                        <select name="tarif_pembayaran_id" id="tarif_pembayaran_id" class="form-control" required>
                            <option value="">-- Pilih Tarif --</option>
                            @foreach ($tarifPembayarans as $tarif)
                                <option value="{{ $tarif->id }}" data-nominal="{{ $tarif->nominal }}">
                                    {{ $tarif->jenisPembayaran->nama_pembayaran }} - Rp {{ number_format($tarif->nominal, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nominal (format tampilan) --}}
                        <div class="mb-3">
                            <label for="nominal_display" class="form-label">Nominal</label>
                            <input type="text" id="nominal_display" class="form-control" readonly>
                        </div>

                        {{-- Nominal (nilai asli yang dikirim ke server) --}}
                        <input type="hidden" name="nominal" id="nominal">

                    {{-- Periode --}}
                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <select name="periode" class="form-control" required>
                            <option value="">-- Pilih Periode --</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="semesteran">Semesteran</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>

                    {{-- Tahun Ajaran (Opsional) --}}
                    
                    <div class="mb-3">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach ($tahunAjarans as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                   

                    {{-- Jatuh Tempo --}}
                    <div class="mb-3">
                        <label for="jatuh_tempo" class="form-label">Tanggal Jatuh Tempo (awal)</label>
                        <input type="date" name="jatuh_tempo" class="form-control" >
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Tagihan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tarifSelect = document.getElementById('tarif_pembayaran_id');
        const nominalInput = document.getElementById('nominal'); 
        const nominalDisplay = document.getElementById('nominal_display'); 

        tarifSelect.addEventListener('change', function () {
            const selected = tarifSelect.options[tarifSelect.selectedIndex];
            const nominal = selected.getAttribute('data-nominal');

            if (nominal) {
                nominalInput.value = nominal; 
                nominalDisplay.value = formatRupiah(nominal); 
            } else {
                nominalInput.value = '';
                nominalDisplay.value = '';
            }
        });

        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }
    });
</script>

@endsection
