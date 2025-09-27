@extends('resident.resident-layout')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 2rem 2rem;
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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
        background: linear-gradient(90deg, #667eea, #764ba2);
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
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 24px;
    }

    .btn-apply {
        background: linear-gradient(135deg, #667eea, #764ba2);
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
        background: linear-gradient(135deg, #5a6fd8, #6a42a0);
    }

    .requests-section {
        background: #f8f9fa;
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 3rem;
    }

    .requests-title {
        color: #2c3e50;
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
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 3px;
    }

    .table-container {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        border-color: #e9ecef;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
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
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a42a0);
        transform: translateY(-1px);
    }

    .close {
        color: white;
        opacity: 0.8;
        font-size: 1.5rem;
    }

    .close:hover {
        color: white;
        opacity: 1;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 0;
        }

        .service-card .card-body {
            padding: 1.5rem;
        }

        .requests-section {
            padding: 1rem;
        }

        .table-responsive {
            border-radius: 1rem;
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
    <div class="row mb-5">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card service-card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="card-title font-weight-bold mb-3">SK Service</h5>
                    <p class="card-text text-muted mb-4">Apply for Sangguniang Kabataan services and youth programs</p>
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
                    <p class="card-text text-muted mb-4">Request official barangay certificates and clearances</p>
                    <button type="button" class="btn btn-primary btn-apply" data-toggle="modal" data-target="#legalDocumentModal">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="requests-section">
        <h3 class="requests-title">My SK Service Requests</h3>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>School</th>
                            <th>Year</th>
                            <th>Service Type</th>
                            <th>Status</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skServices as $service)
                            <tr>
                                <td class="font-weight-medium">{{ $service->firstname }} {{ $service->lastname }}</td>
                                <td>{{ $service->school }}</td>
                                <td>{{ $service->school_year }}</td>
                                <td>{{ $service->type_of_service }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($service->status) }}">
                                        {{ $service->status }}
                                    </span>
                                </td>
                                <td>{{ $service->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SK Service Modal -->
<div class="modal fade" id="skServiceModal" tabindex="-1" role="dialog" aria-labelledby="skServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skServiceModalLabel">
                    <i class="fas fa-graduation-cap me-2"></i>
                    SK Service Application
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sk-services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">
                                    <i class="fas fa-user me-1"></i>
                                    First Name
                                </label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_year">
                                    <i class="fas fa-calendar me-1"></i>
                                    School Year
                                </label>
                                <input type="text" class="form-control" id="school_year" name="school_year" placeholder="e.g., 2024-2025" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type_of_service">
                                    <i class="fas fa-cogs me-1"></i>
                                    Type of Service
                                </label>
                                <input type="text" class="form-control" id="type_of_service" name="type_of_service" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="attachment">
                            <i class="fas fa-paperclip me-1"></i>
                            Attachment (Optional)
                        </label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment">
                        <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('legal-documents.store-clearance') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="service_type">
                            <i class="fas fa-list me-1"></i>
                            Type of Service
                        </label>
                        <select class="form-control" id="service_type" name="service_type" required>
                            <option value="">Select a service type</option>
                            <option value="Barangay Clearance">Barangay Clearance</option>
                            <option value="Certificate of Indigency">Certificate of Indigency</option>
                            <option value="Barangay Certification">Barangay Certification</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fullname">
                            <i class="fas fa-user me-1"></i>
                            Full Name
                        </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            Address
                        </label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dateofbirth">
                                    <i class="fas fa-birthday-cake me-1"></i>
                                    Date of Birth
                                </label>
                                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="placeofbirth">Place of Birth</label>
                                <input type="text" class="form-control" id="placeofbirth" name="placeofbirth" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="civil_status">
                                    <i class="fas fa-heart me-1"></i>
                                    Civil Status
                                </label>
                                <select class="form-control" id="civil_status" name="civil_status" required>
                                    <option value="">Select status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">
                                    <i class="fas fa-venus-mars me-1"></i>
                                    Gender
                                </label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="purpose">
                            <i class="fas fa-clipboard me-1"></i>
                            Purpose
                        </label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Please specify the purpose of your request..." required></textarea>
                    </div>

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

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
