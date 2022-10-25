@extends('master')

@section('content')
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3>Profile User</h3>
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
            <div class="box-body">

                <img class="profile-user-img img-responsive" style="width:200px; border-radius:50%;"
                    src="{{ asset('user_profile/' . $user->foto) }}" alt="User profile picture"><br>

                @if (empty($user->foto))
                    <form action="{{ route('user-profile-edit', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <input type="file" name="foto" class="form-control">
                            <br>


                            <button class="btn btn-primary" style="" type="submit">Upload
                                Image</button>

                        </div>
                    </form>
                @elseif ($user->foto == true)
                    <form action="{{ route('user-profile-delete', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="form-group">

                            <input type="hidden" name="foto" value="{{ $user->foto }}">
                            <button class="btn btn-danger" type="submit">Delete Image</button>
                        </div>
                    </form>
                @endif

                <div class="form-group">
                    <label>Nama </label> : {{ $user->nama }}
                </div>
                <div class="form-group">
                    <label>Role </label> : {{ $user->role }}
                </div>
                <div class="form-group">
                    <label>Email </label> : {{ $user->email }}
                </div>
                <div class="form-group">
                    <label>Jabatan </label> : {{ $pegawai->jabatan }}
                </div>


            </div>
        </div>
    </div>
@endsection
