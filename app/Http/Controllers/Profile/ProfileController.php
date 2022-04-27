<?php

namespace App\Http\Controllers\Profile;

use App\User;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;




class ProfileController extends Controller
{
    public function __invoke($id)
    {

        $user = User::find($id);
        $authId = Auth::id();

        if($authId != $user->id){
            abort(403);
        }

        return view('profile', [
            'user' => $user,
        ]);
    }
}



