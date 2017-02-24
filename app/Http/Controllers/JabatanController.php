<?php

namespace App\Http\Controllers;

use Request;
use Input ;
use Validator ;
use App\jabatan;
class JabatanController extends Controller
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
        $jabatan=jabatan::paginate(5);
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['kode_jabatan' => 'required|unique:jabatans',
                    'nama_jabatan' => 'required|unique:jabatans',
                    'besaran_uang' => ' required|min:0|numeric',];

        $message =['kode_jabatan.unique' => 'Code Already Exist',
                    'kode_jabatan.required' => 'Please Input',
                    'nama_jabatan.required' => 'Please Input',
                    'nama_jabatan.unique' => 'Jabatan Sudah Ada',
                    'besaran_uang.required' => 'Please Input',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.numeric' => 'Please Input Numeric'];
    

    $validate=Validator::make(Input::all(),$rules,$message);
    if ($validate->fails()) {
        return redirect('jabatan/create')->withErrors($validate)->withInput();
    }

    $jabatan=Request::all();
    jabatan::create($jabatan);
    return redirect('jabatan');
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
        $jabatan=jabatan::find($id);
        return view('jabatan.edit',compact('jabatan'));
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
        $jabatan=jabatan::find($id);
        if ($jabatan->kode_jabatan != Request('kode_jabatan') || $jabatan->nama_jabatan != Request('nama_jabatan')) {
            $rules =['kode_jabatan' => 'required|unique:jabatans',
                    'nama_jabatan' => 'required|unique:jabatans',
                    'besaran_uang' => ' required|min:0|numeric',];
        }
        else
        {
            $rules =['kode_jabatan' => 'required',
                    'nama_jabatan' => 'required',
                    'besaran_uang' => ' required|min:0|numeric',];
        }
        $message =['kode_jabatan.unique' => 'Gunakan Kode Lain',
                    'kode_jabatan.required' => 'Mohon Diisi',
                    'nama_jabatan.required' => 'Mohon Diisi',
                    'besaran_uang.required' => 'Mohon Diisi',
                    'nama_jabatan.unique'=> 'Jabatan Sudah Ada',
                    'besaran_uang.min' => 'Minimal 0',
                    'besaran_uang.numeric' => 'Mohon Isi Angka'];


    

            $validate=Validator::make(Input::all(),$rules,$message);
            if ($validate->fails()) {
                return redirect('jabatan/'.$id.'/edit')->withErrors($validate)->withInput();
            }

            $update=Request::all();
            $jabatan=jabatan::find($id);
            $jabatan->update($update);
            return redirect('jabatan');
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
                jabatan::find($id)->delete();
                return redirect('jabatan');
            }
}
