<!-- Modal -->
<div class="modal fade" id="verify-payment" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Verify Payment</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="verify_evidence_body">
                <h3 class="text-center">Are you sure you want to Verify this Payment?</h3>
                <p class="text-secondary text-center">
                    By clicking Verify, you agree that you have verified that all payment evidences are correct.
                </p>
            </div>
            <form action="" id="verify_payment_form" method="POST">
                @csrf
                <div class="modal-footer mb-0 pb-0 p-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Verify</button>
                </div>
            </form>
        </div>
    </div>
</div>
