<!-- src/components/Header.vue -->
<template>
  <OperationHeader></OperationHeader>
  </template>
  
  <script>
  import OperationHeader from '@/header/Operation.vue';
  export default {
    name: 'Header',
    components: {
        OperationHeader,
    },
  };
  </script>
  
  <style scoped>
  /* Add your header styles here */
  .systemetec-header {
    background-color: #f8f9fa;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
  }
  </style>
  