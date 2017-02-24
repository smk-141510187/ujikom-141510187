@extends('layouts.app')

@section('content')
        <div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading ">

                    <h2>Gaji Karyawan</h2>
                <center>
                </div>
                <div class="panel-body">
                <center>
                        <p><img width="200px" height="200px" src="<?php echo url('asset/image/') ?>/<?php echo $pegawai->foto; ?>" class="img-circle" alt="Cinque Terre" ></p></center>
                    <center>
                    <h3>{{$pegawai->User->name}}</h3>
                    <h4>{{$pegawai->User->email}}</h4>
                    <h4>{{$pegawai->nip}}</h4>
                    <h4><b>Maaf Nampaknya Untuk Bulan {{$penggajian->created_at->month}}-{{$penggajian->created_at->day}}-{{$penggajian->created_at->year}} Anda Belum mempunyai Gaji Untuk Lebih Lanjut Silahkan Hubungi Bagian Administrasi </b></h4>
                    
                </div>
            </div>
        </div>



@endsection
