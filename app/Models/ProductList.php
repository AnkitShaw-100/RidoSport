<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'url', 'parent_id'];

    // Define relationship for main product and sublist
    public function subProducts()
    {
        return $this->hasMany(ProductList::class, 'parent_id');
    }

    public function parentProduct()
    {
        return $this->belongsTo(ProductList::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subproduct_id');
    }

}