@extends('layouts.app')

@section('content')
        <div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading ">

                    <h2>Gaji Karyawan</h2>
                <center>
                </div>
                <div class="panel-body">
                <center>
                        <p><img width="200px" height="200px" src="<?php echo url('asset/image/') ?>/<?php echo $pegawai->foto; ?>" class="img-circle" alt="Cinque Terre" ></p></center>
                    <center>
                    <h3>{{$pegawai->User->name}}-{{$pegawai->nip}}</h4>
                    <h4>{{$pegawai->User->email}}</h4>
                    
                    <h3>
                        @if($penggajian->status_pengambilan == "0"||$penggajian->tanggal_pengambilan="")
                            <b>Gaji Bulan {{$penggajian->created_at->month}}-{{$penggajian->created_at->day}}-{{$penggajian->created_at->year}} Belum Di Ambil Silahkan Hubungi Pihak Administrasi Jika Ada Kesalahan</b>
                        @else
                            <b>Gaji Bulan {{$penggajian->created_at->month}}-{{$penggajian->created_at->day}}-{{$penggajian->created_at->year}} Sudah Diambil Silahkan Hubungi Pihak Administrasi Jika Ada Kesalahan</b>
                        @endif
                    </h3>
                    <h5>Gaji Lembur Sebesar Rp.{{$penggajian->jumlah_uang_lembur}} ,Gaji Pokok Sebesar Rp.{{$penggajian->gaji_pokok}} ,Menda pat Tunjangan Sebesar Rp.{{$penggajian->tunjangan_pegawai->tunjangan->besaran_uang}} ,Jadi Total Gaji Rp.{{$penggajian->gaji_total}}</h5>
                    </center>
                </div>
            </div>
        </div>
            <div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading ">
                <center>
                    <h4>History Penggajian</h4>
                </div>
                <div class="panel-body">
                <center>
                @foreach($USER as $DATAUSER)
                    @if(auth::user()->email==$DATAUSER->email)
                        @foreach($PEGAWAI as $DATAPEGAWAI)
                            @if($DATAPEGAWAI->id_user == $DATAUSER->id)
                                @foreach($TUNJANGAN as $DATATUNJANGAN)
                                    @if($DATATUNJANGAN->id_pegawai == $DATAPEGAWAI->id)
                                         @foreach($PENGGAJIAN as $DATAPENGGAJIAN)
                                            @if($DATAPENGGAJIAN->id_tunjangan_pegawai == $DATATUNJANGAN->id)
                        
                                                    <a class="btn btn-primary form-control" href="{{route('gaji.show',$DATAPENGGAJIAN->id)}}">{{$DATAPENGGAJIAN->created_at->month}}-{{$DATAPENGGAJIAN->created_at->day}}-{{$DATAPENGGAJIAN->created_at->year}}</a>
                                                    
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </center>
                </div>
            </div>
        </div>
    </div>



@endsection
