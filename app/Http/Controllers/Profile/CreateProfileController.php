<?php

namespace App\Http\Controllers\Profile;

use App\User;
use App\Http\Requests\Profile\CreateRequest;


class CreateProfileController extends BaseController
{
    public function __invoke(CreateRequest $request)
    {
        $request->validated($request);
        $this->service->createProfile($request);
        return redirect('profiles/' . $lastId->id)->with('status', 'Профиль добавлен');
    }
}



