<template>
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
        </ul>
    
    </div>
</template>