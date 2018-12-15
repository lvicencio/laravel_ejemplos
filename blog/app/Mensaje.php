<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'messages';

    protected $fillable = ['nombre','email', 'mensaje'];



    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
