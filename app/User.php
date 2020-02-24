<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_role',
        'name',
        'username', 
        'email',
        'password',
        'active', 
        'activation_token'
    ];

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token', 'avatar'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function biouser()
    {
        return $this->hasOne(Biouser::class);
    }

    public function aduan()
    {
        return $this->hasMany(Aduan::class, 'id_user');
    }

    public function log_aduan()
    {
        return $this->hasMany(Log_aduan::class, 'id_create');
    }

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'id_user');
    }

    public function berita()
    {
        return $this->hasMany(Aduan::class, 'id_create');
    }
}
