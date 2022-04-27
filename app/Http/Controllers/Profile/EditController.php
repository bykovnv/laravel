<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Routing\Controller;




class EditController extends Controller
{
    public function __invoke($id)
    {

        $user = User::find($id);

        return view('edit', [
            'user' => $user,
        ]);
    }
}



