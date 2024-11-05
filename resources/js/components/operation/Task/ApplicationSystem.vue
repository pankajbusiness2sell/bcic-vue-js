<template>
    <div class="kanban-items-container" v-if="trackdata.data.length > 0 " v-for="(trackdata , index) in trackdata.data" :key="index">
        <div class="d-flex justify-content-between">
             <!-- {{  trackdata  }} -->
            <div class="avatar-group dropdown">
                <div class="avatar avatar-s" id="page-contactdetails-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="avatar-placeholder rounded-circle" />
                </div>
                <span class="fs-6 fw-medium ps-2">{{ trackdata.first_name }}</span>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover" aria-labelledby="page-contactdetails-dropdown">
                    <div class="contact_box_hedaer">
                        <h6 class="m-0" key="t-notifications">Details</h6>
                    </div>
                    <div class="contact_box_details">
                        <ul class="">
                            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)">
                                <i class="ti ti-user-circle"></i> {{ trackdata.first_name }}
                            </li>
                            <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i> {{ trackdata.siteid }}</li>
                            <li class="kanban-icon kanban-date"><i class="ti ti-calendar-stats"></i> {{ trackdata.date_started }}</li>
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

        <div  class="d-flex justify-content-between mt-1">
            <ul>
                <li class="kanban-icon kanban-user"><i class="ti ti-user-circle"></i> <a href="#0">(#A{{ trackdata.id }})</a></li>
                <li class="kanban-icon kanban-location"><i class="ti ti-phone-call"></i><a :href="'tel:' + trackdata.mobile">{{ trackdata.mobile }}</a> </li>
                
                
            </ul>

            <ul class="kanban-items-right">
                <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i> {{ trackdata.siteid }}</li>
                <li class="kanban-icon kanban-location"><i class="ti ti-phone-call"></i> {{ trackdata.date_started }}</li>
                <!-- <li class="kanban-icon kanban-price"><i class="ti ti-premium-rights"></i> 480</li> -->
            </ul>
        </div>
        <div>{{ trackdata.email }}</div>
        <div>{{ trackdata.adminname }}</div>
    </div>
</template>
<script>
import { defineComponent, ref, reactive, onMounted } from 'vue'; // Import necessary functions
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

    // Lifecycle hooks
    onMounted(() => {
       // emit('popup-name', {});
      // Perform any setup logic once the component is mounted
      //console.log('Component mounted');
      //console.log('Track data:', props.trackdata); // Access prop data
    });

    // Return any variables or functions you want to expose to the template
    return {
      someData,
      openNewWindow,
    };
  },
});
</script>
