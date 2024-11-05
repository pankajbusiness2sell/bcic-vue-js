<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <PopupHeader></PopupHeader>
                    <div class="card-body">
                        <!--Job Details Section Start Here-->
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <h5 class="card-title"> Secondery Client Info</h5>
                                </div>


                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col  mb-3">
                                        <label class="form-label"> Name </label>
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Email </label>
                                        <input type="text" class="form-control" placeholder="Enter Email Address">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Phone No </label>
                                        <input type="text" class="form-control" placeholder="Enter Phone No">
                                    </div>





                                    <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary bcic_btns me-2">Submit</button>
                                        <button type="submit" class="btn btn-primary bcic_btns">View</button>
                                    </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <h5 class="card-title">  Real Estate Agent Details</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-3 col-lg-3 mb-3">
                                            <label class="form-label">Agency Name </label>
                                            <input type="text" class="form-control" placeholder="Agency Name">
                                        </div>

                                        <div class="col-3 col-lg-3 mb-3">
                                            <label class="form-label">Agent Name </label>
                                            <input type="text" class="form-control" placeholder="Agent Name">
                                        </div>


                                        <div class="col-3 col-lg-3 mb-3">
                                            <label class="form-label">Agent Number </label>
                                            <input type="text" class="form-control" placeholder="Agent Number">
                                        </div>


                                        <div class="col-3 col-lg-3 mb-3">
                                            <label class="form-label">Agent Email</label>
                                            <input type="text" class="form-control" placeholder="Agent Email">
                                        </div>

                                        <div class="col-md-3 col-lg-3 mb-3">
                                            <label class="form-label">Agent LandLine No</label>
                                            <input type="text" class="form-control" placeholder="Agent LandLine No">
                                        </div>

                                        <div class="col-md-3 col-lg-3 mb-3">
                                            <label class="form-label">Agent Address</label>
                                            <input type="text" class="form-control" placeholder="Agent Address">
                                        </div>

                                    </div>

                                </div>

                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-briefcase"></i>
                                    </div>
                                    <h5 class="card-title">Job Detail</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Work Guarantee</label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="Phone">Yes</option>
                                            <option value="Email">No</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">WG With Reason</label>
                                        <input type="text" class="form-control" placeholder="Reason for Work Guarantee">
                                    </div>

                                    </div>
                                </div>




                                <div class="card-header pt-0">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-user-dollar"></i>
                                    </div>
                                    <h5 class="card-title">Customer Payment</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Amount </label>
                                        <input type="text" class="form-control" placeholder="Enter Amount">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Payment Method </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Bank Transfer" selected="">Bank Transfer</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Account">Account</option>
                                            <option value="Voucher">Voucher</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Paid </label>
                                        <input type="text" class="form-control" placeholder="Enter Amount">
                                    </div>


                                    <div class="col mb-3">
                                        <label class="form-label">Paid Date </label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Invoice Status</label>
                                        <select class="form-select">
                                            <option value="">Select</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Paid</option>
                                            <option value="2" selected="">Semi Paid</option>
                                        </select>
                                    </div>

                                    </div>
                                </div>


                                <div class="card-header pt-0">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                    <h5 class="card-title">Email & SMS</h5>
                                </div>

                                <div class="card-body p-0">
                                    <table class="table table-bordered table-hover mt-2 ">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Confirm Booking</th>
                                                <th>Cleaner Details to Client </th>
                                                <th> Email Client Invoice </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="otd-send_btns">
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary"> <i class="ti ti-mail"></i> Send Email</a>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li><a href="javascript:void(0);" class="btn btn-primary"> <i class="ti ti-mail"></i> Send Email</a></li>
                                                        <li><a href="javascript:void(0);" class="btn btn-primary"> <i class="ti ti-message-dots"></i> Send SMS</a></li>
                                                    </ul>

                                                </td>

                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary"> <i class="ti ti-mail"></i> Email</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02 Jul 2024 04:31:13</td>
                                                <td>02 Jul 2024 04:31:13</td>
                                                <td>02 Jul 2024 04:31:13</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>




                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="otd_job_details_rightpanel">
                                        <div class="card">
                                            <nav class="p-3 pb-0">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-allnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-allnotes" type="button" role="tab" aria-controls="nav-allnotes" aria-selected="true">All Notes</button>
                                                <button class="nav-link" id="nav-staffnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-staffnotes" type="button" role="tab" aria-controls="nav-staffnotes" aria-selected="false">Staff Notes</button>
                                                <button class="nav-link" id="nav-highlightnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-highlightnotes" type="button" role="tab" aria-controls="nav-highlightnotes" aria-selected="false">Highlight Notes</button>
                                                <button class="nav-link" id="nav-threepmnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-threepmnotes" type="button" role="tab" aria-controls="nav-threepmnotes" aria-selected="false">3PM Notes</button>
                                            </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-allnotes" role="tabpanel" aria-labelledby="nav-allnotes-tab" tabindex="0">
                                                    <!---All Notes-->
                                                    <div class="text-end p-3">
                                                        <select class="form-select">
                                                            <option value="0">Select</option>
                                                            <option value="1">Sales Notes</option>
                                                            <option value="2">Before Job Notes</option>
                                                            <option value="3">Otd Notes </option>
                                                            <option value="4">Reclean Notes </option>
                                                            <option value="5">Complaint Notes  </option>
                                                            <option value="6">Review Notes  </option>
                                                            <option value="7">Re-quote Notes</option>
                                                            <option value="8">Unassigned Notes</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                                    </div>


                                                    <div class="vq_message_list p-3 pt-0">

                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->

                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Quote Step change Info to A Approved</span>
                                                                <p>Quote Step change Info to A Approved</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->

                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->

                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->


                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->


                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->


                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->



                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-2">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->


                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-3">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->


                                                            <!--Quote box Section Start Here-->
                                                            <div class="vq_message_q_box mb-3">
                                                                <span>Amount Change in (Carpet) $120 to $140</span>
                                                                <p>Amount Change in (Carpet) $120 to $140</p>
                                                                <div class="vq_message_f d-flex justify-content-between">
                                                                    <span><i class="ti ti-user-square-rounded"></i> By Manali Manwadkar</span>
                                                                    <span><i class="ti ti-calendar-dot"></i> 2024-07-08 16:20:59 </span>
                                                                </div>
                                                            </div>
                                                            <!--Quote box Section End Here-->

                                                    </div>






                                                    <!--All Notes-->
                                                </div>

                                                <div class="tab-pane fade" id="nav-staffnotes" role="tabpanel" aria-labelledby="nav-staffnotes-tab" tabindex="0">
                                                    <!---All Notes-->
                                                    <div class="text-end p-3">
                                                        <select class="form-select">
                                                            <option value="0">Select</option>
                                                            <option value="1">Sales Notes</option>
                                                            <option value="2">Before Job Notes</option>
                                                            <option value="3">Otd Notes </option>
                                                            <option value="4">Reclean Notes </option>
                                                            <option value="5">Complaint Notes  </option>
                                                            <option value="6">Review Notes  </option>
                                                            <option value="7">Re-quote Notes</option>
                                                            <option value="8">Unassigned Notes</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                                    </div>

                                                    <div class="otd_result_found">
                                                        <img :src="noresultfoundImg" alt="No Result Found"/>
                                                        No Result Found
                                                    </div>




                                                </div>

                                                <div class="tab-pane fade" id="nav-highlightnotes" role="tabpanel" aria-labelledby="nav-highlightnotes-tab" tabindex="0">
                                                    <!---All Notes-->
                                                    <div class="text-end p-3">
                                                        <select class="form-select">
                                                            <option value="0">Select</option>
                                                            <option value="1">Sales Notes</option>
                                                            <option value="2">Before Job Notes</option>
                                                            <option value="3">Otd Notes </option>
                                                            <option value="4">Reclean Notes </option>
                                                            <option value="5">Complaint Notes  </option>
                                                            <option value="6">Review Notes  </option>
                                                            <option value="7">Re-quote Notes</option>
                                                            <option value="8">Unassigned Notes</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                                    </div>

                                                    <div class="otd_result_found">
                                                        <img :src="noresultfoundImg" alt="No Result Found"/>
                                                        No Result Found
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="nav-threepmnotes" role="tabpanel" aria-labelledby="nav-threepmnotes-tab" tabindex="0">
                                                   <!---All Notes-->
                                                   <div class="text-end p-3">
                                                        <select class="form-select">
                                                            <option value="0">Select</option>
                                                            <option value="1">Sales Notes</option>
                                                            <option value="2">Before Job Notes</option>
                                                            <option value="3">Otd Notes </option>
                                                            <option value="4">Reclean Notes </option>
                                                            <option value="5">Complaint Notes  </option>
                                                            <option value="6">Review Notes  </option>
                                                            <option value="7">Re-quote Notes</option>
                                                            <option value="8">Unassigned Notes</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                                    </div>


                                                    <div class="otd_result_found">
                                                        <img :src="noresultfoundImg" alt="No Result Found"/>
                                                        No Result Found
                                                    </div>





                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--Job Details Section End Here-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, onMounted, reactive, ref } from 'vue'; // Import necessary functions
import { useCommonFunction } from '../../func/function.js';
import PopupHeader from './header/PopupHeader.vue';
import PopupTab from './header/PopupTab.vue';

export default defineComponent({

    components : {
        PopupHeader,
        PopupTab
    },

    setup() { 
        const noresultfoundImg = ref('/assets/img/noresultfound.jpg');

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
            noresultfoundImg
        };
    }
});
</script>

