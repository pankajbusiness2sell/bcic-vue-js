<template>
  <div class="container-fluid p-3">
    <div class="row justify-content-center">
      
      <div class="col-md-12">
        <!-- <h3 style="text-align: center;">View Quote</h3> -->
        
          <div class="card-body">
              <div class="card-header ps-0 pt-0 mb-3">
                      <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                          <i class="ti ti-mail"></i>
                      </div>
                      <h5 class="card-title"> View Invoice</h5> 
              </div>


              <div class="col-md-12" v-if="jobinvlist.length > 0 ">
                <div class="col-md-5"> </div>
                  <div class="col-md-5"> 
                    <select class="form-select" @change="getInvodata($event)">
                      <option value="0">Select</option>
                      <option :value="jobinfo.staff_id" v-for="(jobinfo, index) in jobinvlist"  :key="index">{{  jobinfo.job_type }}</option>
                    </select>
                  </div>   

                  <div class="col-mb-3">
                    <button type="submit" @click="sendInv" class="btn btn-primary bcic_btns">Send Inv </button>
                 </div>

              </div>
               
              <div class="row">
                  <div class="card">
                    <ViewInvoice :invoicedetails="invoiceDetails"></ViewInvoice>
                  </div>
              </div>
          </div> 
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
import { useCommonFunction } from '../../func/function.js';
import ViewInvoice from './../quote/ViewInvoice.vue';
import Swal from 'sweetalert2';

export default defineComponent({
  name: 'JobType',
  components: {
    ViewInvoice,
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
    const bciclogo = ref('./assets/img/bcic-logo.png');
    const { sendData, isNumberKey } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    const invoiceDetails = ref({
      details: [],
      jobDecData: [],
      checkQUotetype: [],
      invoiceDetailshtml: '',
      getemailNotes: ''
    });

    const isLoading = ref(true); // Loading state

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value && typeof alldata.value === 'object') {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};

        // Update emailData.email when quote_info.email is available
       // emailData.value.email = alldatainforamtion.quote_info.email || '';
      } else {
        console.warn('alldata is not a valid object:', alldata.value);
      }
    };

     const getInvodata = async(event) => {
        const staff_id = event.target.value;
        showEmailQuote(staff_id);
     }
      
    const showEmailQuote = async (staff_id = 0) => {
        try {
          const quote_id = '217682'; //jobId.value;
          const type = 0;
          const staffid = (staff_id > 0) ? staff_id : 0;
          const formData = { quote_id, type ,staffid };

          const response = await sendData('get', '/view-quote-email', formData);
          console.log(response);
          if (response && typeof response === 'object') {
            invoiceDetails.value = response;
          } else {
            throw new Error('Invalid response format');
          }
        } catch (error) {
          console.error('Error in showEmailQuote:', error);
          ErrorcustomSwal.fire({
            title: 'Failed to load email quote!',
            text: error.message || 'An error occurred',
            icon: 'error',
          });
        } finally {
          isLoading.value = false; // Mark loading as complete
        }
    };

    const jobinvlist = ref({});
    const getJobTypeforInv = async () => {
      
          const job_id = jobId.value;
          const formData = { job_id};

          const response = await sendData('get', '/get-job-invoice', formData);
          jobinvlist.value =   response.jobDetails

      }

    // Lifecycle hook
    onMounted(async () => {
      try {
        getallData();
        await showEmailQuote();
        await getJobTypeforInv();

      } catch (error) {
        console.error('Error in mounted hook:', error);
      }
    });

    // Watcher for alldata changes
    watch(alldata, (newVal) => {
      if (newVal) {
        getallData();
        showEmailQuote();
        getJobTypeforInv();
      }
    });

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

    const ErrorcustomSwal = Swal.mixin({
      toast: true,
      position: 'top-end',
      background: '#f9f9f9',
      color: '#333',
      showConfirmButton: false,
      timer: 2000,
      customClass: {
        popup: 'custom-swal-popup',
        title: 'custom-swal-title-error',
      },
      didOpen: () => {
        const popup = Swal.getPopup();
        popup.style.borderRadius = '10px';
      },
    });

    return {
      jobId,
      alldata,
      alldatainforamtion,
      getallData,
      invoiceDetails,
      showEmailQuote,
      bciclogo,
      isLoading,
      customSwal,
      ErrorcustomSwal,
      getJobTypeforInv,
      jobinvlist,
      getInvodata,
    };
  }
});
</script>
