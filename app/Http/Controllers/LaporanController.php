<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aduan;
use App\User;
use App\Log_aduan;
use App\Helper;
use Auth;
use Alert;
use PDF;
use DB;
use App\Pesan;
use App\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        ->select('laporans.id',
        'users.name', 'users.email', 'users.username', 
        'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
        'laporans.id_aduan', 'laporans.laporan_status', 'aduans.status', 'log_aduans.status', 'aduans.notif')
        ->where('aduans.status', '=', 'TINDAK LANJUT')
        ->where('log_aduans.status', '=', 'TINDAK LANJUT')
        ->orderBy('laporans.created_at', 'desc')
        ->get();

        $compact = [
            'laporan'
        ];

        return view ('laporan.index', compact($compact));
    }

    public function show($id)
    {
        $detail_laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        ->select('laporans.id',
        'users.name', 'users.email', 'users.username', 
        'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
        'laporans.id_aduan', 'laporans.laporan_status', 'aduans.status', 'log_aduans.status')
        ->where('laporans.id',$id)
        ->where('log_aduans.status','=','TINDAK LANJUT')
        ->first();
        
        $aduan = Aduan::findOrFail($detail_laporan->id_aduan);
        $aduan->notif = 0;
        $aduan->update();

        $detail_aduan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->join('users', 'aduans.id_user', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name',
        'biousers.alamat',
        'biousers.no_hp',
        'aduans.created_at',
        'aduans.isi')
        ->where('laporans.id',$id)
        ->where('log_aduans.status','=','TINDAK LANJUT')
        ->first();

        $compact = [
            'detail_laporan',
            'detail_aduan'
        ];

        return view ('laporan.detail', compact($compact));
    }

    public function teruskan_keterangan_laporan(Request $request, $id)
    {
        $laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->select('laporans.id', 'aduans.status', 'log_aduans.status', 'log_aduans.id_aduan')
        ->where('laporans.id',$id)
        ->where('log_aduans.status','=','TINDAK LANJUT')
        ->first();

        $laporan->status = "SELESAI";
        
        $aduan = Aduan::findOrFail($laporan->id_aduan);
        $aduan->status  = $laporan->status;
        $aduan->value   = 1;
        $aduan->notif   = 5;
        $aduan->jawaban = $request->jawaban;
        $aduan->update();

        $id_aduan   = $laporan->id_aduan;
        $status     = $laporan->status;
        $bidang     = Laporan::join('log_aduans', 'laporans.id_aduan','=','log_aduans.id_aduan')
        ->where('laporans.id',$id)
        ->where('log_aduans.status','=','TINDAK LANJUT')
        ->pluck('log_aduans.bidang')
        ->first();
        $jawaban    = $request->jawaban;
        $id_create  = Auth::user()->id;
        $note_disposisi = Laporan::join('log_aduans', 'laporans.id_aduan','=','log_aduans.id_aduan')
        ->where('laporans.id',$id)
        ->where('log_aduans.status','=','TINDAK LANJUT')
        ->pluck('log_aduans.note_disposisi')
        ->first();

        Helper::createLog($id_aduan, $status, $bidang, $jawaban, $id_create, $note_disposisi);

        $pesan = new Pesan;
        $pesan->id_aduan = $aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = $jawaban;
        $pesan->save();

        Alert::success('Success', 'Jawaban Berhasil Dikirim Kepada Konsumen!');
        
        return redirect ('/aduan/');
    }
    
    public function read_laporan($id)
    {
        $file = Laporan::findOrFail($id);
        return response()->download(public_path('uploads/Laporan/'.$file->filename));
    }
    
    
    
    
    
    public function indexs()
    {
        $laporan = Laporan::join('log_aduans', 'laporans.id_aduan', '=', 'log_aduans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        // ->join('aduans', 'laporans.id_aduan', '=', 'aduans.id')
        ->select('laporans.id',
        'users.name', 'users.email', 'users.username', 
        'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
        'laporans.id_aduan', 'log_aduans.id_aduan', 'log_aduans.status', 'log_aduans.bidang')
        ->whereNotNull('log_aduans.bidang')
        // ->whereIn('log_aduans.status', ['TINDAK LANJUT','SELESAI'])
        ->where('log_aduans.status', 'SELESAI')
        // ->whereIn('aduans.status', ['TINDAK LANJUT','SELESAI'])
        // ->groupBy('log_aduans.id_aduan')
        // ->having('log_aduans.status', ['SELESAI','TINDAK LANJUT'])
        ->orderBy('laporans.created_at', 'desc')
        ->get();

        $compact = [
            'laporan'
        ];

        return view ('tindaklanjut.index_laporan', compact($compact));
    }
    
    public function shows($id)
    {
        // $detail_laporan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        // ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        // ->join('users', 'laporans.id_create', '=', 'users.id')
        // ->select('laporans.id',
        // 'users.name', 'users.email', 'users.username', 
        // 'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
        // 'laporans.id_aduan', 'laporans.laporan_status', 'aduans.status', 'log_aduans.status')
        // ->where('laporans.id',$id)
        // // ->where('log_aduans.status','=','TINDAK LANJUT')
        // ->first();
        
        $detail_laporan = Laporan::join('log_aduans', 'laporans.id_aduan', '=', 'log_aduans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        ->select('laporans.id',
        'users.name', 'users.email', 'users.username', 
        'laporans.filename', 'laporans.keterangan', 'laporans.id_create', 'laporans.created_at',
        'laporans.id_aduan', 'log_aduans.status', 'log_aduans.bidang')
        // ->whereNotNull('log_aduans.bidang')
        ->where('laporans.id',$id)
        ->first();

        $detail_aduan = Laporan::join('aduans','laporans.id_aduan','=','aduans.id')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->join('users', 'aduans.id_user', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name',
        'biousers.alamat',
        'biousers.no_hp',
        'aduans.created_at',
        'aduans.isi')
        ->where('laporans.id',$id)
        // ->where('log_aduans.status','=','TINDAK LANJUT')
        ->first();

        $compact = [
            'detail_laporan',
            'detail_aduan'
        ];

        return view ('tindaklanjut.detail_laporan', compact($compact));
    }
}
