<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <PopupHeader></PopupHeader>
                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-checklist"></i>
                                </div>
                                <h5 class="card-title"> Task Assign History </h5>
                        </div>

                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th>Sr No </th>
                                        <th>Quote ID</th>
                                        <th>Job ID</th>
                                        <th>Staff ID</th>
                                        <th>Subject</th>
                                        <th>Comment</th>
                                        <th>Task Type</th>
                                        <th>Noti Type</th>
                                        <th>Task Status</th>
                                        <th>Task Admin Name Type</th>
                                        <th>Created Date</th>
                                        <th>Finish Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>

                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>


                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>


                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>

                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>


                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
                                    </tr>


                                    <tr>
                                        <td>1238</td>
                                        <td> 0 </td>
                                        <td> 4852 </td>
                                        <td></td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> Number of Rooms are not Correct for (J#4852) </td>
                                        <td> OTD </td>
                                        <td> Urgent </td>
                                        <td> New </td>
                                        <td> Payal Panda </td>
                                        <td> 19th Jul 2024 15:07 PM </td>
                                        <td> 20th Jul 2024 15:07 PM</td>
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

<script>
import { defineComponent, onMounted, reactive ,ref } from 'vue'; // Import necessary functions
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