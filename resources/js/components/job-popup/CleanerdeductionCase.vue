<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-receipt-2"></i>
                                </div>
                                <h5 class="card-title"> Cleaner Deduction Case </h5>
                        </div>


                        <div class="row">
                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Type </label>
                                        <select class="form-select">
                                            <option value="0">Select</option>
                                            <option value="61">Cleaning</option>
                                            <option value="49">Carpet</option>
                                        </select>
                                    </div>

                                    <div class="col col-md-6 mb-3">
                                        <label class="form-label fw-semibold"> Amount </label>
                                        <input type="text" class="form-control" placeholder="Please Enter Amount">
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Reason </label>
                                        <textarea rows="2" cols="2" class="form-control" placeholder="Please Enter Reason"></textarea>
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <label class="form-label fw-semibold"> Choose file </label>
                                        <input class="form-control" type="file">
                                    </div>

                                    <div class="col col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                        </div>



                        <div class="bcic_view_quote_table table-responsive mb-5">
                            <table class="table table-bordered mt-2 fs-14 payment_table">
                                <thead>
                                    <tr>
                                        <th> Sr No </th>
                                        <th> Staff Name </th>
                                        <th> Job ID </th>
                                        <th> Amount </th>
                                        <th> Reason</th>
                                        <th> file </th>
                                        <th> Created On </th>
                                        <th> Added By</th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Cleaning </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Oslar,Ganga Prasad,Veerpal Singh Deol </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>

                                    </tr>

                                    <tr>
                                        <td> Carpet </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> Anor Ahmed,Buddy </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                        <td> N/A </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
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
