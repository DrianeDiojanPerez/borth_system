<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class holyday extends Model
{
    use HasFactory;
    protected $fillable = ['date','comment','empty'];
}
