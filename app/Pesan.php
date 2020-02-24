<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesans';

    protected $fillable = [
        'id_aduan',
        'id_user',
        'pesan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function aduan()
    {
        return $this->belongsTo(Aduan::class, 'id_aduan');
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
