<template>
    <div class="kanban-items-container">
        <div class="d-flex justify-content-between">
            <div class="avatar-group dropdown">
                <div class="avatar avatar-s" id="page-contactdetails-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="avatar-placeholder rounded-circle" />
                </div>
                <span class="fs-6 fw-medium ps-2">Claudia-Rose Wojt</span>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start p-0 mt-4 contact_details-hover" aria-labelledby="page-contactdetails-dropdown">
                    <div class="contact_box_hedaer">
                        <h6 class="m-0" key="t-notifications">Details</h6>
                    </div>
                    <div class="contact_box_details">
                        <ul class="">
                            <li class="kanban-icon kanban-user" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Christopher (#Q215981)">
                                <i class="ti ti-user-circle"></i> Muskan Agarwal
                            </li>
                            <li class="kanban-icon kanban-phone"><i class="ti ti-map-pin"></i> Brisbane</li>
                            <li class="kanban-icon kanban-date"><i class="ti ti-calendar-stats"></i> 21st Aug 2024</li>
                        </ul>

                        <div class="kanban-f-icon mt-2">
                            <ul>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cleaning"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Carpet"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pest"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kanban-items-btns">
                <button class="btn btn-soft-info" data-bs-toggle="offcanvas" data-bs-target="#operationcanvasRight" aria-controls="operationcanvasRight"><i class="ti ti-file-info"></i></button>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-1">
            <ul>
                <li class="kanban-icon kanban-user"><i class="ti ti-user-circle"></i> <a href="#0">(#Q215981)</a></li>
                <li class="kanban-icon kanban-location"><i class="ti ti-phone-call"></i> <a href="tel:0402238953">0402238953</a></li>
                <li>
                    <div class="col mb-1 mt-2">
                        <select class="form-select">
                            <option value="0">Select</option>
                            <option value="1">New</option>
                            <option value="4">Organise Reclean</option>
                            <option value="2" >Awaiting Exit Report</option>
                            <option value="11">Aw Client Response</option>
                            <option value="3">Awaiting Cleaner</option>
                            <option value="5">Cleaner Assigned</option>
                            <option value="7">Reclean Scheduled</option>
                            <option value="6">Cleaner Accepted</option>
                            <option value="8">Reclean Completed</option>
                            <option value="9">Reclean Failed</option>
                            <option value="10">Aw Client Invoice</option>
                        </select>
                    </div>
                </li>
            </ul>

            <ul class="kanban-items-right">
                <li class="kanban-icon kanban-email"><i class="ti ti-user-circle"></i> <a href="#0"> J# 55713 </a></li>
                <li class="kanban-icon kanban-price"><i class="ti ti-premium-rights"></i> 480</li>

                <!--  <li>
                <div class="col mb-1">
                    <select class="form-select">
                        <option value="0">Select</option>
                        <option value="1">Fixed</option>
                        <option value="2" >No Fixed</option>
                    </select>
                </div>
            </li>-->
            </ul>
        </div>
    </div>
</template>
<script>
import { defineComponent, ref } from 'vue'; // Import necessary functions


export default defineComponent({

});
</script>