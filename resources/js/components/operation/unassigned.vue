<template>
    <OperationHeader /> 
    <div class="page-wrapper">
       <div class="content">
           <div class="row justify-content-center">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">

                        <!-- <pre> {{  datesRange  }}</pre> -->
                         <div class="d-flex justify-content-between">
                            <div class="pt-2">
                                   <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                       <i class="ti ti-user-dollar"></i>
                                   </div>
                                   <h5 class="card-title text-nowrap">
                                    Unassigned – Assigned (
                                    {{ unassigndatas.fromDate ? dsyformat(unassigndatas.fromDate) : '' }} -
                                    {{ unassigndatas.toDate ? dsyformat(unassigndatas.toDate) : '' }}
                                    )
                                  </h5>
                            </div>

                         
                        </div>

                       </div>


                      
                       <div class="card-body">

                           <!--Unassigned – Assigned Jobs Section Start Here -->
                               <div class="unassigned_jobs">
                                   <h5>Jobs</h5>
                                   <table class="table table-bordered">
                                       <thead class="table-info">
                                           <tr>
                                               <th></th>
                                               <th v-for="dates in datesRange">
                                                   <span> {{  daynameformat(dates)  }} </span>
                                                   <p>{{ dsyformat(dates) }}</p>
                                               </th>
                                               

                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr    v-for="(jobtype, index) in unassigndatas.jobTypes" :key="index"> 
                                               <th>{{ jobtype }}</th>
                                               <td v-for="datesdata in datesRange" :key="datesdata">
                                                    <div v-for="(jobtypes, jobassgKey) in unassigndatas.infodata[datesdata]?.[index]" :key="jobassgKey">
                                                        <div :class="jobassgKey === 'asng' ? 'assigned_jobs_l' : 'assigned_jobs_l unassigned_jobs_l'" v-if="jobassgKey === 'un-asng' || jobassgKey === 'asng'">
                                                            <div class="assigned_jobs_h">
                                                                {{ jobassgKey }} <span> {{  totalJobslength(jobtypes) }} </span>
                                                            </div>
                                                            <ul class="ms-2">
                                                                <li v-for="(sitename, siteindex) in jobtypes" :key="siteindex">
                                                                    {{ siteindex }} <span>{{  sitename.length }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                           </tr>

                                       </tbody>
                                   </table>
                               </div>
                           <!--Unassigned – Assigned Jobs Section End Here -->




                            <!--Unassigned – Assigned Jobs Section Start Here -->
                            <div class="unassigned_jobs mt-4">
                                  
                                   <div class="d-flex justify-content-between unassigned_location">
                                       <h5>Location</h5>
                                        <div class="row">

                                            <!-- <div class="col p-0 me-2"> 
                                                    <input class="form-control" type="date" value="2024-11-05" >
                                            </div>
                                            <div class="col p-0 me-2">
                                                <input class="form-control" type="date"  value="2024-11-05">
                                            </div> -->
            
                                            <div class="col p-0">
                                                <select class="form-select" v-model="unassignform.job_type_id">
                                                    <option value="all">ALL</option>
                                                    <option :value="index"  v-for="(jobtype, index) in unassigndatas.jobTypes" :key="index">{{ jobtype }}</option>
                                                    
                                                        <!-- <option value="all">ALL</option>
                                                        <option value="1">Cleaning</option>
                                                        <option value="2">Carpet</option>
                                                        <option value="3">Pest</option>
                                                        <option value="11">Removal</option> -->
                                                        
                                                </select>
                                            </div>
                 
                                            <div class="col">
                                                <select class="form-select"  v-model="unassignform.search_type_id">
                                                    <option value="0" disabled>Select</option>
                                                    <option value="1">Unassigned</option>
                                                    <option value="2">Assigned</option>
                                                    <option value="3">Both</option>
                                                </select>
                                            </div>
                                            <div class="col p-0">
                                                <ul class="bcic_view_q_btns">
                                                    <li><button type="submit" @click="searchunAssigned" class="btn btn-primary">Search</button></li>
                                                    <li><button type="submit" @click="resetAssign"  class="btn btn-danger">Reset</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                   </div>

                                   <!-- <pre>{{ jobunassignedinfo  }}</pre> -->

                                   <table class="table table-bordered">
                                       <thead class="table-info">
                                           <tr>
                                               <th>Location</th>
                                                <th v-for="dates in datesRange">
                                                    <span> {{  daynameformat(dates)  }} </span>
                                                    <p>{{ dsyformat(dates) }}</p>
                                                </th>

                                           </tr>
                                       </thead>
                                       <tbody>
                                        <!-- v-for="(jobtypes, jobassgKey) in unassigndatas.infodata[datesdata]?.[index]" :key="jobassgKey" -->
                                        <tr v-for="(siteinfo, siteKey) in SitesLocation" :key="siteKey">
                                            <th>{{ siteinfo.name }}</th>
                                            
                                            <!-- Loop through each date in datesRange -->
                                            <td v-for="dates in datesRange" :key="dates">
                                                <div class="d-flex justify-content-start">
                                                    <div v-if="jobunassignedinfo[siteinfo.id] && jobunassignedinfo[siteinfo.id][dates]" 
                                                        v-for="(jobGroup, jobTypeKey) in jobunassignedinfo[siteinfo.id][dates]" 
                                                        :key="jobTypeKey">
                                                        <!-- Loop through each job in the jobGroup -->
                                                        <span v-for="job in jobGroup" :key="job.job_id" class="btn-group me-1" role="group" aria-label="Basic mixed styles example">
                                                           
                                                            <div class="btn-group me-1" v-for="(jobnfo,indexkey) in job" :key="indexkey"  role="group" aria-label="Basic mixed styles example">
                                                                <a href="javascript:void(0)" 
                                                                    @click="openNewWindow('jobpopup?tab=job_details&job_id=' + jobnfo.job_id,'1500','800')">
                                                                        <button type="button" :class="jobnfo.job_acc_deny === 0 ? 'btn btn-success' : 'btn btn-primary'"  ><i class="ti ti-id"></i> 
                                                                                {{ jobnfo.job_id }} 
                                                                        </button>
                                                                    <button type="button" :class="jobnfo.job_acc_deny === 0 ? 'btn btn-success' : 'btn btn-primary'" >{{ jobnfo.jobabv }} </button>
                                                                </a>
                                                            </div>
                                                        </span>

                                                    </div>
                                                </div>
                                            </td>
                                          </tr>   
                                       </tbody>
                                   </table>
                               </div>
                           <!--Unassigned – Assigned Jobs Section End Here -->


                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

</template>




<script>

import OperationHeader from '@/header/Operation.vue';
import { ref, onMounted } from 'vue';
import { useCommonFunction } from '@func/func/function.js';

export default {
    components: {
        OperationHeader,
    },
    setup() {
        const { sendData , ymdformat, dsyformat,daynameformat, openNewWindow } = useCommonFunction();

         const unassigndatas = ref({});   
         const datesRange = [];

        // Data fetching function
        const getunassigndata = async () => {
            try {
                const formData = {};  // Ensure formData is initialized here
                const response = await sendData('get', '/get-un-assign-data', formData);
                // console.log(response);
                 unassigndatas.value = response;

                const startDate = new Date(unassigndatas.value.fromDate);
                const endDate = new Date(unassigndatas.value.toDate);

                for (let date = startDate; date <= endDate; date.setDate(date.getDate() + 1)) {
                    
                    datesRange.push(ymdformat(new Date(date)));
                }

            } catch (error) {
                console.error('Un-assigned jobs error:', error);
            }
        };

        const totalJobslength = (jobtypes) => {
           
            if(!jobtypes) return
            let totalLength = Object.values(jobtypes).reduce((sum, arr) => sum + arr.length, 0);
            return totalLength
        }  

          const unassignform = ref( {
              job_type_id : 'all',
              search_type_id : 3,
          });

            const SitesLocation = ref({});  
            
            const getSites = async () => {
  
                try {
                       
                    const formdate = {}
                    const response = await sendData('get' ,'/api/get-sites', formdate);
                    SitesLocation.value = response

                } catch (err) {
                   //error.value = 'Failed to fetch records';
                } finally {
                    // loading.value = false;
                }

            };	
            
            const jobunassignedinfo = ref({});

            const searchunAssigned = async () => {
                //console.log(unassigndatas.value.fromDate);

               const fromDate = unassigndatas.value.fromDate;
               const todate =  unassigndatas.value.toDate;

                try {
                    const formData = {...unassignform.value, fromDate, todate};  // Ensure formData is initialized here
                    console.log(formData);
                    const response = await sendData('get', '/get-job-un-assign-data-by-site', formData);
                    //console.log(response);
                    jobunassignedinfo.value = response.getjobInfo;

                    console.log(jobunassignedinfo.value);
                }catch{

                     console.error('search-assign function not working')
                }
            }

            const resetAssign = async () => {
                 unassignform.value = {
                        job_type_id : 'all',
                        search_type_id : 3,
                    }
                    searchunAssigned();
            }

       //currentDate.value = today.toISOString().slice(0, 10); // Format as YYYY-MM-DD

        // Run data fetch on component mount
        onMounted(() => {
            getunassigndata();
            getSites();
            setTimeout(async ()=>{
                searchunAssigned()
            },500 )
        });

        return {
           
            getunassigndata,
            unassigndatas,
            datesRange,
            dsyformat,
            daynameformat,
            totalJobslength,
            getSites,
            SitesLocation,
            unassignform,
            searchunAssigned,
            jobunassignedinfo,
            resetAssign,
            openNewWindow,
        };
    }
};

</script>



