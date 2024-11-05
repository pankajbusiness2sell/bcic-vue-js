<template>
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
         <!-- <pre>{{  popupInfo }}</pre> -->
         <!-- <pre>ans_date {{  formattedData }}</pre> -->
         <!-- <pre>{{  gettodate }}</pre> -->
         
          <div class="modal-header">
            <div class="modal_head_text">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                <b>{{ formattedData.pagetype }}</b> :  {{ formattedData.name }} Info ( {{  formattedId  }} )</h1>
                <span ><i class="ti ti-calendar-time"></i> {{ formattedData.fallow_date_time }}</span>
              </div>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
            <!-- <p class="modal-title fs-6 m-1" v-if="formattedData.pageid == 6">
                <span v-html="formattedData.comment"></span>
            </p> -->

            <div class="modal-body" v-if="shouldShowModalwithTop">

               <ul class="nav nav-tabs wizard" id="myTab" role="tablist" >
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"  role="tab" aria-controls="home-tab-pane" aria-selected="true">
                            <span class="nmbr">1</span>Customer Details
                        </a>
                    </li>


                    <li class="nav-item" role="presentation" v-if="chckSMSPermision">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"  role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                            <span class="nmbr" >2</span> SMS
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                            <span class="nmbr">3</span> Email
                        </a>
                    </li>
        
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" role="tab" aria-controls="notes-tab-pane" aria-selected="false">
                            <span class="nmbr">4</span> Notes
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="callshedule-tab" data-bs-toggle="tab" data-bs-target="#callshedule-tab-pane" role="tab" aria-controls="callshedule-tab-pane" aria-selected="false">
                            <span class="nmbr">5</span> Call Schedule
                        </a>
                    </li>
    
                </ul>


                <div class="tab-content" id="myTabContent">
                   
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    
                    <!--Customer Details Section Start Here-->
                            <div class="tab_cus_details">
    
                                <div class="vq_cus_details">
                                    <div class="d-flex justify-content-between">
                                            <div class="users-profile p-3">
                                                    <div class="avatar">
                                                       {{  formattedData.shortName || ''  }}
                                                    </div>
                                                    <div class="name-user">
                                                        <h6 class="mb-1"><a href="javascript:void(0);">  {{ formattedData.name }} </a></h6>
                                                        <div class="bcic_viewquote-detail">
                                                            <ul class="d-flex justify-content-start" >
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Email">
                                                                    <span ><i class="ti ti-mail"></i></span>
                                                                    <span><a href="javascript:void(0);">{{ formattedData.email }}</a></span>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Suburb">
                                                                    <span><i class="ti ti-circle-dot"></i></span>
                                                                    <span>{{ formattedData.site_name }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                            </div>
    
    
                                            <div>
                                                <div class=" vq-call-details">
                                                    <a class="d-flex justify-content-start " href="javascript:void(0);">
                                                        <div class="bv_icon">
                                                            <i class="ti ti-phone-call"></i>
                                                        </div>
    
                                                        <div class="bv_details">
                                                            <span>Call US Now</span>
                                                            <p> {{ formattedData.phone }} </p>
                                                        </div>
                                                    </a>
                                                </div>
    
                                            </div>
    
                                    </div>
                                </div>
    
    
    
    
                                <ul class=" vq_btn-list" >
    
                                    <li>
                                        <div class="d-flex justify-content-start users-profile">
                                            <div class="bv_icon">
                                                <i class="ti ti-id"></i>
                                            </div>
    
                                            <div class="bv_details">
                                                <span> {{  getidsType(formattedId.split('#')[0])  }}</span>
                                                <p> {{  formattedId.split('#')[1]  }} </p>
                                            </div>
                                        </div>
    
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-start users-profile">
                                            <div class="bv_icon">
                                                <i class="ti ti-calendar-time"></i>
                                            </div>
    
                                            <div class="bv_details" v-if="formattedData.pageid == 3">
                                                <span>Created date</span>
                                                <p>{{ formattedData.booked_date }}</p>
                                            </div>

                                            <div class="bv_details" v-if="formattedData.pageid == 1 || formattedData.pageid == 6">
                                                <span>Booking date</span>
                                                <p>{{ formattedData.booked_date }}</p>
                                            </div>

                                        </div>
                                    </li>
     
                                   
                                    <li v-if="formattedData.pageid == 1  || formattedData.pageid == 6">
                                        <div class="d-flex justify-content-start users-profile">
                                            <div class="bv_icon">
                                                <i class="ti ti-currency-dollar"></i>
                                            </div>
    
                                            <div class="bv_details" >
                                                <span>Amount</span>
                                                <p> $ {{  formattedData.amount }} </p>
                                            </div>
                                        </div>
                                    </li>
    
                                </ul>
                            </div>
                    <!--Customer Details Section End Here-->
                    </div>

                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!--sms Section Start Here-->
                                <div class="tab_sms"  v-if="formattedData.pageid == 3">
        
                                    <div class="btn-list vq_sms_btn">
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 1}]" @click="gethrSMS(4,18,1)"><i class="ti ti-device-mobile-message"></i>  SMS NA</button>
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 2}]" @click="gethrSMS(5,19,2)"><i class="ti ti-device-mobile-message"></i> SMS NA2</button>
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 3}]" @click="gethrSMS(6,20,3)"><i class="ti ti-device-mobile-message"></i>  SMS Lost</button>
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 4}]" @click="gethrSMS(11,21,4)"><i class="ti ti-device-mobile-message"></i>  1st Docs</button>
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 5}]" @click="gethrSMS(12,22,5)"><i class="ti ti-device-mobile-message"></i> 2nd Docs</button>
                                        <button type="button" :class="['btn', 'btn-primary', { 'active': formattedData.activehrClass !== null && formattedData.activehrClass === 6}]" @click="gethrSMS(14,23,6)"><i class="ti ti-device-mobile-message"></i>  Fallow up </button>
                                    </div>


                                    <div class="row">
                                      <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" v-model="formattedData.phone"/>
                                        <span v-if="hrSMSerrors.phone" class="error">{{ hrSMSerrors.phone }}</span>
                                     </div>
  
                                      <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control"  placeholder="Please select sms type" v-model="formattedData.subject"/>
                                        <span v-if="hrSMSerrors.subject" class="error">{{ hrSMSerrors.subject }}</span>
                                      </div>
                                    </div>

                                    <div class="col mb-3">
                                      <textarea rows="4" cols="4"  class="form-control" placeholder="Type Message Here" >{{ formattedData.hr_sms_contect }}</textarea>
                                      <span v-if="hrSMSerrors.hr_sms_contect" class="error">{{ hrSMSerrors.hr_sms_contect }}</span>
                                   </div>
                                   <div class="col mb-3">
                                    <button type="button"  class="btn btn-primary btn-sm" @click="sendhrSMS">Send </button>
                                   </div>
                                 

                                </div>

                                <div class="tab_sms"  v-if="formattedData.pageid == 1">
                                    <div class="btn-list vq_sms_btn">
                                       <!-- {{  appendSMS }} -->
                                        <button
                                          type="button"
                                          @click="fetchSalesSms(1)"
                                          :class="['btn', 'btn-primary', { 'active': appendSMS.activeButton !== null && appendSMS.activeButton === 1}]"
                                        >
                                          <i class="ti ti-device-mobile-message"></i> SMS 1
                                        </button>
                                        <button
                                          type="button"
                                          @click="fetchSalesSms(2)"
                                          :class="['btn', 'btn-primary', { 'active': appendSMS.activeButton !== null && appendSMS.activeButton === 2 }]"
                                        >
                                          <i class="ti ti-device-mobile-message"></i> SMS 2
                                        </button>
                                        <button
                                          type="button"
                                          @click="fetchSalesSms(3)"
                                          :class="['btn', 'btn-primary', { 'active': appendSMS.activeButton !== null && appendSMS.activeButton === 3 }]"
                                        >
                                          <i class="ti ti-device-mobile-message"></i> SMS 3
                                        </button>
                                    </div>
         
                                    <div class="col mb-3">
                                        <textarea rows="4" cols="4"  class="form-control" placeholder="Type Message Here" >{{  appendSMS.message  }}</textarea>
                                    </div>
                                </div>

                            <!--sms Section End Here-->
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
        
                        <!--Email Section Start Here-->
                                <div class="tab_sms vq_sms_btn">
        
                                    <div class="btn-list" v-if="formattedData.pageid == 3">
                                        <button type="button" class="btn btn-primary" :class="['btn', 'btn-primary', { 'active': hrEmailText.activehrClass !== null && hrEmailText.activehrClass === 1}]"  @click="hremailtpl(1,16,1)" ><i class="ti ti-mail"></i> Send First Email</button>
                                        <button type="button" class="btn btn-primary" :class="['btn', 'btn-primary', { 'active': hrEmailText.activehrClass !== null && hrEmailText.activehrClass === 2}]" @click="hremailtpl(2,16,2)"> <i class="ti ti-mail"></i> Doc Email</button>
                                        <button type="button" class="btn btn-primary" :class="['btn', 'btn-primary', { 'active': hrEmailText.activehrClass !== null && hrEmailText.activehrClass === 3}]" @click="hremailtpl(3,15,3)"> <i class="ti ti-mail"></i> Welcome Email</button>
                                       
                                    </div>
                                    <div class="btn-list" v-if="formattedData.pageid == 1">
                                        <button type="button" class="btn btn-primary" @click="salesEmail(4 , 'first email')"><i class="ti ti-mail"></i>Email 1</button>
                                        <button type="button" class="btn btn-primary" @click="salesEmail(5, 'second email')"> <i class="ti ti-mail"></i>Email 2 </button>
                                    </div>

                                    <div class="btn-list" v-if="formattedData.pageid == 4">
                                      <button type="button" v-if="formattedData.voucher_email === '0000-00-00 00:00:00'" class="btn btn-primary" @click="sendfeedBackMail(2)"><i class="ti ti-mail"></i>Voucher Call</button>

                                        <button type="button" v-if="formattedData.voucher_email !== '0000-00-00 00:00:00'" @click="checkIscalled('Voucher Call')"  class="btn btn-primary btn-sm">
                                          <i class="ti ti-mail"></i>Voucher Call
                                          <i class="ti ti-check"></i>
                                        </button>
                                      

                                      <button type="button" v-if="formattedData.feedback_email === '0000-00-00 00:00:00'"  class="btn btn-primary" @click="sendfeedBackMail(1)"> <i class="ti ti-mail"></i>FeedBack Email</button>
                                        <button type="button" v-if="formattedData.feedback_email !== '0000-00-00 00:00:00'"  @click="checkIscalled('FeedBack Email')"  class="btn btn-primary btn-sm">
                                          <i class="ti ti-mail"></i>FeedBack Call 
                                          <i class="ti ti-check"></i>
                                        </button>
                                   </div>

                                   
                                    <div v-if="formattedData.pageid == 3">

                                      <div class="row">
                                        <div class="col-md-6 mb-2">
                                          <input type="text" class="form-control" v-model="formattedData.email"/>
                                          <!-- <span v-if="hrSMSerrors.phone" class="error">{{ hrSMSerrors.phone }}</span> -->
                                       </div>
    
                                        <div class="col-md-6 mb-2">
                                          <input type="text" class="form-control"  placeholder="Please select sms type" v-model="hrEmailText.subject"/>
                                          <!-- <span v-if="hrSMSerrors.subject" class="error">{{ hrSMSerrors.subject }}</span> -->
                                        </div>
                                      </div>
  
                                      <div class="col mb-3">
                                          <editor
                                          api-key="qxvh3wmd1wmhkhx3qj4e8frjhiihd9cvs418wnzdeg91e51h"
                                          id="basic-example"
                                          :init="editorOptions"
                                          v-model="hrEmailText.messagetext"
                                        ></editor>
                                      </div>

                                       <div class="col mb-3">
                                           <button type="button" class="btn btn-primary btn-sm" @click="sendhrEmail">Send </button>
                                       </div>
                                          
                                    </div>

                                   
                                   
                                </div>
                            <!--Email Section End Here-->
        
                    </div>
        
                    <div class="tab-pane fade" id="notes-tab-pane" role="tabpanel" aria-labelledby="notes-tab" tabindex="0">
        
                            <!--Email Section Start Here-->
                                <div class="bv_tab_notes">
                                    <h5 class="pb-2">Notes <span>{{  notesCount || 0 }}</span> </h5>

                                    <div class="bv_notes" v-if="notesCount > 0" v-for="(valueData, indexKey) in notesData" :Key="indexKey">
                                        <div class="d-flex justify-content-between bv_notes_box">
                                            <span>
                                                <i class="ti ti-note"></i> {{ valueData.comments || valueData.heading   }} 
                                            </span>
        
                                            <span>
                                                <i class="ti ti-calendar-time"></i>{{ valueData.created_date }}
                                            </span>
                                        </div>
                                        <!-- <p>{{ valueData.comments || ''  }}</p> -->
                                    </div>

                                    <div v-else class="d-flex justify-content-between bv_notes_box">
                                       No Record found
                                    </div>
                                </div>
                            <!--Email Section End Here-->
                    </div>

                    <div class="tab-pane fade" id="callshedule-tab-pane" role="tabpanel" aria-labelledby="callshedule-tab" tabindex="0">
         
                        <div class="call_type_btns ">
                            <ul>
                                <li><button type="button" @click="buttonClick(formattedData.id, 'ans_date',formattedData.pageid)" class="btn btn-success">Answered</button>
                                      <span v-if="formattedData.ans_date !== '0000-00-00 00:00:00' || formattedData.left_sms_date !== '0000-00-00 00:00:00' ">
                                      <span v-if="formattedData.ans_date == '0000-00-00 00:00:00' "><i class="ti ti-square-rounded-x"></i> </span>
                                      <span v-if="formattedData.ans_date != '0000-00-00 00:00:00' "><i class="ti ti-square-rounded-check"></i></span>
                                    </span>
                                </li> 
                                <li><button type="button" @click="buttonClick(formattedData.id, 'left_sms_date',formattedData.pageid)" class="btn btn-danger">Left Message </button>
                                  <span v-if="formattedData.ans_date !== '0000-00-00 00:00:00' ||  formattedData.left_sms_date !== '0000-00-00 00:00:00' ">
                                    <span v-if="formattedData.left_sms_date == '0000-00-00 00:00:00' "><i class="ti ti-square-rounded-x"></i> </span>
                                    <span v-if="formattedData.left_sms_date != '0000-00-00 00:00:00' "><i class="ti ti-square-rounded-check"></i></span>
                                  </span>
                                </li>
                            </ul>
                        </div>

                        <div class="bv_call_schedule">
                            
                            
                            <div class="btn-list" v-if="formattedData.pageid == 4">
                              <h3 class="mb-1">Call </h3>
                                <ul class="not_ans_days">
                                  <li >
                                    <div v-if="formattedData.first_email === '0000-00-00 00:00:00'"> 
                                      <button type="button" @click="buttonClick(formattedData.id, 'ans_date',formattedData.pageid)"  class="btn btn-primary btn-sm">First Call
                                      </button>
                                     </div>
                                    <div v-if="formattedData.first_email !== '0000-00-00 00:00:00'">
                                      <button type="button" @click="checkIscalled('First Call')"  class="btn btn-primary btn-sm">First Call
                                      </button>
                                      <span ><i class="ti ti-check"></i></span>
                                    </div>
                                  </li>
                                  
                                  <li>
                                    <div  v-if="formattedData.second_email === '0000-00-00 00:00:00'">
                                       <button type="button" @click="buttonClick(formattedData.id, 'sec_ans_date',formattedData.pageid)" class="btn btn-primary btn-sm">Second Call</button>
                                    </div>
                                    <div v-if="formattedData.second_email !== '0000-00-00 00:00:00'">
                                      <button type="button" @click="checkIscalled('Second Call')"  class="btn btn-primary btn-sm">Second Call 
                                      </button>
                                      <i class="ti ti-check"></i>
                                    </div>
                                  </li>
                                  
                                  <li > 
                                    <div v-if="formattedData.threed_email === '0000-00-00 00:00:00'"> 
                                      <button type="button" @click="buttonClick(formattedData.id, 'third_ans_date',formattedData.pageid)" class="btn btn-primary btn-sm">Third Call</button>
                                    </div>
                                     <div v-if="formattedData.threed_email !== '0000-00-00 00:00:00'">
                                        <button type="button" @click="checkIscalled('Third Call')"  class="btn btn-primary btn-sm">Third Call 
                                        </button>
                                        <i class="ti ti-check"></i>
                                     </div>
                                  </li>

                                  <li> 
                                    <div> 
                                      <button type="button" @click="doneReview(formattedData.id)" class="btn btn-danger btn-sm">Done</button>
                                    </div>
                                  </li> 

                              </ul> 
                            </div>
  
                            <h3 class="mb-1">Reschedule Call</h3>
                            <ul class="not_ans_days">
                                <li  v-for="(Sbutton, sudKey) in buttonShow" :key="sudKey" >
                                    <div>
                                        <button type="button" class="btn btn-info btn-sm"  @click="callschedule(formattedData.id, formattedData.pageid , sudKey , 1)">
                                            {{ Sbutton  }}</button>
                                    </div>
                                </li>
                            </ul>
        
                            <div class="mt-3">
                                <h3 class="mb-1">When to Call Next</h3>

                                <div class="mb-3 row ">
                                        <div class="col-md-4">
                                            <div>
                                                <label class="form-label">Date<span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" @change="checkValue($event)"  v-model="formattedData.fallow_created_date"  min="" max="" id="start_date_t1">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                <label class="form-label">Hours <span class="text-danger">*</span></label>
                                                <select name="fallow_time" class="form-select" v-model="formattedData.fallow_time">
                                                    <option value="">Select</option>
                                                    <option :value="slotVal" v-for="(slotVal, slotKey) in timeSlot" :key="slotKey" >{{ slotVal }}</option>
                                                </select>
                                        </div>
        
                                        <div class="col-md-2 mt-4">
                                            <button class="btn btn-primary ok_btn"  @click="callschedule(formattedData.id, formattedData.pageid , 0 , 2)">Save</button>
                                        </div>
        
                                </div>
                            </div>
        
                            <div class="mt-3"   v-if="isLostdiv">
                                <h3 class="mb-1">Lost Call</h3>
                                <div class="mb-3 row ">
                                        <div class="col-md-4">
                                            <label class="form-label">Info <span class="text-danger">*</span></label>
                                            <select name="step" class="form-select" v-model="formattedData.lostInfo">
                                                <option value="0">Select</option>
                                                <option :value="lostKey" v-for="(lostvalue, lostKey) in lostVal" :key="lostKey" >{{ lostvalue  }}</option>
                                            </select>
                                        </div>
        
        
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
    
            
            </div>

            <div v-if="shouldShowModal">
              
              <ul class="nav nav-tabs wizard" id="myTab" role="tablist" >

                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="callshedule2-tab" data-bs-toggle="tab" data-bs-target="#callshedule2-tab-pane" role="tab" aria-controls="callshedule2-tab-pane" aria-selected="false">
                    <span class="nmbr">1</span> Call Schedule
                  </a>
                </li>

                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="notes2-tab" data-bs-toggle="tab" data-bs-target="#notes2-tab-pane" role="tab" aria-controls="notes2-tab-pane" aria-selected="false">
                    <span class="nmbr">2</span> Notes
                  </a>
                </li>
              
                
              
              </ul>
              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="notes2-tab-pane" role="tabpanel" aria-labelledby="notes2-tab" tabindex="0">
              
                    <!--Email Section Start Here-->
                    <div class="bv_tab_notes">
                      <h5 class="pb-2">Notes <span>{{  notesCount || 0 }}</span> </h5>

                      <div class="bv_notes" v-if="notesCount > 0" v-for="(valueData, indexKey) in notesData" :Key="indexKey">
                          <div class="d-flex justify-content-between bv_notes_box">
                              <span>
                                  <i class="ti ti-note"></i> {{ valueData.comments || valueData.heading   }} 
                              </span>

                              <span>
                                  <i class="ti ti-calendar-time"></i>{{ valueData.created_date }}
                              </span>
                          </div>
                          <!-- <p>{{ valueData.comments || ''  }}</p> -->
                      </div>

                      <div v-else class="d-flex justify-content-between bv_notes_box">
                         No Record found
                      </div>
                  </div>
                    <!--Email Section End Here-->
                </div>
                
                <div class="tab-pane fade  show active" id="callshedule2-tab-pane" role="tabpanel" aria-labelledby="callshedule2-tab" tabindex="0">
                
                <div class="call_type_btns call_types_re_btns">
                                <ul>
                                  <li><button type="button" @click="buttonClick(formattedData.id, 'ans_date',formattedData.pageid)" class="btn btn-success">Answered</button>
                                      <span><i class="ti ti-square-rounded-x"></i> </span>
                                  </li>
                                  <li><button type="button" @click="buttonClick(formattedData.id, 'left_sms_date',formattedData.pageid)" class="btn btn-danger">Left Message </button>
                                      <span><i class="ti ti-square-rounded-check"></i></span>
                                  </li>
                              </ul>
                              </div>
              
                              <div class="bv_call_schedule">
                                  <h3 class="mb-1">Reschedule Call</h3>
                                  <!-- <pre>{{  buttonShow  }}</pre> -->
                                  <ul class="not_ans_days">
                                      <li  v-for="(Sbutton, sudKey) in buttonShow" :key="sudKey" >
                                          <div>
                                              <button type="button" @click="callschedule(formattedData.id, formattedData.pageid , sudKey , 1)" class="btn btn-info btn-sm" >
                                                  {{ Sbutton  }}</button>
                                          </div>
                                      </li>
                                      
              
                                  </ul>
              
                                  <div class="mt-3">
                                      <h3 class="mb-1">When to Call Next</h3>
              
                                      <div class="mb-3 row ">
                                              <div class="col-md-4">
                                                  <div>
                                                      <label class="form-label">Date<span class="text-danger">*</span></label>
                                                      <input class="form-control" v-model="formattedData.fallow_created_date" @change="checkValue($event)"  type="date"  id="start_date_t1">
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                      <label class="form-label">Hours <span class="text-danger">*</span></label>
                                                      <select name="fallow_time" class="form-select" v-model="formattedData.fallow_time">
                                                          <option value="">Select</option>
                                                          <option :value="slotVal" v-for="(slotVal, slotKey) in timeSlot" :key="slotKey" >{{ slotVal }}</option>
                                                      </select>
                                              </div>
              
                                              <div class="col-md-2 mt-4">
                                                  <button class="btn btn-primary ok_btn" @click="callschedule(formattedData.id, formattedData.pageid , 0 , 2)" >Save</button>
                                              </div>
              
                                      </div>
                                  </div>
                              </div>
                
                </div>
              </div>					

            </div>
        </div>
      </div>

      
</template>

<script>
import { defineComponent, ref, computed, watch, toRef } from 'vue';
import Editor from '@tinymce/tinymce-vue';
import axios from 'axios';
import Swal from 'sweetalert2'

//console.log(tinymce);

export default defineComponent({
  components: {
    editor: Editor,
  },
  props: {
    popupInfo: {
      type: [Object, Array],
      required: false,
      default: () => ({})
    }
  },
  setup(props, { emit }) {
    const getidsType = (params) => {
      const idname = { 'A': 'App ID', 'J': 'Job ID', 'Q': 'Quote ID', 'S': 'Staff ID','N':'Noti'};
      return idname[params];
    };

    const popupInfo = toRef(props, 'popupInfo'); // Convert to ref

    const shouldShowModal = computed(() => {
      const validPageIds = [5, 7, 8, 11, 6, 12, 13, 10];
      return validPageIds.includes(formattedData.value.pageid);
    });

    const shouldShowModalwithTop = computed(() => {
      const validPageIds = [1, 3, 4];
      return validPageIds.includes(formattedData.value.pageid);
    });

    const chckSMSPermision = computed(() =>{
 
      const validPageIds = [4];
      return !validPageIds.includes(formattedData.value.pageid);

    })

    const isLostdiv = computed(() =>{
 
      const validPageIds = [4,6];
      return !validPageIds.includes(formattedData.value.pageid);

     })

    

    const formattedId = computed(() => {
      const { quote_id, job_id, app_id, staff_id, notification_id } = popupInfo.value;
      if (job_id > 0) return `J#${job_id}`;
      if (quote_id > 0) return `Q#${quote_id}`;
      if (app_id > 0) return `A#${app_id}`;
      if (staff_id > 0) return `S#${staff_id}`;
      if (notification_id > 0) return `N#${notification_id}`;
      return '';
    });

     
    const formattedData = ref([]);
    const getdetails = async (pageid , salesid) => {
       
       try {
          const response = await axios.get('/get-popup-details', {
            params: {
              pageid: pageid,
              salesid: salesid
            }
          });
          

            formattedData.value =  alldataInfoNew(response.data);

        } catch (error) {
          console.error('Error fetching notes:', error);
          return [];
        }

    }
   // formattedData
    const alldataInfoNew = (popupInfo) => {

       popupInfo.value = popupInfo;

      const getShortName = (fullName) => {
        return fullName ? fullName.split(' ').map(word => word[0]).join('') : '';
      };

      const baseData = {
        shortName: getShortName(popupInfo.value.name || popupInfo.value.first_name),
        ans_date: popupInfo.value.ans_date || '',
        job_id: popupInfo.value.job_id || 0,
        fallow_date_time: popupInfo.value.fallow_date_time || '',
        left_sms_date: popupInfo.value.left_sms_date || '',
        id: popupInfo.value.id || '',
        email: popupInfo.value.email || '',
        fallow_time: popupInfo.value.fallow_time || '',
        fallow_created_date: popupInfo.value.fallow_created_date || '',
        phone: popupInfo.value.phone || '',
        task_admin_name: popupInfo.value.task_admin_name || '',
        site_name: popupInfo.value.site_name || '',
        heading: popupInfo.value.heading || '',
        pagetype: popupInfo.value.Pagetype || '',
        pageid: parseInt(props.popupInfo.pageid),
        quote_id: popupInfo.value.quote_id || 0,
      };

      switch (parseInt(popupInfo.value.pageid)) {
        case 3:
          return {
            ...baseData,
            name: popupInfo.value.first_name || '',
            booked_date: popupInfo.value.date_started || '',
            lostInfo: popupInfo.value.sutab_unsutab || 0,
            job_types:popupInfo.value.job_types || '',
            app_id:popupInfo.value.app_id || 0,
            subject:'',
            activehrClass:'',
            hr_sms_contect:'',
            flag: false,
            notes: null
          };
        case 1:
          return {
            ...baseData,
            name: popupInfo.value.name || '',
            lostInfo: popupInfo.value.step || 0,
            booked_date: popupInfo.value.jobdate || '',
            amount: popupInfo.value.amount || 0,
            flag: true
          };
        case 6:
          return {
            ...baseData,
            name: popupInfo.value.name || '',
            booked_date: popupInfo.value.jobdate || '',
            comment: popupInfo.value.comment,
            amount: popupInfo.value.amount || 0,
            flag: true
          };
        case 5:
          return {
            ...baseData,
            name: popupInfo.value.name || '',
            lostInfo: popupInfo.value.message_status || 0,
            comment: popupInfo.value.comment || '',
            flag: false
          };
          case 7:
          return {
            ...baseData,
            name: props.popupInfo.name || '',
            lostInfo: props.popupInfo.message_status || 0,
            comment: props.popupInfo.comment || '',
            flag: false
          };
        case 8:
          return {
            ...baseData,
            name: props.popupInfo.name || '',
            lostInfo: props.popupInfo.message_status || 0,
            comment: props.popupInfo.comment || '',
            flag: false
          }; 
        case 10:
          return {
            ...baseData,
            name: props.popupInfo.name || '',
            lostInfo: props.popupInfo.message_status || 0,
            comment: props.popupInfo.comment || '',
            flag: false
          }; 
        case 11:
            return {
                ...baseData,
                name: props.popupInfo.name || '',
                lostInfo: props.popupInfo.message_status || 0,
                comment: props.popupInfo.comment || '',
                flag: false
            };  
        case 12:
            return {
                ...baseData,
                name: props.popupInfo.name || '',
                lostInfo: props.popupInfo.message_status || 0,
                comment: props.popupInfo.comment || '',
                flag: false
            };  
        case 13:
            return {
                ...baseData,
                name: props.popupInfo.name || '',
                lostInfo: props.popupInfo.message_status || 0,
                comment: props.popupInfo.comment || '',
                
                flag: false
            };  
        case 4:
          return {
            ...baseData,
            name: popupInfo.value.name || '',
            lostInfo: popupInfo.value.step || 0,
            first_email: popupInfo.value.first_email || '',
            second_email: popupInfo.value.second_email || '',
            threed_email: popupInfo.value.threed_email || '',
            voucher_email: popupInfo.value.voucher_email || '',
            feedback_email: popupInfo.value.feedback_email || '',
            flag: true
          };
        default:
          return {
            ...baseData,
            name: popupInfo.value.name || '',
            flag: false
          };
      }
    }

    const notesData = ref(null);
    const buttonShow = ref(null);
    const timeSlot = ref([]);
    const lostVal = ref(null);

    watch(
      () => popupInfo.value.pageid,
      async (newPageId) => {
         
         await getdetails(newPageId ,popupInfo.value.id);
        const validPageIds = [3, 1, 5, 4, 7, 8, 6, 11, 12, 13, 10];
        const pageId = parseInt(newPageId);
        if (validPageIds.includes(pageId)) {
          try {
            notesData.value = await getNotes(popupInfo.value.id);
            buttonShow.value = await getNextschedule();
            timeSlot.value = getMinutes('03:00', '21:30');
           // console.log(timeSlot.value);
          } catch (error) {
            console.error('Error fetching data:', error);
          }
        }

        if (pageId === 3) {
 
          try {
            lostVal.value = await getlostdd(38);
          } catch (error) {
            console.error('Error fetching lostdd data:', error);
          }
        } else if (pageId === 1) {
          lostVal.value = popupInfo.value.status;

          setTimeout(async () => {
               await fetchSalesSms(4);
          }, 500);
         
        }
      },
      { deep: true }
    );

    async function getNotes(salesid) {
      try {
        const response = await axios.get('/get-track-notes', {
          params: {
            salesid: salesid,
            tasktype: 1,
            box_type: 1
          }
        });
        return response.data.notes;
      } catch (error) {
        console.error('Error fetching notes:', error);
        return [];
      }
    }

    async function getNextschedule() {
      try {
        const response = await axios.get('/get-next-schedule');
        return response.data;
      } catch (error) {
        console.error('Error fetching next schedule:', error);
        return {};
      }
    }

    async function getlostdd(type) {
      try {
        const response = await axios.get('/get-lost-dd', {
          params: { typeid: type }
        });
        return response.data;
      } catch (error) {
        console.error('Error fetching lostdd data:', error);
        return {};
      }
    }

    function getMinutes(start, end) {
      const minutes = [];
      let currentTime = new Date(`1970-01-01T${start}:00`);
      const endTime = new Date(`1970-01-01T${end}:00`);

      while (currentTime <= endTime) {
        const nextTime = new Date(currentTime.getTime() + 30 * 60000);
        const formatTime = time => time.toTimeString().substr(0, 5);
        minutes.push(`${formatTime(currentTime)}-${formatTime(nextTime)}`);
        currentTime = nextTime;
      }
      return minutes;
    }

    const notesCount = computed(() => Array.isArray(notesData.value) ? notesData.value.length : 0);

    const checkValue = (event) => {
      console.log(event.target.value);
    }

    // watch(
    //   () => popupInfo.value.pageid,
    //   async (newPageId) => {    
    //     console.log('Page ID changed:', newPageId);
    //     // Your logic
    //     console.log('Updated formattedData:', formattedData.value);
    //   }
    // );   

    const callschedule = async(salesid , pageid, schdleid ,shdltype ) => {

       
         try {
            const response = await axios.get('/call-next-schedule', {
              params : {
                salesid : salesid,  
                pageid : pageid,
                schdleid : parseInt(schdleid),
                shdltype:shdltype,
                calldate:formattedData.value.fallow_created_date,
                callTime:formattedData.value.fallow_time,
              }
            }); 
             
            Object.assign(formattedData.value, {
              fallow_date_time: response.data.taskdata.fallow_date_time,
              fallow_created_date: response.data.taskdata.fallow_created_date,
              fallow_time: response.data.taskdata.fallow_time
            });
                 
                customSwal.fire({
                  title: response.data.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
                });


          } catch (error) {
            console.error('Error fetching next schedule:', error);
            return {};
          }
     }

    const buttonClick = async (salesid, fieldname, pageid) => {
      try {
        const response = await axios.get('/ans-left-button', {
          params: {
            salesid: salesid,
            fieldname: fieldname,
            pageid: pageid
          }
        });

        // Ensure reactivity when updating formattedData
        Object.assign(formattedData.value, {
          ans_date: response.data.taskdata.ans_date,
          left_sms_date: response.data.taskdata.left_sms_date,
          fallow_date_time: response.data.taskdata.fallow_date_time,
          second_email: response.data.taskdata.second_email,
          threed_email: response.data.taskdata.threed_email
        });

        //second_email , threed_email
        
           customSwal.fire({
              title: response.data.message,
              icon: 'success',
              iconColor: '#4CAF50',
            });
         //console.log(formattedData.value);

      } catch (error) {
        console.error('Error updating data:', error);
      }
    };

    const checkIscalled = (parms) => {

      const titleShow = `${parms} Already Called!`;
    
      ErrorcustomSwal.fire({
              title: 'Error',
              text: titleShow,
              icon: 'error',
              iconColor: '#FF5722',
              customClass: {
                  // Apply the error-specific class
                  popup: 'custom-swal-popup custom-swal-error'
              }
            });
    }

     const appendSMS = ref({
      message : null,
      message_type : 0,
      activeButton: 1
     });

      const fetchSalesSms = async (smstype) => {

          try {
            let sms_type_id = (smstype === 4) ? 1 : smstype;
            const { data } = await axios.get('/get-sales-sms', {
              params: {
                sms_type_id: sms_type_id,
                quote_id: formattedData.value.quote_id,
                salesid: formattedData.value.id,
                type : 1
              }
            });
            // Ensure appendSMS is properly defined before updating
            if (appendSMS.value) {
              appendSMS.value.message = data.message;
              appendSMS.value.message_type = data.message_type;
              appendSMS.value.activeButton = sms_type_id; // Update activeButton with smstype, not data.message_type

              if (smstype !== 4) {
                copyToClipboard();
              }
            }
          } catch (error) {
            console.error('Failed to fetch SMS:', error);
          }
      }

      // In your component methods
      const copyToClipboard = async () => {
          try {
            await navigator.clipboard.writeText(appendSMS.value.message);
            const titleShow = `SMS ${appendSMS.value.message_type} Copied!`;
            customSwal.fire({
              title: titleShow,
              icon: 'success',
              iconColor: '#4CAF50',
            });
          } catch (error) {
            console.error('Failed to copy text:', error);
            customSwal.fire({
              title: 'Error',
              text: 'Failed to copy text.',
              icon: 'error',
              iconColor: '#FF5722',
            });
          }
      };


        const salesEmail = async(template_id, text) => {

          const { isConfirmed } = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to send the sales '+ text +' email ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, send it!',
                cancelButtonText: 'No, cancel',
                customClass: {
                  popup: 'custom-swal-popup',
                  title: 'custom-swal-title',
                  confirmButton: 'custom-swal-confirm-button',
                  cancelButton: 'custom-swal-cancel-button'
                },
                didOpen: () => {
                  const popup = Swal.getPopup();
                  popup.style.borderRadius = '10px';
                }
              });

              if (!isConfirmed) {
                return; // Exit the function if the user cancels
              }
              
            try {
              const { data } = await axios.get('/get-sales-email', {
                params: {
                  template_id: template_id,
                  quote_id: formattedData.value.quote_id,
                  salesid: formattedData.value.id,
                  type : 2,
                  text : text
                }
              }); 

              customSwal.fire({
                  title: data.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
                });
                
              console.log(data);

            }catch (error) {

            }
        }

        const doneReview = async(id) => {

            const { isConfirmed } = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to done/remove review call.?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, done it!',
                cancelButtonText: 'No, cancel',
                customClass: {
                  popup: 'custom-swal-popup',
                  title: 'custom-swal-title',
                  confirmButton: 'custom-swal-confirm-button',
                  cancelButton: 'custom-swal-cancel-button'
                },
                didOpen: () => {
                  const popup = Swal.getPopup();
                  popup.style.borderRadius = '10px';
                }
              });

              if (!isConfirmed) {
                return; // Exit the function if the user cancels
              }

              const { data } = await axios.get('/done-review-call', {
                  params: {
                    id: id
                  }
              });

              customSwal.fire({
                  title: data.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
                });
        }

        const sendfeedBackMail = async(type) => {

              const response = await axios.get('send-feedbackemail', {
                  params: {
                    type: type, 
                    job_id: formattedData.value.job_id,
                    salesid: formattedData.value.id,

                  }
              });

               // Ensure reactivity when updating formattedData
            Object.assign(formattedData.value, {
              voucher_email: response.data.taskdata.voucher_email,
              feedback_email: response.data.taskdata.feedback_email,
            });

            //second_email , threed_email
            
                customSwal.fire({
                  title: response.data.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
                });
            
               console.log(formattedData.value);
        }
        
        const gethrSMS = async(cleaningtype,removaltype, typeid) => {
           const job_types = formattedData.value.job_types;
           const jobtype =  (job_types.includes('services_removal')) ? 2 : 1;
           //job_types
          const response = await axios.get('get-hr-sms', {
                  params: {
                    cleaningtype: cleaningtype, 
                    removaltype: removaltype, 
                    jobtypeid:jobtype,
                    name: formattedData.value.name,
                    typeid:typeid
                  }
              });
             
              Object.assign(formattedData.value, {
                subject: response.data.subject,
                hr_sms_contect: response.data.comtent,
                activehrClass:typeid
              });

              hrSMSerrors.value.subject = '';
              hrSMSerrors.value.hr_sms_contect = '';
              hrSMSerrors.value.phone = '';
              
              //hr_sms_contect
              console.log(formattedData.value);

        }

        // Reactive state for error messages
      const hrSMSerrors = ref({
        subject: '',
        hr_sms_contect: '',
        phone: ''
      });

        const validate = () => {
          let isValid = true;

          // Reset previous errors
          hrSMSerrors.value.subject = '';
          hrSMSerrors.value.hr_sms_contect = '';
          hrSMSerrors.value.phone = '';

          // Validate Subject
          if (!formattedData.value.subject.trim()) {
            hrSMSerrors.value.subject = 'Subject is required.';
            isValid = false;
          } else if (formattedData.value.subject.length > 100) {
            hrSMSerrors.value.subject = 'Subject must be less than 100 characters.';
            isValid = false;
          }

          // Validate Message Content
          if (!formattedData.value.hr_sms_contect.trim()) {
            hrSMSerrors.value.hr_sms_contect = 'Message content is required.';
            isValid = false;
          } else if (formattedData.value.hr_sms_contect.length > 500) {
            hrSMSerrors.value.hr_sms_contect = 'Message content must be less than 500 characters.';
            isValid = false;
          }

          // Validate Phone Number
          const phone = formattedData.value.phone.trim();
          const phoneRegex = /^[0-9]{10,15}$/; // Adjust the regex as per your requirements
          if (!phone) {
            hrSMSerrors.value.phone = 'Phone number is required.';
            isValid = false;
          } else if (!phoneRegex.test(phone)) {
            hrSMSerrors.value.phone = 'Invalid phone number. It should contain only numbers and be between 10 to 15 digits.';
            isValid = false;
          }

          return isValid;
        };

        const sendhrSMS = async()=> {

           // Perform validation
          if (!validate()) {
            // If validation fails, do not proceed
            return;
          }

           const response = await axios.post('/send-hr-sms' ,
                {
                   subject :  formattedData.value.subject,
                   phone: formattedData.value.phone,
                   message: formattedData.value.hr_sms_contect,
                   salesid:formattedData.value.id,
                   app_id:formattedData.value.app_id,
                    _token : document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                });
             if(response.data.status === 1) {
                customSwal.fire({
                  title: response.data.message,
                  icon: 'success',
                  iconColor: '#4CAF50',
                });
             }
                 
              // console.log(response.data.status);         
       }


       const editorOptions = ref({
              height: 300,
              menubar: false,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
              ],
              toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
              content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });

            
            const hrEmailText = ref({
              subject : '',
              messagetext : '',
              activehrClass:''
            })
         const hremailtpl = async(cleaningtype,removaltype , typeid) => {
               
          const job_types = formattedData.value.job_types;
           const jobtype =  (job_types.includes('services_removal')) ? 2 : 1;
           //job_types
          const response = await axios.get('get-hr-sms', {
                  params: {
                    cleaningtype: cleaningtype, 
                    removaltype: removaltype, 
                    jobtypeid:jobtype,
                    name: formattedData.value.name,
                    typeid:typeid
                  }
              });

              hrEmailText.value.messagetext = `Hello ${formattedData.value.name} ${response.data.comtent}`;
              hrEmailText.value.subject = response.data.subject;
              hrEmailText.value.activehrClass = parseInt(response.data.typeid);

             // console.log(hrEmailText.value);
         }   
          

      // Global SweetAlert2 configuration
    const customSwal = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: '#f9f9f9',
        color: '#333',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
        },
        didOpen: () => {
          const popup = Swal.getPopup();
          popup.style.borderRadius = '10px';
        },
    });

    // Global SweetAlert2 configuration
    const ErrorcustomSwal = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: '#f9f9f9',
        color: '#333',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title-error',
        },
        didOpen: () => {
          const popup = Swal.getPopup();
          popup.style.borderRadius = '10px';
        },
    });

    return {
      buttonClick,
      formattedId,
      formattedData,
      getidsType,
      notesData,
      getNotes,
      notesCount,
      getNextschedule,
      buttonShow,
      getMinutes,
      timeSlot,
      getlostdd,
      lostVal,
      shouldShowModal,
      shouldShowModalwithTop,
      checkValue,
      getdetails,
      alldataInfoNew,
      callschedule,
      fetchSalesSms,
      appendSMS,
      salesEmail,
      chckSMSPermision,
      isLostdiv,
      checkIscalled,
      doneReview,
      sendfeedBackMail,
      gethrSMS,
      sendhrSMS,
      hrSMSerrors,
      editorOptions,
      hremailtpl,
      hrEmailText,

    };
  }
});

</script>
<style scoped>
 .error{
  color: red;
 }
</style>