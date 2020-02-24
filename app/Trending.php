<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    protected $table = 'trendings';

    protected $fillable = [
        'jenis_produk',
        'nama_produk',
        'start_at',
        'end_date'
    ];
}