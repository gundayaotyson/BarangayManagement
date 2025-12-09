@extends('bhw.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregnant Records - BHW Dashboard</title>
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
            background: var(--primary-color);
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
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary-color);
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

        .display-6 {
            font-size: 1.5rem;
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
    <div class="container py-4">
        @if (session('success'))
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
                    <div class="stats-number">{{ count($pregnants) }}</div>
                    <div class="stats-label">Total Records</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 1)->count() }}</div>
                    <div class="stats-label">Purok 1</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 2)->count() }}</div>
                    <div class="stats-label">Purok 2</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 3)->count() }}</div>
                    <div class="stats-label">Purok 3</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Pregnant Records</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPregnantModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Record
            </button>
        </div>

        <!-- Pregnant Records Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>Pregnant Records List
                </div>
                <span class="resident-badge">{{ count($pregnants) }} Records</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>LMP Date</th>
                                <th>EMC Date</th>
                                <th>Sitio</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pregnants as $pregnant)
                                <tr>
                                    <td>{{ $pregnant->Fname }} {{ $pregnant->mname }} {{ $pregnant->lname }}</td>
                                    <td>{{ $pregnant->birthday }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pregnant->birthday)->age }}</td>
                                    <td>#{{ $pregnant->household_no }}, Purok {{ $pregnant->purok_no }}</td>
                                    <td>{{ $pregnant->LMP_date }}</td>
                                    <td>{{ $pregnant->EMC_date }}</td>
                                    <td>{{ $pregnant->sitio }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-info btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#viewPregnantModal" data-pregnant="{{ json_encode($pregnant) }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editPregnantModal" data-pregnant="{{ json_encode($pregnant) }}">
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

    <!-- Add Pregnant Modal -->
    <div class="modal fade" id="addPregnantModal" tabindex="-1" aria-labelledby="addPregnantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('bhw.pregnant.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resident_id" id="resident_id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="addPregnantModalLabel">
                            <i class="fas fa-plus-circle me-2"></i>Add New Pregnant Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-user info-icon"></i>Resident Information
                                </h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="resident_name" class="form-label">Search Resident</label>
                                <input type="text" id="resident_name" class="form-control" placeholder="Type resident name...">
                                <div class="form-text">Start typing to search for residents or enter information manually</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <label for="Fname" class="form-label">First Name *</label>
                                    <input type="text" name="Fname" id="Fname" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="mname" class="form-label">Middle Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="lname" class="form-label">Last Name *</label>
                                    <input type="text" name="lname" id="lname" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="birthday" class="form-label">Birthday *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                    <input type="date" name="birthday" id="birthday" class="form-control" required onchange="calculateAge()">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                    <input type="text" name="age" id="age" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="household_no" class="form-label">House No. *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="number" name="household_no" id="household_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="purok_no" class="form-label">Purok No. *</label>
                                <select name="purok_no" id="purok_no" class="form-select" onchange="updateSitio()" required>
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
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-baby info-icon"></i>Pregnancy Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="LMP_date" class="form-label">Last Menstrual Period (LMP) Date *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="LMP_date" id="LMP_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="EMC_date" class="form-label">Estimated Month of Confinement (EMC) Date *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <input type="date" name="EMC_date" id="EMC_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Pregnant Modal -->
    <div class="modal fade" id="viewPregnantModal" tabindex="-1" aria-labelledby="viewPregnantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background:#2c3e50;">
                    <h5 class="modal-title" id="viewPregnantModalLabel">
                        <i class="fas fa-eye me-2"></i>Pregnant Record Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Resident Information -->
                        <div class="col-md-6" style="width: 100% !important; margin: 0 auto; float:none;">

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-#2c3e50 text-white py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">RESIDENT INFORMATION</h6>
                                            <small class="opacity-75">Personal Details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Full Name:<span class="info-value" id="view_Fname"></span> <span class="info-value" id="view_mname"></span> <span class="info-value" id="view_lname"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div class="info-item">
                                                <span class="info-label">Birthday:<span class="info-value" id="view_birthday"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Age: <span class="info-value" id="view_age"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Household No. <span class="info-value" id="view_household_no"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Purok No.<span class="info-value" id="view_purok_no"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-item">
                                                <span class="info-label">Sitio:<span class="info-value" id="view_sitio"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">LMP Date:<span class="info-value" id="view_LMP_date"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">EMC Date:<span class="info-value" id="view_EMC_date"></span></span>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <div class="info-item text-center">
                                                <span class="info-label">Pregnancy Duration</span>
                                                <span class="info-value display-6 text-primary fw-bold" id="view_pregnancy_duration"></span>
                                                <small class="text-muted">weeks</small>
                                            </div>
                                        </div> -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pregnancy Information -->
                    </div>

                    <!-- Summary Card -->
                    <!-- <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-gradient-info text-white py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clipboard-check fa-lg me-3"></i>
                                <h6 class="mb-0 fw-bold">PREGNANCY SUMMARY</h6>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-primary">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_full_name"></div>
                                            <div class="summary-label">Patient Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-success">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_emc_date"></div>
                                            <div class="summary-label">Due Date</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-warning">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_weeks_pregnant"></div>
                                            <div class="summary-label">Weeks Pregnant</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Record
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Edit Pregnant Modal -->
    <div class="modal fade" id="editPregnantModal" tabindex="-1" aria-labelledby="editPregnantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editPregnantForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pregnant_id" id="edit_pregnant_id">
                    <input type="hidden" name="resident_id" id="edit_resident_id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editPregnantModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Pregnant Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-user info-icon"></i>Resident Information
                                </h5>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <label for="edit_Fname" class="form-label">First Name *</label>
                                    <input type="text" name="Fname" id="edit_Fname" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="edit_mname" class="form-label">Middle Name</label>
                                    <input type="text" name="mname" id="edit_mname" class="form-control">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="edit_lname" class="form-label">Last Name *</label>
                                    <input type="text" name="lname" id="edit_lname" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_birthday" class="form-label">Birthday *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                    <input type="date" name="birthday" id="edit_birthday" class="form-control" required onchange="calculateEditAge()">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_age" class="form-label">Age</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                    <input type="text" name="age" id="edit_age" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="edit_household_no" class="form-label">House No. *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="number" name="household_no" id="edit_household_no" class="form-control" required>
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
                        </div>
<!--
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-baby info-icon"></i>Pregnancy Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_LMP_date" class="form-label">Last Menstrual Period (LMP) Date *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="LMP_date" id="edit_LMP_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_EMC_date" class="form-label">Estimated Month of Confinement (EMC) Date *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <input type="date" name="EMC_date" id="edit_EMC_date" class="form-control" required>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <script>
    $(function() {
        function calculateAge() {
            var birthday = document.getElementById('birthday').value;
            if (birthday) {
                var today = new Date();
                var birthDate = new Date(birthday);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                document.getElementById('age').value = age;
            }
        }

        function calculateEditAge() {
            var birthday = document.getElementById('edit_birthday').value;
            if (birthday) {
                var today = new Date();
                var birthDate = new Date(birthday);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                document.getElementById('edit_age').value = age;
            }
        }

        function updateSitio() {
            var purok = document.getElementById('purok_no').value;
            var sitioDropdown = document.getElementById('sitio');

            // Clear current selection
            sitioDropdown.selectedIndex = 0;

            // Set sitio based on purok selection
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

        function calculatePregnancyDuration(LMP_date) {
            if (!LMP_date) return 'N/A';

            var lmp = new Date(LMP_date);
            var today = new Date();

            // Calculate the difference in milliseconds
            var diffTime = Math.abs(today - lmp);

            // Convert to weeks
            var diffWeeks = Math.floor(diffTime / (1000 * 60 * 60 * 24 * 7));

            return diffWeeks;
        }

        // Function to update pregnancy duration in real-time for Add Modal
        function updateAddPregnancyDuration() {
            var lmpDate = $('#LMP_date').val();
            var pregnancyWeeks = calculatePregnancyDuration(lmpDate);

            // Update the display if you have one in add modal, or create one
            if ($('#add_pregnancy_duration').length) {
                $('#add_pregnancy_duration').text(pregnancyWeeks);
            }
        }

        // Function to update pregnancy duration in real-time for Edit Modal
        function updateEditPregnancyDuration() {
            var lmpDate = $('#edit_LMP_date').val();
            var pregnancyWeeks = calculatePregnancyDuration(lmpDate);

            // Update the display in edit modal
            if ($('#edit_pregnancy_duration').length) {
                $('#edit_pregnancy_duration').text(pregnancyWeeks);
            }
        }

        // View Button Click Handler
        $('.view-btn').on('click', function() {
            var pregnantData = $(this).data('pregnant');
            console.log('View Data:', pregnantData);

            // Populate Resident Information
            $('#view_Fname').text(pregnantData.Fname || 'N/A');
            $('#view_mname').text(pregnantData.mname || '');
            $('#view_lname').text(pregnantData.lname || 'N/A');
            $('#view_birthday').text(pregnantData.birthday || 'N/A');

            // Calculate age for view
            if (pregnantData.birthday) {
                var today = new Date();
                var birthDate = new Date(pregnantData.birthday);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#view_age').text(age + ' years old');
            } else {
                $('#view_age').text('N/A');
            }

            $('#view_household_no').text(pregnantData.household_no || 'N/A');
            $('#view_purok_no').text(pregnantData.purok_no ? 'Purok ' + pregnantData.purok_no : 'N/A');
            $('#view_sitio').text(pregnantData.sitio || 'N/A');

            // Populate Pregnancy Information
            $('#view_LMP_date').text(pregnantData.LMP_date || 'N/A');
            $('#view_EMC_date').text(pregnantData.EMC_date || 'N/A');

            // Calculate and display pregnancy duration
            var pregnancyWeeks = calculatePregnancyDuration(pregnantData.LMP_date);
            $('#view_pregnancy_duration').text(pregnancyWeeks);

            // Populate Summary Section
            $('#summary_full_name').text((pregnantData.Fname || '') + ' ' + (pregnantData.lname || ''));
            $('#summary_emc_date').text(pregnantData.EMC_date || 'N/A');
            $('#summary_weeks_pregnant').text(pregnancyWeeks + ' weeks');
        });

        // Edit Button Click Handler
        $('.edit-btn').on('click', function() {
            var pregnantData = $(this).data('pregnant');
            console.log('Edit Data:', pregnantData);

            // Set form action
            var updateRoute = "{{ route('bhw.pregnant.update', '') }}/" + pregnantData.id;
            $('#editPregnantForm').attr('action', updateRoute);

            $('#edit_pregnant_id').val(pregnantData.id);

            // Populate Resident Information
            $('#edit_Fname').val(pregnantData.Fname || '');
            $('#edit_mname').val(pregnantData.mname || '');
            $('#edit_lname').val(pregnantData.lname || '');
            $('#edit_birthday').val(pregnantData.birthday || '');

            // Calculate and set age for edit form
            if (pregnantData.birthday) {
                var today = new Date();
                var birthDate = new Date(pregnantData.birthday);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#edit_age').val(age);
            } else {
                $('#edit_age').val('');
            }

            $('#edit_household_no').val(pregnantData.household_no || '');
            $('#edit_purok_no').val(pregnantData.purok_no || '');
            $('#edit_sitio').val(pregnantData.sitio || '');

            // Populate Pregnancy Information
            $('#edit_LMP_date').val(pregnantData.LMP_date || '');
            $('#edit_EMC_date').val(pregnantData.EMC_date || '');

            // Calculate and display initial pregnancy duration for edit modal
            var initialPregnancyWeeks = calculatePregnancyDuration(pregnantData.LMP_date);
            // Create or update pregnancy duration display in edit modal
            if (!$('#edit_pregnancy_duration').length) {
                // Add pregnancy duration display to edit modal if it doesn't exist
                $('#edit_EMC_date').closest('.row').after(`
                    <div class="col-md-12 mb-3">
                        <div class="info-item text-center p-3 bg-light rounded">
                            <span class="info-label fw-bold text-primary">Current Pregnancy Duration</span>
                            <div class="info-value display-6 text-primary fw-bold" id="edit_pregnancy_duration">${initialPregnancyWeeks}</div>
                            <small class="text-muted">weeks (updates automatically when LMP changes)</small>
                        </div>
                    </div>
                `);
            } else {
                $('#edit_pregnancy_duration').text(initialPregnancyWeeks);
            }
        });

        // Initialize autocomplete when modal is shown
        $('#addPregnantModal').on('shown.bs.modal', function () {
            $("#resident_name").autocomplete({
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

                    // Set hidden resident_id field if needed
                    $("#resident_id").val(r.id);

                    // Populate form fields with resident data
                    $("#Fname").val(r.fname);
                    $("#mname").val(r.mname);
                    $("#lname").val(r.lname);
                    $("#birthday").val(r.birthday);
                    $("#household_no").val(r.household_no);

                    // Set purok_no value and update sitio
                    $("#purok_no").val(r.purok_no);
                    updateSitio();

                    // Calculate age
                    calculateAge();
                }
            });

            // Add pregnancy duration display to add modal
            if (!$('#add_pregnancy_duration').length) {
                $('#EMC_date').closest('.row').after(`
                    <div class="col-md-12 mb-3">
                        <div class="info-item text-center p-3 bg-light rounded">
                            <span class="info-label fw-bold text-primary">Pregnancy Duration</span>
                            <div class="info-value display-6 text-primary fw-bold" id="add_pregnancy_duration">0</div>
                            <small class="text-muted">weeks (updates automatically when LMP changes)</small>
                        </div>
                    </div>
                `);
            }
        });

        // Reset form when modal is closed
        $('#addPregnantModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();

            // Destroy autocomplete to prevent multiple initializations
            if ($("#resident_name").hasClass("ui-autocomplete-input")) {
                $("#resident_name").autocomplete("destroy");
            }
        });

        // Add visual feedback when required fields are filled
        $('input[required], select[required]').on('change', function() {
            if ($(this).val()) {
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
            }
        });

        // Update sitio when purok changes
        $('#purok_no').on('change', function() {
            updateSitio();
        });

        // Calculate age when birthday changes
        $('#birthday').on('change', function() {
            calculateAge();
        });

        $('#edit_birthday').on('change', function() {
            calculateEditAge();
        });

        // Real-time pregnancy duration updates
        $('#LMP_date').on('change', function() {
            updateAddPregnancyDuration();
        });

        $('#edit_LMP_date').on('change', function() {
            updateEditPregnancyDuration();
        });

        // Also update on input for immediate feedback
        $('#LMP_date').on('input', function() {
            updateAddPregnancyDuration();
        });

        $('#edit_LMP_date').on('input', function() {
            updateEditPregnancyDuration();
        });
    });
</script>
</body>
</html>
@endsection
