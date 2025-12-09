@extends('bhw.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Delivery Records - BHW Dashboard</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #343a40;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-primary.text-white.p-3.rounded-lg {
            background: var(--primary-color);
            border: none;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius) !important;
        }

        .container {
            max-width: 1200px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-warning, .btn-danger, .btn-info {
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table thead {
            background:  var(--primary-color);
            color: white;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(155, 89, 182, 0.05);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            margin: 2rem 0;
            border: none;
        }

        .info-icon {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .resident-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            z-index: 1060;
        }

        .ui-menu-item {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #eee;
        }

        .ui-menu-item:last-child {
            border-bottom: none;
        }

        .ui-state-active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        .modal-header {
            background:  var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 10px 10px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
        }

        .search-highlight {
            background-color: #fff3cd;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }

        /* View Modal Specific Styles */
        .info-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 1rem;
            font-weight: 600;
            color:var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value:last-child {
            margin-bottom: 0;
        }

        .gender-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .summary-item {
            padding: 1rem;
            text-align: center;
        }

        .summary-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.25rem;
        }

        .summary-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .summary-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #20c997) !important;
        }

        .card-header h6 {
            font-size: 0.9rem;
        }

        .display-6 {
            font-size: 1.5rem;
        }

        /* Print Styles */
        @media print {
            .modal-footer {
                display: none !important;
            }

            .modal-header {
                background: #2c3e50 !important;
                -webkit-print-color-adjust: exact;
            }

            .card-header {
                background: #2c3e50 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn {
                padding: 0.5rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .summary-item {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
        <!-- <div class="d-none d-sm-inline-block" style="margin-left:auto; float:right;">
                <div style="background-color:#2c3e50;" class="text-white p-3 rounded-lg">
                    <i class="fas fa-calendar-alt fa-fw"></i>
                    <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
                </div>
        </div> -->

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ count($newdeliveries) }}</div>
                    <div class="stats-label">Total Deliveries</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $newdeliveries->where('gender', 'Male')->count() }}</div>
                    <div class="stats-label">Male Babies</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $newdeliveries->where('gender', 'Female')->count() }}</div>
                    <div class="stats-label">Female Babies</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <!-- Optional: Add another stat card if needed -->

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Delivery Records</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Delivery
            </button>
        </div>

        <!-- Delivery Records Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>Delivery Records List
                </div>
                <span class="resident-badge">{{ count($newdeliveries) }} Records</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Parent Name</th>
                                <th>Child Name</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newdeliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->p_fname }} {{ $delivery->p_lname }}</td>
                                <td>{{ $delivery->c_fname }} {{ $delivery->c_lname }}</td>
                                <td>{{ $delivery->c_birthday }}</td>
                                <td>{{ $delivery->gender }}</td>
                                <td>{{ $delivery->weight }} kg</td>
                                <td>{{ $delivery->height }}cm</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-info btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#viewDeliveryModal" data-delivery="{{ json_encode($delivery) }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editDeliveryModal" data-delivery="{{ json_encode($delivery) }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Delivery Modal -->
    <div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('bhw.storeNewDelivery') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resident_id" id="resident_id">
                    <input type="hidden" name="pregnants_id" id="pregnants_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDeliveryModalLabel">
                            <i class="fas fa-plus-circle me-2"></i>Add New Delivery Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user info-icon"></i>Parent Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="resident_search" class="form-label">Search Resident</label>
                                                <input type="text" id="resident_search" class="form-control" placeholder="Type resident name...">
                                                <div class="form-text">Start typing to search for residents or leave blank to enter manually</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="p_fname" class="form-label">First Name *</label>
                                                <input type="text" name="p_fname" id="p_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="p_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="p_mname" id="p_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="p_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="p_lname" id="p_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="age" class="form-label">Age *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                                    <input type="number" name="age" id="age" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                                    <input type="date" name="birthday" id="birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="household_no" class="form-label">Household No. *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                    <input type="text" name="household_no" id="household_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="purok_no" class="form-label">Purok No. *</label>
                                                <select name="purok_no" id="purok_no" class="form-select" required>
                                                    <option value="">Select Purok</option>
                                                    <option value="1">Purok 1</option>
                                                    <option value="2">Purok 2</option>
                                                    <option value="3">Purok 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="sitio" class="form-label">Sitio *</label>
                                                <select name="sitio" id="sitio" class="form-select" required>
                                                    <option value="">Select Sitio</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Leksab">Leksab</option>
                                                    <option value="Taew">Taew</option>
                                                    <option value="Pidlaoan">Pidlaoan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="placeofbirth" class="form-label">Place of Birth *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" name="placeofbirth" id="placeofbirth" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="typeof_birth" class="form-label">Type of Birth *</label>
                                                <select name="typeof_birth" id="typeof_birth" class="form-select" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Caesarean">Caesarean</option>
                                                    <option value="Assisted">Assisted</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-baby info-icon"></i>Child Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="c_fname" class="form-label">First Name *</label>
                                                <input type="text" name="c_fname" id="c_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="c_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="c_mname" id="c_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="c_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="c_lname" id="c_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="c_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                    <input type="date" name="c_birthday" id="c_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="time" class="form-label">Time *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    <input type="time" name="time" id="time" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="weight" class="form-label">Weight (kg) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                                    <input type="text" name="weight" id="weight" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="height" class="form-label">Height (cm) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i></span>
                                                    <input type="text" name="height" id="height" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="gender" class="form-label">Gender *</label>
                                                <select name="gender" id="gender" class="form-select" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Delivery Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Delivery Modal -->
    <div class="modal fade" id="viewDeliveryModal" tabindex="-1" aria-labelledby="viewDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #2c3e50;">
                    <h5 class="modal-title" id="viewDeliveryModalLabel">
                        <i class="fas fa-eye me-2"></i>Delivery Record Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Parent Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-#2c3e50 text-white py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">PARENT INFORMATION</h6>
                                            <small class="opacity-75">Mother's Details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="info-item">
                                                <span class="info-label">Full Name:  <span class="info-value" id="view_p_fname"></span> <span class="info-value" id="view_p_mname"></span> <span class="info-value" id="view_p_lname"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Age: <span class="info-value" id="view_age"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Birthday: <span class="info-value" id="view_birthday"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Household No.<span class="info-value" id="view_household_no"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Purok No.{{ $delivery->purok_no }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Sitio: <span id="view_sitio" class="info-value"></span>
                                                <span class="info-value" id="view_sitio"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Place of Birth:<span class="info-value" id="view_placeofbirth"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Type of Birth</span>
                                                <span class="info-value badge bg-info" id="view_typeof_birth"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Child Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-#2c3e50 text-white py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-baby text-success fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">CHILD INFORMATION</h6>
                                            <small class="opacity-75">Newborn Details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="info-item">
                                                <span class="info-label">Full Name:<span class="info-value" id="view_c_fname"></span> <span class="info-value" id="view_c_mname"></span> <span class="info-value" id="view_c_lname"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Birth Date:<span class="info-value" id="view_c_birthday"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Time of Birth:<span class="info-value" id="view_time"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Weight</span>
                                                <span class="info-value display-6 text-primary fw-bold" id="view_weight"></span>
                                                <small class="text-muted">kg</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Height</span>
                                                <span class="info-value display-6 text-success fw-bold" id="view_height"></span>
                                                <small class="text-muted">cm</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Gender</span>
                                                <span class="info-value">
                                                    <span class="badge gender-badge" id="view_gender_badge"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <!-- <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-gradient-info text-white py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clipboard-check fa-lg me-3"></i>
                                <h6 class="mb-0 fw-bold">DELIVERY SUMMARY</h6>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-primary">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_parent_name"></div>
                                            <div class="summary-label">Mother's Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-success">
                                            <i class="fas fa-baby"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_child_name"></div>
                                            <div class="summary-label">Baby's Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-warning">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_birth_date"></div>
                                            <div class="summary-label">Date of Birth</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-info">
                                            <i class="fas fa-venus-mars"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_gender"></div>
                                            <div class="summary-label">Gender</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                    </button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Record
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Edit Delivery Modal -->
    <div class="modal fade" id="editDeliveryModal" tabindex="-1" aria-labelledby="editDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="#" method="POST" id="editDeliveryForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="delivery_id" id="edit_delivery_id">
                    <input type="hidden" name="resident_id" id="edit_resident_id">
                    <input type="hidden" name="pregnants_id" id="edit_pregnants_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDeliveryModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Delivery Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user info-icon"></i>Parent Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_fname" class="form-label">First Name *</label>
                                                <input type="text" name="p_fname" id="edit_p_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="p_mname" id="edit_p_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="p_lname" id="edit_p_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_age" class="form-label">Age *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                                    <input type="number" name="age" id="edit_age" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                                    <input type="date" name="birthday" id="edit_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_household_no" class="form-label">Household No. *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                    <input type="text" name="household_no" id="edit_household_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_purok_no" class="form-label">Purok No. *</label>
                                                <select name="purok_no" id="edit_purok_no" class="form-select" required>
                                                    <option value="">Select Purok</option>
                                                    <option value="1">Purok 1</option>
                                                    <option value="2">Purok 2</option>
                                                    <option value="3">Purok 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_sitio" class="form-label">Sitio *</label>
                                                <select name="sitio" id="edit_sitio" class="form-select" required>
                                                    <option value="">Select Sitio</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Leksab">Leksab</option>
                                                    <option value="Taew">Taew</option>
                                                    <option value="Pidlaoan">Pidlaoan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_placeofbirth" class="form-label">Place of Birth *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" name="placeofbirth" id="edit_placeofbirth" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_typeof_birth" class="form-label">Type of Birth *</label>
                                                <select name="typeof_birth" id="edit_typeof_birth" class="form-select" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Caesarean">Caesarean</option>
                                                    <option value="Assisted">Assisted</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-baby info-icon"></i>Child Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_fname" class="form-label">First Name *</label>
                                                <input type="text" name="c_fname" id="edit_c_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="c_mname" id="edit_c_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="c_lname" id="edit_c_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_c_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                    <input type="date" name="c_birthday" id="edit_c_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_time" class="form-label">Time *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    <input type="time" name="time" id="edit_time" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_weight" class="form-label">Weight (kg) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                                    <input type="text" name="weight" id="edit_weight" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_height" class="form-label">Height (cm) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i></span>
                                                    <input type="text" name="height" id="edit_height" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_gender" class="form-label">Gender *</label>
                                                <select name="gender" id="edit_gender" class="form-select" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Delivery Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            function calculateAge(birthday) {
                if (birthday) {
                    var age = new Date().getFullYear() - new Date(birthday).getFullYear();
                    return age;
                }
                return '';
            }
            function formatTo12Hour(time) {
                    if (!time) return 'N/A';

                    // Split into hours/minutes
                    const [hour, minute] = time.split(':');
                    let h = parseInt(hour);
                    const ampm = h >= 12 ? 'PM' : 'AM';

                    h = h % 12 || 12; // Convert 0 → 12, 13 → 1, 14 → 2, etc.

                    return `${h}:${minute} ${ampm}`;
                }

            function updateSitio() {
                var purok = document.getElementById('purok_no').value;
                if (purok == 1) {
                    $("#sitio").val("Leksab");
                } else if (purok == 2) {
                    $("#sitio").val("Taew");
                } else if (purok == 3) {
                    $("#sitio").val("Pidlaoan");
                } else {
                    $("#sitio").val("N/A");
                }

            }

            // View Button Click Handler
            $('.view-btn').on('click', function() {
                var deliveryData = $(this).data('delivery');

                // Populate Parent Information
                $('#view_p_fname').text(deliveryData.p_fname || 'N/A');
                $('#view_p_mname').text(deliveryData.p_mname || '');
                $('#view_p_lname').text(deliveryData.p_lname || 'N/A');
                $('#view_age').text(deliveryData.age ? deliveryData.age + ' years old' : 'N/A');
                $('#view_birthday').text(deliveryData.birthday || 'N/A');
                $('#view_household_no').text(deliveryData.household_no || 'N/A');
                $('#view_purok_no').text(deliveryData.purok_no ? 'Purok ' + deliveryData.purok_no : 'N/A');
                $('#view_sitio').text(deliveryData.sitio || 'N/A');
                $('#view_placeofbirth').text(deliveryData.placeofbirth || 'N/A');
                $('#view_typeof_birth').text(deliveryData.typeof_birth || 'N/A');

                // Populate Child Information
                $('#view_c_fname').text(deliveryData.c_fname || 'N/A');
                $('#view_c_mname').text(deliveryData.c_mname || '');
                $('#view_c_lname').text(deliveryData.c_lname || 'N/A');
                $('#view_c_birthday').text(deliveryData.c_birthday || 'N/A');
                $('#view_time').text(formatTo12Hour(deliveryData.time));
                $('#view_weight').text(deliveryData.weight || 'N/A');
                $('#view_height').text(deliveryData.height || 'N/A');

                // Gender badge with color coding
                var gender = deliveryData.gender || 'N/A';
                var genderBadge = $('#view_gender_badge');
                genderBadge.text(gender);
                if (gender === 'Male') {
                    genderBadge.removeClass('bg-danger bg-secondary').addClass('bg-primary');
                } else if (gender === 'Female') {
                    genderBadge.removeClass('bg-primary bg-secondary').addClass('bg-danger');
                } else {
                    genderBadge.removeClass('bg-primary bg-danger').addClass('bg-secondary');
                }

                // Populate Summary Section
                $('#summary_parent_name').text((deliveryData.p_fname || '') + ' ' + (deliveryData.p_lname || ''));
                $('#summary_child_name').text((deliveryData.c_fname || '') + ' ' + (deliveryData.c_lname || ''));
                $('#summary_birth_date').text(deliveryData.c_birthday || 'N/A');
                $('#summary_gender').text(deliveryData.gender || 'N/A');
            });

            // Edit Button Click Handler
            $('.edit-btn').on('click', function() {
                var deliveryData = $(this).data('delivery');

                // Set form action
                $('#editDeliveryForm').attr('action', '{{ route("bhw.newdelivery.update", "") }}/' + deliveryData.id);
                $('#edit_delivery_id').val(deliveryData.id);

                // Populate Parent Information
                $('#edit_p_fname').val(deliveryData.p_fname || '');
                $('#edit_p_mname').val(deliveryData.p_mname || '');
                $('#edit_p_lname').val(deliveryData.p_lname || '');
                $('#edit_age').val(deliveryData.age || '');
                $('#edit_birthday').val(deliveryData.birthday || '');
                $('#edit_household_no').val(deliveryData.household_no || '');
                $('#edit_purok_no').val(deliveryData.purok_no || '');
                $('#edit_sitio').val(deliveryData.sitio || '');
                $('#edit_placeofbirth').val(deliveryData.placeofbirth || '');
                $('#edit_typeof_birth').val(deliveryData.typeof_birth || '');

                // Populate Child Information
                $('#edit_c_fname').val(deliveryData.c_fname || '');
                $('#edit_c_mname').val(deliveryData.c_mname || '');
                $('#edit_c_lname').val(deliveryData.c_lname || '');
                $('#edit_c_birthday').val(deliveryData.c_birthday || '');
                $('#edit_time').val(deliveryData.time || '');
                $('#edit_weight').val(deliveryData.weight || '');
                $('#edit_height').val(deliveryData.height || '');
                $('#edit_gender').val(deliveryData.gender || '');
            });

            // Initialize autocomplete when modal is shown
            $('#addDeliveryModal').on('shown.bs.modal', function () {
                $("#resident_search").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('bhw.search_residents') }}",
                            dataType: "json",
                            data: { query: request.term },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.fname + ' ' + item.lname,
                                        value: item.fname + ' ' + item.lname,
                                        data: item
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        const r = ui.item.data;
                        $("#resident_id").val(r.id);
                        $("#p_fname").val(r.fname);
                        $("#p_mname").val(r.mname);
                        $("#p_lname").val(r.lname);
                        $("#birthday").val(r.birthday);
                        $("#age").val(calculateAge(r.birthday));
                        $("#household_no").val(r.household_no);
                        $("#purok_no").val(r.purok_no);
                        updateSitio();
                        $("#sitio").val(r.sitio);
                    }
                });
            });

            // Update sitio when purok changes
            $('#purok_no').on('change', function() {
                updateSitio();
            });

            // Calculate age when birthday changes
            $('#birthday').on('change', function() {
                var birthday = $(this).val();
                if (birthday) {
                    var age = calculateAge(birthday);
                    $("#age").val(age);
                }
            });

            // Reset form when modal is closed
            $('#addDeliveryModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                if ($("#resident_search").hasClass("ui-autocomplete-input")) {
                    $("#resident_search").autocomplete("destroy");
                }
            });

            // Add some visual feedback when required fields are filled
            $('input, select').on('change', function() {
                if ($(this).val()) {
                    $(this).addClass('is-valid');
                } else {
                    $(this).removeClass('is-valid');
                }
            });
        });
    </script>
</body>
</html>
@endsection
