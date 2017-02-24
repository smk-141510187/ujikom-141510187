@extends('layouts.app')

@section('content')
<style type="text/css">
    th,td{
        text-align: center ;
    }
</style>
        <div class="col-md-9">
            <div class="panel panel-default col-md-12">
                <div class="panel-heading"><h2>Table Kategori Tunjangan</div>
                    
                <div class="">
                    <a href="{{url('tunjangan/create')}}" class="btn btn-primary form-control">Tambah Data</a>
                    <center>{{$tunjangan->links()}}</center>
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="bg-info">
                            <th >No</th>
                            <th>Kode Tunjangan</th>
                            <th colspan="2">Jabatan Dan Golongan</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>besaran Uang</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp

                        @foreach($tunjangan as $datatunjangan)


                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datatunjangan->kode_tunjangan}}</td>
                                <td>{{$datatunjangan->jabatan->nama_jabatan}}</td>
                                <td>{{$datatunjangan->golongan->nama_golongan}}</td>
                                <td>{{$datatunjangan->status}}</td>
                                <td>{{$datatunjangan->jumlah_anak}} Anak</td>
                                <?php $datatunjangan->besaran_uang=number_format($datatunjangan->besaran_uang,2,',','.'); ?>
                                <td>Rp. {{$datatunjangan->besaran_uang}}</td>
                                <td><a class="btn btn-success form-control" href="{{route('tunjangan.edit',$datatunjangan->id)}}">Edit </a></td>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['tunjangan.destroy',$datatunjangan->id]])!!}
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
