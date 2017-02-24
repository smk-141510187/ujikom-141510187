@extends('layouts.app')

@section('content')
        <div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading ">
                <center>
                    <h2>{{$pegawai->User->name}}</h2>
                    <h4>{{$pegawai->nip}}</h4>
                </div>
                <div class="panel-body">
                <center>
                        <p><img width="200px" height="200px" src="<?php echo url('asset/image/') ?>/<?php echo $pegawai->foto; ?>" class="img-circle" alt="Cinque Terre" ></p></center>
                    <center>
                    <h4>{{$pegawai->User->email}}<br>
                    Menjabat Sebagai {{$pegawai->jabatan->nama_jabatan}} di Golongan {{$pegawai->golongan->nama_golongan}}</h4>
                </div>
                <a class="btn btn-primary form-control" href="{{url('pegawai')}}">Kembali</a>
            </div>
        </div>



@endsection
