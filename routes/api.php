<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'API\UserController@login');
    Route::post('signup', 'API\UserController@signup');
    Route::get('signup/activate/{token}', 'API\UserController@signupActivate');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\UserController@logout');
        Route::get('user', 'API\UserController@user');

        Route::get('list_berita', 'API\BeritaController@list');
        Route::get('list_aduan', 'API\AduanController@listAduan');
        Route::get('notif', 'API\AduanController@notif');
        Route::get('update_notif/{id}', 'API\AduanController@updateNotif');
        Route::get('user_dahsboard', 'API\AduanController@userDashboard');
        Route::get('list_chat/{id_aduan}', 'API\PesanController@listChat');
        Route::get('list_dash_berita', 'API\BeritaController@listDashboard');
        Route::get('cari_aduan/{search}','API\AduanController@cariAduan');
        Route::get('cari_berita/{search}','API\BeritaController@cariBerita');
        Route::post('aduan_masuk', 'API\AduanController@AduanMasuk');
        Route::post('biodata/{id}', 'API\BiodataController@Profil');
        Route::get('detail_biodata','API\BiodataController@detailBiodata');
        Route::get('aktivasi_biodata','API\BiodataController@aktivasiBiodata');
        Route::post('pesan/{id_aduan}', 'API\PesanController@Pesan');
        Route::post('ganti_password', 'API\UserController@gantiPassword');
    });
});

Route::post('email_register', 'API\UserController@emailRegister');
Route::post('username_register', 'API\UserController@usernameRegister');
