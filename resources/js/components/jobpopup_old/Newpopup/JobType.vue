<template>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                                    <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                        <i class="ti ti-briefcase-2"></i>
                                    </div>
                                    <h5 class="card-title"> Add Job Type</h5>
                                </div>


                                <div class="card-body pb-0">
                                    <div class="row">
                                    <div class="col  mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="1">Cleaning</option>
                                            <option value="2">Carpet</option>
                                            <option value="3">Pest</option>
                                            <option value="4">Gardening</option>
                                            <option value="5">Upholstery</option>
                                            <option value="6">Bbq</option>
                                            <option value="7">Oven</option>
                                            <option value="8">Spring Cleaning</option>
                                            <option value="9">Others</option>
                                            <option value="10">Reclean</option>
                                            <option value="12">Handymen</option>
                                            <option value="13">Extras</option>
                                            <option value="14">Postponement Fee</option>
                                            <option value="15">Commercial Clean</option>
                                            <option value="16">Grout Cleaning</option>
                                            <option value="17">Plumbers</option>
                                            <option value="18">Electrician</option>
                                            <option value="19">Locksmith</option>
                                            <option value="20">Commission</option>
                                            <option value="21">Removal Packaging</option>
                                            <option value="22">Local Moves</option>
                                            <option value="23">Interstate Move</option>
                                            <option value="25">Domestic Cleaning</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Staff </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="189">Tawar Andiry</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="309">Yasser Saad El Hadek</option>
                                            <option value="505">Mohammed</option>
                                            <option value="544">Hatham  Mcmahon</option>
                                            <option value="662">Pankaj B2s  Test</option>
                                            <option value="1173">Dimitry</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1280">Hari Bahadur Ranabhat</option>
                                            <option value="1540">Jessica Gabriel</option>
                                            <option value="1571">Vantran </option>
                                            <option value="1678">Tresor Jean Luc Bukasa</option>
                                            <option value="1679">Bibek Khadka </option>
                                            <option value="1714">Narayan Panday</option>
                                            <option value="1865">Shaun Paul Morgan</option>
                                            <option value="1879">Khandaatsog Ganbat</option>
                                            <option value="1928">Projjwal Vaidya </option>
                                            <option value="1977">Jaime Alberto Marin </option>
                                            <option value="1991">Ronald Narayan</option>
                                            <option value="2113">Linda Nwachukwu</option>
                                            <option value="2246">Anmol Neupane </option>
                                            <option value="2250">Santosh Bhushal </option>
                                            <option value="2261">Shyam Shah</option>
                                            <option value="2295"> Roshni Sharad</option>
                                            <option value="2324">Yubaraj</option>
                                            <option value="2352">Shailaja Acharya Adhikari </option>
                                            <option value="2376">Rachael Streater </option>
                                            <option value="2384">Md Kamrul </option>
                                            <option value="2394"> Muhammad Umar </option>
                                            <option value="2410">Kazam Khan Mohammed </option>
                                            <option value="2428">Prithaviraj</option>
                                            <option value="2433">Steven Candra</option>
                                            <option value="2443">Amit Sandhu </option>
                                            <option value="2471">Ibiso Tekena Dokubo</option>
                                            <option value="2485">Nawasdeen Raufdeen Raufdeen</option>
                                            <option value="2488">Sabina Maharjan</option>
                                            <option value="2491">Yuri Vanessa Cuellar Graffe </option>
                                        </select>
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" >
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Time</label>
                                        <input type="time" class="form-control" >
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control" >
                                    </div>


                                    <div class="col mb-3">
                                        <label class="form-label">Staff Amount</label>
                                        <input type="text" class="form-control" >
                                    </div>

                                    <div class="col mb-3">
                                        <label class="form-label">Profit</label>
                                        <input type="text" class="form-control" >
                                    </div>




                                    <div class="col mb-3">
                                        <button type="submit" class="btn btn-primary bcic_btns me-2">Add Job Type</button>

                                    </div>
                                    </div>
                        </div>


                        <div class="card-header ">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-briefcase-2"></i>
                                </div>
                                <h5 class="card-title"> Job Types</h5>
                        </div>

                        <table class="table table-bordered table-hover mt-2 fs-14 job-type-table">
                            <thead class="table-primary">
                                <tr>
                                    <th>Type</th>
                                    <th>Staff</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Staff Amount</th>
                                    <th>Profit</th>
                                    <th>BCIC(% / F)</th>
                                    <th>Staff Paid</th>
                                    <th>SMS Send</th>
                                    <th>Notif Send</th>
                                    <th>DateTime</th>
                                    <th>Reset</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>

                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>


                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>


                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>


                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>


                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>


                                <tr>
                                    <td>Removal</td>
                                    <td>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="233">Pankaj Gupta Removal</option>
                                            <option value="1268">Sukhjot Singh </option>
                                            <option value="1551">Hemraj Cbd</option>
                                        </select>
                                    </td>
                                    <td>2024-02-02</td>
                                    <td>8:00 AM</td>
                                    <td>300</td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>N/A</td>
                                    <td>No</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td></td>
                                    <td><button type="submit" class="vq_date">Reset</button></td>
                                    <td><button type="button" class="btn btn-soft-danger"> <i class="ti ti-trash"></i> </button></td>
                                </tr>
                            </tbody>
                        </table>





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
