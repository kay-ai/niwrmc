<!DOCTYPE html>
<html>
<head>
    <title>New Payment Received</title>
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

        .email-footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1 class="display-4">New Payment Received</h1>
        </div>
        <p class="lead mt-5">A new payment has been made by <strong> {{ $customer->first_name }} {{ $customer->last_name }}</strong>.</p>
        <p>Application Name: <strong>{{ $invoice->item }}</strong> License</p>
        <p>Business Name: <strong>{{ $invoice->application->business_name }}</strong></p>
        <p>RRR: <strong>{{ $invoice->remita_rrr }}</strong></p>
        <p>Amount: <strong>₦{{ number_format($invoice->amount, 2) }}</strong></p>
        <p>Payment for: <strong>{{ucwords(str_replace('_', ' ', $invoice->category))}}</strong></p>
        <div class="email-footer">
            <p class="text-muted">If you have any questions, please contact our support team.</p>
            <p class="text-muted">This is a system generated email. Please do not reply to this address.</p>
            <p class="text-muted mt-3">Copyright © {{date('Y')}} Nigeria Integrated Water Resources Commission. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
