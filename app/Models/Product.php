<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    // Specify the fillable attributes
    protected $fillable = [
        'name',
        'description',
        'technical_details',
        'advantages',
        'colors',
        'why_choose',
        'image',
        'gallery_images',
        'subproduct_id',
    ];

    // Cast JSON fields to array
    protected $casts = [
        'technical_details' => 'array',
        'advantages' => 'array',
        'colors' => 'array',
        'why_choose' => 'array',
        'gallery_images' => 'array',
    ];


    public function subproduct()
    {
        return $this->belongsTo(ProductList::class, 'subproduct_id');
    }

    // // Define the relationship to the Subproduct model
    // public function subproduct()
    // {
    //     return $this->belongsTo(ProductList::class);
    // }

    // // Example scope for retrieving by slug
    // public function scopeBySlug($query, $slug)
    // {
    //     return $query->where('slug', $slug);
    // }
}
