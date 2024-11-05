<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-time"></i>
                                </div>
                                <h5 class="card-title"> Job Assign History</h5>
                        </div>




                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th>Job Type </th> 
                                        <th>Denied </th>
                                        <th>Available </th>
                                        <th>Already Has a Job </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="jobdetailslist.assignHistory.length > 0 "  v-for="jobdetails in jobdetailslist.assignHistory">
                                        <td> {{ jobdetails.job_type}} </td>
                                        <td> {{ jobdetails.denied}} </td>
                                        <td>{{ jobdetails.available}}</td>
                                        <td> {{ jobdetails.already_has_job}} </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="7">No data found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-time"></i>
                                </div>
                                <h5 class="card-title"> Deny & Re-Assign History </h5>
                        </div>
                 
                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th> Staff Name </th>
                                        <th> Deny & Re-Assign Time </th>
                                        <th> Job Type </th>
                                        <th> Deny Type </th>
                                        <th> Reason for Deny </th>
                                        <th> Deny/Re-Assign </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="jobdetailslist.denyReassignHistory.length > 0"  v-for="reassignd in jobdetailslist.denyReassignHistory">
                                        <td> {{ reassignd.staff_name}} </td>
                                        <td> {{ reassignd.deny_reassign_time}} </td>
                                        <td> {{ reassignd.job_type}}</td>
                                        <td>{{ reassignd.deny_type}} </td>
                                        <td> {{ reassignd.reason_for_deny}} </td>
                                        <td> {{ reassignd.deny_reassign}} </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="7">No data found</td>
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
    name: 'Assign History',
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
            } else {
               console.warn('alldata is not a valid object:', alldata.value);
            }

        };

            const jobdetailslist = ref({
                assignHistory: {},
                denyReassignHistory: {}
            });

        const fetchAssignHistory =  async () => {
            const job_id = jobId.value;
            const formData = {job_id};
            const response = await sendData('get', '/job-assign-history', formData);
            jobdetailslist.value.assignHistory = response.assignHistory;
            jobdetailslist.value.denyReassignHistory = response.denyReassignHistory;
        }

       
  

       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) { 
                getallData();
                await fetchAssignHistory();
            }
        });

        onMounted(async () => {
           // console.log('onMounted call');
            getallData();
            await fetchAssignHistory();
        });
        
      return {
        jobId,
        alldatainforamtion,
        fetchAssignHistory,
        jobdetailslist,
      };
    },
  });
  </script>
