<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveQuoteQuestion extends Model
{
    use HasFactory;

    protected $table = 'save_quote_questions';
    public $timestamps = false;
}
