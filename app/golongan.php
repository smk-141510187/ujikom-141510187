<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class golongan extends Model
{
        protected $table ='golongans';
    protected $fillable =['id','kode_golongan','nama_golongan','besaran_uang'];

     public function kategori_lembur()
    {
        return $this->HasMany('App\kategori_lembur','id_golongan');
    }
    public function pegawai()
    {
        return $this->HasMany('App\pegawai','id_pegawai');
    }
}
