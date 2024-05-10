<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver'; 

    protected $fillable = [ 
        'nama',
        'telp'
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'driver_id');
    }
}
