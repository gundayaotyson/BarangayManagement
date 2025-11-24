
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
        .signature-box {
            width: 1000px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            overflow: hidden;
        }

        .signature-box img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
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
         .print-container {
            text-align: right;
            width: 100%;
            margin-bottom: 15px;
        }
        .print-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 20px;
            margin-top: 10px;
        }


        @media print {
            body * {
                visibility: hidden;
            }
            .container, .container * {
                visibility: visible;
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
                margin: 0;
                border: none;
                box-shadow: none;
            }
            .print-container {
                display: none;
            }
        }

    </style>
</head>
<body>
    <div class="print-container">
        <button button onclick="window.print()" class="print-btn">Print</button>
    </div>
    <div class="container">
        <div class="header">
          <div class="logo-container">
                <img src="{{ asset('images/cobol log.png') }}" alt="Barangay Cobol Logo" class="logo">
            </div>
            <div class="header-text">
                <p>Republic of the Philippines</p>
                <p>City of San Carlos</p>
                <p>Province of Pangasinan</p>
                <p><strong>BARANGAY COBOL</strong></p>
                <p>Office of the Punong Barangay</p>
            </div>
         <div class="logo-container">
                <img src="{{ asset('images/SC_logo.png') }}" alt="San Carlos City Logo" class="logo">
            </div>
        </div>
        <hr>
        <h1 class="title">BARANGAY BUSINESS PERMIT</h1>

             <span class="date-line"><p><strong>DATE:</strong> {{ now()->format('F d, Y') }}</p></span>

        <div class="content">
            <div class="line">
                is hereby granted to <span class="underline-field">{{  $business_permit->Fname }} {{  $business_permit->mname }} {{ $business_permit->lname }}</span>
            </div>
            <div class="line">
                a resident of <span> Barangay Cobol San Carlos City Pangasinan&nbsp;&nbsp;&nbsp;
            </div>
            <div class="line">
                to operate/manage a <span class="underline-field">{{  $business_permit->business_name }} </span>
            </div>
            <div class="line">
                to be known as <span class="underline-field">{{  $business_permit->business_type }} </span>
            </div>
            <div class="line">
                located at <span class="underline-field">{{  $business_permit->business_address}} </span>
            <p>Subject however to all rules/regulations and existing laws relevant there with.</p>
        </div>
        <div class="footer">
              <!-- <div class="signature-box">
                <img src="{{ asset('images/signiture-removebg.png') }}" alt="Signature" />
            </div> -->
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

    </div>
</body>
</html>
