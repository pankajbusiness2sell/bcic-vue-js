<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <PopupHeader></PopupHeader>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-header">
                                   
                                        <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                            <i class="ti ti-users"></i>
                                        </div>
                                        <h5 class="card-title"> Real Estate Agent Details</h5>
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

                                <table class="table table-bordered table-hover mt-2 fs-14 job-type-table">
                                <thead class="table-primary">
                                    <tr>
                                        <th> Job Type </th>
                                        <th>Staff</th>
                                        <th>Reclean Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Re-Clean Status</th>
                                        <th>ReClean SMS Send</th>
                                        <th>ReClean Notification</th>
                                        <th>DateTime</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>

                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>


                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>


                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>


                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>


                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>


                                    <tr>
                                        <td>Removal</td>
                                        <td>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="233">Pankaj Gupta Removal</option>
                                                <option value="1268">Sukhjot Singh </option>
                                                <option value="1551">Hemraj Cbd</option>
                                            </select>
                                        </td>
                                        <td>2024-02-02</td>
                                        <td>8:00 AM</td>
                                        <td>300</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                    <div class="otd_job_details_rightpanel">
                                            <nav class="p-3 pb-0">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-allnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-allnotes" type="button" role="tab" aria-controls="nav-allnotes" aria-selected="true">All Notes</button>
                                                <button class="nav-link" id="nav-staffnotes-tab" data-bs-toggle="tab" data-bs-target="#nav-staffnotes" type="button" role="tab" aria-controls="nav-staffnotes" aria-selected="false">For Staff</button>
                                            </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-allnotes" role="tabpanel" aria-labelledby="nav-allnotes-tab" tabindex="0">

                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Type a Re-Clean Note Here"></textarea>
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
                                                    <div class="text-end p-3 pt-0">
                                                        <textarea rows="2" cols="2" class="form-control" placeholder="Re-Clean Note For Staff"></textarea>
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
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, onMounted, reactive,ref } from 'vue'; // Import necessary functions
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
