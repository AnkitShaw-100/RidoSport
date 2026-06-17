<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'url', 'parent_id'];

    // Define relationship for main service and sublist
    public function subServices()
    {
        return $this->hasMany(ServiceList::class, 'parent_id');
    }

    public function parentService()
    {
        return $this->belongsTo(ServiceList::class, 'parent_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'subservice_id');
    }

}
