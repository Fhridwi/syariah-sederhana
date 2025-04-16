{{-- resources/views/program/edit.blade.php --}}
@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Program</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('program.update', $program->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_program" class="form-label">Nama Program</label>
                        <input type="text" name="nama_program" id="nama_program" class="form-control" value="{{ $program->nama_program }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_program" class="form-label">Deskripsi Program</label>
                        <textarea name="deskripsi_program" id="deskripsi_program" class="form-control" rows="3" required>{{ $program->deskripsi_program }}</textarea>
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
