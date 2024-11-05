<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-phone-call"></i>
                                </div>
                                <h5 class="card-title">  Call Report  {{  calListdata.length || '' }} </h5>
                        </div>

                  
                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th> Id	</th>
                                        <th> Quote ID </th>
                                        <th> Job ID </th>
                                        <th> From Number </th>
                                        <th> To Number</th>
                                        <th> Call Date </th>
                                        <th> Created On </th>
                                        <th> Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="calListdata.length > 0 " v-for="(calLis, index) in calListdata" :key="index">
                                        <td> {{  index+1 }} </td>
                                        <td> {{  calLis.quote_id }}</td>
                                        <td>  {{  calLis.from_number }}</td>
                                        <td>  {{  calLis.to_number }}</td>
                                        <td>  {{  calLis.call_date }} </td>
                                        <td>  {{  calLis.call_date_time }} </td>
                                        <td> {{  calLis.duration }} </td>

                                    </tr>
                                    <tr>
                                        <td colspan="10">No Record found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
  import { useCommonFunction } from '../../func/function.js';
  
  export default defineComponent({
    name: 'ViewMail',
    props: {
      jobId: {
        type: [String, Number],
        required: true,
      },
      alldata: {
        type: [Object, Array],
        required: true,
      },
    },
  
    setup(props) {
       const hasMounted = ref(false); // Flag to check if the component has mounted
      const { sendData   } = useCommonFunction();

     
      const { jobId, alldata } = toRefs(props);
  
      const alldatainforamtion = reactive({
        all: {},
        jobdetails: [],
        quote_info: {},
      });
  
  
      // Function to fetch all data from props
        const getallData = () => {

            if (alldata.value && typeof alldata.value === 'object') {
                alldatainforamtion.all = alldata.value;
                alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
                alldatainforamtion.quote_info = alldatainforamtion.all.quote_info || {};

                alldatainforamtion.quote_info.id = alldatainforamtion.all.quote_info.id || 0;
            } else {
               console.warn('alldata is not a valid object:', alldata.value);
            }

        };
 
         const calListdata = ref({});
        const getCallReportlist =  async () => {
                const job_id = jobId.value;
                const quote_id = alldatainforamtion.quote_info.id;
                const formData = { job_id , quote_id };
                const response = await sendData('get', '/get-call-list', formData);
               
                calListdata.value  = response.callslist;
                console.log(response);

        }


       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) {
                getallData();
                await getCallReportlist();
            }
        });

        onMounted(async () => {
           // console.log('onMounted call');
            getallData();
            await getCallReportlist();
        });
        
      return {
        jobId,
        alldatainforamtion,
        getCallReportlist,
        calListdata,
      };
    },
  });
  </script>