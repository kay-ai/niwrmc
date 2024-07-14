<!-- Modal -->
<div class="modal fade" id="create-category" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Create Category</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('categories.create')}}" id="create_category_form" method="POST">
                @csrf
                <div class="modal-body" id="generate_evidence_body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Category Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
