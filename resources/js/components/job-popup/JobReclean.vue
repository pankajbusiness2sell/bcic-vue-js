<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-header">
                                        <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                            <i class="ti ti-users"></i>
                                        </div>
                                        <h5 class="card-title"> Re-Clean Jobs</h5>

                             <!-- <pre>{{  alldatainforamtion }}</pre>   -->
                        
                                </div>

                                <div class="card-body pb-0"> 
                                        <div class="row">
                                        <div class="col  mb-3">
                                            <label class="form-label">Job Type</label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Cleaning</option>
                                                <option value="2">Carpet</option>
                                                <option value="3">Pest</option>
                                                <option value="4">Gardening</option>
                                                <option value="5">Upholstery</option>
                                                <option value="6">Bbq</option>
                                                <option value="7">Oven</option>
                                                <option value="8">Spring Cleaning</option>
                                                <option value="9">Others</option>
                                                <option value="10">Reclean</option>
                                                <option value="12">Handymen</option>
                                                <option value="13">Extras</option>
                                                <option value="14">Postponement Fee</option>
                                                <option value="15">Commercial Clean</option>
                                                <option value="16">Grout Cleaning</option>
                                                <option value="17">Plumbers</option>
                                                <option value="18">Electrician</option>
                                                <option value="19">Locksmith</option>
                                                <option value="20">Commission</option>
                                                <option value="21">Removal Packaging</option>
                                                <option value="22">Local Moves</option>
                                                <option value="23">Interstate Move</option>
                                                <option value="25">Domestic Cleaning</option>
                                            </select>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label">Staff </label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="189">Tawar Andiry</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="309">Yasser Saad El Hadek</option>
                                                <option value="505">Mohammed</option>
                                                <option value="544">Hatham  Mcmahon</option>
                                                <option value="662">Pankaj B2s  Test</option>
                                                <option value="1173">Dimitry</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1280">Hari Bahadur Ranabhat</option>
                                                <option value="1540">Jessica Gabriel</option>
                                                <option value="1571">Vantran </option>
                                                <option value="1678">Tresor Jean Luc Bukasa</option>
                                                <option value="1679">Bibek Khadka </option>
                                                <option value="1714">Narayan Panday</option>
                                                <option value="1865">Shaun Paul Morgan</option>
                                                <option value="1879">Khandaatsog Ganbat</option>
                                                <option value="1928">Projjwal Vaidya </option>
                                                <option value="1977">Jaime Alberto Marin </option>
                                                <option value="1991">Ronald Narayan</option>
                                                <option value="2113">Linda Nwachukwu</option>
                                                <option value="2246">Anmol Neupane </option>
                                                <option value="2250">Santosh Bhushal </option>
                                                <option value="2261">Shyam Shah</option>
                                                <option value="2295"> Roshni Sharad</option>
                                                <option value="2324">Yubaraj</option>
                                                <option value="2352">Shailaja Acharya Adhikari </option>
                                                <option value="2376">Rachael Streater </option>
                                                <option value="2384">Md Kamrul </option>
                                                <option value="2394"> Muhammad Umar </option>
                                                <option value="2410">Kazam Khan Mohammed </option>
                                                <option value="2428">Prithaviraj</option>
                                                <option value="2433">Steven Candra</option>
                                                <option value="2443">Amit Sandhu </option>
                                                <option value="2471">Ibiso Tekena Dokubo</option>
                                                <option value="2485">Nawasdeen Raufdeen Raufdeen</option>
                                                <option value="2488">Sabina Maharjan</option>
                                                <option value="2491">Yuri Vanessa Cuellar Graffe </option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">	Reclean Date</label>
                                            <input type="date" class="form-control" >
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">Time</label>
                                            <input type="time" class="form-control" >
                                        </div>










                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary bcic_btns me-2">Add Reclean Job Type</button>

                                        </div>
                                        </div>
                                </div>

                                <div class="card-header ">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-briefcase-2"></i>
                                    </div>
                                    <h5 class="card-title"> Job Types</h5>
                                </div>

                                <table class="table table-bordered table-hover mt-2 fs-14 job-type-table" >
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Delete</th>
                                            <th>Job Type</th>
                                            <th>Staff</th>
                                            <th>Reclean Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Re-Clean Status</th>
                                            <th>ReClean SMS Send</th>
                                            <th>ReClean Notification</th>
                                            <th>DateTime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="job in jobDetails" :key="job.id" :id="'jdetails_' + job.id">
                                        <td>
                                            <a href="javascript:void(0)" @click="deleteRecleanJob(job.id, job.job_id)">Delete</a>
                                        </td>
                                        <td>{{ job.job_type }}</td>
                                        <td>{{ job.staff.name }}</td>
                                        <td>
                                            <input size="10" type="date" class="form-control"  v-model="job.reclean_date" @change="editField(job.id, 'reclean_date', job.reclean_date)" />
                                        </td>
                                        <td>
                                            <input size="10" class="form-control"  v-model="job.reclean_time" @blur="editField(job.id, 'reclean_time', job.reclean_time)" />
                                        </td>
                                        <td>
                                            <select class="form-control"   v-model="job.reclean_status" 
                                            @change="editField(job.id, 'reclean_status', job.reclean_status)">
                                            <!-- <option v-for="status in statuses" :value="status.id">{{ status.name }}</option> -->
                                            <option   v-for="(item, index) in GetSystemDD[37]" :value="index" :key="index" >{{ item }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control"  v-model="job.reclean_work" @change="editField(job.id, 'reclean_work', job.reclean_work)">
                                            <!-- <option v-for="work in recleanWorks" :value="work.id">{{ work.name }}</option> -->
                                            <option   v-for="(item, index) in GetSystemDD[86]" :value="index" :key="index" >{{ item }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a v-if="job.staff_id !== 0" href="javascript:void(0)" @click="sendSMS(job.id)">Job SMS</a>
                                        </td>
                                        <td>
                                            <a v-if="job.staff_id !== 0" href="javascript:void(0)" @click="sendNotification(job.id)">Add Notification</a>
                                            <br />
                                            <span>{{ job.add_notification_date || 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span>{{ job.job_sms_date }}</span>
                                        </td>
                                        </tr>
                                        <tr v-if="!jobDetails.length">
                                          <td colspan="10">No record</td>
                                        </tr>
                                    </tbody>
                                </table>
                                

                            </div>

                            <div class="col-md-4">
                                    <div class="otd_job_details_rightpanel">
                                            <nav class="p-3 pb-0">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="nav-allnotes-tab" @click="getRecleanNotes(1)" data-bs-toggle="tab" data-bs-target="#nav-allnotes" type="button" role="tab" aria-controls="nav-allnotes" aria-selected="true">Re-Clean Notes</button>
                                                    <button class="nav-link" id="nav-staffnotes-tab" @click="getRecleanNotes(2)" data-bs-toggle="tab" data-bs-target="#nav-staffnotes" type="button" role="tab" aria-controls="nav-staffnotes" aria-selected="false">For Staff</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-allnotes" role="tabpanel" aria-labelledby="nav-allnotes-tab" tabindex="0">

                                                    <div class="text-end p-3 pt-0">
                                                        <textarea class="form-control"  rows="3" placeholder="Reclean  Notes"
                                                            v-model="CommentType.recleannotes"
                                                            @keypress="handleKeyPressNotes($event , 1)"
                                                        ></textarea>
                                                    </div>
                         
                                                    <JobNotesList :comments="recleanNotes.all_notes"></JobNotesList>

                                                    <!--All Notes-->
                                                   
                                                </div>

                                                <div class="tab-pane fade" id="nav-staffnotes" role="tabpanel" aria-labelledby="nav-staffnotes-tab" tabindex="0">
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea class="form-control"  rows="3" placeholder="Re-Clean Note For Staff"
                                                            v-model="CommentType.staffnotes"
                                                            @keypress="handleKeyPressNotes($event , 2)"
                                                        ></textarea>
                                                    </div>

                                                    <JobNotesList :comments="recleanNotes.staff_notes"></JobNotesList>


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
import { defineComponent, toRefs , ref, reactive , watch , onMounted } from 'vue';
import { useCommonFunction } from './../../func/function.js';
import JobNotesList from './../notes/JobNotesList.vue';
//import Swal from 'sweetalert2'

export default defineComponent({
  name: 'Job Reclean',
  components:{
    JobNotesList,
  },
  props: {
    jobId: {
      type: [String, Number],
      required: true
    },
    alldata: {
      type: [Object, Array],
      required: true
    }
  },
  setup(props) {
    const noresultfoundImg = ref('/assets/img/noresultfound.jpg');

    const { sendData , getddvaluedata } = useCommonFunction(); 
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};
      }
    };

     const recleanNotes = ref({
        all_notes : {},
        staff_notes: {}
     });
    const getRecleanNotes = async(type) => 
    {
        const job_id = jobId.value;
        const formData = { job_id  , type } 
        const response = await sendData('get', '/get-reclean-notes', formData);

        if(type == 1) {
            recleanNotes.value.all_notes = response.all_notes;
        }else  if(type == 2) {
           recleanNotes.value.staff_notes = response.all_notes;
        }
       
    }

        const CommentType = ref({
            recleannotes: '',
            staffnotes: ''
        });

        const addRecleanComment = async (Notestype) => {

            const quote_id = alldatainforamtion.all.quote_id;
            const job_id = jobId.value;
            let commenttext = '';

            // Check the note type and assign the appropriate comment
            if (Notestype == 1) {
                commenttext = CommentType.value.recleannotes;
            } else if (Notestype == 2) {
                commenttext = CommentType.value.staffnotes;
            }

            const formData = { job_id, commenttext, quote_id, Notestype };

            // Make the API request
            const response = await sendData('post', '/add-reclean-notes', formData);

            // Update the appropriate notes based on the type
            if (Notestype == 1) {
                recleanNotes.value.all_notes = response.all_notes;
            } else if (Notestype == 2) {
                recleanNotes.value.staff_notes = response.all_notes;
            }

            // Reset only the relevant note input
            if (Notestype == 1) {
                CommentType.value.recleannotes = '';
            } else if (Notestype == 2) {
                CommentType.value.staffnotes = '';
            }
        };

        const handleKeyPressNotes = async (event, type) => {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                await addRecleanComment(type);
            }
        };

        const jobDetails = ref({});
        const getrecleanjoblist = async () => {
            
            const job_id = jobId.value;
            const formData = { job_id };
            const response = await sendData('get', '/get-reclean-details', formData);
            console.log(response);
            jobDetails.value = response.jobDetails;

        }
        
        const GetSystemDD = ref({});

        const getddValue = async () => {
            const ids = [37,86];
            GetSystemDD.value =  await getddvaluedata(ids);
            console.log(GetSystemDD.value);
        };


     // Watcher for alldata to update the reactive object when alldata changes
    watch(alldata, (newVal) => {
      if (newVal) {
           getallData();

        console.log('Updated alldata and fetched relevant data');
      }
    });

    onMounted(async () => {
      await getRecleanNotes(1);
      await getrecleanjoblist();
      await getddValue();
      getallData(); // Ensure all data is set before calling getStaffType
    });

    // You can use jobId.value in your methods or template
    console.log('Job ID in job Reclean component:', jobId.value);

    return {
        alldata,
        alldatainforamtion,
        getallData,
        getRecleanNotes,
        noresultfoundImg,
        recleanNotes,
        CommentType,
        handleKeyPressNotes,
        jobDetails,

        GetSystemDD,
        getddValue
    };
  }
});
</script>

