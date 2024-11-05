<template>

    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
               
                    <PopupHeader></PopupHeader>
                    <div class="card">
                        <div class="d-flex justify-content-between">
                             <div class="view_quote_totals">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-dot">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 6.66a2 2 0 0 0 -1.977 1.697l-.018 .154l-.005 .149l.005 .15a2 2 0 1 0 1.995 -2.15z" />
                                </svg>  New Notification List <span>406</span>
                            </div>

                            <div class="d-flex justify-content-start">


                                <div class="col mb-2 me-2">
                                    <label class="form-label">Admin</label>
                                    <select class="form-select">
                                        <option value="Select">Select</option>
                                        <option value="189">Alok Bajpai</option>
                                        <option value="149">Archa</option>
                                        <option value="185">Ashab Hussain</option>
                                        <option value="183">Ashu Dixit</option>
                                        <option value="141">Bhavna</option>
                                        <option value="37">Cbd Movers</option>
                                        <option value="195">Deepshikha Verma</option>
                                        <option value="193">Harshit Gautam</option>
                                        <option value="120">Harshveer</option>
                                        <option value="153">Indrani Saikia</option>
                                        <option value="182">Kailash Singh Rautela</option>
                                        <option value="158">Manali</option>
                                        <option value="173">Mohit Sethi</option>
                                        <option value="12">Nadia</option>
                                        <option value="140">Naval</option>
                                        <option value="181">Neeraj Kumar</option>
                                        <option value="41">Payal Panda</option>
                                        <option value="162">Piyush Digari</option>
                                        <option value="174">Poorva Sharma</option>
                                        <option value="95">Ram Verma</option>
                                        <option value="134">Rashmi</option>
                                        <option value="186">Sahil Kumar Gupta</option>
                                        <option value="175">Shubham Chauhan</option>
                                        <option value="150">Shweta</option>
                                        <option value="194">Sondarya Malhotra</option>
                                        <option value="143">Vimmi</option>
                                        <option value="171">Vinay Kumar</option>
                                    </select>
                                </div>

                                <div class="col mb-2 me-2">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control">
                                </div>


                                <div class="col mb-2 me-2">
                                    <label class="form-label">Task Type</label>
                                    <select class="form-select">
                                        <option value="Select">Select</option>
                                        <option value="189">General</option>
                                        <option value="149">Urgent</option>
                                    </select>
                                </div>

                                <div class="col mb-2">
                                    <ul class="bcic_view_q_btns">
                                        <li><button type="submit" class="btn btn-primary bcic_btns">Search</button></li>
                                        <li><button type="submit" class="btn btn-danger bcic_btns">Reset</button></li>
                                    </ul>
                                </div>

                            </div>





                        </div>

                        <div class="card-body">
                            <div class="bcic_view_quote_table table-responsive mb-5">
                                <table class="table table-bordered table-hover mb-3 text-nowrap">
                                    <thead class="table-primary">
                                        <tr>
                                            <th><i class="ti ti-id"></i> ID </th>
                                            <th><i class="ti ti-id"></i> Job id</th>
                                            <th><i class="ti ti-id"></i> Quote ID</th>
                                            <th><i class="ti ti-versions"></i> App ID</th>
                                            <th><i class="ti ti-user-circle"></i> Staff ID</th>
                                            <th><i class="ti ti-circle-plus"></i> Created On</th>
                                            <th><i class="ti ti-user"></i> Assign Name</th>
                                            <th><i class="ti ti-user"></i> Track Admin Name</th>
                                            <th><i class="ti ti-bell"></i> Noti Type</th>
                                            <th><i class="ti ti-checkup-list"></i> Subject</th>
                                            <th><i class="ti ti-message-2"></i> Comment</th>
                                            <th><i class="ti ti-edit-circle"></i> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle bc_click_btn">
                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);" @click="openPopup"> <i class="ti ti-id"></i> 4855 </a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>


                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>


                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>


                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <div class="noitification_old_detail mt-2 ms-3 me-2">
                                                        <h4 class="tags color3">Old Details</h4>
                                                        <p>Pankaj ups</p>
                                                    </div>
                                                    <div class="noitification_new_detail mt-2 text-end">
                                                        <h4 class="tags color2">New Details</h4>
                                                        <p>Pankaj 11111</p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <div class="noitification_old_detail mt-2 ms-3 me-2">
                                                        <h4 class="tags color3">Old Details</h4>
                                                        <p>Insurance_expiry : 2018-01-01</p>
                                                    </div>
                                                    <div class="noitification_new_detail mt-2 text-end">
                                                        <h4 class="tags color2">New Details</h4>
                                                        <p>Insurance_expiry : 2018-01-01</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>


                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>J#4855 Full Payment Made By pankaj of 100$</td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>1 </td>
                                            <td><a class="vq_id" href="javascript:void(0);"> <i class="ti ti-id"></i> 4855</a></td>
                                            <td><a class="vq_ids" href="javascript:void(0);"> <i class="ti ti-id"></i> 19932</a></td>
                                            <td></td>
                                            <td></td>
                                            <td>09 Aug 2024 20:24</td>
                                            <td>Pankaj</td>
                                            <td>Pankaj</td>
                                            <td><p class="vq_date">General</p></td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <div class="noitification_old_detail mt-2 ms-3 me-2">
                                                        <h4 class="tags color3">Old Details</h4>
                                                        <p>Pankaj ups</p>
                                                    </div>
                                                    <div class="noitification_new_detail mt-2 text-end">
                                                        <h4 class="tags color2">New Details</h4>
                                                        <p>Pankaj 11111</p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <div class="noitification_old_detail mt-2 ms-3 me-2">
                                                        <h4 class="tags color3">Old Details</h4>
                                                        <p>Insurance_expiry : 2018-01-01</p>
                                                    </div>
                                                    <div class="noitification_new_detail mt-2 text-end">
                                                        <h4 class="tags color2">New Details</h4>
                                                        <p>Insurance_expiry : 2018-01-01</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select">
                                                    <option value="0">Select</option>
                                                    <option value="1" selected="">New</option>
                                                    <option value="2">In-progress</option>
                                                    <option value="4">Hold</option>
                                                    <option value="3">Completed</option>
                                                </select>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

</template>

<<script>
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
