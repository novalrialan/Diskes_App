@extends('master')
@section('content')
    <div class="col-md-12 col-sm">
        @if ($berkas->count())
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3>Daftar Berkas</h3>
                    <a href="#" class="btn btn-primary" data-target="#tbl-tambah" data-toggle="modal"><li class="fa fa-file-pdf-o"></li> Tambah Data Berkas
                        +</a>
                </div>
                {{-- error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- end error --}}
                {{-- session --}}
                @if (session()->has('success'))
                    <div class="alert alert-success ">
                        <i class="icon fa fa-chcek"></i> {{ session('success') }}
                    </div>
                @elseif (session()->has('danger'))
                    <div class="alert alert-danger ">
                        {{ session('danger') }}
                    </div>
                @elseif (session()->has('faild'))
                    <div class="alert alert-danger ">
                        <i class="icon fa fa-exclamation-triangle"></i> {{ session('faild') }}
                    </div>
                @endif
                {{-- end session --}}
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pegawai</th>
                                <th>Tanggal</th>
                                <th>Title</th>
                                <th>Keterangan</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($berkas as $row)
                            @if (Auth::user()->nama == $row->pegawai->nama_pegawai || Auth::user()->role == 'superadmin')
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->pegawai->nama_pegawai }}</td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ Str::limit($row->keterangan, 50, '.') }}</td>
                                        <td> <i class="fa fa-file-pdf-o"></i> {{ asset('storage/' . $row->file) }}</td>
                                        <td> 
                                            @foreach ($row->verifikasi as $where)
                                                <span
                                                    class="label {{ $where->status == 0 ? 'label-danger' : 'label-success' }}">
                                                    {{ $where->status == 0 ? 'belum terverifikasi' : 'terverifikasi' }}</span>
                                            @endforeach
                                        </td>

                                        <td class="d-flex">
                                            @if (Auth::user()->role == 'superadmin')
                                                <a href="#" class="btn btn-warning inline tbl-edit"
                                                    data-brk="{{ $row->id }}" data-pgid={{ $row->pegawai_id }}
                                                    data-tgl="{{ $row->tanggal }}" data-titl="{{ $row->title }}"
                                                    data-ketr="{{ $row->keterangan }}"
                                                    data-fl="{{ $row->file }}">Edit</a>

                                                <a href="#" class="btn btn-danger inline tbl-hapus"
                                                    data-brk="{{ $row->id }}" data-fl="{{ $row->file }}">
                                                    delete </a>
                                            @elseif (Auth::user()->nama == $row->pegawai->nama_pegawai)
                                                <a href="#" class="btn btn-warning inline tbl-edit"
                                                    data-brk="{{ $row->id }}" data-pgid={{ $row->pegawai_id }}
                                                    data-tgl="{{ $row->tanggal }}" data-titl="{{ $row->title }}"
                                                    data-ketr="{{ $row->keterangan }}"
                                                    data-fl="{{ $row->file }}">Edit</a>

                                                <a href="#" class="btn btn-danger inline tbl-hapus"
                                                    data-brk="{{ $row->id }}" data-fl="{{ $row->file }}">
                                                    delete </a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {{ $berkas->links() }}
                </div>


            </div>
        @else
            <div class="alert alert-danger">
                Tidak ada Berkas tersedia silakan menginput berkas

            </div>

            <a href="#" class="btn btn-primary" style="padding-bottom: auto" data-target="#tbl-tambah"
                data-toggle="modal">Tambah Data
                Berkas
                +</a>


        @endif
    </div>
    {{-- cdn jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <!-- Modal create berkas-->
    <div class="modal fade" id="tbl-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tambah Berkas</h4>
                </div>
                <form action="{{ route('create-berkas') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('post')
                        {{-- pegawai_id masih mengunakan default value --}}
                        <div class="form-group">
                            <label>Pegawai</label>

                            <input type="text" value="{{ $pegawai }}" name="pegawai_id" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <input type="hidden" name="status" value="0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal edit berkas-->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Berkas</h4>
                </div>
                <form action="{{ route('update-berkas', 'id') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('put')
                        {{-- pegawai_id masih mengunakan default value --}}
                        <div class="form-group">
                            <label>Pegawai</label>
                            <input id="pg-ed" type="text" value="" name="pegawai_id" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input id="tgl-ed" type="date" value="" name="tanggal" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input id="tit-ed" type="text" value="" name="title" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="ket-ed" class="form-control" value="" name="keterangan" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input class="form-control" id="text-file" name="fileOld" value="" readonly>
                            <input type="file" class="form-control" id="fl-ed" value="" name="file">
                        </div>
                        <input type="hidden" name="id" id="brk-id" value="">
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal delete berkas-->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Delete Data Berkas</h3>
                </div>
                <form action="{{ route('delete-berkas', 'id') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center">Apakah anda yakin menghapus berkas data ini ..?</p>
                        <input type="hidden" name="id" id="berkas_id" value="">
                        <input type="hidden" name="file" id="file_del" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let id = 0;
        let pgid = 0;
        let tg = 0;
        let tt = 0;
        let ke = 0;
        let fl = 0;
        $(function() {
            // modal edit
            $('.tbl-edit').on('click', function() {
                $('#modal-edit').modal('show');
                id = $(this).data('brk');
                pgid = $(this).data('pgid');
                tg = $(this).data('tgl');
                tt = $(this).data('titl');
                ke = $(this).data('ketr');
                fle = $(this).data('fl');
                $('#brk-id').val(id);
                $('#pg-ed').val(pgid);
                $('#tgl-ed').val(tg);
                $('#tit-ed').val(tt);
                $('#ket-ed').val(ke);
                $('#text-file').val(fle);
            })

            // method hapus
            $('.tbl-hapus').on('click', function() {
                $('#modal-delete').modal('show');
                id = $(this).data('brk');
                fle = $(this).data('fl');
                $('#berkas_id').val(id);
                $('#file_del').val(fle);
            })
        })
    </script>
@endsection
