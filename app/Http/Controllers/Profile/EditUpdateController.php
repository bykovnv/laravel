<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\Profile\EditRequest;
use Illuminate\Support\Facades\DB;




class EditUpdateController extends Controller
{
    public function __invoke(EditRequest $request, $id)
    {
        $request->validated();

        DB::table('profiles')
            ->where('user_id', $id)
            ->update([
                'company' => $request->company,
                'adress' => $request->adress,
                'phone' => $request->phone,
                'user_id' => $id,
                'id' => $id,
            ]);

        DB::table('users')
            ->where('id', $id)
            ->update(['name' => $request->name,]);

        return redirect('profile/' . $id)->with('status', 'Профиль обновлен');

    }
}



