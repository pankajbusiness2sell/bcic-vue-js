<?php  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobReclean extends Model
{
    protected $table = 'job_reclean';
    //protected $fillable = ['job_type', 'staff_id', 'reclean_date', 'reclean_time', 'reclean_status', 'reclean_work'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
