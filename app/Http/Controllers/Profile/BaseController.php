<?php

namespace App\Http\Controllers\Profile;

use App\Services\Profiles\Service;
use Illuminate\Routing\Controller;

/**
 *  Данный класс для подключение сервисов для будущих конроллеров
 *  Что бы в контроллерах осталась только логика
 */
class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
