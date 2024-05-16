<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['plate_number', 'model','trademark','engine_number','last_km','user_id','status'];
    protected $hidden = [
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
