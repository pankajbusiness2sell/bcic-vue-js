<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                   <!-- <pre>{{  allpopupData }}</pre>   -->


                        <!--Information First Section Start Here-->
                        <div class="otd-job-details-information mt-3">
                            <h3>Customer Information</h3>
                            <ul class="bcic_otd_info">
                            <li><strong>#Q For :</strong> <span class="vq_id"><i class="ti ti-id"></i> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.id : '' }} ( BCIC )</span></li>
                            <li><strong>Reference : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.job_ref : '' }}</li>
                            <li><strong>Name : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.name : '' }}</li>
                            <li><strong>Email : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.email : '' }}</li>
                            <li><strong>Phone : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.phone : '' }}</li>
                            <li><strong>Site : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info?.site_id : '' }} ( {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.suburb : '' }})</li>
                            <li><strong>Job Date : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.booking_date : '' }}</li>
                            <li><strong>Amt : </strong> <span class="otd_price">$ {{ allpopupData && allpopupData.customer_amount ? allpopupData.customer_amount : allpopupData?.quote_info?.amount }}</span></li>
                                <li><strong>Pymt By : </strong> {{ allpopupData && allpopupData.quote_info ? allpopupData.quote_info.name : '' }} </li>
                                <li><strong>Amt Charged : </strong> {{ allpopupData.totalAmt }} </li>
                                <li><strong>Status : </strong>
                                    <select  class="form-select" v-model="allpopupData.status">
                                        <option value="0">Select</option>
                                        <option   v-for="(item, index) in ddValue[26]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </li>
                                <li><strong>Quote Hours : </strong>{{  allpopupData.quoteworkHours }} </li>
                                <li><strong>Work Hours : </strong> {{ allpopupData.work_hr }} </li>
                                <li><strong>Team Size :  </strong> {{ allpopupData.teamSize }} </li>
                                <li><strong>Total Work :  </strong> {{ allpopupData.total_work }} </li>
                                <li><strong>Extra Hours :  </strong> {{ allpopupData.extra_hr }} </li>
                                <li><strong>T&C Accep : </strong> {{  (allpopupData.accept_terms_status == 0) ? 'No' : 'Yes' }} </li>
                                <li><strong>Have Removal : </strong>  {{ allpopupData && allpopupData.quote_info ? ddValue[40][allpopupData.quote_info.have_removal] : 'N/A' }} </li>
                                <li class="bc_click_btn"><strong>Job Assigned : </strong>
                                    <ul>
                                        <li  :title="item.staffinfo" v-for="(item, index) in jobdetailsInfo" :value="index" :key="index">{{ item.job_type}}</li>
                                        <!-- <li>Carpet</li> -->
                                        <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cleaning"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><circle cx="36.096" cy="22.654" r="1.393" fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round"></circle><circle cx="40.222" cy="26.814" r="1.672" fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round" d="m12.213 10.465l11.304 1.98m-7.97 2.031l7.345 1.302m-9.48 1.562l8.959 1.563m6.579 13.093l-.277-3.404c-.694-4.605-6.012-5.723-7.657-1.276c-1.821 3.764-8.313 7.281-15.418 8.151c2.863 9.246 18.17 7.426 20.263 4.74"></path><path fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round" d="M26.955 34.79c-4.982 2.828-.246 7.569 2.604 5.73c2.071 2.777 6.469 2.25 7.5.156c5.886 2.626 7.238-5.573 2.397-6.302c-1.076-3.761-4.968-4.413-7.293-2.136c-1.987-.49-4.029-1.266-5.209 2.552M9.297 17.407v1.51m0 2.353v1.51m1.228-2.686l1.51.052m-5.373 0h1.51m5.899 7.796l1.031 1.105m0-3.873l-1.068 1.068m-2.731-.995l1.068 1.068m0 1.59l-1.068 1.068m9.713-1.657c2.328 1.94 4.939 1.975 7.657 1.276M10.978 41.135c5.694-1.93 9.219-4.403 11.184-7.282m-.052 4.636c-1.116 1.544-2.471 2.825-4.766 3.878M7.102 38.31c3.241-.09 5.776-1.216 8.237-2.478m8.373-11.216l3.217-17.172c.448-2.972 3.947-2.119 3.268.573L26.833 25.29"></path></svg></li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 50 50"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke="#138062" d="M14.583 33.333H31.25v-12.5H14.583z"></path><path stroke="#138062" d="M10.417 41.667H37.5a2.083 2.083 0 0 0 2.083-2.084v-25A2.083 2.083 0 0 0 37.5 12.5H14.583"></path><path stroke="#138062" d="M43.75 35.417h-4.167m-25-22.917v25a4.167 4.167 0 1 1-8.333 0v-25a4.167 4.167 0 1 1 8.333 0m-4.166 20.833a4.166 4.166 0 1 0 0 8.333a4.166 4.166 0 0 0 0-8.333M43.75 18.75h-4.167zm0 8.333h-4.167z"></path></g></svg></li> -->
                                    </ul>
                                </li>
                                <li v-if="allpopupData.startEndShow"><strong>Start/End :  </strong> {{  allpopupData.start_time  }} /  {{  allpopupData.end_time  }}</li>
                            </ul>
                        </div>
                        <!--Information First Section End Here-->




                        <!--Information First Section Start Here-->
                        <div class="otd-job-details-information mt-4">
                            <h3>Quote Information</h3>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Review Email</label>
                                    <select class="form-select" v-model="allpopupData.review_email" @change="updateField($event, 'jobs.review_email',allpopupData.id,'Review Email')">
                                        <option selected="">select</option>
                                        <option   v-for="(item, index) in ddValue[29]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Estimate </label>
                                    <select class="form-select" v-model="allpopupData.estimate_status" @change="updateField($event, 'jobs.estimate_status',allpopupData.id,'Estimate')">
                                        <option value="0">Select</option>
                                        <option   v-for="(item, index) in ddValue[122]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Assigning Status</label>
                                    <select class="form-select" @change="updateField($event, 'jobs.assigning_status',allpopupData.id,'Assigning Status')"  v-model="allpopupData.assigning_status">
                                        <option selected="">select</option>
                                        <option   v-for="(item, index) in ddValue[35]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Job Assigning Status</label>
                                    <select class="form-select" @change="updateField($event, 'jobs.job_assign_status',allpopupData.id,'Job Assigning Status')"  v-model="allpopupData.job_assign_status">
                                        <option selected="">select</option>
                                        <option   v-for="(item, index) in ddValue[133]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                               
                                <div class="col mb-3">
                                    <label class="form-label">Booking Admin</label>
                                       <select 
                                            name="quote_auto_custom" 
                                            class="form-select"  
                                            v-model="quoteData.login_id"
                                            @change="updateField($event, 'quote_new.login_id', quoteData.login_id,'Booking Admin')"
                                          >
                                            <option value="0">Select Admin</option>
                                            <option 
                                                v-for="(admin, index) in admindata" 
                                                :key="admin.id" 
                                                :value="admin.id"
                                              >
                                              {{ admin.name }} 

                                           </option>
                                      </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label"> Online Payment</label>
                                    <select class="form-select" @change="updateField($event, 'jobs.online_payment_status',allpopupData.id, 'Online Payment')" v-model="allpopupData.online_payment_status">
                                        <option selected="">select</option>
                                        <option   v-for="(item, index) in ddValue[65]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Deposit</label>
                                    <select class="form-select"  @change="updateField($event, 'jobs.deposit',allpopupData.id, 'Deposit')" v-model="allpopupData.deposit">
                                        <option value="0">select</option>
                                        <option   v-for="(item, index) in ddValue[40]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>



                            </div>
                            <div class="row">


                                <div class="col mb-3">
                                    <label class="form-label">Re-Quoting </label>
                                    <select class="form-select"  @change="updateField($event, 'jobs.upsell_denied',allpopupData.id, 'Re-Quoting')" v-model="allpopupData.upsell_denied">
                                        <option value="0">Select</option>
                                        <option selected="">select</option>
                                        <option   v-for="(item, index) in ddValue[106]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label"> Re-Quoting Required</label>
                                    <select class="form-select"  @change="updateField($event, 'jobs.upsell_required',allpopupData.id, 'Re-Quoting Required')"  v-model="allpopupData.upsell_required">
                                        <option value="0">Select</option>
                                        <option   v-for="(item, index) in ddValue[127]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Re-Quoting Admin</label>
                                    <select name="quote_auto_custom" class="form-select" @change="updateField($event, 'jobs.upsell_admin',allpopupData.id, 'Re-Quoting Admin')" v-model="allpopupData.upsell_admin">
                                        <option value="0">Select Admin</option>
                                        <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                                    </select>
                                </div>

                               
                                <!-- <div class="col mb-3">
                                    <label class="form-label"> QC</label>
                                    <select class="form-select" @change="updateField($event, 'jobs.qc_show',allpopupData.id)"  v-model="allpopupData.qc_show">
                                        <option value="">Select</option>
                                        <option   v-for="(item, index) in ddValue[208]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div> -->

                               
                                <!-- <div class="col mb-2">
                                    <ul class="bcic_view_q_btns">
                                        <li><button type="submit" class="btn btn-primary bcic_btns">Save</button></li>
                                        <li><button type="submit" class="btn btn-danger bcic_btns">Fault</button></li>
                                    </ul>
                                </div> -->




                            </div>
                        </div>
                        <!--Information First Section End Here-->



                        <!--Information First Section Start Here-->
                        <div class="otd-job-details-information mt-4">
                            <h3>Customer Information</h3>

                            <div class="row">
                                <!-- <div class="col mb-3">
                                    <label class="form-label">Start Time</label>
                                    <select class="form-select" >
                                        <option value="0">Select</option>
                                        <option   v-for="(item, index) in ddValue[174]" :value="index" :key="index" >{{ item }}</option>
                                    </select>
                                </div> -->

                                <div class="col mb-3">
                                    <label class="form-label">Get Entry</label>
                                    <input type="text" class="form-control" :value="allpopupData.get_entry" @blur="updateField($event, 'jobs.get_entry',allpopupData.id,'Get Entry')" placeholder="">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Cleaner Park</label>
                                    <input type="text" class="form-control" :value="allpopupData.cleaner_park" @blur="updateField($event, 'jobs.cleaner_park',allpopupData.id, 'Cleaner Park')" placeholder="">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">SQM</label>
                                    <input type="text" class="form-control" :value="allpopupData.sqm" @blur="updateField($event, 're_quoteing.sqm',allpopupData.requote_id,'SQM')" placeholder="">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">End Time </label>
                                    <span class="vq_id otd_tyms"><a href="#0">Job Finish</a></span>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label">Staff Share Details</label>
                                    <span class="vq_id otd_tyms"><a href="#0">No</a></span>
                                </div>






                            </div>

                        </div>
                        <!--Information First Section End Here-->



                        <div class="otd_job_details_btn mt-3">
                            <ul>
                                <li :class="{ active: currentTab === 'edit_quote' }" ><a href="javascript:void(0)" @click="changeTab('edit_quote')" >Quote </a></li>
                                <li :class="{ active: currentTab === 'job_details' }"><a href="javascript:void(0)" @click="changeTab('job_details')">Job Details </a></li>
                                <li :class="{ active: currentTab === 'job_type' }"><a href="javascript:void(0)" @click="changeTab('job_type')">Job Types </a></li>
                                <li :class="{ active: currentTab === 'job_reclean' }"><a href="javascript:void(0)" @click="changeTab('job_reclean')">Job Reclean </a></li>
                                <li :class="{ active: currentTab === 'job_payment' }" ><a href="javascript:void(0)" @click="changeTab('job_payment')">Payment </a></li>
                                <li :class="{ active: currentTab === 'email_client' }" ><a href="javascript:void(0)" @click="changeTab('email_client')">Email Client </a></li>
                                <li :class="{ active: currentTab === 'send_sms' }" ><a href="javascript:void(0)" @click="changeTab('send_sms')">Send SMS / Notification</a></li>
                                <li :class="{ active: currentTab === 'view_invoice' }" ><a href="javascript:void(0)" @click="changeTab('view_invoice')">View Invoice </a></li>
                                <li :class="{ active: currentTab === 'view_email' }" ><a href="javascript:void(0)" @click="changeTab('view_email')">View Emails </a></li>
                                <!-- <li :class="{ active: currentTab === 'staff_img' }" ><a href="javascript:void(0)" @click="changeTab('staff_img')">Staff Img </a></li> -->

                                <li :class="{ active: currentTab === 'task_history' }" ><a href="javascript:void(0)" @click="changeTab('task_history')">Task History</a></li>
                                <li :class="{ active: currentTab === 'view_checklist' }" ><a href="javascript:void(0)" @click="changeTab('view_checklist')">View CheckList</a></li>
                                <li :class="{ active: currentTab === 'cleaner_notes' }" ><a href="javascript:void(0)" @click="changeTab('cleaner_notes')">Cleaner Notes</a></li>
                                <li :class="{ active: currentTab === 'assign_hitory' }" ><a href="javascript:void(0)" @click="changeTab('assign_hitory')">Assign History</a></li>
                                <li :class="{ active: currentTab === 'admin_fault' }" ><a href="javascript:void(0)" @click="changeTab('admin_fault')">Admin Fault</a></li>
                                <li :class="{ active: currentTab === 'add_review' }" ><a href="javascript:void(0)" @click="changeTab('add_review')">Add Review</a></li>
                                <li :class="{ active: currentTab === 'call_list' }" ><a href="javascript:void(0)" @click="changeTab('call_list')">Call List</a></li>
                            </ul>
                            
                        </div>

                          
                        <component :is="currentComponent" :jobId="jobId" :alldata="allpopupData" />


                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, watch, onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCommonFunction } from '../../func/function.js';


import EditQuote from './EditQuote.vue';
import JobDetails from './JobDetails.vue';
import JobType from './JobType.vue';
import JobReclean from './JobReclean.vue';
import JobPayment from './JobPayment.vue';
import EmailClient from './EmailClient.vue';
import NotificationNew from './NotificationNew.vue';
import ViewMail from './ViewMail.vue';
import UploadImage from './UploadImage.vue';
import TaskHistory from './TaskHistory.vue';
import ViewChecklist from './ViewChecklist.vue';
import CleanerNote from './CleanerNote.vue';
import AssignHistory from './AssignHistory.vue';
import AdminfaultNotes from './AdminfaultNotes.vue';
import AddReview from './AddReview.vue';
import CallList from './CallList.vue';
import PopupViewInvoic from './PopupViewInvoic.vue';

export default {
  components: {
    EditQuote,
    JobDetails,
    JobType,
    JobReclean,
    JobPayment,
    EmailClient,
    NotificationNew,
    ViewMail,
    UploadImage,
    TaskHistory,
    ViewChecklist,
    CleanerNote,
    AssignHistory,
    AdminfaultNotes,
    AddReview,
    CallList,
    PopupViewInvoic
  },
  setup() {
    const { sendData , createCustomSwal, createErrorCustomSwal } = useCommonFunction();
    const route = useRoute();
    const router = useRouter();

    const  customSwal = createCustomSwal();
    const  ErrorcustomSwal = createErrorCustomSwal();

    const currentTab = ref('job_details'); // Default tab
    const jobId = ref(null);
    const firstTimejobid = ref(null);

    // Access query parameters in the onMounted lifecycle hook
    onMounted(() => {

        getQuoteInfo();
          if (route.query.job_id) {
            jobId.value = route.query.job_id;
          }

          if (route.query.tab) {
            currentTab.value = route.query.tab;
          }

            console.log('Current Tab:', currentTab.value);
            console.log('Job ID:', jobId.value);
    });

    // Computed property to determine the current component to display
    const currentComponent = computed(() => {
      switch (currentTab.value) {
        case 'edit_quote':
           return EditQuote;
        case 'job_details':
           return JobDetails;
        case 'job_type':
          return JobType;
        case 'job_reclean':
          return JobReclean;
        case 'job_payment':
          return JobPayment;
        case 'email_client':
          return EmailClient;
        case 'send_sms':
          return NotificationNew;
        case 'view_invoice':
          return PopupViewInvoic;
        case 'view_email':
          return ViewMail;
        case 'task_history':
          return TaskHistory;
        case 'view_checklist':
          return ViewChecklist;
        case 'cleaner_notes':
          return CleanerNote;
        case 'assign_hitory':
          return AssignHistory;
        case 'admin_fault':
          return AdminfaultNotes;
        case 'add_review':
          return AddReview;  
        case 'call_list':
          return CallList;
        case 'staff_img':
          return UploadImage;
        default:
          return JobDetails;
      }
    });

    const allpopupData = ref({ });
    const ddValue = ref({});
    const admindata = ref({});
    const jobdetailsInfo = ref({});

    const quoteData = ref({
          login_id: 0, // Fallback to 0 if not set
      });

    //const jobdetails = ref({});
    // Method to fetch quote information
    const getQuoteInfo = async () => 
    {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);
            firstTimejobid.value = params.get('job_id');

        if (!firstTimejobid.value) return; // Early exit if jobId is not set

        try {
          const  jobid = firstTimejobid.value;
          const formData = {jobid};
          const response = await sendData('get', '/get-job-popu-details', formData);

          
          allpopupData.value = response.allInfo;
          ddValue.value = response.ddValue; 
          admindata.value = response.admindata;
          jobdetailsInfo.value = response.jobdetails;
          quoteData.value.login_id = response.allInfo.quote_info.login_id;

          // getjobDetailsInfo(response.data.jobdetails);

        } catch (error) {
          console.error('Error fetching quote info:', error);
        }
    };

    const updateField = async (event, fieldtable, tid, leavelName = null)=>{

          const value = event.target.value;
          const formData = {value,fieldtable,tid};

          const response = await sendData('post', '/edit-field-update', formData);

                if (response.success === true) {
                    customSwal.fire({
                        title: leavelName + '' + response.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                } else if (response.success === false) {
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
                }

         //console.log(event.target.value, fieldtable, id);
    }

             
     

    // Method to change the tab and update the URL
    const changeTab = (tab) => {
      currentTab.value = tab;
      router.push({ query: { tab, job_id: jobId.value } });
    };

    // Watch for changes in the route to update the tab state
    watch(() => route.query.tab, (newTab) => {
      currentTab.value = newTab || 'job_details';
    });

    // Watch for changes in the route to update the jobId state and fetch quote info
    watch(() => route.query.job_id, (newJobId) => {
      jobId.value = newJobId || null;
     // getQuoteInfo(); // Fetch data whenever jobId changes
    });

    return {
      currentComponent,
      changeTab,
      getQuoteInfo,
      allpopupData,
      ddValue,
      admindata,
      jobId,
      jobdetailsInfo,
      currentTab,
      updateField,
      quoteData,
    };
  }
};
</script>
