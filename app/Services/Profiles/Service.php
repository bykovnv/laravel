<?php

namespace App\Services\Profiles;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Service
{
    /**
     * Обновление данных профиля
     * Если в таблице profiles нет такого id, он его создаст, или обновит
     * Потом обновит имя в таблицк users
     * @param $request из формы
     * @param $id пользователя
     * @return void
     */
    public function update($request, $id)
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
    }

    /**
     * Вывод всех пользователей
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('*')
            ->get();

        return $users;
    }

    /**
     * Создает нового профиля из админки
     * @param $request - данные из формы
     * @return void
     */
    public function createProfile($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Получаем последний id пользователя что бы не было дублей
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

    /**
     * Контроллер удаляет пользователя по ID
     * @param $id пользователя
     * @return void
     */
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('profiles')->where('id', $id)->delete();
    }

    /**
     * Добавляет или обновляет аватар у профиля
     * Картинку переносим в папку /public/uploads
     * Путь и название добавляем в таблицу
     * @param $request
     * @param $id
     * @return void
     */
    public function updateImage($request, $id)
    {
        $filename = $request->image->store('uploads');
        DB::table('profiles')
            ->where('id', $id)
            ->update(['image' => $filename]);
    }

    /**
     * Обновляем статус у пользователя
     * @param $request данные из формы
     * @param $id пользователя
     * @return void
     */
    public function statusUpdate($request, $id)
    {
        DB::table('profiles')
            ->where('id', $id)
            ->update(['status' => $request->status]);
    }

    /**
     * Вывод данных профиля
     * Пользователь может посмотреть только свой профиль
     * @param $id пользователя
     * @return mixed $user
     */
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
