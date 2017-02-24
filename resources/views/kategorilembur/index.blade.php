@extends('layouts.app')

@section('content')
<style type="text/css">
    th,td{
        text-align: center ;
    }
</style>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Table Kategori Lembur</div>
                    
                <div class="">
                    <a href="{{url('kategorilembur/create')}}" class="btn btn-primary form-control">Tambah Data</a>
                    <center>{{$kategorilembur->links()}}</center>
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th >No</th>
                            <th>Kode Lembur</th>
                            <th colspan="2">Jabatan Dan Golongan</th>
                            <th>Besaran Uang</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp
                        @foreach($kategorilembur as $datakategorilembur)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datakategorilembur->kode_lembur}}</td>
                                <td>{{$datakategorilembur->jabatan->nama_jabatan}} 
                                <td>{{$datakategorilembur->golongan->nama_golongan}}</td>
                                <td>{{$datakategorilembur->besaran_uang}}</td>
                                <td><a class="btn btn-success form-control" href="{{route('kategorilembur.edit',$datakategorilembur->id)}}">Edit </a></td>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['kategorilembur.destroy',$datakategorilembur->id]])!!}
                                    {!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>

            </div>
        </div>
    

@endsection
