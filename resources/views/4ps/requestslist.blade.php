@extends('4ps.dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4PS Dashboard - Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem 0;
            border-radius: 0 0 15px 15px;
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

        .status-accepted {
            background-color: rgba(76, 201, 240, 0.15);
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

        .stats-accepted {
            color: var(--success);
        }

        .stats-rejected {
            color: var(--danger);
        }

        .stats-total {
            color: var(--primary);
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
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 mb-0"><i class="fas fa-list-check me-2"></i>Requests List</h1>
                    <p class="mb-0 opacity-75">Manage and review all 4PS program requests</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-light me-2"><i class="fas fa-download me-1"></i> Export</button>
                    <button class="btn btn-light"><i class="fas fa-print me-1"></i> Print</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card">
                    <div class="stats-number stats-total">142</div>
                    <div class="stats-label">Total Requests</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card">
                    <div class="stats-number stats-pending">64</div>
                    <div class="stats-label">Pending</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card">
                    <div class="stats-number stats-accepted">52</div>
                    <div class="stats-label">Accepted</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card stats-card">
                    <div class="stats-number stats-rejected">26</div>
                    <div class="stats-label">Rejected</div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="Search by name, ID, or purok...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">
                            <div class="dropdown me-2">
                                <button class="btn btn-outline-secondary filter-btn dropdown-toggle" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-filter me-1"></i> Status
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="statusFilter">
                                    <li><a class="dropdown-item" href="#">All Statuses</a></li>
                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                    <li><a class="dropdown-item" href="#">Accepted</a></li>
                                    <li><a class="dropdown-item" href="#">Rejected</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary filter-btn dropdown-toggle" type="button" id="sortBy" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sort me-1"></i> Sort By
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortBy">
                                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                                    <li><a class="dropdown-item" href="#">Name (A-Z)</a></li>
                                    <li><a class="dropdown-item" href="#">Name (Z-A)</a></li>
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
                <h5 class="mb-0">All Requests</h5>
                <span class="text-muted">Showing 8 of 142 requests</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Resident Name</th>
                                <th>4ps ID</th>
                                <th>Purok No.</th>
                                <th>House No.</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request )
                            <tr>
                                <td>
                                    <div class="resident-info">
                                        <div class="resident-avatar">{{$request->resident_id }}</div>
                                        <div>
                                            <div class="fw-bold">{{ $request->resident->Fname }} {{ $request->resident->mname }} {{ $request->resident->lname }}</div>
                                            <small class="text-muted">Registered:{{ $request->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $request->fourps_id }}</td>
                                <td>{{ $request->purok_no }}</td>
                                <td>{{ $request->house_no }}</td>
                                <td>{{ $request->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $request->id }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                     <form action="{{ route('4ps.cancel', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="confirmCancel(1)">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                    </form>

                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $request->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $request->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $request->id }}">Edit Request Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('4ps.update', $request->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ $request->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Edit Modal (Example for Request 1) -->
    <!-- <div class="modal fade" id="editModal {{ $request->id }}" tabindex="-1" aria-labelledby="editModalLabel {{ $request->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel {{ $request->id }}">Edit Request Status</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6>Resident Information</h6>
                        <div class="d-flex align-items-center">
                            <div class="resident-avatar me-3">JM</div>
                            <div>
                                <div class="fw-bold">Juan Martinez</div>
                                <div class="text-muted small">4PS ID: 4PS-2301-001</div>
                                <div class="text-muted small">Purok 5, House No. H-24</div>
                            </div>
                        </div>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pending" selected>Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold">Notes (Optional)</label>
                            <textarea class="form-control" id="notes" rows="3" placeholder="Add any notes about this request..."></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelConfirmModal" tabindex="-1" aria-labelledby="cancelConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelConfirmModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this request? This action cannot be undone.</p>
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        The resident will be notified about this cancellation.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-danger" onclick="proceedCancel()">Yes, Cancel Request</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to show confirmation for cancel action
        let cancelRequestId = null;

        function confirmCancel(requestId) {
            cancelRequestId = requestId;
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelConfirmModal'));
            cancelModal.show();
        }

        function proceedCancel() {
            if (cancelRequestId) {
                // In a real application, you would submit the form here
                alert(`Request #${cancelRequestId} has been cancelled.`);
                // Close the modal
                const cancelModal = bootstrap.Modal.getInstance(document.getElementById('cancelConfirmModal'));
                cancelModal.hide();
            }
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-box input');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
