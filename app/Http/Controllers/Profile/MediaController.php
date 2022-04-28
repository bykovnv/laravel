<?php

namespace App\Http\Controllers\Profile;

use App\User;

class MediaController extends BaseController
{
    public function __invoke($id)
    {
        return view('media', [
            'user' => $user = User::find($id),
        ]);
    }
}



