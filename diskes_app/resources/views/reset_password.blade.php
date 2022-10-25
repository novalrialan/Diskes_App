<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="col-md-12" style="padding:20px;">
        <div class="container">
            <div class="card" style="width: 60%; margin-left:20%">
                <div class="card-header">
                    <h4>Reset Password </h4>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('faild'))
                    <div class="alert alert-danger">
                        {{ session('faild') }}
                    </div>
                @endif
                <form action="{{ route('reset-password') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{ $email ?? old('email') }} "
                                class="form-control" placeholder="inputkan email anda">
                            @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="inputkan password baru">
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirm" class="form-control"
                                placeholder="inputkan password baru">
                            @error('password_confirm')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                        <br>
                        <br>
                        <div class="form-group">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
