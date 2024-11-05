<template>
     <!--Information First Section Start Here-->
 <div class="otd-job-details-information mt-3">
    <h3>Customer Information</h3>
    <ul class="bcic_otd_info">
        <li><strong>#Q For :</strong>  <span class="vq_id"><i class="ti ti-id"></i> 19931 ( BCIC ) </span> </li>
        <li><strong>Reference : </strong> 0 </li>
        <li><strong>Name : </strong> Pankaj </li>
        <li><strong>Email : </strong> pankaj.business2sell@gmail.com </li>
        <li><strong>Phone : </strong> 4444444444 </li>
        <li><strong>Site : </strong> Sydney ( DAWES POINT ) </li>
        <li><strong>Job Date : </strong> 23rd Aug 2024 </li>
        <li><strong>Amt : </strong> <span class="otd_price"> $400 </span></li>
        <li><strong>Pymt By : </strong> Pankaj </li>
        <li><strong>Amt Charged : </strong> 100.00 </li>
        <li><strong>Status : </strong>
            <select  class="form-select">
                <option value="0">Select</option>
                <option value="1" selected="">Active</option>
                <option value="2">Cancelled</option>
                <option value="3">Completed</option>
                <option value="4">Complaints</option>
                <option value="5">Reclean</option>
                <option value="6">Onhold</option>
                <option value="7">Dispute</option>
                <option value="8">Damage</option>
                <option value="9">Awaiting Exit Report</option>
                <option value="10">Payment Delayed</option>
            </select>
        </li>
        <li><strong>Quote Hours : </strong> 8 Hours </li>
        <li><strong>Team Size :  </strong> 1 </li>
        <li><strong>T&C Accep : </strong> Yes </li>
        <li><strong>Have Remova : </strong> </li>
        <li class="bc_click_btn"><strong>Job Assigned : </strong>
            <ul>
                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cleaning"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><circle cx="36.096" cy="22.654" r="1.393" fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round"></circle><circle cx="40.222" cy="26.814" r="1.672" fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round"></circle><path fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round" d="m12.213 10.465l11.304 1.98m-7.97 2.031l7.345 1.302m-9.48 1.562l8.959 1.563m6.579 13.093l-.277-3.404c-.694-4.605-6.012-5.723-7.657-1.276c-1.821 3.764-8.313 7.281-15.418 8.151c2.863 9.246 18.17 7.426 20.263 4.74"></path><path fill="none" stroke="#138062" stroke-linecap="round" stroke-linejoin="round" d="M26.955 34.79c-4.982 2.828-.246 7.569 2.604 5.73c2.071 2.777 6.469 2.25 7.5.156c5.886 2.626 7.238-5.573 2.397-6.302c-1.076-3.761-4.968-4.413-7.293-2.136c-1.987-.49-4.029-1.266-5.209 2.552M9.297 17.407v1.51m0 2.353v1.51m1.228-2.686l1.51.052m-5.373 0h1.51m5.899 7.796l1.031 1.105m0-3.873l-1.068 1.068m-2.731-.995l1.068 1.068m0 1.59l-1.068 1.068m9.713-1.657c2.328 1.94 4.939 1.975 7.657 1.276M10.978 41.135c5.694-1.93 9.219-4.403 11.184-7.282m-.052 4.636c-1.116 1.544-2.471 2.825-4.766 3.878M7.102 38.31c3.241-.09 5.776-1.216 8.237-2.478m8.373-11.216l3.217-17.172c.448-2.972 3.947-2.119 3.268.573L26.833 25.29"></path></svg></li>
                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 50 50"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke="#138062" d="M14.583 33.333H31.25v-12.5H14.583z"></path><path stroke="#138062" d="M10.417 41.667H37.5a2.083 2.083 0 0 0 2.083-2.084v-25A2.083 2.083 0 0 0 37.5 12.5H14.583"></path><path stroke="#138062" d="M43.75 35.417h-4.167m-25-22.917v25a4.167 4.167 0 1 1-8.333 0v-25a4.167 4.167 0 1 1 8.333 0m-4.166 20.833a4.166 4.166 0 1 0 0 8.333a4.166 4.166 0 0 0 0-8.333M43.75 18.75h-4.167zm0 8.333h-4.167z"></path></g></svg></li>
            </ul>
        </li>
    </ul>
</div>
<!--Information First Section End Here-->




<!--Information First Section Start Here-->
<div class="otd-job-details-information mt-4">
    <h3>Quote Information</h3>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Review Email</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>

        <div class="col mb-3" >
            <label class="form-label">Estimate </label>
            <select class="form-select">
                <option value="0">Select</option>
                <option value="1">No</option>
                <option value="2">Approved-yes</option>
                <option value="3">Fixed Price</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Assigning Status</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Job Assigning Status</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="1">Auto</option>
                <option value="2">Manual</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Booking Admin</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Select</option>
                <option value="3">Payal</option>
                <option value="4">Puja</option>
                <option value="12">Nadia</option>
                <option value="15">Huma</option>
                <option value="17" selected="">Pankaj</option>
                <option value="31">Manik</option>
                <option value="34">Jarryd</option>
                <option value="38">Brooke</option>
                <option value="41">Payal Panda</option>
                <option value="48">Ankit_2</option>
                <option value="49">Akhil</option>
                <option value="51">Elle</option>
                <option value="52">Vishal</option>
                <option value="54">Charlotte</option>
                <option value="56">Rahul</option>
                <option value="57">Joanne</option>
                <option value="58">Training</option>
                <option value="60">Vikas</option>
                <option value="61">Advit_test</option>
                <option value="63">Kylie</option>
                <option value="64">Sonali</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label"> Online Payment</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Deposit</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>



    </div>
    <div class="row">


        <div class="col mb-3">
            <label class="form-label">Re-Quoting </label>
            <select class="form-select">
                <option value="0">Select</option>
                <option value="1">Approved</option>
                <option value="2">Denied</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label"> Re-Quoting Required</label>
            <select class="form-select">
                <option value="0">Select</option>
                <option value="1">Required</option>
                <option value="2">Complete</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Re-Quoting Admin</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="0">Select</option>
                <option value="3">Payal</option>
                <option value="4">Puja</option>
                <option value="12">Nadia</option>
                <option value="15">Huma</option>
                <option value="17" selected="">Pankaj</option>
                <option value="31">Manik</option>
                <option value="34">Jarryd</option>
                <option value="38">Brooke</option>
                <option value="41">Payal Panda</option>
                <option value="48">Ankit_2</option>
                <option value="49">Akhil</option>
                <option value="51">Elle</option>
                <option value="52">Vishal</option>
                <option value="54">Charlotte</option>
                <option value="56">Rahul</option>
                <option value="57">Joanne</option>
                <option value="58">Training</option>
                <option value="60">Vikas</option>
                <option value="61">Advit_test</option>
                <option value="63">Kylie</option>
                <option value="64">Sonali</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Operations</label>
            <select class="form-select">
                <option value="3" selected="">Payal</option>
                <option value="12">Nadia</option>
                <option value="34">Jarryd</option>
                <option value="57">Joanne</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label"> QC</label>
            <select class="form-select">
                <option selected="">select</option>
                <option value="1">Pending</option>
                <option value="2">Done</option>
            </select>
        </div>

        <div class="col mb-2">
            <ul class="bcic_view_q_btns">
                <li><button type="submit" class="btn btn-primary bcic_btns">Save</button></li>
                <li><button type="submit" class="btn btn-danger bcic_btns">Fault</button></li>
            </ul>
        </div>




    </div>
</div>
<!--Information First Section End Here-->



<!--Information First Section Start Here-->
<div class="otd-job-details-information mt-4">
    <h3>Customer Information</h3>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Start Time</label>
            <select class="form-select">
                <option value="0">Select</option>
                <option value="1">6 To 8 Am</option>
                <option value="2">7 To 9 Am</option>
                <option value="3">8 To 10 Am</option>
                <option value="4">9 To 11 Am</option>
                <option value="6">11 To 13 Pm</option>
                <option value="5">10 To 12 Pm</option>
                <option value="7">12 To 14 Pm</option>
                <option value="8">13 To 15 Pm</option>
                <option value="9">14 To 16 Pm</option>
                <option value="10">15 To 17 Pm</option>
                <option value="11">16 To 18 Pm</option>
            </select>
        </div>

        <div class="col mb-3">
            <label class="form-label">Get Entry</label>
            <input type="text" class="form-control" placeholder="">
        </div>

        <div class="col mb-3">
            <label class="form-label">Cleaner Park</label>
            <input type="text" class="form-control" placeholder="">
        </div>

        <div class="col mb-3">
            <label class="form-label">SQM</label>
            <input type="text" class="form-control" placeholder="">
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

<div class="otd_job_details_btn mt-3">
    <ul>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=edit_quote&job_id=' + QueryParms.job_id,'1400','800')">Quote </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=job_details&job_id=' + QueryParms.job_id,'1400','800')">Job Details </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=job_type&job_id=' + QueryParms.job_id,'1400','800')">Job Types </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=job_reclean&job_id=' + QueryParms.job_id,'1400','800')">Job Reclean </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=job_payment&job_id=' + QueryParms.job_id,'1400','800')">Payment </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=email_client&job_id=' + QueryParms.job_id,'1400','800')">Email Client </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=send_sms&job_id=' + QueryParms.job_id,'1400','800')">Send SMS / Notification</a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=view_invoice&job_id=' + QueryParms.job_id,'1400','800')">View Invoice </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=view_email&job_id=' + QueryParms.job_id,'1400','800')">View Emails </a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=upload_images&job_id=' + QueryParms.job_id,'1400','800')">Upload Image</a></li>
		
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=task_history&job_id=' + QueryParms.job_id,'1400','800')">Task History</a></li>
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=view_checklist&job_id=' + QueryParms.job_id,'1400','800')">View CheckList</a></li>
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=cleaner_notes&job_id=' + QueryParms.job_id,'1400','800')">Cleaner Notes</a></li>
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=assign_hitory&job_id=' + QueryParms.job_id,'1400','800')">Assign History</a></li>
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=admin_fault&job_id=' + QueryParms.job_id,'1400','800')">Admin Fault</a></li>
		<li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=add_review&job_id=' + QueryParms.job_id,'1400','800')">Add review</a></li>
        <li><a href="javascript:void(0)" @click="openNewWindow('job_popup?tab=call_list&job_id=' + QueryParms.job_id,'1400','800')">Call List</a></li>
    </ul>

    
    
</div>
<!--Information First Section End Here-->
</template>

<script>
import { defineComponent, onMounted, reactive } from 'vue'; // Import necessary functions
import { useCommonFunction } from '../../../func/function.js';
//import PopupHeader from './PopupHeader.vue';

export default defineComponent({

    components : {
        //PopupHeader
    },

    setup() { 
        const QueryParms = reactive({
            tab: '',
            job_id: 0
        });

        const getQueryParms = () => {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            console.log('Pankaj test');
            QueryParms.tab = params.get('tab');
            QueryParms.job_id = params.get('job_id');
        };

        const { openNewWindow } = useCommonFunction();

        onMounted(() => {
            getQueryParms(); // Call the function here
        });

        // Other reactive variables or functions can go here

        return {
            openNewWindow,
            getQueryParms,
            QueryParms
        };
    }
});
</script>

