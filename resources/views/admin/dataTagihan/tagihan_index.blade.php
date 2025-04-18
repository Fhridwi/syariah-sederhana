@extends('template.app')

@section('content')
<div class="row">
    {{-- Sidebar Kiri --}}
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-success btn-block mb-3">+ Tambah Data</a>

                <h6>Filter</h6>
                <form method="GET" action="{{ route('tagihan.index') }}">
                    <select name="program" class="form-control">
                        <option value="">-- Semua --</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog }}" {{ request('program') == $prog ? 'selected' : '' }}>
                                {{ $prog }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="tahun_ajaran" class="form-control mt-3">
                        <option value="">-- Semua --</option>
                        @foreach($tahunAjarans as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    

                    <button class="btn btn-primary btn-block mt-2">Terapkan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Konten Kanan --}}
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Data Tagihan Wali Santri</h5>
            </div>
            <div class="card-body">
                @foreach($santris as $santri)
                    <div class="mb-3 border p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $santri->nama }}</strong> ({{ $santri->program }}) - {{ $santri->angkatan }}
                            </div>
                            <button class="btn btn-sm btn-outline-secondary toggle-tagihan" data-id="{{ $santri->id }}">
                                Tampilkan Tagihan
                            </button>
                        </div>

                        <div class="tagihan-detail mt-3" id="tagihan-{{ $santri->id }}" style="display: none;">
                            {{-- Kelompokkan tagihan --}}
                            @php
                                $bulanan = $santri->tagihans->filter(fn($t) => $t->jenisPembayaran->tipe == 'bulanan');
                                $semesteran = $santri->tagihans->filter(fn($t) => $t->jenisPembayaran->tipe == 'semesteran');
                                $tahunan = $santri->tagihans->filter(fn($t) => $t->jenisPembayaran->tipe == 'tahunan');
                            @endphp

                            @if($bulanan->isNotEmpty())
                                <h6 class="mt-2">Tagihan Bulanan</h6>
                                <ul>
                                    @foreach($bulanan as $b)
                                        <li>{{ $b->jenisPembayaran->nama }} - Rp {{ number_format($b->nominal) }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($semesteran->isNotEmpty())
                                <h6 class="mt-2">Tagihan Semesteran</h6>
                                <ul>
                                    @foreach($semesteran as $s)
                                        <li>{{ $s->jenisPembayaran->nama }} - Rp {{ number_format($s->nominal) }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($tahunan->isNotEmpty())
                                <h6 class="mt-2">Tagihan Tahunan / Lainnya</h6>
                                <ul>
                                    @foreach($tahunan as $t)
                                        <li>{{ $t->jenisPembayaran->nama }} - Rp {{ number_format($t->nominal) }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.toggle-tagihan').click(function () {
            const id = $(this).data('id');
            const detail = $('#tagihan-' + id);

            // Sembunyikan semua
            $('.tagihan-detail').not(detail).slideUp();

            // Toggle yang diklik
            detail.slideToggle();
        });
    });
</script>
@endsection
