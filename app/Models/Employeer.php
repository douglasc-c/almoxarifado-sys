<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'identification_number', 'document_number', 'email', 'address', 'phone', 'function',
    ];

    public function equipament()
    {
        return $this->hasMany('App\Models\Equipament', 'id');
    }

    public function equipamentReturn()
    {
        return $this->belongsTo('App\Models\Empolyeer');
    }
}
