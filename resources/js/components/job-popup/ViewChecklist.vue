<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-checklist"></i>
                                </div>
                                <h5 class="card-title"> CheckList Update </h5>
                        </div>

                        <!-- <pre>{{ jobChecklist }}</pre> -->

                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                  <tr>
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                    <th>Send/Start Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="checklist in jobChecklist" :key="checklist.id">
                                    <td>{{ checklist.id }}</td>
                                    <td>{{ checklistType[checklist.checklist_type_id] }}</td>
                                    <td>{{ checklist.check_type_text }}</td>
                                    <td>
                                      <img :src="`/images/${checklist.status ? 'check_agree.png' : 'no_icon.png'}`" style="height: 23px; padding: 2px;" />
                                    </td>
                                    <td>
                                      <textarea
                                        rows="2"
                                        cols="75"
                                        style="width: 100%; height: 40px;"
                                        v-model="checklist.comment"
                                        @blur="updateComment(checklist.id, checklist.comment,'comment','job_checklist')"
                                      ></textarea>
                                    </td>
                                    <td>{{ (checklist.send_date_time != '0000-00-00 00:00:00') ? checklist.send_date_time : '' }}</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
  import { useCommonFunction  } from '../../func/function.js';
  import Swal from 'sweetalert2'
  //import { debounce } from 'lodash';
  
  export default defineComponent({
    name: 'View Check List',
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
      const { sendData , createCustomSwal, createErrorCustomSwal } = useCommonFunction();
      const { jobId, alldata } = toRefs(props);
  
     
      const  customSwal = createCustomSwal();
      const  ErrorcustomSwal = createErrorCustomSwal();

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
  
         // Function to fetch task history
         const jobChecklist = ref({});
         const checklistType = ref({});
        const getcheckList = async () => {
            try {
                const job_id = jobId.value;
                const quote_id = alldatainforamtion.quote_info.id;
                const formData = { job_id, quote_id };

                const response = await sendData('get', '/get-check-list', formData);
                jobChecklist.value = response.jobChecklist;
                checklistType.value = response.checkTypeArray;
               // console.log(response);

            } catch (error) {
                console.error('Error fetching task history:', error);
            }
        };
        
        const updateComment = async(id, value, fieldname, tablename) => {
              
            //$bool = mysql_query("update job_checklist set comment='".$value."',createdOn='".date("Y-m-d H:i:S")."' where id=".$id."");
              const formData = { id, value ,fieldname,tablename };
              const response = await sendData('get', '/popup-edit-field', formData);
               
               console.log(response);

                if (response.success === true) {
                    customSwal.fire({
                        title: response.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                } else if (response.success === false) {
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            // Apply the error-specific class
                            popup: 'custom-swal-popup custom-swal-error'
                        }
                    });
                }
                
            };


       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) {
                getallData();
                await getcheckList();
               
            }
        });

        onMounted(async () => {
            hasMounted.value = true; // Set the flag after mount
            getallData();
            getcheckList();
           
        });
        
      return {
        jobId,
        alldatainforamtion,
        getcheckList,
        jobChecklist,
        checklistType,
        updateComment,
      };
    },
  });
  </script>