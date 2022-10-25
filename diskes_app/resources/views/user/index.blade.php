@extends('master')
@section('content')
    <div class="col-md-7">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3> Daftar Users</h3>
                <a href="{{ route('user-pdf') }}" target="_blank" class="btn btn-danger">
                    <li class="fa fa-file-pdf-o"></li> Export PDF
                </a>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- session --}}
            @if (session()->has('success'))
                <div class="alert alert-success ">
                    <i class="icon fa fa-chcek"></i> {{ session('success') }}
                </div>
            @elseif (session()->has('danger'))
                <div class="alert alert-danger ">
                    <i class="icon fa fa-ban"></i> {{ session('danger') }}
                </div>
            @endif
            {{-- end session --}}
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        
                        <th>Action</th>
                    </tr>
                    @foreach ($user as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role }}</td>
                           
                            <td>
                                <form action="{{ route('role-update-user', $row->id) }}" method="post">
                                    @if ($row->role === 'admin')
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success" name="role"
                                            value="superadmin">Super-admin</button>
                                    @elseif ($row->role === 'superadmin')
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info" name="role"
                                            value="admin">Admin</button>
                                    @endif
                                    <a href="#" class="btn btn-warning tbl-edit" data-id="{{ $row->id }}"
                                        data-nama="{{ $row->nama }}" data-email="{{ $row->email }}">Edit</a>
                                    <a href="#" class="btn btn-danger tbl-delete"
                                        data-id="{{ $row->id }}">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>

        <!-- modal edit -->
        <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">EDIT USER</h3>

                    </div>
                    <form action="{{ route('update-user', 'id') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id="ed-nm">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="ed-em">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="ed-id">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal delete -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">DELETE USER</h3>
                    </div>
                    <form action="{{ route('delete-user', 'id') }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data ini..?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="del-id">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- cdn jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

        <script>
            let id = 0;
            let nm = 0;
            let em = 0;
            $('.tbl-edit').on('click', function() {
                $('#modal-edit').modal('show');
                id = $(this).data('id');
                nm = $(this).data('nama');
                em = $(this).data('email');
                $('#ed-id').val(id);
                $('#ed-nm').val(nm);
                $('#ed-em').val(em);
            });

            $('.tbl-delete').on('click', function() {
                $('#modal-delete').modal('show');
                id = $(this).data('id');
                $('#del-id').val(id);
            });
        </script>
    </div>
@endsection
