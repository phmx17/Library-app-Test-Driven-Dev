<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $guarded = []; // turn off mass assignment; ok if request is split and assigned to fields in controller
    use HasFactory;
}
