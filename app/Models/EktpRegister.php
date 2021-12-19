<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EktpRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nik_id'
    ];

    protected $hidden = [
        'user_id', 'nik_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
