<?php

namespace App\Http\Controllers;

use Request;
use App\lembur_pegawai ;
use App\kategori_lembur ;
use App\pegawai ;
use Validator ;
use Input ;
use App\User ;
use DB ;
use carbon\carbon ;
class LemburPegawaiController extends Controller
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

        $pegawai=DB::table('pegawais')->selectRaw('id')->get();
        $lemburpegawai=lembur_pegawai::orderBy('created_at' , 'desc')->paginate(10);
        $pegawai1=pegawai::all();
        $kategorilembur=kategori_lembur::all();
        return view('lemburpegawai.index',compact('lemburpegawai','pegawai','kategorilembur','lemburpegawai1'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorilembur=kategori_lembur::all();
        $pegawai=pegawai::all();
        return view('lemburpegawai.create',compact('pegawai','kategorilembur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules =['jumlah_jam' => 'required|numeric|min:0',];
        $message =['jumlah_jam.required' => 'Please Input',
                    'jumlah_jam.numeric' => 'Input Number',
                    'jumlah_jam.min' => 'Minimal 0',];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('lemburpegawai/create')->withErrors($validate)->withInput();
            }

            $now = Carbon::now();

            $pegawai=pegawai::where('id',Request('id_pegawai'))->first();
            $lemburpegawai=lembur_pegawai::where('id_pegawai',$pegawai->id)->first();
            $lemburpegawaibaru=lembur_pegawai::where('id_pegawai',$pegawai->id)->OrderBy('created_at','desc')->first();
             // dd();
            if(isset($lemburpegawai))
            {
                if($lemburpegawaibaru->created_at->day==$now->day)
                {
                    $error=true ;
                $kategorilembur=kategori_lembur::all();
                $pegawai=pegawai::all();
                return view('lemburpegawai.create',compact('pegawai','kategorilembur','error'));
                }
            }

            $lemburpegawai=Request::all();
            $pegawai=pegawai::where('id',$lemburpegawai['id_pegawai'])->first();
            $check=kategori_lembur::where('id_jabatan',$pegawai->id_jabatan)->where('id_golongan',$pegawai->id_golongan)->first();
            // dd($check);
            if (!isset($check->id)) {
                $kategorilembur=kategori_lembur::all();
                $pegawai=pegawai::all();
                $error=true;
                return view('lemburpegawai.create',compact('pegawai','kategorilembur','error'));
            }
        // dd($lemburpegawai);
        $lemburpegawai['id_kategori_lembur']= $check->id;
        lembur_pegawai::create($lemburpegawai);
        return redirect('lemburpegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $kategorilembur=kategori_lembur::all();
        $pegawai=pegawai::all();
        $lemburpegawai=lembur_pegawai::find($id);
        return view('lemburpegawai.edit',compact('pegawai','kategorilembur','lemburpegawai'));
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
        $rules =['jumlah_jam' => 'required|numeric|min:0',];

        $message =['jumlah_jam.required' => 'Please Input',
                    'jumlah_jam.numeric' => 'Input Number',
                    'jumlah_jam.min' => 'Minimal 0',];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('lemburpegawai/create')->withErrors($validate)->withInput();
            }
        $update=Request::all();
        $lemburpegawai=lembur_pegawai::find($id);
        $lemburpegawai->update($update);
        return redirect('lemburpegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        lembur_pegawai::find($id)->delete();
        return redirect('lemburpegawai');
    }
}
