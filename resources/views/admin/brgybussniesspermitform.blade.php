@extends('admin.dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Business Clearance</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            padding: 1.5cm;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            border: 1px solid #000;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }
        .header .logo {
            width: 80px;
            height: 80px;
        }
        .header .header-text {
            flex-grow: 1;
        }
        .header p {
            margin: 0;
            line-height: 1.2;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 40px 0;
        }
        .content {
            flex-grow: 1;
        }
        .line {
            margin-bottom: 20px;
        }
        .line span {
            border-bottom: 1px solid #000;
            padding: 0 10px;
            font-weight: bold;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 80px;
        }
        .signature, .certified {
            text-align: center;
        }
        .signature .name, .certified .name {
            border-top: 1px solid #000;
            padding-top: 5px;
            margin-top: 40px;
        }
        .date-line {
            text-align: right;
            margin-bottom: 20px;
        }
        .date-line span {
            border-bottom: 1px solid #000;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="/images/cobol logo small.png" alt="Left Logo" class="logo">
            <div class="header-text">
                <p>Republic of the Philippines</p>
                <p>City of San Carlos</p>
                <p>Province of Pangasinan</p>
                <p><strong>BARANGAY COBOL</strong></p>
                <p>Office of the Punong Barangay</p>
            </div>
            <img src="/images/SC_logo.png" alt="Right Logo" class="logo">
        </div>
        <hr>
        <h1 class="title">BARANGAY BUSINESS CLEARANCE</h1>
        <div class="date-line">
            Date: <span></span>
        </div>
        <div class="content">
            <div class="line">
                is hereby granted to <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="line">
                a resident of <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="line">
                to operate/manage a <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="line">
                to be known as <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="line">
                located at <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <p>Subject however to all rules/regulations and existing laws relevant there with.</p>
        </div>
        <div class="footer">
            <div class="signature">
                <div class="name">Signature over printed Name</div>
            </div>
            <div class="certified">
                <p>Certified True and Correct:</p>
                <div class="name">
                    <strong>DIONISIO R. CALDONA</strong><br>
                    Punong Barangay
                </div>
            </div>
        </div>
        <hr>
    </div>
</body>
</html>
@endsection
