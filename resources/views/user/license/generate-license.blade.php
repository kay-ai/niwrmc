<!-- Modal -->
<div class="modal fade" id="generate-license" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Generate License</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="" id="generate_license_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" id="generate_evidence_body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact-address">Licensed As:</label>
                                <input type="text" name="licensed_as" class="form-control" placeholder="Water Well Drilling Company" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact-address">Company Address:</label>
                                <input type="text" name="company_address" class="form-control" placeholder="Enter Address of Company" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact-address">Hydrological Area:</label>
                                <input type="text" name="hydrological_area" class="form-control" placeholder="HA-II" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact-address">State:</label>
                                <input type="text" name="state" class="form-control" placeholder="FCT Abuja" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact-address">Local Government Area:</label>
                                <input type="text" name="lga" class="form-control" placeholder="AMAC" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact-address">Signature of Approval:</label>
                                <input type="file" name="signature" class="form-control" accept="image/jpeg, image/png, image/jpg" required>
                            </div>
                        </div>
                        <small class="text-secondary text-center">
                            Clicking generate will make this license available to the Applicant.
                        </small>
                    </div>
                </div>
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
