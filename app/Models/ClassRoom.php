<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    // protected $table = 'class_rooms';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}
