<template>
       
       <div class="vq_message_list p-3 pt-0">
            <div class="vq_message_q_box mb-2" v-if="comments.length > 0" v-for="note in comments" :key="note.id">
                <span v-html="note.heading"></span>
                <p v-html="note.comment"></p>
                <div class="vq_message_f d-flex justify-content-between">
                    <span><i class="ti ti-user-square-rounded"></i> By {{ note.staff_name }}</span>
                    <span><i class="ti ti-calendar-dot"></i> {{ note.date }} </span>
                </div>
            </div>

            <div v-else class="otd_result_found">
                <img :src="noresultfoundImg" alt="No Result Found"/>
                No Result Found
            </div>
        </div>

  
  </template>
  
  <script setup>
  import { defineProps ,ref } from 'vue';
  const noresultfoundImg = ref('/assets/img/noresultfound.jpg');
  const props = defineProps({
    comments: {
      type: [Object,Array],
      required: false
    }
  });
  </script>
  