<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteDetails extends Model
{
    use HasFactory;
    protected $table = 'quote_details';
    public $timestamps = false;
}
