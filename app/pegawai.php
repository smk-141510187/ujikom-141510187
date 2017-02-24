<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table ='pegawais';
    protected $fillable =['id','nip','id_user','id_jabatan','id_golongan','foto'];

    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

     public function lembur_pegawai()
    {
        return $this->HasMany('App\lembur_pegawai','id_pegawai');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\jabatan','id_jabatan');
    }

    public function golongan()
    {
        return $this->belongsTo('App\golongan','id_golongan');
    }

    public function tunjangan_pegawai()
    {
        return $this->HasMany('App\tunjangan_pegawai','id_pegawai');
    }

}
