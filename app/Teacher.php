<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';

    protected $fillable = ['first_name', 'last_name', 'middle_name', 'social_id', 'phone'];
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'social_id' => 'required',
            'phone' => 'required',
        ];
    }
}
