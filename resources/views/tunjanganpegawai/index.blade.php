@extends('layouts.app')

@section('content')
<style type="text/css">
    th,td{
        text-align: center ;
    }
</style>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Table Tunjangan Pegawai</div>
                    
                
                <div class="panel-body tambah">
                    <div class="col-md-12 e">
                    <a href="{{url('tunjanganpegawai/create')}}" class="btn btn-primary form-control">Tambah Data</a></div>
                    <center>{{$tunjanganpegawai->links()}}</center>
                    <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="bg-info">
                            <th >No</th>
                            <th>Kode Tunjangan</th>
                            <th>Nip</th>
                            <th>Nama Pegawai</th>
                            <th colspan="2">Jabatan Dan Golongan</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>Besaran Uang</th>
                            <th colspan="3">Opsi</th>
                        </tr>

                        @php
                            $no=1 ;
                        @endphp

                        @foreach($tunjanganpegawai as $datatunjanganpegawai)


                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$datatunjanganpegawai->tunjangan->kode_tunjangan}}</td>
                                <td>{{$datatunjanganpegawai->pegawai->nip}}</td>
                                <td>{{$datatunjanganpegawai->pegawai->User->name}}</td>
                                <td>{{$datatunjanganpegawai->pegawai->jabatan->nama_jabatan}}</td>
                                <td>{{$datatunjanganpegawai->pegawai->golongan->nama_golongan}}</td>
                                <td>{{$datatunjanganpegawai->tunjangan->status}}</td>
                                <td>{{$datatunjanganpegawai->tunjangan->jumlah_anak}} Anak</td>
                                <?php $datatunjanganpegawai->tunjangan->besaran_uang=number_format($datatunjanganpegawai->tunjangan->besaran_uang,2,',','.'); ?>
                                <td>Rp. {{$datatunjanganpegawai->tunjangan->besaran_uang}}</td>
                                <td><a class="btn btn-success form-control" href="{{route('tunjanganpegawai.edit',$datatunjanganpegawai->id)}}">Edit </a></td>
                                <td>
                                     {!!Form::open(['method'=>'DELETE','route'=>['tunjanganpegawai.destroy',$datatunjanganpegawai->id]])!!}
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
