<template>
    
    <div class="d-flex justify-content-between mail_from_sec">
        <div>
            <ul>
                <li><strong>From:</strong> <span v-html="emailbody.email_fromaddress"></span></li>
                <li><strong>To:</strong> {{  emailbody.email_toaddress }}</li>
                <li v-if="emailbody.bccaddress"><strong>BCC:</strong> {{  emailbody.bccaddress }}</li>
                <li v-if="emailbody.cc_address"><strong>CC:</strong> {{  emailbody.cc_address }}</li>
            </ul>
        </div>

        <div>
            <ul>
                <li><i class="ti ti-calendar-event"></i>  {{ emailbody.email_date }}</li>
            </ul>
        </div>
    </div>

    <div class="mail-form-content" v-html="emailbody.email_body">
                
    </div>

  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps({
    emailbody: {
      type: [Object, Array],
      required: false
    }
  });
  </script>
  