<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gain extends Model
{


    use HasFactory;

    protected $fillable = [
        "user_id",
        "receipt_date",
        "recurrence_date",
        "value",
        "description",
    ];


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
