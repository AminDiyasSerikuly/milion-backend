<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'parent_full_name',
        'parent_phone',
        'name',
        'last_name',
        'middle_name',
        'address',
        'school',
        'phone',
        'course_price',
        'advisor_id',
    ];


    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'last_name' => 'required|max:32',
            'address' => 'required|max:100',
            'school' => 'required',
            'phone' => 'required|unique:users',
            'course_price' => 'required|int|digits_between:1,10',
            'advisor_id' => 'required',
            'subject' => 'required',
            'parent_full_name' => 'required',
            'parent_phone' => 'required',
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
