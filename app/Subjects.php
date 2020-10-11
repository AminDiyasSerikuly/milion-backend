<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'title'
    ];


    public function group()
    {
       return $this->hasOne(Group::class, 'subject_id', 'id');
    }
}
