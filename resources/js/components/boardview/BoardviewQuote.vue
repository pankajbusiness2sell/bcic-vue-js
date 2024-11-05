<template>
     <Header/>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
 
                    <div class="card-body p-0">
                        <!--card top  section start here-->

                        <div class="d-flex justify-content-between">
                            <div class="bcic_bv_btngroup m-3">
                                <ul>
                                    <li><a href="./track-board-view" class="btn btn-primary me-1"><i class="ti ti-layout-kanban"></i> kanban </a></li>
                                    <li><a href="./track-list-view" class="btn btn-primary me-1"><i class="ti ti-list"></i> List </a></li>
                                    <li><a href="#0" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#exampleModalLg"><i class="ti ti-checklist"></i> Task View </a></li>
                                </ul>
                            </div>
                            <div v-if="loading" class="loader-container">
                                <div class="loader"></div>
                            </div>

                           

                            <div class="bcic_bv_selectgroup m-3">
                                <div class="row">
                                    <div class="col mb-3">
                                        <select class="form-select" v-model="trackdata.priority">
                                            <option value="0">Select</option>
                                            <option v-for="(trackname, trackKey) in GetSystemDD.priority" 
                                                    :key="trackKey" 
                                                    :value="trackKey" >
                                                {{ trackname }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <select class="form-select" v-model="trackdata.isLate">
                                            <option value="0">Select</option>
                                            <option value="1">All</option>
                                            <option value="2">Let</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <select class="form-select" v-model="trackdata.search_type">
                                            <option value="0">Select</option>
                                            <option value="1">Quote Id</option>
                                            <option value="2">Job Id</option>
                                            <option value="3">App Id</option>
                                        </select>
                                    </div>

                                    
                                    <div class="col mb-3">
                                        <input type="text" class="form-control" v-model="trackdata.search_value" placeholder="Enter Name">
                                    </div>

                                    <div class="col mb-3">
                                        <select name="quote_auto_custom" class="form-select"  v-model="trackdata.adminid">
                                            <option value="0">Select Admin</option>
                                            <option value="all">All</option>
                                            <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                                        </select>
                                    </div>

                                     <div class="col mb-3">
                                        <select class="form-select" v-model="trackdata.taskType">
                                            <option value="all" selected="">ALL</option>
                                            <option   v-for="(trackname, trackKey) in GetSystemDD.trackddinfo" 
                                                    :key="trackKey" 
                                                    :value="trackKey"
                                                    >
                                                {{ trackname }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col mb-2">
                                        <ul class="bcic_view_q_btns">
                                            <li><button type="submit" class="btn btn-primary " @click="gettrackalldata"><i class="ti ti-search"></i> Search</button></li>
                                            <li><button type="submit" class="btn btn-danger " @click="trackReset"><i class="ti ti-reload"></i> Reset</button></li>
                                        </ul>
                                    </div>


                                 

                                </div>
                            </div>
                        </div>

                         <!--card top section end here-->

                        


                         <!--kanban Section Start here-->
                            <div class="bc-kanban-board-view">
 

                                <!--kanban first box start here-->
                                <div  :class="['bc-kanban-box', getClass(trackKey)]"   v-for="(trackname, trackKey) in GetSystemDD.trackids" :key="trackKey" >
                                    <div class="d-flex justify-content-between kanban-header">
                                        <h5 class="mb-0 kanban-column-title">{{ trackname }}<span class="kanban-title-badge">  
                                            {{ (getTrackData.totalRecord[trackKey]?.length ?? 0) }} </span></h5>
                                        <button type="button" class="ms-auto kanban-collapse-icon p-0 btn">
                                            <i class="ti ti-arrow-bar-to-left"></i>
                                        </button>
                                    </div>
                                    <div class="kanban-items-main">
                                    

                                      <!--kanban-items-container-->
                                      <div class="kanban-items-container" :id="'item_box_'+trackKey+'_'+trackIndex"  v-if="getTrackData.totalRecord[trackKey]?.length > 0"   v-for="(trackData,trackIndex) in getTrackData.totalRecord[trackKey]" :key="trackIndex" >
                                       
                                        <component
                                            :key="trackData.id"
                                            :is="componentMap[trackData.pageid]"
                                            :trackData="trackData"
                                            @quoteDetails="handleSidedata"
                                            @popup-name="handalpopup"
                                        />
                                        
                                      </div>

                                        <div class="kanban-items-container"   v-else >
                                        <div class="text-center">
                                            <img class="no_record_f mt-2" :src="norecord"/>  
                                            <span class="no_record_t pt-1">No Records Found</span>
                                            </div> 
                                        </div>     
                                    </div>
                               </div>
                                <!--kanban first box start here-->
                            </div>
                         <!--kanban Section End here-->
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>


     <!--Edit info Popup Design Start Here-->

       <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <TaskPopup
          :popupInfo="getpopupInfo"
          ></TaskPopup>
      </div>
      
      
       <!--task view modal start Here-->
       <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header all_task_view_heading">
                  <h2 class="modal-title fs-4" id="exampleModalLgLabel">All Task View</h2>

                  <select name="quote_auto_custom" class="form-select"  @change="showTaskData($event)">
                    <option value="0">Select Admin</option>
                    <option value="all">All</option>
                    <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                </select>

                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <div class="modal-body">
                
                 
                  <TaskViewPopup 
                    :trackids="GetSystemDD.trackddinfo"
                    :trackName="GetSystemDD.trackids"
                    :trackRecord="getTrackData.tableRecord || {}"
                    ></TaskViewPopup>
              </div>
              </div>
          </div>
        </div>
      <!--task view modal end Here-->


          <!--View Quote Section Start Here-->
    <div class="bcic_vquote_offcanvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasViewqrightSide" aria-labelledby="offcanvasViewqrightLabel">

        <QuoteNotes 
        :SidequoteData="QuotesidePanelInfo"
        :sitedata="SitesLocation"
        :admindata="admindata"
        ></QuoteNotes>
    </div> 

   

</template>

<script>

import {defineComponent,  ref , onMounted, watch  } from 'vue'; // Import necessary functions
import SalesTask from './track/SalesTask.vue';
import HRTask from './track/HRTask.vue';
import ReviewTask from './track/ReviewTask.vue';
import CustomTask from './track/CustomTask.vue';
import ReCleanTask from './track/ReCleanTask.vue';
import UnAssignTask from './track/UnAssignTask.vue';
import OtdTask from './track/OtdTask.vue';
import CleanerQualityTask from './track/CleanerQualityTask.vue';
import CallCareTask from './track/CallCareTask.vue';
import ComplaintTask from './track/ComplaintTask.vue';
import VoucherData from './track/VoucherData.vue';

import QuoteNotes from './../notes/QuoteNotes.vue'; // Import the QuoteNotes component
import TaskViewPopup from './TaskViewPopup.vue'; // Import the QuoteNotes component
import TaskPopup from './track/Task/taskpopup.vue'; // Import the QuoteNotes component
import Header from './../Header.vue';

export default defineComponent({ 
       
       components: { 
           SalesTask,
           HRTask,
           ReviewTask,
           CustomTask,
           ReCleanTask,
           UnAssignTask,
           OtdTask,
           CleanerQualityTask,
           CallCareTask,
           ComplaintTask,
           SalesTask,
           VoucherData,
           QuoteNotes,

           TaskViewPopup,
           TaskPopup,
           Header,
       },
     setup(props) { 
        const norecord = ref('../assets/img/no_record_found.svg');
       
        const QuotesidePanelInfo = ref({});

        const handleSidedata =  async (allData) => {
            let pageid = allData.pageid;
            let tracktypeid = allData.Parenttrackid;

             //console.log(pageid + ' === '+tracktypeid);

                if(pageid > 0 && pageid == 1) {

                    const offcanvasElement = document.getElementById('offcanvasViewqrightSide');
                        if (offcanvasElement) {
                        const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                        offcanvas.show();
                        } else {
                        console.warn('Element with ID offcanvasViewqrightSide not found.');
                        }

                        try {
                        // Retrieve CSRF token
                        const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content || '';
                        // Make an Axios GET request to fetch quote details
                        const { data } = await axios.get('./sidequotedetails', {
                            params: { quote_id: tracktypeid },
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        });
                        QuotesidePanelInfo.value = data;
                        // Initialize and show the Bootstrap offcanvas
                
                    } catch (error) {
                        // Handle errors gracefully
                        console.error('Error fetching quote details:', error);
                    }
                }

        };

      

         // Define a map of components
        const componentMap = {
            '1': SalesTask,
            '3': HRTask,
            '4': ReviewTask,
            '5': CustomTask,
            '6': ReCleanTask,
            '7': UnAssignTask,
            '8': OtdTask,
            '10': CleanerQualityTask,
            '11': CallCareTask,
            '12': ComplaintTask,
            '13': VoucherData
        };

        const loading = ref(false);

          const trackdata = ref({
            adminid : 'all',
            taskType : 3,
            search_type : 0,
            search_value : '',
            isLate : 0,
            priority : 0,
          })
          
        const  getTrackData = ref({
            totalRecord : 0,
            tableRecord : 0
        });

            const gettrackalldata = async() => {
                loading.value = true; // Show loader
                 try {
                        const response = await axios.get('/get-track-data', {
                            params: {
                                adminid: trackdata.value.adminid,
                                taskType: trackdata.value.taskType,
                                search_type: trackdata.value.search_type,
                                search_value: trackdata.value.search_value,
                                isLate: trackdata.value.isLate,
                                priority: trackdata.value.priority,
                            },
                        });
                        getTrackData.value.totalRecord = response.data.alldata;
                        getTrackData.value.tableRecord = response.data.totaldata;
                        console.log(response.data);

                     // loading.value = false; // Show loader
                   } catch (error) {
                         console.error('Error saving quote:', error);
                 } finally {
                    loading.value = false; // Hide loader
                }
            }

            const trackReset = () => {
                    trackdata.value.adminid = '0';
                    trackdata.value.taskType = 3;
                    trackdata.value.search_type = 0;
                    trackdata.value.search_value = '';
                    trackdata.value.isLate = 0;
                    trackdata.value.priority = 0;
                    gettrackalldata();
             }

            const showTaskData = function(){
                trackdata.value.adminid = event.target.value;
                gettrackalldata();
             }
         
            const GetSystemDD = ref({
                trackids : {},
                trackddinfo : {},
                priority : {},
            });
            const getddValue = async() => {
                try {
                    const response = await axios.post('/get-dd-value', {
                    ddids: [207,179,151],
                    _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });
                    GetSystemDD.value.trackids = response.data[207];
                    GetSystemDD.value.trackddinfo = response.data[179];
                    GetSystemDD.value.priority = response.data[151];
                } catch (error) {
                        console.error('Error saving quote:', error);
                }
            }

        
                const getClass = (trackKey) => {
                    
                   switch (trackKey) {
                        case "1":
                        return '';
                        case "2":
                        return 'bc-kanban-fir';
                        case "3":
                        return 'bc-kanban-sec';
                        case "4":
                        return 'bc-kanban-thir';
                        default:
                        return 'bc-kanban-four'; // Default class
                    }
                };

            // const admindataRed = ref({});
            const admindata = ref({});

            const getAdminData = async () =>{
                try {
                    const response = await axios.get('/admin-data');
                    admindata.value = response.data;
                } catch (error) {
                    console.error('Error In getAdminData:', error);
                }
            }
 
             
             
            //trackReset,  this.formData = Object.assign({}, this.originalFormData);

            const SitesLocation = ref([]);  
            
            const getSites = async () => {
  
                try {
                    const response = await axios.get('/api/get-sites');
                    SitesLocation.value = response.data;

                } catch (err) {
                //error.value = 'Failed to fetch records';
                } finally {
                // loading.value = false;
                }

            };		  
 
            const getpopupInfo = ref({})
            const handalpopup = (popupInfo) => {
                 getpopupInfo.value = popupInfo;
                // console.log(getpopupInfo.value);
            }


            // watch(
            //     () => GetSystemDD.trackddinfo, // This is the reactive property to watch
            //     () => {
            //         setTimeout(() => {
            //         console.log('SetTimeOut',  GetSystemDD.trackddinfo );
            //         delete GetSystemDD.trackddinfo[2];
            //         }, 1000);
            //     }
            // );

            


            // document.addEventListener("DOMContentLoaded", function () {

            //     document.querySelectorAll('.dropdown-menu').forEach(function (element) {
            //         element.addEventListener('click', function (e) {
            //             e.stopPropagation();
            //         });
            //     })

            //     // make it as accordion for smaller screens
            //     if (window.innerWidth < 992) {

            //         // close all inner dropdowns when parent is closed
            //         document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
            //             everydropdown.addEventListener('hidden.bs.dropdown', function () {
            //                 // after dropdown is hidden, then find all submenus
            //                 this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
            //                     // hide every submenu as well
            //                     everysubmenu.style.display = 'none';
            //                 });
            //             })
            //         });

            //         document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
            //             element.addEventListener('click', function (e) {

            //                 let nextEl = this.nextElementSibling;
            //                 if (nextEl && nextEl.classList.contains('submenu')) {
            //                     // prevent opening link if link needs to open dropdown
            //                     e.preventDefault();
            //                     console.log(nextEl);
            //                     if (nextEl.style.display == 'block') {
            //                         nextEl.style.display = 'none';
            //                     } else {
            //                         nextEl.style.display = 'block';
            //                     }

            //                 }
            //             });
            //         })
            //     }
            // });


        onMounted(() => {
            gettrackalldata();
            getddValue();
            getSites();
            getAdminData(); 
            setTimeout(function() {
                console.log('SetTimeOut');
                delete GetSystemDD.value.trackddinfo['2'];
            }, 1000);
           
        });

        return {
            gettrackalldata,
            trackdata,
            GetSystemDD,
            getddValue,
            getClass,
            getTrackData,
            componentMap,

            getAdminData,
            admindata,
            SitesLocation,
            getSites,
            QuotesidePanelInfo,
           // QuotesidePanel,
            handleSidedata,
            loading,
            showTaskData,
            trackReset, 
            norecord,

            handalpopup,
            getpopupInfo,

        }
    }
});
</script>
