<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    protected $fillable = ['name', 'amount'];

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
