<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
    h3{
        color: white ;
    }
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/app-child.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="app-layout">
  
    <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-center">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="" href="{{ url('/login') }}"><b class="auth">Silahkan Login</b></a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <b class="auth">{{ Auth::user()->name }}</b> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="judul panel-heading">
                <center>
                <h3><b>APeKa</b></h3>
                    <h4>Aplikasi Penggajian Karyawan</h4>
                    
            </div>

                @if (Auth::guest())

                    <div class="panel-body home">
                                <a class="btn btn-primary col-md-12 jabatan"  href="{{url('home')}}">Home</a>
                                <a class="btn btn-primary col-md-8 jabatan"  href="{{url('jabatan')}}">Jabatan</a>
                                <a class="btn btn-primary col-md-8 golongan"  href="{{url('golongan')}}">Golongan</a>
                                <a class="btn btn-primary col-md-8 tunjangan "  href="{{url('pegawai')}}">Pegawai</a>
                                <a class="btn btn-primary col-md-8 pegawaibtn"  href="{{url('tunjanganpegawai')}}">Tunjangan</a>
                                <a class="btn btn-primary col-md-8 kategori"  href="{{url('kategorilembur')}}">Kategori Lembur</a>
                                <a class="btn btn-primary col-md-8 lembur"  href="{{url('lemburpegawai')}}">Lembur Pegawai</a>
                                <a class="btn btn-primary col-md-9 penggajian" href="{{url('penggajian')}}">Penggajian Karyawan</a>
                                <a class="btn btn-primary col-md-12 " href="{{url('gaji')}}">Lihat Gaji Saya</a>
                            </div>
                @else

                @if(auth::user()->permission=="Admin")
                        
                            <div class="panel-body home">
                                
                                <a class="btn btn-primary col-md-12 jabatan1"  href="{{url('home')}}">Home</a>
                                <a class="btn btn-primary col-md-8 jabatan"  href="{{url('jabatan')}}">Jabatan</a>
                                <a class="btn btn-primary col-md-8 golongan"  href="{{url('golongan')}}">Golongan</a>
                                <a class="btn btn-primary col-md-8 tunjangan "  href="{{url('pegawai')}}">Pegawai</a>
                                <a class="btn btn-primary col-md-8 pegawaibtn"  href="{{url('tunjanganpegawai')}}">Tunjangan</a>
                                <a class="btn btn-primary col-md-8 kategori"  href="{{url('kategorilembur')}}">Kategori Lembur</a>
                                <a class="btn btn-primary col-md-8 lembur"  href="{{url('lemburpegawai')}}">Lembur Pegawai</a>
                                <a class="btn btn-primary col-md-9 penggajian" href="{{url('penggajian')}}">Penggajian Karyawan</a>
                                <a class="btn btn-primary col-md-12 " href="{{url('gaji')}}">Lihat Gaji Saya</a>
                            </div>
                    @elseif(Auth::user()->permission == "Hrd")
                            <div class="panel-body home">
                                <a class="btn btn-primary col-md-12 jabatan"  href="{{url('home')}}">Home</a>
                                <a class="btn btn-primary col-md-12 tunjangan "  href="{{url('pegawai')}}">Pegawai</a>
                                <a class="btn btn-primary col-md-12 gaji " href="{{url('gaji')}}">Lihat Gaji Saya</a>
                            </div>
                    @elseif(Auth::user()->permission == "Keuangan")
                            <div class="panel-body home">
                                <a class="btn btn-primary col-md-12 jabatan"  href="{{url('home')}}">Home</a>
                                <a class="btn btn-primary col-md-8 pegawaibtn"  href="{{url('tunjanganpegawai')}}">Tunjangan</a>
                                <a class="btn btn-primary col-md-8 penggajian"  href="{{url('lemburpegawai')}}">Lembur Pegawai</a>
                                <a class="btn btn-primary col-md-8 lembur" href="{{url('penggajian')}}">Penggajian Karyawan</a>
                                <a class="btn btn-primary col-md-12 gaji " href="{{url('gaji')}}">Lihat Gaji Saya</a>
                            </div>
                    @else
                            <div class="panel-body home">
                                <a class="btn btn-primary col-md-12 jabatan"  href="{{url('home')}}">Home</a>
                                <a class="btn btn-primary col-md-12 gaji " href="{{url('gaji')}}">Lihat Gaji Saya</a>
                            </div>
                    @endif

                @endif
                

            </div>
        </div>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
