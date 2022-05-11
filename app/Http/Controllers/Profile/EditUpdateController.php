<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\EditRequest;

class EditUpdateController extends BaseController
{
    /**
     * Контроллер редактирования профиля
     * @param EditRequest $request данные из формы
     * @param $id пользователя
     * Данные проходят валидацию
     * Вносим данные в базу
     * Переадресовываем на страницу профиля
     * Выводим флеш сообщение
     */
    public function __invoke(EditRequest $request, $id)
    {
        $request->validated();
        $this->service->update($request, $id);
        return redirect('profile/' . $id)->with('status', 'Профиль обновлен');
    }
}



