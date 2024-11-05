<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

             <!-- <pre> {{  alldatainforamtion  }}</pre> -->

                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-mail"></i>
                                </div>
                                <h5 class="card-title"> SMS / Notification</h5>
                        </div>
                         <div class="row">
                        <!-- <pre>{{ ClientInfo }}</pre> -->
                          <div class="col col-md-3 mb-3">
                            <label class="form-label fw-semibold">Client/Staff</label>
                            <select class="form-select"  v-model="smsData.connectName" @change="getConnectType($event)">
                                <option value="0">Select</option>
                                <option :value="ClientInfo.mobile" id="0">{{ ClientInfo.name }} ( Client )</option>
                                <option v-if="cleanerlistData.length > 0"  :value="sdata.mobile" :id="sdata.id" v-for="(sdata, index ) in cleanerlistData" :key="index">{{ sdata.name}}  (Staff )</option>
                            </select>
                          </div>
                     
                           <!-- <pre>{{ smslist }}</pre> -->

                            <div class="col col-md-3 mb-3">
                                <label class="form-label fw-semibold">Template</label>
                                <select class="form-select" v-model="smsData.template_id" @change="getSMSTpl($event)">
                                    <option value="0">Select</option>
                                    <option  :value="edata.id" v-for="(edata, index ) in smslist" :key="index">{{ edata.email_type_data}}</option>
                                </select>
                            </div>

                            <div class="col col-md-3 mb-3">
                                <label class="form-label fw-semibold">Mobile</label>
                                <input type="text" class="form-control" v-model="smsData.phone" placeholder="Please enter mobile number">
                            </div>


                            <div class="col col-md-3 mb-3" v-if="show_connect_type">
                                <label class="form-label fw-semibold">Type</label>
                                <select class="form-select" v-model="smsData.smstype">
                                    <option value="0">Select</option>
                                    <option value="1">SMS</option>
                                    <option value="2">Notification</option>
                                </select>
                               
                            </div>


                            <div class="col col-md-12 mb-2">
                                <label class="form-label fw-semibold">SMS Text</label>
                                <textarea rows="6" cols="4" class="form-control" v-model="smsData.message" placeholder="Enter Your SMS Text"></textarea>
                            </div>

                            <div class="col col-md-12 mb-3 text-end">
                                <button type="submit" @click="sendSMS" class="btn btn-primary bcic_btns">Send SMS </button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted  } from 'vue';
import { useCommonFunction } from './../../func/function.js';
import Swal from 'sweetalert2';

export default defineComponent({
  name: 'JobType',
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
    const hasMounted = ref(false); // Flag to check if the component has mounted
    const { sendData, isNumberKey } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    const smslist = ref({});

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};
      }
    };

    const getSMSlist = async () => {
      const formData = {};
      const response = await sendData('get', '/popup-sms-list', formData);
      smslist.value = response.smslist;
    };
   
    const cleanerlistData = ref([]);

    const cleanerList = async () => {
      const job_id = jobId.value;
      const formData = { job_id };
      const response = await sendData('get', '/get-cleaner-list', formData);
      cleanerlistData.value = response.cleanerlist;
      //console.log(response);
    };

     const ClientInfo = ref({});
    const setClientInfo = () => {
      const id = alldatainforamtion.quote_info.id;
      const name = alldatainforamtion.quote_info.name;
      const mobile = alldatainforamtion.quote_info.phone;

       ClientInfo.value = { id: id, name: name, mobile: mobile };

      if (!name) {
        console.warn('site_id is not available yet.');
        return;
      }
    };

    const smsData = ref({
      connectName:0,
      template_id: 0,
      phone: '',
      smstype: 0,
      message: '',
      optionVal: '',
      optionid :0
    });

    const getConnectType = (event) => {
       
     //  console.log(event.target.selectedIndex);
     
       const client_type_number = event.target.value;
      const selectedOption = event.target.options[event.target.selectedIndex];
      const client_type_id = selectedOption.getAttribute('id');
      const optionVal = selectedOption.text;

      
      smsData.value.smstype = 0;
      smsData.value.phone = '';
      show_connect_type.value = false;

      if(client_type_number != '') {

          if(client_type_id > 0) {
              show_connect_type.value = true;
              smsData.value.smstype = 2;
          }else if (client_type_id == 0) {
            show_connect_type.value = false;
          }
          smsData.value.optionVal = optionVal;
          smsData.value.optionid = client_type_id;
          smsData.value.phone = client_type_number;

      }
      
    };

    // Computed property to get the selected template name


    const getSMSTpl = async(event) => {
       
       const tplid = event.target.value;
       const job_id = jobId.value;
       const connectName = smsData.value.optionVal;
       
       smsData.value.message = '';
        if(tplid > 0) {
            const message = smslist.value[tplid].work_guarantee_text;
            const formData = {job_id , tplid , message , connectName };

            const response = await sendData('get', '/get-sms-message', formData);
            smsData.value.message = response.textStr;
        }

    }

          const sendSMS = async () => {

              const job_id = jobId.value;

              if (!smsData.value.connectName) {
                  alert('Please select Client/Staff type');
                  return;
              } else if (!smsData.value.phone) {
                  alert('Please select mobile number');
                  return;
              } else if (!smsData.value.message) {
                  alert('Please enter message text');
                  return;
              }

              const formData = { job_id, ...smsData.value };
              const response = await sendData('post', '/send-popup-sms', formData);
              
              // Reset the form values to the original state
              smsData.value = {
                  connectName: 0,
                  template_id: 0,
                  phone: '',
                  smstype: 0,
                  message: '',
                  optionVal: '',
                  optionid: 0
              };

              customSwal.fire({
                  title: response.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
              });
          };


    const show_connect_type = ref(false);

    onMounted(async () => {
      hasMounted.value = true;
      await getSMSlist();
      getallData();
      await cleanerList();
    });

    watch(alldata, (newVal) => {
      if (hasMounted.value && newVal) {
        getallData();
        getSMSlist();
        cleanerList();
      }
    });

    // Watch for changes in alldatainforamtion.quote_info.phone and update smsData.phone
    watch(() => alldatainforamtion.quote_info.phone, (newPhone) => {
      smsData.value.phone = newPhone || '';
    });

    watch(() => alldatainforamtion.quote_info.name, (Cname) => {
      if (Cname) {
        setClientInfo(); // Call getStaffType when site_id is available
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

    // Global SweetAlert2 error configuration
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
      smslist,
      smsData,
      getSMSlist,
      show_connect_type,
      getConnectType,
      cleanerlistData,
      cleanerList,
      setClientInfo,
      ClientInfo,
      getSMSTpl,
      sendSMS,
    };
  }
});
</script>
