<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Residency</title>
    <style>
        /* A4 Paper Size */
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
             font-family: 'Times New Roman', Times, serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .a4-container {
            width: 210mm;
            height: 297mm;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20mm;
            box-sizing: border-box;
            position: relative;
        }

        /* Certificate Styling */
        .certificate-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10mm;
            position: relative;
        }

        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .header-text {
            text-align: center;
            flex-grow: 1;
            padding: 0 10mm;
        }

        .certificate-header h1 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .certificate-header h2 {
            font-size: 14pt;
            margin: 2mm 0 0 0;
            text-transform: uppercase;
            font-weight: normal;
        }

        .certificate-title {
            text-align: center;
            margin: 8mm 0;
            padding-bottom: 2mm;
            border-bottom: 1px solid #000;
        }

        .certificate-title h3 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .certificate-body {
            line-height: 1.6;
            font-size: 12pt;
        }

        .to-whom {
            margin-bottom: 6mm;
        }

        .certification-text {
            margin-bottom: 6mm;
            /* text-align: justify; */
        }
         .signature-box {
            width: 1000px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            overflow: hidden;
            margin-left: 50px;

        }

        .signature-box img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .underline-field {
            display: inline-block;
            border-bottom: 1px solid #000;
            /* min-width: 80mm; */
            text-align: center;
            padding: 0 2mm;
            margin: 0 1mm;
        }

        .signature-area {
            margin-top: 15mm;
            text-align: right;
        }

        .signature-name {
            margin-top: 8mm;
            font-weight: bold;
            text-transform: uppercase;
        }

        .signature-title {
            margin-top: 1mm;
            font-size: 11pt;
        }

        .footer {
            position: absolute;
            bottom: 15mm;
            width: calc(100% - 40mm);
            text-align: center;
            font-size: 10pt;
            color: #555;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: white;
                margin: 0;
                padding: 0;
            }

            .a4-container {
                box-shadow: none;
                margin: 0;
                padding: 20mm;
                width: 210mm;
                height: 297mm;
                page-break-after: always;
            }

            .no-print {
                display: none;
            }
        }

        /* Preview controls */
        .preview-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            z-index: 100;
        }

        button {
            padding: 8px 15px;
            margin: 0 5px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background: #34495e;
        }
    </style>
</head>
<body>
    <div class="no-print preview-controls">
        <button onclick="window.print()">Print Certificate</button>
    </div>

    <div class="a4-container">
        <div class="certificate-header">
            <div class="logo-container">
                <img src="{{ asset('images/cobol log.png') }}" alt="Barangay Cobol Logo" class="logo">
            </div>
            <div class="header-text">
                <h1>Republic of the Philippines</h1>
                <h2>City of San Carlos</h2>
                <h2>Province of Pangasinan</h2>
                <h2>BARANGAY COBOL</h2>
                <h2>Office of the Punong Barangay</h2>
            </div>
            <div class="logo-container">
                <img src="{{ asset('images/SC_logo.png') }}" alt="San Carlos City Logo" class="logo">
            </div>
        </div>

        <div class="certificate-title">
            <h3>Certificate of Residency</h3>
        </div>

        <div class="certificate-body">
            <div class="to-whom">
                <p>To Whom It May Concern:</p>
            </div>

            <div class="certification-text">
                 <p>This is to certify that <span class="underline-field">{{ $residency->Fname }} {{ $residency->mname }} {{ $residency->lname }}</span> of legal age, <span class="underline-field">{{ $residency->civil_status }}</span> is a bonafide resident of Barangay Cobol, San Carlos City, Pangasinan.</p>

                <p>This is to certify further that the above name person is a resident of this Barangay since <span class="underline-field">{{ \Carbon\Carbon::parse($residency->res_started_living)->format('F d, Y') }}</span> up to the present.</p>

                <p>This certification is issued upon the request of <span class="underline-field">{{ $residency->Fname }} {{ $residency->mname }} {{ $residency->lname }}</span> for any legal purpose it may serve.</p>
            </div>

            <p>Issued this <span class="underline-field">{{ \Carbon\Carbon::parse($residency->cert_use_date)->format('jS') }}</span> day of <span class="underline-field">{{ \Carbon\Carbon::parse($residency->cert_use_date)->format('F') }}</span> <span class="underline-field">{{ \Carbon\Carbon::parse($residency->cert_use_date)->format('Y') }}</span> at Barangay Cobol, San Carlos City, Pangasinan.</p>

            <div class="signature-area">
                <p>Respectfully yours,</p>
                <!-- <div class="signature-box">
                    <img src="{{ asset('images/signiture-removebg.png') }}" alt="Signature" />
                </div> -->
                <div class="signature-name">DIONISIO R. CALDONA</div>
                <div class="signature-title">Punong Barangay</div>
            </div>
        </div>
<!--
        <div class="footer">
            <p>Note: This certificate is valid for six (6) months from the date of issuance.</p>
        </div> -->
    </div>

    <script>
        function togglePreview() {
            document.body.style.backgroundColor = document.body.style.backgroundColor === 'white' ? '#f5f5f5' : 'white';
        }
    </script>
</body>
</html>
