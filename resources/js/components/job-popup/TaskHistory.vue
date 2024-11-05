<template>
    <div class="container-fluid p-3">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="card-header ps-0 pt-0 mb-3 d-flex align-items-center">
                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10 me-2">
                  <i class="ti ti-checklist"></i>
                </div>
                <h5 class="card-title">Task Assign History</h5>
              </div>
              
              <div class="bcic_view_quote_table table-responsive mb-5">
                <table class="table table-bordered mt-2 fs-14 payment_table">
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Quote ID</th>
                      <th>Job ID</th>
                      <th>Staff ID</th>
                      <th>Subject</th>
                      <th>Comment</th>
                      <th>Task Type</th>
                      <th>Noti Type</th>
                      <th>Task Status</th>
                      <th>Task Admin Name</th>
                      <th>Created Date</th>
                      <th>Finish Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(task, index) in showTasks" :key="task.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ task.quote_id > 0 ? task.quote_id : '' }}</td>
                      <td>{{ task.job_id > 0 ? task.job_id : '' }}</td>
                      <td>{{ task.staff_name }}</td>
                      <td>{{ task.heading }}</td>
                      <td>{{ task.comment }}</td>
                      <td>{{ GetSystemDD[179] ? GetSystemDD[179][task.track_type] : '' }}</td>
                      <td>{{ task.noti_type === 1 ? 'General' : 'Urgent' }}</td>
                      <td>{{ GetSystemDD[179] ? GetSystemDD[179][task.is_task_status] : '' }}</td>
                      <td>{{ task.admin_name }}</td>
                      <td>{{ formatDate(task.createOn) }}</td>
                      <td>{{ task.task_finish_date !== '0000-00-00 00:00:00' ? formatDate(task.task_finish_date) : '' }}</td>
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
  import { defineComponent, toRefs, reactive, ref, watch, onMounted } from 'vue';
  import { useCommonFunction } from '../../func/function.js';
  //import { debounce } from 'lodash';
  
  export default defineComponent({
    name: 'ViewMail',
    props: {
      jobId: {
        type: [String, Number],
        required: true,
      },
      alldata: {
        type: [Object, Array],
        required: true,
      },
    },
  
    setup(props) {
       const hasMounted = ref(false); // Flag to check if the component has mounted
      const { sendData, getddvaluedata  } = useCommonFunction();
     
      const { jobId, alldata } = toRefs(props);
  
      const alldatainforamtion = reactive({
        all: {},
        jobdetails: [],
        quote_info: {},
      });
  
      const showTasks = ref([]);
      const GetSystemDD = ref({});
  
      // Function to fetch all data from props
      const getallData = () => {
        if (alldata.value && typeof alldata.value === 'object') {
          alldatainforamtion.all = alldata.value;
          alldatainforamtion.jobdetails = alldata.value.jobdetails || [];
          alldatainforamtion.quote_info = alldatainforamtion.all.quote_info || {};
        } else {
          console.warn('alldata is not a valid object:', alldata.value);
        }
      };
  
         // Function to fetch task history
        const getTaskhistory = async () => {
            try {
                const job_id = jobId.value;
                const quote_id = alldatainforamtion.quote_info.id;
                const formData = { job_id, quote_id };

                const response = await sendData('get', '/get-task-history', formData);
                const taskHistory = response.taskhistory || [];

                // Iterate over taskHistory to fetch the staff and admin names asynchronously
                const tasksWithDetails = await Promise.all(
                taskHistory.map(async (task) => {
                    if (task.staff_id > 0) {
                       
                        task.staff_name = await getrsvalue(task.staff_id, 'staff', 'name');

                    } else {
                    task.staff_name = '';
                    }
                    task.admin_name = await getrsvalue(task.task_manage_id, 'admin', 'name');
                     

                    return task;
                })
                );

                // Update showTasks with the detailed tasks
                showTasks.value = tasksWithDetails;
            } catch (error) {
                console.error('Error fetching task history:', error);
            }
        };
  
        const getrsvalue = async (id, tName, field) => {
            try {
                const formData = { id, tName, field };
                const response = await sendData('get', '/get-rs-value', formData);
                
                // Log the response to check its structure
                console.log(`Response for id ${id}, table ${tName}, field ${field}:`, response);

                if (response && response.valuename) {
                  return response.valuename;
                } else {
                 console.warn(`Value not found for id ${id}, tName ${tName}, field ${field}`);
                return ''; // Return empty string if value not found
                }
            } catch (error) {
                console.error(`Error fetching value for id ${id}, tName ${tName}, field ${field}:`, error);
                return ''; // Return empty string on error
            }
        };

  
      // Function to fetch dropdown values
      const getddValue = async () => {
            try {
            const ids = [179, 135];
            GetSystemDD.value = await getddvaluedata(ids);
            } catch (error) {
            console.error('Error fetching dropdown data:', error);
            }
      };
  
      const formatDate = (dateString) => {
        return new Date(dateString).toLocaleString();
      };
  
       // Watcher for alldata prop changes
        watch(alldata, async (newVal) => {
            if (hasMounted.value && newVal) {
                getallData();
                await getTaskhistory();
                await getddValue();
            }
        });

        onMounted(async () => {
            hasMounted.value = true; // Set the flag after mount
            getallData();
            await getddValue();
            await getTaskhistory();
        });
        
      return {
        jobId,
        alldatainforamtion,
        showTasks,
        getrsvalue,
        formatDate,
        GetSystemDD,
      };
    },
  });
  </script>
  