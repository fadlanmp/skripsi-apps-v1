<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumpun extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function kitab()
    {
        return $this->hasMany(Kitab::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
