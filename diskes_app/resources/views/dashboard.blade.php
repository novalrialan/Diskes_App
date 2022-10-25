@extends('master')
@section('content')
    <div class="col-lg-3 col-xs-6">


        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>Gedung </h3>
                <h3>{{ $gedung }}</h3>
                <p>Daftar Gegung terpakai</p>
            </div>
            <div class="icon">
                <i class="fa fa-building"></i>
            </div>
            <a href="{{ route('index-gedung') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">

                <h3>Pegawai </h3>
                <h3>{{ $pegawai }}</h3>
                <p>Daftar Pegawai sekarang</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('index-pegawai') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>File Pegawai </h3>
                <h3>{{ $berkas }}</h3>
                <p>Daftar File Pegawai</p>
            </div>
            <div class="icon">
                <i class="fa fa-files-o"></i>
            </div>
            <a href="{{ route('index-berkas') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Verifikasi</h3>
                <h3>{{ $verifikasi }}</h3>
                <p>Daftar File Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
            <a href="{{ route('index-verifikasi') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

   
   
@endsection
