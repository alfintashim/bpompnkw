<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Biouser;
use App\Helper;
use Carbon\Carbon;
use Response;
use DB;

class BiodataController extends Controller
{
     public function Profil(Request $request,$id)
    {

        $id_create  = auth('api')->user()->id;
      
        $profil = Biouser::findOrFail($id);
        $profil->id_user         = $id_create;
        $profil->jk              = $request->jk;
        $profil->alamat          = $request->alamat;
        $profil->profesi         = $request->profesi;
        $profil->instansi        = $request->instansi;
        $profil->no_hp           = $request->no_hp;
        $profil->no_ktp          = $request->no_ktp;

        $ktp = $request->file('ktp');
        $destinationPath = 'storage/profil';
        $namaFile = 'ktp-' . str_random(5). '.jpeg';
        // $ktp->storeAs("ktp",$namaFile,"public");
        $ktp->move($destinationPath, $namaFile);
        $profil->ktp = $namaFile;

        // $foto = $request->file('foto');
        // $destinationPath = base_path() . '/storage/profil';
        // $namaFile = 'foto-' . str_random(5). '.jpeg';
        // $foto->storeAs("foto",$namaFile,"public");
        // $foto->move($destinationPath, $namaFile);
        // $profil->foto = $namaFile;

        $profil->save();

    
        return response()->json([
            'message' => 'Biodata berhasil diisi'
        ]);
    }

     public function detailBiodata()
    {
        $id_create  = auth('api')->user()->id;

        $biodata = Biouser::where('id_user',$id_create)->first();
 
       
        return Response::json(
            $biodata,200
        );
    
    }

     public function aktivasiBiodata(Request $request)
    {

        $id_create  = auth('api')->user()->id;

       $biodata = Biouser::where('id_user',$id_create)->first();
        
       
        
        

        if($biodata->jk != null){
            return response()->json([
                'message' => 'Ada'
            ]);
        }else{
            return response()->json([
                'message' => 'Tidak Ada'
            ]);
        }
    }


}
