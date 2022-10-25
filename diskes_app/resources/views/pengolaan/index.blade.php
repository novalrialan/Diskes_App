@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="container">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><li class="fa fa-arrow-up"></li> Import File
                        Excel</a>
                    <a href="{{ route('export-excel') }}" class="btn btn-info"> <li class="fa fa-arrow-down"></li> Export Excel</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success ">
                        <i class="icon fa fa-chcek"></i> {{ session('success') }}
                    </div>
                @endif
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
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Kode Rekening</th>
                            <th>Keterangan</th>
                            <th>Perihal PersubKegiatan</th>
                            <th>Anggaran</th>
                            <th>Waktu</th>
                            <th>Biaya</th>
                            <th>Total</th>
                            <th>Saldo</th>
                            <th>Penangung Jawab</th>
                        </tr>
                        @foreach ($pengelolaan as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->kode_rekening }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->perihal_persub_kegiatan }}</td>

                                <td>{{ 'Rp ' . number_format($row->anggaran, 0, ',', '.') }}</td>
                                <td>{{ date($row->waktu) }}</td>
                                <td>{{ 'Rp ' . number_format($row->biaya, 0, ',', '.') }}</td>
                                <td>{{ 'Rp ' . number_format($row->total, 0, ',', '.') }}</td>
                                <td>{{ 'Rp ' . number_format($row->saldo, 0, ',', '.') }}</td>
                                <td>{{ $row->penangung_jawab }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
                <div class="box-footer">
                    {!! $pengelolaan->links() !!}
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">IMPORT FILE EXCEL</h4>

                    </div>
                    <form action="{{ route('import-excel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="modal-body">
                            <div class="form-group">
                                <input name="file" type="file" class="form-control"
                                    placeholder="silakan masukan file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success">Import File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
