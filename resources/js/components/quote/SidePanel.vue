<template>
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
</template>

<script >
import {defineComponent, onMounted } from 'vue'; // Import necessary functions
//import axios from 'axios'; // Import Axios

export default defineComponent({

  props: {
    sidequoteinfo: {
      type: Object,
      required: true
    },
  },
  setup(props) {
   
 

    // Example usage of onMounted
    onMounted(() => {
      if (props.sidequoteinfo.length > 0) {
         
            console.log('Start Pankaj Gupta');
            console.log(props.sidequoteinfo);
            console.log('End Pankaj Gupta');
         // getJobtypeDetails(props.sidequoteinfo[0]);
      }else{
        console.log('Pankaj');
        console.log(props);
      }
    });

    return {

    };
  },
});
</script>