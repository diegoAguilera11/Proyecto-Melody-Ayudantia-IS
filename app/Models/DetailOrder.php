<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_number',
        'quantity',
        'total',
        'payment_method',
        'user_id',
        'concert_id'
    ];

    public function concertDates()
    {
        return $this->belongsTo(Concert::class, 'concert_id');
    }
}
