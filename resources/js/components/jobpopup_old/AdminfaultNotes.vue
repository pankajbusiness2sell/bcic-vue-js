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
                                <h5 class="card-title"> Admin Fault Notes</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold"> Name </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="61">Advit test</option>
                                            <option value="49">Akhil</option>
                                            <option value="48">Ankit 2</option>
                                            <option value="38">Brooke</option>
                                            <option value="54">Charlotte</option>
                                            <option value="51">Elle</option>
                                            <option value="15">Huma</option>
                                            <option value="34">Jarryd</option>
                                            <option value="57">Joanne</option>
                                            <option value="63">Kylie</option>
                                            <option value="31">Manik</option>
                                            <option value="12">Nadia</option>
                                            <option value="17">Pankaj</option>
                                            <option value="3">Payal</option>
                                            <option value="41">Payal Panda</option>
                                            <option value="4">Puja</option>
                                            <option value="56">Rahul</option>
                                            <option value="64">Sonali</option>
                                            <option value="58">Training</option>
                                            <option value="60">Vikas</option>
                                            <option value="52">Vishal</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Add Notes </label>
                                        <textarea rows="2" cols="2" class="form-control" placeholder="Please Enter Notes"></textarea>
                                    </div>


                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="vq_message_list p-3 pt-0">
                                    <!--Quote box Section Start Here-->
                                    <div class="vq_message_q_box otd_add_review_box mb-2">
                                        <span>Pankaj Google Review</span>
                                        <p>Review Date : 2024-08-16 </p>
                                        <div class="vq_message_f d-flex justify-content-between">
                                            <span><i class="ti ti-user-square-rounded"></i> Job ID 4855 </span>
                                            <span><i class="ti ti-star"></i> Overall Ratting : 5  </span>
                                        </div>
                                        <p> Negative/Positive Experience</p>
                                        <div class="vq_message_f d-flex justify-content-between">
                                            <span> Positive Experience : Test</span>
                                            <span> Positive Experience : Test </span>
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
