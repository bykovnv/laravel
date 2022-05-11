<?php

namespace App\Http\Controllers\Profile;


class ProfilesController extends BaseController
{
    /**
     * Контроллер вывовода всех профилей
     */
    public function __invoke()
    {
        return view('profiles', [
            'users' => $this->service->getAll($user),
        ]);
    }
}



