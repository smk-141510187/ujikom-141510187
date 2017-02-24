@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Create Kategori Lembur</div>
                    
                <div class="panel-body">
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/kategorilembur') }}">
                        {{ csrf_field() }}

                            <div class="col-md-6">
                                <label for="kode_lembur" >Kode Lembur</label>
                                <input id="kode_lembur" type="text" class="form-control" name="kode_lembur" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_lembur') }}</strong>
                                    </span>
                            </div>

                            <div class="col-md-6">
                                <label for="besaran_uang" >Besaran uang</label>
                                <input id="besaran_uang" type="text" class="form-control" name="besaran_uang" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('besaran_uang') }}</strong>
                                    </span>
                            </div>

                             <div class="col-md-6">
                                <label for="Jabatan">Golongan</label>
                                    <select class="col-md-6 form-control" name="id_golongan">
                                        @foreach($golongan as $datagolongan)
                                            <option  value="{{$datagolongan->id}}" >{{$datagolongan->nama_golongan}}</option>
                                        @endforeach
                                    </select>
                            </div>

                            <div class="col-md-6">
                                 <label for="Jabatan">Jabatan</label>
                                    <select class="col-md-6 form-control" name="id_jabatan">
                                        @foreach($jabatan as $datajabatan)
                                            <option  value="{{$datajabatan->id}}" >{{$datajabatan->nama_jabatan}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        
                           <div class="col-md-12">
                            <button type="submit" class="btn btn-primary form-control">Tambah</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>

        
@endsection
