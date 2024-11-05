<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-device-mobile-message"></i>
                                </div>
                                <h5 class="card-title"> Send SMS / Notification </h5>
                        </div>

                       <div class="row">
                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Select User</label>
                                <select class="form-select">
                                    <option value="0">Select</option>
                                    <option value="0401899887">panakj</option>
                                </select>

                            </div>

                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">To</label>
                                <select class="form-select">
                                    <option value="0">Select</option>
                                    <option value="1">Ng Contact</option>
                                    <option value="2">Ng-no Contact</option>
                                    <option value="4">Delayed Pay</option>
                                    <option value="3">Reclean Exit Report</option>
                                    <option value="5">Pest Invoice</option>
                                    <option value="6">Contact Customer For Arrangements</option>
                                    <option value="7">Customer Call Back</option>
                                    <option value="8">Remaining Bal Due</option>
                                    <option value="12">Reclean Update</option>
                                    <option value="9">Insufficient Funds</option>
                                    <option value="10">Upsell Confirm</option>
                                    <option value="11">Address Required</option>
                                    <option value="13">Cleaner Will Contact To Conf Time &amp; Access</option>
                                    <option value="14">Delayed Pay-no Checklist</option>
                                    <option value="15">Job Complete Sms</option>
                                    <option value="16">Removal Completion Sms</option>
                                    <option value="17">Grievance/damage</option>
                                    <option value="19">Completion Message (removals)</option>
                                    <option value="20">Removals Payment Due Message</option>
                                    <option value="21">Call Back Sms (removals)</option>
                                    <option value="22">48 Hour Check- Domestic Cleaning</option>
                                    <option value="23">24 Hour Check- Domestic Cleaning</option>
                                    <option value="24">Domestic Cleaning Completion</option>
                                    <option value="25">48 Hour Check- Gardening  Cleaning</option>
                                    <option value="26">24 Hour Check- Gardening  Cleaning</option>
                                    <option value="27"> Gardening  Completion </option>
                                    <option value="28">Client Details To Staff</option>
                                    <option value="29">Cleaner Message On The Day</option>
                                    <option value="30">Customer Message On The Day</option>
                                    <option value="31">Product Review Message</option>
                                    <option value="32">Refund Cleaner Sms</option>
                                </select>
                            </div>


                            <div class="col col-md-4 mb-3">
                                <label class="form-label fw-semibold">Mobile No</label>
                                <input type="text" class="form-control" placeholder="Mobile Number">
                            </div>


                            <div class="col col-md-12 mb-2">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea rows="6" cols="4" class="form-control" placeholder="Enter Your Message"></textarea>
                            </div>

                            <div class="col col-md-12 mb-3 text-end">
                                <button type="submit" class="btn btn-primary bcic_btns">Send SMS </button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, toRefs , ref} from 'vue';

export default defineComponent({
  name: 'Job Reclean',
  props: {
    jobId: {
      type: [String, Number],
      required: true
    }
  },
  setup(props) {
    const { jobId } = toRefs(props); // Destructure the jobId from props
    const noresultfoundImg = ref('/assets/img/noresultfound.jpg');

    // You can use jobId.value in your methods or template
    console.log('Job ID in job Reclean component:', jobId.value);

    return {
      jobId,
      noresultfoundImg
    };
  }
});
</script>