<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Uuid;

class UserActivity extends Model
{
    use HasFactory;

    protected $table = 'user_activitys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'employeer_id',
        'description'
    ];
}
