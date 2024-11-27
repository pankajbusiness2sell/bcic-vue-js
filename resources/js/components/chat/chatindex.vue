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
                                    <i class="ti ti-brand-wechat"></i>
                                </div>
                                <h5 class="card-title text-nowrap">Chat</h5>
                            </div>

                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-3 col-md-3 pe-0">
                                <div class="sms-left-sidebar">
                                    <div class="search-box">
                                        <input class="form-control search-input" placeholder="Search staff..." v-model="searchQuery" @keyup="fetchSearchResults" aria-label="Search">
                                    </div>

                                    <!-- <pre>{{  stafflist  }}</pre> -->

                                    <div class="sms-left-sidebar-list" v-if="stafflist.length > 0 ">

                                        <!--begin::User-->
                                        <div v-for="(staffdata,staffindex) in stafflist" :key="staffindex" class="d-flex justify-content-between py-2 border-bottom border-light">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px symbol-circle ">
                                                    <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">{{ initialsName(staffdata.name)  }}</span>
                                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-2">
                                                    <a href="javascript:void(0)" @click="showchatDetails(staffdata)" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">{{ staffdata.name }}</a>
                                                    <div class="fw-normal text-muted">{{ staffdata.mobile }}</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Lat seen-->
                                            <div class="d-flex flex-column align-items-end ms-3">
                                                <span class="text-muted fs-8 mb-1">{{ (staffdata.lastdate) ? timefm(staffdata.lastdate) : timefm(staffdata.last_chat_datetime) }}</span>
                                                <span class="badge badge-sm badge-circle badge-light-success" v-if="staffdata.totalReco > 0 ">{{ staffdata.totalReco }}</span>
                                            </div>
                                            <!--end::Lat seen-->
                                        </div>
                                        <!--end::User-->
                                    </div>

                                    <div class="sms-left-sidebar-list" v-else>
                                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <b> No Records Found </b>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-9 col-md-9 ps-0" v-if="staffinfodetails.name">
                                <div class="sms-right-sidebar">
                                    <div class="d-flex justify-content-between sms-right-header">
                                        <!--begin::User-->
                                        <div class="d-flex justify-content-between">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px symbol-circle ">
                                                    <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">{{ initialsName(staffinfodetails.name) }}</span>
                                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-2">
                                                    <div><a href="#" class="fs-7 fw-bold text-gray-900 text-hover-primary mb-2">{{ staffinfodetails.name }}</a></div>
                                                    <div class="d-flex justify-content-start">
                                                        <span class="d-inline-block me-2" v-if="staffinfodetails.team_of > 0">
                                                            Team of {{ staffinfodetails.team_of }}
                                                        </span>

                                                        <ul>
                                                            <li v-for="(service, index) in splitServices(staffinfodetails.job_types)" :key="index" class="badge badge-tag badge-success-light me-1">
                                                                {{ service }}
                                                            </li>
                                                        </ul>
                                                        <span class="d-inline-block">( {{ SitesLocation[staffinfodetails.site_id]?.name  }} )</span>
                                                    </div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->

                                        </div>
                                        <!--end::User-->

                                        <!--Contact No-->
                                        <div class="sms-right-call"><i class="ti ti-phone-call"></i> <a :href="`tel:${staffinfodetails.mobile}`">{{ staffinfodetails.mobile }}</a></div>

                                        <!--Contact No-->
                                    </div>

                                    <div class="chat-conversation" ref="chatContainer">
                                        <!-- <pre>{{  chatdetailsdata }}</pre> -->
                                        <ul class="list-unstyled mb-0">
                                            <li v-for="(chatdetails, chatindex) in chatdetailsdata" :key="chatindex" :class="{'right': chatdetails.chat_type === 'admin'}">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <div class="symbol symbol-45px symbol-circle me-3">
                                                            <span class="symbol-label  bg-light-danger text-danger fs-6 fw-bolder ">
                                                                {{ initialsName((chatdetails.chat_type === 'staff') ? staffinfodetails.name : 'admin') }}
                                                            </span>
                                                            <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                                        </div>
                                                    </div>

                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0">
                                                                    {{ chatdetails.message }}
                                                                </p>
                                                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                                                    <span class="align-middle">
                                                                        {{ datetimefm(chatdetails.chat_exact_time) }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name">

                                                            <!-- {{ chatdetails.chat_type }} -  {{  chatdetails.to  }}  - {{  chatdetails.form }} -  {{  chatdetails.to_id }} -->

                                                            {{ (chatdetails.chat_type === 'staff') ? staffinfodetails.name : 'admin'}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="chat-input-section p-3 p-lg-4 border-top mb-0">
                                        <div class="row g-0">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-lg bg-light border-light" :placeholder="'Please write a message for '+staffinfodetails.name" v-model="chatform.message" @keypress="handleKeyPressChat($event)">
                                            </div>
                                            <div class="col-auto">
                                                <div class="chat-input-links ms-md-2 me-md-0">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <button type="submit" @click="sendNotification()" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
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

                            <div v-else class="col-9 col-md-9 ps-0">
                                <div class="sms-right-sidebar">
                                    <div class="d-flex justify-content-between sms-right-header">
                                        <b> Please select staff</b>
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
        import {
            defineComponent,
            ref,
            reactive,
            watch,
            nextTick,
            onMounted
        } from 'vue'; // Import necessary functions;
        import OperationHeader from '@/header/Operation.vue';
        import {
            useCommonFunction
        } from './../../func/function.js';

        // console.log(Header);

        export default defineComponent({

            components: {
                OperationHeader
            },

            setup() {

                const {
                    sendData,
                    initialsName,
                    createCustomSwal,
                    createErrorCustomSwal,
                    datetimefm,
                    timefm
                } = useCommonFunction();

                const customSwal = createCustomSwal();
                const ErrorcustomSwal = createErrorCustomSwal();

                const searchQuery = ref(""); // Reactive search query
                const stafflist = ref({});
                const originalStaffList = ref({});
                const chatContainer = ref(null); // Reference to the chat container

                const getStafflist = async () => {
                    try {
                        const response = await sendData('get', '/chat-get-staff-list', {});

                        // console.log(response);

                        stafflist.value = response;
                        originalStaffList.value = response;

                    } catch (error) {

                        console.error('Error fetching staff list:', error);
                    }
                };

                const SitesLocation = ref([]);
                const getSites = async () => {
                    try {
                        const response = await sendData('get', '/api/get-sites', {});
                        SitesLocation.value = response;
                    } catch (err) {
                        console.error('Error fetching site details:', err);
                    }
                };

                const fetchSearchResults = async () => {
                    if (searchQuery.value.trim() !== "") {
                        try {

                            if (searchQuery.value.length > 1) {
                                stafflist.value = originalStaffList.value.filter((staff) =>
                                    staff.name.toLowerCase().includes(searchQuery.value.toLowerCase())
                                );
                            }

                        } catch (error) {
                            console.error("Error fetching search results:", error);
                        }
                    } else {
                        stafflist.value = originalStaffList.value;
                        //console.error('Error fetching staff list:', error);
                    }
                };

                const staffinfodetails = ref({});
                const chatdetailsdata = ref({});
                const showchatDetails = async (staffinfo) => {

                    const formData = {
                        staff_id: staffinfo.id,
                        mobile: staffinfo.mobile,
                        name: staffinfo.name
                    }

                    try {
                        const response = await sendData('get', '/chat-details', formData);
                        chatdetailsdata.value = response.data;

                    } catch (err) {
                        console.error('Error fetching site details:', err);
                    }

                    //console.log(formData);

                    staffinfodetails.value = staffinfo;

                    console.log(staffinfo);

                }

                const handleKeyPressChat = (event) => {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        sendNotification();
                    }
                };

                const chatform = ref({
                    staff_id: 0,
                    message: '',
                    staff_name: ''
                })
                const sendNotification = async () => {
                    chatform.value.staff_id = staffinfodetails.value.id;
                    chatform.value.staff_name = staffinfodetails.value.name;

                    const formData = {
                        ...chatform.value
                    };

                    try {
                        const response = await sendData('post', '/send-chat-message', formData);

                        chatform.value = {
                            staff_id: 0,
                            message: '',
                            staff_name: ''
                        };

                        if (response.success === true) {

                            if (Array.isArray(chatdetailsdata.value)) {
                                chatdetailsdata.value.push(response.data);
                            }

                            customSwal.fire({
                                title: response.message,
                                icon: 'success',
                                iconColor: '#4CAF50',
                            });

                            setTimeout(() => {
                                const container = chatContainer.value;
                                if (container) {
                                    container.scrollTop = container.scrollHeight;
                                }
                            }, 100); // Adjust the delay if needed

                        } else if (response.success === false) {
                            ErrorcustomSwal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                iconColor: '#FF5722',
                                customClass: {
                                    popup: 'custom-swal-popup custom-swal-error'
                                }
                            });
                        }

                    } catch (err) {
                        console.error('Error fetching site details:', err);
                    }
                }

                const splitServices = (serviceString) => {
                    if (!serviceString) return [];
                    return serviceString
                        .split(",") // Split by commas
                        .map((service) => service.trim()); // Remove extra spaces
                };

                // Watch chat details and scroll to the bottom whenever new data is added
                watch(chatdetailsdata, async () => {
                    await nextTick(() => {
                        const container = chatContainer.value;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    });
                });

                onMounted(() => {
                    getStafflist(); // Initial fetch of data
                    getSites();

                });

                return {
                    stafflist,
                    fetchSearchResults,
                    searchQuery,
                    initialsName,
                    showchatDetails,
                    staffinfodetails,
                    splitServices,
                    SitesLocation,
                    chatdetailsdata,
                    datetimefm,
                    chatContainer,
                    timefm,
                    handleKeyPressChat,
                    chatform,
                    sendNotification,
                }

            }

        });
</script>
