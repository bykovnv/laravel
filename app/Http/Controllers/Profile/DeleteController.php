<?php

namespace App\Http\Controllers\Profile;

use App\User;

class DeleteController extends BaseController
{
    public function __invoke($id)
    {
       $this->service->delete($id);
       return redirect('/profiles' . $id)->with('status', 'Профиль удален');
    }
}



