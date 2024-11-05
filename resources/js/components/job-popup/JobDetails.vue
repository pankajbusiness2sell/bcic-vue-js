<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!--Job Details Section Start Here-->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">

                               <!-- <pre> {{  joblistcomments  }}</pre> -->

                                        <div class="card-header pt-0">
                                            <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                                <i class="ti ti-mail"></i>
                                            </div>
                                            <h5 class="card-title">Email & SMS</h5>
                                        </div>
        
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-hover mt-2 ">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>Confirm Booking</th>
                                                        <th colspan="2">Cleaner Details to Client </th>
                                                        <th> Email Client Invoice </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="otd-send_btns text-center">
                                                        <td>
                                                            <a href="javascript:void(0);" @click="sendEmailPopup('email_client_booking_conf')" class="btn btn-primary"> <i class="ti ti-mail"></i>Booking Confirm Email </a>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" @click="sendEmailPopup('email_client_cleaner_details')"  class="btn btn-primary"> <i class="ti ti-mail"></i> Send Email Details</a>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" @click="sendEmailPopup('sms_client_cleaner_details')"  class="btn btn-primary"> <i class="ti ti-mail"></i> Send SMS Details</a>
                                                        </td>
        
                                                        <td>
                                                            <!-- <a href="javascript:void(0);" @click="sendEmailPopup('email_client_invoice')"  class="btn btn-primary"> <i class="ti ti-mail"></i> Email Invoice</a> -->
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center" >
                                                        <td>{{alldatainforamtion.all.email_client_booking_conf }}</td>
                                                        <td>{{alldatainforamtion.all.email_client_cleaner_details }}</td>
                                                        <td>{{alldatainforamtion.all.sms_client_cleaner_details }}</td>
                                                        <td></td>
                                                    </tr>
        
                                                </tbody>
                                            </table>
                                        </div>
                 


                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <h5 class="card-title"> Secondery Client Info</h5>
                                </div>
   
                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col  mb-3">
                                        <label class="form-label"> Name </label>
                                        <input type="text" class="form-control"  @input="clearError('name')"   v-model="seconderyinfo.name" placeholder="Enter Name">
                                        <span class="text-danger" v-if="HaserrorMsg.name" >{{ HaserrorMsg.name }}</span>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Email </label>
                                        <input type="text" class="form-control"  @input="clearError('email')"  v-model="seconderyinfo.email" placeholder="Enter Email Address">
                                        <span class="text-danger" v-if="HaserrorMsg.email">{{ HaserrorMsg.email }}</span>
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Phone No </label>
                                        <input type="text" class="form-control"  @input="clearError('phone')"   @keypress="isNumberKey"  maxlength="10" v-model="seconderyinfo.phone" placeholder="Enter Phone No">
                                        <span  class="text-danger" v-if="HaserrorMsg.phone">{{ HaserrorMsg.phone }}</span>
                                    </div>

                                    <div class="col mb-4">
                                        <button type="submit" class="btn btn-primary bcic_btns me-2" @click="saveSeconderyInfo">Submit</button>
                                        <button type="submit" class="btn btn-primary bcic_btns" data-bs-toggle="modal" data-bs-target="#adminfaultModalSm" @click="secondInfoView()" >View</button>
                                    </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <h5 class="card-title">  Real Estate Agent Details</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-3 col-lg-2 mb-3">
                                            <label class="form-label">Agency Name </label>
                                            <input type="text" @blur="updateField($event, 'job_details.real_estate_agency_name',alldatainforamtion.jobdetails[0]?.id,'Agency name')"  class="form-control" :value="alldatainforamtion.jobdetails[0]?.real_estate_agency_name" placeholder="Agency Name">
                                        </div>

                                        <div class="col-3 col-lg-2 mb-3">
                                            <label class="form-label">Agent Name </label>
                                            <input type="text" @blur="updateField($event, 'job_details.agent_name',alldatainforamtion.jobdetails[0]?.id,'Agent Name')"  class="form-control"  :value="alldatainforamtion.jobdetails[0]?.agent_name" placeholder="Agent Name">
                                        </div>


                                        <div class="col-3 col-lg-2 mb-3">
                                            <label class="form-label">Agent Number </label>
                                            <input type="text" @blur="updateField($event, 'job_details.agent_number',alldatainforamtion.jobdetails[0]?.id,'Agent Number')"  class="form-control" :value="alldatainforamtion.jobdetails[0]?.agent_number" placeholder="Agent Number">
                                        </div>


                                        <div class="col-3 col-lg-2 mb-3">
                                            <label class="form-label">Agent Email</label>
                                            <input type="text" @blur="updateField($event, 'job_details.agent_email',alldatainforamtion.jobdetails[0]?.id,'Agent Email')"  class="form-control" :value="alldatainforamtion.jobdetails[0]?.agent_email"  placeholder="Agent Email">
                                        </div>

                                        <div class="col-md-3 col-lg-2 mb-3">
                                            <label class="form-label">Agent LandLine No</label>
                                            <input type="text" @blur="updateField($event, 'job_details.agent_landline_num',alldatainforamtion.jobdetails[0]?.id,'Agency Landkine Number')"  class="form-control"  :value="alldatainforamtion.jobdetails[0]?.agent_landline_num" placeholder="Agent LandLine No">
                                        </div>

                                        <div class="col-md-3 col-lg-2 mb-3">
                                            <label class="form-label">Agent Address</label>
                                            <input type="text" @blur="updateField($event, 'job_details.agent_address',alldatainforamtion.jobdetails[0]?.id,'Agency Address')"  class="form-control" :value="alldatainforamtion.jobdetails[0]?.agent_address" placeholder="Agent Address">
                                        </div>

                                    </div>

                                </div>

                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-briefcase"></i>
                                    </div>
                                    <h5 class="card-title">Job Detail</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Work Guarantee</label>
                                        <select class="form-select" @change="updateField($event, 'jobs.work_guarantee',alldata.id, 'Work Guarantee')" v-model="alldata.work_guarantee">
                                            <option value="">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[18]" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">WG With Reason</label>
                                        <input type="text" :value="alldata.work_guarantee_text" @blur="updateField($event, 'jobs.work_guarantee_text',alldata.id, 'WG With Reason')"  class="form-control" placeholder="Reason for Work Guarantee">
                                    </div>
                                    </div>
                                </div>



                                <div class="card-header pt-0">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-user-dollar"></i>
                                    </div>
                                    <h5 class="card-title">Customer Payment</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Amount </label>
                                        <input type="text" class="form-control"  @blur="updateField($event, 'jobs.customer_amount',alldata.id, 'Amount')"  :value="alldata && alldata.customer_amount ? alldata.customer_amount : alldata?.quote_info?.amount"  placeholder="Enter Amount">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Payment Method </label>
                                        <select class="form-select" v-model="alldata.customer_payment_method" @change="updateField($event, 'jobs.customer_payment_method',alldata.id, 'Payment Method')">
                                            <option value="">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[27]" :value="item" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Paid </label>
                                        <input type="text" class="form-control" @blur="updateField($event, 'jobs.customer_paid',alldata.id, 'Paid')"  :value="alldata.customer_paid" placeholder="Enter Amount">
                                    </div>


                                    <div class="col mb-3">
                                        <label class="form-label">Paid Date </label>
                                        <input type="date" class="form-control" @change="updateField($event, 'jobs.customer_paid_date',alldata.id, 'Paid Date')" :value="alldata.customer_paid_date">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Invoice Status</label>
                                        <select class="form-select"  @change="updateField($event, 'jobs.invoice_status',alldata.id, 'Invoice Status')"  v-model="alldata.invoice_status">
                                            <option value="">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[21]" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>

                                    </div>
                                </div>




                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="otd_job_details_rightpanel">
                                        <div class="card">
                                            <nav class="p-3 pb-0">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" @click="getjobList(1)" id="nav-allnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-allnotes" type="button" role="tab" aria-controls="nav-allnotes" aria-selected="true">All Notes</button>
                                                <button class="nav-link" @click="getjobList(2)" id="nav-staffnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-staffnotes" type="button" role="tab" aria-controls="nav-staffnotes" aria-selected="false">Staff Notes</button>
                                                <button class="nav-link" @click="getjobList(3)" id="nav-highlightnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-highlightnotes" type="button" role="tab" aria-controls="nav-highlightnotes" aria-selected="false">Highlight Notes</button>
                                                <button class="nav-link" @click="getjobList(4)" id="nav-threepmnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-threepmnotes" type="button" role="tab" aria-controls="nav-threepmnotes" aria-selected="false">3PM Notes</button>
                                            </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-allnotes" role="tabpanel" aria-labelledby="nav-allnotes-tab" tabindex="0">
                                                    
                                                    <div class="text-end p-3 pt-0"> 
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type Job Note Here"
                                                        v-model="CommentType.job_comment"
                                                        @keypress="handleKeyPressNotes($event , 1)"
                                                     ></textarea>
                                                    </div>

                                                    <JobNotesList :comments="joblistcomments.job_notes"></JobNotesList>

                                                </div>

                                                <div class="tab-pane fade" id="nav-staffnotes" role="tabpanel" aria-labelledby="nav-staffnotes-tab" tabindex="0">
                                                    <!---All Notes-->
                                                    
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea class="form-control"  rows="3" placeholder="Type Staff Note Here"
                                                        v-model="CommentType.staff_comment"
                                                        @keypress="handleKeyPressNotes($event , 2)"
                                                     ></textarea>
                                                    </div>

                                                    <JobNotesList :comments="joblistcomments.staff_notes"></JobNotesList>

                                                </div>

                                                <div class="tab-pane fade" id="nav-highlightnotes" role="tabpanel" aria-labelledby="nav-highlightnotes-tab" tabindex="0">
                                                    
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea class="form-control"  rows="3" placeholder="Type highlightnotes Note Here"
                                                        v-model="CommentType.pm3_comment"
                                                        @keypress="handleKeyPressNotes($event , 3)"
                                                     ></textarea>
                                                    </div>

                                                    <JobNotesList :comments="joblistcomments.highlight_notes"></JobNotesList>
                                                </div>
                                              
                                                <div class="tab-pane fade" id="nav-threepmnotes" role="tabpanel" aria-labelledby="nav-threepmnotes-tab" tabindex="0">
                                                   <!---All Notes-->
                                                  
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea class="form-control"  rows="3" placeholder="Type 3 Pm check Note Here"
                                                            v-model="CommentType.highlight_comment"
                                                            @keypress="handleKeyPressNotes($event , 4)"
                                                        ></textarea>
                                                    </div>

                                                    <JobNotesList :comments="joblistcomments.pm3_check"></JobNotesList>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--Job Details Section End Here-->
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="adminfaultModalSm" tabindex="-1" aria-labelledby="adminfaultModalSmLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Secondery Client Info J#{{ jobId }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <table class="table table-bordered table-hover" >
                <thead class="table-primary text-nowrap">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>CreatedOn</th>
                        <!-- <th>Delete</th> -->
                    </tr> 
                </thead>
                
                <tbody>
                    <tr  v-if="secondInfoData.length > 0"  v-for="(clientinfo, index) in secondInfoData" :key="index">
                        <td>{{  index + 1 }}</td>
                        <td>{{ clientinfo.secondary_name }}</td>
                        <td>{{ clientinfo.secondary_email }}</td>
                        <td>{{ clientinfo.secondary_number }}</td>
                        <td>{{ clientinfo.createdOn }}</td>
                    </tr> 

                    <tr v-else>
                       <td colspan="6">No Records</td>
                    </tr>
                </tbody>
                                
             </table>
              
          </div>
        </div>
      </div>
</template>

<script>
// nextTick, watch
import { defineComponent, toRefs, ref, reactive, onMounted , watch } from 'vue';
//import Swal from 'sweetalert2'
import { useCommonFunction } from './../../func/function.js';
import JobNotesList from './../notes/JobNotesList.vue';


export default defineComponent({
  name: 'JobQuote',
  components:{
    JobNotesList
  },
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
    const noresultfoundImg = ref('/assets/img/noresultfound.jpg');
    const { jobId, alldata } = toRefs(props);
    const { 
              getddvaluedata , isNumberKey ,clearError ,
              validateFields , sendData ,
              createCustomSwal, createErrorCustomSwal
           } 
           = useCommonFunction();

    const  customSwal = createCustomSwal();
    const  ErrorcustomSwal = createErrorCustomSwal();       

    console.log('Job ID in job details component: ' + jobId.value);
    
    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

   

    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};
      }
    };

    const GetSystemDD = ref({});
    const getddValue = async () => {
         const ids = [35, 18, 27, 21, 160];
         GetSystemDD.value =  await getddvaluedata(ids);
         console.log(GetSystemDD.value);
    };

        const seconderyinfo = ref({
            name: '',
            email: '',
            phone: '',
        });

        const HaserrorMsg = ref({
            name: '',
            email: '',
            phone: '',
        });

        const validationRules = {
            name: { required: true },
            email: { required: true, pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, message: 'Invalid email format.' },
            phone: { required: true, pattern: /^\d{10}$/, message: 'Phone must be 10 digits.' },
        };
        const validate = () => {
               const { isValid, errors } = validateFields(seconderyinfo.value, validationRules);
                HaserrorMsg.value = errors;  // Set errors to HaserrorMsg
                return isValid;
        };
       
        const secondInfoData = ref({});

        const secondInfoView = async () => {
            const job_id = jobId.value;
            const formget = { job_id };
            console.log(formget);
            const response = await sendData('get', '/get-secondery-info', formget);
            console.log(response);
            secondInfoData.value = response.cinfo;
            
        }

        const sendEmailPopup = async (emailtype)=> 
        {
            const job_id = jobId.value;
            const  formData = {  job_id , emailtype };
            const response =  await sendData('post', '/send-popup-email', formData);
            //console.log(response);
            alldatainforamtion.all.email_client_booking_conf = response.jobsinfo.email_client_booking_conf;
            alldatainforamtion.all.email_client_cleaner_details = response.jobsinfo.email_client_cleaner_details;
            alldatainforamtion.all.sms_client_cleaner_details = response.jobsinfo.sms_client_cleaner_details;
            
            customSwal.fire({
                title: response.message,
                icon: 'success',
                iconColor: '#4CAF50',
            });

        }

        const saveSeconderyInfo = async () => { 
              

            if (!validate()) {
                // If validation fails, do not proceed
                return;
            }

            try {
                    seconderyinfo.value.job_id = jobId.value;
                    seconderyinfo.value.quote_id = alldatainforamtion.quote_info.id;
                    const response = await sendData('post', '/save-secondery-info', seconderyinfo.value);

                    customSwal.fire({
                        title: 'Secondary Information added successfully',
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                    seconderyinfo.value.job_id = '';
                    seconderyinfo.value.quote_id = '';
                    seconderyinfo.value = {};

                //secondInfoData = response;
            } catch (error) {
                console.error('Save failed:', error);
            }

        };
        
            const joblistcomments = reactive({
                job_notes : {},
                staff_notes : {},
                highlight_notes : {},
                pm3_check :{}
            });
            const getjobList = async (notestype) => {
                
                 //console.log('Call Notes List' + notestype);

                const job_id = jobId.value;
                const formData = { job_id, notestype };

                try {
                    const response = await sendData('get', '/get-job-list', formData);

                    switch (notestype) {
                        case 1:
                            joblistcomments.job_notes = response.job_note;
                            break;
                        case 2:
                            joblistcomments.staff_notes = response.job_note;
                            break;
                        case 3:
                            joblistcomments.highlight_notes = response.job_note;
                            break;
                        case 4:
                            joblistcomments.pm3_check = response.job_note;
                            break;
                        default:
                            console.error(`Unknown notestype: ${notestype}`);
                    }
                } catch (error) {
                    console.error("Error fetching job list:", error);
                }
            };
 
                const CommentType = ref({
                    job_comment: '',
                    staff_comment: '',
                    pm3_comment: '',
                    highlight_comment: '',
                });

                const addComment = async (notestype) => {
                    let commentNotes = '';

                    switch (notestype) {
                        case 1:
                            if (!CommentType.value.job_comment.trim()) return;
                            commentNotes = CommentType.value.job_comment;
                            break;
                        case 2:
                            if (!CommentType.value.staff_comment.trim()) return;
                            commentNotes = CommentType.value.staff_comment;
                            break;
                        case 3:
                            if (!CommentType.value.pm3_comment.trim()) return;
                            commentNotes = CommentType.value.pm3_comment;
                            break;
                        case 4:
                            if (!CommentType.value.highlight_comment.trim()) return;
                            commentNotes = CommentType.value.highlight_comment;
                            break;
                        default:
                            return;  // Exit if an unknown type is passed
                    }

                    const commentData = {
                        job_id: jobId.value,
                        comment: commentNotes,
                        notestype: notestype,
                    };

                    try {
                        const response = await sendData('post', '/add-job-notes', commentData);
                        
                        // Reset the comment field after submission
                        CommentType.value = {
                            job_comment: '',
                            staff_comment: '',
                            pm3_comment: '',
                            highlight_comment: '',
                        };

                        switch (notestype) {
                            case 1:
                                joblistcomments.job_notes = response.job_note;
                                break;
                            case 2:
                                joblistcomments.staff_notes = response.job_note;
                                break;
                            case 3:
                                joblistcomments.highlight_notes = response.job_note;
                                break;
                            case 4:
                                joblistcomments.pm3_check = response.job_note;
                                break;
                        }
                    } catch (error) {
                        console.error("Error adding comment:", error);
                    }
                };

                const updateField = async (event, fieldtable, tid, leavelName = null)=> {

                        const value = event.target.value;
                        const job_id = jobId.value;
                        const formData = {value,fieldtable,tid, job_id};

                        // console.log(formData);


                        const response = await sendData('post', '/edit-field-update', formData);

                            if (response.success === true) {
                                customSwal.fire({
                                    title: leavelName + ' ' + response.message,
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


                const handleKeyPressNotes = (event, type) => {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        addComment(type);
                    }
                };

        watch(alldata, (newVal) => {
            if (hasMounted.value && newVal) {
                getallData();
                getjobList(1);
                console.log('hello Pankaj Job Notes call')
            }
            },
            //{ deep: true }
        ); 
        
    // Call getddValue when the component is mounted
    onMounted(() => {
      hasMounted.value = true;
      getddValue();
      getjobList(1);
    });

    return {
        jobId,
        noresultfoundImg,
        alldata,
        getallData,
        alldatainforamtion,
        GetSystemDD,
        getddValue,

        seconderyinfo,
        HaserrorMsg,
        saveSeconderyInfo,
        clearError: (field) => clearError(HaserrorMsg, field),
        isNumberKey,
        secondInfoData,
        secondInfoView,
        sendEmailPopup,
        joblistcomments,
        getjobList,

        handleKeyPressNotes,
        addComment,
        CommentType,
        updateField,
       // newjobComment,

     
    };
  }
});

</script>

