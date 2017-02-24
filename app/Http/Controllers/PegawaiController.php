<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\pegawai ;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Input ;
use App\jabatan;
use App\golongan;
use App\kategori_lembur;
use DB ;
use App\tunjangan;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('AdminHrdMiddleware');
    }
    public function index()
    {
        $pegawai=pegawai::paginate(4);
        return view('pegawai.index',compact('pegawai'));
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
        return view('pegawai.create',compact('golongan','jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array('email' => 'required|unique:users',
                        'password' => 'required|min:6|confirmed',
                        'name' => 'required',
                        'permission' =>'required',
                        'nip' => 'required|min:11|numeric|unique:pegawais',
                        'id_jabatan' =>'required',
                        'id_golongan' => 'required',
                        'foto' => 'required',
                        'kode_lembur' => 'unique'
                         );
        $message =array('email.unique' =>'Gunakan Email Lain' ,
                        'name.required' =>'Wajib Isi',
                        'email.required' =>'Wajib Isi',
                        'password.unique' =>'wajib isi',
                        'permission.confirmed' =>'Masukan Password Yang Benar',
                        'permission.required' =>'Wajib isi',
                        'nip.unique' =>'Gunakan Nip Lain',
                        'nip.required' =>'Wajib isi',
                        'nip.min' =>'Min 11',
                        'nip.numeric' =>'Input Dengan Angka',
                        'id_jabatan.required' =>'Wajib isi',
                        'id_golongan.required' =>'Wajib isi');


        $val=validator::make(Input::all(),$rules,$message);
        if($val->fails())
        {
            return redirect('pegawai/create')
            ->withErrors($val)
            ->withInput();

        }
        $file =Input::file('foto');
       $distributor=public_path().'/asset/image';
       $filename=$file->getClientOriginalName();
       $uploadsuccess=$file->move($distributor,$filename);
       if (Input::hasfile('foto')) {
            $akun=new User ;
            $akun->name=Input::get('name');
             $akun->email=Input::get('email');
             $akun->password=bcrypt(Input::get('password'));
             $akun->permission=Input::get('permission');
             $akun->save();

             $pegawai=new pegawai ;
             $pegawai->nip=Input::get('nip');
             $pegawai->foto=$filename;
             $pegawai->id_jabatan=Input::get('id_jabatan');
             $pegawai->id_golongan=Input::get('id_golongan');
             $pegawai->id_user=$akun->id;
             $pegawai->save();

            $lama = kategori_lembur::where('id_jabatan',$pegawai->id_jabatan)->where('id_golongan',$pegawai->id_golongan)->first();
            // dd($lama);
            if (isset($lama)) {
            $error=true ;
            $pegawai=pegawai::paginate(5);
            return view('pegawai.index',compact('pegawai'));
        }
         }

         $kategorilembur=new kategori_lembur ;
         $kategorilembur->id_jabatan =$pegawai->id_jabatan;
         $kategorilembur->id_golongan=$pegawai->id_golongan;
         $a =date('dmys');
         $kategorilembur->kode_lembur="KODEKAT".$a."-".$pegawai->id_jabatan."-".$pegawai->id_golongan ;
         $kategorilembur->besaran_uang=0 ;
         $kategorilembur->save();
         return redirect('pegawai');

         $kategoritunjangan=new tunjangan  ;
         $kategoritunjangan->id_jabatan =$pegawai->id_jabatan;
         $kategoritunjangan->id_golongan=$pegawai->id_golongan;

         $a =date('dmys');
         $kategoritunjangan->kode_lembur="KODETUN".$a."-".$pegawai->id_jabatan."-".$pegawai->id_golongan ;
         $kategoritunjangan->besaran_uang=0 ;
         $kategoritunjangan->jumlah_anak=0 ;
         $kategoritunjangan->status="belum" ;
         $kategoritunjangan->save();
        return redirect('pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai=pegawai::find($id);
        return view('pegawai.read',compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai=pegawai::find($id);
        $jabatan=jabatan::all();
        $golongan=golongan::all();
        return view('pegawai.edit',compact('pegawai','jabatan','golongan'));
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
        $data = Input::all();
        $pegawai=pegawai::where('id',$id)->first();
        // dd($pegawai);
        // dd($pegawai->User->email);
        if ($pegawai->nip != Request('nip')) {
            $rules = array(
                        'name' => 'required',
                        'permission' =>'required',
                        'nip' => 'required|min:11|numeric|unique:pegawais',
                        'email' => 'required',
                        'id_jabatan' =>'required',
                        'id_golongan' => 'required',
                        'foto' => 'required',
                        'kode_lembur' => 'unique'
                         );
        }
        elseif ($pegawai->User->email != Request('email')) {
            $rules = array('email' => 'required|unique:users',
                        'nip' => 'required|min:11|numeric',
                        'name' => 'required',
                        'permission' =>'required',
                        'id_jabatan' =>'required',
                        'id_golongan' => 'required',
                        'foto' => 'required',
                        'kode_lembur' => 'unique'
                         );
        }
        
        else
        {
            $rules = array('email' => 'required',
                        'name' => 'required',
                        'permission' =>'required',
                        'nip' => 'required|min:11|numeric',
                        'id_jabatan' =>'required',
                        'id_golongan' => 'required',
                        'foto' => 'required',
                        'kode_lembur' => 'unique'
                         );
        }
             
        $message =array('email.unique' =>'Gunakan Email Lain' ,
                        'name.required' =>'Wajib Isi',
                        'email.required' =>'Wajib Isi',
                        'permission.confirmed' =>'Masukan Password Yang Benar',
                        'permission.required' =>'Wajib isi',
                        'nip.unique' =>'Gunakan Nip Lain',
                        'nip.required' =>'Wajib isi',
                        'nip.min' =>'Min 11',
                        'nip.numeric' =>'Input Dengan Angka',
                        'id_jabatan.required' =>'Wajib isi',
                        'id_golongan.required' =>'Wajib isi');


        $val=validator::make(Input::all(),$rules,$message);
        if($val->fails())
        {
            return redirect('pegawai/'.$id.'/edit')
            ->withErrors($val)
            ->withInput();
        }
            // $update=Input::all();
            // $user=User::find($pegawai->id_user);
            // $user->name=Input::get('name') ;
            // $user->email=Input::get('email');
            // $user->permission=Input::get('permission');
            // $user->update($update);
            $user=new User ;
                $user=array('name'=>Input::get('name'),
                                'email'=>Input::get('email'),
                                'permission'=>Input::get('permission')
                                );
            User::where('id',$pegawai->id_user)->update($user);
            $update=Input::all();
            $logo =Input::file('foto') ;
            $upload='asset/image';
            $filename=$logo->getClientOriginalName();
            $success=$logo->move($upload,$filename);

            if($success){
                $pegawai=new pegawai ;
                $pegawai=array('foto'=>$filename,
                                'nip'=>Input::get('nip'),
                                'id_jabatan'=>Input::get('id_jabatan'),
                                'id_golongan'=>Input::get('id_golongan'),
                                );

                    pegawai::where('id',$id)->update($pegawai);
                    // User::where('id',$pegawai->id_user)->update($akun);

                return Redirect('pegawai');
        }
            // dd($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai=pegawai::find($id);
        
        $user=User::where('id',$pegawai->id_user)->delete();
        $pegawai->delete();
        // dd($pegawai);
        return redirect('pegawai');
    }
}
