<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $connection = 'mysql';
     //protected $table = 'croma_category';
     protected $table='category';
    //use HasFactory;
}
