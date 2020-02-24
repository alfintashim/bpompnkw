<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Berita;
use App\Helper;
use Carbon\Carbon;
use Response;
use DB;

class BeritaController extends Controller
{
    public function list(Request $request)
    {
        $list =  DB::table('beritas')
            ->select('beritas.id','users.name','judul','isi','gambar','status','id_create','beritas.created_at')
            ->leftJoin('users','users.id', 'id_create')
            ->groupBy('beritas.id','users.name','judul','isi','gambar','status','id_create','beritas.created_at')
            ->where('status','PUBLISH')
            ->orderBy('beritas.id','desc')
            ->get();

        return Response::json(array(
            'message'=> 'List Berita',
            'detail' => $list->toArray()),200
        );
    }

    public function listDashboard(Request $request)
    {
        $list =  DB::table('beritas')
            ->select('beritas.id','users.name','judul','isi','gambar','status','id_create','beritas.created_at')
            ->leftJoin('users','users.id', 'id_create')
            ->groupBy('beritas.id','users.name','judul','isi','gambar','status','id_create','beritas.created_at')
            ->where('status','PUBLISH')
            ->orderBy('beritas.id','desc')
            ->limit(5)
            ->get();


        return Response::json(array(
            'message'=> 'List Berita Dashboard',
            'detail' => $list->toArray()),200
        );
    }

    public function cariBerita(request $request,$search)
    {
        $search = Berita::select('id')
            ->where('judul','like','%'.strtolower($search).'%')
            ->get()->pluck('id');

        $berita = Berita::where('id',$search)->orderBy('created_at','desc')->get();

        return Response::json(array(
            'message'=> 'List Berita',
            'detail' => $berita->toArray()),200
        );
    }
}
