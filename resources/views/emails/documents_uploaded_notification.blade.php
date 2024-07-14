<!DOCTYPE html>
<html>
<head>
    <title>New Document Uploaded</title>
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
            <h1 class="display-4">New Document Uploaded</h1>
        </div>
        <p class="lead mt-5">A new document has been uploaded by {{ $application->customer->first_name }} {{ $application->customer->last_name }}.</p>
        <p>Business Name: <strong>{{ $application->business_name }}</strong></p>
        <p>License Category: <strong>{{ $application->license_sub_category->name }}</strong></p>

        <h2 class="mt-4">Uploaded Documents:</h2>
        <ul>
            @foreach ($documents as $document)
                <li>{{ $document->name }}</li>
            @endforeach
        </ul>

        <p class="mt-5">Please review the documents attached.</p>
        <div class="email-footer">
            <p class="text-muted">If you have any questions, please contact our support team.</p>
            <p class="text-muted">This is a system-generated email. Please do not reply to this address.</p>
            <p class="text-muted mt-3">Copyright © {{ date('Y') }} Nigeria Integrated Water Resources Commission. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
