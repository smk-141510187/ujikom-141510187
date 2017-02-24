@extends('layouts.app')

@section('content')
<style type="text/css">
    th,td{
        text-align: center ;
    }
</style>
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-heading"><h2>Table Lembur Pegawai</div>
                    
                <div class="">
                    <a href="{{url('lemburpegawai/create')}}" class="btn btn-primary form-control">Tambah Data</a>
                    <center>{{$lemburpegawai->links()}}</center>
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="bg-info">
                            <th >No</th>
                            <th>Kode Lembur</th>
                            <th>Tanggal Lembur</th>
                            <th colspan="2">Nip Dan Nama Pegawai</th>
                            <th colspan="2">Jabatan Dan Golongan</th>
                            <th>Jumlah Jam</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp

                        @foreach($lemburpegawai as $datalemburpegawai)


                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datalemburpegawai->kategori_lembur->kode_lembur}}</td>
                                <td>{{$datalemburpegawai->created_at}}</td>
                                <td>{{$datalemburpegawai->pegawai->nip}}
                                <td>{{$datalemburpegawai->pegawai->User->name}}</td>
                                <td>{{$datalemburpegawai->pegawai->jabatan->nama_jabatan}}</td>
                                <td>{{$datalemburpegawai->pegawai->golongan->nama_golongan}}</td>
                                <td>{{$datalemburpegawai->jumlah_jam}}</td>
                                
                                
                                
                                <td><a class="btn btn-success form-control" href="{{route('lemburpegawai.edit',$datalemburpegawai->id)}}">Edit </a></td>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['lemburpegawai.destroy',$datalemburpegawai->id]])!!}
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
