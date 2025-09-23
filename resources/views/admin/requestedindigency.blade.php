@extends('admin.dashboard')
@section('title', ('Barangay Indigency'))

@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --dark-color: #2c3e50;
        --light-color: #ecf0f1;
        --text-color: #333;
        --border-color: #ddd;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    /* Card and Table Styling */
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 12px var(--shadow-color);
        border: none;
        margin-bottom: 2rem;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        font-size: 0.9rem;
        min-width: 1000px; /* Minimum width for smaller screens */
    }

    .table th {
        background-color: var(--light-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }

    /* Search and Filter Styling */
    .search-box {
        position: relative;
    }

    .search-box .form-control {
        padding-left: 2.5rem;
    }

    .search-box::before {
        content: "\f002";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-color);
        opacity: 0.5;
        z-index: 10;
    }

    /* Button Styling */
    .btn-view {
        color: var(--danger-color);
        background-color: rgba(231, 76, 60, 0.1);
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

    /* Dropdown Styling */
    .dropdown-menu {
        padding: 0.5rem;
        min-width: 200px;
        box-shadow: 0 5px 15px var(--shadow-color);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    /* Tooltip Styling */
    .tooltip-inner {
        background-color: var(--dark-color);
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
    }

    .bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow::before,
    .bs-tooltip-top .tooltip-arrow::before {
        border-top-color: var(--dark-color);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }

        .search-box {
            width: 100% !important;
        }

        .dropdown {
            width: 100%;
        }

        .dropdown-toggle {
            width: 100%;
        }
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="m-0 mb-2 mb-md-0">Requested Barangay indigency</h2>
        <div class="d-flex gap-2 flex-grow-1 flex-md-grow-0">
            <div class="search-box flex-grow-1">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Name...">
            </div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-columns me-1"></i> Columns
                </button>
                <ul class="dropdown-menu dropdown-menu-end" id="columnSelection"></ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="clearanceTable">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Birthplace</th>
                        <th>Age</th>
                        <th>Civil Status</th>
                        <th>Citizenship</th>
                        <th>Religion</th>
                        <th>Contact Number</th>
                        <th>Occupation</th>
                        <th>Household No</th>
                        <th>Purok No</th>
                        <th>Sitio</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($indigencyRequests as $request)

                        <tr>
                            <td>
                                {{ $request->resident->lname ?? 'N/A' }},
                                {{ $request->resident->Fname ?? '' }}
                                {{ $request->resident->mname ?? '' }}
                            </td>
                           <td>{{ $request->resident->birthday ?? 'N/A' }}</td>
                            <td>{{ $request->resident->birthplace ?? 'N/A' }}</td>
                            <td>{{ $request->resident->age ?? 'N/A' }}</td>
                            <td>{{ $request->resident->civil_status ?? 'N/A' }}</td>
                            <td>{{ $request->resident->Citizenship ?? 'N/A' }}</td>
                            <td>{{ $request->resident->religion ?? 'N/A' }}</td>
                            <td>{{ $request->resident->contact_number ?? 'N/A' }}</td>
                            <td>{{ $request->resident->occupation ?? 'N/A' }}</td>
                            <td>{{ $request->resident->household_no ?? 'N/A' }}</td>
                            <td>{{ $request->resident->purok_no ?? 'N/A' }}</td>
                            <td>{{ $request->resident->sitio ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('indigency.view', $request->id) }}"
                                   class="btn btn-sm btn-view"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Generate PDF Document">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-4">No clearance requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover focus'
        });
    });

    // Search functionality
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("keyup", function() {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll("#clearanceTable tbody tr");

        rows.forEach(row => {
            const fullName = row.cells[0].textContent.toLowerCase();
            row.style.display = fullName.includes(filter) ? "" : "none";
        });
    });

    // Column selection functionality with localStorage persistence
    const columns = [
        'Full Name', 'Date of Birth', 'Birthplace', 'Age', 'Civil Status',
        'Citizenship','religion','Contact Number', 'Occupation', 'Household No',
        'Purok No', 'Sitio', 'Action'
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
});
</script>
@endsection
