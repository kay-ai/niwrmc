<!DOCTYPE html>
<html>
<head>
    <title>Invoice Generated</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
        }
        .btn-pay {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-pay:hover {
            background-color: #0056b3;
        }

        .email-footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1 class="display-4">Invoice Generated</h1>
        </div>
        <p class="lead mt-5">Dear {{ $customer->first_name }} {{ $customer->last_name }},</p>
        <p>Your invoice for <strong>{{ $application_name }}</strong> License has been generated.</p>
        <p>RRR: <strong>{{ $invoice->remita_rrr }}</strong></p>
        <p>Amount: <strong>₦{{ number_format($invoice->amount, 2) }}</strong></p>
        <p>Payment For: <strong>{{ucwords(str_replace('_', ' ', $payment_type))}}</strong></p>
        <p class="text-center mt-5">Please click the button below to complete your payment.</p>
        <div class="text-center">
            <a href="{{ url('/pay-remita') }}" class="btn btn-primary shadow">Pay Now</a>
        </div>
        <div class="email-footer">
            <p class="text-muted">If you have any questions, please contact our support team.</p>
            <p class="text-muted">This is a system generated email. Please do not reply to this address.</p>
            <p class="text-muted mt-3">Copyright © {{date('Y')}} Nigeria Integrated Water Resources Commission. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
