<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\CreateRequest;

/**
 * Добавление профиля из адмики
 * Данные из формы проходят валидацию
 * Заносим данные в базу
 * Переадресовываем пользователя ко всем пользователям
 * Выводим флеш сообщение
 */
class CreateProfileController extends BaseController
{
    public function __invoke(CreateRequest $request)
    {
        $request->validated($request);
        $this->service->createProfile($request);
        return redirect('profiles/')->with('status', 'Профиль добавлен');
    }
}



