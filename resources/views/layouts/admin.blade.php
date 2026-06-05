<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWARGA - Admin</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            background:#1e3a8a;
            color:white;
            position:fixed;
            height:100%;
            overflow-y:auto;
        }

        .logo{
            text-align:center;
            padding:25px;
            border-bottom:1px solid rgba(255,255,255,.2);
        }

        .logo h2{
            font-size:24px;
        }

        .logo p{
            font-size:13px;
            opacity:.8;
        }

        .menu{
            padding:20px 0;
        }

        .menu a{
            display:block;
            color:white;
            text-decoration:none;
            padding:14px 25px;
            transition:.3s;
        }

        .menu a:hover{
            background:#2563eb;
        }

        .menu i{
            width:25px;
        }

        /* MAIN */

        .main{
            margin-left:260px;
            width:100%;
        }

        /* NAVBAR */

        .navbar{
            background:white;
            padding:18px 30px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);

            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .navbar h3{
            color:#1e293b;
        }

        .user{
            color:#64748b;
            font-weight:600;
        }

        /* CONTENT */

        .content{
            padding:30px;
        }

        /* CARD */

        .card-container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
        }

        .card h4{
            color:#64748b;
            margin-bottom:10px;
        }

        .card h2{
            color:#1e3a8a;
        }

        /* TABLE */

        .table-box{
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        table th{
            background:#1e3a8a;
            color:white;
            padding:12px;
        }

        table td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        .badge{
            padding:5px 10px;
            border-radius:20px;
            font-size:12px;
        }

        .success{
            background:#dcfce7;
            color:#166534;
        }

        .warning{
            background:#fef3c7;
            color:#92400e;
        }

        .danger{
            background:#fee2e2;
            color:#991b1b;
        }

        @media(max-width:768px){

            .sidebar{
                width:220px;
            }

            .main{
                margin-left:220px;
            }
        }
    </style>

</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <h2>SIWARGA</h2>
            <p>Sistem Informasi Warga RT</p>
        </div>

        <div class="menu">

            <a href="#">
                <i class="fas fa-home"></i>
                Dashboard
            </a>

            <a href=".Admin/warga/index.blade.php">
                <i class="fas fa-users"></i>
                Data Warga
            </a>

            <a href="#">
                <i class="fas fa-money-bill-wave"></i>
                Iuran Warga
            </a>

            <a href="#">
                <i class="fas fa-file-alt"></i>
                Pelaporan
            </a>

            <a href="#">
                <i class="fas fa-bullhorn"></i>
                Pengumuman
            </a>

            <a href="#">
                <i class="fas fa-camera"></i>
                Kegiatan RT
            </a>

            <a href="#">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>

        </div>

    </div>

    <!-- MAIN -->

    <div class="main">

        <div class="navbar">

            <h3>@yield('title')</h3>

            <div class="user">
                Admin RT
            </div>

        </div>

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>