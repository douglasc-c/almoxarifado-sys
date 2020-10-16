<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand', 'model', 'serial_number', 'status', 'accessories', 'access_password', 'icloud_email', 'icloud_password', 'description', 'employeer_id'
    ];

	public function employeer()
    {
        return $this->belongsTo('App\Models\Employeer', 'employeer_id');
    }

}
