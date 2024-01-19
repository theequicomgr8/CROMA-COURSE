<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $connection = 'mysql';
     //protected $table = 'croma_courses';
     protected $table='course';
    //use HasFactory;
}
