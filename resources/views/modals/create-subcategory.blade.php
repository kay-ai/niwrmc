<!-- Modal -->
<div class="modal fade" id="create-subcategory" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Create License Type</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('subcategories.create')}}" id="create_category_form" method="POST">
                @csrf
                <div class="modal-body" id="generate_evidence_body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">License Type Name:</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Category Name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="license_category_id">Category Name:</label>
                                <select name="license_category_id" class="form-control form-select" value="{{old('license_category_id')}}">
                                    <option>- Select an Option -</option>
                                    @if ($categories)
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="processing_fee">Processing Fee: (&#8358;)</label>
                                <input type="number" step="0.01" value="{{old('processing_fee')}}" name="processing_fee" class="form-control" placeholder="500000" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="licensing_fee">Licensing Fee: (&#8358;)</label>
                                <input type="number" step="0.01" value="{{old('licensing_fee')}}" name="licensing_fee" class="form-control" placeholder="500000" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
