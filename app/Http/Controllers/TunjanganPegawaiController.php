<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator ;
use Input ;
use App\tunjangan_pegawai ;
use App\pegawai;
use App\tunjangan ;
class TunjanganPegawaiController extends Controller
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

        $tunjanganpegawai=tunjangan_pegawai::paginate(10);
        
        return view('tunjanganpegawai.index',compact('tunjanganpegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pegawai=pegawai::all();
        $tunjangan=tunjangan::all();
        return view('tunjanganpegawai.create',compact('pegawai','tunjangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['id_pegawai' => 'required|unique:tunjangan_pegawais',
                'kode_tunjangan' => 'required|unique:tunjangans',
                    'jumlah_anak' => 'required|numeric|min:0',
                    'besaran_uang'=> 'required|numeric|min:0'];

        $message =['id_pegawai.required' => 'Wajib Isi',
                    'id_pegawai.unique' => 'Tunjangan Hanya Bisa 1 Kali',
                    'kode_tunjangan.required' => 'Silahkan Input',
                    'kode_tunjangan.unique' => 'Gunakan kode Lain',
                    'jumlah_anak.required' => 'Silahkan Input',                    
                    'jumlah_anak.numeric'=>'Input Numerik',
                    'jumlah_anak.min'=>'Minimal 0',
                    'besaran_uang.required'=>'Silahkan Input',
                    'besaran_uang.numeric'=>'Input Numerik',
                    'besaran_uang.min'=>'Minimal 0'];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('tunjanganpegawai/create')->withErrors($validate)->withInput();
            }

            $tunjanganpegawai=Input::all();
            // dd($tunjanganpegawai);
            $pegawai=pegawai::where('id',$tunjanganpegawai['id_pegawai'])->first();
            // $check=tunjangan::where('id_jabatan',$pegawai->id_jabatan)->where('id_golongan',$pegawai->id_golongan)->first();
            // dd($pegawai);
            // if (!isset($check->id)) {
            //     $pegawai=pegawai::all();
            //     $error=true;
            //     return view('tunjanganpegawai.create',compact('pegawai','error'));
            // }

            $tunjangan=new tunjangan ;
            // dd($lemburpegawai);
            $date=date("dmy");
            $tunjangan->kode_tunjangan=Input::get('kode_tunjangan') ;
            $tunjangan->id_jabatan=$pegawai->id_jabatan ;
            $tunjangan->id_golongan=$pegawai->id_golongan;
            $tunjangan->status=Input::get('status');
            $tunjangan->jumlah_anak=Input::get('jumlah_anak');
            $tunjangan->besaran_uang=Input::get('besaran_uang');
            $tunjangan->save();

            $tunjanganpegawai=new tunjangan_pegawai ;
            $tunjanganpegawai['id_pegawai'] = $pegawai->id;
            $tunjanganpegawai['id_tunjangan'] = $tunjangan->id;
            $tunjanganpegawai->save();

            return redirect('tunjanganpegawai');
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
        $pegawai=pegawai::all();
        $tunjanganpegawai=tunjangan_pegawai::find($id);
        return view('tunjanganpegawai.edit',compact('tunjanganpegawai','pegawai'));
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
        $wheretunjanganpegawai=tunjangan_pegawai::where('id',$id)->first();
        if ($wheretunjanganpegawai->tunjangan->kode_tunjangan != Request('kode_tunjangan')) {
            $rules =['kode_tunjangan' => 'required|unique:tunjangans',
                    'id_pegawai' => 'required',
                    'jumlah_anak' => 'required|numeric|min:0',
                    'besaran_uang'=> 'required|numeric|min:0'];
        }
        elseif ($wheretunjanganpegawai->id_pegawai != Request('id_pegawai')) {
            $rules =['kode_tunjangan' => 'required',
                    'id_pegawai' => 'required|unique:tunjangan_pegawais',
                    'jumlah_anak' => 'required|numeric|min:0',
                    'besaran_uang'=> 'required|numeric|min:0'];
        }
        else
        {

            $rules =['id_pegawai' => 'required',
                'kode_tunjangan' => 'required',
                    'jumlah_anak' => 'required|numeric|min:0',
                    'besaran_uang'=> 'required|numeric|min:0'];
        }

        $message =['id_pegawai.required' => 'Wajib Isi',
                    'id_pegawai.unique' => 'Tunjangan Hanya Bisa 1 Kali',
                    'kode_tunjangan.required' => 'Silahkan Input',
                    'kode_tunjangan.unique' => 'Gunakan kode Lain',
                    'jumlah_anak.required' => 'Silahkan Input',                    
                    'jumlah_anak.numeric'=>'Input Numerik',
                    'jumlah_anak.min'=>'Minimal 0',
                    'besaran_uang.required'=>'Silahkan Input',
                    'besaran_uang.numeric'=>'Input Numerik',
                    'besaran_uang.min'=>'Minimal 0'];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('tunjanganpegawai/'.$id.'/edit')->withErrors($validate)->withInput();
            }

            $tunjangan=new tunjangan ;
            $tunjangan = array('kode_tunjangan' =>Input::get('kode_tunjangan'),
                                'status'=>Input::get('status'),
                                'jumlah_anak'=>Input::get('jumlah_anak'),
                                'besaran_uang'=>Input::get('besaran_uang'));
            tunjangan::where('id',$wheretunjanganpegawai->id_tunjangan)->update($tunjangan);
            
            $update=Input::all();
            $tunjangan_pegawai=tunjangan_pegawai::find($id);
            $tunjangan_pegawai->update($update);


            return redirect('tunjanganpegawai');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tunjanganpegawai=tunjangan_pegawai::find($id);
        $tunjangan=tunjangan::where('id',$tunjanganpegawai->id_tunjangan)->delete();
        $tunjanganpegawai->delete();
        return redirect('tunjanganpegawai');
    }
}
