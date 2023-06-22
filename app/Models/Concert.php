<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'date'
    ];

    public static function getConcerts()
    {
        return self::all();
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'concert_id');
    }
}
