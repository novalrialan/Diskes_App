@extends('master')
@section('content')
    <div class="container">
        <div class="col-lg-10">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3> Lihat Berkas </h3>
                </div>
                <form action="" method="post">

                    <div class="box-body">
                        <div class="form-group">
                            <label style="margin-right: 37px">Nama Pegawai</label> :
                            {{ $verifikasi->berkas->pegawai->nama_pegawai }}
                        </div>
                        <div class="form-group">
                            <label style="margin-right: 68px">No Berkas</label>: {{ $verifikasi->berkas_id }}
                        </div>

                        <div class="form-group">
                            <label style="margin-right: 101px">Title</label> : {{ $verifikasi->berkas->title }}
                        </div>
                        <div class="form-group">
                            <label style="margin-right: 60px">Keterangan</label> : {{ $verifikasi->berkas->keterangan }}
                        </div>



                        <div class="form-group">
                            <label style="margin-right: 109px">File</label>: <i class="fa fa-file-pdf-o"> <a
                                    href="{{ asset('storage/' . $verifikasi->berkas->file) }}">
                                    {{ $verifikasi->berkas->file }} </a> </i>
                        </div>

                        <div class="form-group">
                            <label style="margin-right: 93px">Status</label>: <span
                                class="label {{ $verifikasi->status == 0 ? 'label-danger' : 'label-success' }}">
                                {{ $verifikasi->status == 0 ? 'belum terverifikasi' : 'terverifikasi' }}</span>
                        </div>

                    </div>
                    <iframe src="{{ asset('storage/' . $verifikasi->berkas->file) }}" width="100%" height="500px">
                    </iframe>
                    <div class="box-footer">
                        <a href="{{ route('index-verifikasi') }}" class="btn btn-info">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
