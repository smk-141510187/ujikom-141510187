@extends('layouts.app')

@section('content')
<style type="text/css">
    td,th{
        text-align: center ;
    }
    img{
        border-image-repeat: 3px ;
        border-style: circle ;
    }
</style>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Table Penggajian</div>
                    
                <div class="">
                    <div class="col-md-12">
                        <a href="{{url('penggajian/create')}}" class="btn btn-primary form-control">Tambah Data</a>
                        <center>{{$penggajian->links()}}</center>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        @php
                            $no=1 ;
                        @endphp
                        @foreach($penggajian as $datapenggajian)
                        @if($date->month == $datapenggajian->created_at->month)

                        
                            <div class="col-md-6">
                                <div class="panel panel-default pegawai">
                                <div class="panel-heading kecil">
                                    <div class="panel-title"></div>
                                </div>
                                <div class="panel-body">                        
                                <center>
                                <p>{{$no++}}</p>
                                <img height="100px" alt="Smiley face" width="100px" class="img-circle" src="asset/image/{{$datapenggajian->tunjangan_pegawai->pegawai->foto}}">

                            <h3>{{$datapenggajian->tunjangan_pegawai->pegawai->User->name}}</h3>
                            <h4>{{$datapenggajian->tunjangan_pegawai->pegawai->nip}}</h4>
                            <h5><b>@if($datapenggajian->tanggal_pengambilan == ""&&$datapenggajian->status_pengambilan == "0")
                                Gaji {{$datapenggajian->created_at}} Belum Diambil 
                                <div class="col-md-12">
                                <a class="btn btn-primary col-md-6" href="{{route('penggajian.edit',$datapenggajian->id)}}">Sudah Diambil</a>
                                <button disabled="" class="btn btn-primary col-md-6">Ubah Pengambilan</button>
                            </div>
                            @elseif($datapenggajian->tanggal_pengambilan == ""||$datapenggajian->status_pengambilan == "0")
                                Gaji {{$datapenggajian->created_at}} Belum Diambil
                                <div class="col-md-12">
                                <a class="btn btn-primary col-md-6 " href="{{route('penggajian.edit',$datapenggajian->id)}}">Sudah Diambil</a>
                                <button disabled="" class="btn btn-primary col-md-6">Ubah Pengambilan</button>
                            </div>
                            @else
                                Gaji {{$datapenggajian->created_at}} Sudah Diambil Pada {{$datapenggajian->tanggal_pengambilan}}
                                <div class="col-md-12">
                                <button disabled="" class="btn btn-primary col-md-6">Sudah Diambil</button>
                                <a class="btn btn-primary col-md-6 " href="{{route('penggajianupdate.edit',$datapenggajian->id)}}">Ubah Pengambilan</a>

                            </div>
                            @endif</b></h5>
                            



                            </h5>
                            
                                    <a class="btn btn-primary col-md-4 a" href="{{route('penggajian.show',$datapenggajian->id)}}">Detail</a>
                                    <a class="btn btn-success col-md-4" href="{{route('tunjangan.edit',$datapenggajian->id)}}">Edit </a>
                                         {!!Form::open(['method'=>'DELETE','route'=>['penggajian.destroy',$datapenggajian->id]])!!}
                                        {!!Form::submit('Delete',['class'=>'btn btn-danger col-md-4 a'])!!}
                                        {!!Form::close()!!}
                        @endif
                                
                        </center>
                        </div>
                        </div>
                        </div> 
                        @endforeach
                        
                    </table>
                </div>

            </div>
        </div>
        
@endsection
