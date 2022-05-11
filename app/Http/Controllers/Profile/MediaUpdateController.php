<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\MediaRequest;


class MediaUpdateController extends BaseController
{
    /**
     * Контроллер обновляет аватар пользователя
     * @param MediaRequest $request - данные из формы
     * @param $id пользвотеля
     * Валидация картинки
     * Вносим данные в базу
     * Переадресация на страницу пользователя
     * Выводим флеш сообщение
     */
    public function __invoke(MediaRequest $request, $id)
    {
        $request->validated($request);
        $this->service->updateImage($request, $id);
        return redirect('profile/' . $id)->with('status', 'Аватар обновлен');
    }
}



