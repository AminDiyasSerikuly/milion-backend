<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'phone'
    ];

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ];
    }
}
