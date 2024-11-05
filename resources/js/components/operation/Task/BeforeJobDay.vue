<template>
    <!-- <pre> {{  trackdata.data }}</pre>  -->
        <div class="kanban-items-container" v-if="trackdata.data.length > 0 " v-for="(trackdata , index) in trackdata.data" :key="index"> 
         
            <div class="d-flex justify-content-between"> 
            <div class="avatar-group dropdown">
                <!-- <div class="avatar avatar-s" id="page-contactdetails-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="avatar-placeholder rounded-circle" />
                </div> -->
                <span class="fs-6 fw-medium ps-2">{{ trackdata.name }}</span>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover" aria-labelledby="page-contactdetails-dropdown">
                    <div class="contact_box_hedaer">
                        <h6 class="m-0" key="t-notifications">Details</h6>
                    </div>
                    <div class="contact_box_details">
                        <ul class="">
                            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)">
                                <i class="ti ti-user-circle"></i> {{ trackdata.name }}
                            </li>
                            <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i> {{ trackdata.sitename }}</li>
                            <li class="kanban-icon kanban-date"><i class="ti ti-calendar-stats"></i> {{ trackdata.booking_date }}</li>
                            <li class="kanban-icon kanban-phone"><i class="ti ti-email"></i> {{ trackdata.email }}</li>
                        </ul>

                       
                    </div>
                </div>
            </div>

            <div class="kanban-items-btns">
                <button class="btn btn-soft-info" data-bs-toggle="modal" data-bs-target="#operationautotaskFullscreen" @click="triggerPopupinfo(trackdata)" ><i class="ti ti-file-info"></i></button>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-1">
            <ul>
                <ul>
                    <li class="kanban-icon kanban-user">
                        
                        <i class="ti ti-user-circle"></i>
                        <a href="javascript:void(0)" 
                            @click="openNewWindow('jobpopup?tab=job_reclean&job_id=' + trackdata.booking_id,'1500','800')">
                            (J#{{ trackdata.booking_id }})
                        </a>
                        <!-- <a href="#0"> (#J {{ trackdata.booking_id }} ) </a> -->
                    </li>
                    <li class="kanban-icon kanban-location">
                        <i class="ti ti-phone-call"></i>
                        <a :href="'tel:' + trackdata.phone">{{ trackdata.phone }}</a>
                    </li>
                  
                </ul>
                
            </ul>

            <ul class="kanban-items-right">
                <li class="kanban-icon kanban-location" v-if="trackdata.booking_id > 0"><i class="ti ti-user-circle"></i> 
                    {{ trackdata.sitename }}
                </li>
                <li class="kanban-icon kanban-price"><i class="ti ti-premium-rights"></i>  $ {{ trackdata.amount }} </li>
            </ul>
           

        </div>
          <div><a :href="'mailto:' + trackdata.email">{{ trackdata.email }}</a></div>
          <p>{{ trackdata.job_types }}</p>
    </div>
</template>

<script>

import { defineComponent, ref } from 'vue'; // Import necessary functions
import { useCommonFunction } from './../../../func/function.js'; // Import your common functions

export default defineComponent({
  name: 'OntheDayJobs',
  props: {
    trackdata: {
      type: Object,
      required: true, // Ensure this prop is required
    },
    ddvalue: {
        type : [Object, Array],
        required: false,
    },
    indexKey:{
        type : [Number, String],
        required : true
    },
    trackName:{
        type:String,
        required:true
    }
  },  
  emits: ['popup-name'] ,
  setup(props , { emit }) {
    // Destructure the openNewWindow function from useCommonFunction
    const { openNewWindow } = useCommonFunction();

    // Define reactive or ref variables (if needed)
    const someData = ref(null);

   
    const triggerPopupinfo = (trackInfo) => { 
          
        const job_id = trackInfo.booking_id;
        const quote_id = trackInfo.qid;
        const subTrackid = parseInt(props.indexKey);
        const trackid = 1;
        const pageName = 'Before-Job';
        const trackName = props.trackName;
        const formData = {job_id, quote_id, subTrackid, trackid,pageName, trackName};
        
        setTimeout(() => {
            emit('popup-name', formData); // emit the event after a delay
        }, 1000); // Delay of 200 milliseconds
    }

 
    // Return any variables or functions you want to expose to the template
    return {
      someData,
      openNewWindow,
      triggerPopupinfo,
    };
  },
});
</script>
