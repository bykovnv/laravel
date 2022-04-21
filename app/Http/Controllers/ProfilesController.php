<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;



class ProfilesController extends Controller
{
    public function index($user)
    {
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $authId = Auth::id();

        return view('profile', [
            'user' => $user ,
            'id' => $authId,
        ]);
    }

    public function profiles()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('*')
            ->get();

        return view('profiles', [
            'users' => $users
        ]);

    }
    public function edit($user)
    {
        $user = User::find($user);
        //dd($user->profile);
        return view('edit', [
            'user' => $user,
        ]);
    }

    public function media($user)
    {
        $user = User::find($user);
        return view('media', [
            'user' => $user,
        ]);
    }

    public function security($user)
    {
        $user = User::find($user);
        return view('security', [
            'user' => $user,
        ]);

    }

    public function status($user)
    {
        $user = User::find($user);
        return view('status', [
            'user' => $user,
        ]);
    }

    public function editUpdate(Request $request, $id)
    {

        DB::table('profiles')
            ->where('user_id', $id)
            ->updateOrInsert([
            'company' => $request->company,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'user_id' => $id,
                'id' => $id,
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update(['name' => $request->name,]);

        return redirect('/');

    }

    public function mediaUpdate(Request $request, $id)
    {
        $filename = $request->image->store('uploads');
        DB::table('profiles')
            ->where('id', $id)
            ->update(['image' => $filename]);

        return redirect('/');

    }

    public function securityUpdate(Request $request, $id)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function statusUpdate(Request $request, $id)
    {

        DB::table('profiles')
            ->where('id', $id)
            ->update(['status' => $request->status]);

        return redirect('/');
    }

    public function delete($id)
    {

        DB::table('users')->where('id', $id)->delete();
        DB::table('profiles')->where('id', $id)->delete();
        return redirect('/profiles');
    }

    public function create()
    {
        return view ('create_profile');
    }

    public function createUser(Request $request)
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
}



