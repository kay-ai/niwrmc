<!-- Modal -->
<div class="modal fade" id="delete-license" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Delete License</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body" id="view_card_body">
               <p>Are you sure you want to delete this License?</p>
            </div>
            <form method="post" id="license_delete_form">
                @csrf
                <div class="modal-footer pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
