<template>
    <table class="table table-bordered mb-3"  v-if="listData?.length > 0">
        <thead >
            <tr>
                <th> <i class="ti ti-alert-hexagon"></i> Priorty </th>
                <th><i class="ti ti-user-circle"></i> Ashu Dixit</th>
                <th><i class="ti ti-user-circle"></i> Neeraj Kumar </th>
                <th><i class="ti ti-user-circle"></i> Manali Manwadkar </th>
                <th><i class="ti ti-user-circle"></i> Poorva Sharma</th>
                <th><i class="ti ti-user-circle"></i> Mohit Sethi</th>
                <th><i class="ti ti-user-circle"></i>Sparsh Kapoor</th>
                <th><i class="ti ti-user-circle"></i> Naval Verma</th>
                <th><i class="ti ti-user-circle"></i> Rashmi Chaturvedi</th>
                <th><i class="ti ti-user-circle"></i> Pankaj</th>
                <th><i class="ti ti-user-circle"></i> Payal Panda</th>
                <th><i class="ti ti-user-circle"></i> N/A</th>
                <th><i class="ti ti-truck-delivery"></i> CBD Movers</th>
                <th><i class="ti ti-user-circle"></i> Manan Bhatia</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td>P0</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>
             <tr>
                <td>P1</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>

             <tr>
                <td>P2</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>

             <tr>
                <td>P3</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>
            <tr>
                <td>P4</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>
            <tr>
                <td>P5</td>
                <td>30</td>
                <td>24</td>
                <td>45</td>
                <td>71</td>
                <td>3</td>
                <td>49</td>
                <td>56</td>
                <td>27</td>
                <td>2</td>
                <td>1</td>
                <td>4</td>
                <td>5</td>
                <td>1</td>

            </tr>
        </tbody>

    </table>

    <table class="table table-bordered" >
        <thead>
            <tr>
                <th> <i class="ti ti-id"></i> Quote ID </th>
                <th> <i class="ti ti-map-pin"></i> Address </th>
                <th> <i class="ti ti-users"></i> Name </th>
                <th> <i class="ti ti-mail"></i> Email </th>
                <th> <i class="ti ti-phone"></i> Phone </th>
                <th> <i class="ti ti-briefcase"></i> Job Type </th>
                <th> <i class="ti ti-calendar-due"></i> Job Date </th>
                <th> <i class="ti ti-helicopter-landing"></i> Heading </th>
                <th> <i class="ti ti-premium-rights"></i> Amount </th>
                <th> <i class="ti ti-file-analytics"></i> Status </th>
                <th> <i class="ti ti-calendar-due"></i> Follow Date </th>
                <th> <i class="ti ti-calendar-time"></i> Follow Time </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="listData.length  > 0" >
                <td><a href="#0"> 215175 </a></td>
                <td>12 West Street, Croydon NSW, Australia</td>
                <td>Nira</td>
                <td>Daffodilsgardens19@gmail.com</td>
                <td>0431543124</td>
                <td>
                    <div class="kanban-f-icon">
                        <ul>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cleaning"><img :src="cleaningImg" alt="Cleaning"/></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"><img :src="carpetImg" alt="carpet"/></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pest"><img :src="pestImg" alt="pest"/></li>
                        </ul>
                    </div>
                </td>
                <td>04th Dec 2024</td>
                <td></td>
                <td>440</td>
                <td class="lv_approved_btn"><i class="ti ti-checks"></i> Approved </td>
                <td>2024-11-04 08:45:00</td>
                <td>08:30-09:00</td>
            </tr>
            <tr v-else>
             <td colspan="20">No Record found</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import { defineComponent, ref } from 'vue'; // Import necessary functions
//import axios from 'axios'; // Import axios for HTTP requests

export default defineComponent({
        
    components: {
       //QuoteNotes
    },
  props: {
    listData: {
      type: [Object, Array],
      required: false,
      default: () => ({})
    },
  },
  
    setup(props) {

    }
       
})

//listData

</script>