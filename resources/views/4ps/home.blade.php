@extends('4ps.dashboard')
@section('content')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform .2s;
        margin-bottom: 20px;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: none;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 1rem 1.5rem;
        text-align: center;
    }
    .card-body {
        text-align: center;
        padding: 2rem;
    }
    .card-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0;
    }
    h1 {
        margin-bottom: 2rem;
        font-weight: bold;
        color: #333;
    }

    /* Card Specific Colors */
    .card-residents .card-header {
        background-color: #007bff;
        color: white;
    }
    .card-residents .card-body .card-title {
        color: #007bff;
    }

    .card-requests .card-header {
        background-color: #6c757d;
        color: white;
    }
     .card-requests .card-body .card-title {
        color: #6c757d;
    }

    .card-pending .card-header {
        background-color: #ffc107;
        color: white;
    }
    .card-pending .card-body .card-title {
        color: #ffc107;
    }

    .card-accepted .card-header {
        background-color: #28a745;
        color: white;
    }
    .card-accepted .card-body .card-title {
        color: #28a745;
    }

    .card-rejected .card-header {
        background-color: #dc3545;
        color: white;
    }
     .card-rejected .card-body .card-title {
        color: #dc3545;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome to 4ps Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-residents">
                    <div class="card-header">
                        Total 4ps Residents
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalResidents }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-requests">
                    <div class="card-header">
                        Total Requests
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalRequests }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card card-pending">
                    <div class="card-header">
                        Pending
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $pendingRequests }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card card-accepted">
                    <div class="card-header">
                        Accepted
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $acceptedRequests }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card card-rejected">
                    <div class="card-header">
                        Rejected
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $rejectedRequests }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
