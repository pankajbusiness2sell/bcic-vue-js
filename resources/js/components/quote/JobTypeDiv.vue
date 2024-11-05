 <template>


    <div class="card-header">
        <h5 class="card-title">{{ jobInfo.name }}</h5>
      </div>

       <div class="bcic_cleaning_quote" v-if="jobInfo.id === 1" >
        <div class="card-body pb-0">

            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Bed</label>
                <input type="text" class="form-control"  id="bed" v-model="QuoteTypeForm.bed" placeholder="0">
              </div>
             
              <div class="col mb-3">
                <label class="form-label">Bath</label>
                <input type="text" class="form-control" id="bath" v-model="QuoteTypeForm.bath"  placeholder="0">
              </div>

              <div class="col mb-3">
                <label class="form-label"> Study</label>
                <input type="text" class="form-control"  id="study" v-model="QuoteTypeForm.study"  placeholder="0">
              </div>

              <div class="col mb-3">
                <label class="form-label"> Toilet </label>
                <input type="text" class="form-control" id="toilet" v-model="QuoteTypeForm.toilet"  placeholder="0">
              </div>

              <div class="col mb-3">
                <label class="form-label"> Leving Area</label>
                <input type="text" class="form-control" id="living" v-model="QuoteTypeForm.living"  placeholder="0">
              </div>
            </div>

          

            <div class="row">
              <div class="col mb-3"> 
                <label class="form-label">Furnished</label>
                <select class="form-select" id="furnished" v-model="QuoteTypeForm.furnished" >
                  <option value="0">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div class="col mb-3">
                <label class="form-label">House Type</label>
                <select class="form-select" id="property_type" v-model="QuoteTypeForm.property_type"> 
                  <option value="0">Select</option>
                  <option value="Unit" selected="">Unit</option>
                  <option value="House">House</option>
                  <option value="Two Storey">Two Storey</option>
                  <option value="Multi Storey">Multi Storey</option>
                </select>
              </div>
             
              <div class="col mb-3">
                <label class="form-label"> Blinds</label>
                <select class="form-select" id="blinds" v-model="QuoteTypeForm.blinds"> 
                   <option value="0">Select</option>
                   <option value="No Blinds">No Blinds</option>
                   <option value="Vertical">Vertical</option>
                   <option value="Venetians">Venetians</option>
                   <option value="Rollers">Rollers</option>
                   <option value="Shutters">Shutters</option>
                </select>
              </div>

              <div class="col mb-3">
                <label class="form-label"> Wall Wash </label>
                <select class="form-select" id="cleaning_wall_wash" v-model="QuoteTypeForm.cleaning_wall_wash"> 
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
               </select>
              </div>
            </div>

            <div class="col mb-3" >
                <button type="submit" class="btn btn-primary" @click="JobForSubmit(jobInfo.id)" >Add {{jobInfo.id}}</button>
            </div>

        </div> 
        

       </div>
      
        <div class="bcic_cleaning_quote" v-else-if="jobInfo.id === 2"  >
       
        <div class="card-body pb-0">

            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Bedroom</label>
                <input type="text" class="form-control" id="bed" v-model="carpetQuote.bed" placeholder="0">
              </div>

              <div class="col mb-3">
                <label class="form-label"> Living Area & Dinning</label>
                <input type="text" class="form-control"  id="living" v-model="carpetQuote.living" placeholder="0">
              </div>

              <div class="col mb-3">
                <label class="form-label"> Stairs </label>
                <input type="text" class="form-control" id="carpet_stairs" v-model="carpetQuote.carpet_stairs" placeholder="0">
              </div>

              

              <div class="col mb-3">
                <label class="form-label"> Stains </label>
                <select class="form-select" id="stains" v-model="carpetQuote.stains" >
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>

              <div class="col mb-3">
                <label class="form-label">Floor</label>
                <select class="form-select" id="quote_floor" v-model="carpetQuote.quote_floor">
                 <option value="0">Select</option>
                 <option value="1">Ground Floor</option>
                 <option value="2">1st Floor</option>
                 <option value="3">2nd Floor</option>
                 <option value="4">Above</option>
                </select>
              </div>
             

              <div class="col mb-3">
                <label class="form-label">Stain removal service?</label>
                <select class="form-select" id="carpet_stain_removal" v-model="carpetQuote.carpet_stain_removal">
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>

            </div>

            <div class="col mb-3" >
                <button type="submit" class="btn btn-primary" @click="JobForSubmit(jobInfo.id)" >Add {{jobInfo.id}}</button>
            </div>
           
        </div>



            </div>

        <div class="bcic_removals_quote " v-else-if="jobInfo.id === 3"  >
            <ul class="bci_creat_first_quote" style="margin:25px 0 0">                	
                <li>
                    <label>Inside</label>					
                    <input type="checkbox"  name="pest_inside" id="pest_inside"  v-model="PestForm.pest_inside" value="1">
                </li>
                <li>
                    <label>Outside</label>
                    <input type="checkbox" name="pest_outside" id="pest_outside" v-model="PestForm.pest_outside" value="1">
                </li>
                <li>
                    <label>Flea and Tick</label>
                <input type="checkbox" name="pest_flee" id="pest_flee"  v-model="PestForm.pest_flee" value="1">
                </li>
            </ul>

              

            <div class="col mb-3" >
                <button type="submit" class="btn btn-primary" @click="JobForSubmit(jobInfo.id)" >Add {{jobInfo.id}}</button>
            </div>
        </div>
     
       <div class="bcic_removals_quote " v-else-if="jobInfo.id === 11"  >
           
            <div class="card-body">

                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Bed</label>
                    <input type="text" class="form-control" placeholder="0">
                  </div>

                  <div class="col mb-3">
                    <label class="form-label">Study</label>
                    <input type="text" class="form-control" placeholder="0">
                  </div>

                  <div class="col mb-3">
                    <label class="form-label"> Living Area</label>
                    <input type="text" class="form-control" placeholder="0">
                  </div>

                  <div class="col mb-3">
                    <label class="form-label"> Kitchen </label>
                    <input type="text" class="form-control" placeholder="0">
                  </div>

                  <div class="col mb-3">
                    <label class="form-label"> Dining</label>
                    <input type="text" class="form-control" placeholder="0">
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Moving From </label>
                    <textarea rows="3" cols="3" class="form-control" placeholder="Enter a Location"></textarea>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Moving To </label>
                    <textarea rows="3" cols="3" class="form-control" placeholder="Enter a Location"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-3 mb-3">
                    <label class="form-label">On Level From <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">Ground</option>
                      <option value="2">1st</option>
                      <option value="3">2nd</option>
                      <option value="4">Above Third</option>
                    </select>
                  </div>

                  <div class="col-3 mb-3">
                    <label class="form-label">Has Lift/Elevator From </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">Yes</option>
                      <option value="2">No</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">Home Type From <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">High Rise Unit</option>
                      <option value="2">House</option>
                      <option value="3">Apartment</option>
                      <option value="4">Storage</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">Door Distance From <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">20 Meters</option>
                      <option value="2">40 Meters</option>
                      <option value="3">60 Meters</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">On Level To<span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">Ground</option>
                      <option value="2">1st</option>
                      <option value="3">2nd</option>
                      <option value="4">Above Third</option>
                    </select>
                  </div>

                  <div class="col-3 mb-3">
                    <label class="form-label">Has Lift/Elevator To </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">Yes</option>
                      <option value="2">No</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">Home Type To <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">High Rise Unit</option>
                      <option value="2">House</option>
                      <option value="3">Apartment</option>
                      <option value="4">Storage</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">Door Distance To <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">20 Meters</option>
                      <option value="2">40 Meters</option>
                      <option value="3">60 Meters</option>
                    </select>
                  </div>

                  <div class="col-3 mb-3">
                    <label class="form-label">Day Time <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1" selected="">10am-1pm</option>
                      <option value="2">1pm-5pm</option>
                      <option value="3">5pm-8pm</option>
                    </select>
                  </div>


                  <div class="col-3 mb-3">
                    <label class="form-label">Stairs <span class="text-danger"> * </span> </label>
                    <select class="form-select">
                      <option value="0">Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="2">4</option>
                      <option value="3">5</option>
                    </select>
                  </div>


                  <div class="col-4 mb-3">
                    <label class="form-label">Add Inventory  </label>
                    <textarea rows="2" cols="2" class="form-control" placeholder="Enter a Location"></textarea>
                  </div>

                  <div class="col mb-3">
                    <button type="submit" class="btn btn-primary" >Add {{jobInfo.id , 5}}</button>
                 </div>

                </div>
            </div>

           
       </div>
      
        <div class="bcic_cleaning_quote" v-else-if="jobInfo.id > 0" >
            
            <div class="card-body">

                <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Description</label>
                    <input
                        type="text"
                        name="desc"
                        class="form-control"
                        id="description"
                        v-model="othersForm.description"
                        style="width:70%!important; text-align:left!important;"
                        />
                </div>
             
                <div class="col mb-3"> 
                    <label class="form-label"> Amount </label>
                    <input type="number" class="form-control" name="other_job_amount" id="other_job_amount"  v-model="othersForm.other_job_amount" placeholder="0">
                </div>
                </div> 

                <div class="col mb-3" >
                    <button type="submit" class="btn btn-primary" @click="JobForSubmit(jobInfo.id)" >Add</button>
                </div>

            </div>
       </div>
 </template>

 <script>
import { defineComponent, ref, watch } from 'vue'; // Import necessary Vue Composition API functions
import axios from 'axios'; // Import Axios for making HTTP requests

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.withCredentials = true;

export default defineComponent({
  props: {
    jobtypeid: {
      type: Number,
      required: true
    },
      newjobid: {
        type: Number,
        required: true
      },
      quopteinfo: {
        type: Object,
        required: true
      }
  },
  emits: ['errors-updated', 'getside-data'] , // Declare custom event
  setup(props , { emit }) {
    const jobInfo = ref([]); // Reactive reference to store job information
    const errorParent = ref({
                      quote_form: '',
                      postCode: '',
                      sitesid: ''
                    });
      const getSideData = ref({
         quoteDetailsinfo:'',
         totalAmount:0
      });
   
    const QuoteTypeForm = ref({
            bed: '',
            bath: '',
            study: '', 
            toilet: '',
            living: '',
            furnished: 'No',
            property_type: 'Unit',
            blinds: 'No Blinds',
            cleaning_wall_wash: '2',
    }); // Reactive reference for form data
    const carpetQuote = ref({
            bed: '',
            living: '',
            carpet_stairs: '0',
            stains: '0',
            quote_floor: '0',
            carpet_stain_removal: '0',
    });

    const PestForm = ref({
            pest_inside: '',
            pest_outside: '',
            pest_flee: '',
    });

    const removalData = ref({
                   removal_bed: '' 
                  });

    const othersForm = ref({
            description: '',
            other_job_amount: 0,
    });

    

    // Method to fetch data based on jobtypeid or newjobid
    const getJobtypeDetails = async (id) => {
      try {
        const response = await axios.get(`./api/job-type-info/${id}`);
        jobInfo.value = response.data; // Update jobInfo with fetched data
        othersForm.value.description = jobInfo.value.job_text;
        othersForm.value.other_job_amount = jobInfo.value.job_amount;

         console.log(jobInfo.value);  
            //  console.log(othersForm.value.other_job_amount);   
            //  console.log(jobInfo.value.job_amount);   

      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    // Method to handle form submission or any other action
    const JobForSubmit = async (job_type_id) => {

        let formData = {};

        errorParent.value.quote_form = (props.quopteinfo.quote_form === '' || props.quopteinfo.quote_form === 0) ? 'Please select Quote for' : '';
        errorParent.value.postCode = props.quopteinfo.postCode === '' ? 'Please select postcode' : '';
        errorParent.value.sitesid = (props.quopteinfo.sitesid === '' || props.quopteinfo.sitesid === 0) ? 'Please select location' : '';
        const hasErrors = Object.values(errorParent.value).some(error => error !== '');
        if (hasErrors) {
             emit('errors-updated', errorParent.value);
        } else {

            if(job_type_id == 1) {
                formData = QuoteTypeForm.value;
            }else if(job_type_id == 2){
                formData = carpetQuote.value;
            }else if(job_type_id == 3){
                formData = PestForm.value;
            }else if(job_type_id == 11){
                formData = removalData.value;
            }else{
                formData = othersForm.value;
            }
            formData.job_type_id = job_type_id;
            
            formData.quote_form = props.quopteinfo.quote_form;
            formData.postCode = props.quopteinfo.postCode;
            formData.sitesid = props.quopteinfo.sitesid;
            formData.booking_date = props.quopteinfo.booking_date;

            getQuoteData(formData); 

            emit('errors-updated', null);
        }
    };

      const getQuoteData = async (formData) => {
        try {   
                // Make a POST request to your backend API endpoint
                formData._token = document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '';
                const response = await axios.post('./create-quote-object/', formData);
               // console.log(response.data); 
                getSideData.value.quoteDetailsinfo = response.data.tempdetails;
                getSideData.value.totalAmount = response.data.totalAmount;
                emit('getside-data', getSideData.value);
                jobInfo.value = '';

              
                formjobTypeFormReset(formData.job_type_id);
                
        } catch (error) {
            console.error('Error fetching data:', error);
        }
  
    }

    // Watch for changes in jobtypeid prop
    watch(() => props.jobtypeid, (newVal, oldVal) => {
        (newVal) ? getJobtypeDetails(newVal) : ''; // Fetch data whenever jobtypeid prop changes
    });

    // Watch for changes in newjobid prop
    watch(() => props.newjobid, (newVal, oldVal) => {
       (newVal) ?  getJobtypeDetails(newVal) : ''; // Fetch data whenever newjobid prop changes
    });
 
    
      const  formjobTypeFormReset = (job_type_id) => {
         
            if (job_type_id == 1) {
                QuoteTypeForm.value.bed = '';
                QuoteTypeForm.value.bath = '';
                QuoteTypeForm.value.study = ''; 
                QuoteTypeForm.value.toilet = '';
                QuoteTypeForm.value.living = '';
                QuoteTypeForm.value.furnished = 'No';
                QuoteTypeForm.value.property_type = 'Unit';
                QuoteTypeForm.value.blinds = 'No Blinds';
                QuoteTypeForm.value.cleaning_wall_wash = '2';

            }else if(job_type_id == 2) {
            
              carpetQuote.value.bed=  '';
              carpetQuote.value.living = '';
              carpetQuote.value.carpet_stairs = '0';
              carpetQuote.value.stains= '0';
              carpetQuote.value.quote_floor = '0';
              carpetQuote.value.carpet_stain_removal = '0';
            }else if(job_type_id == 3) {
               PestForm.value.pest_inside=  '';
               PestForm.value.pest_outside = '';
               PestForm.value.pest_flee = '';
            }else  {
               PestForm.value.description=  '';
               PestForm.value.other_job_amount = 0;
            }
      }


    // Return reactive references and methods to be used in template
    return {
      jobInfo,
      QuoteTypeForm,   
      carpetQuote, 
      PestForm,
      othersForm,  
      errorParent,
      formjobTypeFormReset,
      JobForSubmit, // Make JobForSubmit accessible in the template
    };
  }
});
</script>