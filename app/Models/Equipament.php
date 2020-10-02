<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand', 'model', 'serial_number', 'status', 'accessories', 'access_password', 'icloud_email', 'icloud_password', 'description'
    ];

	public function employeerReturn()
    {
        return $this->belongsTo('App\Models\Empolyeer');
    }

    public function employeer()
    {
        return $this->hasMany('App\Models\Equipament', 'equipament_id', 'id');
    }
}
