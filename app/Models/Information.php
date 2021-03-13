<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public function get_items()
    {
//        $result = cache()->remember('test_count', '300', function () {

        $user_count = User::all()->count();
        $student_count = User::join('students', 'users.id', '=', 'students.user_id')
            ->count();

        $advisor_count = User::join('advisors', 'users.id', '=', 'advisors.user_id')
            ->count();

        $teacher_count = User::join('teachers', 'users.id', '=', 'teachers.user_id')
            ->count();

        $group_count = Group::all()->count();

        $subject_count = Subjects::all()->count();

        $news_count = News::all()->count();


        $result = [
            'user_count' => $user_count,
            'student_count' => $student_count,
            'advisor_count' => $advisor_count,
            'teacher_count' => $teacher_count,
            'group_count' => $group_count,
            'subject_count' => $subject_count,
            'news_count' => $news_count
        ];

        return $result;

//        });
    }
}
