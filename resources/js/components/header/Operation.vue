<!-- src/components/Header.vue -->
<template>
    <header class="systemetec-header">
      <div class="sidebar shadow-sm" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
  
            <ul>
              <li>
                <h6 class="submenu-hdr">Operation System</h6>
                <ul>

                  
                  <li class="submenu" >
                    <a href="javascript:void(0);" class="subdrop active">
                      <i class="ti ti-chart-dots"></i> <span>Unassigned</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <li>
                        <a href="./job-un-assigned">job-un-assigned</a>
                     </li>
                     <!-- <li>
                        <a href="javascript:void(0);">Reclean un-Assign</a>
                    </li> -->
                     
                    </ul>

                  </li>

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
  
            </ul>
          </div>
        </div>
      </div>
    </header>



  </template>
  
  <script>
  export default {
    name: 'OperationHeader',
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
  