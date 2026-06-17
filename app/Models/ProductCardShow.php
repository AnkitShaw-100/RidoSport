<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCardShow extends Model
{
    use HasFactory;

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'product_card_title',
        'product_card_image',
        'product_card_description',
    ];
}
