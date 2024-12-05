<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">User Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="includes/upload_image_verify.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">

                        <input type="hidden" class="form-control" id="userId" name="userId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="idPictures" class="form-label">Upload ID Pictures</label>
                        <input type="file" class="form-control" id="idPictures" name="idPictures[]" multiple accept="image/*">
                    </div>
                    <button type="submit" name="save_photos" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>