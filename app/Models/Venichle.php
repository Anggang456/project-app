<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venichle extends Model
{
    use HasFactory;
    public $table = 'venichle';
    protected $fillable = [
        'nama',
        'type',
        'nomor',
        'bbm',
        'service'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'venichle_id');
    }
}
