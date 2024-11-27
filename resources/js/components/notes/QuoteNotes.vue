  <template>

        <!-- <pre>{{  sitedata  }}</pre>
        <pre>{{  admindata  }}</pre>
        <pre>{{  SidequoteData  }}</pre> -->
        
        <div class="offcanvas-header">
           <div class="vq_site_phoneno"><i class="ti ti-phone-call"></i> {{  getSiteNumber(SidequoteData.site_id)  }}</div>
           <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

         <div class="offcanvas-body">
           <div class="vq_offcanvas_id">
              <ul>
                <li><i class="ti ti-clipboard-text"></i> Q {{  SidequoteData.id }} </li>
                <li><i class="ti ti-user-circle"></i> {{  SidequoteData.name }} </li>
                <li><i class="ti ti-mail"></i> {{  SidequoteData.email }} </li>
                <li><i class="ti ti-phone-call"></i> {{  SidequoteData.phone }}</li>
              </ul>
           </div>
           <hr> 
           <div class="vq-sidebar_btns">
              <ul class="d-flex justify-content-between">
                <li><a href="javascript:void(0);" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewquotsModalLg" @click="showEmailQuote(SidequoteData.id, 0);" > <i class="ti ti-clipboard-text"></i> View Quote </a></li>
                <li><a href="javascript:void(0);"  @click="showEmailQuote(SidequoteData.id , 1)"> <i class="ti ti-mail"></i> Email Quote </a></li>
              </ul>
           </div>
           <div class="vq-sidebar_btns">
              <ul class="d-flex justify-content-between">
                 <li><a href="javascript:void(0);" class="vq_sms_q"><i class="ti ti-message"></i> SMS Quote </a></li>
                 <li><a href="javascript:void(0);" class="vq_book_edit"><i class="ti ti-pencil-minus"></i> Book &amp; Edit Quote </a></li>
              </ul>
           </div>
           <div class="vq-sidebar_btns">
              <ul class="d-flex justify-content-between">
                 <li><a href="javascript:void(0);" class="vq_send_sms" data-bs-toggle="modal"  data-bs-target="#sendcustomeSMS" ><i class="ti ti-message-2-share"></i>Send Custom SMS</a></li>
                 <!-- <li><a href="javascript:void(0);" class="vq_quote_a"><i class="ti ti-circle-dashed-check"></i> Quote Approved </a></li> -->
              </ul>
           </div>
           <div class="vq-sidebar_btns">
              <ul class="d-flex justify-content-between">
                <li><a  href="javascript:void(0);"  @click="showQuoteQue(SidequoteData.id)"  data-bs-toggle="modal" data-bs-target="#QuestionquoteModal">Quote Questions</a></li>
                 <!-- <li><a href="javascript:void(0);" @click="showQuoteQue(SidequoteData.id)"  aria-controls="offcanvasQuestionquote" class="vq_sms"><i class="ti ti-help-octagon"></i> Quote Question</a></li> -->
              </ul>
           </div>
           
           <div class="vq-sidebar_btns">
            <ul class=" d-flex justify-content-between">
                <li><a  href="javascript:void(0);" class="btn btn-primary mt-2 vq_admin_fault" data-bs-toggle="modal"  data-bs-target="#adminfaultModalSm">Add Admin Fault</a></li>
            </ul>
          </div>

          
           <div class="d-flex justify-content-between">
              <div class="mt-3 mb-3">
                 <label for="exampleFormControlInput1" class="form-label fw-bold">Quote Assign to</label>
                 <select name="quote_auto_custom" class="form-select" @change="edit_field($event,'quote_new.login_id',SidequoteData.id)" v-model="SidequoteData.login_id">
                    <option value="0">Select Admin</option>
                     <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                 </select>
              </div>
              <!-- <div class="mt-3 mb-3"><label for="exampleFormControlInput1" class="form-label fw-bold">Task For</label><span>{{  SidequoteData.login_id }}</span></div> -->
           </div>
            <div class="mb-3">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type A Note Here"
                    v-model="newComment"
                    @keypress="handleKeyPress"
                    ></textarea>
                </div>    
            <hr>
             
            <QuoteNotesList :comments="Quotenotesdetails"></QuoteNotesList>

        </div>


      <!--View Quote Start Here -->
        <div class="modal fade" id="viewquotsModalLg"  tabindex="-1" aria-labelledby="viewquotsModalLgLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title h4" id="viewquotsModalLgLabel">View Quote</h5>
                | <a @click="showEmailQuote(SidequoteData.id , 1)">Send Email</a>
                    <!-- <span style="float: right;padding-left: 49px;color: red;" v-if="sendViewQuoteSMS">Send Email sucessfully</span> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <ViewInvoice 
                    :invoicedetails="invoiceDetails"
                    ></ViewInvoice> 
             </div>
           </div>
       </div> 


        <div class="modal fade" id="QuestionquoteModal" tabindex="-1" aria-labelledby="QuestionquoteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4" id="QuestionquoteModal">
                    <h4 class="offcanvas-title" id="offcanvasRightLabel">Quote Questions For : {{  QuoteQuestionData.job_type_id  }}</h4>
                    <h6>Quote ID : #{{  QuoteQuestionData.quote_id }}</h6>
                    <QuoteNotification v-if="showNotification" message="Your Quote Question is submitted successfully." />
                
                
                    </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <QuoteQuestion 
                    :quote-questions="QuoteQuestionData.quoteQuestions" 
                    :question-ids="QuoteQuestionData.questionIds" 
                    @save-questions="handleSaveQuestions" 
                    />
                </div>
              </div>
            </div>
          </div>


          

    <div class="modal fade" id="sendcustomeSMS" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header m-0">
              <h5 class="modal-title" id="exampleModalSmLabel"> Send Custom SMS</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                  <div class="p-3">
                      <h4 class="text-center pb-2">Send Message To <span> {{ SidequoteData.name }} </span></h4>
                      <h5 class="text-center pb-2">Quote ID : <span> {{ SidequoteData.id }}</span></h5>
                      <div class="row">
                          <div class="col-md-12 mb-2">
                              <label class="form-label">Phone No</label>
                              <input type="text" class="form-control" v-model="SidequoteData.phone" placeholder="Enter Contact No">
                          </div>
      
                          <div class="col-md-12 mb-2">
                              <label class="form-label">Message</label>
                              <textarea rows="4" cols="4" class="form-control" v-model="custMesg.comment" placeholder="Please Enter Message"></textarea>
                          </div>
                          <div class="col-md-12 mb-2">
                              <button type="submit" class="btn btn-primary mt-3" @click="sendCustomeSMS">Send</button>
                          </div>
      
                      </div>
                  </div>
            </div>
          </div>
        </div>
    </div>  


    <div class="modal fade" id="adminfaultModalSm" tabindex="-1" aria-labelledby="adminfaultModalSmLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header m-0">
              <h5 class="modal-title" id="exampleModalSmLabel"> Add Admin Fault</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="p-3">
                      <h5 class="text-center pb-2">Quote ID : <span> {{  SidequoteData.id  }}</span></h5>
                       <div class="row">
                          <div class="col-md-12 mb-2">
                              <label class="form-label">Admin Name</label>
                                <select name="quote_auto_custom" class="form-select" v-model="faultParams.admin_id">
                                    <option value="0">Select Admin</option>
                                    <option  v-for="(name,adminid) in admindata" :key="adminid" :value="name.id">{{ name.name }}</option>
                                </select>
                          </div>
      
                          <div class="col-md-12 mb-2">
                              <label class="form-label">Message</label>
                              <textarea rows="4" cols="4" class="form-control" v-model="faultParams.comments" placeholder="Please Enter Message"></textarea>
                          </div>
                          <div class="col-md-12 mb-2">
                              <button type="submit" class="btn btn-primary mt-2" @click="addadminFault(SidequoteData.id);"  >Send</button>
                          </div>
      
                      </div>
                  </div>
      
      
            </div>
          </div>
        </div>
      </div>
   
  </template>
  

  <script>
import { defineComponent, ref,  isRef,isReactive , toRefs , onMounted, watch } from 'vue';

//import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import QuoteNotesList from './../notes/QuoteNoteslist.vue';
import ViewInvoice from  './../quote/ViewInvoice.vue';
import QuoteNotification  from './../notification/QuoteNotification.vue';
import QuoteQuestion from './../quote/QuoteQuestion.vue';
import axios from 'axios';
import Swal from 'sweetalert2'

export default defineComponent({
    components: {
        QuoteNotesList,
        ViewInvoice,
        QuoteNotification,
        QuoteQuestion,
    },
    props: {
        SidequoteData: {
            type: [Object, Array],
            required: false,
            default: () => ({}),
        },
        sitedata: {
            type: [Object, Array],
            required: false,
            default: () => ({}),
        },
        admindata:{
            type: [Object, Array],
            required: false,
            default: () => ({}),
        }
    },

    setup(props) {
        const Quotenotesdetails = ref([]);

        //const SidequoteData = ref(props.SidequoteData);

        // Ensure SidequoteData is an object
        // const sidequoteData = typeof props.SidequoteData === 'object' && props.SidequoteData !== null
        //     ? props.SidequoteData
        //     : {};
           
            const getSiteNumber = (siteid) => {
                if (props.sitedata && props.sitedata[siteid] && props.sitedata[siteid].phone) {
                    return props.sitedata[siteid].phone;
                } else {
                    // Optional: Provide a default or error message
                    return 'Phone number unavailable';
                }
           };

           const invoiceDetails = ref({
                details :[],
                jobDecData:[],
                checkQUotetype:[],
                invoiceDetailshtml:'',
                getemailNotes:'' 

            });

            const showEmailQuote = async (quoteid , type) => {
 
                    try {
                    const response = await axios.get('/view-quote-email', {
                    params: {
                        quote_id:quoteid,
                        type:type
                    }, 
                    });
                    if(type == 0) {
                        //sendViewQuoteSMS.value = false;
                        invoiceDetails.value = response.data;
                       // console.log(invoiceDetails.value.jobDecData);
                    }else{
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    } catch (error) {
                    console.error('Error unsetting session variables:', error);
                    }
            }

        const fetchComments = async (quoteid) => {
            try {
                //console.log("Fetching comments for quoteid:", quoteid);

                if (!quoteid) {
                    console.error("Invalid quoteid:", quoteid);
                    return;
                }
                const response = await axios.get(`/get-quote-notes?quote_id=${quoteid}`);
                Quotenotesdetails.value = response.data;
                //console.log("Fetched comments:", Quotenotesdetails.value);
            } catch (error) {
                console.error("Error fetching quote notes:", error);
            }
        };

            const newComment = ref('');
            const quoteid = ref(0);
            const addComment = async () => {
                if (!newComment.value.trim()) return; // Prevent submitting empty comments

                const commentData = {
                    quote_id: quoteid.value,
                    comment: newComment.value,
                    _token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                };

                try {
                    const response = await axios.post('./add-quote-notes', commentData);
                    Quotenotesdetails.value = response.data;
                    newComment.value = '';
                } catch (error) {
                    console.error("Error adding comment:", error);
                }
            };

            const handleKeyPress = (event) => {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    // alert('hih');
                    addComment();
                }
            }; 

            const  QuoteQuestionData = ref({
                    quoteDetails : {},
                    quoteQuestions : [],
                    questionIds : [],
                    job_type_id: 'Cleaning',
                    quote_id:0,
                })


            const faultParams = ref({
                admin_id : 0,
                comments:''
            });

            const addadminFault = async (quote_id) =>{
                    
                const commentData = {
                    quote_id: quote_id,
                    admin_id: faultParams.value.admin_id,
                    comment: faultParams.value.comments,
                    _token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                };

                try {
                     const response = await axios.post('./admin-fault-notes', commentData);
                      console.log(response.status);
                        
                        faultParams.value.admin_id = 0;
                        faultParams.value.comments = '';

                        Swal.fire({
                            title: "Fault Notes Added",
                            text: response.data.message,
                            icon: "success",
                            timer: 1500
                         });

                } catch (error) {
                    console.error("Error adding comment:", error);
                }

            };


            const showNotification = ref(false);
            const showQuoteQue = async (quote_id) => {

                // const offcanvasElement = document.getElementById('offcanvasViewqright');
                // if (offcanvasElement) { 
                //      const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                //      offcanvas.show();
                // } else {
                //      console.warn('Element with ID offcanvasViewqright not found.');
                // }

                    // const offcanvasElementQues = document.getElementById('offcanvasQuestionquote');
                    // if (offcanvasElementQues) { 
                    //      const offcanvas = new bootstrap.Offcanvas(offcanvasElementQues);
                    //      offcanvas.show();
                    // } else {
                    //      console.warn('Element with ID offcanvasQuestionquote not found.');
                    // }


                  try {
                    const response = await axios.get('/show-quote-question', {
                          params: {
                            quote_id: quote_id,
                          }
                      });
                      //QuoteQuestionData.value.quoteDetails = response.data.quote_details;
                      QuoteQuestionData.value.questionIds = response.data.question_ids;
                      QuoteQuestionData.value.quoteQuestions = response.data.quote_questions;
                      QuoteQuestionData.value.quote_id = quote_id;
                      showNotification.value = false;

                      console.log(QuoteQuestionData.value);

                      
                  } catch (error) { 
                    console.error("There was an error fetching the quote questions:", error);
                  }
            }

            const handleSaveQuestions = async (selectedQuestions) => 
            {
                try {
                    const response = await axios.post('/save-quote-question', {
                      quote_id: QuoteQuestionData.value.quote_id,
                      questionids : selectedQuestions,
                      quote_type:1,
                      _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });

                    showNotification.value = false;
                   if(response.data.status == 200) {
                       showNotification.value = true;
                   }
                } catch (error) {
                    console.error('Error saving quote:', error);
                    // Handle error response appropriately
              }
            };

                    const custMesg = ref({
                        comment:'',
                     });

                    const sendCustomeSMS = async() => {

                        const commentData = {
                                quote_id: quoteid.value,
                                messageText: custMesg.value.comment,
                                phone: props.SidequoteData.phone,
                                _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                            };
                            try {
                                const response = await axios.post('./send-custom-sms', commentData);
                               // messageComment.value = '';
                                console.log(response.data);
                            } catch (error) {
                                console.error("Error adding comment:", error);
                            }

                    }

                    const edit_field = async(event,field_name,quote_id) => {
           
                            try {
                                    const response = await axios.post('/edit-field' ,
                                {
                                    value :  event.target.value,
                                    quote_id: quote_id,
                                    field_name: field_name,
                                    _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                                });
                
                                        Swal.fire({
                                            title: "Quote Assign",
                                            text: response.data.message,
                                            icon: "success",
                                            timer: 1500
                                            });
                
                            } catch (error) {
                                console.error('Error In getAdminData:', error);
                            }
                        //}
                    }

      
        // Watch for changes in sidequoteData.id and fetch comments when it changes
        watch(
            () => props.SidequoteData, 
            (newData, oldData) => {
                
                if(newData.id > 0) {
               // console.log('QuoteIds ' + newData.id);
                fetchComments(newData.id);
                quoteid.value = newData.id;
                }
            }, 
             { deep: true } // Add this option if you need deep reactivity
        );

    
        // Optionally, fetch comments on component mount
        // onMounted(() => {
        //     fetchComments(sidequoteData.id);
        // });

        return {
            getSiteNumber,
            Quotenotesdetails,
            fetchComments,
            handleKeyPress,
            addComment,
            newComment,
            showEmailQuote,
            invoiceDetails,
            showQuoteQue,
            handleSaveQuestions,
            QuoteQuestionData,
            showNotification,
            sendCustomeSMS,
            custMesg,
            edit_field,
            addadminFault,
            faultParams,
        };
    },
});
</script>




  