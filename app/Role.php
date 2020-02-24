<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'rolename',
        'ket'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
