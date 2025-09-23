@extends('dashboard')
@section('title', 'Reports')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Container Styling */
        .report-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Header Styling */
        .report-header {
            text-align: center;
            margin-bottom: 20px;
            color: #2e7d32;
            font-size: 2rem;
            font-weight: bold;
            border-bottom: 3px solid #2e7d32;
            padding-bottom: 10px;
        }

        /* Table Styling */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .report-table th,
        .report-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .report-table th {
            background-color: #2e7d32;
            color: #ffffff;
            font-weight: bold;
        }

        .report-table tr:nth-child(even) {
            background-color: #f1f8f4;
        }

        .report-table tr:hover {
            background-color: #e8f5e9;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .report-table th,
            .report-table td {
                padding: 8px;
            }

            .report-header {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="report-container">
    <div class="report-header">
        Barangay Report
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Resident Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Juan Dela Cruz</td>
                <td>Brgy. Cobol, San Carlos City</td>
                <td>0912-345-6789</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Santos</td>
                <td>Brgy. Cobol, San Carlos City</td>
                <td>0922-456-7890</td>
                <td>Inactive</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Pedro Reyes</td>
                <td>Brgy. Cobol, San Carlos City</td>
                <td>0933-567-8901</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Ana Lopez</td>
                <td>Brgy. Cobol, San Carlos City</td>
                <td>0944-678-9012</td>
                <td>Active</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Luis Garcia</td>
                <td>Brgy. Cobol, San Carlos City</td>
                <td>0955-789-0123</td>
                <td>Inactive</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection
