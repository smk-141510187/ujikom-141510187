<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori_lembur extends Model
{
    protected $table ='kategori_lemburs';
    protected $fillable =['id','kode_lembur','id_jabatan','id_golongan','besaran_uang'];

    public function lembur_pegawai()
    {
        return $this->HasMany('App\lembur_pegawai','id_kategori_lembur');
    }
    public function jabatan()
    {
        return $this->belongsTo('App\jabatan','id_jabatan');
    }
     public function golongan()
    {
        return $this->belongsTo('App\golongan','id_golongan');
    }
}
