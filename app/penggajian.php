<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penggajian extends Model
{
    protected $table ='penggajians';
    protected $fillable =['id','nip','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji','tanggal_pengambilan','tanggal_pengambilan','status_pengambilan','petugas_penerima','id_tunjangan_pegawai','updated_at','created_at'];

    public function tunjangan_pegawai()
    {
        return $this->belongsTo('App\tunjangan_pegawai','id_tunjangan_pegawai');
    }
}
