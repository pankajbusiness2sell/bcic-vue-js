<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-mail"></i>
                                </div>
                                <h5 class="card-title"> Admin Fault Notes</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold"> Name </label>
                                        <select class="form-select" v-model="faultNotes.admin_id">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in adminlist" :value="item.id" :key="index" >{{ item.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Add Notes </label>
                                        <textarea rows="2" cols="2"  v-model="faultNotes.comments" class="form-control" placeholder="Please Enter Notes"></textarea>
                                    </div>


                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" @click="saveFaultNotes" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="vq_message_list p-3 pt-0">
                                    <!--Quote box Section Start Here-->
                                        <!-- <div class="vq_message_q_box otd_add_review_box mb-2">
                                            <span>Pankaj Google Review</span>
                                            <p>Review Date : 2024-08-16 </p>
                                            <div class="vq_message_f d-flex justify-content-between">
                                                <span><i class="ti ti-user-square-rounded"></i> Job ID 4855 </span>
                                                <span><i class="ti ti-star"></i> Overall Ratting : 5  </span>
                                            </div>
                                            <p> Negative/Positive Experience</p>
                                            <div class="vq_message_f d-flex justify-content-between">
                                                <span> Positive Experience : Test</span>
                                                <span> Positive Experience : Test </span>
                                            </div>
                                        </div> -->
                                    <!--Quote box Section End Here-->


                                </div>
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
  import { useCommonFunction } from '../../func/function.js';
  
  export default defineComponent({
    name: 'ViewMail',
    props: {
      jobId: {
        type: [String, Number],
        required: true,
      },
      alldata: {
        type: [Object, Array],
        required: true,
      },
    },
  
    setup(props) {
       const hasMounted = ref(false); // Flag to check if the component has mounted
      const { sendData ,  createCustomSwal  } = useCommonFunction();

      const  customSwal = createCustomSwal();
      //const  ErrorcustomSwal = createErrorCustomSwal();
      
      const { jobId, alldata } = toRefs(props);
  
      const alldatainforamtion = reactive({
        all: {},
        jobdetails: [],
        quote_info: {},
      });
  
  
      // Function to fetch all data from props
        const getallData = () => {

            if (alldata.value && typeof alldata.value === 'object') {
                alldatainforamtion.all = alldata.value;
                alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
                alldatainforamtion.quote_info = alldatainforamtion.all.quote_info || {};
            } else {
               console.warn('alldata is not a valid object:', alldata.value);
            }

        };

        const adminlist = ref({});
        const getadminlist =  async () => {
            const formData = {};
            const response = await sendData('get', '/admin-data', formData);

            adminlist.value = response;
        }

        const faultNotes = ref({
            admin_id:0,
            comments:''
        });

        const saveFaultNotes = async () =>{
               
                const job_id = jobId.value;
                const quote_id = 0;
                const formData = { job_id , quote_id  , ...faultNotes.value};
                const response = await sendData('post', '/admin-fault-notes', formData);

                customSwal.fire({
                    title: response.message,
                    icon: 'success',
                    iconColor: '#4CAF50',
                });
                faultNotes.value = { admin_id : 0 , comments : '' };

        }
  

       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) {
                getallData();
                await getadminlist();
            }
        });

        onMounted(async () => {
           // console.log('onMounted call');
            getallData();
            await getadminlist();
        });
        
      return {
        jobId,
        alldatainforamtion,
        getadminlist,
        adminlist,
        saveFaultNotes,
        faultNotes,
      };
    },
  });
  </script>