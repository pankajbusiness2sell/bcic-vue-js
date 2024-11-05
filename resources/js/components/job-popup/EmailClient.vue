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
                                <h5 class="card-title"> Email Client </h5>
                        </div>
                       <div class="row">
                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Template</label>
                                <select class="form-select" v-model="emailData.template_id"  @change="getEmailTex($event)">
                                    <option value="0">Select</option>
                                    <option :value="edata.id" v-for="(edata, index ) in emaillist" :key="index">{{ edata.subject}}</option>
                                </select>
                            </div>

                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">To</label>
                                <input type="text" class="form-control" v-model="emailData.email" placeholder="">
                            </div>


                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control" v-model="emailData.subject" placeholder="">
                            </div>


                            <div class="col col-md-12 mb-2">
                                <label class="form-label fw-semibold">Comment</label>
                                <textarea rows="6" cols="4" class="form-control" v-model="emailData.message" placeholder="Enter Your Location"></textarea>
                            </div>

                            <div class="col col-md-12 mb-3 text-end">
                                <button type="submit" @click="sendEmail" class="btn btn-primary bcic_btns">Send Email </button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
import { useCommonFunction } from './../../func/function.js';
import Swal from 'sweetalert2'

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
    const { sendData, isNumberKey } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    const emaillist = ref({});

    // Initialize emailData as a ref
    const emailData = ref({
      template_id: 0,
      email: '', // Start with an empty email
      subject: '',
      message: ''
    });

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};

        // Update emailData.email when quote_info.email is available
        emailData.value.email = alldatainforamtion.quote_info.email || '';
      }
    };

    const getEmailtemplate = async () => {
      const formData = {};
      const response = await sendData('get', '/popup-email-list', formData);
      emaillist.value = response.emailTpl;
    };

    const sendEmail = async() => {
            if (!emailData.value.email) {
                alert('Please enter a valid email id');
                return;
            } else if (!emailData.value.subject) {
                alert('Please enter subject');
                return;
            } else if (!emailData.value.message) {
                alert('Please enter a email message');
                return;
            } 
            const job_id = jobId.value;
            const formData = {job_id , ...emailData.value };
            const response = await sendData('post', '/send-popup-email', formData);

            customSwal.fire({
                  title: response.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
              });

           // emailData.value = {};
            emailData.value.template_id = 0;
            emailData.value.subject = '';
            emailData.value.message = '';

          console.log(response.value);
    };
    
    const getEmailTex = async(event)=> {
      const emailTypeid = event.target.value; 
      const job_id = jobId.value;
      let message = '';
      if(emailTypeid > 0) {
        message =  emaillist.value[emailTypeid].message;
        const formData = {job_id , emailTypeid , message };
        const response = await sendData('get', '/get-email-message', formData);
       
        emailData.value.message = response.emailMsg;
       // console.log(emailData.value);
      }else{
        emailData.value.message = '';
      }
      
    }


    const getddValue = async () => {};

    onMounted(async () => {
      await getddValue();
      await getEmailtemplate();
      getallData(); // Ensure to call this on mounted
    });

    watch(alldata, (newVal) => {
      if (newVal) {
        getallData();
        getEmailtemplate();
      }
    });

    watch(jobId, (newVal) => {
      if (newVal) {
        getQuoteInfo();
      }
    });

    // Watch for changes in alldatainforamtion.quote_info.email and update emailData.email
    watch(() => alldatainforamtion.quote_info.email, (newEmail) => {
      emailData.value.email = newEmail || ''; // Update email in emailData
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


        // Global SweetAlert2 configuration
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
      getddValue,
      emaillist,
      emailData,
      sendEmail,
      getEmailtemplate,

      getEmailTex,
    };
  }
});
</script>
