<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <pre>
                            {{  quoteinfoData  }}
                        </pre> -->

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" :value="quoteinfoData.phone" placeholder="Enter Phone Number...">
                                </div>

                                <div class="col-md-8 p-0">
                                    <div class="bcic_payment_btns">
                                        <button type="submit" class="btn btn-primary bcic_btns mt-0">Send Terms & Conditions</button>
                                        <button type="submit" class="btn btn-danger bcic_btns mt-0 ms-2"> <i class="ti ti-ban"></i></button>
                                    </div>
                                </div>

                            </div>

                             <!--Payments section Start Here-->

                            <div class="card-header mt-2 ps-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card"></i>
                                </div>
                                <h5 class="card-title"> Payments </h5>
                            </div>
 
                            <div class="row"  v-if="jobDetailsinfo.length > 0">
                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Job Type  </label>
                                 
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Staff Name </label>

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Staff Amount </label>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Profit</label>
                                </div>
                            </div>
                            
                            <div class="row"  v-if="jobDetailsinfo.length > 0" v-for="jobs in jobDetailsinfo" :key="jobs.id">
                                <div class="col mb-3">
                                    <div class="d-flex align-items-center text-body text-hover-1000" href="#!">
                                        <h6 class="mb-0 ms-2 fw-semibold"> {{  jobs.job_type }} </h6>
                                    </div>

                                </div>

                                <div class="col mb-3">
                                    <div  v-if="jobs.staffname" class="d-flex align-items-center text-body text-hover-1000" href="#!">
                                        <div class="avatar avatar-m">
                                        <div class="avatar-name rounded-circle"><span>{{  getInitials(jobs.staffname) }} </span></div>
                                        </div>
                                        <h6 class="mb-0 ms-2 fw-semibold"> {{  jobs.staffname }} </h6>
                                    </div>

                                </div>

                                <div class="col mb-3">
                                    <input type="text" class="form-control" :value="jobs.amount_total" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <input type="text" class="form-control" :value="jobs.amount_staff" placeholder="0">
                                </div>

                                <div class="col mb-3">
                                   <input type="text" class="form-control" :value="jobs.amount_profit" placeholder="0">
                                </div>
                            </div>

                            <!--Payments section End Here-->


                            <!--Add Job Payments section Start Here-->
                            <div class="card-header mt-2 ps-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card"></i>
                                </div>
                                <h5 class="card-title"> Add Job Payments </h5>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Date</label>
                                    <input type="Date"  v-model="addPaymentForm.p_date" class="form-control">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="text" v-model="addPaymentForm.p_amount" class="form-control" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Payment Method</label>
                                    <select class="form-select" v-model="addPaymentForm.p_payment_method">
                                        <option value="0">Select</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Account">Account</option>
                                        <option value="Voucher">Voucher</option>
                                     </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Taken By</label>
                                    <select class="form-select" v-model="addPaymentForm.p_taken_by">
                                        <option value="0">Select</option>
                                        <option :value="cleaners.id" v-if="cleanerlistData.length > 0" v-for="cleaners in cleanerlistData" :key="cleaners.id">{{ cleaners.name }}</option>
                                        <option value="BCIC">BCIC</option>
                                        
                                        
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <button type="submit" @click="addPayment" class="btn btn-primary bcic_btns">Save</button>
                                </div>

                            </div>

                             <!--Add Job Payments section End Here-->

                             <!-- Payments Received section Start Here-->
                            <div class="card-header mt-2 ps-0">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card-pay"></i>
                                </div>
                                <h5 class="card-title"> Payments Received </h5>
                            </div>
                           <!-- <pre> {{ paymentList }}</pre> -->

                            <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead class="table-primary">
                                    <tr>
                                        <th> Date </th>
                                        <th> Amount </th>
                                        <th> Payment Method </th>
                                        <th> Taken By </th>
                                        <th> Transaction ID </th>
                                        <th> Status </th>
                                        <th> Pay Status </th>
                                        <th> Pymnt Type  </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(listdata, index) in paymentList" :key="index">
                                        <td>{{ listdata.date }} </td>
                                        <td><span class="vq_price"> AUD {{ listdata.amount }}  </span> </td>
                                        <td>

                                            <span class="vq_website"> {{ listdata.payment_method }}  </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-tag badge-success-light">{{ listdata.taken_by }}</span>

                                        </td>

                                        <td>
                                            {{ listdata.transaction_id }}
                                        </td>

                                        <td>
                                            {{ (listdata.payment_card_status == 1) ? 'Recived' : (listdata.payment_card_status == 2) ? 'Pending' : 'Reefund'  }}
                                        </td>

                                        <td>
                                            <span class="vq_admin"> {{ listdata.transaction_type }} </span>
                                        </td>
                                        <td>
                                            <span class="vq_admin">  {{ (listdata.payment_type == 1) ? 'BCIC' : 'BBC' }}</span>
                                        </td>
                                        <td>
                                            <button type="button"   class="btn btn-soft-danger"><i class="ti ti-trash"></i></button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                            <!-- Payments Received section End Here-->


                            <!-- Payments Refund section Start Here-->
                            <div class="card-header mt-2 ps-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card-refund"></i>
                                </div>
                                <h5 class="card-title"> Payments Refund </h5>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="text" class="form-control"   @keypress="isNumberKey"  v-model="refundadd.r_amount" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Transaction ID</label>
                                    <input type="text" class="form-control"  @keypress="isNumberKey"  v-model="refundadd.transaction_id" placeholder="Enter Transaction ID">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Fault Status</label>
                                    <select class="form-select" v-model="refundadd.ref_fault_status">
                                        <option value="0">Select</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Cleaner</option>
                                        <option value="3">Client</option>
                                     </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Cleaner Name	</label>
                                    <select class="form-select" v-model="refundadd.ref_cleaner_id">
                                        <option value="0">Select</option>
                                        <option :value="cleaners.id" v-if="cleanerlistData.length > 0" v-for="cleaners in cleanerlistData" :key="cleaners.id">{{ cleaners.name }}</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Comments</label>
                                    <textarea rows="2" cols="4" v-model="refundadd.ref_comment" class="form-control" placeholder="Enter Your comment"></textarea>
                                </div>

                                <div class="col mb-3">
                                    <button type="submit" @click="addRefundPayment" class="btn btn-primary bcic_btns">Add Refund</button>
                                </div>

                            </div>

                             <!-- Payments Received section Start Here-->
                             <div class="card-header mt-2 ps-0">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card-pay"></i>
                                </div>
                                <h5 class="card-title"> Refund Payment List </h5>
                            </div>
                           <!-- <pre> {{ refundlistdata }}</pre> -->

                            <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead class="table-primary">
                                    <tr>
                                        <th> Amount </th>
                                        <th> Transaction ID	 </th>
                                        <th> Comments </th>
                                        <th> Fault </th>
                                        <th> Cleaner Name	 </th>
                                        <th> Account Status </th>
                                        <th> Refund Payment Status </th>
                                        <th> Payment Status Date  </th>
                                        <th> Date </th>
                                        <th> Invoice </th>
                                        <th> Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(listdata, index) in refundlistdata" :key="index">
                                        
                                        <td><span class="vq_price"> AUD {{ listdata.amount }}  </span> </td>
                                        <td>

                                            <span class="vq_website"> {{ listdata.transaction_id }}  </span>
                                        </td>
                                        <td style="width: 40%;">
                                            {{ listdata.comment }}
                                        </td>

                                        <td>
                                            {{ listdata.fault_status }}
                                        </td>

                                        <td>
                                            {{ listdata.cleaner_name }}
                                        </td>

                                        <td>
                                            {{ listdata.refund_status }}
                                        </td>
                                        <td>
                                             {{ listdata.payment_job_status }}
                                        </td>
                                        <td>
                                            {{ listdata.payment_status_date }}
                                        </td>
                                        <td>
                                            {{ listdata.created_date }}
                                        </td>
                                       
                                        <td>
                                             {{ listdata.invoice_link }}
                                        </td>
                                        <td>
                                            <button v-if="listdata.delete_option"  type="button" class="btn btn-soft-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                            <span v-else>N/A</span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <!-- <pre>{{  refundlistdata }}</pre> -->
                             <!-- Payments Refund section Start Here-->


                            <!-- Credit Card Payment section Start Here-->

                            <div class="card-header mt-2 ps-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-credit-card"></i>
                                </div>
                                <h5 class="card-title"> Credit Card Payments </h5>
                            </div>

                            <div class="row align-item-center">
                                <div class="col-md-9">
                                    <div class="otd_card_details mb-3">
                                        <h5>Pay by Credit Card</h5>
                                        <p>Please fill the payment details below.</p>
                                    </div>

                                    <div class="row">
                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Invoice Amount</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>

                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Credit Card Type</label>
                                            <ul class="otd_payment_cards">
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            <img :src="mastercardImg" alt="Master Card"/>
                                                        </label>
                                                    </div>

                                                </li>

                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            <img :src="visacardImg" alt="Visa Card"/>
                                                        </label>
                                                    </div>

                                                </li>


                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            <img :src="amexcardImg" alt="Amex Card"/>
                                                        </label>
                                                    </div>

                                                </li>
                                            </ul>





                                        </div>


                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Name on Credit Card</label>
                                            <input type="text" class="form-control" placeholder="Enter Amount Here">
                                        </div>

                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Card Number</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>

                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Expiry Date</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-select">
                                                        <option value="0">Select</option>
                                                        <option value="01">01 (Jan)</option>
                                                        <option value="02">02 (Feb)</option>
                                                        <option value="03">03 (Mar)</option>
                                                        <option value="04">04 (Apr)</option>
                                                        <option value="05">05 (May)</option>
                                                        <option value="06">06 (Jun)</option>
                                                        <option value="07">07 (Jul)</option>
                                                        <option value="08">08 (Aug)</option>
                                                        <option value="09">09 (Sep)</option>
                                                        <option value="10">10 (Oct)</option>
                                                        <option value="11">11 (Nov)</option>
                                                        <option value="12">12 (Dec)</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <select class="col-md-6 form-select">
                                                        <option value="0">Select</option>
					                                    <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                        <option value="2031">2031</option>
                                                        <option value="2032">2032</option>
                                                        <option value="2033">2033</option>
                                                        <option value="2034">2034</option>
                                                    </select>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">CVN/CVV2</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>

                                        <div class="col col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Agree Check</label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Agreed To Charge This Credit Card A Day Before Of Job- (card To Be Charged On Auto Payment)</option>
                                                <option value="2">Bank Transfer 2 Days Prior</option>
                                                <option value="3">Other Card 1 Day Prior</option>
                                                <option value="4">Charge Same Card A Day Before But Later In The Afternoon</option>
                                                <option value="5">Agreed To Charge This Credit Card On Completion Of The Move For Remaining Hours (removal)</option>
                                            </select>
                                        </div>


                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary bcic_btns">Make Payment</button>
                                        </div>


                                    </div>



                                </div>

                                <div class="col-md-3">
                                    <div class="otd_pay_card text-center ">
                                        <img :src="paycardImg" alt="Cards"/>
                                    </div>
                                </div>



                            </div>




                            <!-- Credit Card Payment section End Here-->


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted ,computed } from 'vue';
import { useCommonFunction } from './../../func/function.js';
import Swal from 'sweetalert2'

export default defineComponent({
  name: 'JobType',
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
  
    const hasMounted = ref(false); // Flag to check if the component has mounted

	const mastercardImg = ref('/assets/img/master_card.png');
	const visacardImg = ref('/assets/img/visa_card.png');
	const amexcardImg = ref('/assets/img/amex_card.png');
	const paycardImg = ref('/assets/img/state-tax-image.png');
		
		
    const { sendData , isNumberKey } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

		const getddValue = async () => {
		 
		};

       

        const addPaymentForm = ref({
            p_date: new Date().toISOString().substr(0, 10),
            p_amount: '',
            p_payment_method: '0',
            p_taken_by: '0',
            voucher_text: ''
        })
        
        const paymentList = ref({});
        const addPayment = async () =>{

            if (isNaN(addPaymentForm.value.p_amount) || addPaymentForm.value.p_amount < 1 || !addPaymentForm.value.p_amount) {
                alert('Please enter a valid amount');
                addPaymentForm.value.p_amount = '';
                return;
            } else if (!addPaymentForm.value.p_payment_method || addPaymentForm.value.p_payment_method == 0) {
                alert('Please enter a payment method');
                return;
            } 

            const job_id = jobId.value;
            const quote_id = alldatainforamtion.quote_info.id;
            const  formData = { job_id, quote_id, ...addPaymentForm.value };

            const response = await sendData('post', '/add-payment', formData);
            paymentList.value = response.payment_list;
            
            addPaymentForm.value.p_date = new Date().toISOString().substr(0, 10);
            addPaymentForm.value.p_amount = '';
            addPaymentForm.value.p_payment_method = '0';
            addPaymentForm.value.p_taken_by = '0';
            addPaymentForm.value.voucher_text = '';

            customSwal.fire({
                  title: 'AUD' + addPaymentForm.value.p_amount +' Payment Added Successfully ',
                  icon: 'success',
                  iconColor: '#4CAF50',
            });

            console.log(response);

             //console.log(addPaymentForm.value);
        }

         const cleanerlistData = ref({});
        const cleanerList = async () => {
            const job_id = jobId.value;
            const  formData = { job_id };
            const response = await sendData('get', '/get-cleaner-list', formData);
            cleanerlistData.value = response.cleanerlist
            console.log(response);
        }

        const fetchPayment = async () =>{

            const job_id = jobId.value;
            const  formData = { job_id };

            const response = await sendData('get', '/list-payment', formData);
            paymentList.value = response.payment_list;
            console.log(response);
        }

        const quoteinfoData = ref({});
        const getQuoteInfo = async () => {

                const job_id = jobId.value;
                const quote_id = alldatainforamtion.quote_info.id;
                const site_id =  alldatainforamtion.quote_info.site_id;
                const  formData = { job_id, quote_id, site_id };

                const response = await sendData('get', '/get-payment-data', formData);
                quoteinfoData.value = response.quotedetails;
        }   
		
    // Function to set all data from props
    const getallData = () => {
      if (alldata.value) {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};
      }
    };

    const jobDetailsinfo = ref({});
    // Function to get job details
    const getJobDetails = async () => {
      try {
        const job_id = jobId.value;
        const formget = { job_id };
         //console.log(formget);
        const response = await sendData('get', '/get-job-details', formget);
        jobDetailsinfo.value = response;

        console.log(jobDetailsinfo.value);

      } catch (error) {
        console.error('Error fetching job details:', error);
      }
    };
    
     const refundlistdata = ref({});
    const getRefaundlist = async () => {
        const job_id = jobId.value;
        const formget = { job_id };

        const response = await sendData('get', '/get-refund-list', formget);
        refundlistdata.value = response.refundlist;

    }

    const refundadd = ref({
            r_amount:'',
			transaction_id:'',
			ref_fault_status:0,
			ref_cleaner_id: 0,
			ref_comment:''
        });

        const addRefundPayment = async() => {
            //console.log(refundadd.value);

            if (isNaN(refundadd.value.r_amount) || refundadd.value.r_amount < 1 || !refundadd.value.r_amount) {
                alert('Please enter a valid amount');
                refundadd.value.r_amount = '';
                return;
            } else if (!refundadd.value.transaction_id) {
                alert('Please enter a valid Transaction ID');
                return;
            } else if (!refundadd.value.ref_fault_status) {
                alert('Please select a Fault Status');
                return;
            } else if (!refundadd.value.ref_comment) {
                alert('Please enter comments');
                return;
            }

            // Replace '&' with '#39;' in refundComments
            refundadd.value.ref_comment = refundadd.value.ref_comment.replace('&', '#39;');

            const job_id = jobId.value;
            const quote_id = alldatainforamtion.quote_info.id;
            const  formData = { job_id, quote_id, ...refundadd.value };
            const response = await sendData('post', '/add-refund-payment', formData);
            refundlistdata.value = response.refundlist;
 
            refundadd.value.r_amount = '';
            refundadd.value.transaction_id = '';
            refundadd.value.ref_fault_status = '';
            refundadd.value.ref_comment = '';
            refundadd.value.ref_cleaner_id = 0;

            customSwal.fire({
                  title: 'AUD' + refundadd.value.r_amount +' Refund Payment Added Successfully ',
                  icon: 'success',
                  iconColor: '#4CAF50',
            });
            console.log(response);
        }
	 

    // Global SweetAlert2 configuration
    const customSwal = Swal.mixin({
                toast: true,
                position: 'top-end',
                background: '#f9f9f9',
                color: '#333',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                },
                didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.borderRadius = '10px';
                },
            });


        // Global SweetAlert2 configuration
    const ErrorcustomSwal = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: '#f9f9f9',
        color: '#333',
        showConfirmButton: false,
        timer: 2000,
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title-error',
        },
        didOpen: () => {
          const popup = Swal.getPopup();
          popup.style.borderRadius = '10px';
        },
    });     

        const getInitials = (fullName) => {
            if (!fullName || typeof fullName !== 'string') {
                return ''; // Return empty string if fullName is undefined or not a string
            }

            // Split the fullName by spaces, filter out empty strings (in case of extra spaces)
            const words = fullName.trim().split(/\s+/);

            if (words.length >= 2) {
                return (words[0][0] + words[1][0]).toUpperCase(); // First letter of the first two words
            }

            return words[0][0] ? words[0][0].toUpperCase() : ''; // Return the first letter if there's only one word
        };

	
        
        watch(alldata, (newVal) => {
            if (hasMounted.value && newVal) {
                console.log('watch run');
                getallData();
                getQuoteInfo(); // Call after updating alldata
                fetchPayment();
                cleanerList();
            }
        });

        onMounted(async () => {
            hasMounted.value = true;
            
            console.log('onMounted run');

            await getddValue();
            await  getQuoteInfo();
            await getJobDetails();
            await fetchPayment();
            await cleanerList();
            await getRefaundlist();
        });

        // watch(jobId, (newVal) => {
        //     if (newVal) {
        //         getQuoteInfo();
        //     }
        // });
	
	 return {
      jobId,
	  alldata,
      alldatainforamtion,
      getallData,
	  getddValue,
      getQuoteInfo,
      getJobDetails,
      jobDetailsinfo,
      getInitials,
      addPaymentForm,
      addPayment,
      paymentList,
      addRefundPayment,
      refundadd,
      isNumberKey,
      cleanerList,
      cleanerlistData,
      refundlistdata,
      getRefaundlist,


      quoteinfoData,
      mastercardImg,
      visacardImg,
      amexcardImg,
      paycardImg

    };
  }
});
</script>