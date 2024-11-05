<template>
    
    <OperationHeader /> 
    <div class="page-wrapper">
      <div class="content">
          <div class="row">

    <!-- <div class="mt-5 p-3">
      <div class="content">
        <div class="row justify-content-center"> --> 
          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                    <i class="ti ti-checklist"></i>
                  </div>
                  <h5 class="card-title ms-3">{{ taskTypeName }} Task Board View</h5>
                </div>

                <div v-if="loading" class="loader-container">
                    <div class="loader"></div>
                </div>

                <div class="bcic_bv_selectgroup">
                  <select class="form-select" v-model="selectedTaskType" @change="updateUrl">
                    <option v-for="option in taskOptions" :key="option.value" :value="option.value">
                      {{ option.label }}   
                    </option>
                  </select>
                </div>
              </div>

              <div class="card-body">
                <div class="bc-kanban-board-view operation-kanban">
                  <div v-for="(trackInfo, index, currentTrackNamesArray) in currentTrackNames" 
                    
                    :key="index"  
                    :id="currentTrackNamesArray"
                    :class="['bc-kanban-box', 'bc-kanban-' + getDynamicClass(currentTrackNamesArray)]">
                   
                    <div class="d-flex justify-content-between kanban-header">
                      <h5 class="mb-0 kanban-column-title">
                        
                        {{ trackInfo }} 
                        <span v-if="getTrackData[index]?.total > 0" class="kanban-title-badge">
                          {{ getTrackData[index]?.total }}
                        </span>
                      </h5>
                      <button type="button" class="ms-auto kanban-collapse-icon p-0 btn">
                        <i class="ti ti-arrow-bar-to-left"></i>
                      </button>
                    </div>
                    <div v-if="getTrackData[index]?.total > 0" class="kanban-items-main">
                      <component 
                        :is="currentComponent" 
                        :trackdata="getTrackData[index]" 
                        :ddvalue="GetSystemDD" 
                        :indexKey="index" 
                        :trackName="trackInfo"
                        @popup-name="handalpopup"/>
                    </div>
                    <div v-else class="kanban-items-container text-center">
                      <img class="no_record_f mt-2" :src="norecord" />
                      <span class="no_record_t pt-1">No Records Found</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


      <!--Operation Notes Design Section Start Here-->
    <div class="modal fade" id="operationautotaskFullscreen" tabindex="-1" aria-labelledby="operationautotaskFullscreenLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
 
              
              <div class="modal-title operation_modal_title fs-4" id="operationautotaskFullscreenLabel">
                  <div class="card-header"><div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                    <i class="ti ti-id"></i></div>
                    <div class="d-flex justify-content-start">
                      <h5 class="me-2">{{ questioninfo.pageName }} -&gt; {{ questioninfo.trackName }} </h5>
                      <h6 class="card-title text-nowrap badge badge-info fs-6"> J# {{ questioninfo.job_id }} </h6>
                    </div>
                    
                  </div>

              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            
          <div class="modal-body">
            <div class="bcic_view_quote_table table-responsive mt-0 m-3">
             
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Question</th>
                    <th>Check</th>
                  </tr>
                </thead>
          
                <!-- When isAns is false, allow interactive checkboxes -->
                <tbody class="align-middle" v-if="questioninfo.isAns == false">
                  <template v-if="questioninfo.data && questioninfo.data.length > 0">
                    <tr v-for="(qusdata, index) in questioninfo.data" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ qusdata.qus }}</td>
                      <td>
                        <input 
                          type="checkbox" 
                          :id="'ans_checkbox_' + index" 
                          :value="qusdata.id" 
                          v-model="checkedQuestions" 
                        />
                      </td>
                    </tr>
                    <!-- Submit button -->
                    <tr>
                      <td colspan="2"></td>
                      <td>
                        <a href="javascript:void(0)" @click="saveQuestion">Submit</a>
                      </td>
                    </tr>
                  </template>
                  <template v-else>
                    <tr>
                      <td colspan="3" class="text-center">No Records found</td>
                    </tr>
                  </template>
                </tbody>
          
                <!-- When isAns is true, show static checkboxes -->
                <tbody v-else>
                  <template v-if="questioninfo.data && questioninfo.data.length > 0">
                    <tr v-for="(qusdata, index) in questioninfo.data" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ qusdata.qus }}</td>
                      <td>
                        <input 
                          type="checkbox" 
                          :id="'ans_checkbox_' + index" 
                          :checked="qusdata.chekedans === 1" 
                          :value="qusdata.id"
                        />
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>
           
           
          </div>
      </div>
  </div>

  </template>
  
  <script>
  import { ref, watch, onMounted, computed } from 'vue';
  import  OperationHeader  from '@/header/Operation.vue';
  import { useRouter, useRoute } from 'vue-router';
  import { useCommonFunction } from '@func/func/function.js';
  
  import BeforeJobDay from './Task/BeforeJobDay.vue';
  import OnTheDayJobs from './Task/OnTheDayJobs.vue';
  import NewRecleanJobsPage from './Task/NewRecleanJobsPage.vue';
  import NewPageRecleanJobs from './Task/NewPageRecleanJobs.vue';
  import ReviewSystem from './Task/ReviewSystem.vue';
  import ApplicationSystem from './Task/ApplicationSystem.vue';
  import ComplaintTrack from './Task/ComplaintTrack.vue';

   //console.log(OperationHeader);
   
  export default {
    props: ['tab'],
    components: {
      OperationHeader,
      },
    setup(props) {
      const norecord = ref('../assets/img/no_record_found.svg');
      const router = useRouter();
      const route = useRoute();
  
      const selectedTaskType = ref(route.query.tab ? Number(route.query.tab) : 1); 
      const currentTrackNames = ref([]);
      const getTrackData = ref({});
      const loading = ref(false);
  
      const taskOptions = ref([
        { value: 0, label: 'Select' },
        { value: 1, label: 'Before-job' },
        { value: 2, label: 'On-the-day' },
        { value: 4, label: 'Re-clean Jobs' },
        { value: 5, label: 'Review System' },
        { value: 6, label: 'HR Application' },
        { value: 7, label: 'New Before Re-clean' },
        { value: 8, label: 'New Complaint Track' },
      ]);
  
      const { sendData, getddvaluedata, createErrorCustomSwal , createCustomSwal  } = useCommonFunction();
      
      const  customSwal = createCustomSwal();
      const  ErrorcustomSwal = createErrorCustomSwal();   
  
      const fetchStagesData = async () => {
        const ddvalue = getStagesData(selectedTaskType.value);

        // console.log(selectedTaskType.value);
        // console.log(typeof selectedTaskType.value);

          if(parseInt(selectedTaskType.value) === 7) {
              const ddids = [158];
             await getddValue(ddids);
            // GetSystemDD.value = currentTrackNames.value;
          } 

          if(parseInt(selectedTaskType.value) === 8) {
             const ddids = [125,137,205,206];
            await getddValue(ddids);
          } 
        // console.log(selectedTaskType.value);
        // console.log('dd value get ' + selectedTaskType.value + ' == ');

        if (ddvalue > 0) {
          loading.value = true; // Show loader
          await getDropdownValues(ddvalue);
        } else {
          ErrorcustomSwal.fire({
            title: 'Error',
            text: 'Please select a valid task type',
            icon: 'error',
            iconColor: '#FF5722',
            customClass: {
              popup: 'custom-swal-popup custom-swal-error',
            },
          });
        }
      };
  
      const getDropdownValues = async (typeid) => {
        try {
          const responseinfo = await getddvaluedata([typeid]);
          currentTrackNames.value = responseinfo[typeid] || [];
          await getTrackDataInfo(selectedTaskType.value, currentTrackNames.value);
        } catch (error) {
          createErrorCustomSwal('Error fetching dropdown data');
        }
      };
  

      const GetSystemDD = ref ({});

      const getddValue = async (ids) => {
          try {
             GetSystemDD.value = await getddvaluedata(ids);
             
             console.log(GetSystemDD.value);

          } catch (error) {
             console.error('Error fetching dropdown data:', error);
          }
      };



      const getTrackDataInfo = async (tracktype, trackname) => {
        const formData = { tracktype, trackname };
        try {
          const response = await sendData('get', '/get-tracktype-data', formData);
          if (response.success === false) {
            ErrorcustomSwal.fire({
              title: 'Error',
              text: response.data,
              icon: 'error',
              iconColor: '#FF5722',
              customClass: {
                popup: 'custom-swal-popup custom-swal-error',
              },
            });
            return false;
          }
          getTrackData.value = response.data;
        } catch (error) {
          console.error('Error fetching track data:', error);
        } finally {
          loading.value = false; // Hide loader
        }
      };
  
      const getStagesData = (type) => {
        const mapping = {
          1: 113,
          2: 116,
          4: 131,
          5: 152,
          6: 55,
          7: 158,
          8: 137,
        };
        return mapping[type] || 0;
      };
  
      const currentComponent = computed(() => {
        switch (selectedTaskType.value) {
          case 1: return BeforeJobDay;
          case 2: return OnTheDayJobs;
          case 4: return NewRecleanJobsPage;
          case 5: return ReviewSystem;
          case 6: return ApplicationSystem;
          case 7: return NewPageRecleanJobs;
          case 8: return ComplaintTrack;
          default: return null;
        }
      });
  
      const updateUrl = () => {
        const taskTypeValue = selectedTaskType.value;
        if (taskTypeValue) {
          router.push({ query: { tab: taskTypeValue } });
         // fetchStagesData(); // Fetch data whenever the URL is updated
        }
      };

       
        // job_id: 0,
        //           pageName : '',
        //           trackName : '',
        //           trackData : {},
        //           isAns:false
            
          const questioninfo = ref({});

      const handalpopup = async (formData) => {
              questioninfo.value.isAns = false;
            const response = await sendData('get', '/get-track-question', formData);
            try{
                if(response.success === true) {
                    questioninfo.value = response.data

                    console.log(questioninfo.value);
                }
            }catch{
               console.log('popup data not shoing');
            }
            
      }

      const checkedQuestions = ref([]);


      const saveQuestion = async () => {
          console.log('Hello');
          console.log('Checked Questions:', checkedQuestions.value);

          // Prepare data to send
          const dataToSend = questioninfo.value.data.map(qusdata => {
            return {
              job_id: questioninfo.value.job_id,
              questionid: qusdata.id,
              tracks_id: qusdata.tracks_id,
              track_heading: qusdata.track_heading,
              qus: qusdata.qus,
              isChecked: checkedQuestions.value.includes(qusdata.id), // true or false
            };
          });

          //console.log('Data to Send:', dataToSend);
          const fromData = { dataToSend  };
          const response = await sendData('post', '/save-track-question', fromData);
           questioninfo.value.data = response.data;
           questioninfo.value.isAns = true;
           checkedQuestions.value = [];

             //questioninfo.value = {};
                if (response.success === true) {

                  //const selectedTaskType = ref(route.query.tab ? Number(route.query.tab) : 1);
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

           //console.log(response);

      };
  
      const getDynamicClass = (index) => {
        const classList = ['', 'fir', 'sec', 'thir', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', ''];
        return classList[index] || ''; // Return an empty string if index exceeds available classes
      };

      // Computed property to determine the task type name
      const taskTypeName = computed(() => {
        switch (selectedTaskType.value) {
          case 1:
            return 'Before-job';
          case 2:
            return 'On the Day';
          case 3:
            return '';
          case 4:
            return 'Re-clean Jobs';
          case 5:
            return 'Review System';
          case 6:
            return 'HR Application';
          case 7:
            return 'New Before Re-clean';
          case 8:
            return 'New Complaint Track';
          default:
            return '';
        }
      });
  
      watch(() => route.query.tab, (newTab) => {
        selectedTaskType.value = newTab ? Number(newTab) : 1;
        fetchStagesData(); // Fetch data when the tab changes
      });
  
      onMounted(() => { 
         fetchStagesData(); // Fetch data on component mount
      });
  
     
      return {
        norecord,
        selectedTaskType,
        currentComponent,
        currentTrackNames,
        fetchStagesData,
        updateUrl,
        taskOptions,
        getTrackData,
        loading,
        getDynamicClass,
        GetSystemDD,
        getddValue,
        handalpopup,
        questioninfo,
        saveQuestion,
        checkedQuestions,
        taskTypeName,
      };
    },
  };
  </script>
    