<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    public $timestamps = false;


        // Define the relationship with SubStaff
        public function substafflist()
        {
            return $this->hasMany(Substaff::class, 'staff_id', 'id')->where('status', 1);
        }

}


