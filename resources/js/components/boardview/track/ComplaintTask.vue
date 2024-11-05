<template>
  <div class="d-flex justify-content-between" ref="childElement">
    <div class="avatar-group dropdown">
      <span class="fs-6 fw-medium ps-2"> 
        {{ trackData.Pagetype }} ({{ trackData.task_admin_name }})
      </span>
    </div>

    <div class="kanban-items-btns">
      <button class="btn btn-soft-success me-1" 
              @click="triggerPopupinfo(trackData)"  
              data-bs-target="#exampleModalToggle" 
              data-bs-toggle="modal">
        <i class="ti ti-pencil-minus"></i>
      </button>
    </div>
  </div>

  <div class="d-flex justify-content-between mt-1">
    <ul>
      <li class="kanban-icon kanban-user" 
          data-bs-toggle="tooltip" 
          data-bs-placement="top" 
          data-bs-title="Christopher (#Q215981)">
        <i class="ti ti-user-circle"></i> 
        {{ trackData.name }} 
        <a href="#0">J#{{ trackData.job_id }}</a>
      </li>
    </ul>
    <ul class="kanban-items-right">
      <li class="kanban-icon kanban-date text-nowrap">
        {{ trackData.fallow_date_time }}
      </li>
    </ul>
  </div>

  <div class="d-flex justify-content-full">
    <span v-html="trackData.heading"></span>
  </div>

  <div class="d-flex justify-content-full">
    <span v-html="trackData.comment"></span>
  </div>

  <div class="d-flex justify-content-full">
    <select name="step" class="form-select" 
            @change="statusUpdate($event, trackData.id, '#J'+trackData.job_id)" 
            v-model="trackData.message_status">
      <option value="0">Select</option>
      <option :value="sKey" 
              v-for="(svalue, sKey) in trackData.statusdd" 
              :key="sKey">
        {{ svalue }}
      </option>
    </select>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'; 
import axios from 'axios'; 
import Swal from 'sweetalert2';

export default defineComponent({
  props: {
    trackData: {
      type: Object,
      required: false,
      default: () => ({}),
    },
  },
  emits: ['quoteDetails', 'popup-name'],
  setup(props, { emit }) {
    const childElement = ref(null); // Define the ref for the element

    const trackInfo = ref({
      Parenttrackid: 0,
      pageid: 0,
    });

    const gettrackInfo = (trackid, pageid) => {
      try {
        trackInfo.value.Parenttrackid = trackid;
        trackInfo.value.pageid = parseInt(pageid);
        emit('quoteDetails', trackInfo.value);
      } catch (error) {
        console.error('Error fetching quote details:', error);
      }
    };

    const triggerPopupinfo = (popupInfo) => {
      emit('popup-name', popupInfo);
    };

    const statusUpdate = async (event, salesid, quote_id) => {
      const response = await axios.get('sales-status-update', {
        params: {
          value: event.target.value,
          salesid: salesid,
        },
      });

      if (response.status === 200) {
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

        const respdata = `${quote_id} moved in ${response.data}`;
        customSwal.fire({
          title: respdata,
          icon: 'success',
          iconColor: '#4CAF50',
        });
      }
    };

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
      statusUpdate,
      childElement, // Return the ref to the template
    };
  },
});
</script>
