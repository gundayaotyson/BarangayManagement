@extends('senior.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #4361ee;
        --secondary: #2c3e50;
        --success: #4cc9f0;
        --danger: #f72585;
        --warning: #f8961e;
        --info: #4895ef;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
    }

    body {
        background-color: #f5f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-header {
        background:var(--secondary);
        color: white;
        padding: 1.5rem 0;
        border-radius: 15px 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px 12px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-pending {
        background-color: rgba(248, 150, 30, 0.15);
        color: var(--warning);
    }

    .status-processing {
        background-color: rgba(76, 201, 240, 0.15);
        color: var(--success);
    }

    .status-accept {
        background-color: rgba(46, 204, 113, 0.15);
        color: var(--success);
    }

    .status-rejected {
        background-color: rgba(247, 37, 133, 0.15);
        color: var(--danger);
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        border-color: var(--secondary);
    }

    .btn-danger {
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        padding-left: 2.5rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .filter-btn {
        border-radius: 8px;
        font-weight: 600;
    }

    .resident-info {
        display: flex;
        align-items: center;
    }

    .resident-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 12px;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: var(--gray);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-responsive {
        border-radius: 12px;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .modal-title {
        font-weight: 600;
    }

    .stats-card {
        text-align: center;
        padding: 1.5rem;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        font-size: 0.9rem;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stats-pending {
        color: var(--warning);
    }

    .stats-processing {
        color: var(--primary);
    }

    .stats-accepted {
        color: var(--success);
    }

    .stats-rejected {
        color: var(--danger);
    }

    .stats-total {
        color: var(--primary);
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

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.85rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
        }

        .stats-card {
            padding: 1rem;
        }

        .stats-number {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 mb-0"><i class="fas fa-hand-holding-heart me-2"></i>Senior Service Requests</h1>
                <p class="mb-0 opacity-75">Manage and track service requests for senior citizens</p>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="stats-number stats-pending">{{ $statusCounts['pending'] }}</div>
                <div class="stats-label">Pending Requests</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="stats-number stats-processing">{{ $statusCounts['processing'] }}</div>
                <div class="stats-label">Processing</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="stats-number stats-accepted">{{ $statusCounts['accept'] }}</div>
                <div class="stats-label">Accepted</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="stats-number stats-rejected">{{ $statusCounts['rejected'] }}</div>
                <div class="stats-label">Rejected</div>
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

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by name, ID, or status...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-secondary filter-btn dropdown-toggle" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusFilter">
                                <li><a class="dropdown-item status-filter" href="#" data-status="all">All Statuses</a></li>
                                <li><a class="dropdown-item status-filter" href="#" data-status="pending">Pending</a></li>
                                <li><a class="dropdown-item status-filter" href="#" data-status="processing">Processing</a></li>
                                <li><a class="dropdown-item status-filter" href="#" data-status="accept">Accepted</a></li>
                                <li><a class="dropdown-item status-filter" href="#" data-status="rejected">Rejected</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary filter-btn dropdown-toggle" type="button" id="sortBy" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i> Sort By
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sortBy">
                                <li><a class="dropdown-item sort-option" href="#" data-sort="newest">Newest First</a></li>
                                <li><a class="dropdown-item sort-option" href="#" data-sort="oldest">Oldest First</a></li>
                                <li><a class="dropdown-item sort-option" href="#" data-sort="name_asc">Name (A-Z)</a></li>
                                <li><a class="dropdown-item sort-option" href="#" data-sort="name_desc">Name (Z-A)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Request Details</h5>
            <span class="text-muted" id="showingText">Showing {{ $requests->count() }} of {{ $requests->count() }} requests</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Senior Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>OSCA ID</th>
                            <th>FCAP ID</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Accept Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requestsTableBody">
                        @forelse($requests as $req)
                            <tr class="request-row" data-status="{{ $req->status }}">
                                <td>
                                    <div class="resident-info">
                                        <div class="resident-avatar">
                                            {{ substr($req->first_name, 0, 1) }}{{ substr($req->last_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $req->first_name }} {{ $req->middle_name }} {{ $req->last_name }}</div>
                                            <small class="text-muted">Birthday: {{ $req->dob ? \Carbon\Carbon::parse($req->dob)->format('M d, Y') : 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $req->age }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-{{ $req->gender == 'Male' ? 'male' : 'female' }} me-1"></i>
                                        {{ $req->gender }}
                                    </span>
                                </td>
                                <td><code>{{ $req->oscaId }}</code></td>
                                <td><code>{{ $req->fcapId }}</code></td>
                                <td>
                                    <span class="status-badge status-{{ $req->status }}">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                </td>
                                <td>{{ $req->request_date->format('M d, Y') }}</td>
                                <td class="accept-date-cell">{{ $req->accept_date ? $req->accept_date->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-primary edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#statusModal"
                                                data-id="{{ $req->id }}"
                                                data-status="{{ $req->status }}"
                                                data-update-url="{{ route('senior.req.updateStatus', $req->id) }}"
                                                title="Edit Status">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('senior.req.destroy', $req->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Request">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h4>No requests found</h4>
                                        <p class="text-muted">There are no service requests at the moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Remove the pagination section until we fix the controller -->
        <div class="card-footer">
                <div class="d-flex justify-content-center">
                    {{ $requests->links('pagination::bootstrap-5') }}
                </div>
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusUpdateForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="requestId" name="id">
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="accept">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label fw-bold">Notes (Optional)</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelConfirmModal" tabindex="-1" aria-labelledby="cancelConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this request? This action cannot be undone.</p>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will permanently remove the request from the system.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete Request</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusModal = document.getElementById('statusModal');
        const statusUpdateForm = document.getElementById('statusUpdateForm');
        let deleteForm = null;

        // Status Modal
        statusModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const requestId = button.getAttribute('data-id');
            const currentStatus = button.getAttribute('data-status');
            const updateUrl = button.getAttribute('data-update-url');

            document.getElementById('requestId').value = requestId;
            document.getElementById('status').value = currentStatus;
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
                deleteForm = this;

                const cancelModal = new bootstrap.Modal(document.getElementById('cancelConfirmModal'));
                cancelModal.show();
            });
        });

        // Confirm delete button
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit();
            }
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#requestsTableBody .request-row');
            let visibleCount = 0;

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('showingText').textContent = `Showing ${visibleCount} of ${tableRows.length} requests`;
        });

        // Status filter functionality
        const statusFilters = document.querySelectorAll('.status-filter');
        statusFilters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                const status = this.getAttribute('data-status');
                const tableRows = document.querySelectorAll('#requestsTableBody .request-row');
                let visibleCount = 0;

                tableRows.forEach(row => {
                    if (status === 'all' || row.getAttribute('data-status') === status) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                document.getElementById('showingText').textContent = `Showing ${visibleCount} of ${tableRows.length} requests`;
            });
        });

        // Sort functionality
        const sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                // In a real application, this would trigger a server-side sort or client-side sorting
                alert('Sorting by: ' + this.getAttribute('data-sort'));
            });
        });
    });
</script>
@endsection
