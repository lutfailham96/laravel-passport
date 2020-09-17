<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class CollegeStudent extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'address', 'phone'];

    protected $hidden = ['id'];

    protected $primaryKey = 'uuid';

    protected $casts = [
        'uuid' => 'string'
    ];

    protected $guarded = ['uuid'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
