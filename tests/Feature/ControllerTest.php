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




    public function loginAuth()
    {
        $this->post('/login', [
            'email' => 'doodee@doodee.ru',
            'password' => 'doodee@doodee.ru'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuth()
    {
        $this->loginAuth();
        $response = $this->get('profile/1');
        $response->assertOk();
    }


    public function testFailedAuth()
    {
        $this->post('/login', [
            'email' => 'doode@doodee.ru',
            'password' => 'doode@doodee.ru'
        ]);
        $response = $this->get('profile/1');
        $response->assertForbidden();
    }


    public function testEditProfile()
    {
        $this->loginAuth();

        DB::table('profiles')
            ->where('user_id', 1)
            ->updateOrInsert([
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

//    public function testFailedPhoneEditProfile()
//    {
//        $this->loginAuth();
//
//        $this->post('/edit/1', [
//            'email' => 'doodee@doodee.ru',
//            'password' => 'doodee@doodee.ru'
//        ]);
//
//        $response = $this->get('edit/1');
//        $response->assertSee('The phone must be an integer.');
//    }


}
