<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCodes extends Model
{
    use HasFactory;
    protected $table = 'postcodes';
    public $timestamps = false;
}
