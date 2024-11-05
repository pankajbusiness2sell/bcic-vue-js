/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'; // Make sure this includes necessary dependencies
import { createApp } from 'vue';
import router from './router'; // Import the router configuration 

/**
    *   import { useCommonFunction } from './func/function.js'; // Import your common functions
    *   const { getFunc } = useCommonFunction();
    *  We Can use check Login function as true/false
*/

// Create a Vue app instance 
const app = createApp({}); 



// Import components
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
//C:\wamp64\www\bcic-live\resources\js\components\operation\operation_task.vue  hr_share_task



// Register components
app.component('example-component', ExampleComponent);
app.component('view-page', ViewQuote); 
app.component('quote-page', QuotePage);
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

// Function to check if Bootstrap is already loaded
const isBootstrapLoaded = () => {
    return document.querySelector('script[src="/assets/js/bootstrap.bundle.min.js"]') !== null;
};

//  console.log(getFunc());
//  function handleGlobalClick(event) {
//     console.log('Global click detected', event.target);  // Log the clicked element
//   }
//   document.addEventListener('click', handleGlobalClick);

// Load Bootstrap JavaScript
const loadBootstrap = () => {
    return new Promise((resolve) => {
        // Check if Bootstrap is already loaded
        if (isBootstrapLoaded()) {
            console.log("Bootstrap is already loaded.");
            resolve(); // Resolve immediately if it's already loaded
            return;
        }

        // Create script element to load Bootstrap
        const script = document.createElement('script');
        script.src = '/assets/js/bootstrap.bundle.min.js';
        script.async = true;

        script.onload = () => {
            console.log("Bootstrap loaded successfully.");
            resolve(); // Resolve the promise when the script is loaded
        };

        document.head.appendChild(script);
    });
};

// Initialize the app
loadBootstrap().then(() => {
    app.use(router); // Use the router
    app.mount('#app'); // Mount the Vue app
});
