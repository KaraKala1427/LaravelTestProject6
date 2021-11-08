<?php

namespace App\Repositories;

use App\Models\User;


class MyUserRepository
{

    public function getUserByEmail($userData)
    {
        return User::where('email', '=', $userData->email)->first();
    }

    public function create($data)
    {
        $user = new User();

        $user->name = $data->name;
        $user->email = $data->email;
        $user->provider_id = $data->id;
        $user->avatar = $data->avatar;
        $user->save();

        return $user;
    }
}
