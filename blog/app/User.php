<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//funcion para encriptar la contraseña
public function setPasswordAttribute($password)
{
    $this->attributes['password'] = bcrypt($password);
}


//un usuario podra tener varios roles

public function roles()
{
    return $this->belongsToMany(Role::class,'assigned_roles');
}

//fin relacion


public function messages()
{
    return $this->hasMany(Mensaje::class);
}


//llega un array de roles
    public function hasRoles(array $roles)
    {

        return $this->roles->pluck('name')->intersect($roles)->count();

        // foreach ($roles as $role) 
        // {
        //     foreach ($this->roles as $userRole) 
        //     {
        //         if ($userRole->name === $role)
        //         {
        //            return true;
        //         }   
        //     }
        // }

        
       //return false;
    }


//llega solo 1 parametro
    // public function hasRoles($role)
    // {
    //    return $this->role == $role;
    // }
}
