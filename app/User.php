<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','role','password','user_pic','user_phone','active','zip_code','promo_code','TnC','latitude','longitude','interest'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public static  function checkUser($data) {

        $result = [];
         if(array_key_exists('email', $data))
         {
            if (\Auth::validate(array('email' => $data['email'], 'password' => $data['password']))) {

                $user = User::where('email',$data['email'])->first();
                $result = [
                    'id' => $user->id
                ];

            }else{

                $result['error'] = 'Incorrect email or password';

            }
         }

          if(array_key_exists('username', $data))
         {
            if (\Auth::validate(array('username' => $data['username'], 'password' => $data['password']))) {

                $user = User::where('username',$data['username'])->first();
                $result = [
                    'id' => $user->id
                ];

            }else{

                $result['error'] = 'Incorrect username or password';

            }
         }
        
        return $result;
    }
}
