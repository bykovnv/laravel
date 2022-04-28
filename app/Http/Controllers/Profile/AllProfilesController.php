<?php

namespace App\Http\Controllers\Profile;

use App\User;

class AllProfilesController extends BaseController
{
    public function __invoke()
    {
        return view('profiles', [
            'users' => $this->service->getAll(),
        ]);
    }
}



