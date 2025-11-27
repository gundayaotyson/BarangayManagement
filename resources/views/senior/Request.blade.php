@extends('senior.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --success-color: #2ecc71;
        --dark-color: #2c3e50;
        --light-color: #ecf0f1;
        --text-color: #333;
        --border-color: #ddd;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px var(--shadow-color);
    }

    body {
        background-color: var(--light-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
    }

    .container {
        max-width: 1400px;
        padding: 20px;
    }

    .page-header {
        background:  var(--dark-color);
        color: white;
        padding: 25px 30px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        box-shadow: var(--box-shadow);
    }

    .page-header h1 {
        margin: 0;
        font-weight: 600;
        font-size: 2.2rem;
    }

    .page-header p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px var(--shadow-color);
    }

    .card-header {
        background: linear-gradient(to right, var(--light-color), #e9ecef);
        border-bottom: 1px solid var(--border-color);
        padding: 18px 25px;
        font-weight: 600;
        font-size: 1.3rem;
        color: var(--dark-color);
    }

    .table-container {
        overflow-x: auto;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }

    table {
        margin: 0;
        min-width: 1000px;
    }
     .table thead th {
        background: var(--dark-color);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 1rem 0.75rem;
        text-align: left;
        white-space: nowrap;
    }

    thead {
        background-color: var(--dark-color);
        color: white;
    }

    thead th {
        padding: 15px 12px;
        font-weight: 500;
        border: none;
    }

    tbody tr {
        transition: var(--transition);
    }

    tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        /* font-size: 0.9rem; */
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: rgba(243, 156, 18, 0.15);
        color: var(--warning-color);
        border: 1px solid rgba(243, 156, 18, 0.3);
    }

    .status-processing {
        background-color: rgba(52, 152, 219, 0.15);
        color: var(--primary-color);
        border: 1px solid rgba(52, 152, 219, 0.3);
    }

    .status-accept {
        background-color: rgba(46, 204, 113, 0.15);
        color: var(--success-color);
        border: 1px solid rgba(46, 204, 113, 0.3);
    }

    .status-rejected {
        background-color: rgba(231, 76, 60, 0.15);
        color: var(--danger-color);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }

    .btn-edit {
        background-color: var(--primary-color);
        border: none;
        /* border-radius: var(--border-radius); */
        padding: 6px 9px;
        color: white;
        transition: var(--transition);
    }

    .btn-edit:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: var(--danger-color);
        border: none;
        /* border-radius: var(--border-radius); */
        padding: 6px 9px;
        color: white;
        transition: var(--transition);
    }

    .btn-delete:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }

   .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: nowrap;
        }

        .action-buttons .btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

    .alert {
        border: none;
        border-radius: var(--border-radius);
        padding: 15px 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 5px var(--shadow-color);
    }

    .alert-success {
        background-color: rgba(46, 204, 113, 0.15);
        color: #155724;
        border-left: 4px solid var(--success-color);
    }

    .alert-danger {
        background-color: rgba(231, 76, 60, 0.15);
        color: #721c24;
        border-left: 4px solid var(--danger-color);
    }

    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(to right, var(--primary-color), var(--dark-color));
        color: white;
        border-bottom: none;
        padding: 20px 25px;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .modal-title {
        font-weight: 600;
    }

    .btn-close {
        filter: invert(1);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 18px 25px;
    }

    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    .stats-card {
        text-align: center;
        padding: 20px;
        border-radius: var(--border-radius);
        margin-bottom: 20px;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
    }

    .stats-card:hover {
        transform: translateY(-3px);
    }

    .stats-card .number {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stats-card .label {
        font-size: 0.9rem;
        color: var(--dark-color);
        font-weight: 500;
    }

    .stats-pending {
        background-color: rgba(243, 156, 18, 0.1);
        border-left: 4px solid var(--warning-color);
    }

    .stats-processing {
        background-color: rgba(52, 152, 219, 0.1);
        border-left: 4px solid var(--primary-color);
    }

    .stats-accepted {
        background-color: rgba(46, 204, 113, 0.1);
        border-left: 4px solid var(--success-color);
    }

    .stats-rejected {
        background-color: rgba(231, 76, 60, 0.1);
        border-left: 4px solid var(--danger-color);
    }

    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
        border-color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .card-header {
            padding: 15px 20px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-hand-holding-heart me-2"></i>Senior Service Requests</h1>
        <p>Manage and track service requests for senior citizens</p>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="stats-card stats-pending">
                <div class="number">{{ $statusCounts['pending'] }}</div>
                <div class="label">Pending Requests</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stats-card stats-processing">
                <div class="number">{{ $statusCounts['processing'] }}</div>
                <div class="label">Processing</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stats-card stats-accepted">
                <div class="number">{{ $statusCounts['accept'] }}</div>
                <div class="label">Accepted</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stats-card stats-rejected">
                <div class="number">{{ $statusCounts['rejected'] }}</div>
                <div class="label">Rejected</div>
            </div>
        </div>
    </div>

    {{-- Success/Error messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    {{-- Table of senior requests --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Request Details</h5>
            <!-- <button class="btn btn-sm btn-outline-primary">
                <i class="fas fa-download me-1"></i> Export
            </button> -->
        </div>
        <div class="table-container">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>Full Name</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>OSCA ID</th>
                        <th>FCAP ID</th>
                        <th>Status</th>
                        <th>Request Date</th>
                        <th>Accept Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr id="request-row-{{ $req->id }}">
                            <td>{{ $req->first_name }} {{ $req->middle_name }} {{ $req->last_name }}</td>
                            <td>{{ $req->age }}</td>
                            <td>{{ $req->dob ? \Carbon\Carbon::parse($req->dob)->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $req->gender }}</td>
                            <td>{{ $req->oscaId }}</td>
                            <td>{{ $req->fcapId }}</td>
                            <td>
                                <span class="status-badge status-{{ $req->status }}">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </td>
                            <td>{{ $req->request_date->format('Y-m-d') }}</td>
                            <td class="accept-date-cell">{{ $req->accept_date ? $req->accept_date->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-edit edit-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#statusModal"
                                            data-id="{{ $req->id }}"
                                            data-status="{{ $req->status }}"
                                            data-update-url="{{ route('senior.req.updateStatus', $req->id) }}">
                                        <i class="fas fa-edit me-1"></i>
                                    </button>
                                    <form action="{{ route('senior.req.destroy', $req->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fas fa-trash me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>No requests found</h4>
                                    <p>There are no service requests at the moment.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">
                    <i class="fas fa-edit me-2"></i>Update Request Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusUpdateForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="requestId" name="id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="accept">Accept</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                    <button type="submit" class="btn btn-primary "data-bs-dismiss="modal">
                        <i class="fas fa-save me-1"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusModal = document.getElementById('statusModal');
        const statusUpdateForm = document.getElementById('statusUpdateForm');

        statusModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const requestId = button.getAttribute('data-id');
            const currentStatus = button.getAttribute('data-status');
            const updateUrl = button.getAttribute('data-update-url');

            statusModal.querySelector('#requestId').value = requestId;
            statusModal.querySelector('#status').value = currentStatus;
            statusUpdateForm.action = updateUrl;
        });

        statusUpdateForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = this.action;

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const requestId = formData.get('id');
                    const row = document.getElementById('request-row-' + requestId);

                    // Update status text and badge
                    const statusCell = row.querySelector('.status-cell');
                    const statusBadge = row.querySelector('.status-badge');

                    if (statusCell) statusCell.textContent =
                        data.request.status.charAt(0).toUpperCase() + data.request.status.slice(1);

                    if (statusBadge) {
                        statusBadge.textContent =
                            data.request.status.charAt(0).toUpperCase() + data.request.status.slice(1);
                        statusBadge.className = 'status-badge status-' + data.request.status;
                    }

                    // Update accept date only if accepted
                    if (data.request.accept_date) {
                        row.querySelector('.accept-date-cell').textContent =
                            new Date(data.request.accept_date).toISOString().split('T')[0];
                    } else {
                        row.querySelector('.accept-date-cell').textContent = "N/A";
                    }

                    // Close modal
                    bootstrap.Modal.getInstance(statusModal).hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update status.',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong.',
                footer: 'Please try again later.'
                });
            });
        });

        // Delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This request will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
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
