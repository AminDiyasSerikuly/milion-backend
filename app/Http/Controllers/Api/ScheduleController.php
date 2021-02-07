<?php


namespace App\Http\Controllers\Api;


use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends BaseController
{

    public function schedule()
    {
        if (Auth::user()->hasRole('student')) {
            $schedule = Schedule::getSchedule();
            return $this->sendResponse($schedule);
        } else {
            return $this->sendError('Вы не являетесь студентом!');
        }


    }
}
