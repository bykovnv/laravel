<?php

namespace App\Http\Controllers\Profile;


/**
 * Контроллер выводит всех пользователей
 * Получаем всех пользователей и выводим в view
 * url страницы /profiles
 */
class AllProfilesController extends BaseController
{
    public function __invoke()
    {
        return view('profiles', [
            'users' => $this->service->getAll(),
        ]);
    }
}



