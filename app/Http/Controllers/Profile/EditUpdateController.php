<?php

namespace App\Http\Controllers\Profile;

use App\User;
use App\Http\Requests\Profile\EditRequest;

class EditUpdateController extends BaseController
{
    public function __invoke(EditRequest $request, $id)
    {
        $request->validated();
        $this->service->update($request, $id);
        return redirect('profile/' . $id)->with('status', 'Профиль обновлен');
    }
}



