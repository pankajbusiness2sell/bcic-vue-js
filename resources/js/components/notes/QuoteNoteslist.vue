<template>
    
    <div class="vq_message_list">

      <div class="vq_message_q_box mb-2" v-for="note in comments" :key="note.id">
        <span v-html="note.heading"></span>
        <p v-html="note.comment"></p>
        <div class="vq_message_f d-flex justify-content-between">
            <span><i class="ti ti-user-square-rounded"></i> By {{ note.staff_name }}</span>
            <span><i class="ti ti-calendar-dot"></i> {{ note.createdOn }} </span>
        </div>
    </div>
  </div>

  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps({
    comments: {
      type: Array,
      required: false
    }
  });
  </script>
  