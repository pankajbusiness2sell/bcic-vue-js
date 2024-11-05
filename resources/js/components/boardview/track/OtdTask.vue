<template>

    <div class="d-flex justify-content-between">
        <div class="avatar-group dropdown">
            <span class="fs-6 fw-medium ps-2"> {{ trackData.Pagetype }} ({{  trackData.task_admin_name }}) </span>
    
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover"
                            aria-labelledby="page-contactdetails-dropdown">
                            <div class="contact_box_hedaer">
                                <h6 class="m-0" key="t-notifications"> Details [ {{ formattedId }} ] </h6>
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
    
                                <div class="kanban-f-icon mt-2">
                                    <ul v-if="trackData.imgstr.length > 0">
                                        <li v-for="(jobImg, index) in trackData.imgstr" :key="index"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            :data-bs-title="jobImg.job_type">
                                          <img :src="`./job_type_icon/${jobImg.icon}`" :alt="jobImg.job_type"/>
                                        </li>
                                      </ul>
                                </div>
    
                            </div>
    
                    </div>
        </div>
    
        <div class="kanban-items-btns">
            <button class="btn btn-soft-success me-1"  @click="triggerPopupinfo(trackData)"  data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="ti ti-pencil-minus"></i></button>
            <!-- <button class="btn btn-soft-info" @click="gettrackInfo(trackData.quote_id , trackData.pageid)"  ><i class="ti ti-file-info"></i> </button> -->
        </div>
    </div>
    
    <div class="d-flex justify-content-between mt-1" >
        <ul>
            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)" > <i class="ti ti-user-circle"></i> {{ trackData.name }} <a href="#0">{{  formattedId  }}</a></li>
            <li class="kanban-icon kanban-email" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="cjh89@outlook.com.au"><i class="ti ti-mail"></i> {{ trackData.email }}</li>
            <li class="kanban-icon kanban-phone" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="XXXX-7327"><i class="ti ti-phone-call"></i> <a href="#0">{{ trackData.phone }}</a></li>
           
        </ul>
    
        <ul class="kanban-items-right">
            <li class="kanban-icon kanban-date text-nowrap"> {{ trackData.fallow_date_time }}</li>
            <li class="kanban-bd"> {{ trackData.reclean_status }}</li>
            <li class="kanban-icon kanban-date text-nowrap">
              <select name="step" class="form-select" v-model="trackData.is_task_status" @change="statusUpdate($event, trackData.id, formattedId || '')">
                  <option value="0">Select</option>
                  <option :value="sKey" v-for="(svalue, sKey) in trackData.statusdd" :key="sKey" >{{ svalue  }}</option>
              </select>
            </li>
            <!-- <li class="kanban-qd"><span>QD</span> {{ trackData.quotedate }}</li> -->
        </ul>
    </div>

    <div class="d-flex justify-content-full">
        <span v-html="trackData.comment"></span>
     </div>



</template>

<script>
import { defineComponent,computed, ref } from 'vue'; // Import necessary functions
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

        const gettrackInfo  =  (trackid , pageid) => {
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

        const formattedId = computed(() => {
            const { quote_id, job_id, app_id , staff_id} = props.trackData;
            if (quote_id > 0) {
            return `(Q#${quote_id})`;
            } else if (job_id > 0) {
            return `(J#${job_id})`;
            } else if (app_id > 0) {
            return `(A#${app_id})`;
            }else if (staff_id > 0) {
            return `(S#${staff_id})`;
            }
            return ''; // Default if no condition is met
        });

        const triggerPopupinfo = (popupInfo) => {
            emit('popup-name', popupInfo);
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
           formattedId,
           triggerPopupinfo,
           statusUpdate
        }
    }
});
</script>


  