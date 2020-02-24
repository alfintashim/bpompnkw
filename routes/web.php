<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/test',function(){
   return public_path(); 
});

// , 'middleware' => ['auth.basic', 'auth.admin','auth.infokom','auth.pimpinan']

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'HomeController@index')->name('home');

/* USER */
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/add', 'UserController@create');
        Route::post('/add', 'UserController@store');
        Route::get('/{id}', 'UserController@show');
        Route::get('/{id}/edit', 'UserController@edit');
        Route::put('/{id}/edit', 'UserController@update');
        Route::delete('/{id}/delete', 'UserController@destroy');

        Route::put('/{id}/nonaktif', 'UserController@nonaktif');
    });


/* STAFF INFOKOM */
// ADUAN
    Route::group(['prefix' => 'aduan'], function () {
        Route::get('/', 'AduanController@index');
        Route::put('/{id}', 'AduanController@show');

    // ADUAN GAMBAR
        Route::get('/{id}/gambar', 'AduanController@gambar');

        Route::post('/{id}/kirim_pesan', 'AduanController@kirim_pesan');
        Route::delete('/hapus_pesan/{id}', 'AduanController@hapus_pesan');
        Route::put('/{id}/proses_aduan', 'AduanController@proses_aduan');
        Route::put('/{id}/ganti_status', 'AduanController@ganti_status');
        Route::put('/{id}/status_ditolak', 'AduanController@status_ditolak');

        // Route::get('/{id}/getdata/{id}', 'AduanController@getdata');
        Route::post('/{id}/delete', 'AduanController@destroy');
    });

// TRENDING ADUAN
    Route::group(['prefix' => 'trending'], function () {
        Route::get('/', 'TrendingController@index');
        Route::post('/', 'TrendingController@store');
    });

// DISPOSISI DARI HEAD
    Route::group(['prefix' => 'disposisi_infokom'], function () {
        Route::get('/', 'DisposisiController@index');
        Route::put('/{id}', 'DisposisiController@show');

    // CETAK DISPOSISI
        Route::get('/{id}/printpreview', 'DisposisiController@printpreview');
        Route::get('/{id}/print', 'DisposisiController@print');
        Route::get('/{id}/download', 'DisposisiController@download');

    // TERUSKAN PERINTAH
        Route::put('/{id}/teruskan_note_disposisi', 'DisposisiController@teruskan_note_disposisi');

        Route::put('/{id}/teruskan_keterangan', 'DisposisiController@teruskan_keterangan_laporan');

        Route::put('/{id}/ganti_status', 'DisposisiController@ganti_status');

        // Route::get('/{id}/laporan', 'DisposisiController@index_laporan');
        // Route::put('/{id}/upload_laporan', 'DisposisiController@upload_laporan');
    });
    
    // SEMUA DISPOSISI
    Route::group(['prefix' => 'disposisi'], function () {
        Route::get('/', 'DisposisiController@indexs');
        Route::get('/{id}', 'DisposisiController@shows');
        Route::put('/{id}/upload_laporan', 'DisposisiController@upload_laporan');
    });

// STATUS LAPORAN DARI HEAD
    // Route::group(['prefix' => 'laporan'], function () {
    //     Route::get('/', 'LaporanController@index');
    //     Route::get('/{id}', 'LaporanController@show');

    //     Route::put('/{id}/teruskan_keterangan', 'LaporanController@teruskan_keterangan_laporan');
    // });

// HASIL LAPORAN
    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', 'LaporanController@index');
        Route::put('/{id}', 'LaporanController@show');

        Route::put('/{id}/teruskan_keterangan', 'LaporanController@teruskan_keterangan_laporan');

        Route::get('/{id}/read', 'LaporanController@read_laporan');
    });

// BERITA
    Route::group(['prefix' => 'berita'], function () {
        Route::get('/', 'BeritaController@index');
        Route::get('/add', 'BeritaController@create');
        Route::post('/add', 'BeritaController@store');
        Route::get('/{id}', 'BeritaController@show');

        Route::get('/{id}/edit', 'BeritaController@edit');
        Route::put('/{id}/edit', 'BeritaController@update');

        Route::put('/{id}/ganti_status', 'BeritaController@ganti_status');
        Route::put('/{id}/nonaktif', 'BeritaController@nonaktif');
    });


/* HEAD */
// ADUAN
    Route::group(['prefix' => 'aduans'], function () {
        Route::get('/', 'AduanController@indexs');
        Route::get('/{id}', 'AduanController@shows');

    // ADUAN GAMBAR
        Route::get('/{id}/gambar', 'AduanController@gambars');
    });

// TINDAK LANJUT
    Route::group(['prefix' => 'tindak_lanjut'], function () {
        Route::get('/', 'TindakLanjutController@index');
        Route::put('/{id}', 'TindakLanjutController@show');

    // TINDAK LANJUT/DISPOSISI PROSES ADUAN
        Route::put('/{id}/disposisi', 'TindakLanjutController@disposisi');
        Route::put('{id}/balas', 'TindakLanjutController@balas');
    });

// LAPORAN BIDANG 
    // Route::group(['prefix' => 'laporan_bidang'], function () {
    //     Route::get('/', 'TindakLanjutController@index_laporan');
    //     Route::get('/{id}', 'TindakLanjutController@detail_laporan');
    //     Route::get('/{id}/read', 'TindakLanjutController@read_laporan');

    //     Route::put('/{id}/approve', 'TindakLanjutController@approve_laporan');
    // });
    
// LAPORAN BIDANG 
    Route::group(['prefix' => 'laporans'], function () {
        Route::get('/', 'LaporanController@indexs');
        Route::get('/{id}', 'LaporanController@shows');

        Route::get('/{id}/read', 'LaporanController@read_laporan');
    });

/* BIDANG PENGUJIAN */
    Route::group(['prefix' => 'disposisi_pengujian'], function () {
        Route::get('/', 'PengujianController@index');
        Route::put('/{id}', 'PengujianController@show');
        Route::put('/{id}/upload_laporan', 'PengujianController@upload_laporan');
    });

/* BIDANG PEMERIKSAAN */
    Route::group(['prefix' => 'disposisi_pemeriksaan'], function () {
        Route::get('/', 'PemeriksaanController@index');
        Route::put('/{id}', 'PemeriksaanController@show');
        Route::put('/{id}/upload_laporan', 'PemeriksaanController@upload_laporan');
    });

/* BIDANG PENINDAKAN */
    Route::group(['prefix' => 'disposisi_penindakan'], function () {
        Route::get('/', 'PenindakanController@index');
        Route::put('/{id}', 'PenindakanController@show');
        Route::put('/{id}/upload_laporan', 'PenindakanController@upload_laporan');
    });

/* BAGIAN TATA USAHA */
    Route::group(['prefix' => 'disposisi_tatausaha'], function () {
        Route::get('/', 'TataUsahaController@index');
        Route::put('/{id}', 'TataUsahaController@show');
        Route::put('/{id}/upload_laporan', 'TataUsahaController@upload_laporan');
    });

});