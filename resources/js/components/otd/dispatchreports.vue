<template>
    <OperationHeader></OperationHeader>
   <div class="page-wrapper">
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
                                       <h5 class="card-title text-nowrap">Dispatch Task</h5>
                                   </div>

                                    <div v-if="loading" class="loader-container">
                                       <div class="loader"></div>
                                    </div>
   
                                
                                   <div class="">
                                              

                                               <div class=" d-inline-block me-2 ">
                                                   <input type="date" class="form-control" v-model="formdispatchData.formdate">
                                               </div>

                                               <div class="d-inline-block me-2">
                                                   <select class="form-select" v-model="formdispatchData.site_id">
                                                       <option value="0">Select Location</option>
                                                       <option :value="sites.id" v-for="(sites,index) in SitesLocation" :key="index">{{ sites.name }}</option>
                                                   </select>
                                               </div>


                                               <div class="d-inline-block me-2">
                                                   <select class="form-select" v-model="formdispatchData.job_type_id">
                                                       <option value="0">Select Job Type</option>
                                                       <option :value="jobdata.id" v-for="(jobdata, index) in getjobtypeInfo" :key="index">{{ jobdata.name }}</option>
                                                   </select>
                                               </div>


                                               <div class=" d-inline-block me-2">
                                                   <input type="text" class="form-control" v-model="formdispatchData.staff_id" placeholder="Staff Name">
                                               </div>

                                               <div class=" d-inline-block me-2">
                                                   <select class="form-select" v-model="formdispatchData.is_work"> 
                                                       <option value="0">Select No Work</option>
                                                       <option value="1">No</option>
                                                       <option value="2">Yes</option>
                                                   </select>
                                               </div>
                                            <div class="d-inline-block me-2">
                                                <button type="submit" class="btn btn-info" @click="dispatchSearch(1)">Search</button>
                                            </div>
                                               <div class="d-inline-block">
                                                   <button type="submit" class="btn btn-danger" @click="dispatchSearch(0)">Reset</button>
                                               </div>
                                   </div>
                           </div>


                       </div>

                       <div class="card-body">
                           <div class="row">
                               <!--Dispatch Calender Start Here-->
                                    <div class="col-md-12">

                                        <div class="d-flex justify-content-between mt-2">
                                           <ul class="bcic_dispatch_btns">
                                               <li><a href="javascript:void(0);"  @click="nextWeekSearch(3)"><i class="ti ti-chevron-left"></i> Prev day </a></li>
                                               <li><a href="javascript:void(0);"  @click="nextWeekSearch(4)"> Next day <i class="ti ti-chevron-right"></i> </a></li>
                                           </ul>

                                           <ul class="bcic_dispatch_btns">
                                               <li><a href="javascript:void(0);" @click="nextWeekSearch(1)"><i class="ti ti-chevron-left" ></i></a> </li>
                                               <li><a href="javascript:void(0);"  @click="nextWeekSearch(2)"><i class="ti ti-chevron-right"></i></a></li>
                                               <!-- <li data-bs-toggle="offcanvas" data-bs-target="#dispatchcanvasRight" aria-controls="dispatchcanvasRight"><i class="ti ti-user-circle"></i> Staff Assign</li> -->
                                           </ul>
                                        </div>

                                       <div class="unassigned_jobs border-0 mt-3 rounded-0">
                                           <table class="table table-bordered ">
                                               <thead class="table-info">
                                                   <tr>
                                                       <th>
                                                           <span> STAFF NAME </span>
                                                       </th>

                                                       <th v-for="dates in datesRange">
                                                            <span> {{  daynameformat(dates)  }} </span>
                                                            <p>{{ dsyformat(dates) }}</p>
                                                       </th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <tr  
                                                      v-for="(staffinfo,staffIndex) in stafflist" 
                                                      :key="staffIndex"
                                                      v-bind:style="{ background: (staffinfo.no_work === 2) ? '#e8d6d6' : '' }"
                                                     >
                                                        <td v-bind:style="{ background: (staffinfo?.substafflist.length > 0) ? '#e4f2e6' : '' }">
                                                           <h2 class="d-flex align-items-center dispatch_tooltip">
                                                                <a href="javascript:void(0);" class=" d-flex justify-content-start bcic_d_staff">
                                                                   <span class="avatar-name me-2">
                                                                     {{ initialsName(staffinfo.name) }} 
                                                                   </span>
                                                                   <div class="bcic_d_staff_d">
                                                                       <span class="fw-bold">{{ staffinfo.nick_name }}</span>
                                                                       <p class="text11"> <b>{{ SitesLocation[staffinfo.site_id]?.abv }}</b> ({{ staffinfo.job_types }})</p>
                                                                   </div>

                                                                </a>

                                                                <div class="dispatch_tooltiptext">
                                                                    <div class="contact_box_hedaer">
                                                                       <h6 class="m-0" key="t-notifications"> STAFF INFORMATION ( {{ SitesLocation[staffinfo.site_id]?.name }} ) </h6>
                                                                    
                                                                    </div>
                                                                    <div class="contact_box_details" v-if="staffinfo?.substafflist.length > 0">
                                                                        <ul class="">
                                                                            <li class="kanban-icon kanban-user" v-for="(substaff,subindex) in staffinfo?.substafflist" :key="subindex">{{ substaff.name }} -  {{ substaff.mobile }} </li>
                                                                        </ul>
                                                                       
                                                                    </div>  
                                                                   
                                                                    <div class="contact_box_details">
                                                                       <ul class="">
                                                                           <li class="kanban-icon kanban-user"><i class="ti ti-user-circle"></i> {{ staffinfo.name }}</li>
                                                                           <li class="kanban-icon kanban-email"><i class="ti ti-mail"></i> {{ staffinfo.email }}</li>
                                                                           <li class="kanban-icon kanban-phone"><i class="ti ti-phone-call"></i> <a href="#0">{{ staffinfo.mobile }}</a></li>
                                                                           <li class="kanban-icon kanban-phone">
                                                                               <i class="ti ti-users-group"></i> {{ staffinfo.team_of }}
                                                                               <select class="form-select mt-2" v-model="staffinfo.staff_member_rating">
                                                                                   <option>Select Rating</option>
                                                                                   <option value="0">0</option>
                                                                                   <option value="1">1</option>
                                                                                   <option value="2">2</option>
                                                                                   <option value="3">3</option>
                                                                                   <option value="4">4</option>
                                                                                   <option value="5">5</option>
                                                                               </select>
                                                                           </li>
                                                                           
                                                                           <li>
                                                                               <button type="button" class="btn btn-primary me-2"> Modify</button>
                                                                               <button type="button" class="btn btn-primary me-2"> Roster</button>
                                                                               <button type="button" class="btn btn-primary me-2"> Staff File</button>
                                                                           </li>
                                                                       </ul>
                                                                   </div>

                                                                </div>

                                                            </h2>



                                                       </td>
                                                       
                                                       <td v-for="(dates, index) in datesRange" 
                                                         :key="index"  
                                                         :class="getClassForDate(staffinfo.id, dates)"
                                                         >
                                                          
                                                          <!-- <pre>{{ checkStaffRoster?.[staffinfo.id][dates] }}</pre> -->

                                                          <div class="mb-1 dispatch_tooltip"  
                                                          v-if="staffJobdetails?.[staffinfo.id]?.[dates]?.length > 0"
                                                          v-for="(jobinfo, jobindex) in staffJobdetails?.[staffinfo.id]?.[dates] || []"
                                                          :key="jobindex">
                                                               <a href="javascript:void(0);" @click="openNewWindow('jobpopup?tab=job_details&job_id=' + jobinfo.job_id,'1500','800')"  :class="['dispatch_paid', addClassinfo(jobinfo.jobstatus)]" >
                                                                   <span class="dispatch_id"><b>J# {{  jobinfo.job_id  }}</b> [<span> {{  jobinfo.jobstatusName  }} </span>]</span>
                                                                   <span>{{ jobinfo.quote_details?.split(',')[0] }} </span>
                                                                   <p> {{ jobinfo.quote_details?.split(',')[3] }}  (Paid)</p>
                                                               </a>

                                                               <div class="dispatch_tooltiptext">
                                                                   <div class="contact_box_hedaer">
                                                                       <h6 class="m-0" key="t-notifications"> JOB# {{  jobinfo.job_id  }} [<span> {{  jobinfo.jobstatusName  }} </span>]</h6>
                                                                   </div>
                                                                   <div class="contact_box_details">
                                                                       <ul class="">
                                                                           <li class="kanban-icon kanban-email"><i class="ti ti-id"></i> Job ID : <a href="#0"> J# {{  jobinfo.job_id  }} </a></li>
                                                                           <li class="kanban-icon kanban-user"><i class="ti ti-user-circle"></i> {{ jobinfo.quote_details?.split(',')[0] }} </li>
                                                                           <li class="kanban-icon kanban-phone"><i class="ti ti-phone-call"></i>  {{ jobinfo.quote_details?.split(',')[2] }} </li>
                                                                            <li class="kanban-icon kanban-phone" v-if="jobinfo.jobtypes.length > 0 " v-for="(quoteinfo, jobindex) in jobinfo.jobtypes" >
                                                                               <b>{{ quoteinfo.job_name }}</b>
                                                                               <p><span>{{ quoteinfo.staffName }}</span> <span>{{ quoteinfo.staffmobile }}</span></p>
                                                                               <p class="mt-2 text-wrap" v-html="quoteinfo.desc"></p>
                                                                               <hr>
                                                                               
                                                                           </li>
                                                                           <p class="mt-2 text-wrap">{{ jobinfo.quote_details?.split(',')[5] }} </p>
                                                                       </ul>
                                                                   </div>
                                                               </div>
                                                            </div>
                                                       </td>
                                                       
                                                   </tr>

                                               </tbody>

                                           </table>
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
import { ref, watch, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';

import OperationHeader from '@/header/Operation.vue';
import { useCommonFunction } from '@func/func/function.js';

export default {
    components: {
        OperationHeader
    },
    setup() {
        const { sendData, initialsName, ymdformat, daynameformat, dsyformat, openNewWindow } = useCommonFunction();
        const route = useRoute();
        const router = useRouter();
        const loading = ref(false);

        

        const SitesLocation = ref([]);
        const getSites = async () => {
            try {
                const response = await sendData('get', '/api/get-sites', {});
                SitesLocation.value = response;
            } catch (err) {
                console.error('Error fetching site details:', err);
            }
        };

        const datesRange = ref([]);
        const dateInfoRange = ref({});
        const staffJobdetails = ref({});

      

        const formdispatchData = ref({
            formdate: route.query.formdate || '',
            site_id: Number(route.query.site_id) || 0,
            job_type_id: Number(route.query.job_type_id) || 0,
            staff_id: route.query.staff_id || '',
            is_work: Number(route.query.is_work) || 0,
        });

          
             const dispatchSearch = async (type) => 
            {
                if (type === 0) {
                    formdispatchData.value = {
                        formdate: '',
                        site_id: 0,
                        job_type_id: 0,
                        staff_id: '',
                        is_work: 0
                    };
                }

                console.log(stafflist.value);

                // Log updated form data
                console.log('Updated form data:', formdispatchData.value);

                // Update the route with query parameters
                router.push({ path: '/dispatch-report', query: { ...formdispatchData.value } });

                // Fetch data after updating the route
                await fetchData();

                // Log the updated staff list after filtering
                console.log('Updated staff list:', stafflist.value);
            };


            const stafflist = ref({});
            const getStafflist = async () => {
                try {

                   const formData = { ...formdispatchData.value };
                    const response = await sendData('get', '/dispatch-get-staff-list', formData);
                    stafflist.value = response.data;

                   //console.log(response.data);

                } catch (error) {
                    console.error('Error fetching staff list:', error);
                }
            };
 
        const fetchData = async () => {
            try {
                // Reset states that should be cleared before fetching new data
                datesRange.value = [];  // Reset datesRange
                dateInfoRange.value = {};  // Reset dateInfoRange
                staffJobdetails.value = {};  // Reset staffJobdetails

                // Fetch the necessary data in parallel
                await Promise.all([
                    getjobdetailsinfo(),
                    getStafflist(),
                ]);

                // Add a slight delay for subsequent calls if needed
                setTimeout(() => {
                    isCheckStaffRoster();
                    getSites();
                    getJobsType();
                }, 100);
            } catch (error) {
                console.error("Error loading data:", error);
            }
        };

           // Update getjobdetailsinfo method to reset datesRange correctly
            const getjobdetailsinfo = async () => {
                try {
                    loading.value = true; // Show loader
                    // Reset datesRange by assigning an empty array to it
                    datesRange.value = [];
                    
                    const formData = { ...formdispatchData.value };
                    //console.log('runtimedata' , formData);

                    const response = await sendData('get', '/get-dispatch-date', formData);
                    const startDate = new Date(response.from_date);
                    const endDate = new Date(response.to_date);
                    const date = new Date(startDate);

                    while (date <= endDate) {
                        datesRange.value.push(ymdformat(new Date(date)));  // Use .value to push values
                        date.setDate(date.getDate() + 1);
                    }

                    dateInfoRange.value = [...datesRange.value];  // Update dateInfoRange reactively
                    staffJobdetails.value = response.jobdetails;
                    
                    formdispatchData.value.formdate = response.from_date;

                    //console.log(response);
                    loading.value = false; // Show loader
                } catch (err) {
                    loading.value = false; // Show loader
                    console.error('Error fetching job details:', err);
                }
             };

        const checkStaffRoster = ref({});
        const isCheckStaffRoster = async () => {
            try {
                const formData = { 'alldates': [...dateInfoRange.value] };
                const response = await sendData('post', '/check-staff-roster', formData);
                checkStaffRoster.value = response;
            } catch (error) {
                console.error('Error checking staff roster:', error);
            }
        };

        const getjobtypeInfo = ref([]);
        const getJobsType = async () => {
            try {
                const response = await sendData('get', '/get-job-type-data', {});
                getjobtypeInfo.value = response;
            } catch (err) {
                console.error('Error fetching job types:', err);
            }
        };

        const nextWeekSearch =   (datesearchtype) => {
            
           formdispatchData.value.datesearchtype = datesearchtype;
            getjobdetailsinfo();
            getStafflist();
            router.push({ path: '/dispatch-report', query: { ...formdispatchData.value } });
        }

        // Use computed property for the class based on conditions
        const addClassinfo = (statusid) => {
            switch (statusid) {
                case 1:
                    return 'dispatch_primary';
                case 3:
                    return 'dispatch_semi';
                case 4:
                    return 'dispatch_dispute';
                case 5:
                    return 'dispatch_danger';
                default:
                    return 'dispatch_primary'; // Default class
            }
        };

        const getClassForDate = (staffId, date) => {
            return checkStaffRoster.value?.[staffId]?.[date] === 0 ? 'bg-danger-subtle' : '';
        };

        // Called on initial mount to fetch data
        onMounted(() => {
            fetchData();  // Initial fetch of data
        });

       
        return {
            stafflist,
            SitesLocation,
            datesRange,
            dateInfoRange,
            staffJobdetails,
            addClassinfo,
            checkStaffRoster,
            getClassForDate,
            getjobtypeInfo,
            formdispatchData,
            dispatchSearch,
            daynameformat,
            getJobsType,
            initialsName,
            openNewWindow,
            dsyformat,
            nextWeekSearch,
            loading,
        };
    }
};
</script>
