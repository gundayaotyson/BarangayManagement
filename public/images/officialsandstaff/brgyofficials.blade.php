@extends('admin.dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --text-color: #2c3e50;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #ecf0f1;
            color: var(--text-color);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
            padding: 1.25rem 1.5rem;
        }

        .card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Card Header */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: var(--light-color);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            color: white;
            box-shadow: var(--box-shadow);
            margin-bottom: 10px;
            margin-top: -20px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 30px;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Buttons */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #219653;
            border-color: #219653;
            transform: translateY(-2px);
        }

        /* Table Styling */
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            padding: 14px;
            vertical-align: middle;
            text-align: center;
            border-bottom: none;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        /* Badge Styling */
        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bg-success {
            background-color: var(--success-color) !important;
        }

        .bg-danger {
            background-color: var(--danger-color) !important;
        }

        /* Action Buttons */
        .action-column {
            display: flow-root;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Alert Styling */
        .alert {
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            margin-top: -40px;
        }

        /* Modal Styling */
        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 1.25rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: invert(1);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-control,
        .form-select {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-column {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-sm {
                width: 100%;
                justify-content: center;
            }
        }

        /* View Resident Modal Styles */
        #viewResidentModal .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        #viewResidentModal .modal-header {
            background-color: #2c3e50;
            color: white;
            border-bottom: none;
            padding: 1.5rem;
            border-radius: 10px 10px 0 0;
        }

        #viewResidentModal .modal-title {
            font-weight: 600;
            font-size: 1.4rem;
        }

        #viewResidentModal .modal-title i {
            margin-right: 10px;
        }

        #viewResidentModal .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        #viewResidentModal .btn-close:hover {
            opacity: 1;
        }

        #viewResidentModal .modal-body {
            padding: 2rem;
        }

        /* Resident Header Card */
        .resident-info-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #3498db;
        }

        .resident-name {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .resident-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        .resident-meta-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #555;
        }

        .resident-meta-item i {
            margin-right: 5px;
            color: #3498db;
            width: 16px;
            text-align: center;
        }

        .resident-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #e0e0e0;
            margin-left: auto;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .resident-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Section Titles */
        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
            font-size: 1.1rem;
        }

        .section-title i {
            margin-right: 8px;
            color: #3498db;
        }

        /* Info Groups */
        .info-group {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.85rem;
            color: #7f8c8d;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .info-value {
            font-size: 1rem;
            color: #34495e;
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 3px solid #3498db;
        }

        /* Modal Footer */
        #viewResidentModal .modal-footer {
            border-top: none;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        #viewResidentModal .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
        }

        #viewResidentModal .btn-secondary {
            background-color: #95a5a6;
            border-color: #95a5a6;
        }

        #viewResidentModal .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
            color: white;
        }

        #viewResidentModal .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            #viewResidentModal .modal-dialog {
                margin: 0.5rem;
            }

            #viewResidentModal .modal-body {
                padding: 1rem;
            }

            .resident-info-card {
                padding: 1rem;
            }

            .resident-name {
                font-size: 1.3rem;
            }

            .resident-meta {
                gap: 0.5rem;
            }

            .resident-photo {
                width: 80px;
                height: 80px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #viewResidentModal .modal-content {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-header">
            <h2 class="mb-0">Barangay Officials</h2>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addOfficialModal">
                <i class="fas fa-plus me-1"></i> Add New Official
            </button>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Position</th>
                                <th>Term Start</th>
                                <th>Term End</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($officials as $official)
                                <tr>
                                    <td class="fw-semibold">{{ $official->fullname }}</td>
                                    <td>{{ $official->position }}</td>
                                    <td>{{ date('M d, Y', strtotime($official->term_start)) }}</td>
                                    <td>{{ date('M d, Y', strtotime($official->term_end)) }}</td>
                                    <td>
                                        <span class="badge {{ $official->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $official->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($official->resident)
                                            <button class="btn btn-info btn-sm viewResidentBtn"
                                                data-id="{{ $official->resident_id }}" data-bs-toggle="modal"
                                                data-bs-target="#viewResidentModal">
                                                <i class="fas fa-eye"></i> View Details
                                            </button>
                                        @else
                                            <span class="badge bg-secondary">No Linked Resident</span>
                                        @endif
                                    </td>
                                    <td class="action-column">
                                        <button class="btn btn-primary btn-sm editOfficialBtn" data-bs-toggle="modal"
                                            data-bs-target="#editOfficialModal" data-id="{{ $official->id }}"
                                            data-fullname="{{ $official->fullname }}" data-position="{{ $official->position }}"
                                            data-term_start="{{ $official->term_start }}"
                                            data-term_end="{{ $official->term_end }}" data-status="{{ $official->status }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('barangayofficials.destroy', $official->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- View Details Modal -->
    <div class="modal fade" id="viewResidentModal" tabindex="-1" aria-labelledby="viewResidentModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewResidentModalLabel">
                        <i class="fas fa-user"></i> Resident Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                    <img id="view-resident-photo" src="{{ asset('images/default-profile.png') }}"
                                        alt="Resident Photo">
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

                </div>
            </div>
        </div>
    </div>

    <!-- Add Official Modal -->
    <div class="modal fade" id="addOfficialModal" tabindex="-1" aria-labelledby="addOfficialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOfficialModalLabel">Add Barangay Official</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addOfficialForm" action="{{ route('barangayofficials.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select name="position" id="position" class="form-select" required>
                                <option value="">Select Position</option>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Kagawad">Barangay Kagawad</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Barangay Treasurer">Barangay Treasurer</option>
                                <option value="SK Chairman">SK Chairman</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="term_start" class="form-label">Term Start</label>
                                <input type="date" name="term_start" id="term_start" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="term_end" class="form-label">Term End</label>
                                <input type="date" name="term_end" id="term_end" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Official</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Official Modal -->
    <div class="modal fade" id="editOfficialModal" tabindex="-1" aria-labelledby="editOfficialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfficialModalLabel">Edit Barangay Official</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editOfficialForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="edit_fullname" class="form-control" list="residentsList"
                                required>
                            <datalist id="residentsList"></datalist>
                        </div>
                        <div class="mb-3">
                            <label for="edit_position" class="form-label">Position</label>
                            <select id="edit_position" name="position" class="form-select" required>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Kagawad">Barangay Kagawad</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Barangay Treasurer">Barangay Treasurer</option>
                                <option value="SK Chairman">SK Chairman</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_term_start" class="form-label">Term Start</label>
                                <input type="date" id="edit_term_start" name="term_start" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_term_end" class="form-label">Term End</label>
                                <input type="date" id="edit_term_end" name="term_end" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="edit_status" class="form-label">Status</label>
                            <select id="edit_status" name="status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Official</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalElement = document.getElementById('viewResidentModal');
            const viewModal = new bootstrap.Modal(modalElement);

            // When modal hides, clean up leftover backdrops (Fix 3)
            modalElement.addEventListener('hidden.bs.modal', function () {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
            });

            // Handle view button clicks
            document.querySelectorAll('.viewResidentBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const residentId = this.getAttribute('data-id');

                    fetch(`/resident-info/${residentId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Format full name
                            const fullName = `${data.Fname} ${data.mname ?? ''} ${data.lname}`.replace(/\s+/g, ' ');

                            // Set header information
                            document.getElementById('view-fullname-header').textContent = fullName;
                            document.getElementById('view-gender-meta').textContent = data.gender;
                            document.getElementById('view-age-meta').textContent = data.age;
                            document.getElementById('view-civil-status-meta').textContent = data.civil_status;
                            document.getElementById('view-address-meta').textContent = `Purok ${data.purok_no}, ${data.sitio || 'Not specified'}`;
                            document.getElementById('view-household-meta').textContent = data.household_no;

                            // Set photo if available
                            const photoElement = document.getElementById('view-resident-photo');
                            if (data.photo && data.photo !== '') {
                                if (data.photo.startsWith('http') || data.photo.startsWith('/')) {
                                    photoElement.src = data.photo;
                                } else {
                                    photoElement.src = `/storage/${data.photo}`;
                                }
                            } else {
                                photoElement.src = "{{ asset('images/default-profile.png') }}";
                            }

                            // Personal information
                            document.getElementById('view-fullname').textContent = fullName;
                            document.getElementById('view-gender').textContent = data.gender;
                            document.getElementById('view-birthday').textContent = data.birthday;
                            document.getElementById('view-age').textContent = data.age;
                            document.getElementById('view-birthplace').textContent = data.birthplace;
                            document.getElementById('view-civil-status').textContent = data.civil_status;
                            document.getElementById('view-citizenship').textContent = data.Citizenship;
                            document.getElementById('view-religion').textContent = data.religion || 'Not specified';

                            // Contact & address
                            document.getElementById('view-contact-number').textContent = data.contact_number || 'Not specified';
                            document.getElementById('view-occupation').textContent = data.occupation || 'Not specified';
                            document.getElementById('view-household-no').textContent = data.household_no;
                            document.getElementById('view-purok').textContent = data.purok_no;
                            document.getElementById('view-sitio').textContent = data.sitio || 'Not specified';

                            // Set edit button data-id (if present)
                            document.querySelector('#viewResidentModal .edit-from-view')?.setAttribute('data-id', residentId);

                            // Show modal
                            viewModal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching resident info:', error);
                            alert('Failed to load resident information. Please try again.');
                        });
                });
            });

            // Handle edit button click (if present)
            const editFromViewBtn = document.querySelector('.edit-from-view');
            if (editFromViewBtn) {
                editFromViewBtn.addEventListener('click', function () {
                    const residentId = this.getAttribute('data-id');
                    viewModal.hide();
                    document.querySelector(`.editResidentBtn[data-id="${residentId}"]`)?.click();
                });
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fullnameInput = document.getElementById('fullname');

            fullnameInput.addEventListener('input', function () {
                const query = this.value;

                if (query.length >= 2) {
                    fetch(`/autocomplete-residents?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            const datalist = document.getElementById('residentsList');
                            datalist.innerHTML = ''; // Clear previous options

                            data.forEach(resident => {
                                const option = document.createElement('option');
                                option.value = resident.fullname;
                                datalist.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Autocomplete error:', error));
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Success message from session
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    timer: 3000
                });
            @endif

            // Error message from session
            @if($errors->any())
                Swal.fire({
                    title: 'Error!',
                    html: `<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>`,
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            @endif

            // Add form submission with SweetAlert
            document.getElementById('addOfficialForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: 'Adding Official',
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        form.submit();
                    }
                });
            });

            // Edit form submission with SweetAlert
            document.getElementById('editOfficialForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: 'Updating Official',
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        form.submit();
                    }
                });
            });

            // Delete confirmation with SweetAlert
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Deleting...',
                                text: 'Please wait...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                    form.submit();
                                }
                            });
                        }
                    });
                });
            });

            // Edit button click handler
            document.querySelectorAll('.editOfficialBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    document.getElementById('editOfficialForm').action = `/barangayofficials/${id}`;
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_fullname').value = this.dataset.fullname;
                    document.getElementById('edit_position').value = this.dataset.position;
                    document.getElementById('edit_term_start').value = this.dataset.term_start;
                    document.getElementById('edit_term_end').value = this.dataset.term_end;
                    document.getElementById('edit_status').value = this.dataset.status;
                });
            });

            // Date validation
            const termStartInput = document.getElementById('term_start');
            const termEndInput = document.getElementById('term_end');
            const editTermStartInput = document.getElementById('edit_term_start');
            const editTermEndInput = document.getElementById('edit_term_end');

            if (termStartInput && termEndInput) {
                termStartInput.addEventListener('change', function () {
                    termEndInput.min = this.value;
                });
            }

            if (editTermStartInput && editTermEndInput) {
                editTermStartInput.addEventListener('change', function () {
                    editTermEndInput.min = this.value;
                });
            }
        });
    </script>
@endsection
