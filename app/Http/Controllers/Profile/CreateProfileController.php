<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;



class CreateProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);


        Validator::make($input, $rules, $messages = [
            'required' => ':attribute эти поля обязательны для заполнения.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $lastId = DB::table('users')->latest('id')->first();
        $filename = $request->image->store('uploads');

        DB::table('profiles')
            ->insert([
                'company' => $request->company,
                'adress' => $request->adress,
                'phone' => $request->phone,
                'user_id' => $lastId->id,
                'id' => $lastId->id,
                'image' => $filename,
            ]);

        return redirect('profiles/' . $lastId->id)->with('status', 'Профиль добавлен');

    }
}



