<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                           <!--Create Quote Section Start Here-->
                           <div class="mt-3">
                            <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <h5 class="card-title">  Create Quote </h5>
                                </div>


                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col  mb-3">
                                        <label class="form-label">Quote For <span class="text-danger"> * </span></label>
                                        <select class="form-select">
                                        <option selected="">State</option>
                                        <option value="1">Bcic</option>
                                        <option value="2">Bbc</option>
                                        <option value="3">Br</option>
                                        <option value="4">B Hub</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Post Code <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" placeholder="Enter Suburb or Postcode...">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Site Id <span class="text-danger"> * </span></label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Gc</option>
                                        <option value="2">Sc</option>
                                        <option value="3">Ad</option>
                                        <option value="4">Nc</option>
                                        <option value="5">Bris</option>
                                        <option value="6">Mel</option>
                                        <option value="7">Can</option>
                                        <option value="8">Syd</option>
                                        <option value="9">Wlg</option>
                                        <option value="10">Prth</option>
                                        <option value="11">Twsv</option>
                                        <option value="12">Glg</option>
                                        <option value="13">Hbt</option>
                                        <option value="14">Ptq</option>
                                        <option value="15">Dr</option>
                                        <option value="16">Ips</option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Job Date </label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary bcic_btns" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Check Availability</button>
                                    </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-briefcase"></i>
                                    </div>
                                    <h5 class="card-title">  Select Job Details</h5>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Reference </label>
                                        <select class="form-select" id="bcic_reference_type" onchange="showDiv()">
                                            <option value="default">Select</option>
                                            <option value="hidden_div1">Cleaning</option>
                                            <option value="hidden_div2">Carpet</option>
                                            <option value="hidden_div3">Gardening</option>
                                            <option value="hidden_div4">Others</option>
                                            <option value="hidden_div5">Removal</option>
                                            <option value="hidden_div6">Domestic Cleaning</option>
                                        </select>
                                        </div>
                                    </div>

                                </div>



                                <!--BCIC Cleaning start Here-->
                                <div class="bcic_cleaning_quote bcic_hide" id="hidden_div1" >
                                    <div class="card-header">
                                    <h5 class="card-title">BCIC Cleaning</h5>
                                    </div>
                                    <div class="card-body pb-0">

                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Bed</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">Bath</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Study</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Toilet </label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Leving Area</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>
                                        </div>



                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Furnished</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">House Type</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="Unit" selected="">Unit</option>
                                            <option value="House">House</option>
                                            <option value="Two Storey">Two Storey</option>
                                            <option value="Multi Storey">Multi Storey</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Blinds</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="No Blinds">No Blinds</option>
                                            <option value="Vertical">Vertical</option>
                                            <option value="Venetians">Venetians</option>
                                            <option value="Rollers">Rollers</option>
                                            <option value="Shutters">Shutters</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Wall Wash </label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        </div>


                                    </div>

                                    <div class="card-header">
                                    <h5 class="card-title">Recurring Details</h5>
                                    </div>

                                    <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                        <label class="form-label">Recurring Job <span class="text-danger"> * </span> </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        </div>

                                        <div class="col-6 mb-3">
                                        <label class="form-label">Recurring Type</label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Weekly</option>
                                            <option value="2">Fortnightly</option>
                                            <option value="3">Monthly</option>
                                            <option value="4">Quarterly</option>
                                            <option value="5">Bi Yearly</option>
                                            <option value="5">Yearly</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h5 class="card-title">Quote Details</h5>
                                </div>


                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Estimate Status</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">No</option>
                                        <option value="2">Approved-yes</option>
                                        <option value="3">Fixed Price</option>
                                        </select>
                                    </div>

                                    <div class="col-3 mb-3">
                                        <label class="form-label">White Goods </label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">Pets on Property</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">Client Type</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="2">Realestate</option>
                                        <option value="1">Landlord</option>
                                        <option value="3">Tenant</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">Do you have any gardening requirements</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        </select>
                                    </div>



                                    <div class="col-3 mb-3">
                                        <label class="form-label"> Parking</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Free-street Parking</option>
                                        <option value="2">Metered-street Parking</option>
                                        <option value="3">At The Property</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">How long you have lived in the property?</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">6 Months</option>
                                        <option value="2">1 Year</option>
                                        <option value="3">2 Years</option>
                                        <option value="4">3 Years</option>
                                        <option value="5">4 Years</option>
                                        <option value="5">5+ Years</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">Do you need a removal quote</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="2">Yes</option>
                                        <option value="1">No</option>
                                        </select>
                                    </div>

                                    <div class="col-3 mb-3">
                                        <label class="form-label">Would you like a removal quote.?</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="2">Booked Elsewhere</option>
                                        <option value="3">Moving Themselves</option>
                                        <option value="4">Book/quote With Us</option>
                                        <option value="5">N/a</option>
                                        </select>
                                    </div>


                                    <div class="col-3 mb-3">
                                        <label class="form-label">How much Bond are we aiming to secure?</label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Upto $1500</option>
                                        <option value="2">Upto $2000</option>
                                        <option value="3">Upto $3000</option>
                                        <option value="4">$3000 +</option>
                                        </select>
                                    </div>



                                    </div>
                                </div>

                                </div>
                                <!--BCIC Cleaning End Here-->


                                <!--BCIC Carpet start Here-->
                                <div class="bcic_cleaning_quote bcic_hide" id="hidden_div2" >
                                    <div class="card-header">
                                    <h5 class="card-title">BCIC Carpet</h5>
                                    </div>
                                    <div class="card-body pb-0">

                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Bedroom</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Living Area & Dinning</label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Stairs </label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Stains </label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">Floor</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Ground Floor</option>
                                            <option value="2">1st Floor</option>
                                            <option value="3">2nd Floor</option>
                                            <option value="4">Above</option>
                                            </select>
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label">Stain removal service?</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>

                                        </div>



                                        <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        </div>


                                    </div>



                                </div>
                                <!--BCIC Carpet End Here-->

                                <!--Gardening start Here-->
                                <div class="bcic_cleaning_quote bcic_hide" id="hidden_div3" >
                                    <div class="card-header">
                                    <h5 class="card-title">Gardening</h5>
                                    </div>
                                    <div class="card-body pb-0">

                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Desc</label>
                                            <input type="text" name="desc" class="form-control" value="Minimum call out 2 hrs for 1 gardener, $60 for any additional hour if required, specialised services shall be quoted on the day. Please provide list of areas to gardeners to attend. Bond Back Guarantee not offered on service" style="width:70%!important; text-align:left!important;">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Amount </label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>
                                        </div>
                                        <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <!--Gardening End Here-->

                                <!--Other start Here-->
                                <div class="bcic_cleaning_quote bcic_hide" id="hidden_div4" >
                                    <div class="card-header">
                                    <h5 class="card-title">Domestic Cleaning</h5>
                                    </div>
                                    <div class="card-body pb-0">

                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Desc</label>
                                            <input type="text" name="desc" class="form-control" value="Minimum call out 2 hrs for 1 gardener, $60 for any additional hour if required, specialised services shall be quoted on the day. Please provide list of areas to gardeners to attend. Bond Back Guarantee not offered on service" style="width:70%!important; text-align:left!important;">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Amount </label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        </div>



                                        <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <!--Other End Here-->


                                <!--br removals start Here-->
                                <div class="bcic_removals_quote  bcic_hide" id="hidden_div5" >
                                        <div class="card-header">
                                        <h5 class="card-title">Better Removals</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                            <div class="col mb-3">
                                                <label class="form-label">Bed</label>
                                                <input type="text" class="form-control" placeholder="0">
                                            </div>

                                            <div class="col mb-3">
                                                <label class="form-label">Study</label>
                                                <input type="text" class="form-control" placeholder="0">
                                            </div>

                                            <div class="col mb-3">
                                                <label class="form-label"> Living Area</label>
                                                <input type="text" class="form-control" placeholder="0">
                                            </div>

                                            <div class="col mb-3">
                                                <label class="form-label"> Kitchen </label>
                                                <input type="text" class="form-control" placeholder="0">
                                            </div>

                                            <div class="col mb-3">
                                                <label class="form-label"> Dining</label>
                                                <input type="text" class="form-control" placeholder="0">
                                            </div>
                                            </div>

                                            <div class="row">
                                            <div class="col mb-3">
                                                <label class="form-label">Moving From </label>
                                                <textarea rows="3" cols="3" class="form-control" placeholder="Enter a Location"></textarea>
                                            </div>
                                            <div class="col mb-3">
                                                <label class="form-label">Moving To </label>
                                                <textarea rows="3" cols="3" class="form-control" placeholder="Enter a Location"></textarea>
                                            </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-3 mb-3">
                                                <label class="form-label">On Level From <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Ground</option>
                                                <option value="2">1st</option>
                                                <option value="3">2nd</option>
                                                <option value="4">Above Third</option>
                                                </select>
                                            </div>

                                            <div class="col-3 mb-3">
                                                <label class="form-label">Has Lift/Elevator From </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">Home Type From <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">High Rise Unit</option>
                                                <option value="2">House</option>
                                                <option value="3">Apartment</option>
                                                <option value="4">Storage</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">Door Distance From <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">20 Meters</option>
                                                <option value="2">40 Meters</option>
                                                <option value="3">60 Meters</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">On Level To<span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Ground</option>
                                                <option value="2">1st</option>
                                                <option value="3">2nd</option>
                                                <option value="4">Above Third</option>
                                                </select>
                                            </div>

                                            <div class="col-3 mb-3">
                                                <label class="form-label">Has Lift/Elevator To </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">Home Type To <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">High Rise Unit</option>
                                                <option value="2">House</option>
                                                <option value="3">Apartment</option>
                                                <option value="4">Storage</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">Door Distance To <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">20 Meters</option>
                                                <option value="2">40 Meters</option>
                                                <option value="3">60 Meters</option>
                                                </select>
                                            </div>

                                            <div class="col-3 mb-3">
                                                <label class="form-label">Day Time <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1" selected="">10am-1pm</option>
                                                <option value="2">1pm-5pm</option>
                                                <option value="3">5pm-8pm</option>
                                                </select>
                                            </div>


                                            <div class="col-3 mb-3">
                                                <label class="form-label">Stairs <span class="text-danger"> * </span> </label>
                                                <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="2">4</option>
                                                <option value="3">5</option>
                                                </select>
                                            </div>


                                            <div class="col-4 mb-3">
                                                <label class="form-label">Add Inventory  </label>
                                                <textarea rows="2" cols="2" class="form-control" placeholder="Enter a Location"></textarea>
                                            </div>

                                            <div class="col-2 mb-3">
                                                <button type="submit" class="btn btn-primary bcic_btns">Add</button>
                                            </div>




                                            </div>
                                        </div>

                                        <div class="card-header">
                                        <h5 class="card-title">Recurring Details</h5>
                                        </div>

                                        <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                            <label class="form-label">Recurring Job <span class="text-danger"> * </span> </label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            </div>

                                            <div class="col-6 mb-3">
                                            <label class="form-label">Quote Details </label>
                                            <select class="form-select">
                                                <option value="0">Select</option>
                                                <option value="1">Weekly</option>
                                                <option value="2">Fortnightly</option>
                                                <option value="3">Monthly</option>
                                                <option value="4">Quarterly</option>
                                                <option value="5">Bi Yearly</option>
                                                <option value="5">Yearly</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-header">
                                        <h5 class="card-title">Quote Details</h5>
                                    </div>


                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Estimate Status</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">No</option>
                                            <option value="2">Approved-yes</option>
                                            <option value="3">Fixed Price</option>
                                            </select>
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label class="form-label">White Goods </label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">Pets on Property</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">Client Type</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="2">Realestate</option>
                                            <option value="1">Landlord</option>
                                            <option value="3">Tenant</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">Do you have any gardening requirements</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            </select>
                                        </div>



                                        <div class="col-3 mb-3">
                                            <label class="form-label"> Parking</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Free-street Parking</option>
                                            <option value="2">Metered-street Parking</option>
                                            <option value="3">At The Property</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">How long you have lived in the property?</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">6 Months</option>
                                            <option value="2">1 Year</option>
                                            <option value="3">2 Years</option>
                                            <option value="4">3 Years</option>
                                            <option value="5">4 Years</option>
                                            <option value="5">5+ Years</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">Do you need a removal quote</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="2">Yes</option>
                                            <option value="1">No</option>
                                            </select>
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label class="form-label">Would you like a removal quote.?</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="2">Booked Elsewhere</option>
                                            <option value="3">Moving Themselves</option>
                                            <option value="4">Book/quote With Us</option>
                                            <option value="5">N/a</option>
                                            </select>
                                        </div>


                                        <div class="col-3 mb-3">
                                            <label class="form-label">How much Bond are we aiming to secure?</label>
                                            <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Upto $1500</option>
                                            <option value="2">Upto $2000</option>
                                            <option value="3">Upto $3000</option>
                                            <option value="4">$3000 +</option>
                                            </select>
                                        </div>



                                        </div>
                                    </div>

                                </div>
                                <!--br removals End Here-->




                                <!--Domestic Cleaning start Here-->
                                <div class="bcic_cleaning_quote bcic_hide" id="hidden_div6" >
                                    <div class="card-header">
                                    <h5 class="card-title">Domestic Cleaning</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Desc</label>
                                            <input type="text" name="desc" class="form-control" value="Minimum call out 2 hrs for 1 gardener, $60 for any additional hour if required, specialised services shall be quoted on the day. Please provide list of areas to gardeners to attend. Bond Back Guarantee not offered on service" style="width:70%!important; text-align:left!important;">
                                        </div>

                                        <div class="col mb-3">
                                            <label class="form-label"> Amount </label>
                                            <input type="text" class="form-control" placeholder="0">
                                        </div>

                                        </div>



                                        <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <!--Domestic Cleaning End Here-->
                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-user-circle"></i>
                                    </div>
                                    <h5 class="card-title">  Personal Details</h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Name <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Phone No <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" placeholder="Enter Phone No">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Email<span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" placeholder="Enter Email">
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Reference </label>
                                        <select class="form-select">
                                        <option value="0">Select</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Email">Email</option>
                                        <option value="Chat">Chat</option>
                                        <option value="Site">Site</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Realestate">Realestate</option>
                                        <option value="BBC App">Bbc App</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Best time to contact </label>
                                        <select class="form-select">
                                        <option value="">Select</option>
                                                            <option value="07:30-08:00">07:30-08:00</option>
                                        <option value="08:00-08:30">08:00-08:30</option>
                                        <option value="08:30-09:00">08:30-09:00</option>
                                        <option value="09:00-09:30">09:00-09:30</option>
                                        <option value="09:30-10:00">09:30-10:00</option>
                                        <option value="10:00-10:30">10:00-10:30</option>
                                        <option value="10:30-11:00">10:30-11:00</option>
                                        <option value="11:00-11:30">11:00-11:30</option>
                                        <option value="11:30-12:00">11:30-12:00</option>
                                        <option value="12:00-12:30">12:00-12:30</option>
                                        <option value="12:30-13:00">12:30-13:00</option>
                                        <option value="13:00-13:30">13:00-13:30</option>
                                        <option value="13:30-14:00">13:30-14:00</option>
                                        <option value="14:00-14:30">14:00-14:30</option>
                                        <option value="14:30-15:00">14:30-15:00</option>
                                        <option value="15:00-15:30">15:00-15:30</option>
                                        <option value="15:30-16:00">15:30-16:00</option>
                                        <option value="16:00-16:30">16:00-16:30</option>
                                        <option value="16:30-17:00">16:30-17:00</option>
                                        <option value="17:00-17:30">17:00-17:30</option>
                                        <option value="17:30-18:00">17:30-18:00</option>
                                        </select>
                                    </div>




                                    </div>

                                    <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Address </label>
                                        <textarea rows="4" cols="4" class="form-control" placeholder="Enter Your Location"></textarea>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Comments </label>
                                        <textarea rows="4" cols="4" class="form-control" placeholder="Enter Comments Here"></textarea>
                                    </div>
                                    </div>






                                </div>




                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="card">
                                <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <h5 class="card-title"> Quote Section</h5>
                                </div>

                                <div class="card-body">
                                    <div class="bcic_quote_box mb-3">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>
                                            <label class="form-label"> Cleaning </label>
                                            <select name="quote_auto_custom" class="form-select">
                                                <option value="1" selected="">Auto</option>
                                                <option value="2">Custom</option>
                                            </select>
                                            </th>

                                            <th>
                                            <label class="form-label"> Hours</label>
                                            <input type="text" class="form-control" placeholder="8">
                                            </th>

                                            <th>
                                            <label class="form-label"> Discount </label>
                                            <input type="text" class="form-control" placeholder="">
                                            </th>

                                            <th>
                                            <label class="form-label"> Rate </label>
                                            <input type="text" class="form-control" placeholder="50">
                                            </th>

                                            <th>
                                                <label class="form-label"> Total </label>
                                                <input type="text" class="form-control" placeholder="400">
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="5">
                                            <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="bcic_quote_del">
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>

                                    </div>


                                    <div class="bcic_quote_box mb-3">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="4" >
                                            <label class="form-label"> Cleaning </label>

                                            </th>

                                            <th>
                                                <label class="form-label"> Total </label>
                                                <input type="text" class="form-control" placeholder="400">
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="5">
                                            <textarea rows="2" cols="2" class="form-control" placeholder="Enter Your Location"></textarea>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="bcic_quote_del">
                                        <a href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                    </div>

                                    </div>

                                    <div class="bcic_quote_box mb-3">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="4" >
                                            <label class="form-label"> Total </label>
                                            </th>

                                            <th>
                                                <label class="form-label"> 	$500 </label>
                                            </th>

                                        </tr>
                                        </thead>

                                    </table>

                                    <button type="submit" class="btn btn-primary mt-3 mb-3">Save Quote</button>

                                    <div class="bcic_btns_quote_section">
                                        <ul>
                                        <li> <button type="submit" class="btn btn-secondary"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasQuestionquote" aria-controls="offcanvasQuestionquote">Quote Questions</button></li>
                                        <li> <button type="submit" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewquotsModalLg">View Quote</button></li>
                                        <li> <button type="submit" class="btn btn-success">Email Quote</button></li>
                                        <li> <button type="submit" class="btn btn-dark">Auto Follow Up</button></li>
                                        <li> <button type="submit" class="btn btn-warning">Lost Quote</button></li>
                                        <li>
                                            <select name="quote_auto_custom" class="form-select">
                                            <option value="1">Select</option>
                                            <option value="2">Mohit Sethi </option>
                                            <option value="3">Nadia Abdoolla</option>
                                            <option value="4">Naval Verma</option>
                                            <option value="5">Mahima Saini</option>
                                            <option value="6"> Kailash Singh</option>
                                            <option value="7"> Indrani Saikia </option>
                                            </select>
                                        </li>

                                        <li> <button type="submit" class="btn btn-primary">Book Now</button></li>
                                        </ul>


                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--Create Quote Section End Here-->




                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
