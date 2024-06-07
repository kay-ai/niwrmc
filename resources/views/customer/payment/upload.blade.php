<div class="modal fade" id="upload-payment" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Upload Payment Receipt</h5>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="upload_payment_form" enctype="multipart/form-data" class="mb-0">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <h6 class="mb-2 text-dark">Payment Receipt:</h6>
                            <div class="form-group">
                                <input type="file" id="receipts" name="receipts[]" class="form-control" accept="image/jpeg, image/png, image/gif" multiple required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
