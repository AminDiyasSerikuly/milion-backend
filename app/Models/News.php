<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';

    public function rules()
    {
        return [
            'name' => 'required',
            'title' => 'required',
            'image' => 'required|file|mimes:jpeg,bmp,png|max:500000',
            'content' => 'required',
        ];
    }

}
