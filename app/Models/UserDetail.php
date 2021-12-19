<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik';

    protected $fillable = [
        'kk',
        'nik',
        'place',
        'birth_date',
        'gender',
        'blood_type',
        'rt',
        'rw',
        'city',
        'village',
        'district',
        'address',
        'citizenship',
        'religion',
        'profession',
        'marriage',
        'image_KK',
        'transfer_certificate',
        'Certificate_moving_foreign',
    ];

    protected $hidden = [
        'kk',
        'nik',
        'place',
        'birth_date',
        'gender',
        'blood_type',
        'rt',
        'rw',
        'city',
        'village',
        'district',
        'address',
        'citizenship',
        'religion',
        'profession',
        'marriage',
        'image_KK',
        'transfer_certificate',
        'Certificate_moving_foreign',
    ];
}
