<?php

namespace App\Http\Controllers;

use Request;
use Validator ;
use Input ;
use App\golongan ;
class GolonganController extends Controller
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
        
        $golongan=golongan::paginate(5);
        return view('golongan.index',compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules =['kode_golongan' => 'required|unique:golongans',
                    'nama_golongan' => 'required|unique:golongans',
                    'besaran_uang' => ' required|min:0|numeric',];

        $message =['kode_golongan.unique' => 'Gunakan Kode Lain',
                    'kode_golongan.required' => 'Mohon Diisi',
                    'nama_golongan.required' => 'Mohon Diisi',
                    'besaran_uang.required' => 'Mohon Diisi',
                    'nama_golongan.unique' => 'Golongan Sudah Ada',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.numeric' => 'Mohon isi Angka',];
    

    $validate=Validator::make(Input::all(),$rules,$message);
    if ($validate->fails()) {
        return redirect('golongan/create')->withErrors($validate)->withInput();
    }

    $golongan=Request::all();
    golongan::create($golongan);
    return redirect('golongan');
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
    public function search(Request $request)
    {
        $query = Request('r');
        $hasil = golongan::where('nama_golongan', 'LIKE', '%' . $query . '%')->paginate(10);
        // dd($hasil);
        return view('golongan.show', compact('hasil', 'query'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $golongan=golongan::find($id);
        return view('golongan.edit',compact('golongan'));
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
        $golongan=golongan::find($id);
        if ($golongan->kode_golongan != Request('kode_golongan') || $golongan->nama_golongan != Request('nama_golongan')) {
            $rules =['kode_golongan' => 'required|unique:golongans',
                    'nama_golongan' => 'required|unique:golongans',
                    'besaran_uang' => ' required|min:0|numeric',];
        }
        else
        {
                $rules =['kode_golongan' => 'required',
                    'nama_golongan' => 'required',
                    'besaran_uang' => ' required|min:0|numeric',];
        }

        $message =['kode_golongan.unique' => 'Gunakan Kode Lain',
                    'kode_golongan.required' => 'Mohon Diisi',
                    'nama_golongan.required' => 'Mohon Diisi',
                    'besaran_uang.required' => 'Mohon Diisi',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.numeric' => 'Mohon isi Angka',];
    

        $validate=Validator::make(Input::all(),$rules,$message);
        if ($validate->fails()) {
            return redirect('golongan/'.$id.'/edit')->withErrors($validate)->withInput();
        }

        $update=Request::all();
        $golongan=golongan::find($id);
        $golongan->update($update);
        return redirect('golongan');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        golongan::find($id)->delete();
        return redirect('golongan');
    }
}
