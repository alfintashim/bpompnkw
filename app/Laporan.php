<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $fillable = [
        'id_aduan',
        'filename',
        'keterangan',
        'laporan_status',
        'id_create'
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class, 'id_aduan');
    }
}
