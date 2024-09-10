<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profile';
    protected $fillable = [
        'name',
        'slug_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'profile_id');
    }

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
