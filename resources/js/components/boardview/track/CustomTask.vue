<template>
    <div>
      <div class="d-flex justify-content-between">
        <div class="avatar-group dropdown">
          <span class="fs-6 fw-medium ps-2">
            {{ trackData.Pagetype }} ({{ trackData.task_admin_name }})
          </span>
          <!-- Optional dropdown menu -->
          <!--
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover" aria-labelledby="page-contactdetails-dropdown">
            <div class="contact_box_header">
              <h6 class="m-0"> Details [ A# {{ trackData.app_id }} ] </h6>
            </div>
            <div class="contact_box_details">
              <ul>
                <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top">
                  <i class="ti ti-user-circle"></i> {{ trackData.first_name }}
                </li>
                <li class="kanban-icon kanban-email" data-bs-toggle="tooltip" data-bs-placement="top">
                  <i class="ti ti-mail"></i> {{ trackData.email }}
                </li>
                <li class="kanban-icon kanban-phone" data-bs-toggle="tooltip" data-bs-placement="top">
                  <i class="ti ti-phone-call"></i> <a href="#0">{{ trackData.site_name }}</a>
                </li>
              </ul>
            </div>
          </div>
          -->
        </div>
  
        <div class="kanban-items-btns">
          <button class="btn btn-soft-success me-1" @click="triggerPopupinfo(trackData)" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
            <i class="ti ti-pencil-minus"></i>
          </button>
          <!-- <button class="btn btn-soft-info" data-bs-toggle="offcanvas" data-bs-target="#offcanvasViewqrightSide" aria-controls="offcanvasViewqrightSide"  @click="gettrackInfo(trackData.app_id, trackData.pageid)">
            <i class="ti ti-file-info"></i>
          </button> -->
        </div>
      </div>
  
      <div class="d-flex justify-content-between mt-1">
        <ul>
          <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="ti ti-user-circle"></i>{{ formattedId }}
          </li>
          <li class="kanban-icon kanban-email" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="ti ti-mail"></i>P{{ trackData.priority_status }}
          </li>
          <li class="kanban-icon kanban-phone" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="ti ti-phone-call"></i> {{ trackData.departmentName }} -> {{ trackData.task_type_noti }}
          </li>
          
          <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="ti ti-mail"></i>By : - {{ trackData.staff_name }} to {{ trackData.login_id }}
          </li>

        </ul>
  
        <ul class="kanban-items-right">
          <li class="kanban-icon kanban-date text-nowrap">{{ trackData.fallow_date_time }}</li>
          <li class="kanban-icon me-1">
            <select name="step" class="form-select" v-model="trackData.message_status">
                <option value="0">Select</option>
                <option :value="sKey" v-for="(svalue, sKey) in trackData.statusdd" :key="sKey" >{{ svalue  }}</option>
            </select>
          </li>
        </ul>
      </div>

      <div class="d-flex justify-content-full">
         <span v-html="trackData.comment"></span>
      </div>

    </div>
  </template>
  
  <script>
  import { defineComponent, ref, computed } from 'vue';
  
    export default defineComponent({
        name: 'CustomTask',
        props: {
        trackData: {
            type: Object,
            required: false,
            default: () => ({})
        }
        },
        emits: ['quoteDetails','popup-name'],
        setup(props, { emit }) {
        const trackInfo = ref({
            Parenttrackid: 0,
            pageid: 0
        });
  
        const gettrackInfo = (trackid = 0, pageid = props.trackData.pageid) => {
            try {
            trackInfo.value.Parenttrackid = trackid;
            trackInfo.value.pageid = parseInt(pageid, 10);
            emit('quoteDetails', trackInfo.value);
            } catch (error) {
            console.error('Error fetching quote details:', error);
            }
        };
  
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
  
      return {
        gettrackInfo,
        formattedId,
        triggerPopupinfo
      };
    }
  });
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  </style>
  