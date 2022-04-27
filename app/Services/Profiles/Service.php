<?php

namespace App\Services\Profiles;

use Illuminate\Support\Facades\DB;

class Service
{
    public function update()
    {

    }

    public function getAll()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('*')
            ->get();

        return $users;
    }
}
