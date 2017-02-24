@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Golongan</div>
                    
                <div class="panel-body">
                     {!!Form::model($golongan,['method'=>'PATCH','route'=>['golongan.update',$golongan->id]])!!}

                            <div class="col-md-6">
                                <label for="kode_golongan" >Kode Golongan</label>
                                <input id="kode_golongan" type="text" class="form-control" name="kode_golongan" value="{{$golongan->kode_golongan}}" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_golongan') }}</strong>
                                    </span>
                            </div>

                        

                            <div class="col-md-6">
                                <label for="nama_golongan" >Golongan</label>
                                <input id="nama_golongan" type="text" class="form-control" name="nama_golongan" value="{{$golongan->nama_golongan}}" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_golongan') }}</strong>
                                    </span>
                            </div>

                            

                            <div class="col-md-12">
                                <label control-label">Besaran Uang</label>
                                <input id="besaran_uang" type="text" class="form-control" name="besaran_uang" value="{{$golongan->besaran_uang}}" autofocus>

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
@endsection
