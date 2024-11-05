<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <PopupHeader></PopupHeader>

                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-mail"></i>
                                </div>
                                <h5 class="card-title"> Email Client </h5>
                        </div>
                       <div class="row">
                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Template</label>
                                <select class="form-select">
                                    <option value="0">Select</option>
                                    <option value="1">Booking Confirmation To Client</option>
                                    <option value="2">Send Client Cleaner Details</option>
                                    <option value="3">Re No Guarantee Areas</option>
                                    <option value="4">Re-second Reclean</option>
                                    <option value="5">Template 3</option></select>
                            </div>

                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">To</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>


                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>


                            <div class="col col-md-12 mb-2">
                                <label class="form-label fw-semibold">Subject</label>
                                <textarea rows="6" cols="4" class="form-control" placeholder="Enter Your Location"></textarea>
                            </div>

                            <div class="col col-md-12 mb-3 text-end">
                                <button type="submit" class="btn btn-primary bcic_btns">Send Email </button>
                            </div>
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
