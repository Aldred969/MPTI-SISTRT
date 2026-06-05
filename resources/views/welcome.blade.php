<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Informasi RT</title>

    <!-- Owl Carousel -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

<div class="hero_area">

    <!-- Header -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container pt-3">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <span>Sistem Informasi RT</span>
                </a>

                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse"
                     id="navbarSupportedContent">

                    <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">

                        <ul class="navbar-nav">

                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">
                                    Home
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#about">
                                    About
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#features">
                                    Features
                                </a>
                            </li>

                        </ul>

                        <div class="user_option">

                            @guest
                                <a class="nav-link text-white"
                                   href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Login
                                </a>

                                <a class="nav-link text-white"
                                   href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i>
                                    Register
                                </a>
                            @endguest

                            @auth
                                <a class="nav-link text-white"
                                   href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            @endauth

                        </div>

                    </div>
                </div>

            </nav>
        </div>
    </header>

    <!-- Slider -->
    <section class="slider_section position-relative">

        <div class="container">

            <div id="carouselExampleIndicators"
                 class="carousel slide"
                 data-ride="carousel">

                <div class="carousel-inner">

                    <div class="carousel-item active">

                        <div class="row">
                            <div class="col">

                                <div class="detail-box">

                                    <div>

                                        <h2>Welcome to</h2>

                                        <h1>
                                            Sistem Informasi RT
                                        </h1>

                                        <p>
                                            Meningkatkan pelayanan administrasi warga,
                                            pengelolaan data kependudukan,
                                            surat menyurat online,
                                            dan kegiatan RT secara digital.
                                        </p>

                                        <div class="mt-4">

                                            <a href="{{ route('login') }}"
                                               class="btn btn-primary mr-2">
                                                Login
                                            </a>

                                            <a href="{{ route('register') }}"
                                               class="btn btn-light">
                                                Daftar
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<!-- What We Do -->
<section class="do_section layout_padding" id="features">

    <div class="container">

        <div class="heading_container">

            <h2>Apa Yang Kami Sediakan?</h2>

            <p>
                Sistem Informasi RT membantu pengelolaan administrasi
                dan pelayanan warga secara terintegrasi.
            </p>

        </div>

        <div class="do_container">

            <div class="box arrow-start arrow_bg">
                <div class="img-box">
                    <img src="{{ asset('images/d-1.png') }}">
                </div>
                <div class="detail-box">
                    <h6>Data Warga</h6>
                </div>
            </div>

            <div class="box arrow-middle arrow_bg">
                <div class="img-box">
                    <img src="{{ asset('images/d-2.png') }}">
                </div>
                <div class="detail-box">
                    <h6>Surat Online</h6>
                </div>
            </div>

            <div class="box arrow-end arrow_bg">
                <div class="img-box">
                    <img src="{{ asset('images/d-4.png') }}">
                </div>
                <div class="detail-box">
                    <h6>Kegiatan RT</h6>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="{{ asset('images/d-5.png') }}">
                </div>
                <div class="detail-box">
                    <h6>Laporan RT</h6>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- About -->
<section class="who_section" id="about">

    <div class="container">

        <div class="row">

            <div class="col-md-5">
                <div class="img-box">
                    <img src="{{ asset('images/who-images.jpg') }}">
                </div>
            </div>

            <div class="col-md-7">

                <div class="detail-box">

                    <div class="heading_container">
                        <h2>Tentang Sistem</h2>
                    </div>

                    <p>
                        Sistem Informasi RT merupakan platform digital
                        yang membantu pengurus RT dan warga dalam
                        mengelola data kependudukan, pengajuan surat,
                        kegiatan lingkungan, dan laporan administrasi
                        secara cepat dan transparan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Features -->
<section class="client_section">

    <div class="container">

        <div class="heading_container">
            <h2>Fitur Utama Sistem</h2>
        </div>

        <div class="carousel-wrap">

            <div class="owl-carousel">

                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <h5>Manajemen Data Warga</h5>
                            <p>
                                Pengelolaan data warga dan kartu keluarga
                                secara terpusat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <h5>Surat Menyurat Online</h5>
                            <p>
                                Pengajuan dan pencetakan surat secara digital.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <h5>Laporan dan Kegiatan</h5>
                            <p>
                                Monitoring kegiatan dan laporan RT secara realtime.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>


<footer class="footer_section">
    <div class="container">
        <div class="row py-5">

            <div class="col-md-4 mb-4">
                <h5 class="footer-brand">🏘️ Sistem Informasi RT</h5>
                <p class="footer-desc">
                    Platform digital untuk membantu pengurus RT dan warga
                    dalam mengelola administrasi secara cepat dan transparan.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h6 class="footer-heading">Navigasi</h6>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">🏠 Beranda</a></li>
                    <li><a href="#about">ℹ️ Tentang</a></li>
                    <li><a href="#features">⚙️ Fitur</a></li>
                    <li><a href="{{ route('login') }}">🔐 Login</a></li>
                    <li><a href="{{ route('register') }}">📝 Daftar</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h6 class="footer-heading">Layanan Kami</h6>
                <ul class="footer-links">
                    <li><a href="#">👥 Data Warga</a></li>
                    <li><a href="#">📄 Surat Online</a></li>
                    <li><a href="#">📅 Kegiatan RT</a></li>
                    <li><a href="#">📊 Laporan RT</a></li>
                </ul>
            </div>

        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} <strong>Sistem Informasi RT</strong>. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    center: true,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        1000: {
            items: 3
        }
    }
});
</script>

</body>
</html>