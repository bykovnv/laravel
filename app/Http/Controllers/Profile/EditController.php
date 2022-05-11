<?php

namespace App\Http\Controllers\Profile;

use App\User;

/**
 * Показ пользователя по id
 * Пример url страницы /profile/1
 */
class EditController extends BaseController
{
    public function __invoke($id)
    {
        return view('edit', [
            'user' => User::find($id),
        ]);
    }
}



