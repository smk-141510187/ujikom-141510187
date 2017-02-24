<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\penggajian ;
use App\tunjangan_pegawai ;
use App\pegawai ;
use App\tunjangan ;
use App\jabatan ;
use App\golongan;
use App\kategori_lembur ;
use App\lembur_pegawai ;
use Input ;
use Validator ;
use auth ;
use carbon\carbon ;
class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('AdminKeuanganMiddleware');
    }
    public function index()
    {
        $penggajian=penggajian::paginate(4);
        // $a=$penggajian->created_at ;
        // dd($a);
        $date=carbon::now();
        
        // if(request()->has('')){
        //     $golongan=Golongan::where('kode_golongan',request('kode_golongan'))->paginate(0);
        // }
        // <form action="{{url('golongan')}}/?kode_golongan=kode_golongan"> <input type="text" name="kode_golongan"> <button type="submit" class="btn btn-primary">
        //                             cari
        
        return view('penggajian.index',compact('penggajian','date'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tunjangan=tunjangan_pegawai::paginate(10);
        return view('penggajian.create',compact('tunjangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $rules =['id_tunjangan_pegawai' => 'required'];

        $message =['id_tunjangan_pegawai.required'=>'Penggajian Gagal'];
    

    $validate=Validator::make(Input::all(),$rules,$message);
    if ($validate->fails()) {
        return redirect('penggajian/create')->withErrors($validate)->withInput();
    }

        $penggajian=Input::all();
         // dd($penggajian);
        $where=tunjangan_pegawai::where('id',$penggajian['id_tunjangan_pegawai'])->first();
        // dd($where);
        $wherepenggajian=penggajian::where('id_tunjangan_pegawai',$where->id)->first();
        // dd($wherepenggajian);
        $wheretunjangan=tunjangan::where('id',$where->id_tunjangan)->first();
        // dd($where);
        $wherepegawai=pegawai::where('id',$where->id_pegawai)->first();
        // dd($wherepegawai);
        $wherekategorilembur=kategori_lembur::where('id_jabatan',$wherepegawai->id_jabatan)->where('id_golongan',$wherepegawai->id_golongan)->first();
        // dd($wherekategorilembur);
        $wherelemburpegawai=lembur_pegawai::where('id_pegawai',$wherepegawai->id)->first();
        // dd($wherelemburpegawai);
        $wherejabatan=jabatan::where('id',$wherepegawai->id_jabatan)->first();
        // dd($wherejabatan);
        $wheregolongan=golongan::where('id',$wherepegawai->id_golongan)->first();
        // dd($wheregolongan);
        $wherepenggajianbaru=penggajian::where('id_tunjangan_pegawai',$where->id)->orderBy('created_at','desc')->first() ;
        // dd($wherepenggajianbaru);
       $now = Carbon::now();
        if(isset($wherepenggajian)){
            if($wherepenggajianbaru->created_at->month==$now->month)
            {
                $tunjangan=tunjangan_pegawai::paginate(10);
                $error=true ;
                return view('penggajian.create',compact('tunjangan','error'));
            }
        }
        $penggajian=new penggajian ;
        if (!isset($wherelemburpegawai)) {
            $nol=0 ;
            $penggajian->jumlah_jam_lembur=$nol;
            $penggajian->jumlah_uang_lembur=$nol ;
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->gaji_total=($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
        $penggajian->id_tunjangan_pegawai=Input::get('id_tunjangan_pegawai');
        $penggajian->petugas_penerima=auth::user()->name ;
        $penggajian->save();
        }
        elseif (!isset($wherelemburpegawai)||!isset($wherekategorilembur)) {
            $nol=0 ;
            $penggajian->jumlah_jam_lembur=$nol;
            $penggajian->jumlah_uang_lembur=$nol ;
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->gaji_total=($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
            $penggajian->id_tunjangan_pegawai=Input::get('id_tunjangan_pegawai');
            $penggajian->petugas_penerima=auth::user()->name ;
            $penggajian->save();
        }
        else{
            $penggajian->jumlah_jam_lembur=$wherelemburpegawai->jumlah_jam;
            $penggajian->jumlah_uang_lembur=$wherelemburpegawai->jumlah_jam*$wherekategorilembur->besaran_uang ;
            
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->gaji_total=($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
            $penggajian->id_tunjangan_pegawai=Input::get('id_tunjangan_pegawai');
            $penggajian->petugas_penerima=auth::user()->name ;
            $penggajian->save();
            }
            return redirect('penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datapenggajian=penggajian::find($id);
        return view('penggajian.read',compact('datapenggajian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $gaji=penggajian::find($id);
        $penggajian=new penggajian ;
        $penggajian=array('status_pengambilan'=>1,'tanggal_pengambilan'=>$gaji->updated_at );
        penggajian::where('id',$id)->update($penggajian);
        return redirect('penggajian');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $rules =['jumlah_jam_lembur' => 'required|numeric|min:0'];

        $message =['jumlah_jam_lembur.required'=>'Mohon DiIsi',
                    'jumlah_jam_lembur.numeric'=>'Mohon Input Type Angka',
                    'jumlah_jam_lembur.min'=>'Minimal 0'];

        $validate=Validator::make(Input::all(),$rules,$message);
        if ($validate->fails()) {
            return redirect('tunjangan_pegawai/'.$id.'/edit')->withErrors($validate)->withInput();
        }

        $penggajianfind=penggajian::find($id);
         // dd($penggajian);
        $where=tunjangan_pegawai::where('id',$penggajianfind['id_tunjangan_pegawai'])->first();
        // dd($where);
        $wherepenggajian=penggajian::where('id_tunjangan_pegawai',$where->id)->first();
        // dd($wherepenggajian);
        $wheretunjangan=tunjangan::where('id',$where->id_tunjangan)->first();
        // dd($where);
        $wherepegawai=pegawai::where('id',$where->id_pegawai)->first();
        // dd($wherepegawai);
        $wherekategorilembur=kategori_lembur::where('id_jabatan',$wherepegawai->id_jabatan)->where('id_golongan',$wherepegawai->id_golongan)->first();
        // dd($wherekategorilembur);
        $wherelemburpegawai=lembur_pegawai::where('id_pegawai',$wherepegawai->id)->first();
        // dd($wherelemburpegawai);
        $wherejabatan=jabatan::where('id',$wherepegawai->id_jabatan)->first();
        // dd($wherejabatan);
        $wheregolongan=golongan::where('id',$wherepegawai->id_golongan)->first();
        // dd($wheregolongan);

        $update=Input::all();
        $penggajianfind=penggajian::find($id);
        if (!isset($wherekategorilembur)) {
            $nol=0 ;
            $error=true ;
            $penggajian=penggajian::find($id);
            return view('penggajian/'.$id.'/edit',compact('penggajian','error'));
        }
        else{

            $penggajianfind->jumlah_jam_lembur=Input::get('jumlah_jam_lembur');
            $penggajianfind->jumlah_uang_lembur=Input::get('jumlah_jam_lembur')*$wherekategorilembur->besaran_uang ;
            $penggajianfind->gaji_pokok=$penggajianfind->gaji_pokok;
            $penggajianfind->gaji_total=(Request('jumlah_jam_lembur')*$wherekategorilembur->besaran_uang)+($wheretunjangan->besaran_uang)+($penggajianfind->gaji_pokok);
            // dd($penggajianfind);
            $penggajianfind->update($update);
            }
        return redirect('penggajian/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        penggajian::find($id)->delete();
        return redirect('penggajian');
    }
}
