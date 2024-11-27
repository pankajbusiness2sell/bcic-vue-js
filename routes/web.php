<?php
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("reboot",function (){
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    dd("Ready to Re-start");
});


Route::get('/', function () {
return view('auth.login');
});

Auth::routes();

//Route for Vue.js SPA
// Route::get('{any}', function () {
//     return view('app'); // Serve your main Blade view
// })->where('any', '.*'); // Catch-all route for Vue Router

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/create-quote', [App\Http\Controllers\Quote::class, 'CreateQuote']);
Route::post('/create-quote-object', [App\Http\Controllers\Quote::class, 'createQuoteObject']);
Route::post('/unset-session-variables', [App\Http\Controllers\Quote::class, 'UnsetQuoteVariable']);
Route::get('/delete-temp-quote', [App\Http\Controllers\Quote::class, 'deleteTempQuote']);
Route::post('/save-quote', [App\Http\Controllers\Quote::class, 'SaveQuote']);
Route::get('/view-quote-email', [App\Http\Controllers\Quote::class, 'viewEmailQuote']);
Route::post('/quote-lost', [App\Http\Controllers\Quote::class, 'LostQuote']);
Route::get('/admin-data', [App\Http\Controllers\Quote::class, 'getAdmindata']);
Route::post('/edit-field', [App\Http\Controllers\Quote::class, 'editFields']);
Route::get('/show-quote-question', [App\Http\Controllers\Quote::class, 'showQuoteQestion']);
Route::post('/save-quote-question', [App\Http\Controllers\Quote::class, 'saveQuoteQuestions']);
Route::post('/check-availability', [App\Http\Controllers\Quote::class, 'checkAvailability']);
Route::post('/get-staff-avail-check', [App\Http\Controllers\Quote::class, 'getStaffAvail']);

Route::get('/view-quote', [App\Http\Controllers\Quote::class, 'ViewQuote']);
Route::get('/get-view-quote', [App\Http\Controllers\Quote::class, 'getquoteData']);
Route::post('/get-dd-value', [App\Http\Controllers\Quote::class, 'getddValue']); 

Route::get('/sidequotedetails', [App\Http\Controllers\Quote::class, 'getSideQuote']);
Route::get('/get-quote-notes', [App\Http\Controllers\Quote::class, 'getQuoteNotes']);
Route::post('/add-quote-notes', [App\Http\Controllers\Quote::class, 'addQuoteNotes']);
Route::post('/send-custom-sms', [App\Http\Controllers\Quote::class, 'SemdCustomeSMS']);
Route::post('/admin-fault-notes', [App\Http\Controllers\Quote::class, 'addFaultNotes']);
Route::post('/quote-status-update', [App\Http\Controllers\Quote::class, 'quoteStatus']);



Route::get('/track-board-view', [App\Http\Controllers\Quote::class, 'trackBoardView']);
Route::get('/track-list-view', [App\Http\Controllers\Quote::class, 'trackListView']);  

Route::get('/get-track-data', [App\Http\Controllers\SalesTrack::class, 'getAllTaskInfo']);  
Route::get('/get-track-notes', [App\Http\Controllers\SalesTrack::class, 'getTrackNotes']);  
Route::get('/get-next-schedule', [App\Http\Controllers\SalesTrack::class, 'getNextschedule']);  
Route::get('/get-lost-dd', [App\Http\Controllers\SalesTrack::class, 'getLoastddData']);  
Route::get('/ans-left-button', [App\Http\Controllers\SalesTrack::class, 'ansLeftButton']);  

Route::get('/get-popup-details', [App\Http\Controllers\SalesTrack::class, 'getPopupDetails']);  
Route::get('/call-next-schedule', [App\Http\Controllers\SalesTrack::class, 'callNextShdl']);  
Route::get('/get-sales-sms', [App\Http\Controllers\SalesTrack::class, 'getsalesSMS']);  
Route::get('/get-sales-email', [App\Http\Controllers\SalesTrack::class, 'getsalesEmail']);  
Route::get('/done-review-call', [App\Http\Controllers\SalesTrack::class, 'reviewDone']);  
Route::get('/send-feedbackemail', [App\Http\Controllers\SalesTrack::class, 'sendFeedbackEmail']);  
Route::get('/sales-status-update', [App\Http\Controllers\SalesTrack::class, 'salesStatuUpdate']);  
Route::get('/get-hr-sms', [App\Http\Controllers\SalesTrack::class, 'getHrSMS']);  
Route::post('/send-hr-sms', [App\Http\Controllers\SalesTrack::class, 'sendHrSMS']);  


Route::get('/jobpopup', [App\Http\Controllers\JobPopup::class, 'jobpopup']);  

Route::get('/get-job-popu-details', [App\Http\Controllers\JobPopup::class, 'getJobPopupDetails']);  
Route::Post('/save-secondery-info', [App\Http\Controllers\JobPopup::class, 'saveCustSecondInfo']);  
Route::get('/get-secondery-info', [App\Http\Controllers\JobPopup::class, 'getSeconInfo']);  

Route::post('/send-popup-email', [App\Http\Controllers\JobPopup::class, 'sendEmailPopup']);  
Route::get('/get-job-list', [App\Http\Controllers\JobPopup::class, 'getJobListData']); 
Route::post('/add-job-notes', [App\Http\Controllers\JobPopup::class, 'addJobNotes']); 
Route::get('/get-job-details', [App\Http\Controllers\JobPopup::class, 'getJobDetails']); 
Route::get('/get-job-type', [App\Http\Controllers\JobPopup::class, 'getjobType']); 
Route::get('/get-staff-details', [App\Http\Controllers\JobPopup::class, 'getstaffType']); 
Route::get('/add-job-type', [App\Http\Controllers\JobPopup::class, 'addJobType']); 
Route::post('/job-assign', [App\Http\Controllers\JobPopup::class, 'AssignJobs']); 

Route::get('/get-reclean-notes', [App\Http\Controllers\JobPopup::class, 'ReCleanNotes']); 
Route::post('/add-reclean-notes', [App\Http\Controllers\JobPopup::class, 'AddReCleanNotes']); 
Route::get('/get-reclean-details', [App\Http\Controllers\JobPopup::class, 'getJobRecleanDetails']); 
Route::get('/get-payment-data', [App\Http\Controllers\JobPopup::class, 'getPaymentData']); 
Route::post('/add-payment', [App\Http\Controllers\JobPopup::class, 'addPayment']); 
Route::get('/list-payment', [App\Http\Controllers\JobPopup::class, 'getPaymentlist']); 
Route::get('/get-cleaner-list', [App\Http\Controllers\JobPopup::class, 'getStafflist']); 
Route::post('/add-refund-payment', [App\Http\Controllers\JobPopup::class, 'RefundPaymentAdd']); 
Route::get('/get-refund-list', [App\Http\Controllers\JobPopup::class, 'refundlistdata']); 
Route::get('/popup-email-list', [App\Http\Controllers\JobPopup::class, 'getEmailList']); 
Route::get('/get-email-message', [App\Http\Controllers\JobPopup::class, 'getEmailMessage']); 
Route::post('/send-popup-email', [App\Http\Controllers\JobPopup::class, 'sendPopupEmail']); 

Route::get('/popup-sms-list', [App\Http\Controllers\JobPopup::class, 'getSMSlist']); 
Route::get('/get-sms-message', [App\Http\Controllers\JobPopup::class, 'getSMSMsg']); 

Route::post('/send-popup-sms', [App\Http\Controllers\JobPopup::class, 'sendPopupSMS']); 
Route::get('/get-job-invoice', [App\Http\Controllers\JobPopup::class, 'getJobTypeforInv']); 

Route::get('/get-email-list', [App\Http\Controllers\JobPopup::class, 'getpopupEmailList']); 
Route::get('/get-task-history', [App\Http\Controllers\JobPopup::class, 'getTaskhistory']); 
Route::get('/get-rs-value', [App\Http\Controllers\JobPopup::class, 'getrsvalue']); 
Route::get('/get-check-list', [App\Http\Controllers\JobPopup::class, 'checklistUpdate']); 
//Route::get('/update-checklist', [App\Http\Controllers\JobPopup::class, 'updateCheckList']); 
Route::get('/popup-edit-field', [App\Http\Controllers\JobPopup::class, 'PopeditField']); 
Route::post('/save-cleaner-notes', [App\Http\Controllers\JobPopup::class, 'saveCleanerNotes']); 
Route::get('/get-cleaner-fault-list', [App\Http\Controllers\JobPopup::class, 'getCleanerNotesList']); 
Route::get('/job-assign-history', [App\Http\Controllers\JobPopup::class, 'showAssignHistory']); 
Route::post('/save-review-data', [App\Http\Controllers\JobPopup::class, 'saveReviewData']); 
Route::get('/get-review-data', [App\Http\Controllers\JobPopup::class, 'GetReviewData']); 
Route::get('/get-call-list', [App\Http\Controllers\JobPopup::class, 'getCallList']); 
Route::post('/edit-field-update', [App\Http\Controllers\JobPopup::class, 'editFieldUpdate']); 


Route::get('/bcic-email', [App\Http\Controllers\Emails::class, 'EmailIndex']); 
Route::get('/get-email-list', [App\Http\Controllers\Emails::class, 'getEmaillist']); 
Route::get('/get-total-emails', [App\Http\Controllers\Emails::class, 'getTotalEmails']); 
Route::get('/update-email-data', [App\Http\Controllers\Emails::class, 'emailUpdate']); 
Route::get('/update-quote-job-id', [App\Http\Controllers\Emails::class, 'QuoteJobUpdate']); 
Route::put('/job-quote-update', [App\Http\Controllers\Emails::class, 'jobQuoteRemoved']); 
Route::get('/bcic-email-tpl', [App\Http\Controllers\Emails::class, 'bcicTemplate']); 
Route::get('/email-sign', [App\Http\Controllers\Emails::class, 'signatureEmil']); 
Route::post('/sendemail', [App\Http\Controllers\Emails::class, 'sendEmails']); 
Route::get('/bcic-email-config', [App\Http\Controllers\Emails::class, 'getbcicEmailConfig']); 
Route::post('/new-send-email', [App\Http\Controllers\Emails::class, 'newSendEmail']); 


Route::get('/operation-system', [App\Http\Controllers\OperationTask::class, 'getOperationSystem']); 
Route::get('/get-tracktype-data', [App\Http\Controllers\OperationTask::class, 'getTrackdata']); 
Route::get('/get-track-question', [App\Http\Controllers\OperationTask::class, 'trackQuestion']); 
Route::post('/save-track-question', [App\Http\Controllers\OperationTask::class, 'saveTrackQuestion']); 

Route::get('/task-share-report', [App\Http\Controllers\OperationTask::class, 'taskReports']);
Route::post('/track-task-assign', [App\Http\Controllers\OperationTask::class, 'tracktaskAssign']);
Route::post('/hr-track-task-assign', [App\Http\Controllers\OperationTask::class, 'hrTaskTrackAssign']);
Route::post('/review-track-task-assign', [App\Http\Controllers\OperationTask::class, 'reviewTaskAssign']);
Route::post('/reclean-track-task-assign', [App\Http\Controllers\OperationTask::class, 'recleanTaskAssign']);
Route::post('/custome-track-task-assign', [App\Http\Controllers\OperationTask::class, 'customeTaskAssign']);
Route::post('/complaint-track-task-assign', [App\Http\Controllers\OperationTask::class, 'complaintTaskAssign']);
Route::get('/job-un-assigned', [App\Http\Controllers\OperationTask::class, 'JobUnAssigned']);
Route::get('/get-un-assign-data', [App\Http\Controllers\OperationTask::class, 'getunAssigndata']);
Route::get('/get-job-un-assign-data-by-site', [App\Http\Controllers\OperationTask::class, 'getunAssignDataBySites']);

Route::get('/gps-location', [App\Http\Controllers\OperationTask::class, '_GpsLocationPages']);
Route::get('/dispatch-report', [App\Http\Controllers\OperationTask::class, '_dispatchReports']);
Route::get('/gps-data', [App\Http\Controllers\OperationTask::class, 'GetGpsLocationData']);
Route::get('/get-job-type', [App\Http\Controllers\OperationTask::class, 'getJobType']);
Route::get('/dispatch-get-staff-list', [App\Http\Controllers\OperationTask::class, 'dispatchStaffList']);

Route::get('/get-dispatch-date', [App\Http\Controllers\OperationTask::class, 'getdispatchDateinfo']);
Route::post('/check-staff-roster', [App\Http\Controllers\OperationTask::class, 'IscheckStaffRoster']);
Route::get('/get-job-type-data', [App\Http\Controllers\OperationTask::class, 'getJobTypeInfoData']);

Route::get('/bcic-chat', [App\Http\Controllers\BCICChatController::class, 'bcic_chat']);
Route::get('/chat-get-staff-list', [App\Http\Controllers\BCICChatController::class, 'getStaffChatlist']);
Route::get('/chat-details', [App\Http\Controllers\BCICChatController::class, 'getchatDetails']);
Route::post('/send-chat-message', [App\Http\Controllers\BCICChatController::class, 'sendChatMessage']);



Route::get('/bcic-sms', [App\Http\Controllers\BCICSms::class, 'bcic_sms']);


Route::get('/vuefile', [App\Http\Controllers\Quote::class, 'vuefile']);