<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <PopupHeader></PopupHeader>
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-checklist"></i>
                                </div>
                                <h5 class="card-title"> View Invoice </h5>
                        </div>

                           <table width="100%" >
                              <tbody>
                                <tr>
                                  <td width="50%" valign="top">
                                    <table>
                                      <tbody>
                                        <tr>
                                          <td><img :src="bciclogo" alt="Logo" width="200"></td>
                                        </tr>
                                        <tr>
                                          <td class="text-danger">Quote</td>
                                        </tr>
                                        <tr>
                                          <td class="text-danger">
                                            Better Removals Pty Ltd <br>
                                            ATF Better Removals Unit Trust <br>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td>
                                            1300 766 422 <br>
                                            mailto:bookings@betterremovals.com.au <br>
                                            https://www.betterremovalistssunshinecoast.com.au
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
                                          <td>Q214657</td>
                                        </tr>
                                        <tr>
                                          <td>Issue Date:</td>
                                          <td>20th Jun 2024</td>
                                        </tr>
                                        <tr>
                                          <td>Job Date</td>
                                          <td>21st Jun 2024</td>
                                        </tr>
                                        <tr>
                                          <td>Amount:</td>
                                          <td>550.00</td>
                                        </tr>
                                        <tr>
                                          <td colspan="2">To
                                            AK
                                            
                                            0123456987 </td>
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
                                <tr>
                                  <td class="bcic_text12">Cleaning: 1 Beds, 1 Study, 1 Bath, 1 Toilet, 1 Living Areas, Furnished , House,1 Venetians , Wall wash service is quoted on the day of the job. This is added to the quote, but the charges will be discussed on the day of the job. Included (1 Balcony, 1 Oven, W</td>
                                  <td class="bcic_text12">550</td>
                                </tr>
                                <tr>
                                  <td class="bcic_text12 text-right">Total</td>
                                  <td class="bcic_text12" >$550</td>
                                </tr>
                               
                              </tbody>
                            </table>
                            <h6 class="pt-3 pb-3">CALL us on <a href="#"> 0290525771 </a> to Save 10% to Book these other services with us</h6>
                            <table width="100%" class="table table-bordered ">
                              <thead>
                                <tr class="table-primary">
                                  <th>Removal</th>
                                  <th>Gardening</th>
                                  <th>Handyman</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="bcic_text12">Mould Cleaning</td>
                                  <td class="bcic_text12">Carpet Steam Cleaning</td>
                                  <td class="bcic_text12">Pest Control</td>
                                </tr>
                                <tr>
                                  <td class="bcic_text12">Professional Blind Wash</td>
                                  <td class="bcic_text12">Carpet Deodoriser</td>
                                  <td class="bcic_text12">Wall Washing</td>
                                </tr>
                                <tr>
                                  <td class="bcic_text12">Outside Window Cleaning</td>
                                  <td class="bcic_text12">Rubbish Removal</td>
                                  <td class="bcic_text12">Pressure Cleaning</td>
                                </tr>
                                <tr>
                                  <td class="bcic_text12">Upholstery Cleaning</td>
                                  <td class="bcic_text12">Grout Cleaning</td>
                                  <td class="bcic_text12">Oil Strain Cleaning</td>
                                </tr>
                              </tbody>
                            </table>
                            <h6 class="pt-3 pb-3">Please Note</h6>
                            <ul class="mail_text_format bg-light-info">
                              <li><strong>Bond cleaning includes, kitchen and oven, bathrooms and laundry, cupboards, fixtures, fittings, doors, floors, tracks, spot cleaning walls, all windows inside and outside where accessible. Please click <a href="https://www.bondcleaning.sydney/end-of-lease-cleaning/" target="_blank">Here</a> for the complete list of inclusions.</strong></li>
                              <li><strong>Please note we require electricity and water at the premises on the cleaning day.</strong></li>
                              <li>This quote is an estimate only based on information provided at the time of quoting. Extra charges may apply on the day pending condition and size of the property when viewed.</li>
                              <li>Blind cleaning, carpets, upholstery and pest control or any other service are not included in the bond cleaning price unless specified in quote. Ceilings and garages are excluded from bond cleaning service.</li>
                              <li>Our bond cleaning guarantee means that we will return free of charge to rectify any issues the managing agent&nbsp; has reported in the exit report based around our Bond Cleaning inclusions within 7 calendar days&nbsp; of the clean. We require a time period of 24 to 48 hours from the time we receive the Agents written exit report to address any problems. Unrestricted access to the property will be required.</li>
                              <li>Parking, Key collection charges, Postponed, cancellation or waiting charges&nbsp; may incur an extra fee if applicable.&nbsp;</li>
                              <li>Payment must be made in full 24hours before the commencement of the clean.&nbsp; If you are paying by direct deposit, please send through your remittance advice and allow 3 working days for bank clearing.&nbsp;</li>
                              <li>By Booking our service you agree to our <a href="https://www.bondcleaning.sydney/terms-and-conditions/" target="_blank">Terms &amp; Conditions</a> that are listed on our website.</li>
                            </ul>
                            
                            <h6 class="pt-3 pb-3" >Payment Options</h6>
                              
                            <table width="100%" border="0" >
                              <tbody>
                                <tr>
                                  <td width="50%" valign="top" bgcolor="#ebebeb" class="bcic_payment_quote" >
                                      <table width="100%" border="0" class="table-bordered ">
                                        <tbody >
                                        <tr>
                                          <td colspan="2">Direct Debit Details</td>
                                        
                                        </tr>
                                        <tr>
                                          <td class="bcic_text12">Account Name:</td>
                                          <td class="bcic_text12">BCIC Pty Ltd ATF the Trustee of BCIC Trust</td>
                                        </tr>
                                        <tr>
                                          <td class="bcic_text12">BSB:</td>
                                          <td class="bcic_text12">014527</td>
                                        </tr>
                                        <tr>
                                          <td class="bcic_text12">Account number:</td>
                                          <td class="bcic_text12">295683522</td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" class="bcic_text12">Please enter your Quote Number ( Q#214657 ) for reference</td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" class="bcic_text12">Please Note : Please make sure that you send us the paid receipt of bank transfer 2 days prior to your Booking Date.</td>
                                        
                                        </tr>
                                        </tbody>
                                      </table>
                                </td>
                    
                    
                                <td width="50%" valign="top" bgcolor="#ebebeb" class="bcic_payment_quote"   >
                                <table width="100%" border="0" class="table-bordered ">
                                  <tbody>
                                  <tr>
                                    <td colspan="2">Credit Card:</td>
                                  </tr>
                                  <tr >
                                    <td colspan="2" class="bcic_text12">To Pay by Card, please call on office number to secure your booking.</td>
                                    
                                  </tr>
                                  <tr> 
                                    <td class="bcic_text12">Office number:</td>
                                    <td class="bcic_text12">0290525771</td>
                                  </tr>
                                  </tbody>
                                </table>
                            
                                
                               </td>
                                </tr>
                              </tbody>
                            </table>
                            
                              
                              
                              




                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { defineComponent, onMounted, reactive, ref } from 'vue'; // Import necessary functions
import { useCommonFunction } from './../../func/function.js';
import PopupHeader from './header/PopupHeader.vue';
import PopupTab from './header/PopupTab.vue';

export default defineComponent({

    components : {
        PopupHeader,
        PopupTab
    },

    setup() { 

         const bciclogo = ref('./assets/img/bcic-logo.png');
        const QueryParms = reactive({
            tab: '',
            job_id: 0
        });

        const getQueryParms = () => {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            console.log('Pankaj test');
            QueryParms.tab = params.get('tab');
            QueryParms.job_id = params.get('job_id');
        };

        const { openNewWindow } = useCommonFunction();

        onMounted(() => {
            getQueryParms(); // Call the function here
        });

        // Other reactive variables or functions can go here

        return {
            openNewWindow,
            getQueryParms,
            QueryParms,
            bciclogo
			
        };
    }
});
</script>
