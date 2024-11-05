<template>

    <div class="d-flex justify-content-between" ref="childElement">
        <div class="avatar-group dropdown">
            <span class="fs-6 fw-medium ps-2"> {{ trackData.Pagetype }} ({{  trackData.task_admin_name }}) </span>
    
                    <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover"
                            aria-labelledby="page-contactdetails-dropdown">
                            <div class="contact_box_hedaer">
                                <h6 class="m-0" key="t-notifications"> Details [ Q#{{ trackData.job_id }} ] </h6>
                            </div> 
                            <div class="contact_box_details">
                              <div class="d-flex justify-content-between" >
                                    <ul class="">
                                        <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)" > <i class="ti ti-user-circle"></i> {{ trackData.name }}</li>
                                        <li class="kanban-icon kanban-email" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="cjh89@outlook.com.au"><i class="ti ti-mail"></i> {{ trackData.email }} </li>
                                        <li class="kanban-icon kanban-phone" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="XXXX-7327"><i class="ti ti-phone-call"></i> <a href="#0">{{ trackData.phone }}</a></li>
                                    </ul>

                                    <ul class="me-2">
                                          <li class="location-item">
                                            <i class="ti ti-location-pin"></i> {{ trackData.site_name }}
                                          </li>
                                          <li class="amount-item">
                                            <i class="ti ti-dollar-sign"></i> $ {{ (trackData.amount > 0) ? trackData.amount : 0 }}
                                          </li>
                                          <li class="job-ref-item">
                                            <i class="ti ti-tag"></i> {{ trackData.job_ref }}
                                          </li>
                                    </ul>
                               </div>
                            </div>
    
                    </div> -->
        </div>
    
        <div class="kanban-items-btns">
            <button class="btn btn-soft-success me-1"  @click="triggerPopupinfo(trackData)" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="ti ti-pencil-minus"></i></button>
            <!-- <button class="btn btn-soft-info" @click="gettrackInfo(trackData.quote_id , trackData.pageid)"  ><i class="ti ti-file-info"></i> </button> -->
        </div>
    </div>
    
    <div class="d-flex justify-content-between mt-1" >
        <ul>
            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)" > <i class="ti ti-user-circle"></i> {{ trackData.name }} <a href="#0">(S#{{ trackData.staff_id }})</a></li>
            <!-- <li class="kanban-icon kanban-email" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="cjh89@outlook.com.au"><i class="ti ti-mail"></i> {{ trackData.email }}</li> -->
           
        </ul>
    
        <ul class="kanban-items-right">
            <li class="kanban-icon kanban-date text-nowrap"> {{ trackData.fallow_date_time }}</li>
            <li class="kanban-icon  me-1">
              <select name="step" class="form-select" @change="statusUpdate($event, trackData.id, 'S#'+trackData.staff_id)" v-model="trackData.message_status">
                  <option value="0">Select</option>
                  <option :value="sKey" v-for="(svalue, sKey) in trackData.statusdd" :key="sKey" >{{ svalue  }}</option>
              </select>
            </li>
            <!-- <li class="kanban-qd"><span>QD</span> {{ trackData.quotedate }}</li> -->
        </ul>
    </div>

    <div class="d-flex justify-content-full">
        <span v-if="trackData.heading" v-html="trackData.heading"></span>
        <span v-else v-html="trackData.comment"></span>
     </div>



</template>

<script>
import { defineComponent, ref } from 'vue'; // Import necessary functions
import axios from 'axios'; // Import axios for HTTP requests
import Swal from 'sweetalert2'

export default defineComponent({
  components: {
    //QuoteNotes
  },
  props: {
    trackData: {
      type: [Object, Array],
      required: false,
      default: () => ({})
    },
  },
  emits: ['quoteDetails','popup-name'] ,
    setup(props ,  { emit }) {
     

        const trackInfo = ref({ 
           Parenttrackid : 0,
           pageid : 0,
        });

        const gettrackInfo  = (trackid , pageid) => {
            try {
                    trackInfo.value.Parenttrackid = trackid;
                      trackInfo.value.pageid = parseInt(pageid);
                    emit('quoteDetails', trackInfo.value);
                    // Initialize and show the Bootstrap offcanvas
                
                } catch (error) {
                    // Handle errors gracefully
                    console.error('Error fetching quote details:', error);
                }
        }

       

        const childElement = ref({});
        const triggerPopupinfo =(popupname) => {
          emit('popup-name',popupname);
        }

        const statusUpdate = async(event ,salesid,quote_id)=> {

            const response = await axios.get('sales-status-update', {
                  params: {
                    value: event.target.value, 
                    salesid: salesid,
                  }
              });
              console.log(response);
              if(response.status == 200) {
                
 
                  if ( (childElement.value && childElement.value.parentElement) && (event.target.value == 3) ) {
                            
                            const divdata = childElement.value.parentElement.parentElement.parentElement;
                  
                            if (divdata) {
                              // Get the first element with the kanban-header class
                              const headerElement = divdata.querySelector('.kanban-header');
                              if (headerElement) {
                                // Get the kanban-column-title and kanban-title-badge elements
                                const columnTitleElement = headerElement.querySelector('.kanban-column-title');
                                const titleBadgeElement = headerElement.querySelector('.kanban-title-badge');
                                
                                if (titleBadgeElement) {
                                  // Update the kanban-title-badge text content
                                  //console.log(titleBadgeElement.textContent);
                                  titleBadgeElement.textContent = parseInt(parseInt(titleBadgeElement.textContent) - 1); // Replace with your dynamic value
                                }
                              }
                            }
                            childElement.value.parentElement.remove();
                  }
                
                const respdata = quote_id +' moved in ' + response.data
                  customSwal.fire({
                    title: respdata,
                    icon: 'success',
                    iconColor: '#4CAF50',
                  });


              } 
            }


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

        return {
           gettrackInfo,
           triggerPopupinfo,
           statusUpdate ,
           childElement
        }
    }
});
</script>


  