<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Controllers\Traits\AllNotes;
use App\Http\Controllers\Traits\SendSMS;
use App\Http\Controllers\Traits\EmailTemplates;
use App\Http\Controllers\Traits\BCICEmailTraits;
use App\Http\Controllers\Traits\OperationTask;

class Controller extends BaseController
{
    
    use AuthorizesRequests, 
    ValidatesRequests ,
    AllNotes,
    SendSMS,
    EmailTemplates,
    BCICEmailTraits,
    OperationTask;
}
