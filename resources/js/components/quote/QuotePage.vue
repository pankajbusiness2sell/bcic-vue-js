<template>
    <Header />
    <div class="page-wrapper">
      <div class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="page-header">
              <div class="row align-items-center ">
                <div class="col-md-4">
                  <h3 class="page-title">Create Quote</h3>
                </div>
                <div class="col-md-8 float-end ms-auto">
                  <div class="d-flex title-head">
                    <div class="d-flex align-items-center justify-content-center">
                      <div class="head-icons mb-0">
                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="row">
          <div :class="getSideDataInfo.quoteinfo.length === 0 ? 'col-md-12' : 'col-md-8'" >
            <div class="card">
              <div class="card-header">
                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                  <i class="ti ti-file-invoice"></i>
                </div>
                <h5 class="card-title">  Create Quote </h5>
              </div>
              <!-- <li> <button type="submit" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewquotsModalLg" @click="showEmailQuote(isquote, 0);" >View Quote</button></li> -->
              
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col  mb-3">
                    <label class="form-label">Quote For <span class="text-danger"> * </span></label>
                    <select class="form-select" id="quote_form" v-model="QuoteFormDetails.quote_form">
                      <option value="0">select</option>
                      <option v-for="quotefor in quoteFors" :key="quotefor.id" :value="quotefor.id">{{ quotefor.name }}</option>
                    </select>
                    <span v-if="parentErrors.quote_form" class="error-message">{{ parentErrors.quote_form }}</span>
                  </div>
                  
                  <div class="col mb-3">
                    <label class="form-label">Post Code<span class="text-danger"> * </span></label>
                    <input type="text"  class="form-control"   v-model="QuoteFormDetails.postCode"   @keyup="searchPostCode" @keydown="searchPostCode" placeholder="Enter Suburb or Postcode...">
                     <span v-if="parentErrors.postCode" class="error-message">{{ parentErrors.postCode }}</span>

                        <ul v-if="filteredPostCode.length > 0" class="bcic_searchfilter">
                          <li  v-for="item in filteredPostCode" :key="item.id"  @click="getSiteId(item.suburb , item.site_id)">
                            {{ item.suburb }} - {{ item.postcode }}
                          </li>
                        </ul>
                        

                  </div>
  
                  <div class="col mb-3">
                    <label class="form-label">Site Id <span class="text-danger"> * </span></label>
                    <select class="form-select" name="sitesid" v-model="QuoteFormDetails.sitesid" >
                      <option value="0">Select</option>
                      <option  v-for="sitesVal in SitesLocation" :key="sitesVal.id" :value="sitesVal.id">{{ sitesVal.name }}</option>
                    </select>
                    <span v-if="parentErrors.sitesid" class="error-message">{{ parentErrors.sitesid }}</span>
                  </div>

                  <div class="col mb-3">
                    <label class="form-label">Job Date </label>
                    <input type="date" id="booking_date" v-model="QuoteFormDetails.booking_date" name="booking_date" class="form-control">
                    <span v-if="errorSaveQuote.booking_date" class="error-message">{{ errorSaveQuote.booking_date }}</span>
                  </div>
                 
                  <div class="col mb-3">
                    <!-- <button type="submit" class="btn btn-primary bcic_btns"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"  @click="fetchAvailabilityData()" aria-controls="offcanvasRight">Check Availability</button> -->
                    <button type="submit" class="btn btn-primary bcic_btns"  @click="fetchAvailabilityData()">Check Availability</button>
                  </div>
                </div>
              </div>
              <br>


              <div class="card-header">
                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                  <i class="ti ti-briefcase"></i>
                </div>
                <h5 class="card-title">  Select Job Details</h5>
              </div>

              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-md-3 mb-3">
                      <label class="form-label">Job Type ID </label>
                      <select class="form-select" id="bcic_reference_type" v-model="selectedOption">
                        <option value="0" selected>Select</option>
                        <option  v-for="jobinfo in jobtype" :key="jobinfo.id" :value="jobinfo.id">{{ jobinfo.name }}</option>
                      </select>
                    </div>
                 

                    <div class="col-md-3 mb-3"  v-if="selectedOption == 9">
                      <label class="form-label">Others </label>
                      <select class="form-select" id="bcic_reference_type" v-model="selectedsubOption"  @change="getsubJobType">
                        <option value="0" selected>Select</option>
                        <option  v-for="jobinfo in Othersjobtype" :key="jobinfo.id" :value="jobinfo.id">{{ jobinfo.name }}</option>
                      </select>
                    </div>


                </div>
              </div>

              <JobTypeDiv 
                   :jobtypeid="selectedOption" 
                   :newjobid="getNewJobTypeid" 
                   :quopteinfo="QuoteFormDetails" 
                   @errors-updated="handleChildErrors"
                   @getside-data="handleSidedata" 
                   >
              </JobTypeDiv>

            <div class="card-header">
              <h5 class="card-title">Recurring Details</h5> 
            </div>

            <div class="card-body pb-0"> 
              <div class="row">
                <div class="col-6 mb-3">
                  <label class="form-label">Recurring Job <span class="text-danger"> * </span> </label>
                  <select class="form-select" v-model="saveQuote.recurring_job">
                    <option value="0">Select</option>
                    <option value="1">Yes</option>
                    <option value="2" selected>No</option>
                  </select>
                  <span v-if="errorSaveQuote.recurring_job" class="error-message">{{ errorSaveQuote.recurring_job }}</span>
                </div>

                <div class="col-6 mb-3">
                  <label class="form-label">Recurring Type</label>
                  <select class="form-select" v-model="saveQuote.recurring_job_type">
                    <option value="0"  selected>Select</option>
                    <option value="1">Weekly</option>
                    <option value="2">Fortnightly</option>
                    <option value="3">Monthly</option>
                    <option value="4">Quarterly</option>
                    <option value="5">Bi Yearly</option>
                    <option value="5">Yearly</option>
                    <span v-if="errorSaveQuote.recurring_job_type" class="error-message">{{ errorSaveQuote.recurring_job_type }}</span>
                  </select>
                </div>
              </div>
          </div>

          <div class="card-header">
            <h5 class="card-title">Quote Details</h5>
          </div>


          <div class="card-body pb-0">
            <div class="row">
              <div class="col-3 mb-3">
                <label class="form-label">Estimate Status</label>
                <select class="form-select" v-model="saveQuote.estimate_status">
                  <option value="0" >Select</option>
                  <option value="1">No</option>
                  <option value="2">Approved-yes</option>
                  <option value="3">Fixed Price</option>
                </select>
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">White Goods </label>
                <select class="form-select" v-model="saveQuote.white_goods">
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>


              <div class="col-3 mb-3">
                <label class="form-label">Pets on Property</label>
                <select class="form-select" v-model="saveQuote.pets_property">
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>


              <div class="col-3 mb-3">
                <label class="form-label">Do you have any gardening requirements</label>
                <select class="form-select" v-model="saveQuote.is_gardening">
                  <option value="0">Select</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>



              <div class="col-3 mb-3">
                <label class="form-label"> Parking</label>
                <select class="form-select" v-model="saveQuote.parking">
                  <option value="0">Select</option>
                  <option value="1">Free-street Parking</option>
                  <option value="2">Metered-street Parking</option>
                  <option value="3">At The Property</option>
                </select>
              </div>


              <div class="col-3 mb-3">
                <label class="form-label">How long you have lived in the property?</label>
                <select class="form-select" v-model="saveQuote.lived_property">
                  <option value="0">Select</option>
                  <option value="1">6 Months</option>
                  <option value="2">1 Year</option>
                  <option value="3">2 Years</option>
                  <option value="4">3 Years</option>
                  <option value="5">4 Years</option>
                  <option value="5">5+ Years</option>
                </select>
              </div>


              <div class="col-3 mb-3">
                <label class="form-label">Do you need a removal quote</label>
                <select class="form-select" v-model="saveQuote.is_removal_quote">
                  <option value="0">Select</option>
                  <option value="2">Yes</option>
                  <option value="1">No</option>
                </select>
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Would you like a removal quote.?</label>
                <select class="form-select"  v-model="saveQuote.have_removal">
                  <option value="0">Select</option>
                  <option value="2">Booked Elsewhere</option>
                  <option value="3">Moving Themselves</option>
                  <option value="4">Book/quote With Us</option>
                  <option value="5">N/a</option>
                </select>
              </div>


              <div class="col-3 mb-3">
                <label class="form-label">How much Bond are we aiming to secure?</label>
                <select class="form-select" v-model="saveQuote.bond_amiming">
                  <option value="0">Select</option>
                  <option value="1">Upto $1500</option>
                  <option value="2">Upto $2000</option>
                  <option value="3">Upto $3000</option>
                  <option value="4">$3000 +</option>
                </select>
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Client Type</label>
                <select class="form-select" v-model="saveQuote.client_type" @change="showRealEstate()">
                  <option value="0">Select</option>
                  <option value="2">Realestate</option>
                  <option value="1">Landlord</option>
                  <option value="3">Tenant</option>
                </select>
              </div>

            </div>
          </div>

      
          <div class="card-body pb-0"  v-if="realEstateDiv">
            <div class="row">
              <div class="col-3 mb-3">
                <label class="form-label">Agency Name</label>
                <input type="text" class="form-control" placeholder="Enter Agency Name" v-model="saveQuote.agency_name"  >
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Agent Name </label>
                <input type="text" class="form-control" placeholder="Enter Agent Name" v-model="saveQuote.agent_name"  >
              </div>
              
              <div class="col-3 mb-3">
                <label class="form-label">Agent Number</label>
                <input type="text" class="form-control" placeholder="Enter Agent Number" v-model="saveQuote.agent_number"  >
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Agent Email</label>
                <input type="text" class="form-control" placeholder="Enter Agent Email" v-model="saveQuote.agent_email"  >
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Agent LandLine No</label>
                <input type="text" class="form-control" placeholder="Enter Agent LandLine No" v-model="saveQuote.agent_landline_num"  >
              </div>

              <div class="col-3 mb-3">
                <label class="form-label">Agent address </label>
                <input type="text" class="form-control" placeholder="Enter Agent address" v-model="saveQuote.agent_address"  >
              </div>
            </div>
          </div>

              <div class="card-header">
                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                  <i class="ti ti-user-circle"></i>
                </div>
                <h5 class="card-title">  Personal Details</h5>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Name <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control" placeholder="Enter Name" v-model="saveQuote.name" >
                    <span v-if="errorSaveQuote.name" class="error-message">{{ errorSaveQuote.name }}</span>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Phone No <span class="text-danger"> * </span></label> 
                    <input type="text" autocomplete="off" maxlength="10" pattern="[0-9]{10}" required="" title="Please enter 10 digits" @input="validatePhone(evt)" class="form-control" placeholder="Enter Phone No" v-model="saveQuote.phone" >
                    <span v-if="errorSaveQuote.phone" class="error-message">{{ errorSaveQuote.phone }}</span>
                    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
                  </div>

                  <div class="col mb-3">
                    <label class="form-label">Email<span class="text-danger"> * </span></label>
                    <input type="text" class="form-control" placeholder="Enter Email" v-model="saveQuote.email"  >
                    <span v-if="errorSaveQuote.email" class="error-message">{{ errorSaveQuote.email }}</span>
                  </div>

                  <div class="col mb-3">
                    <label class="form-label">Reference </label>
                    <select class="form-select" v-model="saveQuote.job_ref">
                      <option value="0">Select</option>
                      <option value="Phone">Phone</option>
                      <option value="Email">Email</option>
                      <option value="Chat">Chat</option>
                      <option value="Site">Site</option>
                      <option value="Staff">Staff</option>
                      <option value="Realestate">Realestate</option>
                      <option value="BBC App">Bbc App</option>
                    </select>
                    <span v-if="errorSaveQuote.job_ref" class="error-message">{{ errorSaveQuote.job_ref }}</span>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Best time to contact </label>
                    <select class="form-select" v-model="saveQuote.best_time_contact">
                      <option value="">Select</option>
										  <option value="07:30-08:00">07:30-08:00</option>
                      <option value="08:00-08:30">08:00-08:30</option>
                      <option value="08:30-09:00">08:30-09:00</option>
                      <option value="09:00-09:30">09:00-09:30</option>
                      <option value="09:30-10:00">09:30-10:00</option>
                      <option value="10:00-10:30">10:00-10:30</option>
                      <option value="10:30-11:00">10:30-11:00</option>
                      <option value="11:00-11:30">11:00-11:30</option>
                      <option value="11:30-12:00">11:30-12:00</option>
                      <option value="12:00-12:30">12:00-12:30</option>
                      <option value="12:30-13:00">12:30-13:00</option>
                      <option value="13:00-13:30">13:00-13:30</option>
                      <option value="13:30-14:00">13:30-14:00</option>
                      <option value="14:00-14:30">14:00-14:30</option>
                      <option value="14:30-15:00">14:30-15:00</option>
                      <option value="15:00-15:30">15:00-15:30</option>
                      <option value="15:30-16:00">15:30-16:00</option>
                      <option value="16:00-16:30">16:00-16:30</option>
                      <option value="16:30-17:00">16:30-17:00</option>
                      <option value="17:00-17:30">17:00-17:30</option>
                      <option value="17:30-18:00">17:30-18:00</option>	
                    </select>
                  </div>




                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Address </label>
                    <textarea rows="4" cols="4" class="form-control" ref="addressInput"  placeholder="Enter Your Location" v-model="saveQuote.address"></textarea>
                    <input name="lat_long" type="hidden" id="lat_long" v-model="saveQuote.lat_long">
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Comments </label>
                    <textarea rows="4" cols="4" class="form-control" placeholder="Enter Comments Here" v-model="saveQuote.comments"></textarea>
                  </div>
                </div>

              </div>
            </div> 
          </div>

           <!-- <pre>{{  getSideDataInfo.quoteinfo  }}</pre> -->

          <div class="col-md-4" v-if="getSideDataInfo.quoteinfo.length > 0"  >

            <div class="card">
              <div class="card-header">
                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                  <i class="ti ti-file-invoice"></i>
                </div>
                <span style="float: right;padding-left: 49px;color: red;" v-if="sendViewQuoteSMS">Send Email sucessfully</span> 
                
                <h5 class="card-title"> Quote Section</h5>
              </div>
            
              <div class="card-body">
                
                      <div class="bcic_quote_box mb-3"  v-for="datainfo in getSideDataInfo.quoteinfo "  :key="datainfo.id" >
              
                        <div v-if="datainfo.job_type_id == 1"> 
                          <table class="table table-bordered " >
                            <thead>
                              <tr >
                                <th>
                                  <label class="form-label">{{  datainfo.job_type  }}</label>

                                  <select name="quote_auto_custom" :value="datainfo.quote_auto_custom" @change="edit_field($event,'temp_quote_details.quote_auto_custom',datainfo.id)"  class="form-select">
                                    <option value="1" selected="">Auto</option>
                                    <option value="2">Custom</option>
                                  </select>
                                </th>
                    
                                <!-- <th>
                                  <label class="form-label"> OTO</label>
                                  <select :value="datainfo.admin_oto" @change="edit_field($event,'temp_quote_details.admin_oto',datainfo.id)" class="form-select">
                                    <option value="0" selected="">Select</option>
                                    <option value="0" selected="">No</option>
                                    <option value="1">Yes</option>
                                  </select>
                                </th>

                                <th>
                                  <label class="form-label"> OTO Amt Show</label>
                                   <select :value="datainfo.oto_amt_show" @change="edit_field($event,'temp_quote_details.oto_amt_show',datainfo.id)" class="form-select">
                                    <option value="0" selected="">Select</option>
                                    <option value="0" selected="">No</option>
                                    <option value="1">Yes</option>
                                  </select>
                                </th>

                                <th>
                                  <label class="form-label"> OTO Discount:</label>
                                  <input type="text" class="form-control" placeholder="" :value="datainfo.oto_admin_discount" @blur="edit_field($event,'temp_quote_details.oto_admin_discount',datainfo.id)">
                                </th> -->

                                <th>
                                  <label class="form-label"> Hours</label>
                                  <input type="text" class="form-control" placeholder="" :value="datainfo.hours" @blur="edit_field($event,'temp_quote_details.hours',datainfo.id)">
                                </th>
                    
                                <th>
                                  <label class="form-label"> Discount </label>
                                  <input type="text" class="form-control" placeholder="" :value="datainfo.discount" @blur="edit_field($event,'temp_quote_details.discount',datainfo.id)">
                                </th>
                    
                                <th>
                                  <label class="form-label"> Rate </label>
                                  <input type="text" class="form-control" placeholder="" :value="datainfo.rate" @blur="edit_field($event,'temp_quote_details.rate',datainfo.id)">
                                </th>
                    
                                <th>
                                    <label class="form-label"> Total </label>
                                    <input type="text" class="form-control" placeholder="" :value="datainfo.amount" @blur="edit_field($event,'temp_quote_details.amount',datainfo.id)">
                                </th>
                    
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="5">
                                  <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location" @change="edit_field($event,'temp_quote_details.description',datainfo.id)" >{{  datainfo.description  }}</textarea>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="bcic_quote_del">
                            <a @click="removeQuote(datainfo.id , datainfo.temp_quote_id)"  ><i class="ti ti-trash"></i></a>
                          </div>
                        </div>
 
                        <div v-else>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>
                                  <label class="form-label">{{  datainfo.job_type  }}</label>
                                </th>
                    
                                <th>
                                    <label class="form-label"> Total </label>
                                    <input type="text" class="form-control" placeholder="" :value="datainfo.amount">
                                </th>
                    
                              </tr>
                            </thead>  
                            <tbody>
                              <tr>
                                <td colspan="5">
                                  <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location">{{  datainfo.description  }}</textarea>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="bcic_quote_del">
                            <a  @click="removeQuote(datainfo.id,  datainfo.temp_quote_id)" ><i class="ti ti-trash"></i></a>
                          </div>
                        </div>

                      </div>
            
            

            
                <div class="bcic_quote_box mb-3">
            
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="4" >
                          <label class="form-label"> Total </label>
                        </th>
                        <th>
                           <label class="form-label"> 	$ {{  getSideDataInfo.totalAmount  }} </label>
                        </th>
                      </tr>
                    </thead>
                  </table>
                  
                  <button type="submit" class="btn btn-primary mt-3 mb-3" @click="saveQuoteData">Save Quote</button>
                 
                  <div class="bcic_btns_quote_section" v-if="isquote > 0">
                    <ul>
                      <li> <button type="submit" class="btn btn-secondary"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasQuestionquote" @click="showQuoteQue(isquote)" aria-controls="offcanvasQuestionquote">Quote Questions</button></li>
                      <li> <button type="submit" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewquotsModalLg" @click="showEmailQuote(isquote, 0);" >View Quote</button></li>
                      <li> <button type="submit" class="btn btn-success" @click="showEmailQuote(isquote, 1);">Email Quote</button></li>
                      <li> <button type="submit" class="btn btn-success">SMS Quote</button></li>
                      <li> <button type="submit" class="btn btn-danger" @click="quoteLost(isquote);">Lost Quote</button></li>

                      <li> 
                        <select name="quote_auto_custom" class="form-select" @change="edit_field($event,'quote_new.login_id',isquote)" v-model="QuoteAdmin.login_id">
                          <option value="0">Select Admin</option>
                           <option  v-for="(name,adminid) in admindata" :key="adminid" :value="adminid">{{ name.name }}</option>
                        </select>
                      </li>

                      
                        <!-- <li> <button type="submit" class="btn btn-primary">Book Now</button></li> -->
                    </ul>
                  </div>
            
                </div>
              </div>
            </div>
            </div> 

             
        </div>

      </div>
    </div>


    

<div class="bcic_quote_offcanvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">

    <div>
      <h5 class="offcanvas-title" id="offcanvasRightLabel">Quote For : {{ availData.quote_for }}</h5>
      <h5>Site id : {{ availData.site_id }}</h5>
      <p>Total Staff ({{ availData.totalCount }}) available in GC</p>
    </div>
    
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
      <table class="table table-bordered">
        <thead class="table-primary"  v-if="availData.totalCount > 0">
          <tr>
            <th>STAFF</th>
            
              <th v-for="(day, index) in availData.dates" :key="index">
                 <div class="d-flex justify-content-start" >
                  <span class="bcic_visible"></span>
                  <p>{{ day.dateName }}</p>
                </div>
                <p class="bcic_text_sm">{{ day.dayName }}</p>
              </th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td> 
              <p> Info </p>        
           </td>
            <td  v-for="(day, index) in availData.dates" :key="index">
               <p class="bcic_text_info"> Total Jobs => </p>     
               <p class="bcic_text_info"> Avail Staff =>1 </p>        
            </td>
          </tr>


          <tr v-for="(staff,index) in availData.staffTable" :key="staff.id" :style="(index)">
            <td>
              <strong><a :href="'tel:' + staff.mobile">{{ staff.name }}</a></strong>
              <br><span class="text11">{{ (staff.job_types) }}</span>
            </td>
              <td style="background-color: var(--bs-danger-bg-subtle)" 
               v-for="(day, index) in availData.dates" :key="index"  @click="() => getStaffDayInfo(staff.id, day.dayFormate)"
              >
              <pre>{{ getstaffinfo.jobs }}</pre>
            </td>
              
          </tr>

        </tbody>
      </table>




  </div>
</div>

 <div class="bcic_quote_offcanvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasQuestionquote" aria-labelledby="offcanvasQuestionquoteLabel">
    <div class="offcanvas-header">

      <div>
        <h4 class="offcanvas-title" id="offcanvasRightLabel">Quote Questions For : {{  QuoteQuestionData.job_type_id  }}</h4>
        <h6>Quote ID : #{{  QuoteQuestionData.quote_id }}</h6>
      </div>
      
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <QuoteQuestion 
      :quote-questions="QuoteQuestionData.quoteQuestions" 
      :question-ids="QuoteQuestionData.questionIds" 
      @save-questions="handleSaveQuestions" 
    />

  </div>




<!--View Quote Start Here -->
<div class="modal fade" id="viewquotsModalLg"  tabindex="-1" aria-labelledby="viewquotsModalLgLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="viewquotsModalLgLabel">View Quote</h5>
        | <a @click="showEmailQuote(invoiceDetails.details.id , 1)">Send Email</a>
          <span style="float: right;padding-left: 49px;color: red;" v-if="sendViewQuoteSMS">Send Email sucessfully</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

       <ViewInvoice :invoicedetails="invoiceDetails" ></ViewInvoice> 
     
    </div>
  </div>
</div>
<!-- <div>{{ invoiceDetails }}</div> -->

  
</template>


<script setup>

    import { ref , onMounted ,computed ,nextTick  } from 'vue'; // Import necessary functions
    import axios from 'axios'; // Import Axios
    import JobTypeDiv from './JobTypeDiv.vue'; // Import necessary functions
    import QuoteQuestion from './QuoteQuestion.vue';
    import ViewInvoice from './ViewInvoice.vue';
    import Header from './../Header.vue';
    import Swal from 'sweetalert2'

    
    
    const loading = ref(true);
    const error = ref(null);
    const sendViewQuoteSMS = ref(false);
    const realEstateDiv = ref(false);

    const invoiceDetails = ref({
       details :[],
       jobDecData:[],
       checkQUotetype:[],
       invoiceDetailshtml:'',
       getemailNotes:''

    });

    //const postCode = ref('');
    const sitesid = ref(0);
    const selectedsubOption = ref(9);
    const filteredPostCode = ref([]);


    const SitesLocation = ref([]);
    const quoteFors = ref([]);
    const jobtype = ref([]);
    const Othersjobtype = ref([]);
    

    const imageUrl = ref('/assets/img/bcic-logo.png');
    const selectedOption = ref(0); // Default to option1
    const getNewJobTypeid = ref(0); 

    const isquote = ref(0); // Default to option1

    const errorMessage = ref('');
    const addressInput = ref(null);
    const loadScript = (src, onLoad) => {
      const script = document.createElement('script');
      script.src = src;
      script.defer = true;
      script.async = true;
      script.onload = onLoad;
      document.head.appendChild(script);
    };

    const initializeAutocomplete = () => {
      nextTick(() => {

        if (!addressInput.value || !(addressInput.value instanceof HTMLTextAreaElement)) {
          console.error("Input element not found or not an instance of HTMLInputElement.");
          return;
        }


      const options = {
          componentRestrictions: { country: 'au' },
      };

      const places = new google.maps.places.Autocomplete(addressInput.value, options);

      google.maps.event.addListener(places, 'place_changed', () => {
        const place = places.getPlace();
        if (place.geometry) {
          const address = place.formatted_address;
          const latitude = place.geometry.location.lat();
          const longitude = place.geometry.location.lng();
          const message = `Address: ${address}\nLatitude: ${latitude}\nLongitude: ${longitude}`;


          saveQuote.value.address = address;
          saveQuote.value.lat_long = `${latitude}__${longitude}`;
        }else{
          console.error("No geometry for the selected place.");
        }

       });
      });
    };

      const validatePhone = () => {
        const phonePattern = /^[0-9\s]*$/;
        if (!phonePattern.test(saveQuote.value.phone)) {
          errorMessage.value = 'Only integer values and spaces are not allowed';
        } else {
          errorMessage.value = '';
        }
      };


      const saveQuote = ref({
              quotefor:1,
              postCode:'',
              sitesid:0,
              booking_date:'',
              name :'',
              phone :'',
              email :'quote@bcic.com.au',
              job_ref :'Phone',
              best_time_contact:'',
              address :'',
              lat_long:'',
              comments :'',
              
              recurring_job :'2',
              recurring_job_type :'0',

              estimate_status :'0',
              is_gardening :'0',
              is_removal_quote :'0',
              white_goods :'0',
              parking :'0',
              have_removal :'0',

              agency_name :'',
              agent_name :'',
              agent_number :'',
              agent_email :'',
              agent_landline_num :'',
              agent_address :'',

              pets_property :'0',
              lived_property :'0',
              bond_amiming :'0',
              client_type :'0',
              _token:''
       });


       const errorSaveQuote = ref({});

         const saveQuoteData = async () => {
            errorSaveQuote.value.booking_date = (QuoteFormDetails.value.booking_date === '' || QuoteFormDetails.value.booking_date === 0) ? 'Please enter Booking Date' : '';
            errorSaveQuote.value.recurring_job = (saveQuote.value.recurring_job === '' || saveQuote.value.recurring_job === 0) ? 'Please select Recurring' 
                : (saveQuote.value.recurring_job == 1 && (saveQuote.value.recurring_job_type === '' || saveQuote.value.recurring_job_type === 0)) ? 'Please select Recurring Type' : '';
            errorSaveQuote.value.name = (saveQuote.value.name === '' || saveQuote.value.name === 0) ? 'Please enter Name' : '';
            errorSaveQuote.value.phone = (saveQuote.value.phone === '' || saveQuote.value.phone === 0) ? 'Please enter phone' : '';
            errorSaveQuote.value.email = (saveQuote.value.email === '' || saveQuote.value.email === 0) ? 'Please enter email' : '';
            errorSaveQuote.value.job_ref = (saveQuote.value.job_ref === '' || saveQuote.value.job_ref === '0') ? 'Please enter job Ref' : '';

            const hasErrors = Object.values(errorSaveQuote.value).some(error => error !== '');
            
            if (hasErrors) {
                console.log(errorSaveQuote.value);
            } else {
                saveQuote.value.quotefor = QuoteFormDetails.value.quote_form;
                saveQuote.value.postCode = QuoteFormDetails.value.postCode;
                saveQuote.value.sitesid = QuoteFormDetails.value.sitesid;
                saveQuote.value.booking_date = QuoteFormDetails.value.booking_date;

                saveQuote.value._token = document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '';
                
                try {
                    const response = await axios.post('/save-quote', saveQuote.value);
                    isquote.value = (response.data.quote_id) ? response.data.quote_id : 0;
                    getAdminData();

                } catch (error) {
                    console.error('Error saving quote:', error);
                    // Handle error response appropriately
                }
            }
         };

    const QuoteFormDetails = ref({
            quote_form: 1,
            postCode: '',
            sitesid:0,
            booking_date:''
    });

    const parentErrors = ref({
                  quote_form: '',
                  postCode: '',
                  sitesid: ''
                }); 

       
    const getSideDataInfo = ref({
       quoteinfo:'',
       totalAmount:0
    }); // Ensure this is an array     


     

    // Async function to search postcode
    async function searchPostCode() {
        

          if(QuoteFormDetails.value.postCode.length > 2) {
            // Example: Perform an API call to fetch post items
            try {
              const response = await axios.get('/api/fetch-post-items', {
                params: {
                  postCode: QuoteFormDetails.value.postCode,
                },
              });

              // console.log(response.data);
              filteredPostCode.value = response.data;
              
            } catch (error) {
              console.error('Error fetching data:', error); // Handle errors appropriately
            }
          }else{
            filteredPostCode.value  = [];
            QuoteFormDetails.value.sitesid = 0;
            parentErrors.value = [];
            // postCode.value = '';
          }
      }

      const getSites = async () => {
        try {
          const response = await axios.get('/api/get-sites');
          SitesLocation.value = response.data;

          //console.log(response.data);

        } catch (err) {
          //error.value = 'Failed to fetch records';
        } finally {
          loading.value = false;
        }
      };

      const getQuoteFor = async () => {
        try {
          const response = await axios.get('/api/quote-for');
          quoteFors.value = response.data;

          //console.log(response.data);

        } catch (err) {
          //error.value = 'Failed to fetch records';
        } finally {
          loading.value = false;
        }
      };
      
      const getjobType = async (data_type) => {
        try {
             const response = await axios.get('/api/job-type', {
                params: {
                  data_type:data_type
                },
              });
          
               if(data_type === 1) {
                jobtype.value = response.data;
               }else if(data_type === 2) {
                 Othersjobtype.value = response.data;
               }
             

          // console.log(response.data);

        } catch (err) {
           error.value = 'Failed to fetch records';
        } finally {
          loading.value = false;
        }
      };  


      const getSiteId = async(suburb , siteid) => {
        QuoteFormDetails.value.sitesid = siteid;
          QuoteFormDetails.value.postCode = suburb;
          filteredPostCode.value  = [];
      };

      const getsubJobType = ()=>{
          //selectedOption.value  = selectedsubOption.value;
          selectedOption.value = 9;
          getNewJobTypeid.value = selectedsubOption.value;
      } 

      const showRealEstate = ()=>{
        
         if(saveQuote.value.client_type == '2') {
          realEstateDiv.value = true;
         }else{
          realEstateDiv.value = false;
         }
          
        // alert(saveQuote.value.client_type);
      } 

       // Method to handle child errors
          const handleChildErrors = (childErrors) => {
            parentErrors.value = { ...childErrors };
          };

          const handleSidedata = (childErrors) => {
               getSideDataInfo.value.quoteinfo =  childErrors.quoteDetailsinfo;
               getSideDataInfo.value.totalAmount =  childErrors.totalAmount;
               selectedOption.value  = 0;
               console.log(getSideDataInfo.value.quoteinfo.length);

          };

        const showEmailQuote = async (quoteid , type) => {
            
             try {
                const response = await axios.get('/view-quote-email', {
                params: {
                  quote_id:quoteid,
                  type:type
                },
              });
                if(type == 0) {
                    sendViewQuoteSMS.value = false;
                    invoiceDetails.value = response.data;
                    console.log(invoiceDetails.value.jobDecData);
                }else{
                    Swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: response.data.message,
                      showConfirmButton: false,
                      timer: 1500
                    });
                }

              } catch (error) {
                console.error('Error unsetting session variables:', error);
              }
        }

        const quoteLost = async (quote_id) => {

              try {
                  const response = await axios.post('/quote-lost', {
                      quote_id: quote_id,
                      _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });
                    Swal.fire({
                      title: "Lost Quote!",
                      text: response.data.message,
                      icon: "success",
                      timer: 1500
                    });
                 
              } catch (error) {
                  console.error('Error Quote Lost:', error);
               }
        }
        
        const admindata = ref({});
        const getAdminData = async () =>{
             try {
                const response = await axios.get('/admin-data');
                admindata.value = response.data;
              } catch (error) {
                console.error('Error In getAdminData:', error);
              }
        }

        //QuoteAdmin.login_id
          const QuoteAdmin = ref({
            login_id:0
          });
        const edit_field = async(event,field_name,quote_id) => {
           
          //if(QuoteAdmin.value.login_id != 0 || QuoteAdmin.value.login_id != null) {
            try {
                   const response = await axios.post('/edit-field' ,
                  {
                     value :  event.target.value,
                     quote_id: quote_id,
                     field_name: field_name,
                    _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                  });

                 

                      if(field_name == 'quote_new.login_id') {
                          QuoteAdmin.value.login_id = response.data.value_id;
                          Swal.fire({
                              title: "Quote Assign",
                              text: response.data.message,
                              icon: "success",
                              timer: 1500
                            });
                      }else{
                          getSideDataInfo.value.quoteinfo =  response.data.tempdetails;
                          getSideDataInfo.value.totalAmount =  response.data.totalAmount;
                      }

              } catch (error) {
                console.error('Error In getAdminData:', error);
              }
          //}
        }


        //getAdminData    
         
            const unsetSessionVariables = async () => {
              try {
                const response = await axios.post('/unset-session-variables');
                //message.value = response.data.message;
                console.log('Session Unset' + response.data);
              } catch (error) {
                console.error('Error unsetting session variables:', error);
              }
            };

               const removeQuote = async (temp_id, temp_quote_id) => {
                  try {
                      // Make the HTTP GET request to delete the temp quote
                      const response = await axios.get('/delete-temp-quote', {
                          params: {
                            temp_id: temp_id,
                            temp_quote_id: temp_quote_id
                          }
                      });

                      // Update the Vue data with the response
                      getSideDataInfo.value.quoteinfo = response.data.tempdetails;
                      getSideDataInfo.value.totalAmount = response.data.totalAmount;

                  } catch (error) {
                      // Handle the error appropriately
                      console.error('Error fetching data:', error);
                      // Optionally, you might want to display a user-friendly message or take other actions
                  }
               };

           const  QuoteQuestionData = ref({
              quoteDetails : {},
              quoteQuestions : [],
              questionIds : [],
              job_type_id: 'Cleaning',
              quote_id:0,
           })


          const showQuoteQue = async (quote_id) =>{
              
                  try {
                    const response = await axios.get('/show-quote-question', {
                          params: {
                            quote_id: quote_id,
                          }
                      });
                      //QuoteQuestionData.value.quoteDetails = response.data.quote_details;
                      QuoteQuestionData.value.questionIds = response.data.question_ids;
                      QuoteQuestionData.value.quoteQuestions = response.data.quote_questions;
                      QuoteQuestionData.value.quote_id = quote_id;

                  } catch (error) { 
                    console.error("There was an error fetching the quote questions:", error);
                  }
              
          }

            const handleSaveQuestions = async (selectedQuestions) => 
            {
                try {
                    const response = await axios.post('/save-quote-question', {
                      quote_id: QuoteQuestionData.value.quote_id,
                      questionids : selectedQuestions,
                      quote_type:1,
                      _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });
                   if(response.data.status == 200) {

                      Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                      });
                   }else{
                     
                    Swal.fire({
                      icon: "info",
                      title: "Information",
                      text: response.data.message,
                      timer: 1500
                    });

                   }
                  // console.log(response.data.status); 

                } catch (error) {
                    console.error('Error saving quote:', error);
                    // Handle error response appropriately
              }
            };

            const availData = ref({
                          dates: [],
                          staffTable: [],
                          totalCount: 0,
                          siteId: 1, // Example site ID
                          suburb: '', // Example suburb
                          siteName: '',
                          siteAbv: '',
                          quoteFor: '',
                          getQuoteId: 1, // Example quote ID
                          getJobTypeId: 1, // Example job type ID
                        });

          const fetchAvailabilityData = async () => {
             
              try {
                  parentErrors.value.quote_form = (QuoteFormDetails.value.quote_form === '' || QuoteFormDetails.value.quote_form === 0) ? 'Please select quote for' : '';
                  errorSaveQuote.value.booking_date = (QuoteFormDetails.value.booking_date === '' || QuoteFormDetails.value.booking_date === 0) ? 'Please enter Booking Date' : '';
                  parentErrors.value.booking_date = (QuoteFormDetails.value.quote_form === '' || QuoteFormDetails.value.quote_form === 0) ? 'Please select quote for' : '';
                  parentErrors.value.postCode = (QuoteFormDetails.value.postCode === '' || QuoteFormDetails.value.postCode === 0) ? 'Please select suburb' : '';
                  parentErrors.value.sitesid = (QuoteFormDetails.value.sitesid === '' || QuoteFormDetails.value.sitesid === 0) ? 'Please select site' : '';

                  let hasErrors = Object.values(errorSaveQuote.value).some(error => error !== '');
                  let hasErrors_new = Object.values(parentErrors.value).some(error => error !== '');
                 // console.log(hasErrors);
            
                if (hasErrors || hasErrors_new) {
                    // console.log(errorSaveQuote.value);
                     console.log(parentErrors.value);
                    return;
                } else {

                  const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasRight'));
                   offcanvas.show();
                   
                    let checkAvailData = {
                          suburb: QuoteFormDetails.value.postCode,
                          site_id: QuoteFormDetails.value.sitesid,
                          booking_date: QuoteFormDetails.value.booking_date,
                          quote_for: QuoteFormDetails.value.quote_form,
                          get_quote_id: (isquote.value != null) ? isquote.value : 0,
                          quote_type: 0,
                          _token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                      };

                      const response = await axios.post('/check-availability', checkAvailData);
                      const data = response.data;
                      availData.value = data;
                      triggerStaffDayInfo();
                      
                  }
              } catch (error) {
                console.error('Error fetching availability data:', error);
              }
            
            };

             const getstaffinfo = ref({
              jobs:{}
             });
          const getStaffDayInfo = async(staffid, date) => {

              try {
                    const response = await axios.post('/get-staff-avail-check', {
                      staffid: staffid,
                      jobdate : date,
                      _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                    });

                    getstaffinfo.value =response.data.jobs;

                  } catch (error) {
                    console.error('Error saving quote:', error);
              }
          }  

          const triggerStaffDayInfo = () => {
            console.log('Triggering Staff Day Info');
            if (availData.value.staffTable.length > 0 && availData.value.dates.length > 0) {
                
                availData.value.staffTable.forEach(staff => {
                  availData.value.dates.forEach(day => {
                    console.log(`Calling getStaffDayInfo with Staff ID: ${staff.id}, Date: ${day.dayFormate}`);
                    //const sdateStaff = new Date(day.dateName).toISOString().split('T')[0];
                    getStaffDayInfo(staff.id, day.dayFormate);
                    
                  });
                });
            }
          };
       
      onMounted(() => {
          getSites();
          getQuoteFor();
          getjobType(1);
          getjobType(2);
          unsetSessionVariables();
          loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyCv5vccl4KbWqhSkA-fBEsX9fWu1htpjEs&libraries=places', () => {
            initializeAutocomplete();
          });
      });

</script>

<style scoped>
.error-message {
  color: red;
}
</style>
