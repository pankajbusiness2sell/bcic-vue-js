<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-time"></i>
                                </div>
                                <h5 class="card-title"> Job Assign History</h5>
                        </div>




                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th>Job Type </th>
                                        <th>Denied </th>
                                        <th>Available </th>
                                        <th>Already Has a Job </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Cleaning </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Christy Oslar,Ganga Prasad,Veerpal Singh Deol </td>

                                    </tr>

                                    <tr>
                                        <td> Carpet </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Buddy </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>


                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-time"></i>
                                </div>
                                <h5 class="card-title"> Deny & Re-Assign History </h5>
                        </div>


                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th> Staff Name </th>
                                        <th> Deny & Re-Assign Time </th>
                                        <th> Job Type </th>
                                        <th> Deny Type </th>
                                        <th> Reason for Deny </th>
                                        <th> Deny/Re-Assign </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Cleaning </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Christy Oslar,Ganga Prasad,Veerpal Singh Deol </td>

                                    </tr>

                                    <tr>
                                        <td> Carpet </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Buddy </td>
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
import { defineComponent, onMounted, reactive } from 'vue'; // Import necessary functions
import { useCommonFunction } from './../../func/function.js';
import PopupHeader from './header/PopupHeader.vue';
import PopupTab from './header/PopupTab.vue';

export default defineComponent({

    components : {
        PopupHeader,
        PopupTab
    },

    setup() { 
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
            QueryParms
        };
    }
});
</script>
