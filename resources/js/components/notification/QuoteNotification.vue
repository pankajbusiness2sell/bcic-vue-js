<!-- Notification.vue -->
<template>
    <div v-if="visible" class="notification">
      <p>{{ message }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  
  const props = defineProps({
    message: {
      type: String,
      required: true,
    },
    duration: {
      type: Number,
      default: 3000,
    },
  });
  
  const visible = ref(true);
  
  // Hide notification after the duration
  setTimeout(() => {
    visible.value = false; 
  }, props.duration);
  </script>
  
  <style scoped>
  .notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4caf50;
    color: white;
    padding: 10px;
    border-radius: 5px;
  }
  </style>
  