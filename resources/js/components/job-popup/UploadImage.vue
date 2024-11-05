<template>
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-photo-up"></i>
                                </div>
                                <h5 class="card-title"> Upload Images </h5>
                        </div>




                        <div class="upload_box mb-4">
                            <input type="file" name="file-5[]" id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
                            <label for="file-5"><figure><img :src="uploadimageImg" alt="Upload Image"/></figure> <span>Drag & Drop file anywhere to upload them</span></label>
				        </div>






                        <div class="card-header ps-0 pt-0 mb-3">
                                <div class="mask is-squircle flex size-10 items-center justify-center bg-info/10">
                                    <i class="ti ti-photo-up"></i>
                                </div>
                                <h5 class="card-title"> Your Image File </h5>
                        </div>

                        <ul class="otd_upload_imgs">
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                            <li><img :src="cleaningimageImg" alt="No Result Found"/></li>
                        </ul>





                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref , onMounted  } from 'vue'; // Import necessary functions
    const uploadimageImg = ref('/assets/img/upload_img.png');
    const cleaningimageImg = ref('/assets/img/otd_cleaning_img.png');






</script>
