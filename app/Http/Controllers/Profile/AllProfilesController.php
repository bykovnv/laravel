<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;




class AllProfilesController extends Controller
{
    public function __invoke()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('*')
            ->get();
        return view('profiles', [
            'users' => $users
        ]);
    }
}



