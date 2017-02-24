<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input ;
use Validator;
use App\tunjangan ;
use App\jabatan ;
use App\golongan ;
use App\penggajian ;
class TunjanganController extends Controller
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
        $tunjangan=tunjangan::paginate(5);
        return view('tunjangan.index',compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan=jabatan::all();
        $golongan=golongan::all();
        return view('tunjangan.create',compact('jabatan','golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['kode_tunjangan' => 'required|unique:tunjangans',
                    'jumlah_anak' => 'required|numeric|min:0',
                    'besaran_uang'=> 'required|numeric|min:0'];

        $message =['kode_tunjangan.required' => 'Silahkan Input',
                    'kode_tunjangan.unique' => 'Gunakan kode Lain',
                    'jumlah_anak.required' => 'Silahkan Input',                    
                    'jumlah_anak.numeric'=>'Input Numerik',
                    'jumlah_anak.min'=>'Minimal 0',
                    'besaran_uang.required'=>'Silahkan Input',
                    'besaran_uang.numeric'=>'Input Numerik',
                    'besaran_uang.min'=>'Minimal 0'];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('tunjangan/create')->withErrors($validate)->withInput();
            }

            $tunjangan=Request::all();
            tunjangan::create($tunjangan);
            return redirect('tunjangan');

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
        $penggajian=penggajian::find($id);
        return view('penggajian.edit',compact('penggajian'));

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
        tunjangan::find($id)->delete();
        return redirect('tunjangan');
    }
}
