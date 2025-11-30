@extends('resident.resident-layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* Enhanced Resident Dashboard Styles */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* Welcome Header Enhancement */
.row:first-child {
    margin-bottom: 30px;
}

.row:first-child h1 {
    color: #2c3e50;
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 0;
    position: relative;
    padding-left: 20px;
}

.row:first-child h1::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 5px;
    background: linear-gradient(135deg, #3498db, #2c3e50);
    border-radius: 10px;
}

.row:first-child hr {
    border: 0;
    height: 3px;
    background: linear-gradient(90deg, #3498db, #e0e0e0);
    margin: 20px 0 30px 0;
    border-radius: 2px;
}

/* Enhanced Stats Cards */
.row:nth-child(2) {
    margin-bottom: 40px;
}

.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    background: white;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.card-body {
    padding: 2rem 1.5rem;
    text-align: center;
    position: relative;
    z-index: 2;
}

.card-title {
    color: #6c757d;
    font-size: 0.95rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

.card-text {
    color: #2c3e50;
    font-size: 2.8rem;
    font-weight: 800;
    margin: 0;
    line-height: 1;
}

/* Individual Card Colors */
.row:nth-child(2) .col-md-3:nth-child(1) .card::before {
    background: linear-gradient(90deg, #3498db, #2980b9);
}

.row:nth-child(2) .col-md-3:nth-child(2) .card::before {
    background: linear-gradient(90deg, #f39c12, #e67e22);
}

.row:nth-child(2) .col-md-3:nth-child(3) .card::before {
    background: linear-gradient(90deg, #27ae60, #229954);
}

.row:nth-child(2) .col-md-3:nth-child(4) .card::before {
    background: linear-gradient(90deg, #e74c3c, #c0392b);
}

/* Add icons to cards using pseudo-elements */
.row:nth-child(2) .col-md-3:nth-child(1) .card-body::after {
    font-family: "Font Awesome 6 Free";
    content: "\f02d"; /* example: fa-file-alt (solid) */
    font-weight: 900;
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.7rem;
        opacity: 100;

}

.row:nth-child(2) .col-md-3:nth-child(2) .card-body::after {
    content: "\F250"; /* bi-hourglass-split */
    font-family: "bootstrap-icons";
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.7rem;
    opacity: 100;
}

.row:nth-child(2) .col-md-3:nth-child(3) .card-body::after {
    content: "\F26B"; /* bi-check-circle */
    font-family: "bootstrap-icons";
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.8rem;
    opacity: 100;
}

.row:nth-child(2) .col-md-3:nth-child(4) .card-body::after {
    content: "\F33B"; /* bi-exclamation-triangle */
    font-family: "bootstrap-icons";
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.8rem;
    opacity: 100;
}


/* Enhanced Scheduled Requests Section */
.row.mt-4 {
    margin-top: 50px !important;
}

h2 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 25px;
    font-size: 1.8rem;
    position: relative;
    padding-bottom: 10px;
}

h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #3498db, transparent);
    border-radius: 2px;
}

.table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: none;
}

.table thead {
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.table thead th {
    background: #2c3e50;
    color: white;
    font-weight: 600;
    border: none;
    padding: 18px 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

.table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f8f9fa;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.table tbody td {
    padding: 16px 20px;
    border: none;
    color: #2c3e50;
    vertical-align: middle;
    font-weight: 500;
}

/* Enhanced Alert Box */
.alert {
    border: none;
    border-radius: 15px;
    padding: 2.5rem;
    background: linear-gradient(135deg, #e8f4fc 0%, #f0f8ff 100%);
    border-left: 5px solid #3498db;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.alert::before {
    content: '💡';
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2rem;
    opacity: 0.1;
}

.alert-heading {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.4rem;
}

.alert p {
    color: #5a6c7d;
    line-height: 1.6;
    margin-bottom: 10px;
    font-size: 1rem;
}

.alert hr {
    margin: 20px 0;
    border: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #3498db, transparent);
}

.alert .mb-0 {
    color: #2c3e50;
    font-weight: 600;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db, #2980b9);
    border: none;
    border-radius: 8px;
    padding: 12px 35px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    background: linear-gradient(135deg, #2980b9, #3498db);
}

.btn-primary::after {
    content: '→';
    margin-left: 8px;
    font-weight: bold;
}

/* Status Badges Enhancement */
.table tbody td:last-child {
    font-weight: 600;
}

/* Add status colors dynamically */
.table tbody tr td:last-child:contains("pending") {
    color: #f39c12;
}

.table tbody tr td:last-child:contains("approved") {
    color: #27ae60;
}

.table tbody tr td:last-child:contains("released") {
    color: #27ae60;
}

.table tbody tr td:last-child:contains("rejected") {
    color: #e74c3c;
}

.table tbody tr td:last-child:contains("expired") {
    color: #95a5a6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    .row:first-child h1 {
        font-size: 22px;
        padding-left: 15px;
    }

    .card-body {
        padding: 1.5rem 1rem;
    }

    .card-text {
        font-size: 2.2rem;
    }

    .col-md-3 {
        margin-bottom: 20px;
    }

    .table {
        font-size: 0.9rem;
    }

    .table th,
    .table td {
        padding: 12px 8px;
    }

    .alert {
        padding: 1.8rem;
    }

    h2 {
        font-size: 1.5rem;
    }
}

/* Loading Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.row:nth-child(2) .col-md-3 .card {
    animation: fadeInUp 0.6s ease forwards;
}

.row:nth-child(2) .col-md-3:nth-child(1) .card { animation-delay: 0.1s; }
.row:nth-child(2) .col-md-3:nth-child(2) .card { animation-delay: 0.2s; }
.row:nth-child(2) .col-md-3:nth-child(3) .card { animation-delay: 0.3s; }
.row:nth-child(2) .col-md-3:nth-child(4) .card { animation-delay: 0.4s; }

/* Print Styles */
@media print {
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }

    .btn-primary {
        display: none !important;
    }
}
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome, {{ $resident->Fname }} {{ $resident->mname }} {{ $resident->lname }}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Requests</h5>
                        <p class="card-text">{{ $totalRequests }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pending Requests</h5>
                        <p class="card-text">{{ $totalPendingRequests }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Released Requests</h5>
                        <p class="card-text">{{ $totalReleasedRequests }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Expired Requests</h5>
                        <p class="card-text">{{ $totalExpiredRequests }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($scheduledRequests->count() > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <h2>Scheduled Requests</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scheduledRequests as $request)
                                <tr>
                                    <td>{{ $request->service_type }}</td>
                                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $request->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                  <h4 class="alert-heading">Looking for a specific service?</h4>
                  <p>We offer a variety of services to meet your needs. Whether you require a barangay clearance, need to file a complaint, or want to learn more about our community projects, our services page has you covered.</p>
                  <hr>
                  <p class="mb-0">Click the button below to explore all available services.</p>
                  <a href="{{ route('resident.services') }}" class="btn btn-primary mt-3">Go to Services</a>
                </div>
            </div>
        </div>
    </div>
@endsection
