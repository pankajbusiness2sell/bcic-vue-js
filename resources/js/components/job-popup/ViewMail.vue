<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                    <th> <i class="ti ti-calendar-clock"></i> Email Date </th>
                                    <th> <i class="ti ti-mail"></i> Email </th>
                                    <th> <i class="ti ti-notes"></i> Subject </th>
                                    <th> <i class="ti ti-mail"></i> Mail Type </th>
                                    <th> <i class="ti ti-user-circle"></i> Admin </th>
                                  </tr>
                                </thead>
                                <tbody v-if="viewemailList.emails.length > 0">
                                  <template v-for="(emails, index) in viewemailList.emails" :key="index">
                                    <tr>
                                      <td>{{ emails.date }}</td>
                                      <td>{{ emails.email }}</td>
                                      <td>
                                        <strong><a href="javascript:void(0);" @click="toggleVisibility(index)">{{ emails.heading }}</a></strong>
                                      </td>
                                      <td>{{ emails.type }}</td>
                                      <td>{{ emails.staff_name }}</td>
                                    </tr>
                                    <tr v-if="isVisible[index]">
                                      <td colspan="5">
                                        <p v-html="emails.comment"></p>
                                      </td>
                                    </tr>
                                  </template>
                                </tbody>
                                <tr v-else>
                                  <td colspan="5">No Email found</td>
                                </tr>
                              </table>
                        </div>

                        <div class="card-header ps-0 pt-0 mb-3">
                            <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                <i class="ti ti-mail"></i>
                            </div>
                            <h5 class="card-title"> Email Notes </h5>
                       </div>
                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 text-now">
                                <thead>
                                  <tr class="table-primary">
                                    <th> <i class="ti ti-calendar-clock"></i> Email Date </th>
                                    <th> <i class="ti ti-notes"></i> Comment </th>
                                    <th> <i class="ti ti-user-circle"></i> Admin </th>
                                  </tr>
                                </thead>
                                <tbody v-if="viewemailList.emailsNotes.length > 0">
                                  <template v-for="(notes, index) in viewemailList.emailsNotes" :key="index">
                                    <tr>
                                      <td>{{ notes.date }}</td>
                                      <td>{{ notes.comment }}</td>
                                      <td>{{ notes.staff_name }}</td>
                                    </tr>
                                  </template>
                                </tbody>
                                <tr v-else>
                                  <td colspan="5">No Notes found</td>
                                </tr>
                              </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
import { useCommonFunction } from '../../func/function.js';

export default defineComponent({
  name: 'ViewMail',
  props: {
    jobId: {
      type: [String, Number],
      required: true
    },
    alldata: {
      type: [Object, Array],
      required: true
    }
  },
  setup(props) {

    const { sendData } = useCommonFunction();
    const { jobId, alldata } = toRefs(props);

    const alldatainforamtion = reactive({
      all: {},
      jobdetails: [],
      quote_info: {}
    });

    // Function to set all data from props
    const getallData = () => {
      if (alldata.value && typeof alldata.value === 'object') {
        alldatainforamtion.all = alldata.value;
        alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
        alldatainforamtion.quote_info = alldata.value.quote_info || {};

        // Update emailData.email when quote_info.email is available
       // emailData.value.email = alldatainforamtion.quote_info.email || '';
      } else {
        console.warn('alldata is not a valid object:', alldata.value);
      }
    };
     
 
    const viewemailList = ref({
        emails : {},
        emailsNotes: {}
    });
    const getemailList = async () => {
        const job_id = jobId.value;
      const formData = {job_id};
      const response = await sendData('get', '/get-email-list', formData);
      viewemailList.value.emails = response.emails;
      viewemailList.value.emailsNotes = response.emailNotes;

    };

    const isVisible = ref(Array(viewemailList.value.emails.length).fill(false));

    // Toggle visibility for a specific item
    const toggleVisibility = (index) => {
      isVisible.value[index] = !isVisible.value[index];
    };

    const showEmail = (comment) => {

         console.log(comment);
    }

    watch(alldata, (newVal) => {
      if (newVal) {
        getemailList();
      }
    });

    // Lifecycle hook
    onMounted(async () => {
      try {
        getallData();
        getemailList();
      } catch (error) {
        console.error('Error in mounted hook:', error);
      }
    });


    return {
      jobId,
      alldata,
      alldatainforamtion,
      getallData,
      getemailList,
      viewemailList,
      showEmail,
      isVisible,
      toggleVisibility
    };

  }
});
</script>
