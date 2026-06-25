<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'certified_by_logo',
        'certificate_pdf',
        'certified_by_company_name',
        'certified_for',
        'product_name',
    ];
}
