<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tunjangan_pegawai extends Model
{
    protected $table ='tunjangan_pegawais';
    protected $fillable =['id','id_tunjangan','id_pegawai'];

    public function penggajian()
    {
        return $this->HasMany('App\penggajian','id_tunjangan_pegawai');
    }
    public function pegawai()
    {
        return $this->belongsTo('App\pegawai','id_pegawai');
    }
    public function tunjangan()
    {
        return $this->belongsTo('App\tunjangan','id_tunjangan');
    }
}
