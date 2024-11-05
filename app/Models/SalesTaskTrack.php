<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTaskTrack extends Model
{
    use HasFactory;

    protected $table = 'sales_task_track';
    public $timestamps = false;
}
