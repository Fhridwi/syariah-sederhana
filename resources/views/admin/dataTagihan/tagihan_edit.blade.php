@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Tarif Bulanan Siswa</h3>
                <div class="card-tools">
                    <a href="{{ url('jenisbayar') }}" class="btn btn-default btn-sm">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="" class="form-horizontal">
                    @csrf
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-5">
                            {{-- Informasi Tagihan --}}
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Tagihan</h3>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="idJenisBayar" value="17">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Jenis Bayar</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="Pembayaran SPP" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Tahun</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="2025-2026" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Tipe Bayar</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="bulanan" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Kelas</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="KB" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">NIS</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" value="08266" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Siswa</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="ARAKA WISANGGENI SURYONEGORO" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tarif Sama --}}
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Tarif Setiap Bulan Sama</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Tarif (Rp.)</label>
                                        <div class="col-sm-5">
                                            <input type="text" id="allTarif" name="allTarif" class="form-control harusAngka">
                                        </div>
                                        <div class="col-sm-3">
                                            <small class="text-muted">Tekan Enter</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-7">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Tarif Setiap Bulan Tidak Sama</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover mb-0">
                                            <tbody>
                                                @php
                                                    $months = [
                                                        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober',
                                                        11 => 'November', 12 => 'Desember', 1 => 'Januari', 2 => 'Februari',
                                                        3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'
                                                    ];
                                                @endphp

                                                @foreach ($months as $key => $month)
                                                <tr>
                                                    <input type="hidden" name="idt{{ $key }}" value="35{{ $key + 60 }}">
                                                    <td style="width: 120px; vertical-align: middle;">{{ $month }}</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp</span>
                                                            </div>
                                                            <input type="text" id="n{{ $key }}" name="n{{ $key }}" 
                                                                   class="form-control harusAngka text-right" value="500000">
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Update Tarif</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-header {
        padding: 0.75rem 1.25rem;
    }
    .form-control[readonly] {
        background-color: #f8f9fa;
    }
    .harusAngka {
        text-align: right;
    }
    .table td {
        vertical-align: middle;
    }
    .input-group-text {
        background-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Format angka
    $('.harusAngka').on('keyup', function() {
        this.value = formatRupiah(this.value);
    });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    }

    // Set all fields with same value
    $('#allTarif').on('keypress', function(e) {
        if(e.which == 13) {
            e.preventDefault();
            var value = $(this).val();
            $('input[id^="n"]').val(value);
        }
    });
});
</script>
@endpush