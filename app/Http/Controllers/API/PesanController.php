<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesan;
use App\User;
use Response;
use DB;

class PesanController extends Controller
{
    public function Pesan(Request $request,$id_aduan)
    {
        $id_create = auth('api')->user()->id;

        $pesan = new Pesan;
        $pesan->id_user         = $id_create;
        $pesan->id_aduan        = $id_aduan;
        $pesan->pesan           = $request->pesan;
        $pesan->save();


        return response()->json([
            'message' => 'Komentar berhasil diKirim'
        ]);
    }


    public function listChat($id_aduan)
    {
        // $user = auth('api')->user()->id;

        $chat = DB::table('pesans')
            ->select('pesans.id','id_aduan','id_user','id_role','pesan','pesans.created_at')
            ->leftJoin('users','users.id', 'id_user')
            ->groupBy('pesans.id','id_aduan','id_user','id_role','pesan','pesans.created_at')
            ->where('id_aduan',$id_aduan)
            ->orderBy('pesans.created_at','asc')
            ->get();

        foreach ($chat as $key => $value) {
            $value->name = User::where('id',$value->id_user)->first()->name;
        }

        return Response::json(array(
            'message'=> 'List chat',
            'detail' => $chat->toArray()),200
        );
    }
}
