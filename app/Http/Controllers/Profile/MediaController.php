<?php

namespace App\Http\Controllers\Profile;

use App\User;

class MediaController extends BaseController
{
    /**
     * Контроллер вывода страницы для добавления аватара
     * @param $id пользователя
     * url страницы /media/1
     */
    public function __invoke($id)
    {
        return view('media', [
            'user' => $user = User::find($id),
        ]);
    }
}



