@extends('template.app')

@section('content')
<div class="row">
    <!-- Info Box 1 -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Wali</span>
                <span class="info-box-number">
                    120
                </span>
            </div>
        </div>
    </div>

    <!-- Info Box 2 -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-shield"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Admin</span>
                <span class="info-box-number">
                    5
                </span>
            </div>
        </div>
    </div>

    <!-- Info Box 3 -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-envelope"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pesan Masuk</span>
                <span class="info-box-number">
                    32
                </span>
            </div>
        </div>
    </div>

    <!-- Info Box 4 -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bell"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Notifikasi</span>
                <span class="info-box-number">
                    8
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
