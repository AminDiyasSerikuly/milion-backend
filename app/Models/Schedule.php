<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public static function rules()
    {
        return [
            'cabinet_id' => 'required',
            'week_day_id' => 'required',
            'lesson_time' => 'required',
            'group_id' => 'required',
        ];
    }

    public static function getLessonTimes($week_day)
    {
        $week_day = WeekDays::where(['week_day_number' => $week_day])->first();
        $lesson_begin_time = strtotime($week_day->lesson_begin_time);
        $lesson_duration = $week_day->lesson_duration;
        $break_duration = $week_day->break_duration;
        $lesson_end_time = strtotime('20:00');
        $time = $week_day->lesson_begin_time;
        $times = [];

        while ($lesson_end_time >= strtotime($time)) {
            if (!is_numeric($time)) {
                $time = strtotime($time);
            }
            $added_lesson_duration = sprintf('+%s minutes', $lesson_duration);
            $added_break_duration = sprintf('+%s minutes', $break_duration);

            $time = date("H:i", strtotime($added_lesson_duration, $time));
            $time_duration = sprintf('%s-%s', date('H:i', $lesson_begin_time), $time);
            array_push($times, $time_duration);
            $time = date("H:i", strtotime($added_break_duration, strtotime($time)));
            $lesson_begin_time = strtotime($time);
        }

        return $times;
    }

    public static function getSchedule()
    {
        $weekDays = WeekDays::all();

        $weekDays = $weekDays->load('schedules')->toArray();


        return $weekDays;
    }
}
