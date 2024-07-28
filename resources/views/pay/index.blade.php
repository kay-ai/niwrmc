@extends('layouts.guest')

@push('css')
    <style>
        p{
            color: #666d8d;
            font-weight: 400;
        }
    </style>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="title-div">
                        <h4 class="text-center mb-0" style="color: #5a5a5a">
                            Pay for your license
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-4">
            <div class="card cs_modal">
                <div class="modal-body">
                    <form onsubmit="makePayment()" id="payment-form">
                        <h5>Enter RRR Number:</h5>
                        <div class="form-group mb-3">
                            <input type="text" name="rrr" class="form-control" id="js-rrr" placeholder="123456789" required>
                        </div>
                        <input type="button" onclick="makePayment()" class="btn_1 text-center p-0" style="background-color: #55a51c; border:none; color: #fff;" value="Pay Now" button class="button"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function makePayment() {
        var form = document.querySelector("#payment-form");
        var tx_id = "RRR"+Math.floor(Math.random()*1101233);
        console.log("tx_id: ",tx_id);

        var paymentEngine = RmPaymentEngine.init({
        key:"{{env('REMITA_PUBLIC_KEY')}}",
        processRrr: true,
        transactionId: tx_id,
        extendedData: {
            customFields: [
                {
                    name: "rrr",
                    value: form.querySelector('input[name="rrr"]').value
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
                xhr.open("GET", "/verify-remita-payment/"+response.paymentReference);
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
