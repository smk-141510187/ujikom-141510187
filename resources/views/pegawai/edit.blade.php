@extends('layouts.app')

@section('content')
        <div class="col-md-5 ">
                <div class="panel-heading"><h2>Edit Pegawai</div>
                {!! Form
                ::model($pegawai,['method' => 'PATCH' , 'route'=> ['pegawai.update',$pegawai->id], 'enctype'=>'multipart/form-data'] ) !!}
                <div class="panel-body">
                            <div class="col-md-6">
                                <label for="name" >Nama Pegawai</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{$pegawai->user->name}}" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            </div>

                            <div class="col-md-6">
                                <label for="email" >E-MAIL</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{$pegawai->user->email}}" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            </div>

                             <div class="col-md-12">
                                <label >Type User</label>
                                   <select name="permission" class="col-md-12 form-control">
                                       <option>Admin</option>
                                       <option>HRD</option>
                                       <option>Bagian Administrasi</option>
                                       <option>Pegawai</option>
                                   </select>
                            </div>
                        
                </div>
                </div>

            
            <div class="col-md-4 ">
                <div class="panel-heading"><h2>Edit Pegawai</div>
                    
                <div class="panel-body">

                            <div class="col-md-12">
                                <label for="nip" >NIP Pegawai</label>
                                <input id="nip" type="text" class="form-control" name="nip" value="{{$pegawai->nip}}" autofocus>

                                    <span class="help-block">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                            </div>

                        

                            <div class="col-md-6">
                                <label for="Jabatan">Jabatan</label>
                                    <select class="col-md-6 form-control" name="id_jabatan">
                                        @foreach($jabatan as $datajabatan)
                                            <option  value="{{$datajabatan->id}}" >{{$datajabatan->nama_jabatan}}</option>
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

                            <div class="col-md-12">
                                <label >Foto Pegawai</label>
                                    <input type="file" class="form-control" name="foto" autofocus>

                                    @if ($errors->has('foto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('foto') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary form-control">Update</button>
                            </div>
                            <div class="col-md-12" >
                        </div>
                </div>  
                </div>

</form>

@endsection
