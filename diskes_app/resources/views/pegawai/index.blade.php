@extends('master')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
    <div class="col-md-9">
        {{-- if $pegawai->count() --}}
        @if ($pegawai->count())
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Daftar pegawai </h3>
                    {{-- <a href="#" class="btn btn-primary btn-lg-3 tbl_tambah" data-toggle="modal"
                        data-target="#tbl-tambah">Tambah
                        data
                        +</a> --}}
                    @if (Auth::user()->role == 'superadmin')
                        <a href="{{ route('print-table-pegawai') }}" target="_blank" class="btn btn-info">
                            <li class="fa fa-print"></li> Print Daftar Pegawai
                        </a>
                        <a href="{{ route('export-to-excel-pegawai') }}" class="btn btn-success">
                            <li class="fa fa-file-excel-o"></li> Exports Excel
                        </a>
                    @endif
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
                @endif
                {{-- end session --}}
                <div class="box-body">
                    <table id="datatable" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Sub Bagian</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($pegawai as $row)
                            <tbody>
                                @if (Auth::user()->nama == $row->nama_pegawai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_pegawai }}</td>
                                        <td>{{ $row->subbagian->namabagian }}</td>
                                        <td>{{ $row->jabatan }}</td>
                                        <td><a href="#" class="btn btn-warning tbl-edit"
                                                data-peg="{{ $row->id }}" data-nam="{{ $row->nama_pegawai }}"
                                                data-jab="{{ $row->jabatan }}"
                                                data-sub="{{ $row->subbagian_id }}">edit</a>
                                            <a href="#" class="btn btn-danger tbl-delete"
                                                data-peg="{{ $row->id }}">delete</a>
                                        </td>
                                    </tr>
                                @elseif (Auth::user()->role == 'superadmin')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_pegawai }}</td>
                                        <td>{{ $row->subbagian->namabagian }}</td>
                                        <td>{{ $row->jabatan }}</td>
                                        <td><a href="#" class="btn btn-warning tbl-edit"
                                                data-peg="{{ $row->id }}" data-nam="{{ $row->nama_pegawai }}"
                                                data-jab="{{ $row->jabatan }}" data-sub="{{ $row->subbagian_id }}">
                                                <li class="fa  fa-edit"></li> edit
                                            </a>
                                            <a href="#" class="btn btn-danger tbl-delete"
                                                data-peg="{{ $row->id }}">
                                                <li class="fa fa-trash"></li> delete
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer paginate_button">
                    {!! $pegawai->links() !!}
                </div>


            </div>
        @else
            <div class="alert alert-danger">
                Daftar pegawai belum ada silakan membuat inputan
            </div>
            {{-- <a href="#" class="btn btn-primary tbl_tambah" data-toggle="modal" data-target="#tbl-tambah">Tambah
                data
                +</a> --}}
        @endif
        {{-- endif $pegawai->count() --}}
    </div>


    <!-- Modal create-->
    <div class="modal fade " id="tbl-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title box-primary" id="exampleModalLabel">Tambah Pegawai</h4>
                </div>
                <form action="{{ route('create-pegawai') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai"
                                value="{{ old('nama_pegawai') }}" placeholder="silakan menginputkan nama" required
                                readonly>

                        </div>
                        <div class="form-group">
                            <label>Sub Bagian</label>
                            <select name="subbagian_id" value="{{ old('subbagian_id') }}"
                                class="form-control needs-validation" id="subbagian" required>
                                <option selected disabled> Silakan Pilih Sub Bagian</option>
                                <option value="1">Kepala Bagian</option>
                                <option value="2">Umum</option>
                                <option value="3">Sekretaris</option>
                                <option value="4">Farmasih</option>
                            </select>
                            <input type="number" name="subbagian" class="form-control"
                                placeholder="silakan menginputkan subbagian">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control needs-validation" id="jabatan"
                                value="{{ old('jabatan') }}" placeholder="silakan mengimputkan jabatan anda " required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success submit">Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal update-->
    <div class="modal fade " id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title box-primary" id="exampleModalLabel">Edit Data Pegawai</h4>
                </div>
                <form action="{{ route('update-pegawai', 'id') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" id="nm-ed"
                                value="" placeholder="silakan menginputkan nama" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Sub Bagian</label>
                            <select class="form-control" name="subbagian_id" id="sub-ed" value="" required>
                                <option selected disabled> Silakan Pilih Sub Bagian</option>
                                <option value="1">Kepala Bagian</option>
                                <option value="2">Umum</option>
                                <option value="3">Sekertariat</option>
                                <option value="4">Farmasi</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" value="" name="jabatan" class="form-control" id="jb-ed"
                                placeholder="silakan mengimputkan jabatan anda " required>
                        </div>
                        <input type="hidden" name="id" id="id_pegawai" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-warning btn-sm-5">
                            <li class="fa  fa-edit"></li> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal delete-->
    <div class="modal fade " id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title box-primary" id="exampleModalLabel">Delete Pegawai</h4>
                </div>
                <form action="{{ route('delete-pegawai', 'id') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <p class="text-center">Apakah anda yakin mau menghapus data pegawai ini...?</p>
                        <input type="hidden" name="id" id="idpeg-d" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger submit">Hapus </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- cdn jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>


    <script>
        // univ variable
        let id = 0;
        let nm = "";
        let subg = 0;
        let jbt = "";
        $(function() {
            // method edit 
            $('.tbl-edit').on('click', function() {
                $('#modal-edit').modal('show');
                id = $(this).data('peg');
                nm = $(this).data('nam');
                subg = $(this).data('sub');
                jbt = $(this).data('jab');
                $('#id_pegawai').val(id);
                $('#nm-ed').val(nm);
                $('#sub-ed').val(subg);
                $('#jb-ed').val(jbt);
            })

            // method delete
            $('.tbl-delete').on('click', function() {
                $('#modal-delete').modal('show');
                id = $(this).data('peg');
                $('#idpeg-d').val(id);
            })

        });
    </script>
@endsection
