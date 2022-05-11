<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Routing\Controller;

/**
 * Выводит форму для добавление пользователя для с правом добавления профилей (admin)
 * url страницы /create
 */
class CreateController extends Controller
{
    public function __invoke()
    {
        return view ('create_profile');
    }
}



