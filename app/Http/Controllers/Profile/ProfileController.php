<?php

namespace App\Http\Controllers\Profile;


class ProfileController extends BaseController
{
    /**
     * @param $id пользователя
     * url страницы /profile/1
     */
    public function __invoke($id)
    {
        return view('profile', [
            'user' => $this->service->getProfile($id),
        ]);

    }
}



