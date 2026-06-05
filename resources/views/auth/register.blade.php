<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Informasi RT</title>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

<div class="center">

    <div class="container">

        <a href="{{ url('/') }}"
           class="close-btn fas fa-times"
           title="Close">
        </a>

        <div class="text">
            Registrasi Warga
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NIK -->
            <div class="data">
                <label>NIK</label>

                <input type="text"
                       name="nik"
                       value="{{ old('nik') }}"
                       required>
            </div>

            @error('nik')
                <small>
                    {{ $message }}
                </small>
            @enderror


            <!-- Nama -->
            <div class="data">
                <label>Nama Lengkap</label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       required>
            </div>

            @error('nama')
                <small>
                    {{ $message }}
                </small>
            @enderror


            <!-- Email -->
            <div class="data">
                <label>Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            @error('email')
                <small>
                    {{ $message }}
                </small>
            @enderror


            <!-- No HP -->
            <div class="data">
                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp') }}">
            </div>

            @error('no_hp')
                <small>
                    {{ $message }}
                </small>
            @enderror


            <!-- Password -->
            <div class="data">
                <label>Password</label>

                <input type="password"
                       name="password"
                       required>
            </div>

            @error('password')
                <small>
                    {{ $message }}
                </small>
            @enderror


            <!-- Konfirmasi Password -->
            <div class="data">
                <label>Konfirmasi Password</label>

                <input type="password"
                       name="password_confirmation"
                       required>
            </div>

            <div class="button">
                <div class="inner"></div>

                <button type="submit">
                    Register
                </button>
            </div>

            <div class="signup-link">
                Sudah punya akun?

                <a href="{{ route('login') }}">
                    Login Sekarang
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>