@extends('master');
@section('content')
    <div class="col-md-10">
        <div class="box box-info">
            <div class="box-header">
                <h3>Daftar Penggunaan Gedung</h3>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> <li class="fa fa-building"></li> Buat Daftar
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
                    <i class="icon fa fa-ban"></i> {{ session('danger') }}
                </div>
            @endif
            {{-- end session --}}
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Kode Gedung</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Jumlah Peserta</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($gedung as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->kode_gedung }}</td>
                            <td>{{ $row->tanggal_peminjaman }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->keterangan }}</td>
                            <td> <a href="#" class="btn btn-warning tbl-edit" data-idg="{{ $row->id }}"
                                    data-kdg="{{ $row->kode_gedung }}" data-tglp="{{ $row->tanggal_peminjaman }}"
                                    data-jml="{{ $row->jumlah }}" data-ktr="{{ $row->keterangan }}">Edit</a>
                                <a href="#" data-idgd="{{ $row->id }}"
                                    class="btn btn-danger tbl-hapus">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
            </div>
        </div>

        {{-- cdn jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

        {{-- modal create --}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Buat Daftar Pengunaan Gedung</h3>
                    </div>
                    <form action="{{ route('create-gedung') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode gedung</label>
                                <select name="kode_gedung" id="" class=" form-control" required>
                                    <option selected disabled>Silakan Pilih Gedung</option>
                                    <option value="Gedung A">Gedung A</option>
                                    <option value="Gedung B">Gedung B</option>
                                    <option value="Gedung C">Gedung C</option>
                                    <option value="Gedung F">Gedung F</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Peminjaman</label>
                                <input name="tanggal_peminjaman" type="date" class="form-control"
                                    placeholder="silakan milih tanggal peminjaman" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input name="jumlah" type="number" class="form-control"
                                    placeholder="silakan inputkan jumlah peserta" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" id="" class="form-control" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal create --}}

        {{-- modal edit --}}
        <div class="modal fade ba-example-modal-lg " id="modal-edit" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Edit Daftar Pengunaan Gedung</h3>
                    </div>
                    <form action="{{ route('update-gedung', 'id') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode gedung</label>
                                <select name="kode_gedung" id="ed-kd" class=" form-control" required>
                                    <option selected disabled>Silakan Pilih Gedung</option>
                                    <option>Gedung A</option>
                                    <option>Gedung B</option>
                                    <option>Gedung C</option>
                                    <option>Gedung F</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Peminjaman</label>
                                <input name="tanggal_peminjaman" id="ed-p" type="date" class="form-control"
                                    placeholder="silakan milih tanggal peminjaman" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input name="jumlah" id="ed-j" type="number" class="form-control"
                                    placeholder="silakan inputkan jumlah peserta" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" id="ed-k" class="form-control" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="ed-g">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal edit --}}

        <!-- Modal delete -->
        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Delete Data Gedung</h3>
                    </div>
                    <form action="{{ route('delete-gedung', 'id') }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda ingin menghapus data ini..?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="id-d" name="id">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal delete --}}

    </div>
    <script>
        let id = 0;
        let kd = 0;
        let tgl = 0;
        let jml = 0;
        let ket = 0;

        $(function() {

            $('.tbl-edit').on('click', function() {
                $('#modal-edit').modal('show');
                id = $(this).data('idg');
                kd = $(this).data('kdg');
                tgl = $(this).data('tglp');
                jml = $(this).data('jml');
                ket = $(this).data('ktr');
                $('#ed-g').val(id);
                $('#ed-kd').val(kd);
                $('#ed-p').val(tgl);
                $('#ed-j').val(jml);
                $('#ed-k').val(ket);
            })

            $('.tbl-hapus').on('click', function() {
                $('#modal-delete').modal('show');
                id = $(this).data('idgd');
                $('#id-d').val(id);
            });
        });
    </script>
@endsection
