<?php

namespace Tests\Feature;

use App\Services\Profiles\Service;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControllerTest extends TestCase
{


    /**
     *  Хелпер для вход на сайт
     */
    public function loginAuth()
    {
        $this->post('/login', [
            'email' => 'doodee@doodee.ru',
            'password' => 'doodee@doodee.ru'
        ]);
    }

    /**
     *  Проверка на удачный вход существующему логину и паролю
     */
    public function testAuth()
    {
        $this->loginAuth();
        $response = $this->get('profile/1');
        $response->assertOk();
    }

    /**
     *  Проверка на запрет просмотра профиля , если неправильно введен логин или пароль
     */
    public function testFailedAuth()
    {
        $this->post('/login', [
            'email' => 'doode@doodee.ru',
            'password' => 'doode@doodee.ru'
        ]);
        $response = $this->get('profile/1');
        $response->assertForbidden();
    }

    /**
     * Тест на проверку изменения данных в профиле.
     * После ввода данных в форму, мы должны увидеть текст, который мы ввели в форму.
     */
    public function testEditProfile()
    {
        $this->loginAuth();
        DB::table('profiles')
            ->where('user_id', 1)
            ->update([
                'company' => "Yandex",
                'adress' => "Russia, Moscow",
                'phone' => 8495644879,
                'user_id' => 1,
                'id' => 1,
            ]);

        DB::table('users')
            ->where('id', 1)
            ->update(['name' => "Николай",]);

        $response = $this->get('profile/1');
        $response->assertSee('Yandex');
    }

    /**
     * Тест на валидацию телефона
     * Телефон должен быть типом integer
     */
    public function testFailedPhoneEditProfile()
    {
        $this->loginAuth();

        $this->post('/edit/1', [
            'company' => "Yandex",
            'adress' => "Russia, Moscow",
            'phone' => 'dsad',
        ]);

        $response = $this->get('edit/1');
        $response->assertSee('The phone must be an integer.');
    }

    /**
     * Проверка на загрузку картинки
     * После отправки картинки, на странице профиля. мы ее найдем по названию
     */
    public function testImageUploadProfile()
    {
        $this->loginAuth();
        $filename = "uploads/0ojHe76OJWVlhaj0CNYmOupo7XnuW9S9tsMwkMfH.png";
        DB::table('profiles')
            ->where('id', 1)
            ->update(['image' => $filename]);

        $response = $this->get('/profile/1');
        $response->assertSee('0ojHe76OJWVlhaj0CNYmOupo7XnuW9S9tsMwkMfH');
    }

    /**
     * Проверка на валидацию картинки
     * Пробую передать строку, получается ответ что картинка должна быть картинкой
     */
    public function testFailedImageUploadProfile()
    {
        $this->loginAuth();
        $this->post('/media/1', [
            'image' => "Yandex",
        ]);

        $response = $this->get('/media/1');
        $response->assertSee('The image must be an image.');
    }

    /**
     * Проверка на смену статуса
     * После смены статусы мы должны увить его текущий статус
     */
    public function testStatusUpdate()
    {
        $this->loginAuth();
        $this->post('/status/1' , [
            'status' => 1,
        ]);
        $response = $this->get('/status/1');
        $response->assertSee('Текущий статус 1');

    }

    /**
     * Проверка на доступ ко всем профилям
     * Только admin, может смотреть все профили
     * По умолчанию все заарегистрированные пользователи получают роль guest
     */
    public function testAccessProfiles()
    {
        $this->loginAuth();
        $response = $this->get('/profiles');
        $response->assertStatus(403);
    }

}
