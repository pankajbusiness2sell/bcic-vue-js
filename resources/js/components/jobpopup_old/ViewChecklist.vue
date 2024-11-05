<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <PopupHeader></PopupHeader>
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-checklist"></i>
                                </div>
                                <h5 class="card-title"> CheckList Update </h5>
                        </div>

                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th>Id </th>
                                        <th>Type </th>
                                        <th>Subject </th>
                                        <th>Status</th>
                                        <th> Comments </th>
                                        <th> Send/Start Time  </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Cleaning </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Christy Oslar,Ganga Prasad,Veerpal Singh Deol </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td> Carpet </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Buddy </td>
                                        <td></td>
                                        <td></td>
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
            QueryParms,
			
        };
    }
});
</script>
