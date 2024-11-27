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
                                               <li><i class="ti ti-chevron-left" @click="nextWeekSearch(3)"></i> Prev day </li>
                                               <li @click="nextWeekSearch(4)"> Next day <i class="ti ti-chevron-right"></i> </li>
                                           </ul>

                                           <ul class="bcic_dispatch_btns">
                                               <li><i class="ti ti-chevron-left" @click="nextWeekSearch(1)"></i> </li>
                                               <li><i class="ti ti-chevron-right" @click="nextWeekSearch(2)"></i></li>
                                               <li data-bs-toggle="offcanvas" data-bs-target="#dispatchcanvasRight" aria-controls="dispatchcanvasRight"><i class="ti ti-user-circle"></i> Staff Assign</li>
                                           </ul>

                                       </div>

                                       <!-- <pre>{{ datesRange }}</pre>   -->

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
                                                        <td>
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
                               <!--Dispatch Calender Start Here-->

                               <!--Dispatch Sidebar Start Here-->



                               <div class="offcanvas offcanvas-end" tabindex="-1" id="dispatchcanvasRight" aria-labelledby="dispatchcanvasRightLabel">
                                   <div class="offcanvas-header">
                                       <h5 class="offcanvas-title" id="dispatchcanvasRightLabel">Staff Assign Jobs</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                   </div>
                                   <div class="offcanvas-body">

                                       <div class="row">
                                           <div class="col-md-12 pb-2">
                                               <select class="form-select">
                                                   <option value="0">Select</option>
                                                   <option value="1">Active</option>
                                                   <option value="2">Cancelled</option>
                                                   <option value="3">Completed</option>
                                                   <option value="4">Complaints</option>
                                                   <option value="5">Reclean</option>
                                                   <option value="6">Onhold</option>
                                                   <option value="7">Dispute</option>
                                                   <option value="8">Damage</option>
                                                   <option value="9">Awaiting Exit Report</option>
                                                   <option value="10">Payment Delayed</option>
                                               </select>
                                           </div>
                                           <div class="col-md-12 pb-2">
                                               <div class="searchinputs" id="dropdownMenuClickable">
                                                   <input type="text" placeholder="Search">
                                                   <div class="search-addon">
                                                   <button type="submit"><i class="ti ti-search"></i></button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>


                                       <div class="otd_job_details_rightpanel">

                                           <nav class="pb-2">
                                           <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                               <button class="nav-link active" id="nav-allnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-allnotes" type="button" role="tab" aria-controls="nav-allnotes" aria-selected="true">Assigned</button>
                                               <button class="nav-link" id="nav-staffnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-staffnotes" type="button" role="tab" aria-controls="nav-staffnotes" aria-selected="false">Not Assigned</button>

                                           </div>
                                           </nav>
                                           <div class="tab-content" id="nav-tabContent">
                                               <div class="tab-pane fade show active" id="nav-allnotes" role="tabpanel" aria-labelledby="nav-allnotes-tab" tabindex="0">
                                                   <div class="dispatch_assigned_job">
                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->


                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->


                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->


                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->


                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->

                                           <!--Assigned Job Start Here-->
                                           <div class="dispatch_assign mb-2">
                                               <div class="d-flex justify-content-between fw-bold">
                                                   <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                   <span><i class="ti ti-id"></i> 56366</span>
                                               </div>
                                               <div class="d-flex justify-content-between text-black">
                                                   <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                   <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                               </div>
                                               <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                               <div class="d-flex justify-content-between text-black fw-medium">
                                                   <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                   <span><i class="ti ti-premium-rights"></i> 800</span>
                                               </div>
                                           </div>
                                           <!--Assigned Job End Here-->
                                       </div>

                                               </div>

                                               <div class="tab-pane fade" id="nav-staffnotes" role="tabpanel" aria-labelledby="nav-staffnotes-tab" tabindex="0">

                                                   <!--Not Assigned Job Start Here-->
                                                       <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->

                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->

                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->


                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->

                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->

                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->

                                                    <!--Not Assigned Job Start Here-->
                                                    <div class="dispatch_assign dispatch_notassign mb-2">
                                                           <div class="d-flex justify-content-between fw-bold">
                                                               <span><i class="ti ti-user-circle"></i> Taylor Harding</span>
                                                               <span><i class="ti ti-id"></i> 56366</span>
                                                           </div>
                                                           <div class="d-flex justify-content-between text-black">
                                                               <span><i class="ti ti-phone-call"></i> 0422055891 </span>
                                                               <span><i class="ti ti-calendar-event"></i> 11th Sep 2024</span>
                                                           </div>
                                                           <p class="m-0 text-black"><i class="ti ti-map-pin"></i> 9/49 Church Street, Wollongong NSW, Australia</p>
                                                           <div class="d-flex justify-content-between text-black fw-medium">
                                                               <span><i class="ti ti-map-pin"></i> Gold Coast ELANORA </span>
                                                               <span><i class="ti ti-premium-rights"></i> 800</span>
                                                           </div>
                                                           <div class="bcic_view_quote_table table-responsive">
                                                               <table class="table table-bordered table-hover mt-2">
                                                                   <thead class="table-primary text-nowrap">
                                                                       <tr>
                                                                           <th>Type </th>
                                                                           <th> Amount </th>
                                                                           <th> Cleaner </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                       <tr class="align-middle">
                                                                           <td>
                                                                               Cleaning
                                                                           </td>
                                                                           <td>
                                                                               320
                                                                           </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="233">Pankaj Gupta Removal</option>
                                                                                   <option value="442">Bcic Pty Ltd</option>
                                                                                   <option value="558">Suman Basnet</option>
                                                                                   <option value="890">Zorica  Kostic</option>
                                                                                   <option value="1092">Louise Beatrice Ignacio </option>
                                                                                   <option value="1829">Sajedur Rahman </option>
                                                                                   <option value="1929">Vivek  Chimanbhai Borad</option>
                                                                                   <option value="2015">Fawad Farooq</option>
                                                                                   <option value="2028">Karanveer Singh</option>
                                                                                   <option value="2130">Priya Bhambri </option>
                                                                                   <option value="2153">Karanveer K</option>
                                                                                   <option value="2160">Paul Heena </option>
                                                                                   <option value="2162">Sourabh</option>
                                                                                   <option value="2271">Deep Patel</option>
                                                                                   <option value="2330">Jennifer Velasquez Gonzales </option>
                                                                                   <option value="2339">Ruhunage Kane</option>
                                                                                   <option value="2391">Atakan  Atakul</option>
                                                                                   <option value="2345">Malgorzata Nick </option>
                                                                                   <option value="2386">Sandeep Kaur</option>
                                                                                   <option value="2398">Nitesh Shrestha</option>
                                                                                   <option value="2413">Durga Sapkota</option>
                                                                                   <option value="2430">Nabin Bhandari</option>
                                                                                   <option value="2434">Jasleen Singh</option>
                                                                                   <option value="2447">Farhio Abdi Khalif</option>
                                                                                   <option value="2450">Prachi </option>
                                                                                   <option value="2465">Vidura Dharmasena Konara Mudiyanselage</option>
                                                                                   <option value="2508">Rujal  </option>
                                                                                   <option value="2478">Royal Singh Jammu </option>
                                                                                   <option value="2482">Sukhjinder Pal Singh</option>
                                                                                   <option value="2483">Jyoti Rani</option>
                                                                                   <option value="2492">Moshin Ali Mir  </option>
                                                                                   <option value="2496">Ashpreet Ash Singh </option>
                                                                                   <option value="2497">Sehajpreet Singh </option>
                                                                                   <option value="2504">Ramandeep Kaur</option>
                                                                                   <option value="2503">Grishma Hareshbhai Tejani </option>
                                                                                   <option value="2509">Sembukuttige Harandra De Silva </option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                       <tr class="align-middle">
                                                                           <td>Gardening</td>
                                                                           <td> 160 </td>
                                                                           <td>
                                                                               <select class="form-select">
                                                                                   <option value="0">Select</option>
                                                                                   <option value="1468">Rajankumar Vishnubhai Prajapati</option>
                                                                                   <option value="2267">Nirmani Ranasinghe</option>
                                                                                   <option value="2298">Simrandeep Singh</option>
                                                                               </select>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   <!--Not Assigned Job End Here-->


                                               </div>



                                           </div>

                                   </div>











                                   </div>
                               </div>



                               <!--Dispatch Sidebar End Here-->
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

        // const formdispatchData = ref({
        //     formdate: '',
        //     site_id: 0,
        //     job_type_id: 0,
        //     staff_id: '',
        //     is_work: 0
        // });

        const updateFormFromQuery = (query) => {
            
            console.log('Query' , query);

            
        };


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

                // Filtering stafflist based on site_id and site_id2
                // if (formdispatchData.value.site_id !== 0) {
                //     stafflist.value = stafflist.value.filter(staff =>
                //         staff.site_id === formdispatchData.value.site_id ||
                //         staff.site_id2 === formdispatchData.value.site_id
                //     );
                // }

               
                // Log the updated staff list after filtering
                console.log('Updated staff list:', stafflist.value);
            };


            const stafflist = ref({});
            const getStafflist = async () => {
                try {

                   const formData = { ...formdispatchData.value };
                    const response = await sendData('get', '/dispatch-get-staff-list', formData);
                    stafflist.value = response.data;
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
                    // Reset datesRange by assigning an empty array to it
                    datesRange.value = [];
                    
                    const formData = { ...formdispatchData.value };
                    console.log('runtimedata' , formData);

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

                    console.log(response);
                } catch (err) {
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
            
             //datesearchtype 1=> pre day 2 => next day , 3=> pre week, 4 => next week
           // const formData = { ...formdispatchData.value , datesearchtype };
           formdispatchData.value.datesearchtype = datesearchtype;
            getjobdetailsinfo();
            // console.log(formData);
            // console.log('next Updated form data:', formdispatchData.value);
                // Update the route with query parameters
            //router.push({ path: '/dispatch-report', query: { ...formdispatchData.value } });
             
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
           // console.log(route.query);
        });

        // Watch for route query changes and update form data accordingly
        watch(
            () => route.query,
            (newQuery) => {
                console.log('Route Query Changed:', newQuery);
                updateFormFromQuery(newQuery);
                //router.push({ query: { ...formdispatchData.value } });
                router.push({ path: '/dispatch-report', query: { ...formdispatchData.value } });
                //fetchData();  // Fetch data when the route query changes, and it will reset states
            },
            { immediate: true }  // Ensure it runs initially as well
        );

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
        };
    }
};
</script>
