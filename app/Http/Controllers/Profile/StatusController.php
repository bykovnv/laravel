<?php

namespace App\Http\Controllers\Profile;

use App\Profile;
use App\User;
use Illuminate\Routing\Controller;

/**
 * Контроллер по выводу статуса пользователя
 * @user берем из модели User из базы по его id
 * @status берем из модели Profile
 */
class StatusController extends Controller
{
    public function __invoke($id)
    {
        return view('status', [
            'user' => User::find($id),
            'status' => Profile::getStatus(),
        ]);
    }
}



