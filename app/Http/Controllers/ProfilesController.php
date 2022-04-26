<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;


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

        if($authId != $user->id){
            abort(403);
        }

        return view('profile', [
            'user' => $user,
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
        $request->validate([
            'phone' => 'integer',
        ]);

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

    public function mediaUpdate(Request $request, $id)
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

        return redirect('profile/' . $id)->with('status', 'Статус обновлен');
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('profiles')->where('id', $id)->delete();
        return redirect('/profiles' . $id)->with('status', 'Профиль удален');
    }

    public function create()
    {
        return view ('create_profile');
    }

    public function createUser(Request $request)
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



