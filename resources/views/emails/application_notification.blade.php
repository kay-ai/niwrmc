<!DOCTYPE html>
<html>
<head>
    <title>New Application Initiated</title>
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
            <h1 class="display-4">New Application Initiated</h1>
        </div>
        <p class="lead mt-5">A new application has been initiated by {{ $applicationForm->customer->first_name }} {{ $applicationForm->customer->last_name }}.</p>
        <p>Business Name: <strong>{{$applicationForm->business_name}}</strong></p>
        <p>License Category: <strong>{{$applicationForm->license_sub_category->name}}</strong></p>
        <p class="mt-5">Please review the application attached.</p>
        <div class="email-footer">
            <p class="text-muted">If you have any questions, please contact our support team.</p>
            <p class="text-muted">This is a system generated email. Please do not reply to this address.</p>
            <p class="text-muted mt-3">Copyright © {{date('Y')}} Nigeria Integrated Water Resources Commission. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
