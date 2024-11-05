<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-stars"></i>
                                </div>
                                <h5 class="card-title"> Add Review </h5>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Name </label>
                                        <select class="form-select" v-model="reviewData.admin_id">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in adminlist" :value="item.id" :key="index" >{{ item.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Review Type </label>
                                        <select  class="form-select" v-model="reviewData.review_type">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[170]" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold"> Possitive Notes </label>
                                        <textarea rows="2" cols="2" class="form-control" v-model="reviewData.possitive_com" placeholder="Please Enter Possitive Notes"></textarea>
                                    </div>
                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold"> Negative Notes </label>
                                        <textarea rows="2" cols="2" class="form-control" v-model="reviewData.negative_com" placeholder="Please Enter Negative Notes"></textarea>
                                    </div>
                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Over All Review </label>
                                        <select  class="form-select" v-model="reviewData.overall_exp">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[85]" :value="index" :key="index" >{{ item }}</option>
                                        </select>

                                    </div>
                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Task Create </label>
                                        <select  class="form-select" v-model="reviewData.task_create">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[40]" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" @click="saveReview" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="vq_message_list p-3 pt-0">
                                    <!--Quote box Section Start Here-->
                                    <div class="vq_message_q_box otd_add_review_box mb-2"  v-for="(products, index) in productlist" :key="index">
                                        <span>{{  getadminName(products.review_login_id) }} {{  GetSystemDD[170][products.job_type] || 'Unknown Job Type' }} Review</span>
                                        <p>Review Date : {{  products.review_date }} </p>
                                        <div class="vq_message_f d-flex justify-content-between">
                                            <span><i class="ti ti-star"></i> Overall Ratting : {{  products.overall_experience }}  </span>
                                        </div>
                                        <p> Negative/Positive Experience</p>
                                        <div class="vq_message_f d-flex justify-content-between">
                                            <span> Positive Experience : {{  products.positive_comment }}</span>
                                            <span> Negative Experience : {{  products.negative_comment }} </span>
                                        </div>
                                    </div>
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
    name: 'Assign History',
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
      const { sendData , getddvaluedata , createCustomSwal, createErrorCustomSwal  } = useCommonFunction();

      const  customSwal = createCustomSwal();
      const  ErrorcustomSwal = createErrorCustomSwal();

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

        const getadminName = (aid) => {

             if(aid > 0) {
               return adminlist.value.find( adminid => adminid.id ===  aid ).name;
             }else{
               return 'N/A';
             }
             
        }

         const GetSystemDD = ref ({});

        const getddValue = async () => {
                try {
                const ids = [170, 85, 40];
                GetSystemDD.value = await getddvaluedata(ids);
                } catch (error) {
                console.error('Error fetching dropdown data:', error);
                }
        };

        const  productlist = ref({});

        const getProductlist = async()=> {
            const job_id = jobId.value;
            const formData = {job_id };
            const response = await sendData('get', '/get-review-data', formData);
            productlist.value = response.productList;
        }

        const reviewData = ref({
            admin_id:0,
            review_type:0,
            possitive_com:'',
            negative_com:'',
            overall_exp:0,
            task_create: 0
        })
         const saveReview = async ()=>{

            if(reviewData.value.admin_id == 0) {
                alert('Please select admin id');
                return false;
            }else  if(reviewData.value.review_type == 0) {
                alert('Please select review type ');
                return false;
            }else {
                const job_id = jobId.value;
                const formData = {job_id , ...reviewData.value};
                const response = await sendData('post', '/save-review-data', formData);

                    if (response.success === true) {
                        customSwal.fire({
                            title: response.message,
                            icon: 'success',
                            iconColor: '#4CAF50',
                        });

                        productlist.value = response.productList;

                        // Reset notesData values properly
                        reviewData.value = {
                                admin_id:0,
                                review_type:0,
                                possitive_com:'',
                                negative_com:'',
                                overall_exp:0,
                                task_create: 0
                            };

                    } else if (response.success === false) {
                        ErrorcustomSwal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            iconColor: '#FF5722',
                            customClass: {
                            popup: 'custom-swal-popup custom-swal-error'
                            }
                        });
                    }
                
                    console.log(response);

            }
             
         }

  

       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) { 
                getallData();
                await getadminlist();
                await getddValue();
                await getProductlist()
            }
        });

        onMounted(async () => {
           // console.log('onMounted call');
            getallData();
            await getadminlist();
            await getddValue();
            await getProductlist()
        });
        
      return {
        jobId,
        alldatainforamtion,
        getadminlist,
        adminlist,
        getddValue,
        GetSystemDD,
        reviewData,
        saveReview,
        productlist,
        getProductlist,
        getadminName,
      };
    },
  });
  </script>
