<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    protected $table = 'data_user';

    protected $fillable = [
        'data','user_token', 'limit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_token', 'user_token');
    }
}
