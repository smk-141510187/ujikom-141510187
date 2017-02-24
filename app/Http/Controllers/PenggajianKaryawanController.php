<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use App\pegawai ;
use auth ;
use App\penggajian ;
use App\tunjangan_pegawai ;
use DateTime ;
class PenggajianKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $USER=User::all();
        $PEGAWAI=pegawai::all();
        $PENGGAJIAN=penggajian::OrderBy('created_at','desc')->get();
        $TUNJANGAN=tunjangan_pegawai::all();
        $user=User::where('email',auth::user()->email)->first();
        $pegawai=pegawai::where('id_user',$user->id)->first();
        $tunjanganpegawai=tunjangan_pegawai::where('id_pegawai',$pegawai->id)->first();

        $penggajian=penggajian::where('id_tunjangan_pegawai',$tunjanganpegawai->id)->orderBy('created_at','dsc')->first();
        // dd($penggajian->created_at);

    if(!isset($penggajian)){
            return view('gaji.salah',compact('pegawai','tunjanganpegawai','penggajian','USER','PEGAWAI','PENGGAJIAN','TUNJANGAN'));

    }
    else{
        if (!isset($tunjanganpegawai)) {
            return view('gaji.indexbelumpunyagaji',compact('pegawai','tunjanganpegawai','penggajian','USER','PEGAWAI','PENGGAJIAN','TUNJANGAN'));
        }
        elseif (!isset($tunjanganpegawai) || !isset($penggajian)) {
            return view('gaji.indexbelumpunyagaji',compact('pegawai','tunjanganpegawai','penggajian','USER','PEGAWAI','PENGGAJIAN','TUNJANGAN'));
        }
            return view('gaji.index',compact('pegawai','tunjanganpegawai','penggajian','USER','PEGAWAI','PENGGAJIAN','TUNJANGAN'));
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::where('email',auth::user()->email)->first();
        $pegawai=pegawai::where('id_user',$user->id)->first();
        $tunjanganpegawai=tunjangan_pegawai::where('id_pegawai',$pegawai->id)->first();

        $penggajian=penggajian::where('id_tunjangan_pegawai',$tunjanganpegawai->id)->orderBy('created_at','asc')->first();
        // dd($penggajian->created_at);

        if (!isset($tunjanganpegawai)) {
            return view('gaji.indexbelumpunyagaji',compact('pegawai','tunjanganpegawai','penggajian'));
        }
        elseif (!isset($tunjanganpegawai) || !isset($penggajian)) {
            return view('gaji.indexbelumpunyagaji',compact('pegawai','tunjanganpegawai','penggajian'));
        }
        return view('gaji.index',compact('pegawai','tunjanganpegawai','penggajian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history=penggajian::find($id);
        $USER=User::all();
        $PEGAWAI=pegawai::all();
        $PENGGAJIAN=penggajian::OrderBy('created_at','desc')->get();
        $TUNJANGAN=tunjangan_pegawai::all();
        return view('gaji.history',compact('history','USER','PEGAWAI','PENGGAJIAN','TUNJANGAN'));
    }

    /*history
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $gaji=penggajian::find($id);
        $penggajian=new penggajian ;
        $penggajian=array('status_pengambilan'=>0,'tanggal_pengambilan'=>$gaji->created_at );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
