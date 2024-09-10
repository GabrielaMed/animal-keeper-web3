<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'user';

    protected $fillable = [
        'name',
        'birthdate',
        'cpf',
        'passport',
        'phone',
        'email',
        'password',
        'avatar_path',
        'profile_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
                Log::info('Generated UUID: ' . $model->{$model->getKeyName()});
            }
        });
    }
}
