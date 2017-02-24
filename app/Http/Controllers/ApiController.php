<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model. untuk nama model sesuaikan dengan nama model kalian
use App\User;
use App\jabatan;
use App\golongan;
use App\pegawai;
use App\tunjangan;
use App\tunjangan_pegawai;
use App\kategori_lembur;
use App\lembur_pegawai;
use App\penggajian;

use Auth;
use DB;
use Hash;
use JWTAuth;

class ApiController extends Controller
{
    // public function register(Request $request)
    // {        
    // 	$input = $request->all();
    // 	$input['password'] = Hash::make($input['password']);
    // 	User::create($input);
    //     return response()->json(['result'=>true]);
    // }
    

    public function login(Request $request)
    {
        // $user = User::where('id', Auth::user()->id)->get();
        $response = array("error" => FALSE);
    	$input = $request->all();
         // dd(Request('email'));
    	if (!$token = JWTAuth::attempt($input)) {
            $response["error"] = TRUE;
            $response["error_msg"] = "Email or password yang anda masukan salah. Silahkan Coba Lagi!";
            // return response()->json(['result' => 'wrong email or password.']);
            return ($response);
        }

        
        $user = JWTAuth::toUser($token);
        $USER=User::where('email',Request('email'))->firstorFail();
        $pegawai=pegawai::where('id_user',$USER->id)->firstorFail();
        $jabatan=jabatan::where('id',$pegawai->id_jabatan)->firstorFail();
        $golongan=golongan::where('id',$pegawai->id_golongan)->firstorFail();
        $tunjanganpegawai=tunjangan_pegawai::where('id_pegawai',$pegawai->id)->firstorFail();
        $tunjangan=tunjangan::where('id',$tunjanganpegawai->id_tunjangan)->firstorFail();
        $penggajian=penggajian::where('id_tunjangan_pegawai',$tunjanganpegawai->id)->firstorFail();
        // Detail user & Pegawai Json
        // Bisa diakses lewat postman & Android Login
        // $detail =$user::select('users.id as uid', 
        //                         'users.name as name', 
        //                         'users.email as email', 
        //                         'users.created_at as created_at', 
        //                         'users.permission as permission', 
        //                         'pegawais.nip as nip',
        //                         'pegawais.foto as foto', 
        //                         'jabatans.nama_jabatan as jabatan', 
        //                         'jabatans.besaran_uang as uangjabatan',
        //                         'golongans.nama_golongan as golongan',
        //                         'golongans.besaran_uang as uanggolongan',
        //                         DB::raw('(jabatans.besaran_uang + golongans.besaran_uang) as gaji'))
        //             ->join('pegawais', 'pegawais.id_user', '=', 'users.id')
        //             ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id')
        //             ->join('golongans', 'pegawais.id_golongan', '=', 'golongans.id')
        //             ->join('tunjangan_pegawais' , 'tunjangan_pegawais.id_tunjangan', '=','tunjangans.id')
        //             ->join('tunjangans', 'tunjangans.id', '=', 'tunjangan_pegawais.kode_tunjangan_id')
        //             ->where('users.id', $user->id)
                    // ->firstorFail();

        // Get Photo
        $img = asset("profile/".$pegawai->photo);

        // JSON Output
        $response["error"] = FALSE;
        $response["uid"] = $USER["uid"];
        $response["user"]["foto"] = $img;
        $response["user"]["name"] = $USER["name"];
        $response["user"]["email"] = $USER["email"];
        $response["user"]["permission"] = $USER["permission"];
        $response["user"]["nip"] = $pegawai["nip"];
        $response["user"]["created_at"] = $USER["created_at"];
        $response["user"]["detail"]["jabatan"] = $jabatan["nama_jabatan"];
        $response["user"]["detail"]["golongan"] = $golongan["nama_golongan"];
        $response["user"]["keuangan"]["uang jabatan"] = $jabatan["besaran_uang"];
        $response["user"]["keuangan"]["uang golongan"] = $golongan["besaran_uang"];
        $response["user"]["keuangan"]["gaji pokok"] = $penggajian["gaji_pokok"] ;
        $response["user"]["keuangan"]["Tunjangan"] = $tunjangan["besaran_uang"];
        


        // echo json_encode($response);
        // return response()->json(['result' =>  $response]);
        return ($response);
    }
    
    // public function get_user_details(Request $request)
    // {
    // 	$input = $request->all();
    // 	$user = JWTAuth::toUser($input['token']);
    //     return response()->json(['result' => $user]);
    // }
}
