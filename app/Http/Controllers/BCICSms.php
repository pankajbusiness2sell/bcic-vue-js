<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Support\Collection;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Staff;

//use App\Models\BCICEmail;

class BCICSms extends MasterController
{

    public function __construct()
    {
            $this->middleware('auth');
    }
     
    function bcic_sms() {
        
        return view('sms.index');
    }
}