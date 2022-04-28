<?php

namespace App\Services\Profiles;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function update($request, $id)
    {
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
    }

    public function getAll()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('*')
            ->get();

        return $users;
    }

    public function createProfile($request)
    {
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
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('profiles')->where('id', $id)->delete();
    }

    public function updateImage($request, $id)
    {
        $filename = $request->image->store('uploads');
        DB::table('profiles')
            ->where('id', $id)
            ->update(['image' => $filename]);
    }

    public function statusUpdate($request, $id)
    {
        DB::table('profiles')
            ->where('id', $id)
            ->update(['status' => $request->status]);
    }

    public function getProfile($id)
    {
        $user = User::find($id);
        $authId = Auth::id();
        // Простая защита что бы пользователь не мог просматрировать другие профили
        if($authId != $user->id){
            abort(403);
        }
        return $user;
    }
}
