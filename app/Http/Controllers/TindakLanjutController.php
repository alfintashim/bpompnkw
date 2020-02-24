<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aduan;
use App\User;
use App\Log_aduan;
use Auth;
use Alert;
use App\Helper;
use App\Laporan;
use Response;
use Carbon;

class TindakLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aduan_diproses = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DIPROSES')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $compact = [
            'aduan_diproses'
        ];
        
        return view('tindaklanjut.index', compact($compact))
        ->with('nodiproses',1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_aduan = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 'biousers.jk', 'biousers.alamat','biousers.profesi','biousers.instansi','biousers.no_hp','biousers.no_ktp','biousers.ktp','biousers.foto', 'aduans.*')
        ->where('aduans.id',$id)
        ->first();
        
        $detail_aduan->notif = 0;
        $detail_aduan->update();

        // $petugas = Aduan::join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        // ->join('users', 'log_aduans.id_create', '=', 'users.id')
        // ->select('users.name')
        // ->where('aduans.id',$id)
        // ->first();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id_aduan',$id)
        ->orderBy('log_aduans.id', 'desc')
        ->first();

        $compact = [
            'detail_aduan',
            'petugas'
        ];
        
        return view('tindaklanjut.detail', compact($compact));
    }
    
    public function gambar($id)
    {
        $gambar = Aduan::findOrFail($id);

        return response()->file('storage/gambar/'.$gambar->file);
    }

    public function disposisi(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);

        $aduan->status = $request->status;
        $aduan->value  = 1;
        $aduan->notif  = 3;

        $aduan->update();

        $status         = $aduan->status;
        $bidang         = $request->bidang;
        $jawaban        = NULL;
        $id_create      = Auth::user()->id;
        $note_disposisi = $request->note_disposisi;

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create, $note_disposisi);

        Alert::success('Success', 'Berhasil Mengirim Disposisi Tindak Lanjut!');

        return redirect ('/tindak_lanjut/');
    }

    public function balas(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);

        $aduan->status = $request->status_balas;
        $aduan->notif  = 3;
        $aduan->value  = 1;

        $aduan->update();

        $status         = $aduan->status;
        $bidang         = $request->bidang_balas;
        $jawaban        = NULL;
        $id_create      = Auth::user()->id;
        $note_disposisi = $request->isi_balas;

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create, $note_disposisi);

        Alert::success('Success', 'Berhasil Mengirim Balas untuk Aduan!');

        return redirect ('/tindak_lanjut/');
    }

    // public function index_laporan()
    // {
    //     $aduan_laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
    //     ->join('users', 'laporans.id_create', '=', 'users.id')
    //     ->select('users.name', 'users.email', 'users.username', 
    //     'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
    //     'laporans.id_aduan', 'laporans.laporan_status', 'laporans.id')
    //     ->where('aduans.status', '=', 'DISPOSISI')
    //     ->orderBy('laporans.created_at', 'desc')
    //     ->get();

    //     $compact = [
    //         'aduan_laporan'
    //     ];

    //     return view ('tindaklanjut.index_laporan', compact($compact));
    // }

    // public function detail_laporan($id)
    // {
    //     $detail_laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
    //     ->join('users', 'laporans.id_create', '=', 'users.id')
    //     ->select('users.name', 'users.email', 'users.username', 
    //     'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
    //     'laporans.id_aduan', 'laporans.laporan_status', 'laporans.id')
    //     ->where('laporans.id',$id)
    //     // ->where('aduans.status', '=', 'DISPOSISI')
    //     ->first();

    //     $compact = [
    //         'detail_laporan'
    //     ];

    //     return view ('tindaklanjut.detail_laporan', compact($compact));
    // }

    // public function read_laporan($id)
    // {
    //     $file = Laporan::find($id);
    //     return response()->download(public_path('uploads/Laporan/'.$file->filename));
    // }

    // public function approve_laporan(Request $request,$id)
    // {
    //     $laporan = Laporan::findOrFail($id);
    //     $laporan->laporan_status = 'APPROVED';
    //     $laporan->update();

    //     return redirect()->back();
    // }
}
