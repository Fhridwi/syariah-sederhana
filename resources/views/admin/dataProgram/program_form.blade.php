@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Program</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('program.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_program" class="form-label">Nama Program</label>
                        <input type="text" name="nama_program" id="nama_program" class="form-control @error('nama_program') is-invalid @enderror" 
                               value="{{ old('nama_program') }}" placeholder="Masukkan nama program" required>
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_program" class="form-label">Deskripsi Program</label>
                        <textarea name="deskripsi_program" id="deskripsi_program" class="form-control @error('deskripsi_program') is-invalid @enderror" 
                                  rows="3" placeholder="Masukkan deskripsi program" required>{{ old('deskripsi_program') }}</textarea>
                        @error('deskripsi_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
@endsection
