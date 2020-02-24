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
use Response;
use Carbon;

class DisposisiController extends Controller
{
    protected $rules = [
        'filename'        =>  ['max:100000', 'mimes:doc,docx,pdf,xls,xlsx', 'required']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aduan_disposisi = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 
        'aduans.id_user',
        'aduans.jenis_produk',
        'aduans.nama_produk',
        'aduans.no_reg',
        'aduans.tgl_exp',
        'aduans.nama_pabrik',
        'aduans.alamat_pabrik',
        'aduans.no_batch',
        'aduans.lat',
        'aduans.lng',
        'aduans.alamat_beli',
        'aduans.tgl_guna',
        'aduans.info_lain',
        'aduans.isi',
        'aduans.file',
        'aduans.created_at',
        'aduans.notif',
        'log_aduans.id',
        'log_aduans.id_aduan',
        'log_aduans.status',
        'aduans.status',
        'log_aduans.bidang',
        'log_aduans.note_disposisi',
        'log_aduans.jawaban',
        'log_aduans.id_create')
        ->where('aduans.status', '=', 'DISPOSISI')
        ->where('log_aduans.status', '=', 'DISPOSISI')
        ->where('log_aduans.bidang', '=', 'Bidang Informasi dan Komunikasi')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $compact = [
            'aduan_disposisi'
        ];
        
        return view('disposisi.index', compact($compact))
        ->with('nodisposisi',1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users', 'aduans.id_user', '=', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 
        'biousers.jk', 
        'biousers.alamat',
        'biousers.profesi',
        'biousers.instansi',
        'biousers.no_hp',
        'biousers.no_ktp',
        'biousers.ktp',
        'biousers.foto',
        'aduans.*',
        'log_aduans.id_aduan')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();
        
        $aduan = Aduan::findOrFail($detail_aduan->id_aduan);
        $aduan->notif = 0;
        $aduan->update();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $disposisi = Log_aduan::where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $laporan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('laporans','aduans.id','=','laporans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        ->select('laporans.*','log_aduans.bidang', 'users.name')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $compact = [
            'detail_aduan',
            'petugas',
            'disposisi',
            'laporan'
        ];
        
        return view('disposisi.detail', compact($compact));
    }
    
    public function gambar($id)
    {
        $gambar = Aduan::findOrFail($id);

        return response()->file('storage/gambar/'.$gambar->file);
    }

    public function printpreview($id)
    {
        $disposisi = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users','aduans.id_user','=','users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 
        'biousers.alamat','biousers.no_hp',
        'aduans.isi',
        'aduans.created_at',
        'log_aduans.id',
        'log_aduans.id_aduan',
        'log_aduans.bidang',
        'log_aduans.note_disposisi',
        'log_aduans.jawaban',
        'log_aduans.id_create',
        'log_aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $disposisi_aduan_created_at = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $kepala = User::select('name')
        ->where('id_role','=','2')
        ->first();

        $compact = [
            'disposisi',
            'disposisi_aduan_created_at',
            'petugas',
            'kepala'
        ];

        return view ('disposisi.disposisi_printpreview', compact($compact));
    }

    public function print($id)
    {
        $disposisi = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users','aduans.id_user','=','users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 
        'biousers.alamat','biousers.no_hp',
        'aduans.id',
        'aduans.isi',
        'aduans.created_at',
        'log_aduans.id_aduan',
        'log_aduans.bidang',
        'log_aduans.note_disposisi',
        'log_aduans.jawaban',
        'log_aduans.id_create',
        'log_aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $disposisi_aduan_created_at = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $kepala = User::select('name')
        ->where('id_role','=','2')
        ->first();

        $compact = [
            'disposisi',
            'disposisi_aduan_created_at',
            'petugas',
            'kepala'
        ];

        return view ('disposisi.disposisi_print', compact($compact));
    }
    
    public function download($id)
    {
        $disposisi = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users','aduans.id_user','=','users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 
        'biousers.alamat','biousers.no_hp',
        'aduans.id',
        'aduans.isi',
        'aduans.created_at',
        'log_aduans.id_aduan',
        'log_aduans.bidang',
        'log_aduans.note_disposisi',
        'log_aduans.jawaban',
        'log_aduans.id_create',
        'log_aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $disposisi_aduan_created_at = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.created_at')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $kepala = User::select('name')
        ->where('id_role','=','2')
        ->first();

        $compact = [
            'disposisi',
            'disposisi_aduan_created_at',
            'petugas',
            'kepala'
        ];

        $pdf = PDF::loadView('disposisi.disposisi_download', compact($compact))
        ->setPaper('a4','portrait');

        $fileName = ('Nomor Aduan '. $disposisi->id_aduan .' (Konsumen : '. $disposisi->name .')');
        
        return $pdf->stream($fileName .'.pdf');
    }

    public function teruskan_note_disposisi(Request $request, $id)
    {
        $log_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.status','log_aduans.id_aduan')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $log_aduan->status = $request->status;

        $aduan = Aduan::find($log_aduan->id_aduan);
        $aduan->status = $log_aduan->status;
        $aduan->jawaban = $request->jawaban;
        $aduan->value   = 1;
        $aduan->notif  = 5;
        $aduan->update();

        $id_aduan   = $log_aduan->id_aduan;
        $status     = $aduan->status;
        $bidang     = Log_aduan::where('id',$id)
        ->where('status','=','DISPOSISI')
        ->pluck('bidang')
        ->first();
        $jawaban    = $request->jawaban;
        $id_create  = Auth::user()->id;
        $note_disposisi = Log_aduan::where('id',$id)
        ->where('status','=','DISPOSISI')
        ->pluck('note_disposisi')
        ->first();

        Helper::createLog($id_aduan, $status, $bidang, $jawaban, $id_create, $note_disposisi);

        $pesan = new Pesan;

        $pesan->id_aduan = $aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = $jawaban;

        $pesan->save();

        Alert::success('Success', 'Jawaban Berhasil Dikirim Kepada Konsumen!');
        
        return redirect('/aduan/');
    }

    public function teruskan_keterangan_laporan(Request $request, $id)
    {
        $log_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.status','log_aduans.id_aduan')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $log_aduan->status = $request->status;

        $aduan = Aduan::find($log_aduan->id_aduan);
        $aduan->status = $log_aduan->status;
        $aduan->jawaban = $request->jawaban;
        $aduan->value   = 1;
        $aduan->notif  = 5;
        $aduan->update();

        $id_aduan   = $log_aduan->id_aduan;
        $status     = $aduan->status;
        $bidang     = Log_aduan::where('id',$id)
        ->where('status','=','DISPOSISI')
        ->pluck('bidang')
        ->first();
        $jawaban    = $request->jawaban;
        $id_create  = Auth::user()->id;
        $note_disposisi = Log_aduan::where('id',$id)
        ->where('status','=','DISPOSISI')
        ->pluck('note_disposisi')
        ->first();

        Helper::createLog($id_aduan, $status, $bidang, $jawaban, $id_create, $note_disposisi);

        $pesan = new Pesan;

        $pesan->id_aduan = $aduan->id;
        $pesan->id_user  = Auth::user()->id;
        $pesan->pesan    = $jawaban;

        $pesan->save();

        Alert::success('Success', 'Jawaban Berhasil Dikirim Kepada Konsumen!');
        
        return redirect ('/aduan/'.$aduan->id);
    }

    public function ganti_status(Request $request, $id)
    {
        $log_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->select('aduans.status','log_aduans.id_aduan')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $log_aduan->status = $request->status;

        $aduan = Aduan::find($log_aduan->id_aduan);
        $aduan->status = $log_aduan->status;
        $aduan->update();

        $id_aduan   = $log_aduan->id_aduan;
        $status     = $aduan->status;
        $bidang     = Log_aduan::where('id',$id)
        ->where('status','=','DISPOSISI')
        ->pluck('bidang')
        ->first();
        $jawaban    = NULL;
        $id_create  = Auth::user()->id;

        Helper::createLog($id_aduan, $status, $bidang, $jawaban, $id_create);

        Alert::success('Success', 'Berhasil Mengganti Status Aduan!');

        return redirect ('/aduan/'.$aduan->id);
    }

    // public function index_laporan($id)
    // {
    //     $detail_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
    //     ->join('users', 'aduans.id_user', '=', 'users.id')
    //     ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
    //     ->select('users.name', 'users.email', 'users.username', 
    //     'biousers.jk', 
    //     'biousers.alamat',
    //     'biousers.profesi',
    //     'biousers.instansi',
    //     'biousers.no_hp',
    //     'biousers.no_ktp',
    //     'biousers.ktp',
    //     'biousers.foto',
    //     'aduans.*')
    //     ->where('log_aduans.id',$id)
    //     ->where('log_aduans.status','=','DISPOSISI')
    //     ->first();

    //     $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
    //     ->select('users.name')
    //     ->where('log_aduans.id',$id)
    //     ->where('log_aduans.status','=','DISPOSISI')
    //     ->first();

    //     $disposisi = Log_aduan::where('log_aduans.id',$id)
    //     ->where('log_aduans.status','=','DISPOSISI')
    //     ->first();

    //     $laporan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
    //     ->join('laporans','aduans.id','=','laporans.id_aduan')
    //     ->join('users', 'laporans.id_create', '=', 'users.id')
    //     ->select('laporans.*','log_aduans.bidang', 'users.name')
    //     ->where('log_aduans.id',$id)
    //     ->where('log_aduans.status','=','DISPOSISI')
    //     ->first();

    //     $compact = [
    //         'detail_aduan',
    //         'petugas',
    //         'disposisi',
    //         'laporan'
    //     ];
        
    //     return view ('disposisi.upload_laporan', compact($compact))
    //     ->with('nouploadlaporan',1);
    // }

    // public function upload_laporan(Request $request, $id)
    // {
    //     $log_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
    //     // ->join('laporans','aduans.id','=','laporans.id_aduan')
    //     // ->join('users', 'laporans.id_create', '=', 'users.id')
    //     ->select('log_aduans.id_aduan')
    //     ->where('log_aduans.id',$id)
    //     ->where('log_aduans.status','=','DISPOSISI')
    //     ->first();
        
    //     $this -> validate($request, $this->rules);

    //     $laporan = New Laporan;

    //     $laporan->id_aduan = $log_aduan->id_aduan;

    //     $file = $request->file('filename');
    //     $destinationPath = base_path() . '/public/uploads/Laporan';
    //     $filename = $request->filename->getClientOriginalName();
    //     $file->move($destinationPath, $filename);

    //     $laporan->filename = $filename;
    //     $laporan->keterangan = $request->keterangan;
    //     $laporan->laporan_status = 'PENDING';
    //     $laporan->id_create  = Auth::user()->id;

    //     $laporan->save();
    //     Alert::success('Success', 'Berhasil Upload Laporan!');
    //     return redirect()->back();
    // }
    
    
    
    
    
    
    public function indexs()
    {
        $aduan_disposisi = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users', 'aduans.id_user', '=', 'users.id')
        ->select('users.name', 'users.email', 'users.username', 
        'aduans.id_user',
        'aduans.jenis_produk',
        'aduans.nama_produk',
        'aduans.no_reg',
        'aduans.tgl_exp',
        'aduans.nama_pabrik',
        'aduans.alamat_pabrik',
        'aduans.no_batch',
        'aduans.lat',
        'aduans.lng',
        'aduans.alamat_beli',
        'aduans.tgl_guna',
        'aduans.info_lain',
        'aduans.isi',
        'aduans.file',
        'aduans.created_at',
        'log_aduans.id',
        'log_aduans.id_aduan',
        'log_aduans.status',
        'aduans.status',
        'log_aduans.bidang',
        'log_aduans.note_disposisi',
        'log_aduans.jawaban',
        'log_aduans.id_create')
        ->where('aduans.status', '=', 'DISPOSISI')
        ->where('log_aduans.status', '=', 'DISPOSISI')
        ->orderBy('aduans.updated_at', 'desc')
        ->get();

        $compact = [
            'aduan_disposisi'
        ];
        
        return view('disposisis.index', compact($compact))
        ->with('nodisposisi',1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shows($id)
    {
        $detail_aduan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('users', 'aduans.id_user', '=', 'users.id')
        ->join('biousers', 'aduans.id_user', '=', 'biousers.id_user')
        ->select('users.name', 'users.email', 'users.username', 
        'biousers.jk', 
        'biousers.alamat',
        'biousers.profesi',
        'biousers.instansi',
        'biousers.no_hp',
        'biousers.no_ktp',
        'biousers.ktp',
        'biousers.foto',
        'aduans.*')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $petugas = Log_aduan::join('users', 'log_aduans.id_create', '=', 'users.id')
        ->select('users.name')
        ->where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $disposisi = Log_aduan::where('log_aduans.id',$id)
        ->where('status','=','DISPOSISI')
        ->first();

        $laporan = Log_aduan::join('aduans','log_aduans.id_aduan','=','aduans.id')
        ->join('laporans','aduans.id','=','laporans.id_aduan')
        ->join('users', 'laporans.id_create', '=', 'users.id')
        ->select('laporans.*','log_aduans.bidang', 'users.name')
        ->where('log_aduans.id',$id)
        ->where('log_aduans.status','=','DISPOSISI')
        ->first();

        $compact = [
            'detail_aduan',
            'petugas',
            'disposisi',
            'laporan'
        ];
        
        return view('disposisis.detail', compact($compact));
    }
}
