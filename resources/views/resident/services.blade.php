@extends('resident.resident-layout')

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --primary-dark: #2980b9;
        --secondary-color: #2ecc71;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --dark-color: #2c3e50;
        --light-color: #ecf0f1;
        --text-color: #333;
        --text-muted: #6c757d;
        --primary-light: #e3f2fd;
        --border-color: #ddd;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    .hero-section {
        background:var(--dark-color);
        color: var(--light-color);
        margin-bottom: 3rem;
        border-radius:1rem;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><pattern id="grain" width="100" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="30" cy="5" r="0.3" fill="rgba(255,255,255,0.05)"/><circle cx="60" cy="15" r="0.4" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="20" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .service-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px var(--shadow-color);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .service-card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .service-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--light-color);
        font-size: 24px;
    }

    .btn-apply {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-dark));
    }

    .requests-section {
        background: var(--light-color);
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 3rem;
    }

    .requests-title {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .requests-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        border-radius: 3px;
    }

    .table-container {
        background: var(--light-color);
        overflow: hidden;
        box-shadow: 0 5px 20px var(--shadow-color);
    }

    .table thead th {
        background: var(--dark-color);
        color: var(--light-color);
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        border-color: var(--border-color);
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: var(--light-color);
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background-color: var(--warning-color);
        color: var(--light-color);
    }

    .status-approved {
        background-color: var(--primary-color);
        color: var(--light-color);
    }
     .status-released {
        background-color: var(--success-color);
        color: var(--light-color);
    }
    .status-declined {
        background-color: var(--danger-color);
        color: var(--light-color);
    }
    .status-rejected {
        background-color: var(--danger-color);
        color: var(--light-color);
    }

    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background:var(--primary-dark);
        color: var(--light-color);
        border: none;
        border-radius: 1rem 1rem 0 0;
        padding: 1.5rem 2rem;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-dark));
        transform: translateY(-1px);
    }

    .close {
        opacity: 0.8;
        font-size: 1.5rem;
    }

    /* Mobile Responsive Table Styles */
    .mobile-request-card {
        background: white;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px var(--shadow-color);
        border-left: 4px solid var(--primary-color);
    }

    .mobile-request-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    .mobile-request-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .mobile-request-label {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.875rem;
        min-width: 120px;
    }

    .mobile-request-value {
        color: var(--text-color);
        font-size: 0.875rem;
        text-align: right;
        flex: 1;
    }

    .mobile-status-badge {
        padding: 0.35rem 0.7rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
    }

    .desktop-table {
        display: table;
    }

    .mobile-cards {
        display: none;
    }

    .no-requests-mobile {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }

    .no-requests-mobile i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .service-card .card-body {
            padding: 1.5rem;
        }

        .requests-section {
            padding: 1.25rem;
            margin-top: 2rem;
        }

        .table-responsive {
            border-radius: 1rem;
        }

        /* Hide desktop table on mobile */
        .desktop-table {
            display: none;
        }

        /* Show mobile cards on mobile */
        .mobile-cards {
            display: block;
        }

        .mobile-request-card:last-child {
            margin-bottom: 0;
        }

        .requests-title {
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .hero-content h1 {
            font-size: 1.75rem;
        }

        .hero-content p {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 1rem 0;
            border-radius: 0.75rem;
        }

        .requests-section {
            padding: 1rem;
            border-radius: 0.75rem;
        }

        .mobile-request-card {
            padding: 1rem;
        }

        .mobile-request-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .mobile-request-label {
            min-width: auto;
            margin-bottom: 0.25rem;
        }

        .mobile-request-value {
            text-align: left;
            width: 100%;
        }

        .service-card .card-body {
            padding: 1.25rem;
        }

        .btn-apply {
            padding: 0.6rem 1.5rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 400px) {
        .mobile-request-card {
            padding: 0.875rem;
        }

        .mobile-request-label {
            font-size: 0.8rem;
        }

        .mobile-request-value {
            font-size: 0.8rem;
        }

        .mobile-status-badge {
            font-size: 0.65rem;
            padding: 0.3rem 0.6rem;
        }
    }
</style>

<div class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-4 font-weight-bold mb-3">Barangay Services</h1>
            <p class="lead">Access essential barangay services quickly and efficiently</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-2">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card service-card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="card-title font-weight-bold mb-3">Senior Citizen Service</h5>
                    <p class="card-text text-muted mb-4">
                        Apply for your Senior Citizen services and benefits easily through this service.
                    </p>

                    <!-- Button triggers modal -->
                    <button type="button" class="btn btn-primary btn-apply" data-bs-toggle="modal" data-bs-target="#seniorServiceModal">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 mb-4">
    <div class="card service-card">
        <div class="card-body">
            <div class="service-icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h5 class="card-title font-weight-bold mb-3">BHW Service</h5>
            <p class="card-text text-muted mb-4"> Access health programs, check-ups, and support provided by our Barangay Health Workers.</p>
            <button type="button" class="btn btn-primary btn-apply" data-toggle="modal" data-target="#bhwServiceModal">
                Apply Now
            </button>
        </div>
    </div>
</div>

    </div>

    <div class="row mb-5">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card service-card">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="card-title font-weight-bold mb-3">SK Service</h5>
                    <p class="card-text text-muted mb-4">Apply for Sangguniang Kabataan services and youth programs in your barangay.</p>

                        <button type="button" class="btn btn-primary btn-apply" data-toggle="modal" data-target="#skServiceModal">
                            Apply Now
                        </button>
                    </div>
                </div>
            </div>

        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card service-card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="card-title font-weight-bold mb-3">Legal Documents</h5>
                    <p class="card-text text-muted mb-4">Apply for residency, clearance, and other official barangay documents conveniently online.</p>

                    <button type="button" class="btn btn-primary btn-apply" data-toggle="modal" data-target="#legalDocumentModal">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card service-card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="card-title font-weight-bold mb-3">4p's Services</h5>
                    <p class="card-text text-muted mb-4">Apply for residency, clearance, and other official barangay documents conveniently online.</p>

                    <button type="button" class="btn btn-primary btn-apply" data-toggle="modal" data-target="#legalDocumentModal">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- BHW Service Modal -->
                    <div class="modal fade" id="bhwServiceModal" tabindex="-1" role="dialog" aria-labelledby="bhwServiceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bhwServiceModalLabel">
                                            <i class="fas fa-heartbeat me-2"></i>BHW Service Application</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('bhw.request.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="resident_id" value="{{ $resident->id ?? '' }}">

                                            <!-- Personal Information -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_fname">First Name</label>
                                                        <input type="text" class="form-control" id="bhw_fname" name="fname" value="{{ $resident->Fname ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_mname">Middle Name</label>
                                                        <input type="text" class="form-control" id="bhw_mname" name="mname" value="{{ $resident->mname ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_lname">Last Name</label>
                                                        <input type="text" class="form-control" id="bhw_lname" name="lname" value="{{ $resident->lname ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_dob">Date of Birth</label>
                                                        <input type="date" class="form-control" id="bhw_dob" name="dob" value="{{ $resident->birthday ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_age">Age</label>
                                                        <input type="number" class="form-control" id="bhw_age" name="age" value="{{ $resident->age ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bhw_gender">Gender</label>
                                                        <input type="text" class="form-control" id="bhw_gender" name="gender" value="{{ $resident->gender ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Address Information -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bhw_purok_no">Purok</label>
                                                        <input type="text" class="form-control" id="bhw_purok_no" name="purok_no" value="{{ $resident->purok_no ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bhw_sitio">Sitio</label>
                                                        <input type="text" class="form-control" id="bhw_sitio" name="sitio" value="{{ $resident->sitio ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Service Details -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bhw_service_type">Service Type</label>
                                                        <select class="form-control" id="bhw_service_type" name="service_type" required>
                                                            <option value="">Select a service</option>
                                                            <option value="Check-up">Check-up</option>
                                                            <option value="Immunization">Immunization</option>
                                                            <option value="Prenatal Care">Prenatal Care</option>
                                                            <option value="Family Planning">Family Planning</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bhw_contact_no">Contact Number</label>
                                                        <input type="text" class="form-control" id="bhw_contact_no" name="contact_no" value="{{ $resident->contact_number ?? '' }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="bhw_chief_complaint">Chief Complaint</label>
                                                <textarea class="form-control" id="bhw_chief_complaint" name="chief_complaint" rows="3" placeholder="Describe the main health concern..." required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="bhw_phil_no">PhilHealth Number (Optional)</label>
                                                <input type="text" class="form-control" id="bhw_phil_no" name="phil_no" placeholder="Enter PhilHealth number if available">
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-submit w-100">
                                                <i class="fas fa-paper-plane me-2"></i>
                                                Submit Request
                                            </button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
            <!-- Modal senior services-->
    <div class="modal fade" id="seniorServiceModal" tabindex="-1" aria-labelledby="seniorServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('senior.req.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="seniorServiceModalLabel">Senior Citizen Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                    <!-- First Name -->
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstname">
                                    <i class="fas fa-user me-1"></i>
                                    First Name
                                </label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                       value="{{ $resident->Fname ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middlename">
                                    <i class="fas fa-user me-1"></i>
                                    Middle Name
                                </label>
                                <input type="text" class="form-control" id="middlename" name="middlename"
                                       value="{{ $resident->mname ?? '' }}" readonly>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastname">
                                    <i class="fas fa-user me-1"></i>
                                    Last Name
                                </label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                       value="{{ $resident->lname ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <i class="fas fa-birthday-cake me-1"></i>
                                <label for="dob">
                                    Date of Birth
                                </label>
                               <input type="text" class="form-control" id="dob" name="dob"value="{{ $resident->birthday ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">
                                    <i class="fas fa-user me-1"></i>
                                    Age
                                </label>
                                <input type="text" class="form-control" id="age" name="age"
                                       value="{{ $resident->age ?? '' }}" readonly>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">
                                     <i class="fas fa-venus-mars me-1"></i>
                                   Gender
                                </label>
                                <input type="text" class="form-control" id="gender" name="gender"
                                       value="{{ $resident->gender ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <i class="fas fa-birthday-cake me-1"></i>
                                <label for="house_no">
                                   House No.
                                </label>
                               <input type="text" class="form-control" id="house_no" name="house_no"value="{{ $resident->household_no ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="house_no">
                                    <i class="fas fa-user me-1"></i>
                                    Purok
                                </label>
                                <select class="form-control" id="purok" name="purok" readonly>
                                    <option value="{{ $resident->purok_no ?? '' }}">{{ $resident->purok_no ?? '' }} </option>
                            </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sitio">
                                     <i class="fas fa-venus-mars me-1"></i>
                                   Sitio
                                </label>
                                   <select class="form-control" id="sitio" name="sitio" readonly>
                                    <option value="{{ $resident->sitio  ?? '' }}">{{ $resident->sitio ?? '' }} </option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="oscaId">
                                    <i class="fas fa-id-card me-1"></i>
                                    OSCA ID
                                </label>
                                <input type="text" class="form-control" id="oscaId" name="oscaId" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="fcapId">
                                    <i class="fas fa-id-card me-1"></i>
                                    FCAP ID
                                </label>
                                <input type="text" class="form-control" id="fcapId" name="fcapId" required>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-paper-plane me-2"></i>
                         Submit Application
                    </button>
                </form>
            </div>
        </div>
</div>


    </div>
<!-- </div> -->

<!-- SK Service Modal -->
<div class="modal fade" id="skServiceModal" tabindex="-1" role="dialog" aria-labelledby="skServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skServiceModalLabel">
                    <i class="fas fa-graduation-cap me-2"></i>
                    SK Service Application
                </h5>

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sk-services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="resident_id" value="{{ $resident->id ?? '' }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">
                                    <i class="fas fa-user me-1"></i>
                                    First Name
                                </label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                       value="{{ $resident->Fname ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">
                                    <i class="fas fa-user me-1"></i>
                                    Last Name
                                </label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                       value="{{ $resident->lname ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="school">
                            <i class="fas fa-school me-1"></i>
                            School
                        </label>
                        <input type="text" class="form-control" id="school" name="school" required>
                    </div>

                    <div class="form-group">
                        <label for="school_year">
                            <i class="fas fa-calendar-alt me-1"></i>
                            School Year
                        </label>
                        <input type="text" class="form-control" id="school_year" name="school_year" placeholder="e.g., 2024-2025" required>
                    </div>

                    <div class="form-group">
                        <label for="type_of_service">
                            <i class="fas fa-tasks me-1"></i>
                            Type of Service
                        </label>
                        <select class="form-control" id="type_of_service" name="type_of_service" required>
                            <option value="">Select service type</option>
                            <option value="Scholarship Program">Free Printing</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="attachment">
                            <i class="fas fa-paperclip me-1"></i>
                            Attachment
                        </label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept="application/pdf" required>
                        <small class="form-text text-muted">
                            Supported formats: PDF (Max: 5MB)
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-paper-plane me-2"></i>
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Legal Document Modal -->
<div class="modal fade" id="legalDocumentModal" tabindex="-1" role="dialog" aria-labelledby="legalDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="legalDocumentModalLabel">
                    <i class="fas fa-file-alt me-2"></i>
                    Legal Document Application
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
    <form action="{{ route('legal-documents.store-clearance') }}" method="POST">
        @csrf
        <input type="hidden" name="resident_id" value="{{ $resident->id ?? '' }}">

        <div class="form-group">
            <label for="service_type">
                <i class="fas fa-list me-1"></i>
                Type of Service
            </label>
            <select class="form-control" id="service_type" name="service_type" required>
                <option value="">Select a service type</option>
                <option value="Barangay Clearance">Barangay Clearance</option>
                <option value="Certificate of Indigency">Certificate of Indigency</option>
                <option value="Barangay Business Permit">Barangay Business Permit</option>
                <option value="Barangay Residency">Barangay Residency</option>
            </select>
        </div>

        <div class="row">
            <!-- First Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Fname">
                        <i class="fas fa-user me-1"></i>
                        First Name
                    </label>
                    <input type="text" class="form-control" id="Fname" name="Fname"
                           value="{{ $resident->Fname ?? '' }}" readonly>
                </div>
            </div>

            <!-- Middle Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mname">
                        <i class="fas fa-user me-1"></i>
                        Middle Name
                    </label>
                    <input type="text" class="form-control" id="mname" name="mname"
                           value="{{ $resident->mname ?? '' }}" readonly>
                </div>
            </div>

            <!-- Last Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lname">
                        <i class="fas fa-user me-1"></i>
                        Last Name
                    </label>
                    <input type="text" class="form-control" id="lname" name="lname"
                           value="{{ $resident->lname ?? '' }}" readonly>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">
                <i class="fas fa-map-marker-alt me-1"></i>
                Address
            </label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $resident->purok_no ?? '' }} Cobol San Carlos City Pangasinan"
                   readonly>
        </div>

        <!-- Date of Birth & Place of Birth -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dateofbirth">
                        <i class="fas fa-birthday-cake me-1"></i>
                        Date of Birth
                    </label>
                    <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="{{ $resident->birthday ?? '' }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="placeofbirth">Place of Birth</label>
                    <input type="text" class="form-control" id="placeofbirth" name="placeofbirth" value="{{ $resident->birthplace ?? '' }}" readonly>
                </div>
            </div>
        </div>

        <!-- Civil Status & Gender -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="civil_status">
                        <i class="fas fa-heart me-1"></i>
                        Civil Status
                    </label>
                    <select class="form-control" id="civil_status" name="civil_status" readonly>
                        <option value="{{ $resident->civil_status ?? '' }}">{{ $resident->civil_status ?? '' }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">
                        <i class="fas fa-venus-mars me-1"></i>
                        Gender
                    </label>
                    <select class="form-control" id="gender" name="gender" readonly>
                        <option value="{{ $resident->gender ?? '' }}">{{ $resident->gender ?? '' }}</option>
                    </select>
                </div>
            </div>
        </div>



        <div id="business_fields" style="display: none; margin-top: 15px;">
            <div class="form-group">
                <label for="business_name">
                    <i class="fas fa-building me-1"></i>
                    Name of Business
                </label>
                <input type="text" class="form-control" name="business_name" id="business_name">
            </div>

            <div class="form-group">
                <label for="business_type">
                    <i class="fas fa-briefcase me-1"></i>
                    Type of Business
                </label>
                <input type="text" class="form-control" name="business_type" id="business_type">
            </div>

            <div class="form-group">
                <label for="business_address">
                    <i class="fas fa-map-marker-alt me-1"></i>
                    Business Address
                </label>
                <input type="text" class="form-control" name="business_address" id="business_address">
            </div>
        </div>

        <!-- Business / Residency additional fields (hidden by default) -->
        <div class="form-group" id="residency_start_field" style="display: none;">
            <label for="res_started_living"><i class="fas fa-calendar me-1"></i>Started Living in the Barangay (Year)</label>
            <input type="text" class="form-control" id="res_started_living" name="res_started_living" placeholder="Enter the year">
        </div>

        <div class="form-group" id="cert_use_field" style="display: none;">
            <label for="cert_use_date"><i class="fas fa-calendar me-1"></i>When will the Certificate be Used</label>
            <input type="date" class="form-control" id="cert_use_date" name="cert_use_date">
        </div>
         <!-- Purpose -->
        <div class="form-group">
            <label for="purpose">
                <i class="fas fa-clipboard me-1"></i>
                Purpose
            </label>
            <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Please specify the purpose of your request..." required></textarea>
        </div>
        <!-- Pickup Date -->
        <div class="form-group">
            <label for="pickup_date">
                <i class="fas fa-calendar-check me-1"></i>
                Preferred Pickup Date
            </label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>



        <button type="submit" class="btn btn-primary btn-submit">
            <i class="fas fa-paper-plane me-2"></i>
            Submit Application
        </button>
    </form>
</div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- Script to trigger BHW modal --}}
<script>
    $(document).ready(function() {
        // When the "Apply Now" button for BHW service is clicked
        $('button[data-target="#bhwServiceModal"]').on('click', function() {
            // Show the modal
            $('#bhwServiceModal').modal('show');
        });
    });
</script>
<script>
    document.getElementById('service_type').addEventListener('change', function () {
        const businessFields = document.getElementById('business_fields');

        if (this.value === "Barangay Business Permit") {
            businessFields.style.display = "block";
        } else {
            businessFields.style.display = "none";
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceType = document.getElementById('service_type');

        const addressField = document.getElementById('address').closest('.form-group');
        const dateOfBirthField = document.getElementById('dateofbirth').closest('.form-group');
        const placeOfBirthField = document.getElementById('placeofbirth').closest('.form-group');
        const civilStatusField = document.getElementById('civil_status').closest('.form-group');
        const genderField = document.getElementById('gender').closest('.form-group');
        const purposeField = document.getElementById('purpose').closest('.form-group');

        const residencyStartField = document.getElementById('residency_start_field');
        const certUseField = document.getElementById('cert_use_field');

        function toggleFields() {
            const value = serviceType.value;

            if (value === 'Barangay Business Permit') {
                // Business Permit: show address, hide DOB, place, civil, gender, purpose, residency fields
                addressField.style.display = 'block';
                dateOfBirthField.style.display = 'none';
                placeOfBirthField.style.display = 'none';
                civilStatusField.style.display = 'none';
                genderField.style.display = 'none';
                purposeField.style.display = 'block';
                residencyStartField.style.display = 'none';
                certUseField.style.display = 'none';
            } else if (value === 'Barangay Residency') {
                // Residency: show residency fields, hide address, DOB, place, civil, gender, purpose
                addressField.style.display = 'none';
                dateOfBirthField.style.display = 'none';
                placeOfBirthField.style.display = 'none';
                civilStatusField.style.display = 'none';
                genderField.style.display = 'none';
                purposeField.style.display = 'block';
                residencyStartField.style.display = 'block';
                certUseField.style.display = 'block';
            } else {
                // Other services: show all
                addressField.style.display = 'block';
                dateOfBirthField.style.display = 'block';
                placeOfBirthField.style.display = 'block';
                civilStatusField.style.display = 'block';
                genderField.style.display = 'block';
                purposeField.style.display = 'block';
                residencyStartField.style.display = 'none';
                certUseField.style.display = 'none';
            }
        }

        serviceType.addEventListener('change', toggleFields);
        toggleFields(); // Set correct fields on page load
    });
</script>

<script>
    // Set minimum date for pickup date to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        const pickupDateInput = document.getElementById('pickup_date');
        if (pickupDateInput) {
            pickupDateInput.min = tomorrow.toISOString().split('T')[0];
        }
    });

    // Form validation feedback
    $('.modal form').on('submit', function(e) {
        const form = this;
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
</script>

@endsection
