<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected  $table = 'videos';

    //relaciones
    // 1 a muchos
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }
    // mucho a 1
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
