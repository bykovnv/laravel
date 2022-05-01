<?php

namespace App\Http\Controllers\Profile;

use App\User;
use App\Http\Requests\Profile\MediaRequest;

class MediaUpdateController extends BaseController
{
    public function __invoke(MediaRequest $request, $id)
    {
        $request->validated($request);
        $this->service->updateImage($request, $id);
        return redirect('profile/' . $id)->with('status', 'Аватар обновлен');
    }
}



