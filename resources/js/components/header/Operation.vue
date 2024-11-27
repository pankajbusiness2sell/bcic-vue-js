<!-- src/components/Header.vue -->
<template>
    <header class="systemetec-header">
      <div class="sidebar shadow-sm" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
  
             <!-- {{  taskNameFromStorage  }} -->
            <ul>
              <li v-if="taskNameFromStorage === 'sales'">
                <h6 class="submenu-hdr">Sales System </h6>
                 
                  <ul>
                    <li>
                      <a href="/create-quote">Create Quote</a>
                    </li>
                    <li>
                      <a href="./view-quote">View Quote</a>
                    </li>
                    <li>
                      <a href="#re-quoting">Re-Quoteing </a>
                    </li>

                      <li class="submenu" >
                        <a href="javascript:void(0);" class="subdrop active">
                          <i class="ti ti-chart-dots"></i> <span>Sales Task</span><span class="menu-arrow"></span>
                        </a>
                        <ul>
                          <li>
                            <a href="./track-board-view">Sales Track</a>
                          </li>
                          <li>
                            <a href="./task-share-report?page=sales&action=sales-task">Sales Task Share</a>
                          </li>
                        </ul>
                      </li>

                      <li class="submenu" >
                        <a href="javascript:void(0);" class="subdrop active">
                          <i class="ti ti-chart-dots"></i> <span>Reports</span><span class="menu-arrow"></span>
                        </a>
                        <ul>
                          <li>
                            <a href="#team-reports">Daily Task Report</a>
                          </li>
                          <li>
                            <a href="#daily-booked-report">Daily Booked Report</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="#cbd-quote">CBD Quote</a>
                      </li>

                      <li>
                        <a href="/devlopment-quote">Devlopment Quote</a>
                      </li>

                  </ul>

              </li>
              <li v-if="taskNameFromStorage === 'operation'">
                <h6 class="submenu-hdr">Operation System </h6>
                <ul>

                  <li class="submenu" >
                    <a href="javascript:void(0);" class="subdrop active">
                      <i class="ti ti-chart-dots"></i> <span>Reclean</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li>
                        <a href="javascript:void(0);">Reclean Report</a>
                     </li>
                     <li>
                        <a href="javascript:void(0);">Reclean un-Assign</a>
                    </li>
                      <li>
                         <a href="./track-board-view">Reclean Track</a>
                      </li>
                      <li>
                        <a href="./operation-system?tab=4">Reclean Board View</a>
                      </li>
                      <li>
                        <a href="./task-share-report?page=reclean&action=reclean-task">Reclean Task Share</a>
                      </li>
                    </ul>
                  </li>


                  <li class="submenu" >
                    <a href="javascript:void(0);" class="subdrop active">
                      <i class="ti ti-chart-dots"></i> <span>Review Call</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li>
                         <a href="./track-board-view">Review Track</a>
                      </li>
                      <li>
                        <a href="./operation-system?tab=5">Review Board</a>
                      </li>
                      <li>
                        <a href="./task-share-report?page=review&action=review-task">Review Task Share</a>
                      </li>
                    </ul>
                  </li>

                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="fas fa-hand-sparkles"></i> <span>Complaints  </span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Complaint List</a></li>
                      <li><a href="./track-board-view">Complaints Track</a></li>
                      <li><a href="./operation-system?tab=8">Complaint Board View</a></li>
                      <li><a href="./task-share-report?page=complaint&action=complaint-task">Complaint Task Share</a></li>
                    </ul>
                  </li>


                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-users-group"></i><span>Reports</span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Team Track – Team Report </a></li>
                      <li><a href="javascript:void(0);">Time Track – Time Report</a></li>
                    </ul>
                  </li>
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="fas fa-headset"></i> <span>Task  </span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Task List </a></li>
                      <li><a href="javascript:void(0);">Complaints view </a></li>
                      <li><a href="javascript:void(0);">Time Tracks </a></li>
                    </ul>
                  </li>
  
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-phone-call"></i> <span>Review Call  </span><span class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu submenu-two"><a href="javascript:void(0);">Task<span
                          class="menu-arrow inside-submenu"></span></a>
                            <ul>
                              <li><a href="javascript:void(0);">Task List</a></li>
                              <li><a href="javascript:void(0);">Board</a></li>
                              <li><a href="javascript:void(0);">Task Report</a></li> 
                            </ul>
                        </li>
  
  
                        <li class="submenu submenu-two"><a href="javascript:void(0);"> Reports <span
                          class="menu-arrow inside-submenu"></span></a>
                            <ul>
                              <li><a href="javascript:void(0);">Review Reports </a></li>
                              <li><a href="javascript:void(0);">Review Notes Reports </a></li>
                              <li><a href="javascript:void(0);">Product review Reports </a></li> 
                            </ul>
                        </li>
                    </ul>
                  </li>
  
                </ul>
              </li>
              <li v-if="taskNameFromStorage === 'otd'">
                <h6 class="submenu-hdr">OTD Manu </h6>
                  <ul>

                    <li>
                      <a href="./gps-location">GPS Location</a>
                    </li>
                    <li>
                      <a href="./dispatch-report">Dispatch Report</a>
                    </li>

                    <li class="submenu" >
                      <a href="javascript:void(0);" class="subdrop active">
                        <i class="ti ti-chart-dots"></i> <span>Unassigned</span><span class="menu-arrow"></span>
                      </a>
                      <ul>
                        <li>
                          <a href="./job-un-assigned">job-un-assigned</a>
                       </li>
                       
                      </ul>
  
                    </li>

                    <li class="submenu" >
                      <a href="javascript:void(0);" class="subdrop active">
                        <i class="ti ti-chart-dots"></i> <span> Task</span><span class="menu-arrow"></span>
                      </a>
                      <ul>
                        <li>
                          <a href="./operation-system?tab=1">Before Job View </a>
                        </li>
                        <li>
                          <a href="./operation-system?tab=2">On The Day View</a>
                        </li>
                      </ul>
                    </li>

                   
                   

                      <li class="submenu" >
                        <a href="javascript:void(0);" class="subdrop active">
                          <i class="ti ti-chart-dots"></i> <span>Sales Task</span><span class="menu-arrow"></span>
                        </a>
                        <ul>
                          <li>
                            <a href="./track-board-view">Sales Track</a>
                          </li>
                          <li>
                            <a href="./task-share-report?page=sales&action=sales-task">Sales Task Share</a>
                          </li>
                        </ul>
                      </li>

                      <li class="submenu" >
                        <a href="javascript:void(0);" class="subdrop active">
                          <i class="ti ti-chart-dots"></i> <span>Reports</span><span class="menu-arrow"></span>
                        </a>
                        <ul>
                          <li>
                            <a href="#team-reports">Daily Task Report</a>
                          </li>
                          <li>
                            <a href="#daily-booked-report">Daily Booked Report</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="#cbd-quote">CBD Quote</a>
                      </li>

                      <li>
                        <a href="/devlopment-quote">Devlopment Quote</a>
                      </li>

                  </ul>

              </li>
               <li  v-if="taskNameFromStorage === 'default'" >
                <h6 class="submenu-hdr">Default Menu</h6>
                <ul>
                  <li class="submenu" >
                    <a href="javascript:void(0);" class="subdrop active">
                      <i class="ti ti-chart-dots"></i> <span>Sales</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li>
                         <a href="/create-quote">Create Quote</a>
                      </li>
                      <li>
                        <a href="./view-quote">View Quote</a>
                      </li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-report"></i><span>Create Quote</span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">UnAssinged / Assigned</a></li>
                      <li><a href="javascript:void(0);">Daily Report </a></li>
                    </ul>
                  </li>
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-users-group"></i><span>HR</span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Applicant List </a></li>
                      <li><a href="javascript:void(0);">Hr SMS</a></li>
                      <li><a href="javascript:void(0);">View Staff</a></li>
                    </ul>
                  </li>
  
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="fas fa-hand-sparkles"></i> <span>Reclean  </span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Reclean List</a></li>
                      <li><a href="javascript:void(0);">Un Assigned</a></li>
                    </ul>
                  </li>
  
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="fas fa-headset"></i> <span>Complaints  </span><span class="menu-arrow"></span></a>
                    <ul>
                      <li><a href="javascript:void(0);">Complaint List </a></li>
                    </ul>
                  </li>
  
  
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-phone-call"></i> <span>Review Call  </span><span class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu submenu-two"><a href="javascript:void(0);">Task<span
                          class="menu-arrow inside-submenu"></span></a>
                            <ul>
                              <li><a href="javascript:void(0);">Task List</a></li>
                              <li><a href="javascript:void(0);">Board</a></li>
                              <li><a href="javascript:void(0);">Task Report</a></li> 
                            </ul>
                        </li>
  
  
                        <li class="submenu submenu-two"><a href="javascript:void(0);"> Reports <span
                          class="menu-arrow inside-submenu"></span></a>
                            <ul>
                              <li><a href="javascript:void(0);">Review Reports </a></li>
                              <li><a href="javascript:void(0);">Review Notes Reports </a></li>
                              <li><a href="javascript:void(0);">Product review Reports </a></li> 
                            </ul>
                        </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>



  </template>
  
    <script>
      import { ref, onMounted } from 'vue';

      export default {
        name: 'OperationHeader',
        
        setup() {
          // Define a ref to hold the task name
          const taskNameFromStorage = ref();
          
          // Use onMounted to get the task name from localStorage after the component mounts
          onMounted(() => {
            taskNameFromStorage.value = localStorage.getItem('tab-page') || 'default';
          });

          // Return the ref so it can be used in the template
          return {
            taskNameFromStorage
          };
        }
      };
    </script>
  
  <style scoped>
  /* Add your header styles here */
  .systemetec-header {
    background-color: #f8f9fa;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
  }
  </style>
  