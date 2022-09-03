<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rumpun()
    {
        return $this->belongsTo(Rumpun::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function kitab()
    {
        return $this->belongsTo(Kitab::class);
    }

    public function ustad()
    {
        return $this->belongsTo(Ustad::class);
    }
}
