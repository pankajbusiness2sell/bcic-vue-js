<template>
    <OperationHeader></OperationHeader>
        <div class="page-wrapper">
          <div class="content">
              <div class="row justify-content-center">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <div class="d-flex justify-content-between">
                                  <div class="pt-2">
                                   
                                      <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10"><i class="ti ti-map-pin"></i></div>
                                      <h5 class="card-title text-nowrap">GPS Location Page <span class="badge badge-info"> ({{ gpsData.length }}) </span>
                                        
                                    </h5>
                                    <span>{{  currentBrisbaneTime }} </span>
                                   
                                  </div>
                                  <div class="">
                                      <div class="d-inline-block me-2">
                                          <select class="form-select" v-model="jobForm.job_type_id">
                                              <option value="0" selected="">Select Job Type</option>
                                              <option value="all" >ALL</option>
                                              <option :value="index"  v-for="(jobtype, index) in jobTypeData" :key="index">{{ jobtype }}</option>
                                          </select>
                                      </div>
                                      <div class="d-inline-block">
                                          <button type="submit" class="btn btn-primary me-2" @click="fetchGpsData(1)">Search</button>
                                          <button type="submit" class="btn btn-danger" @click="fetchGpsData(2)">Reset</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
  
                          <div class="card-body">
                              <div class="bcic_view_quote_table table-responsive mb-5">
                                  <table class="table table-bordered table-hover">
                                      <thead class="table-primary text-nowrap">
                                          <tr>
                                              <th> Quote id </th>
                                              <th> Job ID </th>
                                              <th> Site Name </th>
                                              <th> Client Name </th>
                                              <th> Job Address </th>
                                              <th> Staff Name </th>
                                              <th> Job Type </th>
                                              <th> Staff Location </th>
                                              <th> Last Location Time </th>
                                              <th> Distance/Time </th>
                                              <th> Loc Job Time </th>
                                              <th> Aus Job Time </th>
                                              <th> Start </th>
                                              <th> End </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                            <tr v-if="gpsData.length > 0" class="align-middle" v-for="data in gpsData" :key="data.id" >
                                              <td><div class="t_vq_id"> {{ data.qid }} </div></td>
                                              <td><div class="t_vq_id"><a href="#0"> {{ data.id }}  </a></div></td>
                                              <td>{{ data.site_name }}</td>
                                              <td class="text-nowrap">{{ data.cx_name }}</td>
                                              <td class="gps_address">{{ data.address }}</td>
                                              <td class="gps_names">
                                                  <span>{{ data.staffInfo?.name }}</span>
                                                 <br/>
                                                  <span><a href="javascript:viod(0);">{{ data.staffInfo?.mobile }}</a></span>
                                              </td>
                                              <td>{{ data.job_type }}</td>
                                              <td class="gps_address" v-bind:style="{ background: (data.stafflocation?.address === '') ? '#e8d6d6' : '' }" >{{ data.stafflocation?.address }}</td>
                                              <td v-bind:style="{ background: (data.stafflocation?.address === '') ? '#e8d6d6' : '' }" >{{ data.stafflocation?.current_time }}</td>
                                              <td>{{ data.stafftimeDis?.time }} - {{ data.stafftimeDis?.distance }} </td>
                                              <td class="text-nowrap">{{ data.jtime }}</td>
                                              <td class="text-nowrap">{{ data.afterConvert }}</td>
                                              <td class="text-nowrap" v-bind:style="{ background: (data.start === '') ? '#e8d6d6' : '' }" >{{ data.start }}</td>
                                              <td class="text-nowrap" v-bind:style="{ background: (data.end === '') ? '#e8d6d6' : '' }" >{{ data.end }}</td>
                                            </tr>
                                            <tr v-else>
                                               <td colspan="10">No Records found</td> 
                                            </tr>  
                                         
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>  
                  </div>
              </div>
          </div>
        </div>
</template>
  
  <script>
import { ref, onMounted } from 'vue';
import OperationHeader from '@/header/Operation.vue';
import { useCommonFunction } from '@func/func/function.js';

export default {
  components: {
    OperationHeader
  },
  setup() {
    const { sendData } = useCommonFunction();
    
    const gpsData = ref([]);
    const currentBrisbaneTime = ref(new Date().toLocaleString('en-AU', { timeZone: 'Australia/Brisbane' }));
    const jobTypeData = ref({});
    const jobForm = ref({
      job_type_id: 'all',
    });

    const formatBrisbaneTime = (time) => {
      const date = new Date(time);
      return date.toLocaleString('en-AU', { timeZone: 'Australia/Brisbane' });
    };

    const fetchJobTypeData = async () => {
      try {
        const response = await sendData('get', '/get-job-type', {});
        jobTypeData.value = response.data;
      } catch (error) {
        console.error('Error fetching job types:', error);
      }
    };

    const fetchGpsData = async (type) => {
      const formData = type === 1 ? { ...jobForm.value } : { job_type_id: 'all' };

      try {
        const response = await sendData('get', '/gps-data', formData);
        gpsData.value = response.data;
      } catch (error) {
        console.error('Error fetching GPS data:', error);
      }
    };

    onMounted(() => {
      fetchJobTypeData();
      fetchGpsData(0);

      setInterval(() => {
        currentBrisbaneTime.value = new Date().toLocaleString('en-AU', { timeZone: 'Australia/Brisbane' });
      }, 1000);
    });

    return {
      gpsData,
      currentBrisbaneTime,
      formatBrisbaneTime,
      jobTypeData,
      fetchGpsData,
      jobForm,
    };
  }
};
</script>
