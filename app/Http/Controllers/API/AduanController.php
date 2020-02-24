<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Aduan;
use App\Helper;
use Carbon\Carbon;
use DB;
use Response;

class AduanController extends Controller
{
    public function AduanMasuk(Request $request)
    {
        $status     = 'BELUM DIPROSES';
        $bidang     = NULL;
        $jawaban    = NULL;
        $id_create  = auth('api')->user()->id;

        $aduan = new Aduan;
        $aduan->status          = $status;
        $aduan->id_user         = $id_create;
        $aduan->jenis_produk    = $request->jenis_produk;
        $aduan->nama_produk     = $request->nama_produk;
        $aduan->no_reg          = $request->no_reg;
        $aduan->tgl_exp         = $request->tgl_exp;
        $aduan->nama_pabrik     = $request->nama_pabrik;
        $aduan->alamat_pabrik   = $request->alamat_pabrik;
        $aduan->no_batch        = $request->no_batch;
        $aduan->lat             = $request->lat;
        $aduan->lng             = $request->lng;
        $aduan->alamat_beli     = $request->alamat_beli;
        $aduan->tgl_guna        = $request->tgl_guna;
        $aduan->info_lain       = $request->info_lain;
        $aduan->isi             = $request->isi;
        $aduan->notif           = 1;

        $file = $request->file('file');
        // $destinationPath = base_path() . '/storage/';
        $destinationPath = 'storage/gambar/';
        $namaFile = 'adm-' . str_random(5). '.pdf';
        // $file->storeAs("gambar",$namaFile,"public");
        $file->move($destinationPath, $namaFile);
        $aduan->file = $namaFile;

        $aduan->save();

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create);

        return response()->json([
            'message' => 'Aduan berhasil diterima'
        ]);
    }

    public function listAduan()
    {
        $user = auth('api')->user()->id;

        $aduan = DB::table('aduans')
            ->where('id_user',$user)
            ->orderBy('created_at','desc')
            ->get();


            foreach ($aduan as $key => $value) {
                $value->nama = User::where('id',$value->id_user)->first()->name;
            }

        return Response::json(array(
            'message'=> 'List Aduan',
            'detail' => $aduan->toArray()),200
        );

    }
    
     public function notif()
    {
        $user = auth('api')->user()->id;

        $aduan = DB::table('aduans')
            ->where('id_user',$user)
            // ->whereNotIn('notif',[0])
            ->whereNotIn('value',[0])
            ->get()
            ->count();

       
         return response()->json([
                     'jumlah'=>$aduan
                  ]);

    }
    
    public function updateNotif($id)
    {

        $aduan = Aduan::find($id);
        $aduan->value   = 0;
        // $aduan->notif   = 0;
        $aduan->save();

        return response()->json([
            'message' => 'status berhasil diupdate'
        ]);

    }


    public function userDashboard(Request $request)
    {
        // jumlah aduan

        $jumlah_aduan_year = DB::table('aduans')
                ->select(DB::raw('count(*) as jumlah'),DB::raw('MONTH(created_at) as bulan'))
                ->groupBy('bulan')
                ->get();
        // $jumlah_aduan_year->map()

        // $jumlah_aduan_year->map(function($item,$key){
        //     return $item->bulan = $this->castMonths($item->bulan);
        // });
    
        return Response::json(array(
            'message'=> 'List Grafik',
            'detail' => $jumlah_aduan_year->toArray()),200
        );
    }


    public function cariAduan(request $request,$search)
    {
        $search = Aduan::select('id')
            ->where('nama_produk','like','%'.strtolower($search).'%')
            ->get()->pluck('id');

        $aduan = Aduan::where('id',$search)->orderBy('created_at','desc')->get();

        return Response::json(array(
            'message'=> 'List Aduan',
            'detail' => $aduan->toArray()),200

        );
    }

    // private function castMonths($month)
    // {
    //     switch ($month) {
    //         case '1':
    //             return "Januari";
    //         case '2':
    //             return "Februari";
    //         case '3':
    //             return "Maret";
    //         case '4':
    //             return "April";
    //         case '5':
    //             return "Mei";
    //         case '6':
    //             return "Juni";
    //         case '7':
    //             return "Juli";
    //         case '8':
    //             return "Agustus";
    //         case '9':
    //             return "September";
    //         case '10':
    //             return "Oktober";
    //         case '11':
    //             return "Oktober";
    //         case '12':
    //             return "Oktober";

    //     }
    // }
}
