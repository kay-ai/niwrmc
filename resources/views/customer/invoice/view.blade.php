<!-- Modal -->
<div class="modal fade" id="view-invoice" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="loading">Loading...</div>
                    </div>
                    <div class="col-md-6">
                       <button type="button" class="close ml-auto" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="row pl-15 pr-20" id="invoice_card_body">
                    <div class="col-md-4">
                        <img class="mt-90" width="150" src="/img/logo.png">
                        <div class="pl-5">
                            <p class="text-success">
                                <strong>Nigerian Integrated Water Resources Management Commission</strong>
                            </p>
                            <p>Plot 502, Nafisah Plaza, By Langema Street, off Constitution Avenue Road,
                                Central Business District Area, Abuja, FCT - Nigeria.</p>
                            <h6 class="mt-5">BILL TO:</h6>
                            <p class="text-success">
                                <strong><span id="in_customer_name">John Doe</span></strong>
                            </p>
                            <p id="in_customer_address">No 4 High Court road, Opp. Gov.t Forestry, Behind Royal School, Kuje, Abuja.</p>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 pr-15" style="text-align: right;">
                        <h3 class="text-success">INVOICE</h3>
                        <p> <span class="in_vendor_name"></span> License</p>
                        <div id="in_status_div" class="bg-danger my-3 ml-auto mt-20 text-white text-uppercase">
                            <span id="in_status">Unpaid</span>
                        </div>
                        <div class="row mt-90">
                            <div class="col-md-5 text-right">
                                <p>Invoice Date:</p>
                                <p>Terms:</p>
                            </div>
                            <div class="col-md-7">
                                <p id="in_date"></p>
                                <p>Due on Receipt</p>
                            </div>
                        </div>
                        <div class="vendor-details mt-5">
                            <h6>Remita RRR</h6>
                            <h3 class="text-success text-uppercase" id="in_reference">INM-2898398</h3>
                        </div>
                        <div class="mt-5">
                            <a id="remita_pay_btn" class="btn btn-primary shadow" data-rrr="" onclick="makePayment()" role="button" style="font-size:13px;">Pay Now</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <table class="table table-responsive mb-5">
                            <thead class="bg-success">
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">Item & Description</th>
                                    <th class="text-white">Qty</th>
                                    <th class="text-white">Rate</th>
                                    <th class="text-white">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td><span id="in_phase" style="font-weight: 500"></span> for <span class="in_vendor_name" style="font-weight: 500"></span> License</td>
                                    <td>1</td>
                                    <td>&#8358; <span class="in_amount"></span></td>
                                    <td>&#8358; <span class="in_amount"></span></td>
                                </tr>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <p>Sub Total:</p>
                                        <p>Tax Rate:</p>
                                        <p><strong>Total:</strong></p>
                                    </td>
                                    <td>
                                        <p>&#8358; <span class="in_amount"></span></p>
                                        <p>0%</p>
                                        <p><strong>&#8358; <span class="in_amount"></span></strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="bg-success text-white text-right"><strong>Balance Due:</strong></td>
                                    <td class="bg-success text-white"><strong>&#8358; <span id="in_total_due"></span></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="note mt-35">
                            {{-- <p class="text-success">Note:</p>
                            <small class="pl-0">Payable to the following account:</small>
                            <div class="pa-20">
                                <p class="text-success" style="text-decoration: underline">Account Details:</p>
                                <p id="in_account_name"  style="font-size: 16px;"></p>
                                <p id="in_account_number" class="text-success" style="font-size: 16px; font-weight:600"></p>
                                <p id="in_vendor_bank" style="font-size: 16px;"></p>
                            </div> --}}
                            <small class="pl-0">Thanks.</small>
                        </div>

                        {{-- <div class="note mt-25 mb-50">
                            <p class="text-success">Terms & Conditions:</p>
                            <p class="pl-0">Invoice covers Purchase of Meter, its accessories (Breakers, CIU, Box, Cable) and installation.</p>
                            <small class="pl-0">All Payments must be made in full before commencement of Meter Installation.</small>
                        </div> --}}
                        <hr class="mb-0"/>
                        <p class="text-center">All rights reserved. Nigerian Integrated Water Resources Commission.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
<script>
    function makePayment() {
        $('#view-invoice').modal('hide');
        var remita_btn = document.querySelector("#remita_pay_btn");
        var tx_id = "RRR"+Math.floor(Math.random()*1101233);
        console.log("tx_id: ",tx_id);

        var paymentEngine = RmPaymentEngine.init({
        key:"QzAwMDAyNzEyNTl8MTEwNjE4NjF8OWZjOWYwNmMyZDk3MDRhYWM3YThiOThlNTNjZTE3ZjYxOTY5NDdmZWE1YzU3NDc0ZjE2ZDZjNTg1YWYxNWY3NWM4ZjMzNzZhNjNhZWZlOWQwNmJhNTFkMjIxYTRiMjYzZDkzNGQ3NTUxNDIxYWNlOGY4ZWEyODY3ZjlhNGUwYTY=",
        processRrr: true,
        transactionId: tx_id,
        extendedData: {
            customFields: [
                {
                    name: "rrr",
                    value: remita_btn.getAttribute('data-rrr')
                }
            ]
            },
            onSuccess: function (response) {
                swal({
                    title: "Payment is being verified",
                    text: "Please wait. Don't leave this page.",
                    icon: "info",
                    button: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });

                const xhr = new XMLHttpRequest();
                xhr.open("GET", "/verify-remita-payment/"+response.paymentReference+"/"+tx_id);
                xhr.onload = function() {
                    const verifyResponse = JSON.parse(xhr.responseText)
                    if (xhr.status === 200) {
                        swal({
                            title: "Payment Verified Successfully",
                            icon: "success",
                            button: "OK"
                        }).then(() => {
                            window.location.href = "/customer-invoices";
                        });
                    } else {
                        swal({
                            title: "Payment Verification Failed",
                            text: verifyResponse.message,
                            icon: "error",
                            button: "Try Again"
                        });
                    }
                };
            xhr.send();
            },
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            onClose: function () {
                console.log("closed");
            }
        });
        paymentEngine.showPaymentWidget();
    }

</script>
@endpush
