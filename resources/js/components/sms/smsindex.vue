<template>
    <!-- <OperationHeader /> -->
    <div class="mt-5 p-3">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card sms-main">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="pt-2">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-device-mobile-message"></i>
                                    </div>
                                    <h5 class="card-title text-nowrap">SMS</h5>
                                </div>

                                <!-- <div class="">


                                    <div class=" d-inline-block me-2 ">
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class=" d-inline-block me-2">
                                        <input type="text" class="form-control" placeholder="Staff Name">
                                    </div>


                                    <div class="d-inline-block">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-3 col-md-3 pe-0">
                                    <div class="sms-left-sidebar">
                                    <div class="search-box">
                                        <form class="position-relative">
                                            <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
                                            <svg class="svg-inline--fa fa-magnifying-glass search-box-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg>
                                        </form>
                                    </div>

                                    <div class="sms_left_sidebar_btns">
                                        <ul>
                                            <li><a href="javascript:void(0);"><i class="ti ti-users-group"></i> Staff</a></li>
                                            <li><a href="javascript:void(0);"><i class="ti ti-id"></i> Quote</a></li>
                                            <li><a href="javascript:void(0);"><i class="ti ti-briefcase"></i> Jobs</a></li>
                                        </ul>
                                    </div>


                                    <div class="sms-left-sidebar-list">

                                        <!--begin::User-->
                                            <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Rujal</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->

                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">S</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Sonali Soni</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">P</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Pema Choeda</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->

                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->

                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->

                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->

                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between py-2">
                                                <!--begin::Details-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-45px symbol-circle ">
                                                        <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">M</span>
                                                        <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                    </div><!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-2">
                                                        <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                        <div class="fw-normal text-muted">melody@altbox.com</div>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Lat seen-->
                                                <div class="d-flex flex-column align-items-end ms-2">
                                                    <span class="text-muted fs-8 mb-1">20 hrs</span>
                                                    <span class="badge badge-sm badge-circle badge-light-success">6</span>
                                                </div>
                                                <!--end::Lat seen-->
                                            </div>
                                        <!--end::User-->


                                    </div>


                                </div>


                                </div>
                                <div class="col-9 col-md-9 ps-0">
                                    <div class="sms-right-sidebar">
                                        <div class="d-flex justify-content-between sms-right-header">
                                            <!--begin::User-->
                                            <div class="d-flex justify-content-between">
                                                    <!--begin::Details-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-45px symbol-circle ">
                                                            <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                            <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                        </div><!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-2">
                                                            <a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">Rujal</a>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                    <!--end::Details-->

                                                </div>
                                            <!--end::User-->

                                            <!--Contact No-->
                                                <div class="sms-right-call"><i class="ti ti-phone-call"></i> <a href="tel:0434312414">0434312414</a></div>


                                            <!--Contact No-->
                                        </div>

                                        <div class="chat-conversation">
                                            <ul class="list-unstyled mb-0">
                                                <li>
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        Good morning
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:00</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="conversation-name">Doris Brown</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-info text-info fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        Good morning, How are you? What about our next meeting?
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:02</span></p>
                                                                </div>
                                                            </div>

                                                            <div class="conversation-name">Patricia Smith</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        Good morning
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:00</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="conversation-name">Doris Brown</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-info text-info fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        Good morning, How are you? What about our next meeting?
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:02</span></p>
                                                                </div>
                                                            </div>

                                                            <div class="conversation-name">Patricia Smith</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        Ok thanks
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:00</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="conversation-name">Doris Brown</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-info text-info fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0"> Hi Rujal  , J#48372 for test is cancelled for 04th Sep 2024. Thanks </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:02</span></p>
                                                                </div>
                                                            </div>

                                                            <div class="conversation-name">Patricia Smith</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        My car are broke down on the way
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:00</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="conversation-name">Doris Brown</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-info text-info fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">Hello Justine Tano, Your job for tomorrow with Dean Roebuck is at 92 Martha Street, Camp Hill QLD, Australia is all set, and your start timings is 08:30 AM as per your confirmation. Thanks, BCIC </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:02</span></p>
                                                                </div>
                                                            </div>

                                                            <div class="conversation-name">Patricia Smith</div>
                                                        </div>
                                                    </div>
                                                </li>


                                                <li>
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">
                                                                        sms from cx 56082- 2 bedrooms vacuumed, shelves wiped 2 bathrooms cleaned 1 downstairs and one upstairs in the hallway (leave master bathroom) kitchen living room garage to be dusted laundry floor wiped stairs vacuumed outdoor verandah moped
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:00</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="conversation-name">Doris Brown</div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="right">
                                                    <div class="conversation-list">
                                                        <div class="chat-avatar">
                                                            <div class="symbol symbol-45px symbol-circle me-3">
                                                                <span class="symbol-label  bg-light-info text-info fs-6 fw-bolder ">R</span>
                                                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                            </div>
                                                        </div>

                                                        <div class="user-chat-content">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <p class="mb-0">Hello Justine Tano, Your job for tomorrow with Dean Roebuck is at 92 Martha Street, Camp Hill QLD, Australia is all set, and your start timings is 08:30 AM as per your confirmation. Thanks, BCIC </p>
                                                                    <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">10:02</span></p>
                                                                </div>
                                                            </div>

                                                            <div class="conversation-name">Patricia Smith</div>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div>



                                        <div class="chat-input-section p-3 p-lg-4 border-top mb-0">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-lg bg-light border-light" placeholder="Enter Message...">
                                                </div>
                                                <div class="col-auto">
                                                    <div class="chat-input-links ms-md-2 me-md-0">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <button type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                                    <i class="ti ti-send-2"></i>
                                                                </button>
                                                            </li>
                                                        </ul>
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
</template>

<script>

import {defineComponent , ref ,reactive, onMounted } from 'vue'; // Import necessary functions;
import  OperationHeader  from '@/header/Operation.vue';
import { useCommonFunction } from './../../func/function.js';

// console.log(Header);

export default defineComponent({ 
       
        components: {
            OperationHeader
        },
      setup(props) { 

            const { openNewWindow } = useCommonFunction();

            const loading = ref(false);
            const error = ref(null);
      }

    });
</script>   