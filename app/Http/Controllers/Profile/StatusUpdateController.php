<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;




class StatusUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        DB::table('profiles')
            ->where('id', $id)
            ->update(['status' => $request->status]);

        return redirect('profile/' . $id)->with('status', 'Статус обновлен');

    }
}



