<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Offer Letter</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            background-color: #f3f4f6;
            padding: 40px;
            color: #333;
        }

        .card {
            background-color: #ffffff;
            padding: 40px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            height: 80px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #28a745; /* Green accent */
            font-size: 26px;
            letter-spacing: 1px;
        }

        .content p {
            margin-bottom: 1rem;
        }

        .section-title {
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }

        ol {
            padding-left: 1.2rem;
        }

        .footer {
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <img src="/images/image.png" alt="Company Logo">
            <h2>TPIPAY FINTECH PRIVATE LIMITED</h2>
        </div>

        <div class="content">
            <p>Date: {{ now()->format('jS F, Y') }}</p>

            <p>Dear <strong>{{ $employee->name }}</strong>,</p>

            <p>We are pleased to extend this offer of employment for the position of <strong>{{ $employee->designation }}</strong> at TPIPAY FINTECH PRIVATE LIMITED. Your skills, professionalism, and dedication were highly valued in our selection process.</p>

            @php
                $annual = $employee->ctc * 100000;
                $monthly = $annual / 12;
            @endphp

            <p>
                <strong>Position:</strong> {{ $employee->designation }}<br>
                <strong>Base Salary:</strong> ₹{{ number_format($annual) }} per annum (₹{{ number_format($monthly) }} monthly)<br>
                <strong>Working Hours:</strong> 9:30 AM – 6:00 PM<br>
                <strong>Joining Date:</strong> {{ \Carbon\Carbon::parse($employee->joining_date)->format('jS F, Y') }}<br>
                <strong>Probation Period:</strong> 3 months from the date of joining
            </p>

            <p class="section-title">Documents Required:</p>
            <ol>
                <li>Educational certificates (originals & photocopies)</li>
                <li>Relieving letter from previous employer</li>
                <li>Last 3 months' salary slips / bank statements</li>
                <li>Experience certificates</li>
                <li>4 passport-size photographs</li>
                <li>Residential address proof (Permanent & Current)</li>
                <li>Copy of PAN card & Passport</li>
            </ol>

            <p>Please sign and return a copy of this letter to confirm your acceptance of the offer.</p>

            <div class="footer">
                <p>Warm regards,</p>
                <p>
                    <strong>Inayat Khan</strong><br>
                    HR Manager<br>
                    M. 9422320600<br>
                    W. www.tpipay.com
                </p>
            </div>
        </div>
    </div>

</body>
</html>
