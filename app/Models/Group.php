<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';


    public function subject()
    {
        return $this->hasOne(Subjects::class, 'id', 'subject_id');
    }
}
