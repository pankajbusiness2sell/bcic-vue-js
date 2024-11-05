@include('layout.head'); 
<body>
 
  
  <main class="main-wrapper">     
    <!--header Section Start Here-->  
    <div class="header shadow-sm">

      <div class="header-left active">
        <a href="index.html" class="logo logo-normal">
          <img src="{{ url('assets/img/bcic-logo-w.png') }} " alt="Logo">
        </a>
        <a href="index.html" class="logo-small">
          <img src="{{ url('assets/img/bcic-logo-sm.png') }} " alt="Logo"> 
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
          <i class="ti ti-arrow-bar-to-left"></i>
        </a>
      </div>

      <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </a>
      <div class="header-user">

        <ul class="nav user-menu-bcic">

          <li class="nav-item nav-list">
            <ul class="nav">
              <li class="nav-item">
                <a href="javascript:void(0);" class="btn btn-header-list" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="Quote">
                  <i class="ti ti-report"></i>
                </a>
                <span class="position-absolute top-0 start-100 translate-middle fs-11 bg-danger rounded-circle">
                  99
                </span>
              </li>

              <li class="nav-item">
                <a href="javascript:void(0);" class="btn btn-header-list" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="Booking">
                  <i class="ti ti-report"></i>
                </a>
                <span class="position-absolute top-0 start-100 translate-middle fs-11 bg-danger rounded-circle">
                  99
                </span>
              </li>

             
            </ul>
          </li>
          
          <li class="nav-item"><a href="{{ url('./create-quote') }}">  SALES ( + ) </a> </li>
          <li class="nav-item"><a href="{{ url('./operation-system') }}">  OTD </a> </li>
          <li class="nav-item"><a href="{{ url('./operation-system') }}">  OPERATIONS </a> </li>
          <li class="nav-item"><a href="javascript:void(0);">  HR </a> </li>
          <li class="nav-item"><a href="javascript:void(0);">  SETTING </a> </li>
          <li class="nav-item"><a href="javascript:void(0);">  CALL REVIEW </a> </li>
          <li class="nav-item"><a href="{{ url('/logout') }}">  LOGOUT </a> </li>
        </ul>



        <ul class="nav user-menu">
          <li class="nav-item nav-list">
            <ul class="nav">
              <li class="nav-item">
                <a href="javascript:void(0);" class="btn btn-header-list" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="Custome Task Report">
                  <i class="ti ti-report"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0);" class="btn btn-help" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  data-bs-title="Create Task">
                  <i class="ti ti-file-plus"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0);" class="btn btn-chart-pie" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="New Notification Urgent Task">
                  <i class="ti ti-bell-plus"></i>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item nav-item-task nav-item-box">
            <a href="./track-board-view" data-bs-toggle="tooltip" data-bs-placement="bottom"
              data-bs-title="All Task Track">
              <i class="ti ti-clipboard-text"></i>
            </a>
          </li>


          <li class="nav-item nav-item-dashboard nav-item-box">
            <a href="./operation-system?tab=2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dashboard">
              <i class="ti ti-layout-dashboard"></i>
            </a>
          </li>


          <li class="nav-item nav-item-chat nav-item-box">
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Chat">
              <i class="ti ti-brand-wechat"></i>
            </a>
          </li>

          <li class="nav-item nav-item-message nav-item-box">
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Message">
              <i class="ti ti-message"></i>
            </a>
          </li>

          <li class="nav-item nav-item-email nav-item-box">
            <a href="./bcic-email" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Email">
              <i class="ti ti-mail"></i>
            </a>
          </li>

          <li class="nav-item nav-item-email nav-item-box">
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Settings">
              <i class="ti ti-settings"></i>
            </a>
          </li>


          <li class="nav-item nav-list">
            <ul class="nav">
              <li class="nav-item">
                <div class="dropdown statistic-dropdown">
                  <div class="card-select">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                      <i class="ti ti-calendar-check me-2"></i>Select Role
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Sales</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Supervisor </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Manager </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Before Jobs </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i class="ti ti-circle-chevron-right"></i>On
                        the day</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>After Job</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i class="ti ti-circle-chevron-right"></i>HR
                      </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Re-cleans</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Complaints</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Others </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>Cleaner Quality </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i class="ti ti-circle-chevron-right"></i>TSA
                      </a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i
                          class="ti ti-circle-chevron-right"></i>SALES TL</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i class="ti ti-circle-chevron-right"></i>HR
                        TL</a>
                      <a href="javascript:void(0);" class="dropdown-item"> <i class="ti ti-circle-chevron-right"></i>Job
                        QC </a>
                    </div>
                  </div>
                </div>

              </li>
              <li class="nav-item">
                <div class="nav-search-inputs">
                  <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                      <i class="fa fa-search"></i>
                    </a>
                    <form action="#" class="dropdown">
                      <div class="searchinputs" id="dropdownMenuClickable">
                        <input type="text" placeholder="Search">
                        <div class="search-addon">
                          <button type="submit"><i class="ti ti-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </li>



          <li class="nav-item dropdown nav-item-box">
            <a id="dropdownButton" href="javascript:void(0);" class="nav-link" data-bs-toggle="dropdown"
              aria-expanded="false" data-bs-placement="bottom" title="Notification">
              <i class="ti ti-bell"></i>
              <span class="badge rounded-pill">13</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
              <div class="topnav-dropdown-header">
                <h4 class="notification-title">Notifications</h4>
              </div>
              <div class="noti-content">
                <ul class="notification-list">
                  <li class="notification-message">
                    <a href="javascript:void(0);">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img src="{{ url('assets/img/avatar.jpg') }}  " alt="Profile">
                          <span class="badge badge-info rounded-pill"></span>
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">Ray Arnold left 6 comments
                            on Isla Nublar SOC2 compliance report</p>
                          <p class="noti-time">Last Wednesday at 9:42 am</p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="javascript:void(0);">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img src="{{ url('assets/img/avatar.jpg') }} " alt="Profile">
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">Denise Nedry replied to Anna
                            Srzand</p>
                          <p class="noti-sub-details">“Oh, I finished
                            de-bugging the phones, but the system's compiling
                            for eighteen minutes, or twenty. So, some minor
                            systems may go on and off for a while.”</p>
                          <p class="noti-time">Last Wednesday at 9:42 am</p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="javascript:void(0);">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt src="{{ url('assets/img/avatar.jpg') }} ">
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">John Hammond attached a file
                            to Isla Nublar SOC2 compliance report</p>
                          <div class="noti-pdf">
                            <div class="noti-pdf-icon">
                              <span><i class="ti ti-chart-pie"></i></span>
                            </div>
                            <div class="noti-pdf-text">
                              <p>EY_review.pdf</p>
                              <span>2mb</span>
                            </div>
                          </div>
                          <p class="noti-time">Last Wednesday at 9:42 am</p>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="topnav-dropdown-footer">
                <a href="javascript:void(0);" class="view-link">View all</a>
                <a href="javascript:void(0);" class="clear-link">Clear all</a>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
              <span class="user-info">
                <span class="user-letter">
                  <img src="{{ url('assets/img/avatar.jpg') }} " alt="Profile">
                </span>
                <span class="badge badge-success rounded-pill"></span>
              </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
              <div class="profilename">
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class="ti ti-layout-2"></i> Dashboard
                </a>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class="ti ti-user-pin"></i> My Profile
                </a>
                <a class="dropdown-item" href="{{ url('./logout') }}">
                  <i class="ti ti-lock"></i> Logout
                </a>
              </div>
            </div>
          </li>

        </ul>

        
      </div>


     

      <div class="dropdown mobile-user-menu">
          <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:void(0);">
              <i class="ti ti-layout-2"></i> Dashboard
            </a>
            <a class="dropdown-item" href="javascript:void(0);">
              <i class="ti ti-user-pin"></i> My Profile
            </a>
            <a class="dropdown-item" href="javascript:void(0);">
              <i class="ti ti-lock"></i> Logout
            </a>
          </div>
      </div>

    </div>
    