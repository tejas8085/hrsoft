<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
</head>
<body>
    <h2>{{ $subject }}</h2>
    <p>Dear {{ $employee->name }},</p>

    <p>{!! $content !!}</p>

    <p>Best regards,<br><strong>{{ $hrName }}</strong></p>
</body>
</html>
