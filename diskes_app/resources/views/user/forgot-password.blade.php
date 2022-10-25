<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="col-md-12 " style="padding: 10px; ">
        <div class="container">
            <div class="card " style="width: 60%; margin-left:20%">
                <div class="card-header with-border">
                    <h4>Forgot Password</h4>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('forgot-password-link') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <p>Silakan mengetikan email anda lagi untuk kami mengirimkan link reset
                            password ke email anda.</p>
                        <div class="form-group has-feedback">
                            <label>Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="form-group has-error">
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left:34%;">Send Reset Password Link
                        </button>
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
