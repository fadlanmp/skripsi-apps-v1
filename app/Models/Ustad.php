<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ustad extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kitab()
    {
        return $this->belongsTo(Kitab::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
