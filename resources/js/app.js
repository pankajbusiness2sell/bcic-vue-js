
/**
 * Load all necessary JavaScript dependencies, including Vue and other libraries.
 * This setup provides a great starting point for building robust applications
 * using Vue and Laravel.
 */

//import 'assets/css/styles.css';
import './bootstrap'; // Ensure this includes Bootstrap and other dependencies
import { createApp } from 'vue';
import router from './router'; // Import the router configuration

// Import any common functions (if applicable)
// Example: const { getFunc } = useCommonFunction();

/** 
 * Initialize Vue Application
 */
const app = createApp({});

/** 
 * Import Components
 */
import ExampleComponent from './components/ExampleComponent.vue';
import QuotePage from './components/quote/QuotePage.vue';
import ViewQuote from './components/view-quote/ViewQuote.vue';
import BoardviewQuote from './components/boardview/BoardviewQuote.vue';
import ListviewQuote from './components/boardview/ListdviewQuote.vue';
import NewJobPopup from './components/job-popup/PopupHeader.vue';
import EmailsPages from './emails/EmailsPages.vue';
import OperationPage from './components/operation/operation_task.vue';
import Taskreports from './components/TaskShareReport/task_share_report.vue';
import HrTask from './components/TaskShareReport/hr_share_task.vue';
import ReviewshareTask from './components/TaskShareReport/review_share_task.vue';
import RecleanTask from './components/TaskShareReport/reclean_share_task.vue';
import ComplaintTask from './components/TaskShareReport/complaint_share_task.vue';
import CustomeTask from './components/TaskShareReport/custome_share_task.vue';
import Unassigned from './components/operation/unassigned.vue';
import DispatchReport from './components/otd/dispatchreports.vue';
import GpsLocation from './components/otd/gpslocation.vue';

import BCICChat from './components/chat/chatindex.vue';
import BCICSms from './components/sms/smsindex.vue';


/** 
 * Register Components Globally
 */
app.component('example-component', ExampleComponent);
app.component('quote-page', QuotePage);
app.component('view-page', ViewQuote);
app.component('board-view', BoardviewQuote);
app.component('list-view', ListviewQuote);
app.component('new-jobpopup', NewJobPopup);
app.component('emails-pages', EmailsPages);
app.component('operation-system', OperationPage);
app.component('task-share-report', Taskreports);
app.component('hr-share-task', HrTask);
app.component('review-share-task', ReviewshareTask);
app.component('reclean-share-task', RecleanTask);
app.component('complaint-share-task', ComplaintTask);
app.component('custome-share-task', CustomeTask);
app.component('un-assigned', Unassigned);
app.component('dispatch-report', DispatchReport);
app.component('gps-location', GpsLocation);

app.component('chat-pages', BCICChat);
app.component('sms-pages', BCICSms);


/** 
 * Handle URL Parameters
 * Store the "tab-page" parameter in localStorage if present in the URL.
 */
const urlParams = new URLSearchParams(window.location.search);
const taskName = urlParams.get('tab-page');

if (taskName) {
    localStorage.setItem('tab-page', taskName);
} 

/** 
 * Mount Vue Application
 */
app.use(router); // Apply router
app.mount('#app'); // Mount the Vue app to the #app element
