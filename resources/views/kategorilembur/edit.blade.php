@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Kategori Lembur</div>
                    
                <div class="panel-body">

                        {!!Form::model($kategorilembur,['method'=>'PATCH','route'=>['kategorilembur.update',$kategorilembur->id]])!!}
                            <div class="col-md-6">
                                <label for="kode_lembur" >Kode Lembur</label>
                                <input id="kode_lembur" value="{{$kategorilembur->kode_lembur}}" type="text" class="form-control" name="kode_lembur" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_lembur') }}</strong>
                                    </span>
                            </div>

                            <div class="col-md-6">
                                <label for="besaran_uang" >Besaran uang</label>
                                <input id="besaran_uang" value="{{$kategorilembur->besaran_uang}}" type="text" class="form-control" name="besaran_uang" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('besaran_uang') }}</strong>
                                    </span>
                            </div>

                            <div class="col-md-3">
                                <label for="Jabatan">Jabatan Lama</label>
                                    <input type="text" class="col-md-3 form-control" readonly value ="{{$kategorilembur->jabatan->nama_jabatan}}">
                            </div>

                            <div class="col-md-3">
                                <label for="Jabatan">Golongan Lama</label>
                                    <input type="text" class="col-md-3 form-control" readonly value ="{{$kategorilembur->golongan->nama_golongan}}">
                            </div>

                            <div class="col-md-3">
                                 <label for="Jabatan">Jabatan Baru</label>
                                    <select class="col-md-6 form-control" name="id_jabatan">
                                        @foreach($jabatan as $datajabatan)
                                            <option  value="{{$datajabatan->id}}" >{{$datajabatan->nama_jabatan}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            
                             <div class="col-md-3">
                                <label for="Jabatan">Golongan Baru</label>
                                    <select class="col-md-6 form-control" name="id_golongan">
                                        @foreach($golongan as $datagolongan)
                                            <option  value="{{$datagolongan->id}}" >{{$datagolongan->nama_golongan}}</option>
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
