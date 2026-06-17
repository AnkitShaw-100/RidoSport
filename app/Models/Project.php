<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'images', 'subservice_id'];

    // Relationship to the Subservice
    public function subservice()
    {
        return $this->belongsTo(ServiceList::class, 'subservice_id');
    }
}

