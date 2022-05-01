<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class SecurityUpdateController extends BaseController
{
    public function __invoke(Request $request, $id)
    {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        dd($status);


        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }
}



