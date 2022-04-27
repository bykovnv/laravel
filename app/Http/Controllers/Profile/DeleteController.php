<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;




class DeleteController extends Controller
{
    public function __invoke($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('profiles')->where('id', $id)->delete();
        return redirect('/profiles' . $id)->with('status', 'Профиль удален');

    }
}



