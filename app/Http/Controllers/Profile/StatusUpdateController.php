<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;

/**
 * Контроллер по смене статуса
 * @request данные из формы
 * @id пользователя
 * Вносим статус в базу
 * Переадресовываем на страницу профиля
 * Выводим флеш сообщение
 */
class StatusUpdateController extends BaseController
{
    public function __invoke(Request $request, $id)
    {
        $this->service->statusUpdate($request, $id);
        return redirect('profile/' . $id)->with('status', 'Статус обновлен');
    }
}



