<!-- Modal -->
<div class="modal fade" id="edit-permission" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Edit Permission</h5>
                <button type="button" class="close ml-auto" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-permission-form" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="panel panel-default card-view box-shadow" style="border-radius: 10px;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="mb-0 text-dark">Permission Name:</h6>
                                    <div class="form-group">
                                        <input type="text" id="permission_name" name="name" class="form-control" placeholder="Permission Name" aria-describedby="permissionname" required>
                                        <small id="helpId" class="input-help-text text-muted">Enter Permission Name</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <input type="hidden" id="permission_id" name="permission_id" value="" />
            </form>
        </div>
    </div>
</div>
