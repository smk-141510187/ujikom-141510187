@extends('layouts.app')
@section('content')
<style type="text/css">
    th,td{
        text-align: center ;
    }

</style>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Table Jabatan</h2></div>
                    
                    <div class="panel-body tambah">
                    <div class="col-md-12 e">
                    <a href="{{url('jabatan/create')}}" class="btn btn-primary form-control">Tambah Data</a></div>
                    <div class="col-md-12">
                    
                    <center>{{$jabatan->links()}}</center>
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th >No</th>
                            <th>Kode Jabatan</th>
                            <th>Nama Jabatan</th>
                            <th>Besaran Uang</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp
                        @foreach($jabatan as $datajabatan)

                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datajabatan->kode_jabatan}}</td>
                                <td>{{$datajabatan->nama_jabatan}}</td>
                                <td>{{$datajabatan->besaran_uang}}</td>
                                <td><a class="btn btn-success form-control" href="{{route('jabatan.edit',$datajabatan->id)}}">Edit </a>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['jabatan.destroy',$datajabatan->id]])!!}
                                    {!!Form::submit('Delete',['class'=>'btn btn-danger form-control'])!!}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
                </div></div>
            </div>
        </div>
    
@endsection
