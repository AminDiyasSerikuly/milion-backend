<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function info()
    {
        return $this->sendResponse([auth()->user()]);
    }

    public function userById(Request $request)
    {
        $user_id = $request->id;
        $user = User::find($user_id);
        if (isset($user)) {
            return $this->sendResponse($user);
        }
        return $this->sendError('Такого пользователя нет');

    }
}
