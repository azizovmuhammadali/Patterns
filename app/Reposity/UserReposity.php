<?php

namespace App\Reposity;

use App\Models\User;
use App\Interfaces\Interfaces\Reposity\UserReposityInterface;

class UserReposity implements UserReposityInterface
{
    /**
     * Create a new class instance.
     */
    public function createUser($data){
    $user = new User();
    $user->name = $data["name"];
    $user->email = $data["email"];
    $user->password = bcrypt($data["password"]);
    $user->verification_token = $data['verification_token'];
    $user->save();
    return $user;
    }
    public function getUserByEmail($email){
    return User::where('email', $email)->first();
    }
    public function findUserByToken($token){
   $user = User::where('verification_token', $token)->first();
   $user->email_verified_at = now();
   $user->save();
   return $user;
    }
}
