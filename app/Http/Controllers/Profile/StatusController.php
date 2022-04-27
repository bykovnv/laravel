<?php

namespace App\Http\Controllers\Profile;

use App\User;

use Illuminate\Routing\Controller;




class StatusController extends Controller
{
    public function __invoke($id)
    {
        $user = User::find($id);
        return view('status', [
            'user' => $user,
        ]);
    }
}



