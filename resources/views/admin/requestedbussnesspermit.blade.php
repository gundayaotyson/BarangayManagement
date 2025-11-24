@extends('admin.dashboard')
@section('title', ('Barangay Business Permit Requests'))

@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --primary-light: rgba(67, 97, 238, 0.1);
        --secondary-color: #2ecc71;
        --danger: #ef233c;
        --danger-light: rgba(239, 35, 60, 0.1);
        --dark: #2b2d42;
        --light: #f8f9fa;
        --gray: #6c757d;
        --border: #e9ecef;
        --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    }

    .card {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        border: none;
    }

    .table {
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: var(--light);
        border-bottom-width: 1px;
        background-color: var(--dark);
        padding: 0.75rem;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
        color: var(--dark);
        border-color: var(--border);
    }

    .avatar {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-sm {
        width: 32px;
        height: 32px;
    }

    .btn-view{
        color: var(--danger-color);
        background-color: rgba(208, 0, 122, 0.1);
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-view:hover {
        background-color: var(--danger-color);
        color: white;
        transform: scale(1.1);
    }

    .search-box {
        min-width: 250px;
        position: relative;
    }

    .search-box .form-control {
        padding-left: 2.5rem;
    }

    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .empty-state {
        padding: 3rem 0;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <div>
            <h2 class="m-0 text-primary">
                <i class="fas fa-file-alt me-2"></i>Requested Barangay Business Permits
            </h2>
            <p class="text-muted mb-0">Manage and process business permit requests from residents</p>
        </div>

        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Search residents...">
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="businessPermitTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Resident</th>
                            <th>Business Name</th>
                            <th>Business Type</th>
                            <th>Business Address</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($businessPermitRequests as $request)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm bg-light-primary rounded-circle me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">
                                            {{ $request->resident->lname ?? 'N/A' }},
                                            {{ $request->resident->Fname ?? '' }}
                                        </h6>
                                        <small class="text-muted">Age: {{ $request->resident->age ?? 'N/A' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $request->business_name }}</td>
                            <td>{{ $request->business_type }}</td>
                            <td>{{ $request->business_address }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('business-permit.view', $request->id) }}"
                                       class="btn btn-sm btn-outline-danger"
                                       data-bs-toggle="tooltip"
                                       title="Generate PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No business permit requests found</h5>
                                    <p class="text-muted">When residents request business permits, they'll appear here</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll("#businessPermitTable tbody tr");

            rows.forEach(row => {
                const name = row.querySelector('h6')?.textContent.toLowerCase() || '';
                row.style.display = name.includes(filter) ? "" : "none";
            });
        });
    }
});
</script>
@endsection
