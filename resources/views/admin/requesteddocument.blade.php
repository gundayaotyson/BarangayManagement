@extends('admin.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
        font-family: 'Poppins', sans-serif;
        background-color: var(--light-color);
        color: var(--text-color);
    }

    .card {
        background: #fff;
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 1.5rem;
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: 0 6px 16px var(--shadow-color);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        gap: 1rem;
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    }

    .card-title {
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
        font-size: 1.25rem;
    }

    .table-container {
        padding: 10px -0.5rem 1.5rem;

    }

    .table-responsive {

        overflow: hidden;
    }

    .table {
        margin-bottom: 5;
        border-collapse: separate;
        border-spacing: 0;
        padding: 10px;
    }

    .table thead th {
        background-color: var(--dark-color);
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
        padding: 0.75rem 1rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table tbody tr {
        transition: var(--transition);
    }

    .table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .table td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    .table td:first-child {
        font-weight: 500;
        color: var(--dark-color);
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.65rem;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-pending {
        color: var(--danger-color);

    }

    .status-processing {

        color: var(--warning-color);
    }

    .status-ready {
        color: var(--primary-color);

    }

    .status-released {

        color: var(--success-color);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        border-radius: var(--border-radius);
    }

    .btn-view {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: var(--light-color);

    }

    .btn-view:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        color: var(--light-color);
    }

    .btn-edit {
        background-color: var(--warning-color);

        color: var(--light-color);
        border: none;
    }

    .btn-edit:hover {
        background-color: #d35400;
        color: var(--light-color);
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: var(--light-color);
        border: none;
    }

    .btn-delete:hover {
        background-color: #c0392b;
        color: white;
    }

    .search-container {
        position: relative;
    }

    .search-container input {
        width: 240px;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        background-color: var(--light-color);
        transition: var(--transition);
        font-size: 0.875rem;
    }

    .search-container input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        background-color: white;
    }

    .search-container::before {
        content: "\f002";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-color);
        opacity: 0.7;
        font-size: 0.875rem;
    }

    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 4px 12px var(--shadow-color);
        border: none;
        padding: 10px;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.875rem;
        transition: var(--transition);
    }

    .dropdown-item:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .dropdown-item label {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 25px var(--shadow-color);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
    }

    .modal-title {
        font-weight: 600;
        color: var(--dark-color);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
    }

    .form-control {
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 0.5rem 1rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 0;
        color: var(--text-color);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--border-color);
    }

    .empty-state h4 {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        opacity: 0.8;
    }

    .btn-outline-secondary {
        border-color: var(--border-color);
        color: var(--text-color);
    }

    .btn-outline-secondary:hover {
        background-color: var(--light-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .badge.bg-light {
        background-color: var(--light-color) !important;
        color: var(--dark-color) !important;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-container input {
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>
<div class="card-header">
        <h2 class="card-title">List of Request Document</h2>
        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-columns me-2"></i>Columns
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="columnDropdown" id="columnSelection">
                    @php
                        $columns = ['Full Name','Address','Date of Birth','Birth Place','Civil Status','Gender','Purpose','Request Date','Pickup Date','Released Date','Tracking Code','Status','Actions'];
                    @endphp
                    @foreach ($columns as $index => $column)
                        <li>
                            <div class="dropdown-item">
                                <label>
                                    <input type="checkbox" class="form-check-input column-toggle me-2" data-column="{{ $index + 1 }}" checked>
                                    {{ $column }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search requests...">
            </div>
        </div>
    </div>

    <div class="card">
    <div class="table-container">
        <div class="table-responsive">
            <table class="table" id="clearanceTable">
                <thead>
                    <tr>
                    @foreach ($columns as $index => $column)
                        <th data-index="{{ $index }}">{{ $column }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($clearanceRequests as $request)
                        <tr>
                          <td>{{ $request->fullname }}</td>
                            <td>{{ $request->address }}</td>
                            <td>{{ $request->dateofbirth }}</td>
                            <td>{{ $request->placeofbirth }}</td>
                            <td>{{ $request->civil_status }}</td>
                            <td>{{ ucfirst($request->gender) }}</td>
                            <td>{{ $request->purpose }}</td>
                            <td>{{ $request->requested_date }}</td>
                            <td>{{ $request->pickup_date }}</td>
                            <td>{{ $request->released_date ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-light text-dark font-monospace">{{ $request->tracking_code }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ str_replace(' ', '', $request->status) }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- <a href="{{ route('clearance.view', $request->id) }}" class="btn btn-sm btn-view" data-bs-toggle="tooltip" title="Generate Document">
                                        <i class="fas fa-file-pdf"></i>
                                    </a> -->
                                    <button type="button" class="btn btn-sm btn-edit edit-status-btn" data-id="{{ $request->id }}" data-status="{{ $request->status }}" data-bs-toggle="tooltip" title="Edit Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('clearance.delete', $request->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-delete delete-btn" data-id="{{ $request->id }}" data-bs-toggle="tooltip" title="Delete Request">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) }}">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>No document requests found</h4>
                                    <p>When requests are submitted, they will appear here</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>




<!-- Status Edit Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Request Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="statusUpdateForm">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="modalRequestId">
                    <div class="mb-3">
                        <label for="modalStatusSelect" class="form-label">Current Status</label>
                        <select id="modalStatusSelect" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="ready to pick up">Ready to Pick Up</option>
                            <option value="released">Released</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="statusNotes" rows="2" placeholder="Add any notes about this status change..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveStatusBtn">Update Status</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this document request? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Request</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Open Status Modal
    $(".edit-status-btn").click(function () {
        let requestId = $(this).data("id");
        let currentStatus = $(this).data("status");

        $("#modalRequestId").val(requestId);
        $("#modalStatusSelect").val(currentStatus);
        $("#statusModal").modal("show");
    });

    // Save Status Update
    $("#saveStatusBtn").click(function () {
        let requestId = $("#modalRequestId").val();
        let newStatus = $("#modalStatusSelect").val();
        let notes = $("#statusNotes").val();
        let token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "/update-clearance-status/" + requestId,
            type: "PATCH",
            data: {
                status: newStatus,
                notes: notes,
                _token: token
            },
            beforeSend: function() {
                $("#saveStatusBtn").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
            },
            success: function (response) {
                if (response.success) {
                    // Update UI
                    let row = $('button[data-id="' + requestId + '"]').closest("tr");
                    let badge = row.find(".status-badge");

                    // Remove all status classes
                    badge.removeClass("status-pending status-processing status-ready status-released");

                    // Add the appropriate class
                    if (newStatus === "pending") {
                        badge.addClass("status-pending").text("Pending");
                    } else if (newStatus === "processing") {
                        badge.addClass("status-processing").text("Processing");
                    } else if (newStatus === "ready to pick up") {
                        badge.addClass("status-ready").text("Ready to Pick Up");
                    } else if (newStatus === "released") {
                        badge.addClass("status-released").text("Released");
                    }

                    // Show success message
                    showAlert("success", "Status updated successfully!");

                    // Close modal
                    $("#statusModal").modal("hide");
                } else {
                    showAlert("danger", response.message || "Failed to update status.");
                }
            },
            error: function (xhr) {
                let errorMsg = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : "Error updating status. Please try again.";
                showAlert("danger", errorMsg);
            },
            complete: function() {
                $("#saveStatusBtn").prop("disabled", false).text("Update Status");
            }
        });
    });

    // Delete Button Handler
    let deleteRequestId;
    $(".delete-btn").click(function () {
        deleteRequestId = $(this).data("id");
        $("#confirmModal").modal("show");
    });

    // Confirm Delete
    $("#confirmDeleteBtn").click(function () {
        let token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "/clearance/delete/" + deleteRequestId,
            type: "DELETE",
            data: {
                _token: token
            },
            beforeSend: function() {
                $("#confirmDeleteBtn").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...');
            },
            success: function (response) {
                if (response.success) {
                    // Remove the row from table
                    $('button[data-id="' + deleteRequestId + '"]').closest("tr").fadeOut(300, function() {
                        $(this).remove();
                        // Check if table is empty
                        if ($("#clearanceTable tbody tr").length === 0) {
                            $("#clearanceTable tbody").html(`
                                <tr>
                                    <td colspan="{{ count($columns) }}">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h4>No document requests found</h4>
                                            <p>When requests are submitted, they will appear here</p>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        }
                    });

                    showAlert("success", response.message);
                } else {
                    showAlert("danger", response.message || "Failed to delete request.");
                }
            },
            error: function (xhr) {
                let errorMsg = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : "Error deleting request. Please try again.";
                showAlert("danger", errorMsg);
            },
            complete: function() {
                $("#confirmModal").modal("hide");
                $("#confirmDeleteBtn").prop("disabled", false).text("Delete Request");
            }
        });
    });

    // Column Toggle Functionality
    const checkboxes = document.querySelectorAll(".column-toggle");
    const savedColumns = JSON.parse(localStorage.getItem("hiddenColumns")) || [];

    // Apply saved settings
    checkboxes.forEach(checkbox => {
        let column = checkbox.getAttribute("data-column");
        if (savedColumns.includes(column)) {
            checkbox.checked = false;
            document.querySelectorAll(`th:nth-child(${column}), td:nth-child(${column})`)
                .forEach(cell => cell.style.display = "none");
        }

        // Listen for changes
        checkbox.addEventListener("change", function () {
            let updatedHiddenColumns = JSON.parse(localStorage.getItem("hiddenColumns")) || [];

            if (!this.checked) {
                updatedHiddenColumns.push(column);
            } else {
                updatedHiddenColumns = updatedHiddenColumns.filter(col => col !== column);
            }

            localStorage.setItem("hiddenColumns", JSON.stringify(updatedHiddenColumns));

            document.querySelectorAll(`th:nth-child(${column}), td:nth-child(${column})`)
                .forEach(cell => cell.style.display = this.checked ? "" : "none");
        });
    });

    // Search Functionality
    $("#searchInput").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#clearanceTable tbody tr").filter(function() {
            $(this).toggle(
                $(this).text().toLowerCase().indexOf(value) > -1
            );
        });
    });

    // Helper function to show alerts
    function showAlert(type, message) {
        // Remove any existing alerts
        $(".alert-dismissible").remove();

        // Create alert
        let alert = $(`
            <div class="alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 9999;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);

        // Add to body and auto dismiss after 5 seconds
        $("body").append(alert);
        setTimeout(() => {
            alert.alert("close");
        }, 5000);
    }
});
</script>
@endsection
