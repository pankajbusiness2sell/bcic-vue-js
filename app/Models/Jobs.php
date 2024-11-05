<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    public $timestamps = false;


    public function quoteInfo()
    {
        return $this->hasOne(QuoteNew::class, 'booking_id', 'id');
    }

    public function jobdetails()
    {
        return $this->hasMany(JobDetail::class, 'job_id', 'id')->where('status', 0)->orderBy('job_type_id', 'ASC');
    }
}


