<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDetails extends Model
{
    use HasFactory;
    protected $table = 'temp_quote_details';
    public $timestamps = false;
}


