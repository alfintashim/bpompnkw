<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biouser extends Model
{
    protected $table = 'biousers';

    protected $fillable = [
        'id_user',
        'jk',
        'alamat',
        'profesi',
        'instansi',
        'no_hp',
        'no_ktp',
        'ktp',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
