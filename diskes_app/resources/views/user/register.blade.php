<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DISKES | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE2/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE2/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE2/plugins/iCheck/square/blue.css') }}">


    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/register') }}"><b>DISKES</b>REGISTER</a>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Register a new members</p>
            <form action="{{ route('user-create') }}" method="post">
                @csrf
                @method('post')
                <div class="form-group has-feedback">
                    <input type="text" name="nama" class="form-control @error('nama') has-error @enderror"
                        placeholder="Inputkan nama panjang anda">
                    @error('nama')
                        <div class="form-group has-error">
                            <div class="help-block">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control @error('email') has-error @enderror"
                        placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                        <div class="form-group has-error">
                            <div class="help-block">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control @error('password') has-error @enderror"
                        placeholder="Password">
                    @error('password')
                        <div class="form-group has-error">
                            <div class="help-block">
                                {{ $message }}
                            </div>

                        </div>
                    @enderror
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select name="subbagian_id" class="form-control" value="{{ old('subbagian_id') }}">
                        <option selected disabled>Silakan Pilih Sub Bagian</option>
                        <option value="1">Kepala Bagian</option>
                        <option value="2">Umum</option>
                        <option value="3">Sekretaris</option>
                        <option value="4">Farmasih</option>
                    </select>
                    @error('subbagian_id')
                        <div class="form-group has-error">
                            <div class="help-block">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="jabatan" class="form-control needs-validation" id="jabatan"
                        value="{{ old('jabatan') }}" placeholder="silakan mengimputkan jabatan anda ">
                    @error('jabatan')
                        <div class="form-group has-error">
                            <div class="help-block">
                                {{ $message }}
                            </div>

                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm">
                        <input type="hidden" name="role" value="admin">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('AdminLTE2/plugins/iCheck/icheck.min.js') }}"></script>
</body>

</html>
