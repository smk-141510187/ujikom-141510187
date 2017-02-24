@extends('layouts.app')

@section('content')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Create Kategori Tunjangan</div>
                    
                <div class="panel-body">
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/tunjangan') }}">
                        {{ csrf_field() }}

                        
                            
                            <div class="col-md-6">
                                <label>Jabatan</label>
                                <select name="id_jabatan" class="form-control">
                                @foreach($jabatan as $datajabatan)
                                    <option value="{{$datajabatan->id}}">
                                        {{$datajabatan->nama_jabatan}}
                                    </option>
                                @endforeach
                                </select>
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
                                <label>Jumlah Anak</label>
                                <input type="text" class="form-control" name="jumlah_anak" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_anak') }}</strong>
                                    </span>
                            </div>
                            <div class="col-md-6">
                                <label>Kode Tunjangan</label>
                                <input type="text" class="form-control" name="kode_tunjangan" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_tunjangan') }}</strong>
                                    </span>
                            </div>

                            <div class="col-md-6">
                                <label for="Jabatan">Status</label>
                                    <select class="col-md-6 form-control" name="status">
                                            <option name="status">Parent</option>
                                            <option name="status">Menikah</option>
                                    </select>
                            </div>


                            <div class="col-md-6">
                                <label>Besaran Uang</label>
                                <input type="text" class="form-control" name="besaran_uang" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('besaran_uang') }}</strong>
                                    </span>
                            </div>

                            
                        
                           <div class="col-md-12">
                            <button type="submit" class="btn btn-primary form-control">Tambah</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
