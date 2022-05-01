<?php

namespace App\Http\Controllers\Profile;

use App\Profile;
use App\User;

use Illuminate\Routing\Controller;




class StatusController extends Controller
{
    public function __invoke($id)
    {
        return view('status', [
            'user' => User::find($id),
            'status' => Profile::getStatus(),
        ]);
    }
}



