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
                <div class="panel-heading"><h2>Table Pegawai</div>
                    
                <div class="panelpegawai">
                    <div class="col-md-12">
                        <a href="{{url('pegawai/create')}}" class="btn btn-primary form-control">Tambah Data</a>
                        <center>{{$pegawai->links()}}</center>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        @php
                            $no=1 ;
                        @endphp
                        @foreach($pegawai as $datapegawai)

                        <div class="col-md-6">
                        <div class="panel panel-default pegawai">
                            <div class="panel-heading kecil">
                                <div class="panel-title"></div>
                            </div>
                            <div class="panel-body bodypegawai">

                        <center>
                        <p>{{$no++}}</p>
                            <img height="100px" alt="Smiley face" width="100px" class="img-circle" src="asset/image/{{$datapegawai->foto}}">

                        <h3>{{$datapegawai->User->name}}</h3>
                        <h4>{{$datapegawai->nip}}</h4>
                        <h5>Type User {{$datapegawai->User->permission}}</h5>
                        
                                <a class="btn btn-primary col-md-4 a" href="{{route('pegawai.show',$datapegawai->id)}}">Detail</a>
                                <a class="btn btn-success col-md-4" href="{{route('pegawai.edit',$datapegawai->id)}}">Edit </a>
                                     {!!Form::open(['method'=>'DELETE','route'=>['pegawai.destroy',$datapegawai->id]])!!}
                                    {!!Form::submit('Delete',['class'=>'btn btn-danger col-md-4 a'])!!}
                                    {!!Form::close()!!}
                                
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
