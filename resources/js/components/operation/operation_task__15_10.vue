<template>
    <div class="mt-5 p-3">
      <div class="content">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div class="pt-2">
                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                      <i class="ti ti-checklist"></i>
                    </div>
                    <h5 class="card-title text-nowrap">Operation System Task</h5>
                  </div>
  
                  <div class="bcic_bv_selectgroup">
                    <div class="row">
                      <div class="col">
                        <select class="form-select" v-model="selectedTaskType" @change="updateUrl">
                          <option value="0">Select</option>
                          <option value="1">Before-job</option>
                          <option value="2">On-the-day</option>
                          <!-- <option value="3">After Job</option> -->
                          <option value="4">Re-clean Jobs</option>
                          <option value="5">Review System</option>
                          <option value="6">Hr Application</option>
                          <option value="7">New Before Re-clean</option>
                          <option value="8">New Complaint Track</option>
                        </select>
                      </div>
                      <!-- <div class="col">
                        <button type="button" class="btn btn-info" @click="fetchStagesData">Search</button>
                      </div>
                      <div class="col">
                        <button type="button" class="btn btn-danger" @click="resetFilters">Reset</button>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="bc-kanban-board-view operation-kanban">
                  <div class="bc-kanban-box" v-for="(trackinfo, index) in currentTrackNames" :key="index">
                    <div class="d-flex justify-content-between kanban-header">
                      <h5 class="mb-0 kanban-column-title">{{ trackinfo }} <span class="kanban-title-badge" v-if="getTrackData[index] ?.total > 0">{{ getTrackData[index] ?.total  }}</span></h5>
                      <button type="button" class="ms-auto kanban-collapse-icon p-0 btn">
                        <i class="ti ti-arrow-bar-to-left"></i>
                      </button>
                    </div>
                    
                    <div class="kanban-items-main" v-if="getTrackData[index] ?.total > 0 ">
                      <component :is="currentComponent" :trackdata="getTrackData[index]" />
                    </div>

                       <div class="kanban-items-container"   v-else >
                            <div class="text-center">
                              <img class="no_record_f mt-2" :src="norecord"/>  
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
    </div>
  </template>
  
  <script>
  import { ref, watch, onMounted, computed } from 'vue';
  import { useCommonFunction } from './../../func/function.js';
  
  const {
    sendData,
    getddvaluedata,
    createErrorCustomSwal,
  } = useCommonFunction();
  
  // Import components
  import BeforeJobDay from './Task/BeforeJobDay.vue';
  import OnTheDayJobs from './Task/OnTheDayJobs.vue';
  import AfterJobDayJobs from './Task/AfterJobDayJobs.vue';
  import NewRecleanJobsPage from './Task/NewRecleanJobsPage.vue';
  //import RecleanTask from './Task/ReviewJobs.vue';
  import ReviewSystem from './Task/ReviewSystem.vue';
  import ApplicationSystem from './Task/ApplicationSystem.vue';
  import NewPageRecleanJobs from './Task/NewPageRecleanJobs.vue';
  import ComplaintTrack from './Task/ComplaintTrack.vue';
  //import NewComplaintTrack from './Task/NewComplaintTrack.vue';
  
  export default {
    props: ['tab'],
    setup(props) {
      const norecord = ref('../assets/img/no_record_found.svg');
      const selectedTaskType = ref(props.tab || 1);
      const stagesData = ref({});
      const currentTrackNames = ref([]);
  
      // Fetch stages data based on selected task type
      const fetchStagesData = async () => {
        const ddvalue = getStagesData(parseInt(selectedTaskType.value));
         
        if (ddvalue > 0) {
          await getDropdownValues(ddvalue);
        } else {
          createErrorCustomSwal('Please select a valid task type');
        }
      };
  
      // Fetch dropdown values based on task type
      const getDropdownValues = async (typeid) => {
        try {
            const responseinfo = await getddvaluedata([typeid]);

             // console.log('getddvaluedata info  ' , responseinfo);
            currentTrackNames.value = responseinfo[typeid] || [];
             
            // console.log('Current Track Names:', currentTrackNames.value); // Debugging log

             getTrackDataInfo(selectedTaskType.value , currentTrackNames.value);
           
        } catch (error) {
          console.error('Error fetching dropdown data:', error);
          createErrorCustomSwal('Error fetching dropdown data');
        }
      };
  
 
        const getTrackData = ref({ });

        const getTrackDataInfo = async (tracktype ,  trackname) => {

           
             const formData = { tracktype  , trackname };

            try {
                const response = await sendData('get', '/get-tracktype-data', formData);
                getTrackData.value = response.data
                console.log(getTrackData);
               
            } catch (error) {
                console.error('Error fetching total emails:', error);
            }
        };
        
      // Determine which task stages to fetch based on the task type
      const getStagesData = (type) => {
        const mapping = {
          1: 113,
          2: 116,
          3: 117,
          4: 158,
          5: 152,
          6: 55,
          7: 158,
          8: 137,
          // 9: 55,
          // 10: 158,
          // 11: 137,
          
        };
        return mapping[type] || 0; // Return 0 if no mapping found
      };
  
      // Computed property to determine the current component to render
      const currentComponent = computed(() => {
        
        switch (parseInt(selectedTaskType.value)) {
           
          case 1: return BeforeJobDay;
          case 2: return OnTheDayJobs;
          case 3: return AfterJobDayJobs;
          case 4: return NewRecleanJobsPage;
          case 5: return ReviewSystem;
          case 6: return ApplicationSystem;
          case 7: return NewPageRecleanJobs;
          case 8: return ComplaintTrack;
          //case 9: return NewPageRecleanJobs;
         // case 10: return NewComplaintTrack;
          default: return null;
        }
      });
  
      const resetFilters = () => {
        selectedTaskType.value = 1;
        stagesData.value = {};
        fetchStagesData();
      };
  
      const updateUrl = () => {
        const taskTypeValue = selectedTaskType.value;
        if (taskTypeValue) {
          window.history.pushState(null, '', `/operation-system?tab=${taskTypeValue}`);
        }
        fetchStagesData();
      };
  
      watch(() => props.tab, (newTab) => {
        selectedTaskType.value = newTab || 1;
        fetchStagesData();
      });
  
      onMounted(() => {
        fetchStagesData();
      });
  
      return {
        norecord,
        selectedTaskType,
        stagesData,
        currentComponent,
        currentTrackNames,
        fetchStagesData,
        resetFilters,
        updateUrl,
        getTrackData,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add any specific styles for your component here */
  </style>
  