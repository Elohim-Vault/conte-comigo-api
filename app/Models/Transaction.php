<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'recurrence_date', 'value', 'description'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }
}
