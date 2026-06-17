<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCourt extends Model
{
    protected $fillable= ['name','email' , 'phone' , 'requirement','city' ,'message','court' ];
}
