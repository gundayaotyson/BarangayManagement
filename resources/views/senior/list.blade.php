
@extends('senior.dashboard')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Senior List</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --sidebar-bg: #343a40;
            --header-bg: #2c3e50;
            --hover-color: #007bff;
            --text-light: #ffffff;
            --text-muted: #6c757d;
            --transition-speed: 0.3s;
            --dark-color: #2c3e50;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 90px 20px 20px;
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        .dashboard-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

      /* Header row above the table */
.header-controls {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
    gap: 15px;
}

.header-controls h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: #333;
    margin-left: 15px;
    flex: 1;
}

.search-container {
    position: relative;
    flex: 0 1 300px;
    max-width: 400px;
}

.search-input {
    width: 100%;
    padding-left: 40px;
    border-radius: 25px;
    border: 1px solid #ddd;
    height: 45px;
    transition: all 0.3s ease;
}

.search-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
}

.add-senior-btn {
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 6px;
    height: 45px;
    flex-shrink: 0;
}

/* Responsive adjustments for header */
@media (max-width: 768px) {
    .header-controls {
        flex-direction: column;
        align-items: stretch;
    }

    .header-controls h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    .search-container {
        max-width: 100%;
        margin: 0 0 10px 0;
    }

    .add-senior-btn {
        align-self: center;
    }
}

        /* Table Improvements */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color:var( --header-bg);
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #ffffffff;
            padding: 12px 15px;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        /* Action Buttons */
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

        /* Badge Improvements */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        /* Modal Styles */
        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .form-label {
            font-weight: 500;
        }

        /* Resident View Modal Styles */
        .resident-info-card {
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .resident-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .resident-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .resident-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .resident-photo {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .resident-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-group {
            margin-bottom: 1.25rem;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark-color);
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive Design Improvements */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 80px;
                padding: 80px 15px 15px;
            }
        }

        @media (max-width: 992px) {
            .header-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .header-controls h1 {
                text-align: center;
            }

            .search-container {
                max-width: 100%;
                margin-left: 0;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .table thead th,
            .table tbody td {
                padding: 10px 8px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 70px 10px 10px;
            }

            .dashboard-box {
                padding: 20px 15px;
            }

            .resident-info-card .row {
                flex-direction: column-reverse;
            }

            .resident-photo {
                margin: 0 auto 1rem;
            }

            .table thead th:nth-child(3),
            .table thead th:nth-child(4),
            .table tbody td:nth-child(3),
            .table tbody td:nth-child(4) {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .header-controls h1 {
                font-size: 1.5rem;
            }

            .table-responsive {
                border: 1px solid #dee2e6;
            }

            .table thead th,
            .table tbody td {
                padding: 8px 5px;
                font-size: 0.85rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 3px;
            }

            .action-buttons .btn {
                width: 32px;
                height: 32px;
            }

            .modal-dialog {
                margin: 0.5rem;
            }

            .resident-meta {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (max-width: 400px) {
            .table thead th:nth-child(2),
            .table tbody td:nth-child(2) {
                display: none;
            }

            .search-input {
                font-size: 0.9rem;
            }
        }

        /* Loading state for better UX */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Custom scrollbar for table */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body>

<div class="main-content" id="main-content">
     @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="dashboard-box">

       <div class="header-controls">
            <h2 class="me-auto">Senior Citizen List</h2>
            <div class="search-container">

                <input type="text" id="searchInput" class="form-control search-input" placeholder="Search seniors...">
            </div>
            <button class="btn btn-primary add-senior-btn" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
                <i class="fas fa-plus"></i> Add Senior
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="seniorTable">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Birthday</th>
                        <th>OSCA ID</th>
                        <th>FCAP ID</th>
                        <th>Resident Match</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seniors as $senior)
                        <tr data-search="{{ strtolower($senior->firstname . ' ' . $senior->middlename . ' ' . $senior->lastname . ' ' . $senior->osca_id . ' ' . $senior->fcap_id) }}">
                            <td class="fw-medium">{{ $senior->firstname }} {{ $senior->middlename }} {{ $senior->lastname }}</td>
                            <td>{{ \Carbon\Carbon::parse($senior->birthday)->format('M d, Y') }}</td>
                            <td><span class="badge bg-info text-dark">{{ $senior->osca_id }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $senior->fcap_id }}</span></td>
                            <td>
                                @if ($senior->resident)
                                <button class="btn btn-success btn-sm view-resident-btn" onclick="openResidentModal({{ $senior->id }})">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </button>
                                @else
                                    <span class="badge bg-danger">No Match</span>
                                @endif
                            </td>
                            <td>
                               <div class="action-buttons">
                                    <button class="btn btn-sm btn-info" onclick="openViewModal({{$senior->id}})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="openEditModal({{$senior->id}})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('senior.destroy', $senior) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h4>No seniors found</h4>
                                    <p>There are no senior citizens in the database yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Add Senior Modal -->
<div class="modal fade" id="addSeniorModal" tabindex="-1" aria-labelledby="addSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSeniorModalLabel"><i class="fas fa-user-plus me-2"></i>Add New Senior</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('senior.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label for="firstname" class="form-label">First Name</label><input type="text" class="form-control" id="firstname" name="firstname" required></div>
                <div class="col-md-6 mb-3"><label for="lastname" class="form-label">Last Name</label><input type="text" class="form-control" id="lastname" name="lastname" required></div>
            </div>
            <div class="mb-3"><label for="middlename" class="form-label">Middle Name</label><input type="text" class="form-control" id="middlename" name="middlename"></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label for="birthday" class="form-label">Birthday</label><input type="date" class="form-control" id="birthday" name="birthday" required></div>
                <div class="col-md-6 mb-3"><label for="osca_id" class="form-label">OSCA ID</label><input type="text" class="form-control" id="osca_id" name="osca_id" required></div>
            </div>
            <div class="mb-3"><label for="fcap_id" class="form-label">FCAP ID</label><input type="text" class="form-control" id="fcap_id" name="fcap_id" required></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Senior</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- View Senior Modal -->
<div class="modal fade" id="viewSeniorModal" tabindex="-1" aria-labelledby="viewSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewSeniorModalLabel"><i class="fas fa-user me-2"></i>Senior Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><div id="viewSeniorContent"></div></div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
    </div>
  </div>
</div>

<!-- Edit Senior Modal -->
<div class="modal fade" id="editSeniorModal" tabindex="-1" aria-labelledby="editSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSeniorModalLabel"><i class="fas fa-edit me-2"></i>Edit Senior</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editSeniorForm" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3"><label for="edit_firstname" class="form-label">First Name</label><input type="text" class="form-control" id="edit_firstname" name="firstname" required></div>
                <div class="col-md-4 mb-3"><label for="edit_lastname" class="form-label">Last Name</label><input type="text" class="form-control" id="edit_lastname" name="lastname" required></div>
                <div class="col-md-4 mb-3"><label for="edit_middlename" class="form-label">Middle Name</label><input type="text" class="form-control" id="edit_middlename" name="middlename" required></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3"><label for="edit_birthday" class="form-label">Birthday</label><input type="date" class="form-control" id="edit_birthday" name="birthday" required></div>
                <div class="col-md-6 mb-3"><label for="edit_osca_id" class="form-label">OSCA ID</label><input type="text" class="form-control" id="edit_osca_id" name="osca_id" required></div>
            </div>
            <div class="mb-3"><label for="edit_fcap_id" class="form-label">FCAP ID</label><input type="text" class="form-control" id="edit_fcap_id" name="fcap_id" required></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Senior</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Resident Details Modal -->
<div class="modal fade" id="viewResidentDetailsModal" tabindex="-1" aria-labelledby="viewResidentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewResidentDetailsModalLabel"><i class="fas fa-user"></i> Resident Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <div class="resident-info-card">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <h4 class="resident-name" id="view-fullname-header"></h4>
                            <div class="resident-meta">
                                <div class="resident-meta-item"><i class="fas fa-venus-mars"></i> <span id="view-gender-meta"></span></div>
                                <div class="resident-meta-item"><i class="fas fa-birthday-cake"></i> <span id="view-age-meta"></span> years old</div>
                                <div class="resident-meta-item"><i class="fas fa-ring"></i> <span id="view-civil-status-meta"></span></div>
                            </div>
                            <div class="resident-meta">
                                <div class="resident-meta-item"><i class="fas fa-map-marker-alt"></i> <span id="view-address-meta"></span></div>
                                <div class="resident-meta-item"><i class="fas fa-home"></i> Household #<span id="view-household-meta"></span></div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="resident-photo">
                                <img id="view-resident-photo" src="{{ asset('images/default.png') }}" alt="Resident Photo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12"><h6 class="section-title"><i class="fas fa-user-circle"></i> Personal Information</h6></div>
                    <div class="col-md-6"><div class="info-group"><div class="info-label">Full Name</div><div class="info-value" id="view-fullname"></div></div>
                        <div class="info-group"><div class="info-label">Gender</div><div class="info-value" id="view-gender"></div></div>
                        <div class="info-group"><div class="info-label">Birthdate</div><div class="info-value" id="view-birthday"></div></div>
                        <div class="info-group"><div class="info-label">Age</div><div class="info-value" id="view-age"></div></div></div>
                    <div class="col-md-6"><div class="info-group"><div class="info-label">Birthplace</div><div class="info-value" id="view-birthplace"></div></div>
                        <div class="info-group"><div class="info-label">Civil Status</div><div class="info-value" id="view-civil-status"></div></div>
                        <div class="info-group"><div class="info-label">Citizenship</div><div class="info-value" id="view-citizenship"></div></div>
                        <div class="info-group"><div class="info-label">Religion</div><div class="info-value" id="view-religion"></div></div></div>
                    <div class="col-12 mt-3"><h6 class="section-title"><i class="fas fa-address-card"></i> Contact & Occupation</h6></div>
                    <div class="col-md-6"><div class="info-group"><div class="info-label">Contact Number</div><div class="info-value" id="view-contact-number"></div></div></div>
                    <div class="col-md-6"><div class="info-group"><div class="info-label">Occupation</div><div class="info-value" id="view-occupation"></div></div></div>
                    <div class="col-12 mt-3"><h6 class="section-title"><i class="fas fa-map-marked-alt"></i> Address Information</h6></div>
                    <div class="col-md-4"><div class="info-group"><div class="info-label">Household No</div><div class="info-value" id="view-household-no"></div></div></div>
                    <div class="col-md-4"><div class="info-group"><div class="info-label">Purok</div><div class="info-value" id="view-purok"></div></div></div>
                    <div class="col-md-4"><div class="info-group"><div class="info-label">Sitio</div><div class="info-value" id="view-sitio"></div></div></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<script>
    async function openViewModal(id) {
        const response = await fetch(`/seniors/${id}/json`);
        const senior = await response.json();
        const content = `
            <div class="info-group"><div class="info-label">Full Name:</div><div class="info-value">${senior.firstname} ${senior.middlename || ''} ${senior.lastname}</div></div>
            <div class="info-group"><div class="info-label">Birthday:</div><div class="info-value">${senior.birthday}</div></div>
            <div class="info-group"><div class="info-label">OSCA ID:</div><div class="info-value">${senior.osca_id}</div></div>
            <div class="info-group"><div class="info-label">FCAP ID:</div><div class="info-value">${senior.fcap_id}</div></div>
        `;
        document.getElementById('viewSeniorContent').innerHTML = content;
        new bootstrap.Modal(document.getElementById('viewSeniorModal')).show();
    }

    async function openEditModal(id) {
        const response = await fetch(`/seniors/${id}/json`);
        const senior = await response.json();
        document.getElementById('edit_lastname').value = senior.lastname;
        document.getElementById('edit_firstname').value = senior.firstname;
        document.getElementById('edit_middlename').value = senior.middlename || '';
        document.getElementById('edit_birthday').value = senior.birthday;
        document.getElementById('edit_osca_id').value = senior.osca_id;
        document.getElementById('edit_fcap_id').value = senior.fcap_id;
        document.getElementById('editSeniorForm').action = `/seniors/${id}`;
        new bootstrap.Modal(document.getElementById('editSeniorModal')).show();
    }

    async function openResidentModal(seniorId) {
        const viewBtn = document.querySelector(`[onclick="openResidentModal(${seniorId})"]`);
        viewBtn.classList.add('loading');
        viewBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';

        try {
            const response = await fetch(`/seniors/${seniorId}/resident`);
            if (!response.ok) {
                alert('Failed to fetch resident data.');
                return;
            }
            const resident = await response.json();
            if (resident.error) {
                alert(resident.error);
                return;
            }

            const fullName = `${resident.lname}, ${resident.Fname} ${resident.mname || ''}`;
            const fullAddress = `${resident.purok_no}${resident.sitio ? ', ' + resident.sitio : ''}`;

            document.getElementById('view-fullname-header').textContent = fullName;
            document.getElementById('view-gender-meta').textContent = resident.gender || 'N/A';
            document.getElementById('view-age-meta').textContent = resident.age || 'N/A';
            document.getElementById('view-civil-status-meta').textContent = resident.civil_status || 'N/A';
            document.getElementById('view-address-meta').textContent = fullAddress;
            document.getElementById('view-household-meta').textContent = resident.household_no || 'N/A';
            document.getElementById('view-resident-photo').src = resident.image ? `/storage/${resident.image}` : "{{ asset('images/default.png') }}";
            document.getElementById('view-fullname').textContent = fullName;
            document.getElementById('view-gender').textContent = resident.gender || 'N/A';
            document.getElementById('view-birthday').textContent = resident.birthday || 'N/A';
            document.getElementById('view-age').textContent = resident.age ? `${resident.age} years old` : 'N/A';
            document.getElementById('view-birthplace').textContent = resident.birthplace || 'Not provided';
            document.getElementById('view-civil-status').textContent = resident.civil_status || 'Not specified';
            document.getElementById('view-citizenship').textContent = resident.Citizenship || 'N/A';
            document.getElementById('view-religion').textContent = resident.religion || 'Not provided';
            document.getElementById('view-contact-number').textContent = resident.contact_number || 'N/A';
            document.getElementById('view-occupation').textContent = resident.occupation || 'N/A';
            document.getElementById('view-household-no').textContent = resident.household_no || 'N/A';
            document.getElementById('view-purok').textContent = resident.purok_no || 'N/A';
            document.getElementById('view-sitio').textContent = resident.sitio || 'N/A';

            new bootstrap.Modal(document.getElementById('viewResidentDetailsModal')).show();
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while fetching resident data.');
        } finally {
            viewBtn.classList.remove('loading');
            viewBtn.innerHTML = '<i class="fas fa-eye me-1"></i>View Details';
        }
    }

    // Enhanced search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('#seniorTable tbody tr');
        let hasVisibleRows = false;

        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || row.textContent.toLowerCase();
            const isVisible = searchData.includes(searchText);
            row.style.display = isVisible ? '' : 'none';
            if (isVisible) hasVisibleRows = true;
        });

        // Show empty state if no results
        const emptyRow = document.querySelector('#seniorTable tbody tr td[colspan]');
        if (emptyRow) {
            const emptyState = emptyRow.closest('tr');
            emptyState.style.display = hasVisibleRows ? 'none' : '';
        }
    });

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
</body>
</html>
