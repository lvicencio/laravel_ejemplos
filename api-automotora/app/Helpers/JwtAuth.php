<?php   

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth
{
    public $key;

    public function __construct(){
        $this->key = 'clave-secreta-sistema-automotora-123456789';
    }

    public function signup($email, $password, $getToken=null)
    {
        $user = User::where(
                array(
                    'email'     => $email,
                    'password'  => $password
                ))->first();
        $signup = false;

        if (is_object($user)) {
            $signup = true;
        }

        if ($signup) {
            # crear token
            $token = array(
                'sub'   => $user->id,
                'email' => $user->email,
                'name'  => $user->name,
                'lastname' => $user->lastname,
                'iat'   => time(),
                'exp'   => time() + (7 * 24 * 60 * 60)  //<--corresponde a una semana
            );

            $jwt = JWT::encode($token,$this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));

            if (is_null($getToken)) {
                return $jwt;
            }else{
                return $decoded;
            }

        } else {
            # error
            return array(
                'status'    => 'error',
                'message'   => 'Error de Login!!'
            );
        }
    }


    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;
        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }

        if (isset($decoded) && is_object($decoded) && isset($decoded->sub)) {
            # code...
            $auth = true;
        } else {
            # code...
            $auth = false;
        }
        

        if($getIdentity){
            return $decoded;
        }

        return $auth;
   }


}


