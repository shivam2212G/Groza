<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $primaryKey = 'checkout_id';
    protected $table = 'checkouts';
    protected $guarded = [];

    protected $casts = [
        'product_data' => 'array',
    ];
}
