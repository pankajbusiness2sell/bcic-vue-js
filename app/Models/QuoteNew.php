<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteNew extends Model
{
    use HasFactory;

    protected $table = 'quote_new';
    public $timestamps = false;

        // public function quote_details()
        // {
        //     return $this->hasMany(QuoteDetails::class, 'quote_id')->where('status', 0);
        // }

        // public function job_details()
        // {
        //     return $this->hasMany(JobDetail::class, 'quote_id')->where('status', 0);
        // }
}
