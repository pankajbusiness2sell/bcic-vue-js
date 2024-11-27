<template>
    <OperationHeader />

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                      
                   

                    <!-- <div class="card-header bcic_view_quoteheader">
                        <div class=" d-flex justify-content-between bcic_view_m_sec">
                            <div class="bcic_view_l_sec mt-2">
                                <ul>
                                    <li v-for="(item, index) in GetSystemDD[31]" :key="index" >
                                        <a :href="`./view-quote?task_action=${index}`" class="badge-light-primary">{{ item }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                <div class="card-body p-0">
                    <form @submit.prevent="searchViewQuote">
                        <div class="view_quote_select">
                            <div class="row">
                                <div class="col mb-2">
                                    <label class="form-label">Quote For</label>
                                    <select class="form-select" id="quote_form" v-model="searchCriteria.quote_for"  >
                                        <option value="0">select</option>
                                        <option v-for="quotefor in quoteFors" :key="quotefor.id" :value="quotefor.id">{{ quotefor.name }}</option>
                                    </select>
                                </div>

                            <div class="col mb-2">
                                <label class="form-label">Job Type </label>
                                <select class="form-select" id="job_type" v-model="searchCriteria.job_type" >
                                    <option value="0" selected>Select</option>
                                    <option  v-for="jobinfo in jobtype" :key="jobinfo.id" :value="jobinfo.id">{{ jobinfo.name }}</option>
                                </select>
                            </div>

                            <div class="col mb-2">
                                <label class="form-label">Location</label>
                                <select class="form-select" name="site_id"  v-model="searchCriteria.site_id" >
                                    <option value="0">Select</option>
                                    <option  v-for="sitesVal in SitesLocation" :key="sitesVal.id" :value="sitesVal.id">{{ sitesVal.name }}</option>
                                </select>
                            </div>
                        
                            <div class="col mb-2">
                                <label class="form-label">Job Status</label>
                                <select class="form-select" v-model="searchCriteria.job_status" >
                                    <option value="0">Select</option>
                                    <option  v-for="(item, index) in GetSystemDD[26]" :value="index" :key="index">
                                    {{ item }}
                                    </option>
                                </select>
                            </div>

                            <div class="col mb-2">
                                <label class="form-label">Reference</label>
                                <select class="form-select" v-model="searchCriteria.quote_ref" >
                                    <option value="0">Select</option>
                                    <option  v-for="(item, index) in GetSystemDD[28]" :value="item" :key="index">
                                    {{ item }}
                                    </option>
                                </select>
                            </div>

                            <div class="col mb-2">
                                <label class="form-label">Search Info</label>
                                <input type="text" class="form-control" v-model="searchCriteria.search_value">
                            </div>
                        

                            <div class="col mb-2">
                                <label class="form-label">Quote Type</label>
                                <select class="form-select"  v-model="searchCriteria.quote_type">
                                    <option value="0">Select</option>
                                    <option  v-for="(item, index) in GetSystemDD[63]" :value="index" :key="index">
                                    {{ item }}
                                    </option>
                                </select>
                            </div>

                            <div class="col mb-2">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control" v-model="searchCriteria.from_date">
                            </div>

                            <div class="col mb-2">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control" v-model="searchCriteria.to_date">
                            </div>

                        
                            
                            <div class="col mb-2">
                                <label class="form-label">Quote Status</label>
                                
                                <select class="form-select" v-model="searchCriteria.quote_status">
                                    <option value="0">Select</option>
                                    <option  v-for="(item, index) in GetSystemDD[31]" :value="index" :key="index">
                                    {{ item }}
                                    </option>
                                </select>
                            </div>

                            <!-- <div class="col mb-2">
                                <label class="form-label">Have Removal</label>
                                <select class="form-select">
                                    <option value="0">Select</option>
                                    <option  v-for="(item, index) in GetSystemDD[90]" :value="item" :key="index">
                                    {{ item }}
                                    </option>
                                </select>
                            </div> -->
                    
                                <div class="col mb-2">
                                    <label class="form-label">Admin</label>
                                    <select name="quote_auto_custom" class="form-select" v-model="searchCriteria.login_id">
                                        <option value="0">Select Admin</option>
                                        <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                                    </select>
                                </div>

                                <div class="col mb-2">
                                    <ul class="bcic_view_q_btns">
                                        <li><button type="submit" class="btn btn-primary bcic_btns">Search</button></li>
                                        <li><button type="submit" class="btn btn-danger bcic_btns" @click="resetFor();">Reset</button></li>
                                    </ul>
                                </div>
                            </div> 
                       </div>
                    </form>  
                </div>

                    <div class="view_quote_totals">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-dot">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 6.66a2 2 0 0 0 -1.977 1.697l-.018 .154l-.005 .149l.005 .15a2 2 0 1 0 1.995 -2.15z" />
</svg>  Total Records {{ quoteData.total_count  }} 
 
                    </div>

                    <div class="card-body pb-0">
                        <div class="row">
                            

                        <div class="col-md-12">
                            <div class=" bcic_view_quote_table table-responsive mb-5 ">

                      <!-- <pre>{{  quoteData }}</pre> -->

                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary text-nowrap">
                                        <tr>
                                            <th><i class="ti ti-id"></i>Id</th>
                                            <th><i class="ti ti-id"></i> Job Id</th>
                                            <th><i class="ti ti-circle-letter-q"></i>Q For</th>
                                            <th><i class="ti ti-world"></i> Site</th>
                                            <th><i class="ti ti-devices"></i> Ref</th>
                                            <th><i class="ti ti-calendar-time"></i>Q Date</th>
                                            <th><i class="ti ti-clock-hour-2"></i> Q Time</th>
                                            <th><i class="ti ti-calendar-time"></i>J Date </th>
                                            <th><i class="ti ti-user-circle"></i> Name</th>
                                            <th><i class="ti ti-mail"></i> Email</th>
                                            <th><i class="ti ti-phone"></i> Phone</th>
                                            <th><i class="ti ti-circle-dot"></i> Suburb</th>
                                            <th><i class="ti ti-calendar-time"></i>J Type </th>
                                            
                                            <th><i class="ti ti-premium-rights"></i> Amt</th>
                                            <th><i class="ti ti-graph"></i> Status</th>
                                            <!-- <th><i class="ti ti-graph"></i> Is Paid</th>
                                            <th><i class="ti ti-briefcase"></i> Job Status</th> -->
                                            <th><i class="ti ti-user-circle"></i> Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-nowrap">
                                        <!--View Quote Card Start Here -->
                                         <tr v-if="quoteData.total_count > 0"   :class="['parent_tr', data.className, getDynamicClass(data)]"   v-for="(data,indexKey) in quoteData.data" :key="indexKey"  >
                                             <!-- <pre>{{  data }}</pre> -->
                                            <td class="bc_click_btn pick_row">
                                                <div class="t_vq_id" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ID"> 
                                                    <!-- <a href="javascript:void(0);"  @click="QuotesidePanel(data.id)"  >{{ data.id }}</a>  -->
                                                    <a href="javascript:void(0);"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasViewqright" aria-controls="offcanvasViewqright"  @click="QuotesidePanel(data.id)"  >{{ data.id }}</a> 
                                                </div>
                                            </td>
                                            <td class="pick_row">
                                                <div class="t_vq_id"   v-if="data.booking_id > 0"
                                                     data-bs-toggle="tooltip" 
                                                     data-bs-placement="top" 
                                                     data-bs-title="Job ID">
                                                    <a href="javascript:void(0)" 
                                                     @click="openNewWindow('jobpopup?tab=job_details&job_id=' + data.booking_id,'1500','800')">
                                                     {{ data.booking_id }} 
                                                    </a>

                                                </div>
                                            </td>
                                            <td class="bc_click_btn pick_row">
                                                <div class="t_qf_ids" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quote For"> {{ getqute(data.quote_for) }}  </div>
                                            </td>
                                            <td class="bc_click_btn" title="Newcastle">{{ getlocation(data.site_id) }}</td>
                                            <td class="bc_click_btn" title="">
                                                 {{  data.job_ref }}
                                                <!-- <div class="vq_website" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Website"><i class="ti ti-world-www"></i></div> -->
                                            </td>
                                            <td class="bc_click_btn" :title="data.date">
                                               <div class="vq_ids" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quote Date">{{ data.date }} </div>
                                            </td>
                                             <td class="bc_click_btn" :title="data.createdOn">
                                               <div class="vq_ids" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quote Date"> {{ data.createdOn }}</div>
                                            </td>
                                            <td class="bc_click_btn" :title="data.booking_date">{{ data.booking_date }}</td>
                                            <td class="bc_click_btn">{{ data.name }}</td>
                                            <td class="bc_click_btn" :title="data.email"> <a :href="'mailto:' + data.email">{{ data.email }}</a></td>
                                            <td class="bc_click_btn"><a :href="'tel:' + data.phone">{{ data.phone }}</a></td>
                                            <td class="bc_click_btn"><a :title="data.address">{{ data.suburb }}</a></td>
                                            <td class="bc_click_btn">
                                                <ul>
                                                    <li :title="jobdata.job_type" v-for="jobdata in data.quoteDesc" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 50 50"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke="#138062" d="M14.583 33.333H31.25v-12.5H14.583z"/><path stroke="#138062" d="M10.417 41.667H37.5a2.083 2.083 0 0 0 2.083-2.084v-25A2.083 2.083 0 0 0 37.5 12.5H14.583"/><path stroke="#138062" d="M43.75 35.417h-4.167m-25-22.917v25a4.167 4.167 0 1 1-8.333 0v-25a4.167 4.167 0 1 1 8.333 0m-4.166 20.833a4.166 4.166 0 1 0 0 8.333a4.166 4.166 0 0 0 0-8.333M43.75 18.75h-4.167zm0 8.333h-4.167z"/></g></svg></li>
                                                </ul>
                                            </td>
                                            
                                            <td class="bc_click_btn"><div class="vq_t_price" data-bs-toggle="tooltip1" data-bs-placement="top" data-bs-title="Amount"> <i class="ti ti-currency-dollar"></i> {{ data.amount }} </div> </td>
                                            
                                            <td>
                                                <select class="form-select" v-model="data.step"  @change="stepChange(data.step, data.id);"> 
                                                    <option value="0">Select</option>
                                                    <option   v-for="(item, index) in GetSystemDD[31]" :value="index" :key="index">
                                                        {{ item }}
                                                    </option>
                                                </select>
                                            </td>
                                            <!-- <td class="bc_click_btn">-</td> -->
                                            <!-- <td class="bc_click_btn"><div class="vq_active_btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Active"> Active </div> </td> -->
                                           
                                            <td class="bc_click_btn">{{ data.adminname }}</td>
                                        </tr>
                                         <tr v-else>
                                             <td colspan="20">No found records</td>
                                         </tr>

                                    </tbody>
                                </table>
                                 <div class="load-btn text-center mt-2 mb-3" v-if="quoteData.loading">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
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


    <!--View Quote Section Start Here-->
<div class="bcic_vquote_offcanvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasViewqright" aria-labelledby="offcanvasViewqrightLabel">
   <QuoteNotes 
    :SidequoteData="QuotesidePanelInfo"
    :sitedata="SitesLocation"
    :admindata="admindata"
    ></QuoteNotes>
</div>

    <!--View Quote Section Start Here-->
</template> 

<script>

import {defineComponent , ref ,reactive, onMounted } from 'vue'; // Import necessary functions;
import QuoteNotes from './../notes/QuoteNotes.vue';
import  OperationHeader  from '@/header/Operation.vue';
//import Header from './../Header.vue';
import Swal from 'sweetalert2'
import { useCommonFunction } from './../../func/function.js';
//import { useRoute } from 'vue-router';

// console.log(Header);

export default defineComponent({ 
       
        components: {
            QuoteNotes,
            OperationHeader
        },
      setup(props) { 

            const { openNewWindow } = useCommonFunction();

            const loading = ref(false);
            const error = ref(null);


            const SitesLocation = ref([]);  
            const quoteFors = ref([]);
            const jobtype = ref([]);
            //const Othersjobtype = ref([]);
            const GetSystemDD = ref({});

            const quoteData = ref({
                data: [],
                totalPages: 0,
                currentPage: 0,
                lastPage: 0,
                pageNum: 1,
                total_count: 0,
                loading :false,
            });

            const searchCriteria = reactive({
                quote_for: 0,
                job_type: 0,
                site_id: 0,
                job_status: 0,
                quote_ref: 0,
                quote_type: 0,
                from_date: '',
                to_date: '',
                quote_status : 0,
                login_id: 0,
                search_value:'',
                search_type : 1,
                task_action :0
            }); 
             
           
            const searchViewQuote = async() => {
                  quoteData.value.data = [];
                  quoteData.value.totalPages = 0;
                  quoteData.value.currentPage = 0;
                  quoteData.value.lastPage = 0;
                  quoteData.value.pageNum = 1;
                  quoteData.value.total_count = 0;
                  getViewQuoteData();
            }

            const resetFor = async ()=> {
                    searchCriteria.search_value = '';
                    quoteData.value.pageNum = 1;
                     searchCriteria.quote_for = 0;
                     searchCriteria.job_type = 0; 
                     searchCriteria.site_id = 0;
                     searchCriteria.job_status = 0;
                     searchCriteria.quote_ref = '';
                     searchCriteria.quote_type = 0;
                     searchCriteria.from_date = ''
                     searchCriteria.to_date = '';
                     searchCriteria.quote_status = 0;
                     searchCriteria.login_id = 0;
                     getViewQuoteData();
            }

       
             
            const getViewQuoteData = async () => {
                if (quoteData.value.loading || (quoteData.value.pageNum > quoteData.value.totalPages && quoteData.value.totalPages !== 0)) return;
                quoteData.value.loading = true;

                   let paramsData = {};
               
                   
                     paramsData = {
                        search_value: searchCriteria.search_value,
                        page: quoteData.value.pageNum,
                        quote_for: searchCriteria.quote_for,
                        job_type: searchCriteria.job_type,
                        site_id: searchCriteria.site_id,
                        job_status: searchCriteria.job_status,
                        quote_ref: searchCriteria.quote_ref,
                        quote_type: searchCriteria.quote_type,
                        from_date: searchCriteria.from_date,
                        to_date: searchCriteria.to_date, 
                        quote_status: searchCriteria.quote_status,
                        login_id: searchCriteria.login_id,
                       // task_action: searchCriteria.task_action,
                    };

                try {
                   
                    const response = await axios.get('/get-view-quote', { params: paramsData });

                    if (response.data && response.data.quoteDetails && Array.isArray(response.data.quoteDetails)) {
                           
                        quoteData.value.data.push(...response.data.quoteDetails);
                        quoteData.value.totalPages = response.data.lastPage;
                        quoteData.value.currentPage = response.data.currentPage;
                        quoteData.value.total_count = response.data.total_count;
                        quoteData.value.pageNum += 1;
                       // console.log(quoteData.value.data); // Verify the data structure

                    } else {
                        console.error('Unexpected response structure', response.data);
                    }
                } catch (err) {
                    console.error('Failed to fetch records', err);
                } finally {
                    quoteData.value.loading = false;
                }
            };


            const handleScroll = () => {
                    const bottomOfWindow = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight;
                    if (bottomOfWindow) {
                        searchCriteria.search_type = 2;
                        getViewQuoteData();
                    }
            };

                
                const getqute = (quotefor) => {
                    try {
                        if (quoteFors.value[quotefor] && quoteFors.value[quotefor].name != null) {
                            return quoteFors.value[quotefor].name;
                        } else {
                            return null;
                        }
                    } catch (error) {
                        console.error('Error accessing quoteFors in getlocation:', error);
                        return null; // Return null in case of an error
                    }
                }

                const getlocation = (siteid) => {
                        try {
                            if (SitesLocation.value[siteid] && SitesLocation.value[siteid].name != null) {
                            return SitesLocation.value[siteid].name;
                            } else {
                            return null;
                            }
                        } catch (error) {
                            console.error('Error accessing SitesLocation in getlocation:', error);
                            return null; // Return null in case of an error
                        }
                    };
            
                  
                
                const getQuoteFor = async () => {
                    try {
                        const response = await axios.get('/api/quote-for');
                        quoteFors.value = response.data; 

                    } catch (err) {
                       //error.value = 'Failed to fetch records';
                    } finally {
                      loading.value = false;
                    }
                };

                const getSites = async () => {
                        try {
                        const response = await axios.get('/api/get-sites');
                        SitesLocation.value = response.data;

                        //console.log(response.data);

                        } catch (err) {
                        //error.value = 'Failed to fetch records';
                        } finally {
                          loading.value = false;
                        }
                 };
	  
	  
            const getjobType = async (data_type) => {
                try {
                    const response = await axios.get('/api/job-type', {
                        params: {
                        data_type:data_type
                        },
                    });
                
                    if(data_type === 1) {
                        jobtype.value = response.data;
                    }else if(data_type === 2) {
                       // Othersjobtype.value = response.data;
                    }
                    

                    } catch (err) {
                    error.value = 'Failed to fetch records';
                    } finally {
                    loading.value = false;
                    }
            };  

            
 
             const getddValue = async() => {
                 
                try {
                    const response = await axios.post('/get-dd-value', {
                       ddids: [31,32,26,28,63,90],
                      _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });

                    GetSystemDD.value =response.data;
                  } catch (error) {
                        console.error('Error saving quote:', error);
                }
                  //getddValue
             }

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

               
                const QuotesidePanelInfo = ref({});
                
                const QuotesidePanel = async (quoteid) => {
                    try {
                     
                        QuotesidePanelInfo.value = {};

                        // Retrieve CSRF token
                        const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content || '';

                        // Make an Axios GET request to fetch quote details
                        const { data } = await axios.get('./sidequotedetails', {
                            params: { quote_id: quoteid },
                            headers: { 'X-CSRF-TOKEN': csrfToken } 
                        });
                        
                         QuotesidePanelInfo.value = data;
                         
                        // Initialize and show the Bootstrap offcanvas
                        // const offcanvasElement = document.getElementById('offcanvasViewqright');
                        // if (offcanvasElement) {
                        //     const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                        //     offcanvas.show();
                        // } else {
                        //    console.warn('Element with ID offcanvasViewqright not found.');
                        // }


                    } catch (error) {
                        // Handle errors gracefully
                        console.error('Error fetching quote details:', error);
                    }
                }

                const stepChange = async(status , quoteid) => {

                    try {
					    const response = await axios.post('/quote-status-update' ,
                        {
                            status :  status,
                            quote_id: quoteid,
                            _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                        });
                        

                            Swal.fire({
                                title: "Quote Status",
                                text: response.data.message,
                                icon: "success",
                                timer: 1500
                                });

                    } catch (error) {
                        console.error('Error In getAdminData:', error);
                    }

                }

                    const getDynamicClass = (data) => {
                        return ''
                    }   
               
                        
                onMounted(() => {
                    getddValue();
                    getQuoteFor();
                    getSites();
                    getAdminData();
                    getjobType(1);
                    // setTimeout(() => {
                    //     getAdminData();
                    //     getjobType(1);
                    // }, 1000);
                    getViewQuoteData();
                    window.addEventListener('scroll', handleScroll);

                   // console.log(custMesg.value);
                });
                return {
                    GetSystemDD,
                    quoteFors,
                    admindata,
                    jobtype,
                    SitesLocation,
                    quoteData,
                    loading,
                    searchCriteria,
                    QuotesidePanelInfo,
                    getViewQuoteData,
                    searchViewQuote,
                    resetFor,
                    QuotesidePanel,
                    getqute,
                    getlocation,
                    handleScroll,
                    getDynamicClass,
                    stepChange,
                    openNewWindow,
                };
         }
    });

</script>
<style>
.loading {
  text-align: center;
  padding: 20px;
}
.bcic_quote_offcanvas.offcanvas.offcanvas-end {
    z-index: 9999;
}
</style>


