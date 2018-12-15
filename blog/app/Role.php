<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable = [
        'name', 'display', 'description',
    ];

//relacion 1 rol tiene muchos usuarios
    public function user()
    {
    	return $this->hasMany(User::class);
    }
}
