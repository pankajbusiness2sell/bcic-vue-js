// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import QuotePage from './components/quote/QuotePage.vue';
import ViewQuote from './components/view-quote/ViewQuote.vue';
import BoardviewQuote from './components/boardview/BoardviewQuote.vue';
import ListviewQuote from './components/boardview/ListdviewQuote.vue';
//import JobPopup from './components/jobpopup/header/PopupHeader.vue'; // Adjust the path as necessary

import NewJobPopup from './components/job-popup/PopupHeader.vue'; // Adjust the path as necessary
import EmailsPages from './emails/EmailsPages.vue';

import OperationTask from './components/operation/operation_task.vue';
import Unassigned from './components/operation/unassigned.vue';
import Taskreports from './components/TaskShareReport/task_share_report.vue';

const routes = [
  {
    path: '/',
    name: 'create-quote',
    component: QuotePage
  },
  {
    path: '/create-quote',
    name: 'create-quote',
    component: QuotePage
  },
  {
    path: '/view-quote',
    name: 'view-quote',
    component: ViewQuote
  },  
  {
    path: '/track-list-view',
    name: 'ListviewQuote',
    component: ListviewQuote
  },
  {
    path: '/track-board-view',
    name: 'track-board-view',
    component: BoardviewQuote
  }, 
  {
    path: '/bcic-email',
    name: 'bcic-email',
    component: EmailsPages
  }, 
  {
    path: '/jobpopup',
    name: 'JobPopupnew',
    component: NewJobPopup,
    props: route => ({ 
      tab: route.query.tab,
      jobId: route.query.job_id
    })
  },
  {
    path: '/operation-system',
    name: 'OperationTask',
    component: OperationTask,
    //props: route => ({ tab: route.query.tab }), // Pass query parameter as a prop
    props: route => ({ tab: Number(route.query.tab) || 1 }), // Default to 1 if tab is not present
  },
  {
    path: '/task-share-report', 
    name: 'task-share-report',
    component: Taskreports
  }, 
  {
    path: '/job-un-assigned', 
    name: 'job-un-assigned',
    component: Unassigned
  }, 
  { path: '/:pathMatch(.*)*', component: '<h1>Not Found Component</h1>' } // Catch-all route for 404 pages
  // Add more routes as needed
];


const router = createRouter({
  history: createWebHistory(), // Use HTML5 History mode
  routes
});

export default router;