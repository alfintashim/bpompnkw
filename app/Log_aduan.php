<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_aduan extends Model
{
    protected $table = 'log_aduans';

    protected $fillable = [
        'id_aduan',
        'status',
        'bidang',
        'note_disposisi',
        'jawaban',
        'id_create'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_create');
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
