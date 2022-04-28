<?php

namespace App\Http\Controllers\Profile;

use App\User;

class ProfileController extends BaseController
{
    public function __invoke($id)
    {
        return view('profile', [
            'user' => $this->service->getProfile($id),
        ]);
    }
}



