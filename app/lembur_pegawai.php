<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lembur_pegawai extends Model
{
    protected $table ='lembur_pegawais';
    protected $fillable =['id','id_kategori_lembur','id_pegawai','jumlah_jam'];

      public function pegawai()
    {
        return $this->belongsTo('App\pegawai','id_pegawai');
    }
     public function kategori_lembur()
    {
        return $this->belongsTo('App\kategori_lembur','id_kategori_lembur');
    }
}
