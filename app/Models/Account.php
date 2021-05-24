<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['value','user_id','nickname'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
