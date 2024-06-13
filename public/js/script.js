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
            $('#in_status').html(data.invoice.status ?? '...');
            $('#in_date').html(moment(data.invoice.created_at).format('Do MMMM YYYY') ?? '...');
            $('.in_amount').html(data.invoice.amount ?? '...');
            $('.in_vendor_name').html(formatAndCapitalizeText(data.invoice.application_name) ?? '...');
            $('#in_account_name').html(data.invoice.application_name ?? '...');
            // $('#in_account_number').html(data.vendor.bank_account_number ?? '...');
            // $('#in_vendor_bank').html(data.vendor.bank_name ?? '...');
            $('#in_phase').html(formatAndCapitalizeText(data.invoice.category) ?? '...');
            // $('#in_spn').html(data.meter_request.contract_number ?? '...');
            if(data.invoice.status == 'paid'){
                $('#in_total_due').html('0');
                $('#in_status_div').addClass('bg-green');
                $('#in_status_div').removeClass('bg-pink');
            }else{
                $('#in_total_due').html(data.invoice.amount ?? '...');
                $('#in_status_div').addClass('bg-pink');
                $('#in_status_div').removeClass('bg-green');
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
        type: "POST",
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
        type: "POST",
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

// function createPricing(){
//     $('#create-price').modal('show');
// }
