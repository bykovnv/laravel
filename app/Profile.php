<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Константы для статуса
    const STATUS_OFFLINE = 0;
    const STATUS_ONLINE = 1;

    // Статический метод для удобного вывода в шаблоне
    public static function getStatus()
    {
        return [
            self::STATUS_OFFLINE => "Вне сети",
            self::STATUS_ONLINE => "В сети",
        ];
    }

    // Константы для ролей
    const ROLE_ADMIN = 1;
    const ROLE_USER = 5;

    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => "Админ",
            self::ROLE_USER => "Пользователь",
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
