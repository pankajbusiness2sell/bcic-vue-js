<!-- src/components/Header.vue -->
<template>
    <header class="systemetec-header">
      <div class="sidebar shadow-sm" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
  
            <ul>
              <li>
                <h6 class="submenu-hdr">Main Menu</h6>
                <ul>
                  <li class="submenu" >
                    <a href="javascript:void(0);" class="subdrop active">
                      <i class="ti ti-chart-dots"></i> <span>Sales</span><span class="menu-arrow"></span>
                    </a>
                    <ul>
                      <!-- <li><a href="{{ url('./create-quote') }}">Create Quote</a></li>
                      <li><a href="{{ url('./view-quote') }}">View Quote</a></li> -->
                      <li>
                        <!-- <router-link to="/create-quote" class="btn btn-primary me-1">
                          <i class="ti ti-layout-kanban"></i> Create Quote
                        </router-link> -->
                         <a href="/create-quote">Create Quote</a>
                      </li>
                      <li>
                        <!-- <router-link to="/view-quote" class="btn btn-primary me-1">
                          <i class="ti ti-layout-kanban"></i>View Quote
                        </router-link> -->
                        <a href="./view-quote">View Quote</a>
                         <!-- <a href="{{ url('./view-quote') }}">View Quote</a> -->
                      </li>
                    </ul>
                  </li>
                  <li class="submenu">
                    <a href="javascript:void(0);" class="subdrop active"><i class="ti ti-report"></i><span>Create Quote</span><span class="menu-arrow"></span></a>
                    <ul>
                      <li>
                          <!-- <a href="javascript:void(0);" onClick="getData();">Dispatch Board </a> -->
                          <!-- <router-link to="/dispatch-board" class="btn btn-primary me-1">
                            <i class="ti ti-layout-kanban"></i> Dispatch Board
                          </router-link> -->
                      </li>
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
  export default {
    name: 'Header',
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
  