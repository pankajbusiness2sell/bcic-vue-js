<template>
  <div class="modal-body">
      
    <table width="100%" >
      <tbody>
        <tr>
          <td width="50%" valign="top">
            <table>
              <tbody>
                <tr>
                  <img :src="imageUrl" alt="Logo" width="200">
                </tr>
                <tr>
                  <td class="text-danger">Quote</td>
                </tr>
                <tr>
                  <td class="text-danger">
                    <span v-html="invoiceDetails.details.company_name_html"></span>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    {{ invoiceDetails.details.site_phone }}<br>
                    {{ invoiceDetails.details.qc_booking_email }}<br>
                    {{ invoiceDetails.details.site_url }}
                  </td>
                </tr>

              </tbody>
            </table>
            

          </td>
          <td width="50%" valign="top">
            <table width="100%" class="table table-bordered ">
              <thead class="table-primary">
                <tr>
                  <th colspan="2">Quote Details</th>
                </tr>
              </thead>
              <tbody>
              
                <tr>
                  <td>Quote Number: </td>
                  <td>Q#{{ invoiceDetails.details.id }}</td>
                </tr>
                <tr>
                  <td>Issue Date:</td>
                  <td>{{ invoiceDetails.details.date }}</td>
                </tr>
                <tr>
                  <td>Job Date</td>
                  <td>{{ invoiceDetails.details.booking_date }}</td>
                </tr>
                <tr>
                  <td>Amount:</td>
                  <td>AUD $ {{ invoiceDetails.details.amount }}</td>
                </tr>
                <tr>
                  <td colspan="2">To
                    <span v-html="invoiceDetails.details.to"></span> 
                  </td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
    <h6 class="pt-3 pb-3" >Items Details</h6>
    <table width="100%" class="table table-bordered ">
      <thead class="table-primary">
        <tr>
          <th> Description </th>
          <th> Amount </th>
        </tr>
      </thead>
      <tbody class="table-secondary">

  
         <!-- <pre>{{  invoiceDetails.jobDecData }}</pre> -->

        <tr v-for="(descinfo, keyJob) in invoiceDetails.jobDecData" :key="descinfo">
          <td class="bcic_text12"><strong>{{ keyJob }} : </strong>  
            <span v-html="descinfo.desc"></span></td>
          <td class="bcic_text12">{{ descinfo.amount }}</td>
        </tr>
        

        <tr>
          <td class="bcic_text12 text-right"><strong>Total</strong></td>
          <td class="bcic_text12" ><strong>$ {{ invoiceDetails.details.amount }}</strong> </td>
        </tr>
      
      </tbody>
    </table>

      <p v-html="invoiceDetails.details.oto_amt_show_text" style="font-size: 12px;font-weight: 600;padding-top: 11px;color: #b01045; "></p>

        <p style="font-size: 17px; font-weight: 600; background-color: #ffffff;">
          Call us on 
          <a :href="'tel:' + invoiceDetails.details.site_phone" style="text-decoration: none; color: #000;">
            {{ invoiceDetails.details.site_phone }}
          </a> 
          to Save 10% by booking these other services with us.
        </p>

    <table width="100%" class="table table-bordered" v-if="invoiceDetails.checkQUotetype.includes(11)">
      <tbody>
        <tr>
          <td style="color:red">Bond Cleaning</td>
          <td style="color:red">Gardening</td>
          <td style="color:red">Domestic Cleaning</td>
        </tr>
        <tr>
          <td>Packaging Service</td>
          <td>Packaging Boxes</td>
          <td>Rubbish Removal</td>
        </tr>
        <tr>
          <td>Piano Moving</td>
          <td>Pool Table Moving</td>
          <td>Heavy Item Moving</td>
        </tr>
        <tr>
          <td>Assembling</td>
          <td>Disassembling</td>
          <td>Removal insurance</td>
        </tr>
      </tbody>
    </table>

    <table width="100%" class="table table-bordered" v-else>
      <tbody>
        <tr>
          <td style="color:red">Removal</td>
          <td style="color:red">Gardening</td>
          <td style="color:red">Handyman</td>
        </tr>
        <tr>
          <td>Mould Cleaning</td>
          <td>Carpet Steam Cleaning</td>
          <td>Pest Control</td>
        </tr>
        <tr>
          <td>Professional Blind Wash</td>
          <td>Carpet Deodoriser</td>
          <td>Wall Washing</td>
        </tr>
        <tr>
          <td>Outside Window Cleaning</td>
          <td>Rubbish Removal</td>
          <td>Pressure Cleaning</td>
        </tr>
        <tr>
          <td>Upholstery Cleaning</td>
          <td>Grout Cleaning</td>
          <td>Oil Stain Cleaning</td>
        </tr>
      </tbody>
    </table>

    <h6 class="pt-3 pb-3">Please Note</h6>
      
      <div v-if="['2', '3', '4'].includes(invoiceDetails.details.step)">
        <div v-if="invoiceDetails.details.ssecret">
          <a :href="invoiceDetails.details.url" style="padding: 6px; text-decoration: none; color: #000; margin-bottom:10px; display: inline-block; border-radius: 4px;">
            <img src="https://www.bcic.com.au/admin/images/book_online.png"/>
          </a>
        </div>
    </div>
      
     <!-- Display content based on the checkQUotetype array -->
     <td colspan="2" align="left" valign="top" bgcolor="#ebebeb" class="mail_text_format">
        <div v-html="invoiceDetails.getemailNotes"></div>
      </td>
      

      
    
    <h6 class="pt-3 pb-3" >Payment Options</h6>
      
      <table width="100%" border="0">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" bgcolor="#ebebeb" class="text12">
              <p><strong>Direct Debit Details</strong></p>
              <table width="100%" border="0" cellpadding="3" cellspacing="3">
                <tr>
                  <td width="32%"><span class="text12">Account Name:</span></td>
                  <td width="68%"><span class="text12"><strong>{{ invoiceDetails.details.qc_company_name }}</strong></span></td>
                </tr>
                <tr>
                  <td><span class="text12">BSB:</span></td>
                  <td><span class="text12"><strong>{{ invoiceDetails.details.qc_bsb }}</strong></span></td>
                </tr>
                <tr>
                  <td><span class="text12">Account number:</span></td>
                  <td><span class="text12"><strong>295683522</strong></span></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <span>Please enter your Quote Number <strong>( Q#{{ invoiceDetails.details.id }} )</strong> for reference</span>
                  </td>
                </tr>
              </table>
              <p>
                Please Note:
                Please make sure that you send us the paid receipt of bank transfer 2 days prior to your Booking Date.<br />
              </p>
            </td>
            <td width="40%" align="left" valign="top" bgcolor="#ebebeb" class="text12">
              <strong>Credit Card:</strong><br /><br />
              <p>To Pay by Card, please call on office number to secure your booking.</p>
              <p><strong>Office number:</strong> {{ invoiceDetails.details.site_phone }}<br /><br /></p>
            </td>
          </tr>
        </tbody>
      </table>

  </div>
</template>


<script setup>
import { ref, onMounted, watch } from 'vue';
const imageUrl = ref('/assets/img/bcic-logo.png');
const props = defineProps({
  invoicedetails: {
    type: Object,
    required: false,
    default: () => [],
  },
});

const invoiceDetails = ref({
       details :[],
       jobDecData:[],
       checkQUotetype:[],
       invoiceDetailshtml:'',
       getemailNotes:''
    });

const setInvoice = () => {
  invoiceDetails.value = props.invoicedetails;
};

// Set invoice details when the component is mounted
onMounted(() => {
  setInvoice();
});

// Watch for changes in the invoicedetails prop
watch(() => props.invoicedetails, (newVal) => {
  invoiceDetails.value = newVal;
});
</script>
