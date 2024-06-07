<!-- Modal -->
<div class="modal fade" id="approve-license" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Approve License</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="approve_evidence_body">
                <h3 class="text-center">Are you sure you want to Approve this License?</h3>
                <p class="text-secondary text-center">
                    By clicking approve, you agree that you have verified that all license documents are correct.
                </p>
            </div>
            <form action="" id="approve_license_form" method="POST">
                @csrf
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
