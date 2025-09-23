@extends('admin.dashboard')
@section('title', ('Barangay Clearance'))

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --primary-light: rgba(67, 97, 238, 0.1);
        --secondary: #3f37c9;
        --danger: #ef233c;
        --danger-light: rgba(239, 35, 60, 0.1);
        --dark: #2b2d42;
        --light: #f8f9fa;
        --gray: #6c757d;
        --border: #e9ecef;
        --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    }

    /* Card Styling */
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        border: none;
    }

    /* Table Styling */
    .table {
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: var(--gray);
        border-bottom-width: 1px;
        background-color: var(--light);
        padding: 0.75rem;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
        border-color: var(--border);
    }

    /* Avatar styling */
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

    /* Button styling */
    .btn {
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
        transition: all 0.2s;
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-light);
    }

    .btn-outline-danger:hover {
        background-color: var(--danger-light);
    }

    /* Search box */
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

    /* Empty state */
    .empty-state {
        padding: 3rem 0;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .search-box {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
        }

        .table thead {
            display: none;

        }

        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;

        }

        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--gray);
            margin-right: 1rem;
        }

        .table td:last-child {
            border-bottom: 0;
            justify-content: flex-end;
        }

        .table td .btn {
            margin: 0 0.25rem;
        }
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="m-0 text-primary">
                <i class="fas fa-file-alt me-2"></i>Requested Barangay Clearance
            </h2>
            <p class="text-muted mb-0">Manage and process clearance requests from residents</p>
        </div>

        <div class="d-flex gap-2">
            <div class="search-box flex-grow-1">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="form-control" placeholder="Search residents...">
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-table-columns me-1"></i> Columns
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow" id="columnSelection"></ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="clearanceTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Resident</th>
                            <th>Basic Information</th>
                            <th>Contact Details</th>
                            <th>Address</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clearanceRequests as $request)
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
                            <td>
                                <div>
                                    <small class="text-muted">Birthday:</small>
                                    <p class="mb-0">{{ $request->resident->birthday ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Civil Status:</small>
                                    <p class="mb-0">{{ $request->resident->civil_status ?? 'N/A' }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <small class="text-muted">Contact:</small>
                                    <p class="mb-0">{{ $request->resident->contact_number ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Occupation:</small>
                                    <p class="mb-0">{{ $request->resident->occupation ?? 'N/A' }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <small class="text-muted">Address:</small>
                                    <p class="mb-0">
                                        Purok {{ $request->resident->purok_no ?? 'N/A' }},
                                        Sitio {{ $request->resident->sitio ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Household No:</small>
                                    <p class="mb-0">{{ $request->resident->household_no ?? 'N/A' }}</p>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('clearance.view', $request->id) }}"
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
                                    <h5 class="text-muted">No clearance requests found</h5>
                                    <p class="text-muted">When residents request clearances, they'll appear here</p>
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
    // Initialize tooltips
    const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        .map(function (el) {
            return new bootstrap.Tooltip(el, {
                trigger: 'hover focus'
            });
        });

    // Search functionality
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll("#clearanceTable tbody tr");

            rows.forEach(row => {
                const name = row.querySelector('h6')?.textContent.toLowerCase() || '';
                row.style.display = name.includes(filter) ? "" : "none";
            });
        });
    }

    // Column selection functionality with localStorage persistence
    const columns = [
        'Resident', 'Basic Information', 'Contact Details', 'Address', 'Actions'
    ];

    const columnDropdown = document.getElementById("columnSelection");
    const tableHeaders = document.querySelectorAll("#clearanceTable thead th");
    const tableRows = document.querySelectorAll("#clearanceTable tbody tr");

    // Load saved column visibility from localStorage
    const savedVisibility = JSON.parse(localStorage.getItem('columnVisibility')) ||
                           Array(columns.length).fill(true);

    columns.forEach((column, index) => {
        const li = document.createElement("li");
        li.className = "dropdown-item";
        li.innerHTML = `
            <div class="form-check">
                <input class="form-check-input column-toggle" type="checkbox"
                       data-column="${index}" id="col-${index}" ${savedVisibility[index] ? 'checked' : ''}>
                <label class="form-check-label" for="col-${index}">
                    ${column}
                </label>
            </div>
        `;
        columnDropdown.appendChild(li);

        // Apply saved visibility
        if (!savedVisibility[index]) {
            tableHeaders[index].style.display = "none";
            tableRows.forEach(row => {
                if (row.cells[index]) {
                    row.cells[index].style.display = "none";
                }
            });
        }
    });

    document.querySelectorAll(".column-toggle").forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            const columnIndex = parseInt(this.getAttribute("data-column"));
            const isChecked = this.checked;

            // Update visibility
            tableHeaders[columnIndex].style.display = isChecked ? "" : "none";
            tableRows.forEach(row => {
                if (row.cells[columnIndex]) {
                    row.cells[columnIndex].style.display = isChecked ? "" : "none";
                }
            });

            // Save to localStorage
            savedVisibility[columnIndex] = isChecked;
            localStorage.setItem('columnVisibility', JSON.stringify(savedVisibility));
        });
    });

    // Responsive table adjustments
    function setupResponsiveTable() {
        if (window.innerWidth < 768) {
            const headers = Array.from(document.querySelectorAll("#clearanceTable thead th")).map(th => th.textContent);
            const rows = document.querySelectorAll("#clearanceTable tbody tr");

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                cells.forEach((cell, index) => {
                    if (index < headers.length - 1) { // Skip action column
                        cell.setAttribute('data-label', headers[index]);
                    }
                });
            });
        }
    }

    window.addEventListener('resize', setupResponsiveTable);
    setupResponsiveTable();
});
</script>
@endsection
