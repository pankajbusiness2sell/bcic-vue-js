<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <PopupHeader></PopupHeader>
                    <div class="card-body">


                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Enter Phone Number...">
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

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Job Type New </label>

                                    <div class="d-flex align-items-center text-body text-hover-1000" href="#!">
                                        <div class="avatar avatar-m">
                                        <div class="avatar-name rounded-circle"><span> <i class="ti ti-trash"></i> </span></div>
                                        </div>
                                        <h6 class="mb-0 ms-2 fw-semibold"> Removal </h6>
                                    </div>

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Staff Name </label>
                                    <div class="d-flex align-items-center text-body text-hover-1000" href="#!">
                                        <div class="avatar avatar-m">
                                        <div class="avatar-name rounded-circle"><span>P</span></div>
                                        </div>
                                        <h6 class="mb-0 ms-2 fw-semibold">Pankaj Gupta</h6>
                                    </div>

                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Staff Amount </label>
                                    <input type="text" class="form-control" placeholder="0">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Profit</label>
                                    <input type="text" class="form-control" placeholder="0">
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
                                    <input type="Date" class="form-control">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Payment Method</label>
                                    <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Account">Account</option>
                                        <option value="Voucher">Voucher</option>
                                     </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Taken By</label>
                                    <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="BCIC">BCIC</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <button type="submit" class="btn btn-primary bcic_btns">Send Terms & Conditions</button>
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
                                    <tr>
                                        <td>17th Apr 2023 </td>
                                        <td><span class="vq_price"> AUD 150.00  </span> </td>
                                        <td>

                                            <span class="vq_website"> Cash </span>
                                        </td>
                                        <td>
                                            Pankaj Gupta
                                            <span class="badge badge-tag badge-success-light">removal</span>

                                        </td>

                                        <td>
                                            0
                                        </td>

                                        <td>
                                            <span class="vq_admin">  Received </span>
                                        </td>

                                        <td>
                                            <span class="vq_admin"> Credit </span>
                                        </td>
                                        <td>
                                            <span class="vq_admin">  BCIC </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-soft-danger"><i class="ti ti-trash"></i></button>
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
                                    <input type="text" class="form-control" placeholder="Enter Amount Here">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Transaction ID</label>
                                    <input type="text" class="form-control" placeholder="Enter Transaction ID">
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Fault Status</label>
                                    <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Cleaner</option>
                                        <option value="3">Client</option>
                                     </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Cleaner Name	</label>
                                    <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="BCIC">BCIC</option>
                                    </select>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-semibold">Comments</label>
                                    <textarea rows="2" cols="4" class="form-control" placeholder="Enter Your Location"></textarea>
                                </div>

                                <div class="col mb-3">
                                    <button type="submit" class="btn btn-primary bcic_btns">Payment Refund</button>
                                </div>

                            </div>

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
import { defineComponent, onMounted, reactive , ref } from 'vue'; // Import necessary functions
import { useCommonFunction } from './../../func/function.js';
import PopupHeader from './header/PopupHeader.vue';
import PopupTab from './header/PopupTab.vue';

export default defineComponent({

    components : {
        PopupHeader,
        PopupTab
    },

    setup() { 
	
	const mastercardImg = ref('/assets/img/master_card.png');
	const visacardImg = ref('/assets/img/visa_card.png');
	const amexcardImg = ref('/assets/img/amex_card.png');
	const paycardImg = ref('/assets/img/state-tax-image.png');

        const QueryParms = reactive({
            tab: '',
            job_id: 0
        });

        const getQueryParms = () => {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            console.log('Pankaj test');
            QueryParms.tab = params.get('tab');
            QueryParms.job_id = params.get('job_id');
        };

        const { openNewWindow } = useCommonFunction();

        onMounted(() => {
            getQueryParms(); // Call the function here
        });

        // Other reactive variables or functions can go here

        return {
            openNewWindow,
            getQueryParms,
            QueryParms,
			
			mastercardImg,
			visacardImg,
			amexcardImg,
			paycardImg
        };
    }
});
</script>

