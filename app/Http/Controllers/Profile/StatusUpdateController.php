<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;




class StatusUpdateController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $this->service->statusUpdate($request, $id);
        return redirect('profile/' . $id)->with('status', 'Статус обновлен');
    }
}



