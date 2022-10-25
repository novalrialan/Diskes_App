@extends('master')
@section('content')
    <div class="col-lg-11">
        @if ($verifikasi->count())
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3>Daftar Berkas Verifikasi</h3>

                    <a href="{{ route('print-table-verifikasi') }}" class="btn btn-info" target="_blank">
                        <li class="fa fa-print"></li> Print Berkas Verifikasi
                    </a>
                    <a href="{{ route('export-to-excel-verifikasi') }}" class="btn btn-success"><li class="fa fa-file-excel-o"></li> Export Excel</a>
                </div>
                {{-- session --}}
                @if (session()->has('success'))
                    <div class="alert alert-success ">
                        <i class="icon fa fa-chcek"></i> {{ session('success') }}
                    </div>
                @elseif (session()->has('danger'))
                @endif
                {{-- end session --}}

                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>title</th>
                                <th>keterangan</th>
                                <th>Berkas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($verifikasi as $row)
                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->berkas->pegawai->nama_pegawai }}</td>
                                    <td>{{ $row->berkas->title }}</td>
                                    <td>{{ $row->berkas->keterangan }}</td>
                                    <td><i class="fa fa-file-pdf-o"> {{ $row->berkas->file }}</i></td>
                                    <td>{{ $row->tanggal_verifikasi }}</td>
                                    <td> <span class="label {{ $row->status == 0 ? 'label-danger' : 'label-success' }}">
                                            {{ $row->status == 0 ? 'belum terverifikasi' : 'terverifikasi' }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('update-verifikasi', $row->id) }}" method="post">
                                            @if (empty($row->status))
                                                @csrf @method('put')

                                                <button type="submit" name="status" value="1"
                                                    class="btn btn-success"><i class="fa fa-check"></i>
                                                    verifikasi</button>
                                            @elseif ($row->status == 1)
                                                @csrf @method('put')
                                                <button type="submit" name="status" value="0"
                                                    class="btn btn-warning"><i class="fa fa-close"></i>
                                                    batalkan</button>
                                            @endif

                                            <a href="{{ route('show-verifikasi', $row->id) }}" class="btn btn-info">
                                                <i class="fa fa-eye"></i>
                                                Lihat berkas</a>

                                            <a href="#" class="btn btn-danger tbl-hapus"
                                                data-idv="{{ $row->id }}">
                                                <i class="fa fa-trash"></i> Hapus
                                                berkas</a>
                                        </form>

                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {{ $verifikasi->links() }}
                </div>

            </div>
        @else
            <div class="alert alert-danger ">
                Tidak ada Berkas Verifikasi
            </div>
        @endif
    </div>
    {{-- cdn jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>



    <!-- Modal delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Hapus Berkas </h3>
                </div>
                <form action="{{ route('delete-verifikasi', 'id') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center">Anda yakin ingin menghapus berkas ini...?</p>
                        <input type="hidden" name="id" id="id_ver" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        let id = 0;
        let Bid = 0;
        let fb = 0;
        let nmP = 0;
        $(function() {

            $('.tbl-hapus').on('click', function() {
                $('#modal-delete').modal('show');
                id = $(this).data('idv');
                $('#id_ver').val(id);
            })
        })
    </script>
@endsection
