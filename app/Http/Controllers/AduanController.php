<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aduan;
use App\User;
use App\Log_aduan;
use App\Helper;
use Auth;
use App\Pesan;
use Alert;
use Illuminate\Support\Facades\Storage;
use App\Trending;
use Carbon;
use Response;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // public function __construct ()
    // {
    // $this->middleware(['auth.admin','auth.infokom']);
    // }

    public function __construct ()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
        $trending = Trending::select('nama_produk', 'jenis_produk')
        ->orderBy('id', 'desc')
        ->first();

        $tabel_trending = Aduan::join('trendings', 'aduans.jenis_produk','=','trendings.jenis_produk')
        ->join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->orderBy('aduans.id', 'desc')
        ->whereDate('aduans.created_at', '>', Carbon\Carbon::now()->subDays(7))
        ->get();

        $jml_diterima = Aduan::count();
        $jml_diproses = Aduan::where('status','=','DIPROSES')->count();
        $jml_disposisi = Aduan::where('status','=','DISPOSISI')->count();
        $jml_tindaklanjut = Aduan::where('status','TINDAK LANJUT')->count();
        $jml_selesai = Aduan::where('status','=','SELESAI')->count();
        $jml_ditolak = Aduan::where('status','=','DITOLAK')->count();

        $aduan_diterima = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->orderBy('aduans.id', 'desc')->get();

        $aduan_diproses = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DIPROSES')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $aduan_disposisi = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DISPOSISI')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();
        
        $aduan_tindaklanjut = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'TINDAK LANJUT')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $aduan_selesai = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'SELESAI')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();
        
        $aduan_ditolak = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DITOLAK')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $compact = [
            'jml_diterima',
            'jml_diproses',
            'jml_disposisi',
            'jml_tindaklanjut',
            'jml_selesai',
            'jml_ditolak',
            'aduan_diterima',
            'aduan_diproses',
            'aduan_disposisi',
            'aduan_tindaklanjut',
            'aduan_selesai',
            'aduan_ditolak',
            'trending',
            'tabel_trending'
        ];

        return view('aduan.index', compact($compact))
        ->with('noditerima',1)
        ->with('nodiproses',1)
        ->with('nodisposisi',1)
        ->with('notindaklanjut',1)
        ->with('noselesai',1)
        ->with('noditolak',1)
        ->with('notrending',1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $detail_aduan = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 'biousers.*', 'aduans.*')
        ->where('aduans.id',$id)
        ->first();
        
        $detail_aduan->status = 'DITERIMA';
        $detail_aduan->notif = 0;
        $detail_aduan->update();

        $status     = $detail_aduan->status;
        $bidang     = NULL;
        $jawaban    = NULL;
        $id_create  = Auth::user()->id;

        Helper::createLog($detail_aduan->id, $status, $bidang, $jawaban, $id_create);

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

        $log_aduan = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('log_aduans.*', 'users.name')
        ->where('id_aduan',$id)
        ->orderBy('log_aduans.id','desc')->get();

        $baca_pesan = Pesan::join('users', 'pesans.id_user','=','users.id')
        ->select('pesans.*', 'users.name', 'users.id_role')
        ->where('id_aduan',$id)
        ->orderBy('pesans.id', 'desc')
        ->get();

        $compact = [
            'detail_aduan',
            'petugas',
            'log_aduan',
            'baca_pesan'
        ];
        
        return view('aduan.detail', compact($compact));
    }

    public function gambar($id)
    {
        $gambar = Aduan::findOrFail($id);

        return response()->file('storage/gambar/'.$gambar->file);
    }

    public function kirim_pesan(Request $request, $id)
    {
        $detail_aduan = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.id',$id)
        ->first();
        
        $pesan = new Pesan;

        $pesan->id_aduan = $detail_aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = $request->isipesan;

        $pesan->save();

        Alert::success('Success', 'Pesan berhasil dikirim!');

        return redirect ('/aduan/'.$id);
    }

    public function hapus_pesan($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        Alert::success('Success', 'Pesan Berhasil Dihapus');

        return redirect('/aduan');
    }

    // public function destroy(Request $request,$id)
    // {
        
    //     Pesan::destroy($request->id);

    //     Alert::success('Success', 'Data Berhasil Dihapus');
    //     return redirect()->back();
    // }

    // public function getdata($id)
    // {
    //     $pesan = Pesan::find($id);
    //     return response()->json($pesan);
    // }

    public function proses_aduan(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->status = 'DIPROSES';
        $aduan->value  = 1;
        $aduan->notif  = 2;
        $aduan->update();

        $pesan = new Pesan;

        $pesan->id_aduan = $aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = 'Terima kasih telah mengirimkan laporan pengaduan kepada Balai Besar Pengawasan Obat dan Makanan Kota Pontianak. Laporan anda akan diproses.';

        $pesan->save();

        $status     = 'DIPROSES';
        $bidang     = NULL;
        $jawaban    = NULL;
        $id_create  = Auth::user()->id;

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create);

        Alert::info('Info', 'Aduan Akan Diproses!');

        return redirect ('/aduan/');
    }

    public function ganti_status(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);

        $aduan->status = $request->status;

        $aduan->update();

        $status     = $aduan->status;
        $bidang     = NULL;
        $jawaban    = NULL;
        $id_create  = Auth::user()->id;

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create);

        Alert::success('Success', 'Berhasil Mengganti Status Aduan!');

        return redirect ('/aduan/'.$id);
    }

    public function status_ditolak(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->status = 'DITOLAK';
        $aduan->value  = 1;
        $aduan->notif  = 6;
        $aduan->update();

        $pesan = new Pesan;
        $pesan->id_aduan = $aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = $request->pesan;
        $pesan->save();

        $status     = 'DITOLAK';
        $bidang     = NULL;
        $jawaban    = NULL;
        $id_create  = Auth::user()->id;

        Helper::createLog($aduan->id, $status, $bidang, $jawaban, $id_create);

        Alert::info('Info', 'Aduan Telah Ditolak!');

        return redirect ('/aduan/');
    }
    
    

// KEPALA
    public function indexs()
    {
        $jml_diterima = Aduan::count();
        $jml_diproses = Aduan::where('status','=','DIPROSES')->count();
        $jml_disposisi = Aduan::where('status','=','DISPOSISI')->count();
        $jml_tindaklanjut = Aduan::where('status','TINDAK LANJUT')->count();
        $jml_selesai = Aduan::where('status','=','SELESAI')->count();
        $jml_ditolak = Aduan::where('status','=','DITOLAK')->count();

        $aduan_diterima = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->orderBy('aduans.id', 'desc')->get();

        $aduan_diproses = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DIPROSES')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $aduan_disposisi = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DISPOSISI')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();
        
        $aduan_tindaklanjut = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'TINDAK LANJUT')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $aduan_selesai = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'SELESAI')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();
        
        $aduan_ditolak = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 'aduans.*')
        ->where('aduans.status', '=', 'DITOLAK')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $compact = [
            'jml_diterima',
            'jml_diproses',
            'jml_disposisi',
            'jml_tindaklanjut',
            'jml_selesai',
            'jml_ditolak',
            'aduan_diterima',
            'aduan_diproses',
            'aduan_disposisi',
            'aduan_tindaklanjut',
            'aduan_selesai',
            'aduan_ditolak'
        ];

        return view('aduans.index', compact($compact))
        ->with('noditerima',1)
        ->with('nodiproses',1)
        ->with('nodisposisi',1)
        ->with('notindaklanjut',1)
        ->with('noselesai',1)
        ->with('noditolak',1);
    }

    public function shows($id)
    {
        $detail_aduan = Aduan::join('users', 'aduans.id_user', '=', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 'biousers.*', 'aduans.*')
        ->where('aduans.id',$id)
        ->first();

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

        $log_aduan = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('log_aduans.*', 'users.name')
        ->where('id_aduan',$id)
        ->orderBy('log_aduans.id','desc')->get();

        $baca_pesan = Pesan::join('users', 'pesans.id_user','=','users.id')
        ->select('pesans.*', 'users.name', 'users.id_role')
        ->where('id_aduan',$id)
        ->orderBy('pesans.id', 'desc')
        ->get();

        $compact = [
            'detail_aduan',
            'petugas',
            'log_aduan',
            'baca_pesan'
        ];
        
        return view('aduans.detail', compact($compact));
    }

    public function gambars($id)
    {
        $gambar = Aduan::findOrFail($id);

        return response()->file('storage/gambar/'.$gambar->file);
    }
}
