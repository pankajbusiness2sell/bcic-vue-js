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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Cleaner Notes </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="BCIC">BCIC</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Cleaner Notes </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="BCIC">BCIC</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Cleaner Notes </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="BCIC">BCIC</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Comments</label>
                                        <textarea rows="2" cols="4" class="form-control" placeholder="Enter Your Location"></textarea>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>



                                </div>

                            </div>
                            <div class="col-md-6">
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
