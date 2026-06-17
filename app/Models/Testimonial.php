<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'author_name',
        'author_image',
        'author_designation',
        'message',
    ];

    // Optionally, if you want to restrict all attributes and only allow the specified ones
    // protected $guarded = [];
}
