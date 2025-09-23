Here's the complete code with fixes for both the image display in the edit view and the progress indicator animation, based on your original code:

```php
@extends('admin.dashboard')

@section('title', 'Residents')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />


<style>
    /* Modern Color Scheme */
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

    /* General Modal Styling */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
    }

    .modal-body {
        padding: 1.5rem;
    }

/* View Modal Specific */
.resident-info-card {
    background-color: var(--primary-light);
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
}

.resident-name {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.resident-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.resident-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    color: var(--text-muted);
}

.resident-photo {
    width: 120px;
    height: 120px;
    border-radius: 12px;
    overflow: hidden;
    border: 3px solid white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.resident-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.info-group {
    margin-bottom: 1.25rem;
}

.info-label {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}

.info-value {
    font-size: 1rem;
    font-weight: 500;
    color: var(--dark-color);
}

    /* Edit Modal Specific Styling */
    #editResidentModal .section-title {
        color: #495057;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.5rem;
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }

    #editResidentModal .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #495057;
        font-size: 0.875rem;
    }

    #editResidentModal .form-control,
    #editResidentModal .form-select {
        padding: 0.625rem 0.875rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        box-shadow: none;
    }

    #editResidentModal .form-control:focus,
    #editResidentModal .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    /* Responsive adjustments for modals */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 0.5rem;
        }

        .modal-content {
            border-radius: 0;
        }

        #viewResidentModal .row > div,
        #editResidentModal .row > div {
            margin-bottom: 1rem;
        }
    }

    /* Rest of your existing styles... */
    body {
        background-color: var(--light-color);
        color: var(--text-color);
    }

    /* Container Styling */
    .table-container {
        width: 100%;
        overflow-x: auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px var(--shadow-color);
        margin-bottom: 30px;
    }

    /* Header Styling */
    .residents-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        padding: 15px 20px;
        border-radius: 4px;
        box-shadow: 0 2px 8px var(--shadow-color);
        margin-bottom: 10px;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* Search & Buttons Container */
    .search-print-container {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Table Styling */
    .residents-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        background-color: white;
        box-shadow: 0 2px 8px var(--shadow-color);
    }

    /* Table Header */
    .residents-table thead {
        background: var(--dark-color);
        color: white;
        position: sticky;
        top: 0;
    }

    .residents-table th {
        padding: 14px 12px;
        text-align: center;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    /* Table Cells */
    .residents-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Table Rows */
    .residents-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .residents-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Search Box Styling */
    .search-box {
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 15px;
        width: 250px;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px var(--shadow-color);
    }

    .search-box:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    /* Entries Filter */
    .entries-container {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
    }

    .entries-container label {
        font-weight: 500;
        color: var(--text-color);
    }

    .entries-container input {
        width: 70px;
        padding: 8px;
        text-align: center;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        outline: none;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .entries-container input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    /* Buttons */
    .btn {
        padding: 10px 18px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-1px);
    }

    .btn-success {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-success:hover {
        background-color: #2980b9;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        transform: translateY(-1px);
    }

    .btn-warning {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-warning:hover {
        background-color: #d35400;
        transform: translateY(-1px);
    }

    /* Action Buttons */
    .action-buttons {
        display: inline-flex;
        gap: 8px;
    }

    .action-buttons .btn {
        padding: 6px 12px;
        font-size: 14px;
    }

    /* Pagination */
    .datatable-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding: 15px 0;
    }

    .datatable-info {
        font-size: 14px;
        color: var(--text-color);
    }

    .pagination {
        display: flex;
        gap: 8px;
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        padding: 8px 14px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background-color: #f1f5f9;
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .page-item.disabled .page-link {
        color: #adb5bd;
        pointer-events: none;
    }

    /* Dropdown */
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 4px 12px var(--shadow-color);
        border: none;
        padding: 10px;
    }

    .dropdown-item {
        padding: 8px 16px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f1f5f9;
    }


    /* Form Progress */
.form-progress {
    margin-bottom: 2rem;
}

.progress {
    height: 8px !important;
    border-radius: 10px;
    background-color: #e9ecef;
    overflow: hidden;
}

.progress-bar {
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    transition: width 0.5s ease;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-top: 0.75rem;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 1;
}

.step-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.step-icon.active {
    background-color: var(--primary-color);
    color: white;
    box-shadow: 0 4px 10px rgba(67, 97, 238, 0.25);
    transform: scale(1.1);
}

.step-icon.completed {
    background-color: var(--success-color);
    color: white;
}

.step-label {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-weight: 500;
    transition: all 0.3s ease;
}

.step-label.active {
    color: var(--primary-color);
    font-weight: 600;
}

/* Form Sections */
.form-section {
    display: none;
    animation: fadeIn 0.4s ease;
}

.form-section.active {
    display: block;
}
/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Image Preview */
.image-preview {
    width: 150px;
    height: 150px;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 0.5rem;
    border: 2px solid var(--border-color);
    position: relative;
}

.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    color: var(--text-muted);
    font-size: 0.9rem;
}

/* Custom File Input */
.custom-file-upload {
    display: inline-block;
    padding: 0.625rem 1.25rem;
    cursor: pointer;
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-top: 0.5rem;
}

.custom-file-upload:hover {
    background-color: var(--primary-color);
    color: white;
}

.custom-file-upload i {
    margin-right: 8px;
}
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .residents-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-print-container {
            width: 100%;
            justify-content: space-between;
        }

        .search-box {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .residents-table {
            font-size: 14px;
        }

        .residents-table th,
        .residents-table td {
            padding: 10px 8px;
        }

        .btn {
            padding: 8px 14px;
            font-size: 14px;
        }

        .datatable-bottom {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }

    @media (max-width: 576px) {
        .table-container {
            padding: 15px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .entries-container {
            flex-wrap: wrap;
        }

        .modal-dialog {
            margin: 10px;
        }
    }

    /* Delete modal styling */
    #deleteModal .modal-header {
        background-color: #dc3545;
    }

    /* Smooth row removal */
    tr {
        transition: opacity 0.3s ease;
    }

    /* Toast styling */
    #deleteSuccessToast {
        min-width: 300px;
        border-radius: 8px;
    }

    /* Row removal animation */
    tr {
        transition: opacity 0.3s ease !important;
    }

    /* Modal header color */
    #deleteModal .modal-header {
        background-color: #dc3545;
        color: white;
    }
</style>

    <div class="residents-header">
        <h2 class="mb-0" style="font-size: 30px;">Residents List</h2>
        <div class="search-print-container">
            <!-- Column Selection Dropdown -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-columns me-1"></i> Columns
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="columnDropdown" id="columnSelection">
                    @php
                        $columns = [
                            'Full Name','Gender', 'Birthday','Birthplace', 'Age', 'Civil Status', 'Citizenship','Religion',
                            'image','Contact No', 'Occupation','Household No', 'Purok No', 'Sitio','Actions'
                        ];
                    @endphp
                    @foreach ($columns as $index => $column)
                        <li>
                            <div class="form-check dropdown-item">
                                <input class="form-check-input column-toggle" type="checkbox"
                                       data-column="{{ $index + 1 }}" checked id="col-{{ $index }}">
                                <label class="form-check-label" for="col-{{ $index }}">
                                    {{ $column }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="entries-container">
                <label for="entries">Show</label>
                <input type="number" id="entries" min="1" value="10" oninput="filterResidents()" class="form-control">
                <span>entries</span>
            </div>

            <input type="search" class="search-box form-control" placeholder="Search residents..."
                   id="searchInput" onkeyup="searchResidents()">

                   <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#residentModal">
                        <i class="fas fa-plus me-1"></i> New Resident
                    </button>

            <button class="btn btn-primary" onclick="exportResidentsToCSV()">
                <i class="fas fa-file-export me-1"></i> Export CSV
            </button>
        </div>
    </div>
<div class="table-container">
    <div class="table-responsive">
        <table class="residents-table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="residentsTableBody">
            @foreach ($residents as $resident)
        <tr>
    <td>{{ $resident->lname }}, {{ $resident->Fname }} {{ $resident->mname ?? '' }}</td>
    <td>{{ $resident->gender }}</td>
    <td>{{ $resident->birthday }}</td>
    <td>{{ $resident->birthplace }}</td>
    <td>{{ $resident->age }}</td>
    <td>{{ $resident->civil_status }}</td>
    <td>{{ $resident->Citizenship }}</td>
    <td>{{ $resident->religion }}</td>
    <td>{{ $resident->image }}</td>
    <td>{{ $resident->contact_number }}</td>
    <td>{{ $resident->occupation }}</td>
    <td>{{ $resident->household_no }}</td>
    <td>{{ $resident->purok_no }}</td>
    <td>{{ $resident->sitio ?? 'N/A' }}</td>
    <td>
        <div class="action-buttons">
            <button class="btn btn-sm btn-primary view-resident"
                type="button"
                data-id="{{ $resident->id }}">
                <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-sm btn-warning edit-resident"
                type="button"
                data-id="{{ $resident->id }}">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger delete-item"
                type="button"
                data-id="{{ $resident->id }}"
                data-name="{{ $resident->lname }}, {{ $resident->Fname }}">
                <i class="fas fa-trash-alt"></i>


        </div>
    </td>
</tr>
@endforeach

            </tbody>
        </table>
    </div>

    <!-- Pagination and Info -->
    <div class="datatable-bottom">
        <div class="datatable-info">
            Showing {{ $residents->firstItem() }} to {{ $residents->lastItem() }} of {{ $residents->total() }} entries
        </div>

        <nav>
            <ul class="pagination">
                {{ $residents->links() }}
            </ul>
        </nav>
    </div>
</div>



<!-- View Resident Modal -->
<div class="modal fade" id="viewResidentModal" tabindex="-1" aria-labelledby="viewResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewResidentModalLabel">
                    <i class="fas fa-user"></i> Resident Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Resident Header Card -->
                <div class="resident-info-card">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="resident-name" id="view-fullname-header"></h4>
                            <div class="resident-meta">
                                <div class="resident-meta-item">
                                    <i class="fas fa-venus-mars"></i> <span id="view-gender-meta"></span>
                                </div>
                                <div class="resident-meta-item">
                                    <i class="fas fa-birthday-cake"></i> <span id="view-age-meta"></span> years old
                                </div>
                                <div class="resident-meta-item">
                                    <i class="fas fa-ring"></i> <span id="view-civil-status-meta"></span>
                                </div>
                            </div>
                            <div class="resident-meta">
                                <div class="resident-meta-item">
                                    <i class="fas fa-map-marker-alt"></i> <span id="view-address-meta"></span>
                                </div>
                                <div class="resident-meta-item">
                                    <i class="fas fa-home"></i> Household #<span id="view-household-meta"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="resident-photo">
                                <img id="view-resident-photo" src="https://via.placeholder.com/150?text=No+Photo" alt="Resident Photo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 class="section-title">
                            <i class="fas fa-user-circle"></i> Personal Information
                        </h6>

                        <div class="info-group">
                            <div class="info-label">Full Name</div>
                            <div class="info-value" id="view-fullname"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Gender</div>
                            <div class="info-value" id="view-gender"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Birthdate</div>
                            <div class="info-value" id="view-birthday"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Age</div>
                            <div class="info-value" id="view-age"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Birthplace</div>
                            <div class="info-value" id="view-birthplace"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Civil Status</div>
                            <div class="info-value" id="view-civil-status"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Citizenship</div>
                            <div class="info-value" id="view-citizenship"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Religion</div>
                            <div class="info-value" id="view-religion"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="section-title">
                            <i class="fas fa-address-card"></i> Contact & Address Information
                        </h6>

                        <div class="info-group">
                            <div class="info-label">Contact Number</div>
                            <div class="info-value" id="view-contact-number"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Occupation</div>
                            <div class="info-value" id="view-occupation"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Household No.</div>
                            <div class="info-value" id="view-household-no"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Purok</div>
                            <div class="info-value" id="view-purok"></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Sitio</div>
                            <div class="info-value" id="view-sitio"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning edit-from-view" data-id="">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Resident Modal -->
<div class="modal fade" id="editResidentModal" tabindex="-1" aria-labelledby="editResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editResidentModalLabel">
                    <i class="fas fa-user-edit"></i> Edit Resident
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editResidentForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="resident-photo">
                                    <img id="edit-resident-photo" src="https://via.placeholder.com/150?text=No+Photo" alt="Resident Photo">
                                </div>
                                <div>
                                    <h5 class="mb-1" id="edit-resident-name"></h5>
                                    <div class="text-muted small" id="edit-resident-id">Resident ID: </div>
                                    <label for="edit-image" class="custom-file-upload mt-2">
                                        <i class="fas fa-camera"></i> Change Photo
                                    </label>
                                    <input type="file" id="edit-image" name="image" class="d-none" accept="image/*">
                                    <div class="mt-2 text-muted small">Recommended size: 300x300px, Max: 2MB</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-4" id="editTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="true">
                                <i class="fas fa-user-circle me-2"></i>Personal
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-info" type="button" role="tab" aria-controls="contact-info" aria-selected="false">
                                <i class="fas fa-address-card me-2"></i>Contact
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address-info" type="button" role="tab" aria-controls="address-info" aria-selected="false">
                                <i class="fas fa-map-marker-alt me-2"></i>Address
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="editTabContent">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="edit-fname" class="form-label">First Name <span class="required-field">*</span></label>
                                    <input type="text" id="edit-fname" name="Fname" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="edit-mname" class="form-label">Middle Name</label>
                                    <input type="text" id="edit-mname" name="mname" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="edit-lname" class="form-label">Last Name <span class="required-field">*</span></label>
                                    <input type="text" id="edit-lname" name="lname" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-gender" class="form-label">Gender <span class="required-field">*</span></label>
                                    <select id="edit-gender" name="gender" class="form-select" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-birthday" class="form-label">Birthdate <span class="required-field">*</span></label>
                                    <input type="date" id="edit-birthday" name="birthday" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-age" class="form-label">Age</label>
                                    <input type="number" id="edit-age" name="age" class="form-control" readonly>
                                    <small class="text-muted">Automatically calculated from birthdate</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-civil-status" class="form-label">Civil Status</label>
                                    <select id="edit-civil-status" name="civil_status" class="form-select">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-religion" class="form-label">Religion</label>
                                    <input type="text" id="edit-religion" name="religion" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-citizenship" class="form-label">Citizenship</label>
                                    <input type="text" id="edit-citizenship" name="Citizenship" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label for="edit-birthplace" class="form-label">Birthplace</label>
                                    <input type="text" id="edit-birthplace" name="birthplace" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade" id="contact-info" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="edit-contact-number" class="form-label">Contact Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+63</span>
                                        <input type="text" id="edit-contact-number" name="contact_number" class="form-control" placeholder="9XX XXX XXXX">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-occupation" class="form-label">Occupation</label>
                                    <input type="text" id="edit-occupation" name="occupation" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Tab -->
                        <div class="tab-pane fade" id="address-info" role="tabpanel" aria-labelledby="address-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="edit-household-no" class="form-label">Household No.</label>
                                    <input type="text" id="edit-household-no" name="household_no" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-purok-no" class="form-label">Purok <span class="required-field">*</span></label>
                                    <select id="edit-purok-no" name="purok_no" class="form-select" required>
                                        <option value="Purok 1">Purok 1</option>
                                        <option value="Purok 2">Purok 2</option>
                                        <option value="Purok 3">Purok 3</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit-sitio" class="form-label">Sitio</label>
                                    <select id="edit-sitio" name="sitio" class="form-select">
                                        <option value="">Select Sitio</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="edit-is-household-head" name="is_household_head">
                                        <label class="form-check-label" for="edit-is-household-head">
                                            This resident is the head of the household
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Success Toast Notification -->
<div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1100; display: none;">
  <div id="deleteSuccessToast" class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <i class="fas fa-check-circle me-2"></i>
        <span id="successMessage">Resident deleted successfully!</span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="deleteModalText">Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for New Resident -->
<div class="modal fade" id="residentModal" tabindex="-1" aria-labelledby="residentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="residentModalLabel">
                    <i class="fas fa-user-plus"></i> Register New Resident
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('manageresidents.store') }}" method="POST" id="residentForm" enctype="multipart/form-data">
                    @csrf

                    <!-- Progress Indicator -->
                    <div class="form-progress mb-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress-steps mt-3">
                            <div class="progress-step">
                                <div class="step-icon active">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="step-label active">Personal Info</span>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <span class="step-label">Contact Info</span>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <span class="step-label">Address</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Sections -->
                    <div class="form-sections">
                        <!-- Section 1: Personal Information -->
                        <div class="form-section active">
                            <h6 class="section-title">
                                <i class="fas fa-user-circle"></i> Personal Information
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="fname" class="form-label">First Name <span class="required-field">*</span></label>
                                    <input type="text" id="fname" name="Fname" class="form-control" required placeholder="Enter first name">
                                    <div class="invalid-feedback">Please provide a first name</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="mname" class="form-label">Middle Name</label>
                                    <input type="text" id="mname" name="mname" class="form-control" placeholder="Enter middle name">
                                </div>

                                <div class="col-md-4">
                                    <label for="lname" class="form-label">Last Name <span class="required-field">*</span></label>
                                    <input type="text" id="lname" name="lname" class="form-control" required placeholder="Enter last name">
                                    <div class="invalid-feedback">Please provide a last name</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender <span class="required-field">*</span></label>
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a gender</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="birthday" class="form-label">Birthdate <span class="required-field">*</span></label>
                                    <input type="date" id="birthday" name="birthday" class="form-control" required>
                                    <div class="invalid-feedback">Please provide a valid birthdate</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" id="age" name="age" class="form-control" readonly>
                                    <small class="text-muted">Automatically calculated from birthdate</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                    <select id="civil_status" name="civil_status" class="form-select">
                                        <option value="">Select Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" name="religion" class="form-control" placeholder="Enter religion">
                                </div>

                                <div class="col-md-6">
                                    <label for="citizenship" class="form-label">Citizenship</label>
                                    <input type="text" id="citizenship" name="Citizenship" class="form-control" value="Filipino" placeholder="Enter citizenship">
                                </div>

                                <div class="col-md-12">
                                    <label for="birthplace" class="form-label">Birthplace</label>
                                    <input type="text" id="birthplace" name="birthplace" class="form-control" placeholder="Enter birthplace">
                                </div>

                                <div class="col-md-12">
                                    <label for="image" class="form-label">Resident Photo</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image-preview">
                                            <div class="image-preview-placeholder">
                                                <i class="fas fa-user fa-2x"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="image" class="custom-file-upload">
                                                <i class="fas fa-upload"></i> Choose Photo
                                            </label>
                                            <input type="file" name="image" id="image" class="form-control d-none" accept="image/*">
                                            <div class="mt-2 text-muted small">Recommended size: 300x300px, Max: 2MB</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Contact Information -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="fas fa-address-card"></i> Contact Information
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+63</span>
                                        <input type="text" id="contact_number" name="contact_number" class="form-control" placeholder="9XX XXX XXXX">
                                    </div>
                                    <div class="form-text">Format: 9XX XXX XXXX (without leading zero)</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" id="occupation" name="occupation" class="form-control" placeholder="Enter occupation">
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Address Information -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="fas fa-map-marker-alt"></i> Address Information
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="household_no" class="form-label">Household No.</label>
                                    <input type="text" id="household_no" name="household_no" class="form-control" placeholder="Enter household number">
                                </div>

                                <div class="col-md-6">
                                    <label for="purok_no" class="form-label">Purok <span class="required-field">*</span></label>
                                    <select id="purok_no" name="purok_no" class="form-select" required>
                                        <option value="">Select Purok</option>
                                        <option value="Purok 1">Purok 1</option>
                                        <option value="Purok 2">Purok 2</option>
                                        <option value="Purok 3">Purok 3</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a purok</div>
                                </div>

                                <div class="col-md-6" id="sitio_container">
                                    <label for="sitio" class="form-label">Sitio</label>
                                    <select id="sitio" name="sitio" class="form-select">
                                        <option value="">Select Sitio</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="is_household_head" name="is_household_head">
                                        <label class="form-check-label" for="is_household_head">
                                            This resident is the head of the household
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" id="prevBtn" style="display:none;">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="nextBtn">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                            <i class="fas fa-save"></i> Save Resident
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript Functions -->
<script>
    // Search function
    function searchResidents() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let tableRows = document.querySelectorAll("#residentsTableBody tr");

        tableRows.forEach(row => {
            let rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(input) ? "" : "none";
        });
    }

    // Export to CSV
    function exportResidentsToCSV() {
        const table = document.querySelector('.residents-table');
        let csv = [];

        // Get headers
        let headers = [];
        document.querySelectorAll('.residents-table thead th').forEach(header => {
            headers.push('"' + header.innerText.replace(/"/g, '""') + '"');
        });
        csv.push(headers.join(','));

        // Get rows
        document.querySelectorAll('.residents-table tbody tr').forEach(row => {
            if (row.style.display !== 'none') {
                let rowData = [];
                row.querySelectorAll('td').forEach(cell => {
                    rowData.push('"' + cell.innerText.replace(/"/g, '""') + '"');
                });
                csv.push(rowData.join(','));
            }
        });

        // Create and download CSV
        const csvContent = csv.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', 'residents_' + new Date().toISOString().slice(0, 10) + '.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Column visibility toggle
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll(".column-toggle");
        const savedColumns = JSON.parse(localStorage.getItem("hiddenColumns")) || [];

        // Apply saved settings
        checkboxes.forEach(checkbox => {
            const column = checkbox.getAttribute("data-column");
            if (savedColumns.includes(column)) {
                checkbox.checked = false;
                document.querySelectorAll(`th:nth-child(${column}), td:nth-child(${column})`)
                    .forEach(cell => cell.style.display = "none");
            }

            // Update on change
            checkbox.addEventListener("change", function () {
                let updatedHiddenColumns = JSON.parse(localStorage.getItem("hiddenColumns")) || [];
                const column = this.getAttribute("data-column");

                if (!this.checked) {
                    if (!updatedHiddenColumns.includes(column)) {
                        updatedHiddenColumns.push(column);
                    }
                } else {
                    updatedHiddenColumns = updatedHiddenColumns.filter(col => col !== column);
                }

                localStorage.setItem("hiddenColumns", JSON.stringify(updatedHiddenColumns));

                document.querySelectorAll(`th:nth-child(${column}), td:nth-child(${column})`)
                    .forEach(cell => cell.style.display = this.checked ? "" : "none");
            });
        });

        // Filter residents by entries
        window.filterResidents = function() {
            let limit = parseInt(document.getElementById("entries").value, 10) || 9999;
            document.querySelectorAll(".residents-table tbody tr").forEach((row, index) => {
                row.style.display = index < limit ? "" : "none";
            });
        }
    });
</script>
 <!-- Delete confirmation script (in your JS file or script tag) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize elements
    const deleteModal = new bootstrap.Modal('#deleteModal');
    const successToast = new bootstrap.Toast('#deleteSuccessToast');
    let currentResidentId = null;
    let currentRow = null;

    // Set up delete buttons
    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function() {
            currentResidentId = this.getAttribute('data-id');
            currentRow = this.closest('tr');
            const name = this.getAttribute('data-name') || 'this resident';

            document.getElementById('deleteModalText').textContent =
                `Are you sure you want to delete ${name}?`;
            deleteModal.show();
        });
    });

    // Confirm delete handler
    document.getElementById('confirmDelete').addEventListener('click', async function() {
        deleteModal.hide();

        try {
            const response = await fetch(`/residents/${currentResidentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to delete resident');
            }

            // Visual feedback
            currentRow.style.transition = 'opacity 0.3s ease';
            currentRow.style.opacity = '0';

            setTimeout(() => {
                currentRow.remove();

                // Show success toast
                document.getElementById('successMessage').textContent =
                    data.success || 'Resident deleted successfully!';
                successToast.show();

            }, 300);

        } catch (error) {
            console.error('Delete error:', error);
            alert('Error: ' + error.message);
        }
    });
});
</script>



<!-- JavaScript for View and Edit Modals -->
<script>
// View and Edit Modals - Using Event Delegation
document.addEventListener('click', function(e) {
    // View button click
    if (e.target.closest('.view-resident')) {
        const button = e.target.closest('.view-resident');
        const residentId = button.getAttribute('data-id');

        fetch(`/manageresidents/${residentId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Set edit button data-id
                document.querySelector('.edit-from-view').setAttribute('data-id', residentId);

                // Populate the view modal header
                document.getElementById('view-fullname-header').textContent = `${data.lname}, ${data.Fname} ${data.mname || ''}`;
                document.getElementById('view-gender-meta').textContent = data.gender;
                document.getElementById('view-age-meta').textContent = data.age;
                document.getElementById('view-civil-status-meta').textContent = data.civil_status || 'Not specified';
                document.getElementById('view-address-meta').textContent = `${data.purok_no}${data.sitio ? ', ' + data.sitio : ''}`;
                document.getElementById('view-household-meta').textContent = data.household_no || 'N/A';

                // Set resident photo
                if (data.image) {
                    document.getElementById('view-resident-photo').src = `{{ asset('storage/') }}/${data.image}`;
                } else {
                    document.getElementById('view-resident-photo').src = 'https://via.placeholder.com/150?text=No+Image';
                }

                // Populate the view modal details
                document.getElementById('view-fullname').textContent = `${data.lname}, ${data.Fname} ${data.mname || ''}`;
                document.getElementById('view-gender').textContent = data.gender;
                document.getElementById('view-birthday').textContent = data.birthday;
                document.getElementById('view-age').textContent = data.age;
                document.getElementById('view-birthplace').textContent = data.birthplace || 'Not provided';
                document.getElementById('view-civil-status').textContent = data.civil_status || 'Not specified';
                document.getElementById('view-citizenship').textContent = data.Citizenship;
                document.getElementById('view-religion').textContent = data.religion || 'Not provided';
                document.getElementById('view-contact-number').textContent = data.contact_number || 'N/A';
                document.getElementById('view-occupation').textContent = data.occupation || 'N/A';
                document.getElementById('view-household-no').textContent = data.household_no || 'N/A';
                document.getElementById('view-purok').textContent = data.purok_no;
                document.getElementById('view-sitio').textContent = data.sitio || 'N/A';

                // Initialize and show the modal
                const viewModal = new bootstrap.Modal(document.getElementById('viewResidentModal'));
                viewModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading resident data');
            });
    }

    // Edit button click
    if (e.target.closest('.edit-resident') || e.target.closest('.edit-from-view')) {
        const button = e.target.closest('.edit-resident') || e.target.closest('.edit-from-view');
        const residentId = button.getAttribute('data-id');

        fetch(`/manageresidents/${residentId}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Populate the edit form
                document.getElementById('edit-fname').value = data.Fname;
                document.getElementById('edit-mname').value = data.mname || '';
                document.getElementById('edit-lname').value = data.lname;
                document.getElementById('edit-gender').value = data.gender;
                document.getElementById('edit-birthday').value = data.birthday;
                document.getElementById('edit-age').value = data.age;
                document.getElementById('edit-birthplace').value = data.birthplace;
                document.getElementById('edit-civil-status').value = data.civil_status;
                  document.getElementById('edit-religion').value = data.religion;
                document.getElementById('edit-citizenship').value = data.Citizenship;
                document.getElementById('edit-contact-number').value = data.contact_number || '';
                document.getElementById('edit-occupation').value = data.occupation || '';
                document.getElementById('edit-household-no').value = data.household_no;
                document.getElementById('edit-purok-no').value = data.purok_no;
                document.getElementById('edit-sitio').value = data.sitio || '';

                // Set resident name and ID in the header
                document.getElementById('edit-resident-name').textContent = `${data.Fname} ${data.lname}`;
                document.getElementById('edit-resident-id').textContent = `Resident ID: ${residentId}`;

                // Set the resident photo
                if (data.image) {
                    document.getElementById('edit-resident-photo').src = `/storage/${data.image}`;
                } else {
                    document.getElementById('edit-resident-photo').src = 'https://via.placeholder.com/150?text=No+Photo';
                }

                // Set the form action
                document.getElementById('editResidentForm').action = `/manageresidents/${residentId}`;

                // Initialize and show the modal
                const editModal = new bootstrap.Modal(document.getElementById('editResidentModal'));
                editModal.show();

                // Update sitio options based on selected purok
                const purokSelect = document.getElementById('edit-purok-no');
                updateSitioOptions(purokSelect.value, 'edit-sitio');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading resident data for editing');
            });
    }
});

// Handle edit form submission
document.getElementById('editResidentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Close modal and refresh page
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editResidentModal'));
            editModal.hide();
            location.reload();
        } else {
            throw new Error(data.message || 'Update failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating resident: ' + error.message);
    });
});

// Auto-calculate age when birthdate changes
document.getElementById('edit-birthday').addEventListener('change', function() {
    const birthday = new Date(this.value);
    if (isNaN(birthday.getTime())) return;

    const today = new Date();
    let age = today.getFullYear() - birthday.getFullYear();
    const monthDiff = today.getMonth() - birthday.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
        age--;
    }

    document.getElementById('edit-age').value = age;
});

// Update sitio options when purok changes in edit form
document.getElementById('edit-purok-no').addEventListener('change', function() {
    updateSitioOptions(this.value, 'edit-sitio');
});
</script>


<script>
// Purok-Sitio Mapping
const purokSitioMap = {
    "Purok 1": ["Sitio Leksab"],
    "Purok 2": ["Sitio Taew"],
    "Purok 3": ["Pidlaoan"]
};

// Multi-step Form Navigation
let currentSection = 0;
const sections = document.querySelectorAll('.form-section');
const progressBar = document.querySelector('.progress-bar');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    // Show first section
    showSection(currentSection);

    // Purok-Sitio functionality
    document.getElementById('purok_no').addEventListener('change', function() {
        updateSitioOptions(this.value, 'sitio');
    });

    // Age calculation
    document.getElementById('birthday').addEventListener('change', calculateAge);

    // Image preview for new resident
    setupImagePreview('image', '.image-preview');

    // Image preview for edit resident
    setupImagePreview('edit-image', '#edit-resident-photo');
});

// Show Sitio options based on Purok selection
function updateSitioOptions(purokValue, sitioElementId) {
    const sitioSelect = document.getElementById(sitioElementId);
    const sitioContainer = sitioElementId === 'sitio' ? document.getElementById('sitio_container') : sitioSelect.closest('.col-md-6');

    sitioSelect.innerHTML = '<option value="">Select Sitio</option>';

    if (purokValue && purokSitioMap[purokValue]) {
        purokSitioMap[purokValue].forEach(sitio => {
            sitioSelect.innerHTML += `<option value="${sitio}">${sitio}</option>`;
        });
        sitioContainer.style.display = 'block';
    } else {
        sitioContainer.style.display = 'none';
    }
}

// Calculate age from birthdate
function calculateAge() {
    const birthday = new Date(this.value);
    if (isNaN(birthday.getTime())) return;

    const today = new Date();
    let age = today.getFullYear() - birthday.getFullYear();
    const monthDiff = today.getMonth() - birthday.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
        age--;
    }

    document.getElementById('age').value = age;
}

// Form Navigation
function showSection(n) {
    sections.forEach((section, index) => {
        section.classList.toggle('active', index === n);
    });

    // Update progress bar
    const progress = ((n + 1) / sections.length) * 100;
    progressBar.style.width = `${progress}%`;
    progressBar.setAttribute('aria-valuenow', progress);

    // Update navigation buttons
    prevBtn.style.display = n === 0 ? 'none' : 'inline-block';
    nextBtn.style.display = n === sections.length - 1 ? 'none' : 'inline-block';
    submitBtn.style.display = n === sections.length - 1 ? 'inline-block' : 'none';

    // Update step icons
    const stepIcons = document.querySelectorAll('.step-icon');
    const stepLabels = document.querySelectorAll('.step-label');

    stepIcons.forEach((icon, index) => {
        // Remove all classes first
        icon.classList.remove('active', 'completed');

        // Add appropriate class
        if (index < n) {
            icon.classList.add('completed');
        } else if (index === n) {
            icon.classList.add('active');
        }
    });

    // Update step labels
    stepLabels.forEach((label, index) => {
        label.classList.toggle('active', index === n);
    });
}

nextBtn.addEventListener('click', function() {
    // Validate current section before proceeding
    if (validateSection(currentSection)) {
        currentSection++;
        showSection(currentSection);
    }
});

prevBtn.addEventListener('click', function() {
    currentSection--;
    showSection(currentSection);
});

// Basic section validation
function validateSection(n) {
    let isValid = true;
    const currentSection = sections[n];
    const requiredFields = currentSection.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        if (!field.value) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Form submission
document.getElementById('residentForm').addEventListener('submit', function(e) {
    // Validate all sections before submission
    let allValid = true;

    sections.forEach((section, index) => {
        if (!validateSection(index)) {
            allValid = false;
            if (allValid) {
                currentSection = index;
                showSection(currentSection);
            }
        }
    });

    if (!allValid) {
        e.preventDefault();
    }
});
</script>
<script>
/**
 * Image handling functions for resident management system
 */

// Image preview for new resident
function setupImagePreview(inputId, previewContainerId) {
    const input = document.getElementById(inputId);
    const previewContainer = document.querySelector(previewContainerId);

    if (!input || !previewContainer) return;

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, GIF)');
            input.value = '';
            return;
        }

        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Image size should not exceed 2MB');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            // For the add form with placeholder div
            if (previewContainerId === '.image-preview') {
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Resident Photo" style="width:100%; height:100%; object-fit:cover;">`;
            }
            // For the edit form with img element
            else if (previewContainerId === '#edit-resident-photo') {
                document.getElementById('edit-resident-photo').src = e.target.result;
            }

            // Create a hidden input to track if image was changed
            const imageChanged = document.getElementById(`${inputId}-changed`) || document.createElement('input');
            imageChanged.type = 'hidden';
            imageChanged.id = `${inputId}-changed`;
            imageChanged.name = 'image_changed';
            imageChanged.value = '1';

            if (!document.getElementById(`${inputId}-changed`)) {
                input.parentNode.appendChild(imageChanged);
            }
        };
        reader.readAsDataURL(file);
    });
}

// Function to update resident photo in edit modal
function updateEditResidentPhoto(imageUrl) {
    const photoElement = document.getElementById('edit-resident-photo');
    if (photoElement) {
        if (imageUrl) {
            photoElement.src = imageUrl;
        } else {
            photoElement.src = 'https://via.placeholder.com/150?text=No+Photo';
        }
    }
}

// Function to update resident photo in view modal
function updateViewResidentPhoto(imageUrl) {
    const photoElement = document.getElementById('view-resident-photo');
    if (photoElement) {
        if (imageUrl) {
            photoElement.src = imageUrl;
        } else {
            photoElement.src = 'https://via.placeholder.com/150?text=No+Photo';
        }
    }
}
</script>


@endsection

```
