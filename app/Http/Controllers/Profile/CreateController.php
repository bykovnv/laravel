<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Routing\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view ('create_profile');
    }
}



