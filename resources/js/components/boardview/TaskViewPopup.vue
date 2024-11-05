<template>
    <div class="all_task_view list-view-qc">

        <!-- <pre>{{  trackRecord  }}</pre> -->

      <table class="table table-bordered">
        <thead class="table-primary">
          <tr>
            <th><i class="ti ti-notes"></i> Task Name</th>
            <!-- Iterate through trackName to create table headers -->
            <th v-for="(trackname, trackKey) in trackName" :key="trackKey">
              <i class="ti ti-clock-record"></i> {{ trackname }}
            </th>
          </tr>
        </thead>
        <tbody>
          <!-- Iterate through trackids to create table rows -->
          <tr v-for="(trackid, trackKeyparent) in trackids" :key="trackKeyparent">
            <th>{{ trackid }}</th>
            <!-- Iterate through trackName again to create columns within each row -->
            <td v-for="(trackname, trackKey) in trackName" :key="trackKey">
              <!-- Safely access nested properties with optional chaining -->
              {{ trackRecord[trackKeyparent]?.[trackKey]?.length || '' }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

<script setup>
import { ref } from 'vue'; 

// Define props
const props = defineProps({
    trackids: {
        type: Object,
        required: true,
    },
    trackName:{
        type:Object,
        required:true,
    },
    trackRecord:{
        type:Object,
        required:true,
    }
});

// Assign the props to a ref if you need to modify it locally
//const trackids = ref(props.trackids);

// Now you can use `trackids.value` for any operations or to display the data
</script>