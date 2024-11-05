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

                            <div class="bcic_bv_selectgroup m-3">
                                <div class="row">
                                    <div class="col mb-3">
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">P1</option>
                                            <option value="2">P2</option>
                                            <option value="3">P3</option>
                                            <option value="4">P4</option>
                                            <option value="5">P5</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">All</option>
                                            <option value="2">Let</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Quote Id</option>
                                            <option value="2">Job Id</option>
                                            <option value="3">App Id</option>
                                        </select>
                                    </div>


                                    <div class="col mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>

                                    <div class="col mb-3">
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="all">ALL</option>
                                            <option value="189">Alok Bajpai </option>
                                            <option value="149">Archa Mishra</option>
                                            <option value="183">Ashu Dixit</option>
                                            <option value="141">Bhavna Shukla</option>
                                            <option value="37">Cbd Movers</option>
                                            <option value="193">Harshit Gautam</option>
                                            <option value="120">Harshveer Chhabra</option>
                                            <option value="153">Indrani Saikia</option>
                                            <option value="182">Kailash Singh Rautela</option>
                                            <option value="158">Manali Manwadkar</option>
                                            <option value="198">Manan Bhatia</option>
                                            <option value="12">Nadia</option>
                                            <option value="140">Naval Verma</option>
                                            <option value="181">Neeraj Kumar</option>
                                            <option value="199">Nitisha Jeena</option>
                                            <option value="41">Payal Panda</option>
                                            <option value="162">Piyush Digari</option>
                                            <option value="174">Poorva Sharma</option>
                                            <option value="95">Ram Verma </option>
                                            <option value="134">Rashmi Chaturvedi</option>
                                            <option value="186">Sahil Kumar Gupta</option>
                                            <option value="175">Shubham Chauhan</option>
                                            <option value="150">Shweta Bhardwaj</option>
                                            <option value="194">Sondarya Malhotra</option>
                                            <option value="197">Sparsh Kapoor</option>
                                            <option value="143">Vimmi Kambo</option>
                                            <option value="171">Vinay Kumar</option>
                                        </select>
                                    </div>


                                     <div class="col mb-3">
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="all" selected="">ALL</option>
                                            <option value="1">Sales Tasks</option>
                                            <option value="3">Hr Tasks</option>
                                            <option value="4">Review Tasks</option>
                                            <option value="5">Custom Tasks</option>
                                            <option value="6">Reclean Task</option>
                                            <option value="7">Unassigned</option>
                                            <option value="8">Otd</option>
                                            <option value="10">Cleaner Quality</option>
                                            <option value="11">Staff Care Call</option>
                                            <option value="12">Complaints Task</option>
                                            <option value="13">Sales Task Yearly/voucher </option>
                                        </select>
                                    </div>

                                    <div class="col mb-2">
                                        <ul class="bcic_view_q_btns">
                                            <li><button type="submit" class="btn btn-primary "><i class="ti ti-search"></i> Search</button></li>
                                            <li><button type="submit" class="btn btn-danger "><i class="ti ti-reload"></i> Reset</button></li>
                                        </ul>
                                    </div>




                                </div>
                            </div>
                        </div>

                         <!--card top section end here-->


   <!-- <pre>{{ getTrackData.grouprec[1] }}</pre> -->

                         <!--List Section Start here-->
                         <div class="list-view-main">
                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                    <div class="accordion-item"   v-for="(trackname, trackKey) in GetSystemDD.trackddinfo" :key="trackKey">
                                        <h2 class="accordion-header" :id="'flush-heading' + trackKey">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#flush-collapseOne'+trackKey" aria-expanded="false" :aria-controls="'flush-collapseOne'+trackKey">
                                            <span> {{ getTrackData.grouprec[trackKey]?.length || 0 }} </span>{{  trackname  }}
                                        </button>
                                        </h2>
                                        <div  :id="'flush-collapseOne'+trackKey" class="accordion-collapse collapse" :aria-labelledby="'flush-headingOne'+trackKey" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">

                                                <div class="table-responsive list-view-qc"  >
                                                    
                                                       <div >
                                                            <component
                                                                :key="trackKey"
                                                                :is="Listcomponent[trackKey]"
                                                                :listData="getTrackData.grouprec[trackKey]"
                                                            />
                                                       </div>
                                                </div>

                                            </div>
                                        </div>
                                       
                                    </div>

                                    
                                   

                                </div>
                         </div>
                         <!--List Section End here-->




                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>


    <!--task view modal start Here-->
        <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header all_task_view_heading">
                <h2 class="modal-title fs-4" id="exampleModalLgLabel">All Task View</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="all_task_view list-view-qc">
                    <table class="table table-bordered ">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="ti ti-notes"></i> Task Name </th>
                                <th><i class="ti ti-clock-record"></i> OverDue 1+day</th>
                                <th><i class="ti ti-clock-12"></i> OverDue Today</th>
                                <th><i class="ti ti-checklist"></i>Current</th>
                                <th><i class="ti ti-report-search"></i> Upcoming Task</th>
                                <th><i class="ti ti-clock-hour-12"></i> Later</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Sales Tasks	</th>
                                <td> 12 </td>
                                <td> 6 </td>
                                <td> 10 </td>
                                <td> 12 </td>
                                <td> 230 </td>
                            </tr>

                            <tr>
                                <th>HR Tasks	</th>
                                <td> 12 </td>
                                <td> 6 </td>
                                <td> 10 </td>
                                <td> 12 </td>
                                <td> 230 </td>
                            </tr>

                            <tr>
                                <th>Review Tasks	</th>
                                <td> 12 </td>
                                <td> 6 </td>
                                <td> 10 </td>
                                <td> 12 </td>
                                <td> 230 </td>
                            </tr>

                            <tr>
                                <th>Custom Tasks	</th>
                                <td> 12 </td>
                                <td> 6 </td>
                                <td> 10 </td>
                                <td> 12 </td>
                                <td> 230 </td>
                            </tr>

                            <tr>
                                <th>Reclean Tasks	</th>
                                <td> 12 </td>
                                <td> 6 </td>
                                <td> 10 </td>
                                <td> 12 </td>
                                <td> 230 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    <!--task view modal end Here-->








</template>

<script >

import {defineComponent,  ref , onMounted  } from 'vue'; // Import necessary functions
import SalesTaskList from './List/SalesTaskList.vue';
import HRTaskList from './List/HRTaskList.vue';
import ReviewTaskList from './List/ReviewTaskList.vue';
import CustomTaskList from './List/CustomTaskList.vue';
import ReCleanTaskList from './List/ReCleanTaskList.vue';
import UnAssignTaskList from './List/UnAssignTaskList.vue';
import OtdTaskList from './List/OtdTaskList.vue';
import CleanerQualityTaskList from './List/CleanerQualityTaskList.vue';
import CallCareTaskList from './List/CallCareTaskList.vue';
import ComplaintTaskList from './List/ComplaintTaskList.vue';
import VoucherDataList from './List/VoucherDataList.vue';
import Header from './../Header.vue';

export default defineComponent({
    components : {
        Header,
    },
    setup() {
           // Define reactive image paths

            // Define a map of components
        const Listcomponent = {
            '1': SalesTaskList,
            '3': HRTaskList,
            '4': ReviewTaskList,
            '5': CustomTaskList,
            '6': ReCleanTaskList,
            '7': UnAssignTaskList,
            '8': OtdTaskList,
            '10': CleanerQualityTaskList,
            '11': CallCareTaskList,
            '12': ComplaintTaskList,
            '13': VoucherDataList
        };



            const GetSystemDD = ref({
                trackids : {},
                trackddinfo : {},
                priority : {},
            });
            const getddValue = async() => {
                try {
                    const response = await axios.post('/get-dd-value', {
                    ddids: [207,179,151,31],
                    _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });
                    GetSystemDD.value.trackids = response.data[207];
                    GetSystemDD.value.trackddinfo = response.data[179];
                    GetSystemDD.value.priority = response.data[151];
                } catch (error) {
                        console.error('Error saving quote:', error);
                }
            }
            
            const loading = ref(false);
            const trackdata = ref({
                adminid : 'all',
                taskType : 1,
                search_type : 0,
                search_value : '',
                isLate : 0,
                priority : 0,
            })
          
            const  getTrackData = ref({
                totalRecord : 0,
                tableRecord : 0,
                grouprec : {}
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
                        getTrackData.value.grouprec = groupRecords(response.data.totalRecod);
                        console.log(response.data);
                        

                     // loading.value = false; // Show loader
                   } catch (error) {
                         console.error('Error saving quote:', error);
                 } finally {
                    loading.value = false; // Hide loader
                }
            }

            const groupRecords = (allData) => {
                 
                     const groupedData = {};
                    allData.forEach(val1 => {
                        const pageType = val1.pageid;
                            if (!groupedData[pageType]) {
                                groupedData[pageType] = [];
                            }
                        groupedData[pageType].push(val1);
                    });
                return groupedData;
            };


            onMounted(() => {
                getddValue();
                gettrackalldata();
                setTimeout(function() {
                    console.log('SetTimeOut');
                    delete GetSystemDD.value.trackddinfo['2'];
                }, 1000);
            });
        // Return the reactive variables
        return {
       
            getddValue,
            GetSystemDD,
            Listcomponent,
            trackdata,
            getTrackData,
            gettrackalldata,
            groupRecords,

        };
    },
});


</script>



