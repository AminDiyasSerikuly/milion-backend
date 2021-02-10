<?php


namespace App\Http\Controllers\Api;


class UserController extends BaseController
{
    public function info()
    {
        return $this->sendResponse([auth()->user()]);
    }

    public function avatar()
    {
        
    }
}
