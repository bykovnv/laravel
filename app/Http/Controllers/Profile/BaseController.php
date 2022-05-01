<?php

namespace App\Http\Controllers\Profile;

use App\Services\Profiles\Service;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
