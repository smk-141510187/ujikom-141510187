@extends('layouts.app')

@section('content')

</style>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default home">
                <div class="panel-heading">
                <center><h1><b>APeKa</b><h1>
                        <h3>Aplikasi Penggajian Karyawan</h3>
                </div>

                <div class="panel-body">
                    <center>
                    <h3 class="welcome">Selamat Datang {{auth::user()->name}} Sebagai {{auth::user()->permission}}</h3>
                    </center> 
                </div>
            </div>
        </div>

        
@endsection
