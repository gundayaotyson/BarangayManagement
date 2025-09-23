<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Clearance</title>
    <style>
        /* General Page Styling */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Print Button Styling */
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
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

        /* Certificate Container */
        .certificate-container {
            width: 210mm; /* A4 width */
            height: 297mm; /* A4 height */
            background: #fff;
            padding: 20mm;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            box-sizing: border-box;
            margin: 0 auto;
        }

        /* Title */
        .title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        /* Header */
        .barangay-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .barangay-header img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .barangay-header .text {
            text-align: center;
            flex: 1;
            padding: 0 20px;
        }

        .barangay-header p {
            margin: 0;
            font-size: 16px;
            line-height: 1.3;
        }

        .barangay-header .fw-bold {
            font-weight: bold;
            font-size: 17px;
            margin-top: 5px;
        }

        /* Details */
        .details p, .personal-info p {
            font-size: 15px;
            margin: 5px 0;
            line-height: 1.4;
        }

        /* Picture, Thumb Mark, and Signature in a Row */
        .photo-signature-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            margin-top: 50px;
        }

        .photo-signature-row .column {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 30%;
        }

        .box {
            border: 1px solid #ccc;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            margin-bottom: 5px;
        }

        /* Signature */
        .signature-section {
            text-align: center;
            margin-top: 30px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin: 0 auto;
            padding-top: 5px;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        /* Print Only the Certificate */
        @media print {
            body {
                background-color: white;
                padding: 0;
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            .certificate-container, .certificate-container * {
                visibility: visible;
            }

            .certificate-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 210mm;
                height: 297mm;
                box-shadow: none;
                border: none;
                padding: 20mm;
                margin: 0;
                page-break-after: always;
            }

            .print-container {
                display: none;
            }

            @page {
                size: A4;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<!-- Print Button Outside Certificate Container -->
<div class="print-container">
    <button onclick="window.print()" class="print-btn">Print</button>
</div>

<!-- Certificate Content -->
<div class="certificate-container" id="printJS">
    <!-- Control Number -->
    <div style="text-align: end;">
        <p><strong>CONTROL NO.</strong> {{ $clearance->id }}</p>
    </div>

    <!-- Barangay Header with Seals -->
    <div class="barangay-header">
        <img src="{{ asset('images/cobol log.png') }}" alt="Barangay Cobol Seal" />
        <div class="text">
            <p>Republic of the Philippines</p>
            <p>City of San Carlos</p>
            <p>Province of Pangasinan</p>
            <p class="fw-bold">BARANGAY COBOL</p>
            <p class="fw-bold">OFFICE OF THE PUNONG BARANGAY</p>
        </div>
        <img src="{{ asset('images/SC_logo.png') }}" alt="City of San Carlos Seal" />
    </div>

    <!-- Title -->
    <div class="title">Barangay Clearance Certification</div>

    <!-- Date -->
    <div style="text-align: end;">
        <p><strong>DATE:</strong> {{ now()->format('F d, Y') }}</p>
    </div>

    <!-- Certification Text -->
    <p class="mb-4">
        This is to certify that the person whose photo, signature, and thumbprint appear herein is a bonafide resident of this Barangay.
        He/She is of good moral character, a law-abiding citizen, and has no derogatory record on file as of this date.
    </p>

    <!-- Personal Information -->
<div class="personal-info">
    <p><strong>Full Name:</strong>
        {{ $clearance->resident->lname ?? '' }},
        {{ $clearance->resident->Fname ?? '' }}
        {{ $clearance->resident->mname ?? '' }}
    </p>
    <p><strong>Address:</strong> {{ $clearance->resident->purok_no ?? '' }}, {{ $clearance->address}}</p>
    <p><strong>Date of Birth:</strong> {{ $clearance->resident->birthday ?? $clearance->dateofbirth }}</p>
    <p><strong>Place of Birth:</strong> {{ $clearance->resident->birthplace ?? $clearance->placeofbirth }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($clearance->resident->gender ?? $clearance->gender) }}</p>
    <p><strong>Civil Status:</strong> {{ $clearance->resident->civil_status ?? $clearance->civil_status }}</p>
    <p><strong>Purpose:</strong> {{ $clearance->purpose }}</p>
</div>

    <!-- CTC & OR Details -->
    <div>
        <p><strong>CTC NO.:</strong> ____________________________</p>
        <p><strong>Place of Issue:</strong> ____________________________</p>
        <p><strong>Date of Issue:</strong> ____________________________</p>
        <p><strong>O.R. No.:</strong> ____________________________</p>
    </div>

    <!-- Picture, Thumb Mark, and Signature -->
    <div class="photo-signature-row">
        <div class="column">
            <div class="box"></div>
            <p>Picture</p>
        </div>

        <div class="column">
            <div class="box"></div>
            <p>Right Thumb Mark</p>
        </div>

        <div class="column">
            <div class="signature-line"></div>
            <p>Signature</p>
        </div>
    </div>

    <!-- Barangay Captain Signature -->
    <div class="signature-section">
        <p class="fw-bold">DIONISIO R. CALDONA</p>
        <p>Punong Barangay</p>
    </div>
</div>

</body>
</html>
