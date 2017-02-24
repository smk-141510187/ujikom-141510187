<?php

namespace App\Http\Controllers;

use Request;
use App\kategori_lembur ;
use App\jabatan ;
use App\golongan;
use Validator ;
use Input ;
class KategoriLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('AdminMiddleware');
    }
    public function index()
    {
        $kategorilembur=kategori_lembur::paginate(10);
        return view('kategorilembur.index',compact('kategorilembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongan=golongan::all();
        $jabatan=jabatan::all();
        return view('kategorilembur.create',compact('golongan','jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['kode_lembur' => 'required|unique:kategori_lemburs',
                'besaran_uang'=>'required|numeric|min:0',
                'id_jabatan'=>'required',
                'id_golongan'=>'required'];

        $message =['kode_lembur.required' => 'Mohon DiIsi',
                    'kode_lembur.unique' => 'Gunakan Kode Lain',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.required'=>'Mohon DiIsi',
                    'besaran_uang.numeric'=>'Gunkan Type Input Angka',
                    'id_jabatan.required'=>'Mohon DiIsi',
                    'id_golongan.required'=>'Mohon DiIsi'];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('kategorilembur/create')->withErrors($validate)->withInput();
            }

            $kategorilembur=Request::all();
            kategori_lembur::create($kategorilembur);
            return redirect('kategorilembur');
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
        $golongan=golongan::all();
        $jabatan=jabatan::all();
        $kategorilembur=kategori_lembur::find($id);
        return view('kategorilembur.edit',compact('golongan','jabatan','kategorilembur'));
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
        $kategorilembur=kategori_lembur::find($id);
       if ($kategorilembur->kode_lembur != Request('kode_lembur') ) {
            $rules =['kode_lembur' => 'required|unique:kategori_lemburs',
                'besaran_uang'=>'required|numeric|min:0',
                'id_jabatan'=>'required',
                'id_golongan'=>'required'];
        }
        else {
            $rules =['kode_lembur' => 'required',
                'besaran_uang'=>'required|numeric|min:0',
                'id_jabatan'=>'required',
                'id_golongan'=>'required'];
        }

        $message =['kode_lembur.required' => 'Mohon DiIsi',
                    'kode_lembur.unique' => 'Gunakan Kode Lain',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.required'=>'Mohon DiIsi',
                    'besaran_uang.numeric'=>'Gunkan Type Input Angka',
                    'id_jabatan.required'=>'Mohon DiIsi',
                    'id_golongan.required'=>'Mohon DiIsi'];
    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('kategorilembur/'.$id.'/edit')->withErrors($validate)->withInput();
            }


            $update=Request::all();
            $kategorilembur=kategori_lembur::find($id);
            $kategorilembur->update($update);
            return redirect('kategorilembur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategori_lembur::find($id)->delete();
        return redirect('kategorilembur');
    }
}
