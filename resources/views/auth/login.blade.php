<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Informasi RT</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

<div class="center">

    <div class="container1">

        <a href="{{ url('/') }}"
           class="close-btn fas fa-times"
           title="Close">
        </a>

        <div class="text">
            Halaman Login
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="data">
                <label>Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus>
            </div>

            @error('email')
                <small style="color:red">
                    {{ $message }}
                </small>
            @enderror

            <div class="data">
                <label>Password</label>

                <input type="password"
                       name="password"
                       required>
            </div>

            @error('password')
                <small style="color:red">
                    {{ $message }}
                </small>
            @enderror

            <div class="button">
                <div class="inner"></div>

                <button type="submit">
                    Login
                </button>
            </div>

            <div class="signin-link">
                Belum punya akun?

                <a href="{{ route('register') }}">
                    Daftar Sekarang
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>

