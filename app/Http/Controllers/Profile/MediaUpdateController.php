<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;




class MediaUpdateController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $request->validate([
            "image" => 'image',
        ]);

        $filename = $request->image->store('uploads');
        DB::table('profiles')
            ->where('id', $id)
            ->update(['image' => $filename]);

        return redirect('profile/' . $id)->with('status', 'Аватар обновлен');

    }
}



