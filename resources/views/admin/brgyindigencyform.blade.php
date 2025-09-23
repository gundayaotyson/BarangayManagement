<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Indigency - Barangay Cobol</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .print-button-container {
            margin: 20px 0;
            text-align: center;
        }

        .print-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .certificate {
            width: 210mm;
            height: 297mm;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20mm;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .header-text h3 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
        }

        .right-logo-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .control-number {
            margin-top: 5px;
            text-align: right;
        }

        .divider {
            width: 100%;
            height: 2px;
            background-color: #000;
            margin: 20px 0;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 30px 0;
        }

        .date-section {
            text-align: right;
            margin: 20px 0;
        }

        .date-line {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 150px;
            text-align: center;
            font-style: italic;
        }

        .date-label {
            display: block;
            text-align: center;
            font-size: 12px;
        }

        .content {
            margin: 30px 0;
            text-align: justify;
        }

        .address-line {
            text-indent: 30px;
        }

        .signature-section {
            margin-top: 60px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .signature {
            border-bottom: 1px solid #000;
            min-width: 200px;
            height: 60px;
            text-align: center;
            position: relative;
        }

        .signature img {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            max-width: 150px;
            max-height: 50px;
            object-fit: contain;
        }

        .signatory-name {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }

        .signatory-position {
            text-align: center;
            font-size: 12px;
        }

        .certification {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .seal {
            position: absolute;
            bottom: 150px;
            left: 100px;
            width: 120px;
            height: 120px;
            background-image: url('/api/placeholder/120/120');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.3;
        }

        .all-caps {
            text-transform: uppercase;
        }

        @media print {
            body {
                background-color: white;
                margin: 0;
                padding: 0;
            }

            .print-button-container {
                display: none;
            }

            .certificate {
                box-shadow: none;
                width: 210mm;
                height: 297mm;
                padding: 20mm;
                margin: 0;
                page-break-after: always;
            }
        }

        @media (max-width: 210mm) {
            .certificate {
                width: 100%;
                height: auto;
                min-height: 297mm;
            }
        }
    </style>
</head>
<body>
    <div class="print-button-container">
        <button class="print-button" onclick="printCertificate()">Print Certificate</button>
    </div>

    <div class="certificate">
        <div class="control-number">
            <p><strong>CONTROL NO.</strong> {{0}}</p>
        </div>
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/cobol log.png') }}" alt="Barangay Cobol Seal" />
            </div>
            <div class="header-text">
                <h3>Republic of the Philippines</h3>
                <h3>City of San Carlos</h3>
                <h3>Province of Pangasinan</h3>
                <h3>BARANGAY COBOL</h3>
                <h3>Office of the Punong Barangay</h3>
            </div>
            <div class="right-logo-container">
                <div class="logo">
                    <img src="{{ asset('images/SC_logo.png') }}" alt="City of San Carlos Seal" />
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="title">CERTIFICATE OF INDIGENCY</div>

        <div class="date-section">
            <span class="date-line"><p><strong>DATE:</strong> {{ now()->format('F d, Y') }}</p>     </span>
            <!-- <span class="date-label">Date</span> -->
        </div>
        <div style="text-align: end;">
        </div>

        <div class="content">
            <p>To Whom It May Concern:</p>

            <p class="address-line">This is to certify that <u>{{ $indigency->fullname }}</u> OF LEGAL AGE, A BONAFIDE RESIDENT OF Barangay Cobol, San Carlos City, Pangasinan, is personally known to me to be a member of an indigent family in this Barangay. I certify that the above mentioned name is honest.</p>

            <p class="address-line">This certification is issued upon the request of <u>{{ $indigency->fullname }}</u> for whatever legal purpose it may serve him/her best.</p>
        </div>

        <div class="certification">
            <p>Certified True and Correct:</p>
        </div>

        <div class="signature-section">
            <!-- <div class="signature">
                <img src="/api/placeholder/150/50" alt="Signature">
            </div> -->
            <div class="signatory-name">DANTE R. CALDONA</div>
            <div class="signatory-position">Punong Barangay</div>
        </div>

        <div class="seal"></div>
    </div>

    <script>
        function printCertificate() {
            window.print();
        }
    </script>
</body>
</html>
