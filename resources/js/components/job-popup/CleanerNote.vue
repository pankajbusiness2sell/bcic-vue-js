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
                                <h5 class="card-title"> Cleaner Notes </h5>
                        </div>

                         <!-- <pre>{{ cleanerlistData }}</pre> -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Cleaner Name </label>
                                        <select class="form-select" v-model="notesData.cleaner_name">
                                            <option value="0">Select</option>
                                            <option v-if="cleanerlistData.length > 0"  :value="sdata.id" :id="sdata.id" v-for="(sdata, index ) in cleanerlistData" :key="index">{{ sdata.name}}</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Notes Type </label>
                                        <select class="form-select" v-model="notesData.notes_type" @change="getsubValue($event)">
                                            <option value="0">Select</option>
                                            <option   v-for="(item, index) in GetSystemDD[196]" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Notes Sub Type </label>
                                        <select class="form-select" v-model="notesData.notes_sub_type">
                                            <option value="0">Select</option>
                                            <option    v-for="(item, index) in getsubtypelist" :value="index" :key="index" >{{ item }}</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Comments</label>
                                        <textarea rows="2" cols="4" v-model="notesData.comments" class="form-control" placeholder="Enter Your Location"></textarea>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" @click="saveNotes" class="btn btn-primary">Save</button>
                                    </div>



                                </div>

                            </div>
                            <!-- <pre>{{ cleanerNotesList  }}</pre> -->
                            <div class="col-md-6">
                                <div class="vq_message_list p-3 pt-0" v-if="cleanerNotesList.length > 0">
                                    <!--Quote box Section Start Here-->
                                    <div class="vq_message_q_box mb-2"  v-for="notes in cleanerNotesList">
                                        <span>{{  notes.heading }}</span>
                                        <p v-html="notes.comment"</p>
                                        <div class="vq_message_f d-flex justify-content-between">
                                            <span><i class="ti ti-user-square-rounded"></i> By {{ notes.staff_name }}</span>
                                            <span><i class="ti ti-calendar-dot"></i> {{ notes.date }} </span>
                                        </div>
                                    </div>
                                    
                                    <!--Quote box Section End Here-->
                                </div>
                                <div class="vq_message_list p-3 pt-0" v-else>
                                    <div class="vq_message_q_box mb-2"  >
                                        <span>Not  found Notes</span>
                                    </div> 

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
  //import { debounce } from 'lodash';
  
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
      const { sendData, getddvaluedata ,  createCustomSwal, createErrorCustomSwal  } = useCommonFunction();

      const  customSwal = createCustomSwal();
      const  ErrorcustomSwal = createErrorCustomSwal();
      
      const { jobId, alldata } = toRefs(props);
  
      const alldatainforamtion = reactive({
        all: {},
        jobdetails: [],
        quote_info: {},
      });
  
      const showTasks = ref([]);
      const GetSystemDD = ref({});
  
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
  
      const cleanerlistData = ref([]);

        const cleanerList = async () => {
            const job_id = jobId.value;
            const formData = { job_id };
            const response = await sendData('get', '/get-cleaner-list', formData);
            cleanerlistData.value = response.cleanerlist;
            console.log(response);
        };

        
  
      // Function to fetch dropdown values
      const getddValue = async () => {
            try {
            const ids = [196, 69,197,198,199];
            GetSystemDD.value = await getddvaluedata(ids);
            } catch (error) {
            console.error('Error fetching dropdown data:', error);
            }
      };

          const getsubtypelist = ref({});

                // Define a mapping of category types to their corresponding subtype IDs
            const subtypeIdMap = {
                1: 69,
                2: 197,
                3: 198,
                4: 199
            };

            const getsubValue = async (event) => {
                const categorytype = parseInt(event.target.value, 10);

                if (categorytype > 0) {
                    const getsubtypeids = getsubtypeid(categorytype);
                    if (getsubtypeids) {
                        getsubtypelist.value = GetSystemDD.value[getsubtypeids];
                    }
                }
            };

                const getsubtypeid = (type) => {
                    // Retrieve the subtype ID from the mapping or return undefined if not found
                    return subtypeIdMap[type];
                };
     
                    const  notesData = ref({
                            cleaner_name : 0,
                            notes_type : 0,
                            notes_sub_type : 0,
                            comments : '',
                    });

                    const cleanerNotesList = ref({});
    
                        const saveNotes = async () => 
                        {
                            // Validation checks
                            if (notesData.value.cleaner_name == 0) {
                                alert('Please select cleaner name');
                                return false;
                            } else if (notesData.value.notes_type == 0) {
                                alert('Please select notes type');
                                return false;
                            } else if (notesData.value.notes_sub_type == 0) {
                                alert('Please select sub type');
                                return false;
                            } else if (notesData.value.comments.trim() === '') {
                                alert('Please enter a comment');
                                return false;
                            }

                            try {
                                // Extract required values
                                const job_id = jobId.value;
                                const cleanerName = cleanerlistData.value.find(
                                cleaner => cleaner.id === notesData.value.cleaner_name
                                )?.name || '';

                                const notesName = GetSystemDD.value[196][notesData.value.notes_type];
                                const cateType = notesData.value.notes_type;
                                const note_type_new = getsubtypeid(cateType);

                                // Construct form data
                                const formData = {
                                job_id,
                                cleanerName,
                                notesName,
                                note_type_new,
                                ...notesData.value
                                };

                                // Send data to the server
                                const response = await sendData('post', '/save-cleaner-notes', formData);

                                if (response.success === true) {
                                        customSwal.fire({
                                            title: response.message,
                                            icon: 'success',
                                            iconColor: '#4CAF50',
                                        });

                                        cleanerNotesList.value = response.notesdata;

                                        // Reset notesData values properly
                                        notesData.value = {
                                            cleaner_name: 0,
                                            notes_type: 0,
                                            notes_sub_type: 0,
                                            comments: ''
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
                                
                            } catch (error) {
                                console.error('Error saving notes:', error);
                            }
                        };
 

            const cleanerNotesListData = async () => {
                const job_id = jobId.value;
                const formData = { job_id };
                const response = await sendData('get', '/get-cleaner-fault-list', formData);
                cleanerNotesList.value =    response.notesdata;
            }
  
       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) {
                 
             // console.log('watch call');  


                getallData();
                await getddValue();
                await cleanerList();
                await cleanerNotesListData();
            }
        });

        onMounted(async () => {
           
           // console.log('onMounted call');
            getallData();
            await getddValue();
            await cleanerList();
            await cleanerNotesListData();
            
        });
        
      return {
        jobId,
        alldatainforamtion,
        GetSystemDD,
        cleanerlistData,
        cleanerList,
        getsubValue,
        getsubtypeid,
        getsubtypelist,
        notesData,
        saveNotes,
        cleanerNotesList,
        cleanerNotesListData,
      };
    },
  });
  </script>
  
