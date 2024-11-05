<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonForDeny extends Model
{
    use HasFactory;

    protected $table = 'reason_for_deny';
    public $timestamps = false;

        public function systemDd()
        {
              return $this->belongsTo(Systemdd::class, 'reason_id');  // Adjust this relationship according to your database schema
        }
}


