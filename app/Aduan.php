<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aduan extends Model
{
    protected $table = 'aduans';

    protected $fillable = [
        'status',
        'id_user',
        'jenis_produk',
        'nama_produk',
        'no_reg',
        'tgl_exp',
        'nama_pabrik',
        'alamat_pabrik',
        'no_batch',
        'lat',
        'lng',
        'alamat_beli',
        'tgl_guna',
        'info_lain',
        'isi',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function log_aduan()
    {
        return $this->hasMany(Log_aduan::class, 'id_aduan')->orderBy('created_at','desc');
    }

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'id_aduan');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_aduan');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d M Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }
}