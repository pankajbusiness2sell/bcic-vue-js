<template>
    <div class="mt-5 p-3">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="pt-2">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                    <h5 class="card-title text-nowrap">BCIC Email <span class="btn bg-light-info text-info btn-sm">{{ allemails.total_count || '' }}</span></h5>
                                </div>

                                 <!-- <pre>{{  emailtpl  }}</pre> -->
                                <div class="email-header">
                                    <div class="row">

                                        <div class="col-lg-12 top-action-left col-sm-12">
                                            <div class="float-left">

                                                <div class="d-inline-block me-2">
                                                    <button type="button" title="Refresh" data-toggle="tooltip"
                                                    class="btn btn-white d-none d-md-inline-block me-1"><i
                                                        class="fas fa-sync-alt"></i></button>
                                                </div>
                                                <div class="d-inline-block me-2">
                                                    <select class="form-select" v-model="fromEmail.priorty">
                                                        <option value="0">Select</option>
                                                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[53]" :key="indexid">{{ emailtype  }}</option>
                                                    </select>
                                                </div>

                                                <div class="d-inline-block me-2">
                                                    <select class="form-select" v-model="fromEmail.estatus">
                                                        <option value="0">Select</option>
                                                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[51]" :key="indexid">{{ emailtype  }}</option>
                                                    </select>
                                                </div>


                                                <div class="d-inline-block me-2">
                                                    <select class="form-select" v-model="fromEmail.email_category">
                                                        <option value="0">Select</option>
                                                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[50]" :key="indexid">{{ emailtype  }}</option>
                                                    </select>
                                                </div>


                                                <div class="d-inline-block me-2">
                                                    <select class="form-select" v-model="fromEmail.adminid">
                                                        <option value="0">Select</option>
                                                        <option   v-for="(item, index) in adminlist" :value="item.id" :key="index" >{{ item.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group dropdown-action mail-search position-relative d-inline-block me-2">
                                                    <input type="text" placeholder="Search for..."
                                                        v-model="fromEmail.email_search_value"
                                                        class="form-control search-message">
                                                    <div class="search-addon">
                                                        <button type="submit"><i class="ti ti-search"></i></button>
                                                    </div>
                                                </div>

                                                <div class="d-inline-block me-2">
                                                    <button type="submit" class="btn btn-info" @click="searchEmaiList(2)">Search</button>
                                                </div>

                                                <div class="d-inline-block me-2">
                                                    <button type="submit" class="btn btn-danger" @click="ResetsearchEmaiList()" >Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="email_top_btns">
                                         <!-- {{ emailCountbyCate }} -->
                                        <ul>
                                            <li @click="searchEmaiListtab(0)" ><a :class="[fromEmail.email_category === '0' ? ' active' : '']"  href="javascript:void(0);">ALL</a></li>
                                            <li   @click="searchEmaiListtab(index)"  v-for="(emailtype , index ) in GetSystemDD[50]" :key="index"><a 
                                                :class="[fromEmail.email_category === index ? ' active' : '']"   href="javascript:void(0);">{{  emailtype }} <span v-if="emailCountbyCate[index]?.length > 0 ">{{  emailCountbyCate[index]?.length }}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">

                                <div class="col-lg-1 col-md-12">
                                    <div class="compose-btn">
                                        <a href="javascript:void(0);" @click="openCompose" class="btn btn-primary btn-block w-100" data-bs-toggle="modal" data-bs-target="#bcicmailModalXl">
                                            Compose
                                        </a>
                                    </div>
                                    <ul class="inbox-menu">
                                        <li >
                                            <a :class="[fromEmail.folder_type === 'INBOX' ? ' active' : '']" @click="searchEmaiListfolder('INBOX')" href="javascript:void(0);"><i class="fas fa-download"></i> Inbox <span class="mail-count" v-if="getEmailtotal && getEmailtotal.INBOX > 0">( {{ getEmailtotal.INBOX }} )</span></a>
                                        </li>
                                       
                                        <li>
                                            <a :class="[fromEmail.folder_type === 'Sent' ? ' active' : '']" @click="searchEmaiListfolder('Sent')"  href="javascript:void(0);"><i class="far fa-paper-plane"></i> Sent <span class="mail-count" v-if="getEmailtotal && getEmailtotal.Sent > 0">( {{ getEmailtotal.Sent }} )</span></a>
                                        </li>
                                        <li>
                                            <a :class="[fromEmail.folder_type === 'Drafts' ? ' active' : '']" href="javascript:void(0);"><i class="far fa-file-alt"></i> Drafts </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="far fa-trash-alt"></i> Trash</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="far fa-star"></i> Important</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-11 col-md-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="email-content">
                                                <div class="table-responsive" >
                                                    <table class="table table-inbox table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>File</th>
                                                                <th>Date</th>
                                                                <th>Name</th>
                                                                <th>Subject</th>
                                                                <th>Job</th>
                                                                <th>Quote</th>
                                                                <th>Category</th>
                                                                <th>User</th>
                                                                <th>Type</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr 
                                                               v-if="allemails.emaillist.length > 0" 
                                                               v-for="(emails, index) in allemails.emaillist" 
                                                               :class="['clickable-row unread', emails.email_assign === 1 ? ' fw-bold' : '']"   
                                                               :key="index">
                                                                <td data-bs-toggle="offcanvas" data-bs-target="#mailcanvasRight" aria-controls="mailcanvasRight" @click="getemailDetails(emails)">
                                                                    <div class="d-flex justify-content-start">
                                                                        
                                                                        <div class="vq_id">
                                                                            <i  v-if="emails.is_attached" class="ti ti-paperclip"></i>
                                                                             {{  emails.id }}  
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td >
                                                                    <i class="ti ti-calendar-event"></i> {{  (emails.email_date  || emails.createdOn) }}
                                                                </td>
                                                                <td data-bs-toggle="offcanvas" data-bs-target="#mailcanvasRight" aria-controls="mailcanvasRight" @click="getemailDetails(emails)"  style="max-width: 300px;" >
                                                                    {{  emails.email_sender || emails.email_fromaddress }}

                                                                    <!--<div class="mail-dropdown">
                                                                        <button class="mail-dropbtn">{{  emails.email_sender || emails.email_fromaddress }}</button>
                                                                         <div class="mail-dropdown-content">
                                                                            <ul>
                                                                                <li><i class="ti ti-calendar-event"></i> {{  emails.email_date }}</li>
                                                                                <li>
                                                                                    <div class="d-flex justify-content-start">
                                                                                        <label>Priority</label>
                                                                                        <select name="priority" class="form-select">
                                                                                            <option value="0">Select</option>
                                                                                            <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[51]" :key="indexid">{{ emailtype  }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="d-flex justify-content-start">
                                                                                        <label>Status</label>
                                                                                        <select name="priority" class="form-select">
                                                                                            <option value="0">Select</option>
                                                                                            <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[53]" :key="indexid">{{ emailtype  }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div> 
                                                                    </div>-->
                                                                    
                                                                </td>

                                                                <td data-bs-toggle="offcanvas" data-bs-target="#mailcanvasRight" aria-controls="mailcanvasRight"  @click="getemailDetails(emails)" class="subject-old text-truncate" style="max-width: 250px;">
                                                                    {{  emails.email_subject }}
                                                                </td>

                                                                <td >
                                                                    <input  @keypress="isNumberKey"   @blur="updateQuoteJob($event, 'job_id', emails.id, 'Job ID')" v-if="emails.job_id == 0" type="text" class="form-control mail-input" :value="emails.job_id || ''">
                                                                    <div v-else  class="mail-quote btn bg-light-info text-info btn-sm">
                                                                        
                                                                        <a href="javascript:void(0)" 
                                                                        @click="openNewWindow('jobpopup?tab=job_details&job_id=' + emails.job_id,'1500','800')">
                                                                        {{ emails.job_id }} 
                                                                       </a>
                                                                        <span @click="removeemailQJid(1, emails.id);"><i class="ti ti-x"></i></span></div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <input @keypress="isNumberKey"  v-if="emails.quote_id == 0"  @blur="updateQuoteJob($event, 'quote_id', emails.id,'Quote ID')" type="text" class="form-control mail-input" :value="emails.quote_id || ''">
                                                                    <div v-else  class="mail-quote btn bg-light-info text-info btn-sm">{{ emails.quote_id }} <span @click="removeemailQJid(2, emails.id);"><i class="ti ti-x"></i></span></div>
                                                                </td>
                                                                <td>
                                                                    <select name="email_category"   @change="updateEmailval($event, 'email_category', emails.id,'Email Category')" v-model="emails.email_category" class="form-select">
                                                                    <option value="0">Select</option>
                                                                    <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[50]" :key="indexid">{{ emailtype  }}</option>
                                                                  </select>

                                                                </td>
                                                                <td class="eamil-users">
                                                                    <select name="email_category"  @change="updateEmailval($event, 'admin_id', emails.id, 'Admin id')" v-model="emails.admin_id" class="form-select">
                                                                        <option value="0">Select</option>
                                                                        <option  v-for="(item, index) in adminlist" :value="item.id" :key="index" >{{ item.name }}</option>
                                                                  </select>
                                                                </td>    
                                                                <td><span class="btn bg-light-warning text-warning btn-sm">{{ emails.mail_type.toUpperCase() || '' }}</span></td>
                                                                <td class="mail-action">
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle btn bg-light-info" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu" style="" wfd-invisible="true">
                                                                            <a class="dropdown-item text-info p-1" href="javascript:void(0);" > <i class="ti ti-checklist btn bg-light-info text-info btn-sm me-1 "></i> Add Task</a>
                                                                            <a class="dropdown-item text-warning  p-1"> <i class="ti ti-notes btn bg-light-warning btn-sm text-warning me-1"></i> Add Note</a>
                                                                            <a class="dropdown-item text-danger p-1" href="javascript:void(0);"><i class="ti ti-trash btn bg-light-danger text-danger btn-sm me-1"></i> Delete</a>
                                                                        </div>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                            <tr v-else-if="allemails.emaillist.length === 0 && !allemails.loading">
                                                                <td colspan="25">No data found</td> <!-- Display no data found message -->
                                                            </tr>
                                                            <!-- <tr v-else if=allemails.value.loading>
                                                                <td colspan="25">No data found</td>
                                                            </tr> -->
                                                        </tbody>
                                                    </table>
                                                    <div class="load-btn text-center mt-2 mb-3" v-if="allemails.loading">
                                                        <button type="button" class="btn btn-primary"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Mail Popup Design Strat Here-->
    <div class="modal fade" id="bcicmailModalXl" tabindex="-1" aria-labelledby="bcicmailModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="bcicmailModalXlLabel">New Message from</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <!-- {{  emailsignature }} -->
                <div class="modal-body ps-3 pe-3">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Mail Type</label>
                            <select class="form-select" v-model="newEmailform.mail_type">
                                <option value="0">Select</option>
                                <option v-for="emaildata in emailConfiglist"  :key="emaildata.id" :value="emaildata.id">{{  emaildata.email_type }}</option>
                               
                            </select>
                        </div>
                        <!-- <div class="col mb-3">
                            <label class="form-label">Job ID</label>
                            <input type="text" class="form-control" placeholder="Enter Job ID">
                        </div> -->
                        <div class="col mb-3">
                            <label class="form-label">Template Type </label>
                            <select class="form-select" v-model="newEmailform.template_id"  @change="getemaildesc($event, 1)">
                                <option value="0">Select</option>
                                <optgroup v-for="(templates, category) in emailTemplates" :key="category" :label="category">
                                    <option v-for="template in templates" :data-id="category + '_' + template.id" :key="template.id" :value="template.id">
                                        {{ template.heading }}
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- <div class="col mb-3">
                            <label class="form-label">BBC Managment</label>
                            <input type="text" class="form-control" placeholder="BBC Managment">
                        </div> -->

                        <div class="col mb-3">
                            <label for="formFileMultiple" class="form-label">Files Upload</label>
                            <input class="form-control" type="file"  id="compose_file" multiple @change="newhandleFileUpload">
                        </div>


                    </div>
                    <div class="row">

                        <div class="col mb-4">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" v-model="newEmailform.to_emails" placeholder="Please enter to email id">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label">All Active Staff</label>
                            <select name="all_staff" class="form-select" v-model="newEmailform.is_active_staff">
                                <option value="0">Select</option>
                                <option value="1">Yes</option>
                                <option value="2" selected="">No</option>
                            </select>
                        </div>

                        

                        <div class="col mb-3">
                            <label class="form-label">BBC</label>
                            <input type="text" class="form-control" v-model="newEmailform.bcc_email" placeholder="Please enter bcc emails">
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">CC</label>
                            <input type="text" class="form-control" v-model="newEmailform.cc_email" placeholder="Please enter cc emails">
                        </div>

                        
                    </div>
                     <div class="row">
                        <div class="col mb-6">
                            <label class="form-label">Subject</label>
                            <input type="text" v-model="newEmailform.subject_email"  class="form-control" placeholder="Please enter subject">
                        </div>
                    </div>
                     <br/>
                    <div class="row">
                        <div class="col mb-12">
                            <!-- <editor
                                api-key="qxvh3wmd1wmhkhx3qj4e8frjhiihd9cvs418wnzdeg91e51h"
                                id="basic-example"
                                :init="editorOptions"
                                @error="handleError"
                                ></editor> -->
                                <ckeditor
                                :editor="editor"
                                v-model="newEmailform.email_body"
                                :config="editorConfig"
                            />
                        </div>
                    </div>  

                    <div class="text-end mb-4">
                        <button type="submit"  @click="sendNewEmail" class="btn btn-primary bcic_btns me-2">Submit</button>
                        
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Mail Popup Design End Here-->


    <!--Reply Popup Design Strat Here-->
    <div class="modal fade" id="replybcicmailModalXl" tabindex="-1" aria-labelledby="replybcicmailModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="replybcicmailModalXlLabel">Reply Email </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ps-3 pe-3">
                    
                    <div class="row">

                        <div class="col mb-3">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" v-model="forwardemail.email_from" placeholder="Please enter to email">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label">BBC</label>
                            <input type="text" class="form-control" v-model="forwardemail.bccaddress" placeholder="">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label">CC</label>
                            <input type="text" class="form-control" v-model="forwardemail.cc_address" placeholder="">
                        </div>

                        <div class="col mb-3">
                            <label for="formFileMultiple" class="form-label" >Files Upload</label>
                            <input class="form-control" type="file" multiple @change="handleFileUpload"  id="formFileMultiple" >
                        </div>
                    </div>
                    <div class="row">

                     
                        <div class="col mb-3">
                            <label class="form-label">Template Type</label>
                            <select class="form-select" v-model="forwardemail.template_id" @change="getemaildesc($event, 2)">
                                <option value="0">Select</option>
                                <optgroup v-for="(templates, category) in emailTemplates" :key="category" :label="category">
                                    <option v-for="template in templates" :data-id="category + '_' + template.id" :key="template.id" :value="template.id">
                                        {{ template.heading }}
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        

                        <div class="col mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text"  class="form-control" v-model="forwardemail.email_subject" placeholder=" Please enter subject">
                        </div>
                    </div>
                    <div>
                        
                        <ckeditor
                            v-model="forwardemail.email_body"
                            :editor="editor"
                            :config="editorConfig"
                        />
                
                      
                    </div>

                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary bcic_btns me-2" @click="sendreplayEmail(1)">Submit</button>
                        <!-- <button type="submit" class="btn btn-primary bcic_btns">Mailgun Submit</button> -->
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Reply Mail Popup Design End Here-->




    <!--Forward Email Popup Design Strat Here-->
    <div class="modal fade" id="forwardbcicmailModalXl" tabindex="-1" aria-labelledby="forwardbcicmailModalXl" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="forwardbcicmailModalXl">Forward Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ps-3 pe-3">
                    
                    <div class="row">

                        <div class="col mb-3">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" v-model="forwardemail.email_from" placeholder="BBC Managment">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label">BBC</label>
                            <input type="text" class="form-control" v-model="forwardemail.bccaddress" placeholder="">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label">CC</label>
                            <input type="text" class="form-control" v-model="forwardemail.cc_address" placeholder="">
                        </div>

                        <div class="col mb-3">
                            <label for="formFileMultiple" class="form-label">Files Upload</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                    </div>
                    <div class="row">

                     
                    <!-- <div class="col mb-3">
                        <label class="form-label">Template Type </label>
                        <select class="form-select" v-model="forwardemail.template_id" >
                            <option value="0">Select</option>
                            <optgroup v-for="(templates, category) in emailTemplates" :key="category" :label="category">
                            <option v-for="template in templates" :key="template.id" :value="template.id">
                                {{ template.heading }}
                            </option>
                            </optgroup>
                        </select>
                    </div> -->


                        <div class="col mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text"  class="form-control" v-model="forwardemail.email_subject" placeholder=" Please enter subject">
                        </div>
                    </div>
                    <div>
                        
                        <ckeditor
                            v-model="forwardemail.email_body"
                            :editor="editor"
                            :config="editorConfig"
                        />
                
                      
                    </div>

                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-primary bcic_btns me-2" @click="sendreplayEmail(2)">Submit</button>
                        <!-- <button type="submit" class="btn btn-primary bcic_btns">Mailgun Submit</button> -->
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Forward Email Mail Popup Design End Here-->





    <!--Mail Sidepanel Section Design start here-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mailcanvasRight" aria-labelledby="mailcanvasRightLabel">
        <div class="offcanvas-header">

            <!-- <div class="d-flex justify-content-start">
               
                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-light-info text-info btn-sm"> Reclean Ack</button>
                </div>

                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-light-info text-info btn-sm">  Reclean Cleaner Email </button>
                </div>

                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-light-info text-info btn-sm">  Reclean Customers Email</button>
                </div>

                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-light-info text-info btn-sm"> Complaint Reply</button>
                </div>
            </div> -->





            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">


            <div class="d-flex justify-content-start p-3 pt-0">
                <div class="d-inline-block me-1">
                    <button type="submit" class="btn btn-primary"  data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-chevron-left"></i> Back</button>
                </div>

                

                <div class="d-inline-block me-1">
                    <select class="form-select" @change="updateEmailval($event, 'priority', emaildetails.id,'Email priority')" v-model="emaildetails.priority">
                        <option value="0">Select</option>
                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[53]" :key="indexid">{{ emailtype  }}</option>
                    </select>
                </div>

                <div class="d-inline-block me-1">
                    <select class="form-select" @change="updateEmailval($event, 'email_assign', emaildetails.id,'Email Assign')" v-model="emaildetails.email_assign">
                        <option value="0">Select</option>
                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[51]" :key="indexid">{{ emailtype  }}</option>
                    </select>
                </div>

                <div class="d-inline-block me-1">
                    <select class="form-select" @change="updateEmailval($event, 'admin_id', emaildetails.id,'Admin name')" v-model="emaildetails.admin_id">
                        <option value="0">Select</option>
                        <option   v-for="(item, index) in adminlist" :value="item.id" :key="index" >{{ item.name }}</option>
                    </select>
                </div>

                <div class="d-inline-block me-1">
                    <select class="form-select" @change="updateEmailval($event, 'email_category', emaildetails.id,'Email Category')" v-model="emaildetails.email_category">
                        <option value="0">Select</option>
                        <option :value="indexid" v-for="(emailtype , indexid ) in GetSystemDD[50]" :key="indexid">{{ emailtype  }}</option>
                    </select>
                </div>

                <div class="d-inline-block me-1" v-if="emaildetails.id > 0">
                    <button type="submit" class="btn bg-light-success text-success btn-md"> E#{{  emaildetails.id  }}   </button>
                </div>

                <div class="d-inline-block me-1" v-if="emaildetails.job_id > 0">
                    <button type="submit" class="btn bg-light-success text-success btn-md"> J#{{  emaildetails.job_id  }}   </button>
                </div>

                <div class="d-inline-block me-1"  v-if="emaildetails.quote_id > 0">
                    <button type="submit" class="btn bg-light-info text-info btn-md"> Q#{{  emaildetails.quote_id  }}</button>
                </div>

                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-light-danger text-danger btn-md"> Spam</button>
                </div>

                <!-- <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-primary btn-md"> <i class="ti ti-chevron-left"></i></button>
                </div>

                <div class="d-inline-block me-1">
                    <button type="submit" class="btn bg-primary btn-md"> <i class="ti ti-chevron-right"></i></button>
                </div> -->

            </div>
            
            <!--Subject Section Start Here-->
            <div class="d-flex justify-content-between subject_s">
                <h5>Subject: {{  emaildetails.email_subject }}</h5>
                <div class="mail_subject_r">
                    <!-- <div class="d-inline-block me-1">
                        <button type="submit" class="btn bg-primary btn-md">Re-Check</button>
                    </div> -->

                    <div class="d-inline-block me-1">
                        <button type="submit" class="btn bg-primary btn-md"  @click="emailreply(emaildetails,1)" title="Replay" data-bs-toggle="modal" data-bs-target="#replybcicmailModalXl" > 
                            <i class="ti ti-arrow-back-up"></i> </button>
                    </div>
                    
                    <div class="d-inline-block me-1">
                        <button type="submit" class="btn bg-primary btn-md"  @click="emailreply(emaildetails,2)" title="Forward" data-bs-toggle="modal" data-bs-target="#forwardbcicmailModalXl"> 
                            <i class="ti ti-arrow-forward-up" ></i> </button>
                    </div>

                </div>
            </div>
            
            <!--From Section End Here-->.

             <emailDetails  :emailbody="emaildetails"></emailDetails>
             
            <!-- <div class="mail-form-content" v-html="emaildetails.email_body">

                
            </div> -->
            <!--From Content Section End Here-->
             <!-- {{  emaildetails.email_attached  }} -->
            <!--Mail Footer Section Start Here-->
            <div class="mail_footer_sec" v-if="emaildetails.is_attached == true">
                <div class="mail_footer_text"><i class="ti ti-paperclip"></i> 5 attachments</div>
                <div class="mail_attched_list">
                    <ul>
                        <li v-for="(emailAttached, index) in emaildetails.email_attached" :key="index">
                            <template v-if="isImage(emailAttached.email_attach)">
                              <img :src="`./../${emailAttached.email_folder}/${emailAttached.email_attach}`" alt="Image"   @click="openInNewTab(`./../${emailAttached.email_folder}/${emailAttached.email_attach}`)" />
                            </template>
                            <template v-else-if="isDocument(emailAttached.email_attach)">
                              <img :src="mailattachedImg" alt="Document Icon"  @click="openInNewTab(`./../${emailAttached.email_folder}/${emailAttached.email_attach}`)" /> <!-- Replace with your document icon -->
                            </template>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" :id="'checkbox-' + index" />
                              <label class="form-check-label" :for="'checkbox-' + index">
                                {{ emailAttached.date }} <!-- Assuming `emailAttached` has a date property -->
                              </label>
                            </div>
                        </li>

                        <!-- <li>
                            <img :src="mailattachedImg" alt="Image"/>
                            <div class="form-check">

                                <label class="form-check-label" for="flexCheckDefault">
                                    30th Sep
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </li>

                        <li>
                            <img :src="mailattachedImg" alt="Image"/>
                            <div class="form-check">

                                <label class="form-check-label" for="flexCheckDefault">
                                    30th Sep
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </li>

                        <li>
                            <img :src="mailattachedImg" alt="Image"/>
                            <div class="form-check">

                                <label class="form-check-label" for="flexCheckDefault">
                                    30th Sep
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </li>

                        <li>
                            <img :src="mailattachedImg" alt="Image"/>
                            <div class="form-check">

                                <label class="form-check-label" for="flexCheckDefault">
                                    30th Sep
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>



        </div>
    </div>


     <!--Mail Sidepanel Section Design End here-->
</template>

<script>
import { ref, onMounted, onUnmounted, watch } from 'vue';
//import Editor from '@tinymce/tinymce-vue';
import { useCommonFunction } from './../func/function.js';
import emailDetails from './emailDetails.vue';
import axios from 'axios'; // Import Axios for making HTTP requests

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import { email } from '@vuelidate/validators';

// import { CKEditor } from '@ckeditor/ckeditor5-vue';  // Import CKEditor
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'; // Import the Classic Editor build

//import Swal from 'sweetalert2'

export default {
    components: {
       // Editor,
        emailDetails,
        Ckeditor
       // ckeditor: CKEditor, // Register CKEditor component
    },
  setup() {
    const mailattachedImg = ref('../assets/img/attched_image.png');
   
    //const editorData = ref('');
    const editor = ClassicEditor;

    const { sendData, isNumberKey , 
         openNewWindow , getddvaluedata , 
         createCustomSwal, 
         createErrorCustomSwal,
         createConfirm,
         } = useCommonFunction();

    const  customSwal = createCustomSwal();
    const  ErrorcustomSwal = createErrorCustomSwal();

    // State variables
    const GetSystemDD = ref({});
    const adminlist = ref([]);
    const emaildetails = ref({});
    const fromEmail = ref({
      folder_type: 'INBOX',
      email_search_value: '',
      priorty: '0',
      estatus: '0',
      email_category: '0',
      adminid: '0',
      search_type: '1',
    });

    // Emails state with pagination
    const allemails = ref({
      emaillist: [],
      totalemail: 0,
      total_count:0,
      loading: false,
      totalPages: 0,
      pageNum: 1,
    });

    // Fetch dropdown values
    const getDropdownValues = async () => {
      try {
        const ids = [50, 51, 53];
        GetSystemDD.value = await getddvaluedata(ids);
      } catch (error) {
        console.error('Error fetching dropdown data:', error);
      }
    };

    // Fetch admin list
    const fetchAdminList = async () => {
      try {
        const response = await sendData('get', '/admin-data');
        adminlist.value = response || [];
      } catch (error) {
        console.error('Error fetching admin list:', error);
      }
    };

    // Fetch email list with pagination
    const fetchEmailList = async () => {
      if (allemails.value.loading || (allemails.value.pageNum > allemails.value.totalPages && allemails.value.totalPages !== 0)) return;

      allemails.value.loading = true;

      try {
        const formData = { ...fromEmail.value, page: allemails.value.pageNum };
        const response = await sendData('get', '/get-email-list', formData);

        if (response.emaillist?.data && Array.isArray(response.emaillist.data)) {
          allemails.value.emaillist.push(...response.emaillist.data);
          allemails.value.totalPages = response.lastPage;
          allemails.value.total_count = response.total_count;
          allemails.value.pageNum += 1;
        } else {
          console.error('Unexpected response structure:', response.data);
        }
      } catch (error) {
        console.error('Error fetching email list:', error);
      } finally {
        allemails.value.loading = false;
      }
    };

    const getEmailtotal = ref({});
    const emailCountbyCate = ref({});

    const gettotalEmails = async () => {
        try {
            const response = await sendData('get', '/get-total-emails', {});
            getEmailtotal.value = response.totalemails;
            emailCountbyCate.value = response.categoryemails;
        } catch (error) {
            console.error('Error fetching total emails:', error);
        }
    };

     // Throttle utility function
        function throttle(fn, wait) {
            let lastTime = 0;
            return function (...args) {
                const now = new Date().getTime();
                if (now - lastTime >= wait) {
                fn(...args);
                lastTime = now;
                }
            };
        }

    // Scroll event handler to load more emails when reaching the bottom of the page
        // const handleScroll = () => {
        // const bottomOfWindow = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 10;
        // if (bottomOfWindow && !allemails.value.loading) {
        //     fetchEmailList();
        // }
        // };

        const handleScroll = throttle(() => {
            const bottomOfWindow = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 10;
            if (bottomOfWindow && !allemails.value.loading) {
                fetchEmailList();
                // allemails.value.loading = true; // Set loading to true
                // fetchEmailList().finally(() => {
                //   //allemails.value.loading = false; // Reset loading state after fetch is complete
                // });
            }
        }, 200); // Throttle for 200ms

    // Fetch email details and open offcanvas
    // const getemailDetails = (emails) => {
    //   emaildetails.value = emails;
    //   const offcanvasElement = document.getElementById('mailcanvasRight');
    //   if (offcanvasElement) {
    //     const offcanvas = new bootstrap.Offcanvas(offcanvasElement);
    //     offcanvas.show();
    //   } else {
    //     console.warn('Offcanvas element not found.');
    //   }
    // };

    // Fetch email details and open offcanvas
   
        const getemailDetails = (emails) => {
             emaildetails.value = emails;
            // const offcanvasElement = document.getElementById('mailcanvasRight');
            // if (offcanvasElement) {
            //     let offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
            //     if (!offcanvasInstance) {
            //         offcanvasInstance = new bootstrap.Offcanvas(offcanvasElement);
            //     }
            //     offcanvasInstance.show();
            // } else {
            //     console.warn('Offcanvas element not found.');
            // }
                
        };

    // Search email list with reset
    const searchEmaiList = async (searchType) => {
      allemails.value.emaillist = [];
      allemails.value.pageNum = 1;
      allemails.value.totalPages = 0;
      fromEmail.value.search_type = searchType;
      await fetchEmailList();
    };

    const ResetsearchEmaiList = async() => {

        allemails.value.emaillist = [];
        allemails.value.pageNum = 1;
        allemails.value.totalPages = 0;
        
        fromEmail.value =  {
            folder_type: 'INBOX',
            email_search_value: '',
            priorty: '0',
            estatus: '0',
            email_category: '0',
            adminid: '0',
            search_type: '1',
        }

        await fetchEmailList();
    }

    // Switch email category with reset
    const searchEmaiListtab = async (type) => {

      
        allemails.value.emaillist = [];
        allemails.value.pageNum = 1;
        allemails.value.totalPages = 0;
        fromEmail.value.email_category = type;
        await fetchEmailList();
       //  console.log(fromEmail.value);
    };

    const searchEmaiListfolder = async (folder_type) => {
                
        allemails.value.emaillist = [];
        allemails.value.pageNum = 1;
        allemails.value.totalPages = 0;
        fromEmail.value =  {
            folder_type: 'INBOX',
            email_search_value: '',
            priorty: '0',
            estatus: '0',
            email_category: '0',
            adminid: '0',
            search_type: '1',
        }
        fromEmail.value.folder_type = folder_type;
        await fetchEmailList();
    }

    const updateQuoteJob = async (event, fieldname, id, customefield) => {

            const value = event.target.value;
            // Find the email object by id
            const emailIndex = allemails.value.emaillist.findIndex(email => email.id === id);

            

            if (emailIndex !== -1) {

                const optionname =  '';

                const formData = {
                    value,
                    fieldname,
                    id,
                    customefield,
                    optionname
                };
                const response = await sendData('get', '/update-quote-job-id', formData);

                //console.log(response);
                if (response.success === true) {
                    allemails.value.emaillist[emailIndex][fieldname] = value;
                    customSwal.fire({
                        title: response.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                } else if (response.success === false) {
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error'
                        }
                    });
                }

            }
   }


        const updateEmailval = async (event, fieldname, id, customefield) => 
        {

            // Get the value from the event
            const value = event.target.value;
            // Find the email object by id
            const emailIndex = allemails.value.emaillist.findIndex(email => email.id === id);
          

            if (emailIndex !== -1) {

               // console.log(emailIndex);

               // console.log('sdsd'); return false;

                // Dynamically update the field in the found email object
                allemails.value.emaillist[emailIndex][fieldname] = value;
                // Optionally update the select's option name if needed
                const optionname = (value > 0) ? event.target.options[event.target.selectedIndex].text : '';
                // Prepare the form data to be sent to the server
                const formData = {
                    value,
                    fieldname,
                    id,
                    customefield,
                    optionname
                };


                // Send the updated data to the server
                const response = await sendData('get', '/update-email-data', formData);

                // Handle the response from the server
                if (response.success === true) {
                    customSwal.fire({
                        title: response.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                } else if (response.success === false) {
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error'
                        }
                    });
                }

                 //console.log(response);
            } else {
                console.log(`No email found with id ${id}`);
            }
        };

        const removeemailQJid = async (type, id) => {

            const fieldnameNew = (type == 1) ? 'Job ID' : 'Quote ID';

            const confirmMessage = 'Do you want to remove '+fieldnameNew+' job type ?'
            const { isConfirmed } = await createConfirm(confirmMessage);

              if (!isConfirmed) {
                return; // Exit the function if the user cancels
              }

            const formData = {type , id};
            const emailIndex = allemails.value.emaillist.findIndex(email => email.id === id);
            if (emailIndex !== -1) {

                const fieldname = (type == 1) ? 'job_id' : 'quote_id';
             
                const response = await sendData('put', '/job-quote-update', formData);

            
                if (response.success === true) {
                    allemails.value.emaillist[emailIndex][fieldname] = 0;
                    customSwal.fire({
                        title: response.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });
                } else if (response.success === false) {
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error'
                        }
                    });
                }
            }
          
        }
         
        const emailsignature = ref(''); // Make sure this is defined somewhere in your code
            const emailSign = async() => {
                const response = await sendData('get', '/email-sign', {});
                emailsignature.value = response;
            } 

            const forwardemail = ref({
                    email_from: '',
                    bccaddress: '',
                    cc_address: '',
                    filedata: '',
                    email_subject: '',
                    email_body: '',
                    emailfrom: '',
                    template_id: 0,
                    email_id: 0,
                    config_id:0,
            });

               

            const emailreply = (emaildetails, type) => {
                  files.value = [];
                // Ensure emaildetails contains the expected properties
                if (!emaildetails || typeof emaildetails !== 'object') {
                    console.error('Valid email details are required.');
                    return;
                }

                // Initialize email fields with defaults if necessary
                forwardemail.value.email_from = emaildetails.email_from || '';
                forwardemail.value.bccaddress = emaildetails.bccaddress || '';
                forwardemail.value.cc_address = emaildetails.cc_address || '';
                forwardemail.value.filedata = ''; // Assuming this is intentional
                //forwardemail.value.email_subject = `Re: ${emaildetails.email_subject || ''}`; // Using template literal

                if (type === 1) {
                    //forwardemail.value.email_subject = `Re: ${emaildetails.email_subject}`;
                    forwardemail.value.email_subject = `Re: ${emaildetails.email_subject.replace(/(FWD:|Re:)/gi, '').trim()}`;
                    forwardemail.value.email_body = constructQuotedEmailBody(emaildetails, 'Original Message');
                } else if (type === 2) {
                    //forwardemail.value.email_subject = `FWD: ${emaildetails.email_subject}`;
                    forwardemail.value.email_subject = `fwd: ${emaildetails.email_subject.replace(/(FWD:|Re:)/gi, '').trim()}`;
                    forwardemail.value.email_body = constructQuotedEmailBody(emaildetails, 'Forwarded message');
                }

                
                // Set additional email fields
                forwardemail.value.emailfrom = emaildetails.email_toaddress || '';
                forwardemail.value.template_id = 0;
                forwardemail.value.email_id = emaildetails.id;
                forwardemail.value.config_id = emaildetails.mail_type;

                // Log the constructed email object for debugging
                //console.log(forwardemail.value);
            };

            const constructQuotedEmailBody = (emaildetails, messageType) => {
                const quotedEmailBody = `
                    <br><br>
                    <blockquote style="border-left: 2px solid #20a6c5; margin: 1em 0; padding-left: 1em; color: #333;">
                        <p style="font-weight: bold;">----- ${messageType} -----</p>
                        <p><strong>From:</strong> ${emaildetails.email_from}</p>
                        <p><strong>To:</strong> ${emaildetails.email_toaddress}</p>
                        <p><strong>Subject:</strong> ${emaildetails.email_subject}</p>
                        <p><strong>Date:</strong> ${emaildetails.date || new Date().toLocaleString()}</p>
                        <hr>
                        ${emaildetails.email_body}
                    </blockquote>
                `;
                return `${emailsignature.value}<br>${quotedEmailBody}`;
            };

            const getemaildesc = async (event , type) => {

                const template_id = event.target.value; // Get the selected template ID
                const categories = Object.keys(emailTemplates.value); // Get the list of categories (e.g., "Email Cat 1", "Email Cat 2")
                
                let emailData = null;

                // Loop through the categories and try to find the template
                for (const category of categories) {
                    emailData = emailTemplates.value[category].find(email => email.id == template_id); // Loose comparison in case of string/number mismatch
                    if (emailData) break; // Stop the loop if a match is found
                }

                // If found, log the result
                if (emailData) {
                    if(type == 1) {
                         newEmailform.value.email_body = `${emailData.message} <br> ${newEmailform.value.email_body}`;
                         newEmailform.value.subject_email = emailData.heading;
                         
                    }else if(type == 2) {
                        forwardemail.value.email_body = `${emailData.message} <br> ${forwardemail.value.email_body}`;
                    }
                   
                } else {
                    //forwardemail.value.email_body = forwardemail.value.email_body;
                    console.log('Email not found in any category.');
                }

            };


       const emailTemplates = ref({});

        const fetchEmailTpl = async () => {
            try {
                const response = await sendData('get', '/bcic-email-tpl');
                emailTemplates.value = response || [];
            } catch (error) {
                console.error('Error fetching admin list:', error);
            }
        };
       
        const emailConfiglist = ref({})
        const getemailConfig = async () => {
            try {
                const response = await sendData('get', '/bcic-email-config');
                emailConfiglist.value = response.emailconfig || [];
            } catch (error) {
                console.error('Error fetching admin list:', error);
            }
        };

    
         // Send email function
         const sendreplayEmail = async (type) => {
            try {
                // Create a FormData object for the files and form data
                const formData = new FormData();
                formData.append('email_from', forwardemail.value.email_from);
                formData.append('bcc_address', forwardemail.value.bccaddress);
                formData.append('cc_address', forwardemail.value.cc_address);
                formData.append('template_id', forwardemail.value.template_id);
                formData.append('email_subject', forwardemail.value.email_subject);
                formData.append('email_body', forwardemail.value.email_body);
                formData.append('email_id', forwardemail.value.email_id);
                formData.append('config_id', forwardemail.value.config_id);
                formData.append('email_type', type);

                // Append uploaded files
                files.value.forEach((file, index) => {
                    formData.append(`files[${index}]`, file);
                });

                // API call to send the email
                const response = await axios.post('/sendemail', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

               // console.log(response.data);

                // Handle the response
                if (response.data.success) {
                    

                    files.value = [];

                    // Reset form fields
                    forwardemail.value = {
                        email_from: '',
                        bccaddress: '',
                        cc_address: '',
                        filedata: '',
                        email_subject: '',
                        email_body: '',
                        emailfrom: '',
                        template_id: 0,
                        email_id: 0,
                        config_id: 0,
                    };

                    // Show success alert
                    customSwal.fire({
                        title: response.data.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });

                } else {
                    // Show error alert if the API indicates failure
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.data.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error',
                        },
                    });
                }

            } catch (error) {
                console.error('Error sending email:', error);
                const errorMessage = error.response?.data?.message || 'An unexpected error occurred.';
                // Optionally show an alert to the user
                ErrorcustomSwal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    iconColor: '#FF5722',
                });
            }
        };


            const editorConfig = {
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'blockQuote', 'insertTable', 'imageUpload'
                ],
                // Other configuration options...
            };

           

        const files = ref([]);

        // Handle file selection
        const handleFileUpload = (event) => {
          files.value = Array.from(event.target.files); // Store all selected files
        };
       
        
    // TinyMCE editor options
    // const editorOptions = ref({
    //     height: 300,
    //     menubar: false,
    //     plugins: [
    //         'advlist autolink lists link image charmap print preview anchor',
    //         'searchreplace visualblocks code fullscreen',
    //         'insertdatetime media table paste code help wordcount'
    //     ],
    //     toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    // });

    // Handle errors from TinyMCE
    const handleError = (error) => {
      console.error('TinyMCE error:', error);
    }; 

    const newfiles = ref([]);

    // Handle file selection
    const newhandleFileUpload = (event) => {
        newfiles.value = Array.from(event.target.files); // Store all selected files
    };

    const openCompose = () => {
        newfiles.value = [];
        document.getElementById('compose_file').value = ''; // Add this line
        newEmailform.value = {
            mail_type:0,
            template_id:0,
            to_emails:'',
            is_active_staff:0,
            bcc_email:'',
            cc_email:'',
            subject_email:'',
            email_body: emailsignature.value,
        }
    }
    const newEmailform = ref({
        mail_type:0,
        template_id:0,
        to_emails:'',
        is_active_staff:0,
        bcc_email:'',
        cc_email:'',
        subject_email:'',
        email_body:'',
    })

        const sendNewEmail = async () => {

             console.log(newEmailform.value);

            if (parseInt(newEmailform.value.is_active_staff) === 1) {
                    const confirmMessage = 'Are you sure you want to send an email to all staff ?';
                    const headingConf = 'Yes, Sent it!'
                    const { isConfirmed } = await createConfirm(confirmMessage, headingConf);

                    if (!isConfirmed) {
                    return; // Exit the function if the user cancels
                    }
            }
            

           // return false;


            try {
                // Create a FormData object for the files and form data
                const formData = new FormData();
                formData.append('mail_type', newEmailform.value.mail_type);
                formData.append('template_id', newEmailform.value.template_id);
                formData.append('to_emails', newEmailform.value.to_emails);
                formData.append('is_active_staff', newEmailform.value.is_active_staff);
                formData.append('bcc_email', newEmailform.value.bcc_email);
                formData.append('cc_email', newEmailform.value.cc_email);
                formData.append('subject_email', newEmailform.value.subject_email);
                formData.append('email_body', newEmailform.value.email_body);

                // Append uploaded files
                newfiles.value.forEach((file, index) => {
                    formData.append(`files[${index}]`, file);
                });

                // API call to send the email
                const response = await axios.post('/new-send-email', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                console.log(response.data);

                if (response.data.success) {
                    

                    newfiles.value = [];
                    document.getElementById('compose_file').value = ''; // Add this line

                    // Reset form fields
                    newEmailform.value = {
                            mail_type:0,
                            template_id:0,
                            to_emails:'',
                            is_active_staff:0,
                            bcc_email:'',
                            cc_email:'',
                            subject_email:'',
                            email_body:'',
                        };

                    // Show success alert
                    customSwal.fire({
                        title: response.data.message,
                        icon: 'success',
                        iconColor: '#4CAF50',
                    });

                } else {
                    // Show error alert if the API indicates failure
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: response.data.message,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error',
                        },
                    });
                }

            } catch (error) {
                  
                    console.error("Error sending email:", error); // Log the error for debugging

                    // Handle the case where error response might not be defined
                    const errorMessage = error.response?.data?.message || 'An unexpected error occurred.';

                    // Show error alert
                    ErrorcustomSwal.fire({
                        title: 'Error',
                        text: errorMessage,
                        icon: 'error',
                        iconColor: '#FF5722',
                        customClass: {
                            popup: 'custom-swal-popup custom-swal-error',
                        },
                    });
                //console.error("Error sending email:", error); // Log the error for debugging
            }
        };

        const isImage = (fileName) => {
                const extension = fileName.split('.').pop().toLowerCase();
                return ['png', 'jpg', 'jpeg', 'gif'].includes(extension);
        };

        const isDocument = (fileName) => {
             return true;
            // const extension = fileName.split('.').pop().toLowerCase();
            // return ['pdf', 'doc', 'docx'].includes(extension);
        };

        const openInNewTab = (url) => {
           window.open(url, '_blank'); // Open the URL in a new tab
        };


    onMounted(async () => {
        try {
                // Fetch essential data in parallel
                await Promise.all([
                    fetchEmailList(),
                    gettotalEmails(),
                   
                ]);

                // Add scroll event listener
                window.addEventListener('scroll', handleScroll);

                // Fetch additional data after small delay (if necessary)
                setTimeout(async () => {
                await Promise.all([
                    getDropdownValues(),
                    fetchAdminList(),
                ]);
                }, 100);

                // Fetch email templates after a delay
                setTimeout(async () => {
                await fetchEmailTpl();
                await emailSign();
                await getemailConfig();
                }, 500);

                
            
        } catch (error) {
            console.error('Error during mounted operations:', error);
        }
    });

    onUnmounted(() => {
        // Remove scroll event listener on unmount to avoid memory leaks
        window.removeEventListener('scroll', handleScroll);
    });

    return {
     // editorOptions,
        GetSystemDD,
        adminlist,
        allemails,
        fromEmail,
        getemailDetails,
        mailattachedImg,
        emaildetails,
        handleError,
        handleScroll,
        searchEmaiList,
        searchEmaiListtab,
        gettotalEmails,
        getEmailtotal,
        searchEmaiListfolder,
        updateEmailval,
        removeemailQJid,
        updateQuoteJob,
        isNumberKey,
        openNewWindow,
        emailreply,

        forwardemail,
        emailTemplates,
        fetchEmailTpl,

        sendreplayEmail,
        editorConfig,
        editor,
        emailsignature,
        emailSign,
        getemaildesc,
        handleFileUpload,
        getemailConfig,
        emailConfiglist,
        newEmailform,
        sendNewEmail,
        newhandleFileUpload,
        openCompose,
        emailCountbyCate,
        ResetsearchEmaiList,
        isImage,
        isDocument,
        openInNewTab,
    }; 
  },
};
</script>

<style>
/* Custom styles for CKEditor */
.ckeditor-custom {
    max-width: 800px; /* Max width of the editor container */
    margin: 0 auto; /* Center the editor */
    border: 1px solid #ccc; /* Add a border */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for smoothness */
    overflow: hidden; /* Prevent overflow */
}

/* Specific styles for the editable area */
.ck-editor__editable {
    min-height: 400px; /* Minimum height of the editable area */
    max-height: 400px; /* Set max height for scrolling */
    padding: 10px; /* Padding inside the editor */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden; /* Disable horizontal scrolling */
}
</style>