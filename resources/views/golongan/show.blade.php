@extends('layouts.app')
@section('content')

</style>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default home">
                <div class="panel-heading">
                 <h3>Hasil pencarian : <b>{{$query}}</h3>
                </div>
<table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th >No</th>
                            <th>Kode Golongan</th>
                            <th>Nama Golongan</th>
                            <th>Besaran Uang</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp
                        @foreach($hasil as $datagolongan)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datagolongan->kode_golongan}}</td>
                                <td>{{$datagolongan->nama_golongan}}</td>
                                <td>{{$datagolongan->besaran_uang}}</td>
                                <td><a class="btn btn-success form-control" href="{{route('golongan.edit',$datagolongan->id)}}">Edit </a></td>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['golongan.destroy',$datagolongan->id]])!!}
                                    {!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>

{{ $hasil->render() }}
               
            </div>
        </div>

        
@endsection
