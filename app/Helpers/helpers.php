<?php  

use App\Models\Sites;
use App\Models\QuoteFor;
use App\Models\JobType;


 if (! function_exists('your_helper_function')) {
    function your_helper_function($param) {
        // Your custom logic
        return $param;
    }
}

    if (! function_exists('dd_value')) {

        function dd_value($type, $notin = '')
        {
            // Initialize the base query
            $query = DB::table('system_dd')
                        ->select('id', 'name')
                        ->where('type', $type)
                        ->where('status', 1);


            if (!empty($notin)) {
                $notinArray = explode(',', $notin);
                $query->whereNotIn('id', $notinArray);
            }

            // Execute the query and get the results
            $results = $query->get();

            // Prepare the output array
            $getvalue = [];
            foreach ($results as $data) {
                $getvalue[$data->id] = $data->name;
            }

            return $getvalue;
        }
    }
    function dd_id($id, $type)
    {

        $result = DB::table('system_dd')
                 ->where('id', $id)
                 ->where('type', $type)
                 ->first();
                 
        if ($result) {
            return $result->name;
        } else {
            return "";
        }

    }

    if (! function_exists('dd_in_value')) {

        function dd_in_value($idtypes)
        {
            if(is_array($idtypes)) {
                $query = DB::table('system_dd')
                            ->select('id', 'name','type')
                            ->whereIn('type', $idtypes)
                            ->where('status', 1);
            
                $results = $query->get();
                // Prepare the output array
                $getvalue = [];
                if(!empty($results)) {
                    foreach ($results as $data) {
                        $getvalue[$data->type][$data->id] = $data->name;
                    }
                    return $getvalue;
                }
            }
        }
    }

    function get_rs_value($table, $field, $wherecond)
    {
        //$result = YourModel::where('id', $wherecond)->first(); // Assuming 'id' is your primary key
        $result = DB::table($table)->where('id', $wherecond)->first();

        if ($result) {
            return $result->{$field};
        } else {
            return "";
        }
    }

    function getsite() {
        $sites = Sites::select('id', 'name', 'domain', 'br_domain', 'abv', 'email', 'phone')
                      ->get()
                      ->keyBy('id')
                      ->toArray();
        return $sites;
    }

?>