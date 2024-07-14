$(document).ready(function() {
    $(document).on('change', '#check_all_permissions', function() {
        var checkAllStatus = $(this).prop('checked');
        $('input[name="permissions[]"]').prop('checked', checkAllStatus);
    });

    $(document).on('change', 'input[name="permissions[]"]', function() {
        var anyUnchecked = $('input[name="permissions[]"]:not(:checked)').length > 0;
        $('#check_all_permissions').prop('checked', !anyUnchecked);
        console.log(anyUnchecked)
    });
});

function viewInvoice(id, type){
    $('#view-invoice').modal('show');

    $.ajax({
        url: `/view-invoice/${id}`,
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{type: type},
        beforeSend: function(){
            $('#view-invoice .loading').show();
            $('#invoice_card_body').hide();
        },
        success: function(data) {
            // var dateString = '2023-06-21T15:43:07.000000Z';
            // var formattedDate = moment.parseZone(dateString).format('YYYY-MM-DD HH:mm:ss');

            $('#in_customer_name').html(data.customer.first_name+' '+data.customer.last_name);
            $('#in_customer_address').html(data.customer.address ?? '...');
            $('#in_reference').html(data.invoice.remita_rrr ?? '...');
            $('#remita_pay_btn').attr('data-rrr', data.invoice.remita_rrr ?? '');
            $('#in_status').html(data.invoice.status ?? '...');
            $('#in_date').html(moment(data.invoice.created_at).format('Do MMMM YYYY') ?? '...');
            $('.in_amount').html(Number(data.invoice.amount ?? 0).toLocaleString());
            $('.in_vendor_name').html(formatAndCapitalizeText(data.invoice.application_name) ?? '...');
            $('#in_account_name').html(data.invoice.application_name ?? '...');
            // $('#in_account_number').html(data.vendor.bank_account_number ?? '...');
            // $('#in_vendor_bank').html(data.vendor.bank_name ?? '...');
            $('#in_phase').html(formatAndCapitalizeText(data.invoice.category) ?? '...');
            // $('#in_spn').html(data.meter_request.contract_number ?? '...');
            if(data.invoice.status == 'paid'){
                $('#in_total_due').html('0');
                $('#in_status_div').addClass('bg-success');
                $('#remita_pay_btn').addClass('d-none');
                $('#in_status_div').removeClass('bg-danger');
            }else{
                $('#in_total_due').html(Number(data.invoice.amount ?? 0).toLocaleString());
                $('#in_status_div').addClass('bg-danger');
                $('#remita_pay_btn').removeClass('d-none');
                $('#in_status_div').removeClass('bg-success');
            }
        },
        complete: function(){
            $('#view-invoice .loading').hide();
            $('#invoice_card_body').show();
        },
        error: function(error){
            $('#view-invoice .loading').html(error);
        }
    });
}

function formatAndCapitalizeText(inputText) {
    var formattedText = inputText.split(/[-_]/).map(function(word) {
        return word.charAt(0).toUpperCase() + word.slice(1);
    }).join(' ');

    return formattedText;
}

function uploadReceipt(id){
    $('#upload-payment').modal('show');
    $('#upload_payment_form').attr('action', "/payments/upload/"+id);
}

function viewReceipt(id){
    $('#view-receipt').modal('show');

    $.ajax({
        url: "/view-receipt/",
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: id},
        beforeSend: function(){
            $('#view_receipt_body').html('');
            $('#view-receipt .loading').html('Loading...');
        },
        success: function(data) {
            // console.log(data);
            if(data.status == 'error'){
                $('#view-receipt .loading').show();
                $('#view-receipt .loading').html('<span class="text-info">'+ data.msg+'</span>');
            }else{
                $('#view-receipt .loading').hide();

                var res = data.msg;

                res.forEach(image => {
                    $('#view_receipt_body').append(
                        '<a style="width: 33.3%; padding: 5px;" href="' + '/storage/' + image.url + '" target="_blank">'+
                            '<img style="width: 100%;" src="' + '/storage/' + image.url + '"></img>' +
                        '</a>'
                    );
                });
            }
        }
    });
}

function verifyPay(id){
    $('#verify-payment').modal('show');
    $('#verify_payment_form').attr('action', "/payments/verify/"+id);
}

function approveLicense(id, slug){
    $('#approve-license').modal('show');
    $('#approve_license_form').attr('action', "/license-approve/"+id+"/"+slug);
}

function generateLicense(id){
    $('#generate-license').modal('show');
    $('#generate_license_form').attr('action', "/license-generate/"+id);
}

function deleteLicense(id){
    $('#delete-license').modal('show');
    $('#license_delete_form').attr('action', "/license/"+id+"/delete");
}

function viewDocuments(id){
    $('#view-document').modal('show');

    $.ajax({
        url: "/view-document/",
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: id},
        beforeSend: function(){
            $('#view_document_body').html('');
            $('#view-document .loading').html('Loading...');
        },
        success: function(data) {
            // console.log(data);
            if(data.status == 'error'){
                $('#view-document .loading').show();
                $('#view-document .loading').html('<span class="text-info">'+ data.msg+'</span>');
            }else{
                $('#view-document .loading').hide();

                var res = data.msg;
                console.log("🚀 ~ file: script.js:126 ~ viewDocuments ~ data.msg:", data.msg)

                res.forEach(document => {
                    $('#view_document_body').append(
                        '<a style="width: 33.3%; padding: 5px;" href="' + '/storage/' + document.url + '" target="_blank">'+
                            '<img style="width: 100%;" src="/img/document-placeholder.svg"></img>' +
                            '<p class"text-secondary">' + document.name +'</p>' +
                        '</a>'
                    );
                });
            }
        }
    });
}

function createUser(){
    $('#create-user').modal('show');
}

function viewAssignPermission(id, role_name){
    $('#role_name').html(role_name);
    $('#role_id').val(id);
    $('#assign-permission').modal('show');

    $.ajax({
        url: "/role-permissions/"+id,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // data: {id: id},
        beforeSend: function(){
            $('#permission_list').html('');
            $('#assign-permission .loading').show();
        },
        success: function(data) {
            //console.log(data);
            if(data && data['all_permissions']){
                var groupedPermissions = {};
                data['all_permissions'].forEach(permission => {
                    var header = permission.name.substring(0, permission.name.lastIndexOf(' '));
                    if (!groupedPermissions[header]) {
                        groupedPermissions[header] = [];
                    }
                    groupedPermissions[header].push(permission);
                });

                var output = '';
                var allPermissionsChecked = true;
                for (const group in groupedPermissions) {
                    if (groupedPermissions.hasOwnProperty(group)) {
                        const groupId = group.replace(/\s+/g, '_');
                        output += `<div class="col-4-width mb-5 permission-item">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label"><h6>${group} ---- </h6></label>
                                            <input class="form-check-input check-all-checkbox" type="checkbox" id="check_all_${groupId}">
                                        </div>
                                    <div class="row">`;

                        groupedPermissions[group].forEach(permission => {
                            output += `<div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input permission-checkbox ${groupId}" name="permissions[]" type="checkbox" value="${permission.id}" id="permission-${permission.id}" ${data['assigned_permissions'].includes(permission.id) ? "checked" : ""}>
                                    <label class="form-check-label" for="permission-${permission.id}">
                                        ${permission.name}
                                    </label>
                                </div>
                            </div>`;

                            if (!data['assigned_permissions'].includes(permission.id)) {
                                allPermissionsChecked = false;
                            }
                        });

                        output += `</div>
                                </div>`;
                    }
                }
                $('#permission_list').html(output);
                initializeMasonry();

                $('.check-all-checkbox').change(function() {
                    var groupId = $(this).attr('id').replace('check_all_', '');
                    $(`.${groupId}`).prop('checked', $(this).prop('checked'));
                });

                var rowHeight = $('#permission_list').height();

                if (rowHeight === 0) {
                    $('#permission_list').css("height", "100%");
                }

                $('#assign-permission .loading').hide();
            }
        }
    });
}

function initializeMasonry() {
    $('.permission-list').masonry({
        itemSelector: '.permission-item',
        columnWidth: '.col-4-width',
        gutter: 16
    });
}

function editPermission(id, name){
    $('#edit-permission-form').attr('action', '/permissions/'+id)
    $('#permission_name').val(name);
    $('#edit-permission').modal('show');
}

function deletePermission(id){
    $('#delete-permission').modal('show');
    $('#permission_delete_form').attr('action', "/permissions/"+id);
}

function viewAssignRole(id, email, role_name){
    if(role_name){
        $('#current_role').val(role_name);
    }
    $('#username').html(email);
    $('#user_id').val(id);
    $('#assign-role').modal('show');
}

function editRole(id, name){
    $('#edit-role-form').attr('action', '/roles/'+id)
    $('#role_name').val(name);
    $('#edit-role').modal('show');
}

function deleteRole(id){
    $('#delete-role').modal('show');
    $('#role_delete_form').attr('action', "/roles/"+id);
}
