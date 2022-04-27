<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\Profile\MediaRequest;
use Illuminate\Support\Facades\DB;




class MediaUpdateController extends Controller
{
    public function __invoke(MediaRequest $request, $id)
    {
        $request->validated();

        $filename = $request->image->store('uploads');
        DB::table('profiles')
            ->where('id', $id)
            ->update(['image' => $filename]);

        return redirect('profile/' . $id)->with('status', 'Аватар обновлен');

    }
}



