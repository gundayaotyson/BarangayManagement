@extends('admin.dashboard')

@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --info-color: #1abc9c;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    /* Card Styling */
    .card {
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    /* Card Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: white;
        border-radius: var(--border-radius);
        color: white;
        box-shadow: var(--box-shadow);
        margin-bottom: 10px;
        color: var(--primary-color);



    }

    .card-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
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
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        vertical-align: middle;
        text-align: center;
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

    /* Status Badges */
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        border-radius: 50px;
        text-transform: uppercase;
    }

    .status-active {
        background-color: var(--danger-color);
        color: white;
    }

    .status-settled {
        background-color: var(--success-color);
        color: white;
    }

    .status-scheduled {
        background-color: var(--warning-color);
        color: white;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Alert Styling */
    .alert {
        border-radius: var(--border-radius);
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
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
    }

    .modal-title {
        font-weight: 600;
    }

    /* Form Styling */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select, .form-textarea {
        border-radius: var(--border-radius);
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        transition: var(--transition);
    }

    .form-control:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-sm {
            width: 100%;
            justify-content: center;
        }

        .table thead {
            display: none;
        }

        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            width: 45%;
            padding-right: 1rem;
            font-weight: 600;
            text-align: left;
        }
    }
</style>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="header">
            <h2 class="mb-0">Barangay Complaints</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
                <i class="fas fa-plus me-1"></i> Add Complaint
            </button>
        </div>
<div class="card">
<div class="container py-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Complainant</th>
                            <th>Complaint Type</th>
                            <th>Respondent</th>
                            <th>Victim</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                            <tr>
                                <td data-label="Complainant">{{ $complaint->fullname }}</td>
                                <td data-label="Complaint Type">{{ Str::limit($complaint->complaint, 20) }}</td>
                                <td data-label="Respondent">{{ $complaint->respondent }}</td>
                                <td data-label="Victim">{{ $complaint->victim }}</td>
                                <td data-label="Location">{{ Str::limit($complaint->location, 15) }}</td>
                                <td data-label="Date">{{ date('M d, Y', strtotime($complaint->date)) }}</td>
                                <td data-label="Status">
                                    <span class="status-badge
                                        @if($complaint->status == 'Active Case') status-active
                                        @elseif($complaint->status == 'Settled Case') status-settled
                                        @else status-scheduled @endif">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td data-label="Actions">
                                    <div class="action-buttons">
                                        <!-- View Details Button -->
                                        <button class="btn btn-info btn-sm viewComplaintBtn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewComplaintModal"
                                            data-complaint="{{ $complaint }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-sm editComplaintBtn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editComplaintModal"
                                            data-id="{{ $complaint->id }}"
                                            data-fullname="{{ $complaint->fullname }}"
                                            data-complaint="{{ $complaint->complaint }}"
                                            data-respondent="{{ $complaint->respondent }}"
                                            data-victim="{{ $complaint->victim }}"
                                            data-location="{{ $complaint->location }}"
                                            data-details="{{ $complaint->details }}"
                                            data-date="{{ $complaint->date }}"
                                            data-status="{{ $complaint->status }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('brgycomplaint.destroy', $complaint->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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

<!-- Add Complaint Modal -->
<div class="modal fade" id="addComplaintModal" tabindex="-1" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComplaintModalLabel">Register New Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brgycomplaint.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Complainant Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date of Complaint</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="respondent" class="form-label">Respondent Name</label>
                            <input type="text" name="respondent" id="respondent" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="victim" class="form-label">Victim Name (if different)</label>
                            <input type="text" name="victim" id="victim" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="complaint" class="form-label">Complaint Type</label>
                        <input type="text" name="complaint" id="complaint" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="location" class="form-label">Incident Location</label>
                            <input type="text" name="location" id="location" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Case Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active Case">Active</option>
                                <option value="Scheduled Case">Scheduled</option>
                                <option value="Settled Case">Settled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Case Details</label>
                        <textarea name="details" id="details" class="form-control form-textarea" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Register Complaint</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Complaint Modal -->
<div class="modal fade" id="viewComplaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complaint Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Complainant</h6>
                        <p id="view-fullname" class="fw-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Date Filed</h6>
                        <p id="view-date" class="fw-bold"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Respondent</h6>
                        <p id="view-respondent" class="fw-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Victim</h6>
                        <p id="view-victim" class="fw-bold"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <h6 class="text-muted">Complaint Type</h6>
                        <p id="view-complaint" class="fw-bold"></p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Status</h6>
                        <p><span id="view-status" class="status-badge"></span></p>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Incident Location</h6>
                    <p id="view-location" class="fw-bold"></p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Case Details</h6>
                    <p id="view-details" class="text-justify"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Complaint Modal -->
<div class="modal fade" id="editComplaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Complaint Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editComplaintForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-fullname" class="form-label">Complainant Full Name</label>
                            <input type="text" name="fullname" id="edit-fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-date" class="form-label">Date of Complaint</label>
                            <input type="date" name="date" id="edit-date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-respondent" class="form-label">Respondent Name</label>
                            <input type="text" name="respondent" id="edit-respondent" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-victim" class="form-label">Victim Name</label>
                            <input type="text" name="victim" id="edit-victim" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-complaint" class="form-label">Complaint Type</label>
                        <input type="text" name="complaint" id="edit-complaint" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="edit-location" class="form-label">Incident Location</label>
                            <input type="text" name="location" id="edit-location" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-status" class="form-label">Case Status</label>
                            <select name="status" id="edit-status" class="form-select" required>
                                <option value="Active Case">Active</option>
                                <option value="Scheduled Case">Scheduled</option>
                                <option value="Settled Case">Settled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-details" class="form-label">Case Details</label>
                        <textarea name="details" id="edit-details" class="form-control form-textarea" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View Complaint Modal
        document.querySelectorAll('.viewComplaintBtn').forEach(button => {
            button.addEventListener('click', function() {
                const complaint = JSON.parse(this.getAttribute('data-complaint'));

                document.getElementById('view-fullname').textContent = complaint.fullname;
                document.getElementById('view-date').textContent = new Date(complaint.date).toLocaleDateString('en-US', {
                    year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('view-respondent').textContent = complaint.respondent;
                document.getElementById('view-victim').textContent = complaint.victim;
                document.getElementById('view-complaint').textContent = complaint.complaint;
                document.getElementById('view-location').textContent = complaint.location;
                document.getElementById('view-details').textContent = complaint.details;

                const statusBadge = document.getElementById('view-status');
                statusBadge.textContent = complaint.status;
                statusBadge.className = 'status-badge ';

                if(complaint.status == 'Active Case') {
                    statusBadge.classList.add('status-active');
                } else if(complaint.status == 'Settled Case') {
                    statusBadge.classList.add('status-settled');
                } else {
                    statusBadge.classList.add('status-scheduled');
                }
            });
        });

        // Edit Complaint Modal
        document.querySelectorAll('.editComplaintBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = document.getElementById('editComplaintForm');

                form.setAttribute('action', `/brgycomplaint/${id}`);
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-fullname').value = this.getAttribute('data-fullname');
                document.getElementById('edit-complaint').value = this.getAttribute('data-complaint');
                document.getElementById('edit-respondent').value = this.getAttribute('data-respondent');
                document.getElementById('edit-victim').value = this.getAttribute('data-victim');
                document.getElementById('edit-location').value = this.getAttribute('data-location');
                document.getElementById('edit-details').value = this.getAttribute('data-details');
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-status').value = this.getAttribute('data-status');
            });
        });

        // Delete Confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
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
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
