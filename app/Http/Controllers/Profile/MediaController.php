<?php

namespace App\Http\Controllers\Profile;

use App\User;

use Illuminate\Routing\Controller;




class MediaController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);
        return view('media', [
            'user' => $user,
        ]);
    }
}



