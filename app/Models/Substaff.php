<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substaff extends Model
{
    use HasFactory;

    protected $table = 'sub_staff';
    public $timestamps = false;


    // Define the inverse relationship with Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}


