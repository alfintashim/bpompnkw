<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\User;
use Auth;
use Alert;
use Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::join('users', 'beritas.id_create', '=', 'users.id')
        ->select('users.name', 'beritas.*')
        ->orderBy('beritas.id', 'desc')
        ->get();

        $compact = [
            'berita'
        ];
        
        return view('berita.index', compact($compact))
        ->with('noberita',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('berita.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $berita = New Berita;

        $berita->judul = $request->judul;
        $berita->isi = $request->editor1;
        if($request->file('gambar') == "")
        {
            $berita->gambar = "no-image.jpg";
        }
        else
        {
            $file = $request->file('gambar');
            $nama = 'news-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            $path = base_path() . '/public/uploads/Berita';
            // Storage::putFileAs('public/uploads/Berita', $request->file('file'), $namabaru);
            $file->move($path,$namabaru);
            
            

            $berita->gambar = $namabaru;
        }
        $berita->id_create = Auth::user()->id;
        $berita->status = $request->status;

        $berita->save();

        Alert::success('Success', 'Berita Berhasil Dibuat!');

        return redirect ('/berita');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::join('users','id_create','=','users.id')
        ->select('users.name','beritas.*')
        ->where('beritas.id',$id)
        ->first();

        $compact = [
            'berita'
        ];
        
        return view ('berita.detail', compact($compact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::join('users','id_create','=','users.id')
        ->select('users.name','beritas.*')
        ->where('beritas.id',$id)
        ->first();

        $compact = [
            'berita'
        ];
        
        return view ('berita.edit', compact($compact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $berita->judul = $request->judul;
        $berita->isi = $request->editor1;
        if($request->file('gambar') == "")
        {
            $berita->gambar = $berita->gambar;
        }
        else
        {
            $file = $request->file('gambar');
            $nama = 'news-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            $path = base_path() . '/public/uploads/Berita';
            // Storage::putFileAs('public/uploads/Berita', $request->file('file'), $namabaru);
            $file->move($path,$namabaru);
            

            $berita->gambar = $namabaru;
        }
        $berita->id_create = Auth::user()->id;
        $berita->status = $request->status;

        $berita->update();

        Alert::success('Success', 'Berita Berhasil Diubah!');

        return redirect ('/berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ganti_status(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $berita->status = $request->status;

        $berita->update();

        Alert::success('Success', 'Status Berita Berhasil Diubah!');

        return redirect ('/berita/'.$id);
    }

    public function nonaktif(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $berita->status = 'NON-ACTIVE';

        $berita->update();

        Alert::success('Success', 'Berita Berhasil Dinonaktifkan!');

        return redirect ('/berita/'.$id);
    }
}
