<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MasterController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Models\QuoteNew;
use App\Models\PostCodes;
use App\Models\Sites;
use App\Models\QuoteFor;
use App\Models\JobType;
use App\Models\TempQuote;
use App\Models\TempDetails;



class QuoteAPIController extends MasterController
{   
  
    
    function getPostCode(Request $request) {

          $strVal = $request->input('postCode');
            $postCodes =   PostCodes::where('suburb', 'like', $strVal)
                          ->orWhere('postcode', 'like', $strVal)
                          ->get();
              return response()->json($postCodes);      
    }

    function getSiteslocation(Request $request) {
          $sites = Sites::select('id','name','domain','br_domain','abv','email','phone')->get()->keyBy('id');
          return response()->json($sites);
    }

    function getQuoteFor(Request $request) {
      $quoteFor = QuoteFor::select('id', 'name', 'type', 'company_name',  'abn_number', 'bsb')->where('status', 1)->get()->keyBy('id');
      return response()->json($quoteFor);
    }

    function jobtypeids(Request $request) {

       // $jobtypeid = $request->input('jobtypeid');
        $data_type = $request->input('data_type');

        if($data_type == 1) {

            $jobTypes = JobType::select('id','name','job_text','value', 'job_amount')->where('p_id', '!=', 9)
                    ->orWhere('id', 9)
                    ->get()->keyBy('id');

            return response()->json($jobTypes);
 
        }else if($data_type == 2) {

          $jobTypes = JobType::select('id','name','job_text','value','job_amount')->where('p_id', 9)->get()->keyBy('id');
          return response()->json($jobTypes);
        }

    }

    public function JobTypeInfo(Request $request, $id)
    {
        $jobtypeid = (!empty($id)) ? $id : 0;
        
        // Fetch the job type information based on the jobtypeid
        $jobType = JobType::select('id', 'name', 'job_text','value',  'job_amount')
            ->where('id', $jobtypeid)
            ->first();

        // Return the job type information as a JSON response
        return response()->json($jobType);
    } 

    

}
