<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SISWARGA - Sistem Informasi RT</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Original Theme Styling Polished -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #2d3748;
            background-color: #f8fafc;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Hero Area matching Iuran-Kas-RT theme */
        .hero_area {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(181, 202, 238, 0.88) 0%, rgba(220, 230, 248, 0.8) 100%), url({{ asset('images/hero-bg.jpg') }});
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Layout */
        .navbar {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
            padding: 15px 0;
            z-index: 1000;
        }

        .navbar-brand span {
            font-weight: 800;
            color: #1e3a8a;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: #1e3a8a !important;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 0 15px;
            position: relative;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #2563eb !important;
        }

        .user_option {
            display: flex;
            align-items: center;
        }

        .btn-login {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #1e3a8a !important;
            font-weight: 700;
            padding: 8px 22px;
            border-radius: 30px;
            transition: all 0.3s;
            text-decoration: none;
            margin-right: 12px;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.55);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .btn-register {
            background: #fec016; /* Original Yellow Accent */
            color: #1e3a8a !important;
            font-weight: 700;
            padding: 8px 22px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 4px 12px rgba(254, 192, 22, 0.35);
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-register:hover {
            background: #f5b004;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(254, 192, 22, 0.55);
            text-decoration: none;
        }

        /* Slider Section */
        .slider_section {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 120px 0;
            color: #1e3a8a;
        }

        .detail-box h2 {
            font-size: 1.6rem;
            color: #1e3a8a;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .detail-box h1 {
            font-size: 3.6rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 22px;
            text-transform: uppercase;
        }

        .detail-box p {
            color: #334155;
            font-size: 1.1rem;
            line-height: 1.65;
            max-width: 650px;
            margin-bottom: 40px;
        }

        .slider_section .btn-primary {
            background: #1e3a8a;
            color: #fff;
            border: none;
            padding: 12px 40px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.35);
            transition: all 0.3s;
            margin-right: 15px;
        }

        .slider_section .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.5);
        }

        .slider_section .btn-light {
            background: #ffffff;
            color: #1e3a8a;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 12px 40px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .slider_section .btn-light:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        /* What We Do */
        .do_section {
            background: #ffffff;
            padding: 90px 0;
        }

        .heading_container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 50px;
        }

        .heading_container h2 {
            font-weight: 800;
            font-size: 2.2rem;
            color: #0f172a;
            text-transform: uppercase;
            position: relative;
            padding-bottom: 15px;
        }

        .heading_container h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #fec016; /* Original Yellow Underline */
            border-radius: 2px;
        }

        .heading_container p {
            color: #64748b;
            max-width: 600px;
            margin-top: 15px;
            font-size: 1.05rem;
        }

        .do_container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .do_container .box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 35px 25px;
            border-radius: 20px;
            width: 22%;
            min-width: 230px;
            text-align: center;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.01);
        }

        .do_container .box:hover {
            transform: translateY(-8px);
            border-color: #fec016;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
        }

        .do_container .box .img-box {
            width: 90px;
            height: 90px;
            background: #353434; /* Original Dark Circle */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px auto;
            transition: all 0.3s ease;
        }

        .do_container .box:hover .img-box {
            background: #fec016; /* Original Yellow Accent on hover */
            transform: scale(1.08);
        }

        .do_container .box .img-box img {
            width: 38px;
        }

        .do_container .box h6 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        /* About Section */
        .who_section {
            background: #f8fafc;
            padding: 90px 0;
        }

        .who_section .img-box img {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
            border: 6px solid #ffffff;
            width: 100%;
        }

        .who_section .detail-box {
            padding-left: 40px;
        }

        .who_section .detail-box h2 {
            font-weight: 800;
            font-size: 2.2rem;
            color: #0f172a;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .who_section .detail-box p {
            color: #475569;
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 30px;
        }

        .who_section .detail-box a {
            display: inline-block;
            padding: 10px 35px;
            background-color: #353434;
            color: #ffffff;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
        }

        .who_section .detail-box a:hover {
            background-color: #fec016;
            color: #1e3a8a;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* Features Section */
        .client_section {
            background: #ffffff;
            padding: 90px 0;
        }

        .client_section .box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 35px;
            margin: 15px;
            transition: all 0.3s;
            text-align: center;
        }

        .client_section .box:hover {
            border-color: #2563eb;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
        }

        .client_section .box h5 {
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 15px;
            font-size: 1.25rem;
            text-transform: uppercase;
        }

        .client_section .box p {
            color: #475569;
            line-height: 1.65;
            font-size: 0.98rem;
            margin: 0;
        }

        /* Footer Section */
        .footer_section {
            background-color: #232323; /* Original Dark Footer */
            color: #ffffff;
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer_section p {
            margin: 0;
            font-size: 0.95rem;
            color: #e2e8f0;
        }
    </style>
</head>

<body>

    <div class="hero_area">
        <!-- Navigation Header -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span>SISWARGA</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                    </ul>
                    
                    <div class="user_option">
                        @guest
                            <a href="{{ route('login') }}" class="btn-login">
                                <i class="fa-solid fa-sign-in-alt mr-1"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="btn-register">
                                <i class="fa-solid fa-user-plus mr-1"></i> Register
                            </a>
                        @endguest

                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-register">
                                <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Slider / Hero Section -->
        <section class="slider_section position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="detail-box">
                            <h2>Welcome to</h2>
                            <h1>SISWARGA - Sistem Informasi RT</h1>
                            <p>
                                Meningkatkan pelayanan administrasi warga, pengelolaan data kependudukan, surat menyurat online, dan kegiatan RT secara digital.
                            </p>
                            <div>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-light">
                                        Daftar
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                        Buka Dashboard
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- What We Do / Features Section -->
    <section class="do_section" id="features">
        <div class="container">
            <div class="heading_container">
                <h2>Apa Yang Kami Sediakan?</h2>
                <p>
                    Sistem Informasi RT membantu pengelolaan administrasi dan pelayanan warga secara terintegrasi.
                </p>
            </div>

            <div class="do_container">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('images/d-1.png') }}" alt="Data Warga">
                    </div>
                    <div class="detail-box">
                        <h6>Data Warga</h6>
                    </div>
                </div>

                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('images/d-2.png') }}" alt="Surat Online">
                    </div>
                    <div class="detail-box">
                        <h6>Surat Online</h6>
                    </div>
                </div>

                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('images/d-4.png') }}" alt="Kegiatan RT">
                    </div>
                    <div class="detail-box">
                        <h6>Kegiatan RT</h6>
                    </div>
                </div>

                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('images/d-5.png') }}" alt="Laporan RT">
                    </div>
                    <div class="detail-box">
                        <h6>Laporan RT</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="who_section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="img-box">
                        <img src="{{ asset('images/who-images.jpg') }}" alt="Tentang Kami">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail-box">
                        <h2>Tentang Sistem</h2>
                        <p>
                            Sistem Informasi RT merupakan platform digital yang membantu pengurus RT dan warga dalam mengelola data kependudukan, pengajuan surat, kegiatan lingkungan, dan laporan administrasi secara cepat dan transparan.
                        </p>
                        <a href="#features">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Slider / Carousel -->
    <section class="client_section">
        <div class="container">
            <div class="heading_container">
                <h2>Fitur Utama Sistem</h2>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="box">
                        <h5>Manajemen Data Warga</h5>
                        <p>
                            Pengelolaan data warga dan kartu keluarga secara terpusat dan teratur.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="box">
                        <h5>Surat Menyurat Online</h5>
                        <p>
                            Kemudahan pengajuan dan penerbitan berbagai jenis surat pengantar secara digital.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="box">
                        <h5>Laporan dan Kegiatan</h5>
                        <p>
                            Monitoring kas keuangan dan agenda kegiatan warga di lingkungan RT secara langsung.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer_section">
        <div class="container">
            <p>
                © {{ date('Y') }} SISWARGA - Sistem Informasi RT. All Rights Reserved.
            </p>
        </div>
    </footer>

    <!-- JS dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
