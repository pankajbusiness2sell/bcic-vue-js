<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffJobsStatus extends Model {
    protected $table = 'staff_jobs_status';
    //protected $fillable = ['job_id', 'job_type_id', 'staff_id', 'assign_type', 'status'];

        // public static function getJobDeniedStaffByReason($jobId, $jobTypeId) {
        //     return self::select('job_id', 'job_type_id', 'staff_id', 'assign_type', 'status')->where('job_id', $jobId)
        //         ->where('job_type_id', $jobTypeId)
        //         ->whereIn('status', [0, 2])
        //         ->with('staff')
        //         ->get();
        // }
}

