<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C3cxUser extends Model
{
    use HasFactory;

    protected $table = 'c3cx_users';
    public $timestamps = false;
}
