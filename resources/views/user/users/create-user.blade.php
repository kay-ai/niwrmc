<!-- Modal -->
<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content cs_modal">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Create User</h5>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('users.create')}}" id="create_users_form" method="POST">
                @csrf
                <div class="modal-body" id="generate_evidence_body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Address:</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
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
