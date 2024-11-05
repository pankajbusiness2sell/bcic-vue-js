<template>
     
    <!-- <pre> {{ trackdata.data }}</pre> -->
    <div class="kanban-items-container"  v-if="trackdata.data.length > 0 " v-for="(trackdata , trackindex) in trackdata.data" :key="trackindex">
        
         <!-- <pre> {{  trackdata.data }}</pre> -->

        <div class="d-flex justify-content-between">
            <div class="avatar-group dropdown">
                <!-- <div class="avatar avatar-s" id="page-contactdetails-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="avatar-placeholder rounded-circle" />
                </div> -->
                <span class="fs-6 fw-medium ps-2">{{  trackdata.name }}</span>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover" aria-labelledby="page-contactdetails-dropdown">
                    <div class="contact_box_hedaer">
                        <h6 class="m-0" key="t-notifications">Details</h6>
                    </div>
                    <div class="contact_box_details">
                        <ul class="">
                            <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i>C# {{  trackdata.id }}</li>
                            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)">
                                <i class="ti ti-user-circle"></i> {{  trackdata.name }}
                            </li>
                            <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i> {{  trackdata.site_id }}</li>
                            <li class="kanban-icon kanban-date"><i class="ti ti-calendar-stats"></i> {{  trackdata.booking_date }}</li>
                        </ul>

                        <!-- <div class="kanban-f-icon mt-2">
                            <ul>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cleaning"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pest"></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- <div class="kanban-items-btns">
                <button class="btn btn-soft-info" data-bs-toggle="offcanvas" data-bs-target="#operationcanvasRight" aria-controls="operationcanvasRight"><i class="ti ti-file-info"></i></button>
            </div> -->
        </div>

        <div class="d-flex justify-content-between mt-1">
            <ul>
                <li class="kanban-icon kanban-user"><i class="ti ti-user-circle"></i> <a href="#0">(#C{{ trackdata.id }})</a></li>
                <li class="kanban-icon kanban-location"><i class="ti ti-phone-call"></i> <a href="tel:0402238953">{{ trackdata.phone }}</a></li>
                
            </ul>

            <ul class="kanban-items-right">
                <li class="kanban-icon kanban-email"><i class="ti ti-user-circle"></i> J#{{ trackdata.job_id }} </li>
                <li class="kanban-icon kanban-price"><i class="ti ti-premium-rights"></i> {{ trackdata.booking_date }}</li>
            </ul>
        </div>
        
         <div>{{ trackdata.jobtype }}</div>
         <div>{{ trackdata.email }}</div>
         <div class="mt-1" v-if="indexKey == 1">
            <select class="form-select" v-model="trackdata.complaint_type">
                <option value="0">Select</option>
                <option  v-for="(name, index) in ddvalue[125]" :key="index" :value="index">{{ name }}</option>
            </select>
        </div>
        <div class="mt-1">
            <select class="form-select" v-model="trackdata.complaint_step_status">
                <option value="0">Select</option>
                <option  v-for="(name, index) in ddvalue[137]" :key="index" :value="index">{{ name }}</option>
            </select>
        </div>
        <div class="mt-1" v-if="indexKey == 12">
            <select class="form-select" v-model="trackdata.debt_rec_type">
                <option value="0">Select</option>
                <option  v-for="(name, index) in ddvalue[205]" :key="index" :value="index">{{ name }}</option>
            </select>
        </div>
        <!-- <span>{{ typeof trackdata.complaint_step_status }}</span> -->
        <div class="mt-1" v-if="indexKey == 13">
            <select class="form-select" v-model="trackdata.tribunal_type">
                <option value="0">Select</option>
                <option  v-for="(name, index) in ddvalue[206]" :key="index" :value="index">{{ name }} </option>
            </select>
        </div>
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

   
   
 
    // Return any variables or functions you want to expose to the template
    return {
      someData,
      openNewWindow,
    };
  },
});
</script>