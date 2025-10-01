@extends('skuser.dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --primary-dark: #3a53c4;
        --secondary-color: #f7b801;
        --text-color: #333;
        --text-muted: #888;
        --bg-color: #f8f9fa;
        --card-bg: #fff;
        --border-color: #dee2e6;
        --border-radius: 0.5rem;
        --transition: all 0.3s ease;
        --box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .page-header {
        margin-bottom: 2rem;
        padding: 0 1rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 600;
        color: var(--text-color);
        margin: 0 0 0.5rem 0;
        padding-left: 0.5rem;
    }

    .page-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 0;
        padding-left: 0.5rem;
    }

    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin: 0 1rem;
    }

    .card-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background-color: transparent;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header .card-title {
        margin-bottom: 0.5rem;
        padding-left: 0.5rem;
    }

    .card-header .search-form {
        width: 100%;
        max-width: 300px;
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    .table-modern {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table-modern thead th {
        background-color: #2c3e50;
        color: var(--bg-color);
        /* font-weight: 600; */
        text-align: center;
        /* padding: 1rem 1.5rem; */
        border-bottom: 2px solid var(--border-color);
    }

    .table-modern tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid var(--border-color);
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table-modern tbody td {

        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table-modern tbody td:first-child {
        color: var(--text-color);
        font-weight: 500;
        /* padding-left: 1.5rem; */
    }

    .status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
    }

    .status-pending { background-color: #ffc107; }
    .status-approved { background-color:  #17a2b8; }
    .status-released { background-color: #28a745; }
    .status-declined { background-color: #dc3545; }

    .actions-group {
        display: flex;
    }

    .actions-group .btn {
        margin-right: 0.5rem;
        transition: var(--transition);
        position: relative;
    }

    .actions-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
        background-color: #f8f9fa;
    }

    .modal-title {
        font-weight: 600;
    }

    .modal-body p {
        margin-bottom: 0.75rem;
    }

    .modal-body p strong {
        color: var(--text-color);
    }

    /* Tooltip Customization */
    .tooltip {
        font-size: 0.875rem;
    }

    .tooltip-inner {
        background-color: var(--text-color);
        color: white;
        border-radius: 0.25rem;
        padding: 0.5rem 0.75rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .tooltip.bs-tooltip-top .tooltip-arrow::before {
        border-top-color: var(--text-color);
    }

    .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: var(--text-color);
    }

    .tooltip.bs-tooltip-start .tooltip-arrow::before {
        border-left-color: var(--text-color);
    }

    .tooltip.bs-tooltip-end .tooltip-arrow::before {
        border-right-color: var(--text-color);
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 1rem;
        }

        .page-header {
            padding: 0 0.5rem;
        }

        .page-header h1 {
            font-size: 1.5rem;
            padding-left: 0.25rem;
        }

        .page-header .breadcrumb {
            padding-left: 0.25rem;
        }

        .card {
            margin: 0 0.5rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }

        .card-header .card-title {
            padding-left: 0;
            margin-bottom: 1rem;
        }

        .card-header .search-form {
            width: 100%;
            margin-top: 0.5rem;
            max-width: 100%;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.8rem 1rem;
        }

        .table-modern tbody td:first-child {
            padding-left: 1rem;
        }

        .actions-group {
            flex-direction: column;
            align-items: stretch;
            gap: 0.3rem;
        }

        .actions-group .btn {
            width: 100%;
            margin-right: 0;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        /* Adjust tooltip positioning for mobile */
        .tooltip {
            font-size: 0.8rem;
        }
    }

    @media (min-width: 1400px) {
        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">SK Services</h1>
    <nav aria-label="breadcrumb">
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('skuser.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol> -->
    </nav>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Service Requests</h5>
        <div class="search-form">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Name...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-modern" id="servicesTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>School</th>
                    <th>Year</th>
                    <th>Type of Service</th>
                    <th>Status</th>
                    <th>Date Requested</th>
                    <th>Attachment</th>
                    <th>Released Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($skServices as $service)
                    <tr>
                        <td>{{ $service->firstname }} {{ $service->lastname }}</td>
                        <td>{{ $service->school }}</td>
                        <td>{{ $service->school_year }}</td>
                        <td>{{ $service->type_of_service }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($service->status) }}">{{ $service->status }}</span>
                        </td>
                        <td>{{ $service->created_at->format('F d, Y') }}</td>
                        <td>{{ $service->attachment }}</td>
                        <td>
                            {{ $service->status == 'Released' && $service->released_date ? $service->released_date->format('F d, Y') : 'N/A' }}
                        </td>
                        <td class="actions-group">
                            <!-- View Button with Tooltip -->
                            <span  data-bs-container="body" data-bs-placement="top"data-bs-toggle="tooltip" title="View Details">
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $service->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </span>

                            <!-- Edit Button with Tooltip -->
                            <span data-bs-toggle="tooltip" data-bs-container="body" data-bs-placement="top" title="Edit Status">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $service->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </span>

                            <!-- Delete Button with Tooltip -->
                            <span data-bs-toggle="tooltip" data-bs-container="body" data-bs-placement="top" title="Delete Request">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $service->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No service requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@foreach ($skServices as $service)
    <!-- View Modal -->
    <div class="modal fade" id="viewModal{{ $service->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel{{ $service->id }}">View Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Full Name:</strong> {{ $service->firstname }} {{ $service->lastname }}</p>
                    <p><strong>School:</strong> {{ $service->school }}</p>
                    <p><strong>School Year:</strong> {{ $service->school_year }}</p>
                    <p><strong>Type of Service:</strong> {{ $service->type_of_service }}</p>
                    <p><strong>Status:</strong> <span class="status-badge status-{{ strtolower($service->status) }}">{{ $service->status }}</span></p>

                    <p><strong>Date Requested:</strong> {{ $service->created_at->format('F d, Y') }}</p>
                    <p><strong>Released Date:</strong> {{ $service->status == 'Released' && $service->released_date ? $service->released_date->format('F d, Y') : 'N/A' }}</p>
                </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $service->id }}">Update Service Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('skuser.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status-{{$service->id}}" class="form-label">Status</label>
                            <select name="status" id="status-{{$service->id}}" class="form-select">
                                <option value="Pending" {{ $service->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $service->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Released" {{ $service->status == 'Released' ? 'selected' : '' }}>Released</option>
                                <option value="Declined" {{ $service->status == 'Declined' ? 'selected' : '' }}>Declined</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $service->id }}">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this service request for <strong>{{ $service->firstname }} {{ $service->lastname }}</strong>?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                     <form action="{{ route('skuser.services.destroy', $service->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script>
    $(document).ready(function(){
        // Search functionality
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#servicesTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // Initialize Bootstrap tooltips
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });
</script>

@endsection

@push('scripts')


@endpush
