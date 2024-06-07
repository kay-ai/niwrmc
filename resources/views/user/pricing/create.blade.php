<!-- Modal -->
<div class="modal fade" id="create-price" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Create Price</h5>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/create-price" method="post">
                @csrf
                <div class="modal-body">
                    <div class="panel panel-default card-view box-shadow" style="border-radius: 10px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h6 class="mb-0 text-dark">License Name:</h6>
                                    <div class="form-group">
                                        <select name="license_name" class="form-control" required>
                                            <option value="">- Select an Option -</option>
                                            <option value="discharge-of-waste">Discharge of Waste Water License</option>
                                            <option value="bore-hole-contractors">Borehole Construction Contractors License</option>
                                            <option value="drillers-license">Drillers License</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-0 text-dark">Price Category:</h6>
                                    <div class="form-group">
                                        <select name="category" class="form-control" required>
                                            <option value="">- Select an Option -</option>
                                            <option value="processing_fee">Processing Fee</option>
                                            <option value="licensing_fee">Licensing Fee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-0 text-dark">License Price:</h6>
                                    <div class="form-group">
                                        <input type="number" step="0.01" name="price" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
