<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteFor extends Model
{
    use HasFactory;
    protected $table = 'quote_for_option';
    public $timestamps = false;
}
