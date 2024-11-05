<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-briefcase-2"></i>
                                    </div>
                                    <h5 class="card-title"> Add Job Type</h5>
                                </div>

                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col  mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" @change="getStaffInfo($event)"  v-model="addJobType.job_type_id">
                                            <option value="0">Select</option>
                                            <option :value="jdata.id" v-for="jdata in jobtype" :key="jdata.id" >{{  jdata.name }}</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Staff </label>
                                        <select class="form-select" v-model="addJobType.staff_id">
                                            <option value="0">Select</option>
                                            <option :value="staffid.id" v-for="staffid in staffids" :key="staffid.id" >{{  staffid.name }}</option>
                                        </select>
                                       
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" v-model="addJobType.job_date" >
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Time</label>
                                        <input type="time" class="form-control"  v-model="addJobType.job_time">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control"  v-model="addJobType.job_amount">
                                    </div>


                                    <div class="col mb-3">
                                        <label class="form-label">Staff Amount</label>
                                        <input type="text" class="form-control" v-model="addJobType.staff_amount" >
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Profit</label>
                                        <input type="text" class="form-control" v-model="addJobType.bcic_profit">
                                    </div>
                                    
                                    <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary bcic_btns me-2" @click="SaveJobType">Add Job Type</button>

                                    </div>
                                    </div>
                        </div>


                        <div class="card-header ">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-briefcase-2"></i>
                                </div>
                                <h5 class="card-title"> Job Types</h5>
                        </div>

                        <table class="table table-bordered table-hover mt-2 fs-14 job-type-table">
                            <thead class="table-primary">
                                <tr>
                                    <th>Reset</th>
                                    <th>Delete</th>
                                    <th>Type</th>
                                    <th>Staff</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Staff Amount</th>
                                    <th>Profit</th>
                                    <th>BCIC(% / F)</th>
                                    <th>Staff Paid</th>
                                    <th>SMS Send</th>
                                    <th>Notif Send</th>
                                    <th>DateTime</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="job in jobDetailsinfo" :key="job.id" class="jobtypeclass">
                                    <td>
                                        <button type="submit" class="vq_date d-inline-block me-1" @click="jobAssign(0, job.id, job.job_id , 0, job.job_type)">Reset</button> 
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-soft-danger" @click="jobAssign(0, job.id, job.job_id , 3 , job.job_type)"> <i class="ti ti-trash"></i> </button> 
                                    </td>
                                    <td>{{ job.job_type }}</td>
                                    <td>
                                            <select class="form-select" v-model="job.staff_id" @change="jobAssign($event, job.id, job.job_id, 1, job.job_type)">
                                                <option value="0">Select</option>
                                                <option :value="staffinfo.id" v-for="staffinfo in job.staffInfo" :key="staffinfo.id" >{{  staffinfo.name }}</option>
                                            </select>
                                        <!-- {{ job.staff_id ? job.staff_id : 'N/A' }} -->
                                    </td>
                                    <td><input class="form-control" type="date" v-model="job.job_date" @blur="updateField(job, 'job_date')" /></td>
                                    <td><input class="form-control" type="text" v-model="job.job_time" @blur="updateField(job, 'job_time')" /></td>
                                    <td><input class="form-control" type="text" v-model="job.amount_total" @blur="updateField(job, 'amount_total')" /></td>
                                    <td><input class="form-control" type="text" v-model="job.discount" readonly /></td>
                                    <td><input class="form-control" type="text" v-model="job.amount_staff" @blur="updateField(job, 'amount_staff')" /></td>
                                    <td><input class="form-control" type="text"  v-model="job.amount_profit" @blur="updateField(job, 'amount_profit')" /></td>
                                    <td>{{ job.amt_share_type || 'Please add bcic share' }}</td>
                                    <td>{{ job.staff_paid ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a class="badge vq_ids  mb-1" @click="sendSms(job.id)">
                                        Job SMS</a> 
                                        <a class="badge vq_ids " @click="sendSms(job.id)">
                                            Add SMS</a>
                                    </td>
                                    <td>
                                        <a class="badge vq_ids  mb-1" @click="sendNotification(job.id)">Job Noti</a> 
                                        <a class="badge vq_ids " @click="sendNotification(job.id)">Add Noti</a>
                                    </td>
                                    <td>{{ job.job_sms_date }} <br/>{{ job.address_sms_date }}</td>
                                  </tr>

                                  

                            </tbody>
                        </table>





                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
import { useCommonFunction } from './../../func/function.js';
import Swal from 'sweetalert2'

export default defineComponent({
  name: 'JobType',
  props: {
    jobId: {
      type: [String, Number],
      required: true
    },
    alldata: {
      type: [Object, Array],
      required: true
    }
  },
  setup(props) {
    const hasMounted = ref(false); // Flag to check if the component has mounted
    const { sendData } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};
      }
    };

    //const GetSystemDD = ref({});

    // Function to get dropdown values
    const getddValue = async () => {

          
        //console.error('get dd value information:');
        // try {
        //   const ids = [35, 18];
        //   GetSystemDD.value = await getddvaluedata(ids);
        //   console.log(GetSystemDD.value);
        // } catch (error) {
        //   console.error('Error fetching dropdown data:', error);
        // }
    };

    const jobtype = ref({});
    // Function to get job type
    const getjobType = async () => {
      try {
        const job_id = jobId.value;
        const formget = { job_id };
        //console.log(formget);
        const response = await sendData('get', '/get-job-type', formget);
        jobtype.value = response;
      } catch (error) {
        console.error('Error fetching job type data:', error);
      }
    };

    const staffids = ref([]);
    // Function to get staff details (called when site_id is available)
    const getStaffType = async () => {
      const site_id = alldatainforamtion.quote_info.site_id;
      if (!site_id) {
        console.warn('site_id is not available yet.');
        return;
      }

      const job_id = jobId.value;
      const formget = { job_id, site_id };
      console.log(alldatainforamtion);
      try {
        const response = await sendData('get', '/get-staff-details', formget);
        staffids.value = response;
      } catch (error) {
        console.error('Error fetching staff details:', error);
      }
    };

    const getStaffInfo = async (event) => {

      staffids.value = '';
      const selectedId = parseInt(event.target.value); // Get selected ID
      
      const selectedJob = jobtype.value.find(j => j.id === selectedId); // Find the selected job object
      const selectedJobName = selectedJob ? selectedJob.name : ''; // Get the selected job name or default to empty

      const site_id = alldatainforamtion.quote_info.site_id; // Ensure this is available
      const job_id = jobId.value; // Reactive value for job ID

      // Create form object to send
      const formData = { job_id, site_id, selectedJobName , selectedId };

      const response = await sendData('get', '/get-staff-details', formData);
       staffids.value = response;
    };

    const jobDetailsinfo = ref({});
    // Function to get job details
    const getJobDetails = async () => {
      try {
        const job_id = jobId.value;
        const formget = { job_id };
         //console.log(formget);
        const response = await sendData('get', '/get-job-details', formget);
        jobDetailsinfo.value = response;
      } catch (error) {
        console.error('Error fetching job details:', error);
      }
    };
    
    const jobAssign = async(event , jid, job_id , type, job_type) => {

          if(type == 3) {

               const { isConfirmed } = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to Delete '+job_type+' job type ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                customClass: {
                  popup: 'custom-swal-popup',
                  title: 'custom-swal-title',
                  confirmButton: 'custom-swal-confirm-button',
                  cancelButton: 'custom-swal-cancel-button'
                },
                didOpen: () => {
                  const popup = Swal.getPopup();
                  popup.style.borderRadius = '10px';
                }
              });

              if (!isConfirmed) {
                return; // Exit the function if the user cancels
              }
          }

        const staff_id = (type == 0 || type == 3) ? 0 : parseInt(event.target.value); 
        const formData = {staff_id , jid , job_id , type };
        const response = await sendData('post', '/job-assign', formData);
        console.log(response);

        jobDetailsinfo.value = response.job_details;
            customSwal.fire({
                  title: response.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
              });
       
    }

      const addJobType =  reactive({
            job_type_id: 0,
            staff_id:0,
            job_date: new Date().toISOString().slice(0, 10),  // Format as 'YYYY-MM-DD'
            job_time: '08:00', // Format as 'HH:MM'
            job_amount:0,
            staff_amount:0,
            bcic_profit:0
          });
              
    const  SaveJobType = async() => {
        const job_id = jobId.value;
        const quote_id = alldatainforamtion.quote_info.id;
        const site_id =  alldatainforamtion.quote_info.site_id;
        const  formData = { job_id, quote_id, site_id , ...addJobType};
        // console.log(formData);
        const response = await sendData('get', '/add-job-type', formData);

        console.log(response);

        if(response.success == false) {
 
          ErrorcustomSwal.fire({
              title: 'Error',
              text: response.message,
              icon: 'error',
              iconColor: '#FF5722',
              customClass: {
                  // Apply the error-specific class
                  popup: 'custom-swal-popup custom-swal-error'
              }
            });


        }else if(response.success == true){

          jobDetailsinfo.value = response.job_details;
            customSwal.fire({
                  title: response.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
              });

        }
       
             // ErrorcustomSwal
              
              addJobType.job_type_id =  0;
              addJobType.staff_id =  0;
              addJobType.job_date =  new Date().toISOString().slice(0, 10);
              addJobType.job_time =  '08:00';
              addJobType.job_amount =  0;
              addJobType.staff_amount =  0;
              addJobType.bcic_profit =  0;
        // console.log(response);
    }
     

    // Watcher for alldata to update the reactive object when alldata changes
    watch(alldata, (newVal) => {
      if (hasMounted.value && newVal) {
           getallData();

        console.log('Updated alldata and fetched relevant data');
      }
    });

    // Watch site_id to trigger getStaffType only when site_id is available
    watch(() => alldatainforamtion.quote_info.site_id, (newSiteId) => {
      if (newSiteId) {
        getStaffType(); // Call getStaffType when site_id is available
      }
    });

     // Global SweetAlert2 configuration
     const customSwal = Swal.mixin({
                toast: true,
                position: 'top-end',
                background: '#f9f9f9',
                color: '#333',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                },
                didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.borderRadius = '10px';
                },
            });


        // Global SweetAlert2 configuration
    const ErrorcustomSwal = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: '#f9f9f9',
        color: '#333',
        showConfirmButton: false,
        timer: 2000,
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title-error',
        },
        didOpen: () => {
          const popup = Swal.getPopup();
          popup.style.borderRadius = '10px';
        },
    });     

    // onMounted lifecycle hook to fetch data when component is loaded
    onMounted(async () => {
      hasMounted.value = true;
      await getddValue();
      await getJobDetails();
      await getjobType();
      getallData(); // Ensure all data is set before calling getStaffType
    });

   

    return {
      jobId,
      alldata,
      alldatainforamtion,
      getallData,
     // GetSystemDD,
      getJobDetails,
      jobDetailsinfo,
      getjobType,
      jobtype,
      getStaffType,
      staffids,
      getStaffInfo,
      SaveJobType,
      addJobType,
      jobAssign,

    };
  }
});
</script>
