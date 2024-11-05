<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <PopupHeader></PopupHeader>
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-mail"></i>
                                </div>
                                <h5 class="card-title"> View Email </h5>
                        </div>
                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 text-now">
                                <thead>
                                    <tr class="table-primary">
                                        <th> <i class="ti ti-calendar-event"></i> Date </th>
                                        <th> <i class="ti ti-calendar-clock"></i> Email Date </th>
                                        <th> <i class="ti ti-mail"></i> Email </th>
                                        <th> <i class="ti ti-notes"></i>  Subject </th>
                                        <th> <i class="ti ti-mail"></i> Mail Type </th>
                                        <th> <i class="ti ti-user-circle"></i> Admin </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2023-11-05 10:10:02</td>
                                        <td>2023-11-05 </td>
                                        <td>pankaj.business2sell@gmail.com</td>
                                        <td id="viewemail"><a href="javascript:void(0);" @click="toggleShow"> Job Completed #45977 at 112 The Esplanade, Burleigh Heads QLD 4220, Australia</a></td>
                                        <td> </td>
                                        <td>Pankaj </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6" v-if="show">
                                            <div class="fs-14">
                                                Hi panakj, <br>
                                                We confirm your bond clean that was booked in for 2023-11-04 at 112 The Esplanade, Burleigh Heads QLD 4220, Australia is complete. <br>
                                                Please click on the link: http://b2s.im/42n for before and after images provided by our cleaner. <br>
                                                Please see that BCIC bond cleans comes with a 7-day guarantee to allow for a free of cost reclean based on the Exit report provided by the Real Estate and the landlord. We request you to reach out to our team if there are any discrepancies in the clean. <br>
                                                We aim for the highest level of customer delivery and are there to assist you every step of the way. <br>

                                            </div>
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


<script>
import { defineComponent, onMounted, reactive , ref} from 'vue'; // Import necessary functions
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
		
		const show = ref(false); // Use `ref` to define reactive data

		const toggleShow = () => {
		  show.value = !show.value;
		};

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
			
			 show,
      toggleShow,
        };
    }
});
</script>

