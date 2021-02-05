<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $table = 'advisors';

    protected $fillable = ['first_name', 'last_name', 'middle_name', 'social_id', 'phone', 'address'];


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'social_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    public function message()
    {

    }
}
