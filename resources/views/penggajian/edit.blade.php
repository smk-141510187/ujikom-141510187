@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Edit Penggajian</h3> </div>
                    <div class="panel-body">
                     {!!Form::model($penggajian,['method'=>'PATCH','route'=>['penggajian.update',$penggajian->id]]) !!}
                        {{ csrf_field() }}

                            <div class="col-md-12">
                                <label >Jumlah Jam Lembur</label>
                                    <input type="text" name="jumlah_jam_lembur" class="form-control" value="{{$penggajian->jumlah_jam_lembur}}" autofocus>
                                    <span class="help-block">
                                        <strong>{{$errors->first('jumlah_jam_lembur')}}</strong>
                                    </span>
                            </div>

                            <div class="col-md-12" >
                                <button type="submit" class="btn btn-primary form-control">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

@endsection
