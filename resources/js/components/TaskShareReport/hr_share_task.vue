<template>
    <OperationHeader /> 
    <div class="page-wrapper">
       <div class="content">
           <div class="row justify-content-center">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                               <div class="d-flex justify-content-between">
                                   <div class="pt-2">
                                       <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                           <i class="ti ti-user-dollar"></i>
                                       </div>
                                       <h5 class="card-title text-nowrap">HR Task Report</h5>
                                   </div>

                                    <div v-if="loading" class="loader-container">
                                        <div class="loader"></div>
                                    </div>

                                    <div class="row">
                                              <div class="col ">
                                                   <label for="role">Role</label>
                                                   <select class="form-select" v-model="roletype.role_type">
                                                       <option>Select</option>
                                                       <option value="0">All</option>
                                                       <option value="1">Hr</option>
                                                       <!-- <option value="2">Assigned</option>
                                                       <option value="3">Both</option> -->
                                                   </select>
                                               </div>
                                               <div class="col p-0">
                                                  <label for="role"></label>
                                                   <ul class="bcic_view_q_btns">
                                                       <li><button type="submit" class="btn btn-primary" @click="searchsalesTask(1)">Search</button></li>
                                                       <li><button type="submit" class="btn btn-danger" @click="searchsalesTask(2)">Reset</button></li>
                                                   </ul>
                                               </div>
                                   </div>
                               </div>

                       </div>

                       <div class="card-body">
                           <div class="table-responsive unassigned_jobs">
                               <table class="table table-bordered">
                                   
                                   <tbody>
                                       <tr>
                                           <!--Reclean Start Here-->
                                           <td class="reclean_tabs">
                                               <table class="table table-bordered">
                                                   <thead class="table-info">
                                                       <tr>
                                                           <th><span>Admin Name</span></th>
                                                           <th v-for="(trackname, index) in GetSystemDD[207]" :key="index">
                                                               <span>{{ trackname }}</span>
                                                               <!-- <p> 4 Hours </p> -->
                                                           </th>
                                                          
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                       <tr class="align-middle text-center" :key="adminid"  v-for="(adminname,adminid) in adminlist" >
                                                           <td>
                                                               <h2  @click="taskAssignPopup(adminname.id)" class="d-flex align-items-center">
                                                                   <a href="javascript:void(0);" class="avatar-name me-2" 
                                                                    data-bs-toggle="modal" data-bs-target="#recleanModalXl"
                                                                    
                                                                    >
                                                                       <span> {{  initialsName(adminname.name)  }} </span>

                                                                       <span v-if="adminname.login_status == 0" class="badge-offline"></span>
                                                                       <span v-if="adminname.login_status > 0" class="badge-online"></span>
                                                                   </a>
                                                                   <a href="javascript:void(0);" class="d-flex flex-column" data-bs-toggle="modal" data-bs-target="#recleanModalXl">
                                                                       <span class="fw-bold"> {{  adminname.name  }}</span>
                                                                       <span class="text-default text-start">{{ GetSystemDD[102]?.[adminname?.auto_role] || '' }}</span>
                                                                   </a>
                                                               </h2>
                                                           </td>
                                                           <td v-for="(trackname, index) in GetSystemDD[207]" :key="index"> 
                                                            <span class="reclean_hrs"> 
                                                                {{  getTrackData.getrecords[adminname.id]?.[index]?.length  }}
                                                                 <!-- {{ adminname.id }}  =   {{ index }}  -->
                                                            </span>
                                                           </td>
                                                        </tr>
                                                   </tbody>

                                               </table>
                                           </td>
                                           <!--Reclean End Here-->

                                          
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

   
    
   <!---Reclean modal design start here-->
   <div class="modal fade" id="recleanModalXl" tabindex="-1" aria-labelledby="recleanModalXlLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title fs-4" id="recleanModalXlLabel">
                <h5 class="d-flex align-items-center">
                    <a href="javascript:void(0);" class="avatar-name me-2" data-bs-toggle="modal" data-bs-target="#recleanModalXl">
                         <span> {{ initialsName(propsData.adminname) }} </span>
                    </a>
                    <a href="javascript:void(0);" class="d-flex flex-column" data-bs-toggle="modal" data-bs-target="#recleanModalXl">
                        <span class="fw-bold">{{ propsData.adminname }}  Track Task </span>
                        <!-- <span class="text-default"> 2024-07-1 To 2024-09-30</span> -->
                    </a>
                </h5>

            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



        </div>
        <div class="modal-body" >

              
             <!-- <pre> {{  propsData.allRecords  }} </pre> -->

                <div>
                    <button type="button" @click="searchType(0)" class="btn btn-primary p-2 ms-2 active">All</button>
                    <button type="button" @click="searchType(index)" v-for="(trackname, index) in GetSystemDD[207]" :key="index" class="btn btn-primary p-2 ms-2">{{ trackname }}</button>
                </div>
               <hr/>
            <div class="d-flex justify-content-between">
                    <div class="reclean_total ps-3">
                        <div class="d-inline-block me-2">
                            <select class="form-select" v-model="selectedCount" @change="selectCheckboxes">
                                <option value="0">Select</option>
                                <option value="5">5</option>
                                   <option value="10">10</option>
                                   <option value="15">15</option>
                                   <option value="20">20</option>
                            </select>
                        </div>
                        
                    </div>
                    
                     <h4>Total Records <span>  {{ propsData.allRecords?.length || 0 }} </span></h4>

                    <div>
                        

                      
                       
                        <div class="d-inline-block mb-3 me-3">
                            <button type="button" class="btn btn-primary" @click="quoteassign('All', 1)">Share to Everyone</button>
                          </div>
                      
                          <span>OR </span>
                      
                           

                          <div class="d-inline-block me-2">
                            <label for=""><strong>Assign to</strong></label>
                            <select class="form-select" v-model="assignto"  @change="(event) => quoteassign(event, 2)">
                              <option value="0">Select</option>
                              <option 
                                v-for="(adminname, adminKey) in propsData.adminids" 
                                :key="adminKey"
                                :value="adminname.id"
                                :style="{ backgroundColor: adminname.login_status === 1 ? '#62ad62' : '#dab2b2', color: 'white' }">
                                {{ adminname.name }} ({{ adminname.login_status === 1 ? 'Online' : 'Offline' }}) -- {{  GetSystemDD[102]?.[adminname.auto_role]  }} 

                              </option>
                            </select>
                          </div>



                    </div>

            </div>


            <!-- <pre> {{  propsData.allRecords  }}</pre> -->

            <div class="bcic_view_quote_table table-responsive p-3 pt-0">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary text-nowrap">
                      <tr>
                        <th>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              @change="toggleAllCheckboxes($event)"
                            />
                          </div>
                        </th>
                        <th>App ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Step</th>
                        <th>Task Owner</th>
                        <th>Q Admin Name</th>
                        <th>Job Type</th>
                        <th>Follow Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        class="align-middle"
                        v-if="propsData.allRecords?.length"
                        v-for="(taskdata, taskid) in propsData.allRecords"
                        :key="taskid"
                        :id="'div-' + taskid"
                      >
                        <td>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              :value="taskdata.id"
                              :id="'checkbox-' + taskid"
                              v-model="checkedItems"
                            />
                          </div>
                        </td>
                        <td>{{ taskdata.app_id }} </td>
                        <td>{{ taskdata.first_name }}</td>
                        <td>{{ taskdata.email }}</td>
                        <td>{{ taskdata.phone }}</td>
                        <td>
                          <span v-if="taskdata.step_status === 0" class="text-danger">--</span>
                          <span v-else>{{ GetSystemDD[55]?.[taskdata.step_status] }}</span>
                        </td>
                        <td>{{ taskdata.task_admin_name }}</td>
                        <td>
                            {{ getadminname(taskdata.login_id) }} </td>
                        <td>
                            <span v-if="!taskdata.imgstr || Object.keys(taskdata.imgstr).length === 0" class="text-warning">--</span>
                            <span v-else>
                              {{ Object.keys(taskdata.imgstr).map(key => key).join(', ') }}
                            </span>
                        </td>
                        <td>{{ taskdata.fallow_date_time }}</td>
                      </tr>
                      <tr v-else>
                        <td colspan="12">No Records found</td>
                      </tr>
                    </tbody>
                  </table>

            </div>
        </div>
        </div>
    </div>
   </div>
<!---Reclean modal design start here-->

</template>

<script>
    import { defineComponent, ref, onMounted } from 'vue'; // Import necessary functions
    import OperationHeader from '@/header/Operation.vue';
    import { useCommonFunction } from '@func/func/function.js';

    export default defineComponent({
        components: {
            OperationHeader,
        },
        setup() {
            const { sendData, getddvaluedata, initialsName ,createErrorCustomSwal , createCustomSwal , createConfirm } = useCommonFunction();

            const  customSwal = createCustomSwal();
            const  ErrorcustomSwal = createErrorCustomSwal();   

            const GetSystemDD = ref({});
            const adminlist = ref([]);
            const originalAdminList = ref([]); // Store the original admin list for reset purposes
            const roletype = ref({ role_type: 0 });
            const getTrackData = ref({ getrecords: {},totaldata:{} });
            const loading = ref(false);
            const selectedCount = ref(0);
            const checkedItems = ref([]);
            const assignto = ref(0);

            // Function to get dropdown values
            const getddValue = async () => {
                try {
                    const ids = [207, 102, 55];
                    GetSystemDD.value = await getddvaluedata(ids);

                     //console.log(GetSystemDD.value);

                } catch (error) {
                    console.error('Error fetching dropdown data:', error);
                }
            };

            // Function to get admin list data
            const getadminlist = async () => {

               //  console.log('saaaaaaaaaaaaaaa');

                try {
                    const formData = {};
                    const response = await sendData('get', '/admin-data', formData);
                    adminlist.value = response;
                    originalAdminList.value = response; // Store the original list
                   
                } catch (error) {
                    console.error('Error fetching admin data:', error);
                }
            };

            // Function to filter admins based on the selected role
            const searchsalesTask = (type) => {
                if (type === 2) {
                    // Reset the list
                    adminlist.value = [...originalAdminList.value]; // Restore original admin list
                    roletype.value.role_type = 0; // Reset role_type if needed
                    getsalesTask();
                    return;
                }

                if (parseInt(roletype.value.role_type) === 0) {
                    // Show all admins if "All" or no specific role selected
                    adminlist.value = [...originalAdminList.value];
                } else if (parseInt(roletype.value.role_type) === 1) {
                    // Show only admins with 'auto_role' equal to 1 (Sales role)
                    adminlist.value = originalAdminList.value.filter(admin => admin.auto_role === 16);
                }
            };

            // Function to fetch sales task data
            const getsalesTask = async () => {
                loading.value = true;
                try {
                    const formData = {adminid: 'all', taskType: 3};
                    const response = await sendData('get', '/get-track-data', formData);

                    console.log(response.taskRecords);
                    
                    getTrackData.value.getrecords = response.taskRecords;
                    getTrackData.value.totaldata = response.totaldata;                    ;
                    
                } catch (error) {
                    console.error('Error fetching sales task data:', error);
                } finally {
                    loading.value = false;
                }
            };

             const propsData = ref({
                adminname : '',
                tracktype : {},
                adminids: {},
                trackdata : {},
                allRecords : {},
                adminfor : 0
             })

            const taskAssignPopup = async (adminid ,  tasktype = 0) => {

                propsData.value =    
                                {
                                    adminname : '',
                                    tracktype : {},
                                    adminids: {},
                                    trackdata : {},
                                    allRecords : {},
                                    adminfor : 0
                                }
                checkedItems.value = [];
                selectedCount.value = 0;
                assignto.value = 0;
                // Find the admin object matching the provided adminid
                const selectedAdmin = originalAdminList.value.find(admin => admin.id === adminid);

                if (selectedAdmin && adminid > 0) {
                    // Assign the selected admin's name and other properties
                    propsData.value.adminname = selectedAdmin.name; // Assuming the admin object has a 'name' property
                    propsData.value.tracktype = GetSystemDD.value[207];
                    propsData.value.adminids = originalAdminList.value;
                    propsData.value.trackdata = getTrackData.value.getrecords[adminid];

                    if(tasktype == 0) {
                        if(getTrackData.value.getrecords[adminid] != 'NULL') {
                            propsData.value.allRecords = Object.values(getTrackData.value.getrecords[adminid]).flat();
                        }
                    }else{
                        if(getTrackData.value.getrecords[adminid] != 'NULL') {
                            propsData.value.allRecords = getTrackData.value.getrecords[adminid][tasktype];
                        }
                    }
                    

                    propsData.value.adminfor = adminid;


                    console.log(propsData.value.trackdata);
                } else {
                    console.error(`Admin with id ${adminid} not found.`);
                }
            };

                // const getadminname = (adminid) => {

                    
                //     if(adminid == 0) return;

                //      return originalAdminList.value.find(admin => admin.id === adminid)?.name;
                // }

            const getadminname = (adminid) => {
                if (adminid === 0 || !originalAdminList.value) return; // Early return if adminid is 0 or originalAdminList is undefined

                const admin = originalAdminList.value.find(admin => admin.id === adminid);

                if (admin) {
                    return admin.name;
                } else {
                    return '';
                }
            };

           

            // Function to handle the bulk selection of checkboxes based on the dropdown
            const selectCheckboxes = () => {
                checkedItems.value = [];
                const limit = Math.min(selectedCount.value, propsData.value.allRecords.length);
                for (let i = 0; i < limit; i++) {
                    checkedItems.value.push(propsData.value.allRecords[i].id);
                }
            };

            // Function to toggle all checkboxes
            const toggleAllCheckboxes = (event) => {
                if (event.target.checked) {
                    checkedItems.value = propsData.value.allRecords.map(record => record.id);
                } else {
                    checkedItems.value = [];
                }
            };

            const quoteassign = async (event, typeid) => {
                const movedid = checkedItems.value.length;
                const isAssignAll = typeid === 1;
                const adminid = isAssignAll ? 'all' : event.target.value;
                const showtext = isAssignAll ? 'All' : event.target.selectedOptions[0].text;

                const errorMessage = validateInputs(movedid, adminid);
                if (errorMessage) {
                    assignto.value = 0;
                    showErrorPopup(errorMessage);
                    return;
                }

                const confirmMessage = `Do you want to move sales tasks to ${showtext}?`;
                const { isConfirmed } = await createConfirm(confirmMessage, 'Yes, Move It');
                if (!isConfirmed) {
                    assignto.value = 0;
                    return
                };

                const formData = { chekcedid: checkedItems.value, taskType: typeid, adminid: adminid };
                const response = await sendData('post', '/hr-track-task-assign', formData);

                if (response.success === true) {
                    checkedItems.value = [];

                    // Update propsData.allRecords by filtering out moved tasks
                    propsData.value.allRecords = propsData.value.allRecords.filter(
                        record => !formData.chekcedid.includes(record.id)
                    );

                    // Remove matching records from getTrackData.getrecords[adminfor] if it's an array of records
                    const adminRecords = getTrackData.value.getrecords[propsData.value.adminfor];
                    
                    if (adminRecords && typeof adminRecords === 'object') {
                        formData.chekcedid.forEach(id => {
                            for (const key in adminRecords) {
                                if (Array.isArray(adminRecords[key])) {
                                    // Filter out the records with the matching `id` within each array
                                    adminRecords[key] = adminRecords[key].filter(record => record.id !== id);
                                }
                            }
                        });
                    } else {
                        console.warn("Expected getTrackData.getrecords[adminfor] to be an object with arrays, but got:", typeof adminRecords);
                    }

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
                            popup: 'custom-swal-popup custom-swal-error'
                        }
                    });
                }
            };


            // Helper function to validate inputs
            const validateInputs = (movedid, adminid) => {
                if (movedid === 0) return 'You must check at least one checkbox';
                if (adminid == 0) return 'Please select an admin name to assign to';
                return null;
            };

            // Helper function to show error popup
            const showErrorPopup = (message) => {
                ErrorcustomSwal.fire({
                    title: 'Error',
                    text: message,
                    icon: 'error',
                    iconColor: '#FF5722',
                    customClass: {
                        popup: 'custom-swal-popup custom-swal-error'
                    }
                });
            };

            const searchType = (type) => {
                //console.log(type);
                taskAssignPopup(propsData.value.adminfor , type);
                //propsData.value.adminfor = adminid;
            }

            onMounted(() => {
                getddValue();
                getadminlist();
                getsalesTask();
            });

            return {
                getddValue,
                GetSystemDD,
                getadminlist,
                adminlist,
                initialsName,
                searchsalesTask,
                roletype,
                getsalesTask,
                getTrackData,
                taskAssignPopup,
                propsData,
                getadminname,

                selectedCount,
                checkedItems,
                selectCheckboxes,
                toggleAllCheckboxes,
                quoteassign,
                loading,
                searchType,
                assignto,
            };
        },
    });
</script>
