<?php

namespace App\Http\Controllers\Profile;

use App\User;

class EditController extends BaseController
{
    public function __invoke($id)
    {
        return view('edit', [
            'user' => User::find($id),
        ]);
    }
}



