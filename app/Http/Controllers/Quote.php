<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MasterController;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Mail\ViewQuoteMmail;

use App\Models\QuoteFor;
use App\Models\JobType;
use App\Models\User;
use App\Models\TempQuote;
use App\Models\TempDetails;
use App\Models\QuoteNew;
use App\Models\TaskManager;
use App\Models\SalesTaskTrack;
use App\Models\QuoteDetails;
use App\Models\JobDetail;
use App\Models\Sites;
use App\Models\TruckList;
use App\Models\C3cxUser;
use App\Models\QuoteEmailNote;
use App\Models\SaveQuoteQuestion;


class Quote extends MasterController
{
    
    const  CLEANING_RATES = 45;

    public function __construct()
    {
            $this->middleware('auth');
    }
     

    function CreateQuote(Request $request) {
        
         return view('quote.quote');
    }

    function createQuoteObject(Request $request) {
 
          
         $job_type_id = $request->input('job_type_id');
         $quotefor = (!empty($request->input('quote_form'))) ? $request->input('quote_form') : 1;
         $postCode = (!empty($request->input('postCode'))) ? $request->input('postCode') : null; 
         $site_id = (!empty($request->input('sitesid'))) ? $request->input('sitesid') : 0;
         $booking_date = (!empty($request->input('booking_date'))) ? $request->input('booking_date') :'';

         $session_id = session()->getId();
         $date = now()->toDateString(); // Current date in "Y-m-d" format
        
           // Check if temp_quote_id is stored in session
                $tempStoreId = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                // Log::info('Sessiionid  ' . $tempStoreId);
                if (empty($tempStoreId)) {
                    // Create a new TempQuote instance
                    $tempQuote = new TempQuote();
                    $tempQuote->session_id = $session_id;
                    $tempQuote->site_id = $site_id;
                    $tempQuote->date = $date;
                    $tempQuote->booking_date = $booking_date;
                    $tempQuote->quote_for = $quotefor;
                    //Log::info('Temp Quote' , $tempQuote);
                    $tempQuote->save();

                    // Store the temp_quote_id in session
                    $temp_quote_id = $tempQuote->id;
                    $request->session()->put('temp_quote_id', $temp_quote_id);
                } else {
                    $temp_quote_id = $tempStoreId;
                }
                Log::info('temp_quote_id  ' . $temp_quote_id);
               ///  echo  $temp_quote_id;

             $jobTypename = $this->get_rs_value('job_type','name',$job_type_id);  

           if($job_type_id == 1) {
           
                $bed = (!empty($request->input('bed'))) ? $request->input('bed') : 0;
                $bath = (!empty($request->input('bath'))) ? $request->input('bath') : 0;
                $study = (!empty($request->input('study'))) ? $request->input('study') : 0 ;
                $toilet = (!empty($request->input('toilet'))) ? $request->input('toilet') : 0 ;  
                $living = (!empty($request->input('living'))) ? $request->input('living') : 0 ; 
                $furnished = (!empty($request->input('furnished'))) ? $request->input('furnished') : '' ; 
                $property_type = (!empty($request->input('property_type'))) ? $request->input('property_type') : '';
                $blinds = (!empty($request->input('blinds'))) ? $request->input('blinds') : '' ; 
                $cleaning_wall_wash = (!empty($request->input('cleaning_wall_wash'))) ? $request->input('cleaning_wall_wash') : '' ; 

                $blinds_numbers = 4;

                $hours = 0; $cleaning_amt = 0; $calc = '';

        //           $rates_sql = "select * from rates_cleaning where bed=".($bed+$study)." and bath=".$bath." and site_id=".$site_id; 
        // $rates_data  = mysql_query($rates_sql);

                    $getRate = DB::table('rates_cleaning')
                             ->where('bed', ($bed+$study))
                             ->where('bath', $bath)
                             ->where('site_id', $site_id)
                             ->first();
                    if(empty($getRate)) {
                      $getRate = DB::table('rates_cleaning')
                      ->where('bed', ($bed+$study))
                      ->where('bath', $bath)
                      ->where('site_id', 0)
                      ->first();
                    }
            $hours = (!empty($getRate->hours)) ? $getRate->hours : 0;   
            $unfurnished = (!empty($getRate->unfurnished)) ? $getRate->unfurnished : 0;   
            $furnished = (!empty($getRate->furnished)) ? $getRate->furnished : 0;   
            $rateblinds = (!empty($getRate->blinds)) ? $getRate->blinds : 0;   
            $rateliving_inc = (!empty($getRate->living_inc)) ? $getRate->living_inc : 0;   

            if ($furnished == "No") {

                $hours = $hours;

            } else {
                
                if ($bed == 1 || $bed == 2) {
                    $furnished_hr = 2;
                } else if ($bed == 3 || $bed == 4) {
                    $furnished_hr = 3;
                } else {
                    $furnished_hr = 5;
                }
                
                $hours = ($hours + $furnished_hr);
            }


            if($blinds == "Venetians" || $blinds == "Shutters") 
            {
                $blindshr = 1;
                if ($blinds_numbers < 5) {
                    $blindshr = 1;
                } else if ($blinds_numbers > 4 && $blinds_numbers < 8) {
                    $blindshr = 2;
                }
                $hours += $blindshr;
            }


            if($toilet > 0) {
                $hours = $hours + $toilet;
            }
            
            
            if($living > $rateliving_inc) {
                
                $extra_livings = ( $living - $rateliving_inc);  
                $hours = ($hours+$extra_livings); 
            }

             
            if($site_id > 0) {

                  $cleaningrate = $this->get_rs_value('sites','rate_amt',$site_id);   

            }else{

                  $cleaningrate = CLEANING_RATES;

            }


              if(!empty($property_type)) 
              {
                  $dd_property_type = DB::table('dd_property_type')
                  ->where('name', $property_type)
                  ->first();

                  $property_hours = (!empty($dd_property_type->hours)) ? $dd_property_type->hours : 0;
                  $property_amount = (!empty($dd_property_type->amount)) ? $dd_property_type->amount : 0;
                  $hours = $hours + $property_hours;
              }

                $cleaning_amt = $hours*$cleaningrate;
                $quoteTemp = 
                  [
                    'temp_quote_id' =>$temp_quote_id,
                    'amount' =>$cleaning_amt,
                    'cleaning_wall_wash' =>$cleaning_wall_wash,
                    'job_type_id' =>$job_type_id,
                    'job_type' =>$jobTypename,
                    'bed' =>$bed,
                    'study' =>$study,
                    'bath' =>$bath,
                    'toilet' =>$toilet,
                    //'booking_date' =>'0000-00-00',
                    'living' =>$living,
                    'furnished' =>$furnished,
                    'property_type' =>$property_type,
                    'blinds_type' =>$blinds,
                    'blinds_numbers' => 4,
                    'hours' => $hours,
                    'rate' => $cleaningrate
                  ];

              $quoteDetailsid = TempDetails::insertGetId($quoteTemp);

              $getdetails = TempDetails::where('temp_quote_id', $temp_quote_id)->where('job_type_id', $job_type_id)->first()->toArray();
              $desc = $this->create_quote_desc_str($getdetails);
              $quoteTempid = $getdetails['id'];

              TempDetails::where('id', $quoteTempid)->update(['description' => $desc]);
          
       
         } else if($job_type_id == 2) {

            //[2024-07-03 04:05:37] local.INFO: data {"bed":"1","living":"1","carpet_stairs":"1","stains":null,"quote_floor":null,"carpet_stain_removal":null,"job_type_id":2} 
            
          $bed = (!empty($request->input('bed'))) ? $request->input('bed') : 0;
          $living = (!empty($request->input('living'))) ? $request->input('living') : 0 ; 
          $carpet_stairs = (!empty($request->input('carpet_stairs'))) ? $request->input('carpet_stairs') : 0 ;
          $stains = (!empty($request->input('stains'))) ? $request->input('stains') : 0 ;
          $quote_floor = (!empty($request->input('quote_floor'))) ? $request->input('quote_floor') : 0 ;
          $lift_property = (!empty($request->input('lift_property'))) ? $request->input('lift_property') : 0 ;
          $carpet_stain_removal = (!empty($request->input('carpet_stain_removal'))) ? $request->input('carpet_stain_removal') : 0 ;
          
                        $getRate = DB::table('rates_carpet')
                        ->where('bed', $bed)
                        ->where('living', $living)
                        ->where('site_id', $site_id);
                    
                            if($stains > 0) {
                                $getRate->where('stairs', '>', 0);
                            } else {
                                $getRate->where('stairs', 0);
                            }
                            
                            $getRate = $getRate->first();

                    if(empty($getRate)) {

                            $getRate = DB::table('rates_carpet')
                            ->where('bed', $bed)
                            ->where('living', $living)
                            ->where('site_id', 0);
                        
                                if($stains > 0) {
                                    $getRate->where('stairs', '>', 0);
                                } else {
                                    $getRate->where('stairs', 0);
                                }
                                
                                $getRate = $getRate->first();
                     
                    }         

                     $carpetDetails = 
                                [
                                    'temp_quote_id' => $temp_quote_id,
                                    'carpet_stain_removal' => $carpet_stain_removal,
                                    'job_type_id' => $job_type_id,
                                    'job_type' => $jobTypename,
                                    'bed' => $bed,
                                    'living' => $living,
                                    'carpet_stairs' => $carpet_stairs,
                                    'quote_floor' => $quote_floor,
                                    'lift_property' => $lift_property,
                                    'stains' => $stains,
                                    'amount' => (!empty($getRate->price)) ? $getRate->price : 0
                                ];


                $quoteDetailsid = TempDetails::insertGetId($carpetDetails);

                $getdetails = TempDetails::where('temp_quote_id', $temp_quote_id)->where('job_type_id', $job_type_id)->first()->toArray();
                $desc = $this->create_quote_desc_str($getdetails);
                $quoteTempid = $getdetails['id'];

                TempDetails::where('id', $quoteTempid)->update(['description' => $desc]);                


           
         } else if($job_type_id == 3) {
            //local.INFO: data {"pest_inside":true,"pest_outside":true,"pest_flee":null,"job_type_id":3} 

                $pest_amt = 0;
                $inside = (!empty($request->input('pest_inside'))) ? $request->input('pest_inside') : 0;
                $outside = (!empty($request->input('pest_outside'))) ? $request->input('pest_outside') : 0 ;
                $flee = (!empty($request->input('pest_flee'))) ? $request->input('pest_flee') : 0 ;


                $rates_data = DB::table('rates_pest')->where('site_id', $site_id)->first();

                if (is_null($rates_data)) {
                   $rates_data = DB::table('rates_pest')->where('site_id', 0)->first();
                }

                if ($outside == '1' && $inside == '1') {
                    $pest_amt += $rates_data->inside_outside;
                } else {
                    if ($flee == "1") {
                        $pest_amt += $rates_data->flea;
                    }
                    if ($outside == "1") {
                        $pest_amt += $rates_data->outside;
                    }
                    if ($inside == "1") {
                        $pest_amt += $rates_data->inside;
                    }
                }

                $pestData =  [
                                'temp_quote_id' => $temp_quote_id,
                                'job_type_id' => $job_type_id,
                                'job_type' => $jobTypename,
                                'pest_inside' => $inside,
                                'pest_outside' => $outside,
                                'pest_flee' => $flee,
                                'amount' => $pest_amt,
                            ];
                $quoteDetailsid = TempDetails::insertGetId($pestData);

                $getdetails = TempDetails::where('temp_quote_id', $temp_quote_id)->where('job_type_id', $job_type_id)->first()->toArray();
                $desc = $this->create_quote_desc_str($getdetails);
                $quoteTempid = $getdetails['id'];

                TempDetails::where('id', $quoteTempid)->update(['description' => $desc]);               
           
         }else if($job_type_id == 11) {

           
         }else{

            $jobTypename = $this->get_rs_value('job_type','name',$job_type_id);  

            $description = (!empty($request->input('description'))) ? $request->input('description') : null;
            $other_job_amount = (!empty($request->input('other_job_amount'))) ? $request->input('other_job_amount') : 0 ;

            $quoteTemp = 
                  [
                    'temp_quote_id' =>$temp_quote_id,
                    'job_type_id' =>$job_type_id,
                    'job_type' =>$jobTypename,
                    'description' =>$description,
                    'amount' =>$other_job_amount,
                  ];

              $quoteDetailsid = TempDetails::insertGetId($quoteTemp);

        }

             $getData = $this->create_quote_str($temp_quote_id); 
            return response()->json($getData, 200);
    }

    function UnsetQuoteVariable(Request $request) {

        // Unset the session variables
        $request->session()->forget(['temp_quote_id', 'quote_id', 'temp_quote']);
        // Optionally, you can return a response
        return response()->json(['message' => 'Session variables unset successfully'], 200);
    }

    function deleteTempQuote(Request $request){
            
            $tempid = $request->input('temp_id');
            $temp_quote_id = $request->input('temp_quote_id');
            TempDetails::where('id', $tempid)->delete();

            $getData = $this->create_quote_str($temp_quote_id);

            return response()->json($getData, 200);
    }


    function SaveQuote(Request $request) {
        
           $quotefor = (!empty($request->input('quotefor'))) ? $request->input('quotefor') : '';
           $suburb = (!empty($request->input('postCode'))) ? $request->input('postCode') : '';
           $sitesid = (!empty($request->input('sitesid'))) ? $request->input('sitesid') : '';
           $booking_date = (!empty($request->input('booking_date'))) ? $request->input('booking_date') : '';
           $name = (!empty($request->input('name'))) ? $request->input('name') : '';
           $phone = (!empty($request->input('phone'))) ? $request->input('phone') : '';
           $email = (!empty($request->input('email'))) ? $request->input('email') : '';
           $job_ref = (!empty($request->input('job_ref'))) ? $request->input('job_ref') : '';
           $best_time_contact = (!empty($request->input('best_time_contact'))) ? $request->input('best_time_contact') : '';
           $address = (!empty($request->input('address'))) ? $request->input('address') : '';
           $comments = (!empty($request->input('comments'))) ? $request->input('comments') : '';
           $recurring_job = (!empty($request->input('recurring_job'))) ? $request->input('recurring_job') : '';
           $recurring_job_type = (!empty($request->input('recurring_job_type'))) ? $request->input('recurring_job_type') : '';
           $estimate_status = (!empty($request->input('estimate_status'))) ? $request->input('estimate_status') : '';
           $is_gardening = (!empty($request->input('is_gardening'))) ? $request->input('is_gardening') : '';
           $is_removal_quote = (!empty($request->input('is_removal_quote'))) ? $request->input('is_removal_quote') : ''; 

           $white_goods = (!empty($request->input('white_goods'))) ? $request->input('white_goods') : '';
           $parking = (!empty($request->input('parking'))) ? $request->input('parking') : '';
           $have_removal = (!empty($request->input('have_removal'))) ? $request->input('have_removal') : '';
           $pets_property = (!empty($request->input('pets_property'))) ? $request->input('pets_property') : '';
           $lived_property = (!empty($request->input('lived_property'))) ? $request->input('lived_property') : '';
           $bond_amiming = (!empty($request->input('bond_amiming'))) ? $request->input('bond_amiming') : '';
           $client_type = (!empty($request->input('client_type'))) ? $request->input('client_type') : '';
           $lat_long = (!empty($request->input('lat_long'))) ? explode('__',$request->input('lat_long')) : '';
          

           $agency_name = (!empty($request->input('agency_name'))) ? $request->input('agency_name') : '';
           $agent_name = (!empty($request->input('agent_name'))) ? $request->input('agent_name') : '';
           $agent_number = (!empty($request->input('agent_number'))) ? $request->input('agent_number') : '';
           $agent_email = (!empty($request->input('agent_email'))) ? $request->input('agent_email') : '';
           $agent_landline_num = (!empty($request->input('agent_landline_num'))) ? $request->input('agent_landline_num') : '';
           $agent_address = (!empty($request->input('agent_address'))) ? $request->input('agent_address') : '';

            $latitude = (!empty($lat_long[0])) ? $lat_long[0] : 0;
            $longitude = (!empty($lat_long[1])) ? $lat_long[1] : 0;

            

           $tempStoreId = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
           //$temp_quote_id = session('temp_quote_id');
           

            $tempQuoteArr = [
                        'suburb' => $suburb,
                        'site_id' => $sitesid,
                        'booking_date' => $booking_date,
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email,
                        'job_ref' => $job_ref,
                        'referral_staff_name' => 0,
                        'quote_for' => $quotefor,
                        'address' => $address,
                        'login_id' => session('id'),
                        'comments' => $comments,
                    ];

         $affectedRows  = TempQuote::where('id', $tempStoreId)->update($tempQuoteArr);

        // echo  $tempStoreId .' == '.$affectedRows; die;

         if( isset ($affectedRows)) {

              $getPostCode =   DB::table('postcodes')->select('postcode')->where('suburb', $suburb)->where('site_id', $sitesid)->first();

               $postcode = (!empty($getPostCode->postcode)) ? $getPostCode->postcode : '';
               $ipaddress = $request->ip();
               $tempDetails = TempQuote::where('id',$tempStoreId)->first();

              
               $agentdetails = '';
               $quoteNewData = [
                    'suburb' => $suburb ?? null,
                    'estimate_status' =>$estimate_status,
                    'wall_wash' =>(!empty($wall_wash)) ? $wall_wash: 0,
                    'stages' =>2,
                    'real_estate_id' =>(!empty($realstatename)) ? $realstatename : '',
                    'site_id' =>$sitesid,
                    'white_goods' =>$white_goods,
                    'parking' =>$parking,
                    'have_removal' =>$have_removal,
                    'step' =>3,
                    'booking_date' =>$booking_date,
                    'name' =>$name,
                    'phone' =>$phone,
                    'recurring_job' =>$recurring_job,
                    'recurring_job_type' => $recurring_job_type,
                    'email' =>$email,
                    'job_ref' =>$job_ref,
                    'question_id' =>(!empty($question_ids)) ? $question_ids : '',
                    'client_type' =>$client_type,

                    'agency_name' =>(!empty($agency_name)) ? $agency_name: '',
                    'agent_name' =>(!empty($agent_name)) ? $agent_name: '',
                    'agent_number' =>(!empty($agent_number)) ? $agent_number: '',
                    'agent_email' =>(!empty($agent_email)) ? $agent_email: '',
                    'agent_landline_num' =>(!empty($agent_landline_num)) ? $agent_landline_num:  '',
                    'agent_address' =>(!empty($agent_address)) ? $agent_address:  '',

                    'pets_property' =>$pets_property,
                    'lived_property' =>$lived_property,
                    'bond_amiming' =>$bond_amiming,
                    'best_time_contact' =>$best_time_contact,

                    'moving_from' =>(!empty($tempDetails->moving_from)) ? $tempDetails->moving_from: '',
                    'moving_to' =>(!empty($tempDetails->moving_to)) ? $tempDetails->moving_to : '',

                    'is_flour_from' =>(!empty($tempDetails->is_flour_from)) ?  $tempDetails->is_flour_from : 0,
                    'is_flour_to' =>(!empty($tempDetails->is_flour_to)) ? $tempDetails->is_flour_to: 0,
                    'is_lift_from' =>(!empty($tempDetails->is_lift_from))  ? $tempDetails->is_lift_from : 0,
                    'house_type_from' =>(!empty($tempDetails->house_type_from)) ? $tempDetails->house_type_from : 0,
                    'door_distance_from' =>(!empty($tempDetails->door_distance_from)) ? $tempDetails->door_distance_from : 0,
                    'is_lift_to' =>(!empty($tempDetails->is_lift_to)) ? $tempDetails->is_lift_to : 0,
                    'house_type_to' =>(!empty($tempDetails->house_type_to)) ? $tempDetails->house_type_to : 0,
                    'door_distance_to' =>(!empty($tempDetails->door_distance_to)) ? $tempDetails->door_distance_to: 0,

                    'lat_from' =>$tempDetails->lat_from,
                    'long_from' =>$tempDetails->long_from,

                    'lat_to' =>$tempDetails->lat_to,
                    'long_to' =>$tempDetails->long_to,

                    'cubic_meter' =>$tempDetails->cubic_meter,
                    'is_gardening' =>(!empty($gardening_requirment)) ? $gardening_requirment : 0,
                    
                    'is_removal_quote' =>$is_removal_quote,
                    'address' =>$address,
                    'comments' =>$comments,
                    'date' =>date("Y-m-d"),
                    'amount' =>$tempDetails->amount,
                    'login_id' =>session('id'),
                    'ipaddress' =>$ipaddress,
                    'latitude' =>$latitude,
                    'longitude' =>$longitude,
                    
                    'postcode' =>$postcode,
                   
                    'quote_for' =>$quotefor,
                    
                    'depot_to_job_time' =>$tempDetails->depot_to_job_time,
                    'traveling' =>$tempDetails->traveling,
                    'travel_time' =>$tempDetails->travel_time,
                    
                    'loading_time' =>$tempDetails->travel_time,

            ];

                if (Session::has('quote_id')) {
                    QuoteNew::where('id', session('quote_id'))->update($quoteNewData);
                    $quoteid = session('quote_id');
                } else {
                    $quoteid = QuoteNew::insertGetId($quoteNewData);
                    $request->session()->put('quote_id', $quoteid);

                    if($client_type == 2) {
                        $agentdetails .= '<strong> Agency Name :</strong> '.$agency_name.' - <strong>Agent name => </strong>'.$agent_name.'</br>'.'<br/>===================<br/>';
                        $agentdetails .= '<strong> Agent Number :</strong> '.$agent_number.' - <strong>Agent email => </strong>'.$agent_email.'</br>'.'<br/>===================<br/>';
                        $agentdetails .= '<strong> Agent landline num : </strong>'.$agent_landline_num.' - <strong>Agent address => </strong>'.$agent_address.'</br>'.'<br/>===================<br/>';
                    }
                }

                

                $p_comment = '';
                if($pets_property !='') {
                    $pets_propertydata =  dd_value(29);
                $p_comment .= 'Pets on Property => '.$pets_propertydata[$pets_property].'<br/>';
                }
                if($lived_property !='') {
                    $lived_propertydata =  dd_value(120);
                $p_comment .= 'How long you have lived in the property? => '.$lived_propertydata[$lived_property].'<br/>';
                }
                if($bond_amiming !='') {
                    $bond_amimingdata =  dd_value(118);
                $p_comment .= 'How much Bond are we aiming to secure? => '.$bond_amimingdata[$bond_amiming].'<br/>';
                }
                if($best_time_contact !='') {
                   $p_comment .= 'Best time to contact => '.$best_time_contact.'<br/>';
                }

                // Quote_new/Quote_details
                $CheckquoteId = (!empty($request->session()->get('quote_id'))) ? $request->session()->get('quote_id') : '';
                if (!empty($CheckquoteId)) {
                    QuoteDetails::where('quote_id',session('quote_id'))->delete();
                }else{
                   
                    TempQuote::where('id', $tempStoreId)->update(['quote_id' => $quoteid]);

                    $Taskdata = [];
                    $Taskdata['site_id'] = $sitesid;
                    $Taskdata['quote_id'] = $quoteid;
                    $Taskdata['job_id'] = 0;
                    $Taskdata['track_type'] = 1;
                    $Taskdata['task_type'] = 'sales';
                    $this->createTaskTrack($Taskdata);
                }


                if($agentdetails != '') {
                    $reheading = 'RealEstate Agent Details';
                    $this->add_quote_notes($quoteid,$reheading,$agentdetails);
                }

                 $getTempDetails = TempDetails::where('temp_quote_id',$tempStoreId)->get();

                if(!empty($getTempDetails)) {

                    $comment = '';

                    foreach($getTempDetails as $key=>$r) {

                        $admin_oto = $r->admin_oto;
                        $oto_admin_discount = $r->oto_admin_discount;
                        $oto_amt_show = $r->oto_amt_show;

                        QuoteDetails::insert([
                            'quote_id' => $quoteid,
                            'oto_amt_show' => $oto_amt_show,
                            'admin_oto' => $admin_oto,
                            'oto_admin_discount' => $oto_admin_discount,
                            'cust_truck_hours_amount' => $r->cust_truck_hours_amount,
                            'removal_desc' => $r->removal_desc,
                            'discount' => $r->discount,
                            'truck_type_id' => $r->truck_type_id,
                            'amount' => $r->amount,
                            'blinds_numbers' => $r->blinds_numbers,
                            'hours' => $r->hours,
                            'rate' => $r->rate,
                            'job_type_id' => $r->job_type_id,
                            'job_type' => $r->job_type,
                            'booking_date' => $r->booking_date,
                            'bed' => $r->bed,
                            'study' => $r->study,
                            'bath' => $r->bath,
                            'stairs' => $r->stairs,
                            'removal_inventory' => $r->removal_inventory,
                            'lounge_hall' => $r->lounge_hall,
                            'kitchen_dining' => $r->kitchen_dining,
                            'kitchen' => $r->kitchen,
                            'office' => $r->office,
                            'garage' => $r->garage,
                            'origanl_total_time' => $r->origanl_total_time,
                            'origanl_cubic' => $r->origanl_cubic,
                            'origanl_total_amount' => $r->origanl_total_amount,
                            'lift_property' => $r->lift_property,
                            'quote_floor' => $r->quote_floor,
                            'stains' => $r->stains,
                            'depot_to_job_time' => $r->depot_to_job_time,
                            'travel_time' => $r->travel_time,
                            'traveling' => $r->traveling,
                            'loading_time' => $r->loading_time,
                            'truck_id' => $r->truck_id,
                            'laundry' => $r->laundry,
                            'box_bags' => $r->box_bags,
                            'dining_room' => $r->dining_room,
                            'travelling_hr' => $r->travelling_hr,
                            'cubic_meter' => $r->cubic_meter,
                            'working_hr' => $r->working_hr,
                            'toilet' => $r->toilet,
                            'living' => $r->living,
                            'furnished' => $r->furnished,
                            'property_type' => $r->property_type,
                            'blinds_type' => $r->blinds_type,
                            'quote_auto_custom' => $r->quote_auto_custom,
                            'carpet_stairs' => $r->carpet_stairs,
                            'pest_inside' => $r->pest_inside,
                            'pest_outside' => $r->pest_outside,
                            'pest_flee' => $r->pest_flee,
                            'description' => $r->description,
                        ]);

                        $comment .= '<strong>' . $r->job_type . ' - </strong> $' . $r->amount . '</br>' . $r->description . '<br/><strong> Quoted for ' . $r->hours . ' hours labor (min. rate), any extra hour will be $' . $r->rate . '/hour /cleaner </strong></br>===================<br/>';
                    }


                    if($p_comment != '') {
                        $p_heading = 'Property Description ';
                        $this->add_quote_notes($quoteid,$p_heading,$p_comment);
                    }
                    
                    $heading = 'Job type Description ';
                    $this->add_quote_notes($quoteid,$heading,$comment);
                }
     
            return response()->json(['quote_id'=>$quoteid], 200);

         }
    }
 
    function viewEmailQuote(Request $request)
    {

         $quote_id = $request->input('quote_id');
         $type = $request->input('type');
         $staffid = $request->input('staffid');
         
        // $quoteInfo = QuoteNew::where('id', $quote_id)->first();

         //echo $quote_id;
        if ($quote_id != "") 
        {
            $quote = QuoteNew::find($quote_id);

            // dd($quote);

            if ($quote) {
                
                $siteId = $quote->site_id;
                $site =  ($siteId > 0) ?  Sites::find($siteId) : [];
                $details['site'] = (!empty($site)) ? $site->toArray() : [];

                $quoteType = QuoteFor::find($quote->quote_for);
                $jobTypeDetails = QuoteDetails::where('quote_id', $quote_id)
                                              ->pluck('job_type_id')
                                              ->toArray();

                $details = $quote->toArray();
                
                $quote_for_type = $quoteType->toArray();

                $details['qc_company_name'] = $quote_for_type['company_name'];
                $details['qc_company_name_html'] = $quote_for_type['company_name_html'];
                $details['qc_booking_email'] = $quote_for_type['booking_email'];
                $details['qc_site_url'] = $quote_for_type['site_url'];
                $details['qc_bsb'] = $quote_for_type['bsb'];


                $details['job_types'] = $jobTypeDetails;
                
                $siteUrl1 =  'https://www.bcic.com.au'; //config('app.url');

                if ($quote->quote_for == 3) {
                    $details['site_url'] = $site->br_domain;
                    $details['term_condition_link'] = $site->br_term_condition_link;
                    $details['inclusion_link'] = $site->br_inclusion_link;
                    $details['site_logo'] = $siteUrl1 . '/' . get_rs_value("siteprefs", "bcic_new_logo", 1);
                } elseif (in_array($quote->quote_for, [2, 4])) {
                    $details['site_url'] = $quoteType->site_url;
                    $details['term_condition_link'] = $quoteType->term_condition_link;
                    $details['inclusion_link'] = $quoteType->inclusion_link;
                    $details['site_logo'] = $quote->quote_for == 2 ? $quoteType->company_logo : $siteUrl1 . '/' . $quoteType->logo_name;
                } else {
                    $details['site_url'] = $site->domain;
                    $details['term_condition_link'] = $site->term_condition_link;
                    $details['inclusion_link'] = $site->inclusion_link;
                    $details['site_logo'] = $siteUrl1 . '/' . get_rs_value("siteprefs", "bcic_new_logo", 1);
                }

                $details['site_email'] = (!empty($site->email)) ? $site->email : '';
                if (in_array(11, $jobTypeDetails)) {
                    $details['site_phone'] = '1300 766 422';
                } else {
                    $details['site_phone'] = $quote->quote_for == 2 ? '1300 838 722' : $site->phone;
                }

                $details['to'] = $quote->name . "<br>" . $quote->address . "<br>" . $quote->phone;

                $quoteDetails = QuoteDetails::where('quote_id', $quote_id)
                                           ->where('job_type_id', '!=', 20)
                                           ->orderBy('job_type_id')
                                           ->get();

                $details['oto_amt_show_text'] = '';
                $qudiscount = 0;

                $jobDecData = [];

                foreach ($quoteDetails as $r) {
                     
                    $r->amount = (!empty($r->amount)) ? $r->amount : 0;
                    
                    $qu_id = base64_encode($quote->id);
                    $url = $siteUrl1 . "/members/" . $qu_id . "/inventory";

                    //print_r($r);

                    if (($r->admin_oto != 0 && $r->job_type_id == 1) && ($r->oto_amt_show == '0')) {
                        $adminDetails = C3cxUser::select('phone_number')->where('adminid', $details['login_id'])->first();
                        $mobileNumber = $adminDetails ? $adminDetails->phone_number : $details['site_phone'];
                        $details['oto_amt_show_text'] = 'Exclusive OTO Offer! Call <a href="tel:' . $mobileNumber . '" style="font-size: 13px;">' . $mobileNumber . '</a>  within 30 mins and unlock up to an extra 10% off on your booking!';
                    }

                          $ramount =  (!empty($r->amount)) ? (float) $r->amount : 0;
                        if ($r->job_type_id == 11) {
                            $truckList = TruckList::find($r->truck_type_id);
                            $bcic_amount = (!empty($truckList->amount)) ? (float) $truckList->amount : 0;
                            $truck_type_name = $truckList->truck_name;
                            $cubic_meter = $truckList->cubic_meter;

                            $details['site_url'] = $site->br_domain;
                            $details['br_term_condition_link'] = $site->br_term_condition_link;
                            $details['br_inclusion_link'] = $site->br_inclusion_link;
                            $heading_text = 'Better Removal';

                            $descrption = $r->description.'<br><strong>From :</strong> '.$quote->moving_from.' , <strong><br>To :</strong> '.$quote->moving_to;
                            $jobDecData[$r->job_type] = ['desc'=>$descrption,'amount'=>$ramount];
                        } else{
                            $jobDecData[$r->job_type] = ['desc'=> $r->description,'amount'=> $ramount];
                        }
                        
                       
                         $jobDecData[$r->job_type]['amount'] = $r->amount;

                        if ((!empty($r->discount) && $r->oto_amt_show == 0) && ($r->job_type_id == 1)) {
                            $amount = (float) $r->amount;
                            $qudiscount = (float) $r->discount;
                            $totaldisAmt = ($amount + $qudiscount);
                            $jobDecData[$r->job_type]['amount'] = $totaldisAmt; 

                            $jobDecData['Discount'] = [
                                'desc' => '',  // Assuming this should be 'desc' => ''
                                'amount' => '-'. $r->discount  // Assuming $r->discount contains the discount amount
                            ];


                        } elseif ((!empty($r->discount)  && $r->oto_amt_show == 1) && ($r->job_type_id == 1)) {
                            $qudiscount = (float) $r->discount;
                            $amount = (float) $r->amount;
                            $oto_admin_discount = (float) $r->oto_admin_discount;
                            $totalAmt = ($amount + $qudiscount + $oto_admin_discount);

                            $jobDecData[$r->job_type]['amount'] = $totalAmt;

                            $jobDecData['Discount'] = ['desc'=>'','amount'=> '-'. $r->discount];
                            $jobDecData['OTO Discount'] = ['desc'=>'','amount'=>'-'.$r->oto_admin_discount];

                        } elseif ((empty($r->discount) && $r->oto_amt_show == 1) && ($r->job_type_id == 1)) {
                            $amount = (float) $r->amount;
                            $oto_admin_discount = (float) $r->oto_admin_discount;
                            $totalAmt = ($amount + $oto_admin_discount);
                            $jobDecData[$r->job_type]['amount'] = $totalAmt;
                            $jobDecData['OTO Discount'] = ['desc'=>'','amount'=>'-'.$r->oto_admin_discount];

                        } else {
                            
                            $jobDecData[$r->job_type]['amount'] = (float)$r->amount;
                            if($r->job_type_id != 11) {
                              $jobDecData[$r->job_type] = ['desc'=> $r->description,'amount'=> (float) $r->amount];
                            }
                        }
                }

              
                // dd($jobDecData);
          
                $details['url'] =   (!empty($url)) ? $url : '';
                $checkQUotetype  = $details['job_types'];
                if (in_array(11, $checkQUotetype)) {
                    $heading_text = 'Better Removal';
                    $getemailNotes1 = QuoteEmailNote::where('emal_type', 'email_quote')
                                                    ->where('quote_for_type_id', 3)
                                                    ->first();
                } elseif (in_array(25, $checkQUotetype)) {
                    $heading_text = ' Domestic Cleaning';
                    $getemailNotes = JobType::select('id', 'quote_notes as notes')
                                            ->where('id', 25)
                                            ->first();
                    $details['site_url'] = 'https://www.bettercleaning.com.au';
                    $details['term_condition_link'] = 'https://www.bettercleaning.com.au/terms-and-conditions/';
                } elseif (in_array(4, $checkQUotetype)) {
                    $heading_text = ' Gardening Cleaning';
                    $getemailNotes = JobType::select('id', 'quote_notes as notes')
                                            ->where('id', 4)
                                            ->first();
                    $details['site_url'] = 'https://www.betterlawnmowing.com.au/';
                    $details['term_condition_link'] = 'https://www.betterlawnmowing.com.au/terms-and-conditions/';
                } else {
                    $getemailNotes = QuoteEmailNote::where('emal_type', 'email_quote')
                                                   ->where('quote_for_type_id', $details['quote_for'])
                                                   ->first();
                    $heading_text = 'Bond Cleaning';
                }

                if(!in_array(11, $checkQUotetype)) {
                        $inclusionLink = "<a  style='color: red;'  href='{$details['inclusion_link']}' target='_blank'>Here</a>";
                        $rTc = '<a style="color: red;" href="'.$details['term_condition_link'].'" target="_blank">Terms & Conditions</a>';
                        $url = '<a style="color: red;"  href="'.$details['url'].'" target="_blank">Click</a>';

                        $search = ['$inclusion', '$tc', '$inventory'];
                        $replace = [$inclusionLink, $rTc, $url];

                        $newString = $getemailNotes['notes'];
                        $resultString = str_replace($search, $replace, $newString);
                }else{
                        $inclusionLink = "<a  style='color: red;'  href='{$details['inclusion_link']}' target='_blank'>Here</a>";
                        $rTc = '<a style="color: red;" href="'.$details['term_condition_link'].'" target="_blank">Terms & Conditions</a>';
                        $url = '<a style="color: red;"  href="'.$details['url'].'" target="_blank">Click</a>';

                        $search1 = ['$inclusion', '$tc', '$inventory'];
                        $replace1 = [$inclusionLink, $rTc, $url];

                        $newString1 = $getemailNotes1['notes'];
                        $resultString = str_replace($search1, $replace1, $newString1);
                }

                if($type == 1) {
                    //print_r($details); die;
                    $subject =  ucfirst($details['name']).", Please Check Your ".$heading_text." Quote Q#".$quote_id." from ".$details['site_url']."";
                   $emailStatus =  Mail::to('pankaj.business2sell@gmail.com')->send(new ViewQuoteMmail($checkQUotetype, $details, $resultString, $jobDecData , $subject));
                    return response()->json(['message' => 'Quote Email Send Successfully']);
                }else{
                    $emailData = ['checkQUotetype'=>$checkQUotetype, 'details' => $details,  'getemailNotes' => $resultString,'jobDecData'=>$jobDecData];
                    return response()->json($emailData);
                }

            }  
        }
         
     }

     function LostQuote(Request $request) {
   
            if($request->isXmlHttpRequest()) {
                $quote_id = $request->input('quote_id');

                QuoteNew::where('id', $quote_id)->update(['step'=>5]);
                $heading = "Lost quote on create quote page";
                $this->add_quote_notes($quote_id,$heading,$heading);
                return response()->json(['message' => 'quote moved to lost ']);
            }

            return response()->json(['message' => 'Invalid request'], 400);
     }

     function getAdmindata(Request $request){
        $admindata = $this->GetAdmin();
        return response()->json($admindata);
     }

     function editFields(Request $request) {
       
            if($request->isXmlHttpRequest()) {

                    $value = $request->input('value');
                    $id = $request->input('quote_id');
                    $field_name = $request->input('field_name');

                    $vars = explode('.', $field_name);

                    $table = $vars[0];
                    $field = $vars[1];

                    if($field_name === 'quote_new.login_id'){
                        $quote_id = $id;
                        QuoteNew::where('id', $quote_id)->update(['login_id'=>$value]);
                        $booking_id1 = QuoteNew::where('id', $quote_id)->value('booking_id');
                        $qname = DB::table('admin')->where('id', $value)->value('name');

                        if ($booking_id1 == 0) {
                            $track_type = 1;
                            $heading = "Quote Assign to " . $qname;
                            $this->add_quote_notes($quote_id, $heading, $heading);
                        } else {
                            $track_type = 2;
                            $heading = "Quote Assign to " . $qname;
                            $this->add_job_notes($booking_id1, $heading, $heading);
                        }


                        $bool1 = SalesTaskTrack::where('quote_id', $quote_id)
                            ->where('track_type', $track_type)
                            ->update(['task_manage_id' => $value]);

                            TaskManager::insert([
                            'completed_date' => now(),
                            'admin_id' => Session::get('id'),
                            'task_type' => $track_type,
                            'quote_id' => $quote_id,
                            'job_id' => $booking_id1,
                            'response_type' => 16,
                            'task_id' => 0,
                            'created_date' => now(),
                            'status' => 0,
                        ]);
                       return response()->json(['value_id' => $value, 'message'=>$heading]); 


                    }else  if($table=="temp_quote_details" && ($field=="quote_auto_custom")) { 
                    
                        TempDetails::where('id',$id)->update([$field=>$value]);
                        $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                        $getData = $this->create_quote_str($temp_quote_id); 
                        return response()->json($getData, 200);
                    
                    }else  if($table=="temp_quote_details" && ($field=="amount")) { 
                    
                        TempDetails::where('id',$id)->update([$field=>$value]);
                        $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                        $getData = $this->create_quote_str($temp_quote_id); 
                        return response()->json($getData, 200);
                    
                    }else  if($table=="temp_quote_details" && ($field=="description")) { 
                    
                        TempDetails::where('id',$id)->update([$field=>$value]);
                        $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                        $getData = $this->create_quote_str($temp_quote_id); 
                        return response()->json($getData, 200);
                    
                    }else  if($table=="temp_quote_details" && ($field=="hours" || $field=="rate" || $field=="discount")) { 

                        TempDetails::where('id',$id)->update([$field=>$value]);
		
                        $temp_quote_details = TempDetails::select('id','hours','amount','rate','oto_admin_discount','discount')->where('id', $id)->first(); 
                        
                        $amount = ($temp_quote_details->hours * $temp_quote_details->rate);

                        
                            if($field == 'discount') {
                                 
                                 $amount = ((float) $amount - (float) $temp_quote_details->oto_admin_discount);
                                 
                                  $amount = $amount - $value;
                                  $otoDisc = ($amount*10)/100;
                                 
                                 if($otoDisc < 40) {
                                     $otoDisc = $otoDisc;
                                 }else{
                                     $otoDisc = 40;
                                 }
                            }else{
                                $otoDisc = $temp_quote_details->oto_admin_discount;
                                $amount = ((float) $amount - (float) $temp_quote_details->discount);
                            }

                        TempDetails::where('id',$id)->update(['amount'=>$amount, 'oto_admin_discount'=>$otoDisc ]);
                       // return response()->json(['amount' => $amount, 'otoDisc'=>$otoDisc]); 
                        $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                       $getData = $this->create_quote_str($temp_quote_id); 
                       return response()->json($getData, 200);

                    } else if($table=="temp_quote_details" && $field=="admin_oto") {
		                  
                                TempDetails::where('id',$id)->update([$field=>$value]);

                                $qdetails = TempDetails::select('id','hours','rate','amount','oto_admin_discount','discount')->where('id', $id)->first()->toArray(); 
                            
                                if($value == 1) {
                                    $newAmt =  ( (float) $qdetails['amount']);
                                    $otoDisc = ($newAmt*10)/100;
                                    
                                    if($otoDisc < 40) {
                                        $otoDisc = $otoDisc;
                                    }else{
                                        $otoDisc = 40;
                                    }
                                    
                                    $amountNew = $newAmt;  
                                        
                                }else{
                                    $otoDisc = 0;
                                    $amountNew = (($qdetails['hours']*$qdetails['rate']) - $qdetails['discount'] );	
                                }
                            
                                    TempDetails::where('id', $id)
                                                ->update([
                                                    $field => $value,
                                                    'oto_amt_show' => 0,
                                                    'amount' => $amountNew,
                                                    'oto_admin_discount' => $otoDisc
                                                ]);

                        $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                        $getData = $this->create_quote_str($temp_quote_id); 
                        return response()->json($getData, 200);

                    }else if($table=="temp_quote_details" && ($field=="oto_amt_show" || $field=="oto_admin_discount")){
		      
                        TempDetails::where('id',$id)->update([$field=>$value]);
                        $temp_quote_details = TempDetails::select('id','hours','rate','amount','oto_admin_discount','discount')->where('id', $id)->first()->toArray(); 

                       if($field=="oto_admin_discount") {
                           
                           $newAmt =  ((($temp_quote_details['hours']*$temp_quote_details['rate']) - (float) $temp_quote_details['discount'] ) - (float) $value );  //$temp_quote_details['amount'] - $value;
                           TempDetails::where('id',$id)->update(['amount'=>$newAmt]);
                       }else {
                           
                           if($value == 1) {
                              $newAmt =  ( (float) $temp_quote_details['amount'] - (float) $temp_quote_details['oto_admin_discount'] );
                              TempDetails::where('id',$id)->update(['oto_amt_show'=>$value , 'amount'=>$newAmt  ]);
                           }else{
                                $amountNew = (($temp_quote_details['hours']*$temp_quote_details['rate']) - (float) $temp_quote_details['discount'] );
                               TempDetails::where('id',$id)->update(['oto_amt_show'=>$value , 'amount'=>$amountNew  ]);
                           }
                       }

                       $temp_quote_id = (!empty($request->session()->get('temp_quote_id'))) ? $request->session()->get('temp_quote_id') : '';
                       $getData = $this->create_quote_str($temp_quote_id); 
                       return response()->json($getData, 200);

                    }
            }
           return response()->json(['message' => 'Invalid request'], 400);
     }

    function showQuoteQestion(Request $request) {

          $quote_id = $request->input('quote_id');
          $question_ids = explode(',', get_rs_value('quote_new', 'question_id', $quote_id));

            // $quote_details = DB::table('quote_details')
            //     ->select('job_type_id')
            //     ->where('quote_id', $quote_id)
            //     ->orderBy('id', 'ASC')
            //     ->first();

            $cond =  1;  //$quote_details->job_type_id == 11 ? 2 : 1;

            $qry_quote_questions = DB::table('quote_question')
                ->where('status', 1)
                ->where('quote_type', $cond)
                ->get();

            return response()->json([
               // 'quote_details' => $quote_details,
                'question_ids' => $question_ids,
                'quote_questions' => $qry_quote_questions
            ]);

    }

    public function saveQuoteQuestions(Request $request)
    {
        
        $quote_id = $request->input('quote_id');
        $question_ids = $request->input('questionids');
        $quote_type = (!empty($request->input('quote_type'))) ? $request->input('quote_type') : 1;

        //$question_ids = explode(',', $question_id);

        if(!empty($question_ids)) 
        {
                 $question_id = implode(',', $question_ids);

                    $admin = Auth::user()->name;

                    if ($quote_type == 3) {
                        $table_name = 'jobs';
                        $id = QuoteNew::where('id', $quote_id)->value('booking_id');
                    } else {
                        $table_name = 'quote_new';
                        $id = $quote_id;
                    }

                    DB::table($table_name)->where('id', $id)->update(['question_id' => $question_id]);

                    SaveQuoteQuestion::where('quote_id', $quote_id)->where('status', 1)->update(['status' => 0]);

                    foreach ($question_ids as $q_id) {
                        $quote_question =  DB::table('quote_question')->select('quote_type','question')->where('id', $q_id )->first();  //QuoteQuestion::find($q_id);
                        if ($quote_question) {
                            SaveQuoteQuestion::insert([
                                'quote_id' => $quote_id,
                                'quote_type' => $quote_question->quote_type,
                                'quote_question' => $quote_question->question,
                                'question_id' => $q_id,
                                'date' => now(),
                                'status' => 1,
                                'admin' => $admin
                            ]);
                        }
                    }

            return response()->json([
                'message' => 'Quote question added successfully',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Please checked question',
                'status' => 404
            ]);
        }
    }

    function CheckAvailability(Request $request) {

        if($request->isXmlHttpRequest()) {
    
             $suburb = $request->input('suburb');
             $site_id = $request->input('site_id');
             $booking_date = $request->input('booking_date');
             $quote_for = $request->input('quote_for');
             $get_quote_id = $request->input('get_quote_id');
             $quote_type = $request->input('quote_type');
             $getjob_type_id = 0;
 
              // dd($request->all());

                    $startDate = Carbon::createFromFormat('Y-m-d', $booking_date)->subDays(2);
                    $endDate = Carbon::createFromFormat('Y-m-d', $booking_date)->addDay(2);
                    
                    $dates = [];
                    
                    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                        $dates[] = [
                            'dateName' => $date->format('dS M Y'),
                            'dayName' => $date->format('l'), // Using Carbon's format method
                            'dayFormate' => $date->format('Y-m-d'), // Using Carbon's format method
                        ];
                    }
              
      
              $jobtype = 'Cleaning';
      
              $getPostCode = DB::table('postcodes')
                  ->select('postcode', 'region', 'postcode')
                  ->where('suburb', 'like', '%' . $suburb . '%')
                  ->where('site_id', $site_id)
                  ->limit(1)
                  ->first();
      
              $staffQuery = DB::table('staff')
                  ->where('status', 1)
                  ->where(function ($query) use ($site_id) {
                      $query->where('site_id', $site_id)
                            ->orWhere('site_id2', $site_id)
                            ->orWhereRaw('FIND_IN_SET(?, all_site_id)', [$site_id]);
                  })
                  ->where('no_work', 1)
                  ->whereRaw('FIND_IN_SET(?, job_types)', [$jobtype])
                  ->orderBy('staff_member_rating', 'desc');
      
              if ($quote_for > 0) {
                  $staffQuery->where('better_franchisee', $quote_for);
              }
      
              $staff = $staffQuery->get();
              $totalCount = $staff->count();
      
              return response()->json([
                  'totalCount' => $totalCount,
                  'staffTable' => $staff,
                  'getPostCode' => $getPostCode,
                  'quote_for' => $quote_for,
                  'site_id' => $site_id,
                  'dates' => $dates,
                  'getjob_type_id' => $getjob_type_id,
                  'get_quote_id' => $get_quote_id,
                  'suburb' => $suburb,
              ]);
             
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
    function getStaffAvail(Request $request) {

       
        
        $staffId = $request->query('staffid');
        $sdateStaff = $request->query('jobdate');
        $getJobTypeId = 1; //$request->query('getJobTypeId');

        

        $result = [];
       
            if ($getJobTypeId != 11) {

                $jobs = DB::table('job_details')
                    ->where('status', '!=', 2)
                    ->where('staff_id', $staffId)
                    ->whereDate('job_date', $sdateStaff)
                    ->whereIn('job_id', function ($query) {
                        $query->select('id')
                              ->from('jobs')
                              ->whereIn('status', [1, 3, 4]);
                    })
                    ->groupBy('job_id')
                    ->get();

                    $queries = DB::getQueryLog();
                    dd($queries);

            } else {
                $substaffIds = DB::table('staff_trucks')
                    ->where('staff_id', $staffId)
                    ->pluck('id')
                    ->toArray();
                
                $jobs = DB::table('job_details')
                    ->where('status', '!=', 2)
                    ->where('staff_id', $staffId)
                    ->whereIn('staff_truck_id', $substaffIds)
                    ->whereDate('job_date', date("Y-m-d", $sdateStaff))
                    ->whereIn('job_id', function ($query) {
                        $query->select('id')
                              ->from('jobs')
                              ->whereIn('status', [1, 3, 4]);
                    })
                    ->groupBy('job_id')
                    ->get();
            }


            

            foreach ($jobs as $job) {
                $quote = DB::table('quote_new')->where('booking_id', $job->job_id)->first();
                $jobStatus = DB::table('jobs')->where('id', $job->job_id)->value('status');
                $jobPayment = DB::table('job_payments')
                    ->where('job_id', $job->job_id)
                    ->where('deleted', 0)
                    ->sum('amount');
                $jobDetailsAmount = DB::table('job_details')
                    ->where('job_type_id', 1)
                    ->where('job_id', $job->job_id)
                    ->where('status', '!=', 2)
                    ->sum('amount_total');

                $paymentStatus = $this->getPaymentStatus($jobPayment, $jobDetailsAmount);
                
                $jobDetails = DB::table('job_details')
                    ->where('job_id', $job->job_id)
                    ->where('status', '!=', 2)
                    ->get();
                
                foreach ($jobDetails as $jdetail) {
                    $staff = DB::table('staff')->where('id', $jdetail->staff_id)->first();
                    $jobIcon = DB::table('job_type')->where('job_type_id', $jdetail->job_type_id)->value('job_icon');
                    
                    $result[] = [
                        'job_id' => $job->job_id,
                        'name' => $quote->name,
                        'suburb' => $quote->suburb,
                        'payment_status' => $paymentStatus,
                        'job_icon' => $jobIcon,
                        'staff' => [
                            'name' => $staff->name,
                            'mobile' => $staff->mobile
                        ],
                        'date' => $quote->date
                    ];
                }
            }


        return response()->json($result);

    }


    function ViewQuote(Request $request) {
 
       
          return view('view-quote.view_quote');
    }

    
        function getquoteData(Request $request) {
            
                $searchValue = $request->input('search_value', '');
                $taskAction = $request->input('task_action', '');
                $quoteFor = $request->input('quote_for', 0);
                $jobType = $request->input('job_type', 0);
                $siteId = $request->input('site_id', 0);
                $jobStatus = $request->input('job_status', 0);
                $jobRef = $request->input('quote_ref', '');
                $quoteType = $request->input('quote_type', 0);
                $fromDate = $request->input('from_date', '');
                $toDate = $request->input('to_date', '');
                $quoteStatus = $request->input('quote_status', 0);
                $loginId = $request->input('login_id', 0);
            
                // Build the query
                $query = QuoteNew::select(
                    'id', 'site_id', 'booking_id', 'job_ref', 'date', 'name', 'email', 'phone', 'suburb', 'postcode', 'address',
                    'booking_date', 'status', 'login_id', 'deleted', 'step', 'createdOn', 'response', 'quote_for', 'amount', 'time',
                    'parking', 'new_mobile', 'question_id', 'enquiry_data', 'qus_key_id', 'denied_id', 'quote_created_type', 
                    'api_quote', 'best_time_contact', 'created_for'
                )
                ->where('step', '!=', 10)
                ->where('bbcapp_staff_id', 0);
            
                // Apply filters
                if ($quoteFor > 0) {
                    $query->where('quote_for', $quoteFor);
                }
            
                if (!empty($taskAction)) {
                    $query->where('step', $taskAction);
                } elseif ($quoteStatus > 0) {
                    $query->where('step', $quoteStatus);
                }
            
                if ($siteId > 0) {
                    $query->where('site_id', $siteId);
                }
            
                if ($loginId > 0) {
                    $query->where('login_id', $loginId);
                }
            
                if (!empty($jobRef)) {
                    $query->where('job_ref', $jobRef);
                }
            
                if ($quoteType > 0 && $fromDate && $toDate) {
                    if ($quoteType == 1) {
                        $query->whereBetween('date', [$fromDate, $toDate]);
                    } elseif ($quoteType == 2) {
                        $query->whereBetween('booking_date', [$fromDate, $toDate]);
                    } elseif ($quoteType == 3) {
                        $query->whereBetween('quote_to_job_date', [$fromDate, $toDate]);
                    }
                }
            
                if (!empty($searchValue)) {
                    $query->where(function ($subQuery) use ($searchValue) {
                        $subQuery->where('name', 'LIKE', '%' . $searchValue . '%')
                            ->orWhere('id', 'LIKE', '%' . $searchValue . '%')
                            ->orWhere('booking_id', 'LIKE', '%' . $searchValue . '%')
                            ->orWhere('phone', 'LIKE', '%' . $searchValue . '%')
                            ->orWhere('email', 'LIKE', '%' . $searchValue . '%');
                    });
                }
            
                if ($jobType > 0) {
                    if ($jobType != 9) {
                        $query->whereIn('id', function ($subQuery) use ($jobType) {
                            $subQuery->select('quote_id')->from('quote_details')->where('job_type_id', $jobType);
                        });
                    } else {
                        $query->whereIn('id', function ($subQuery) {
                            $subQuery->select('quote_id')->from('quote_details')->whereNotIn('job_type_id', [1, 2, 3, 11, 8]);
                        });
                    }
                }
            
                $quoteDetails = $query->orderBy('id', 'DESC')->paginate(30);
            
                // Process results
                $data1 = [];
                if ($quoteDetails->isNotEmpty()) {
                    $today = Carbon::today()->format('Y-m-d');
                    $getPhone = $this->checkDoublePhoneNumber($today);
                    foreach ($quoteDetails as $quoteInfo) {
                        $quoteDesc = $quoteInfo->booking_id == 0 
                            ? QuoteDetails::select('job_type_id', 'job_type')->where('status', 0)->where('quote_id', $quoteInfo->id)->get() 
                            : JobDetail::select('job_type_id', 'job_type')->where('status', 0)->where('job_id', $quoteInfo->booking_id)->get();
                        
                        $adminName = get_rs_value('admin', 'name', $quoteInfo->login_id);
                        $className = '';
            
                        if ((in_array($quoteInfo->phone, $getPhone) || in_array($quoteInfo->email, $getPhone)) && $quoteInfo->booking_id == 0) {
                            $className = 'alert_duplicate_danger_tr';
                        } else {
                            if ($quoteInfo->booking_id != 0) {
                                $className = 'alert_danger_success';
                            } elseif (in_array($quoteInfo->step, [5, 6, 7])) {
                                $className = 'alert_danger_tr';
                            } elseif ($quoteInfo->response == '3') {
                                $className = 'alert_warning';
                            }
                        }
            
                        $data1[] = [
                            'id' => $quoteInfo->id,
                            'className' => $className,
                            'site_id' => $quoteInfo->site_id,
                            'booking_id' => $quoteInfo->booking_id,
                            'job_ref' => $quoteInfo->job_ref,
                            'quoteDesc' => $quoteDesc,
                            'date' => date('dS M Y', strtotime($quoteInfo->date)),
                            'name' => $quoteInfo->name,
                            'email' => $quoteInfo->email,
                            'phone' => $quoteInfo->phone,
                            'suburb' => $quoteInfo->suburb,
                            'postcode' => $quoteInfo->postcode,
                            'address' => $quoteInfo->address,
                            'booking_date' => ($quoteInfo->booking_date != '0000-00-00') ? date('dS M Y', strtotime($quoteInfo->booking_date)) : '',
                            'status' => $quoteInfo->status,
                            'login_id' => $quoteInfo->login_id,
                            'adminname' => $adminName,
                            'deleted' => $quoteInfo->deleted,
                            'step' => $quoteInfo->step,
                            'createdOn' => ($quoteInfo->createdOn != '0000-00-00') ? date('h:i A', strtotime($quoteInfo->createdOn)) : '',
                            'response' => $quoteInfo->response,
                            'quote_for' => $quoteInfo->quote_for,
                            'amount' => $quoteInfo->amount,
                            'time' => $quoteInfo->time,
                            'parking' => $quoteInfo->parking,
                            'new_mobile' => $quoteInfo->new_mobile,
                            'question_id' => $quoteInfo->question_id,
                            'enquiry_data' => $quoteInfo->enquiry_data,
                            'qus_key_id' => $quoteInfo->qus_key_id,
                            'denied_id' => $quoteInfo->denied_id,
                            'quote_created_type' => $quoteInfo->quote_created_type,
                            'api_quote' => $quoteInfo->api_quote,
                            'best_time_contact' => $quoteInfo->best_time_contact,
                            'created_for' => $quoteInfo->created_for,
                        ];
                    }
                }
            
                $currentPage = $quoteDetails->currentPage();
                $lastPage = $quoteDetails->lastPage();
                $totalCount = $quoteDetails->total();
            
                $quoteInfo = [
                    'quoteDetails' => $data1,
                    'currentPage' => $currentPage,
                    'lastPage' => $lastPage,
                    'total_count' => $totalCount
                ];
            
                return response()->json($quoteInfo);
            }
    

     function getSideQuote(Request $request) {
            
                 $quote_id = $request->input('quote_id');
                 $quoteInfo = QuoteNew::select('id','site_id', 'login_id', 'quote_for', 'response', 'booking_id', 'reply_status', 'name', 'email', 'phone', 'step', 'amount', 'inv_sms_date', 'inv_email_date', 'quote_for')->where('id',$quote_id)->first();
                 
                 $sitePhone = $quoteInfo->site_id;

                 return response()->json($quoteInfo);
     }

    function getddValue(Request $request) {
         
         $ids = $request->input('ddids');
         $getData =  dd_in_value($ids);
         return response()->json($getData);
    }

    function getQuoteNotes(Request $request) {
 
        $quote_id = $request->input('quote_id');
        $notes = DB::table('quote_notes')->where('quote_id', $quote_id)->orderBy('createdOn', 'desc')->get();
        return response()->json($notes);
    } 

    function addQuoteNotes(Request $request) {

        // dd($request->all());
        $quote_id = $request->input('quote_id');
        $comment = $request->input('comment');

        if($comment != '') {
                $heading = 'Add Quote Notes';
                $this->add_quote_notes($quote_id,$heading,$comment);
        }
        $notes = $this->getQuoteNotes($request);
        return $notes;
    }

    function SemdCustomeSMS(Request $request) {
        
            dd($request->all());

    }


    function addFaultNotes(Request $request) {

        $quoteId = (!empty($request->input('quote_id'))) ? $request->input('quote_id') : 0;
        $jobId = (!empty($request->input('job_id'))) ? $request->input('job_id') : 0;
        $faultAdminId = (!empty($request->input('admin_id'))) ? $request->input('admin_id') : 0;
        $heading = 'Fault Notes Added By '.session('name');
        $comment = (!empty($request->input('comment'))) ? $request->input('comment') : '';
     
        $this->addAdminFaultNotes($quoteId, $jobId, $faultAdminId, $heading, $comment);
        return response()->json(['message' => 'Fault Notes added successfully'], 200);
    }

    function quoteStatus (Request $request) {

        // dd($request->all());

         $status = $request->input('status');
         $quoteid = $request->input('quote_id');
         $type = 0;


                // Retrieve the step and login_id from the quote_new table
            $quotedetails = DB::table('quote_new')
            ->select('step', 'login_id')
            ->where('id', $quoteid)
            ->first();

        if ($quotedetails) {
            $stepid = $quotedetails->step;
            $getid = $status;

            // Assuming getSystemvalueByID is a custom function
            $getddValue = dd_value(31);
           // print_r($getddValue);
            $name = $getddValue[$getid]; //  getSystemvalueByID($getid, 31);
            $stepname = $getddValue[$stepid];  //getSystemvalueByID($stepid, 31);
            $heading = "Quote Step change $stepname to $name";

          //  echo $heading;

            // Assuming addQuoteNotes is a custom function
            $this->add_quote_notes($quoteid,$heading,$heading);
            //addQuoteNotes($strvalue[1], $heading, $heading);

            // Update the quote_new table based on conditions
            if (in_array($getid, [5, 6, 7])) {
                if ($getid == 5 && $type == 5) {
                    DB::table('quote_new')
                        ->where('id', $quoteid)
                        ->update([
                            'step' => $status,
                            'quote_denied_date' => Carbon::now(),
                            'denied_id' => 10,
                        ]);
                } else {
                    DB::table('quote_new')
                        ->where('id', $quoteid)
                        ->update([
                            'step' => $status,
                            'quote_denied_date' => Carbon::now(),
                            'denied_id' => 0,
                        ]);
                }
            } else {
                DB::table('quote_new')
                    ->where('id', $quoteid)
                    ->update([
                        'step' => $status,
                        'quote_denied_date' => '',
                        'denied_id' => 0,
                    ]);
            }

            // If login_id is 0, update it with the current admin session ID
            if ($quotedetails->login_id == 0) {
                DB::table('quote_new')
                    ->where('id', $quoteid)
                    ->update(['login_id' => session('admin')]);
            }
        }
 
       // $Viewdata =  $this->getquoteData($request);
        return response()->json(['message' => 'Status Update successfully'], 200);

    } 

    function trackBoardView(Request $request) {
         
        return view('boardview.kanban');

    }

    function trackListView(Request $request) {

        return view('boardview.list');

    }


    // ==========================================================================================
    function addCategory(Request $request) {
        dd($request->all());
     }

    function vuefile(Request $request){

        return view('welcome');
    }

}
