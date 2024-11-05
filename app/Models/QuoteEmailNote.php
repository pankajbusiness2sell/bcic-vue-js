<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteEmailNote extends Model
{
    use HasFactory;
    protected $table = 'quote_email_notes';
    public $timestamps = false;
}
