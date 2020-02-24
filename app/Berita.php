<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'isi',
        'id_create',
        'gambar',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_create');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('l, d M Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }
}
