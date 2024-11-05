<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckList extends Model
{
    use HasFactory;

    protected $table = 'truck_list';
    public $timestamps = false;
}
