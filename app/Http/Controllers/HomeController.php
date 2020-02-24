<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aduan;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jml_user = User::where('id_role', '4')->count();
        $jml_aduan_diterima = Aduan::count();
        $jml_aduan_diproses = Aduan::whereIn('status', ['DIPROSES','DISPOSISI','TINDAK LANJUT'])->count();
        $jml_aduan_selesai = Aduan::where('status', 'SELESAI')->count();
        
        $jml_notif_aduan_masuk = Aduan::where('notif',1)->count();
        $jml_notif_aduan_tindaklanjut = Aduan::where('notif',4)->count();
        $jml_notif_aduan_disposisi = Aduan::join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->where('aduans.notif',3)
        ->where('log_aduans.bidang','Bidang Informasi dan Komunikasi')
        ->count();

        $compact = [
            'jml_user',
            'jml_aduan_diterima',
            'jml_aduan_diproses',
            'jml_aduan_selesai',
            'jml_notif_aduan_masuk',
            'jml_notif_aduan_tindaklanjut',
            'jml_notif_aduan_disposisi'
        ];

        return view('index', compact($compact));
    }
}
