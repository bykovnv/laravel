<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Routing\Controller;

/**
 * Контроль по выводу страницы смены пароля
 * url страницы /security/1
 */
class SecurityController extends Controller
{
    public function __invoke($id)
    {
        return view('security', [
            'user' => User::find($id),
        ]);
    }
}



