<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNotes extends Model
{
    use HasFactory;

    protected $table = 'job_notes';
    public $timestamps = false;
}
