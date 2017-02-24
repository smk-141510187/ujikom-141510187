@extends('layouts.app')

@section('content')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Create Lembur Pegawai</div>
                    
                <div class="panel-body">
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/lemburpegawai') }}">
                        {{ csrf_field() }}

                        <div class="col-md-6">
                                <label >Nip Dan Nama Pegawai</label>
                                    <select class="col-md-12 form-control" name="id_pegawai">
                                        @foreach($pegawai as $datapegawai)
                                            <option  value="{{$datapegawai->id}}" >
                                            {{$datapegawai->nip}} {{$datapegawai->User->name}}
                                                </option>
                                        @endforeach
                                    </select>
                                    @if(isset($error))
                                <div>
                                    Tidak memiliki kategori lembur
                                </div>
                                @endif
                        </div>

                        
                            <div class="col-md-6">
                                <label for="jumlah_jam" >Jumlah Jam Lembur</label>
                                <input id="jumlah_jam" type="text" class="form-control" name="jumlah_jam" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_jam') }}</strong>
                                    </span>
                                    <div class="col-md-6">
                                @if(isset($error))
                                    Hari Ini Dia Sudah Lembur
                                @endif
                            </div>
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
