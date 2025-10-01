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
            --text-muted: #adb5bd;
            --transition-speed: 0.3s;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* Header Row */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: var(--header-bg);
            color: var(--text-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
        }

        /* Menu Toggle Button */
        .menu-toggle {
            background: transparent;
            border: none;
            color: var(--text-light);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            position: relative;
            z-index: 1001;
        }

        .menu-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .menu-toggle:active {
            transform: scale(0.95);
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 70px;
            transition: width var(--transition-speed) ease;
            overflow-x: hidden;
            white-space: nowrap;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 0;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            font-size: 15px;
            transition: all var(--transition-speed) ease;
            padding: 12px 15px;
            border-left: 3px solid transparent;
        }

        .sidebar ul li a:hover {
            background-color: rgba(0, 0, 0, 0.2);
            border-left-color: var(--hover-color);
        }

        .sidebar ul li a i {
            margin-right: 15px;
            width: 24px;
            font-size: 1.1rem;
            text-align: center;
            transition: all var(--transition-speed) ease;
        }

        .sidebar ul li a:hover i,
        .sidebar ul li a:hover span {
            color: var(--hover-color);
        }

        .sidebar.collapsed ul li a span {
            display: none;
        }

        /* Active state */
        .sidebar ul li a.active {
            background-color: rgba(0, 0, 0, 0.3);
            border-left-color: var(--hover-color);
            color: var(--hover-color);
        }

        .sidebar ul li a.active i {
            color: var(--hover-color);
        }

        /* Profile Container */
        .profile-container {
    margin-left: auto;
}

.profile-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    color: var(--text-light);
}

.profile-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.profile-name {
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.2;
}
.profile-container .dropdown-menu {
    transform: translate3d(-1px, 58.4px, 0px) !important;
}
/* Dropdown Menu */
.dropdown-menu {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
}

.dropdown-item {
    transition: all 0.2s ease;
    font-size: 0.9rem;
    color: #495057;
}

/* Blue hover for Edit Profile */
.dropdown-option:first-child .dropdown-item:hover {
    background-color: #e7f1ff;
    color: #0d6efd;
}

/* Red hover for Logout */
.dropdown-option:last-child .dropdown-item:hover {
    background-color: #fff0f0;
    color: #dc3545;
}

/* Icon alignment */
.fa-user-circle,
.fa-sign-out-alt {
    width: 1.25em;
    text-align: center;
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
        }

    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<nav class="sidebar" id="sidebar">
    <!-- Header Row -->
   <div class="header-row">
        <!-- Menu Toggle -->
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="profile-container dropdown">
            <button class="profile-btn dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user() && Auth::user()->image ? asset('storage/profile_images/' . Auth::user()->image) : asset('images/images1.jpg') }}"
                    alt="User Profile" class="profile-img me-2">
                <div class="d-flex flex-column">
                    <span class="profile-name">{{ Auth::user()->name ?? 'User' }}</span>
                </div>
            </button>

            <div class="dropdown-menu dropdown-menu-end" style="min-width: 170px;">
                <div class="dropdown-option">
                    <a href="{{ route('senior.profile')}}" class="dropdown-item d-flex align-items-center px-3 py-2 rounded">
                        <i class="fas fa-user-circle me-3"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>
                <div class="dropdown-option">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center px-3 py-2 rounded w-100">
                            <i class="fas fa-sign-out-alt me-3"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <ul>
        <li><a href="{{ route('senior.dashboard') }}"><i class="fas fa-home"></i> <span>Home</span></a></li>
        <li><a href="{{ route('senior.list') }}" class="active"><i class="fas fa-list"></i> <span>Senior List</span></a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-content" id="main-content">
    <div class="dashboard-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Senior Citizen List</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSeniorModal">Add Senior</button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Birthday</th>
                    <th>OSCA ID</th>
                    <th>FCAP ID</th>
                    <th>Resident Match</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($seniors as $senior)
                    <tr>
                        <td>{{ $senior->lastname }}</td>
                        <td>{{ $senior->firstname }}</td>
                        <td>{{ $senior->middlename }}</td>
                        <td>{{ $senior->birthday }}</td>
                        <td>{{ $senior->osca_id }}</td>
                        <td>{{ $senior->fcap_id }}</td>
                        <td>
                            @if ($senior->resident)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="openViewModal({{$senior->id}})">
                                 <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="openEditModal({{$senior->id}})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('senior.destroy', $senior) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this senior?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No seniors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Senior Modal -->
<div class="modal fade" id="addSeniorModal" tabindex="-1" aria-labelledby="addSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSeniorModalLabel">Add New Senior</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('senior.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middlename" name="middlename">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
            <div class="mb-3">
                <label for="osca_id" class="form-label">OSCA ID</label>
                <input type="text" class="form-control" id="osca_id" name="osca_id" required>
            </div>
            <div class="mb-3">
                <label for="fcap_id" class="form-label">FCAP ID</label>
                <input type="text" class="form-control" id="fcap_id" name="fcap_id" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Senior</button>
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
        <h5 class="modal-title" id="viewSeniorModalLabel">Senior Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="viewSeniorContent"></div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Senior Modal -->
<div class="modal fade" id="editSeniorModal" tabindex="-1" aria-labelledby="editSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSeniorModalLabel">Edit Senior</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editSeniorForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="edit_lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="edit_firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="edit_middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="edit_middlename" name="middlename">
            </div>
            <div class="mb-3">
                <label for="edit_birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="edit_birthday" name="birthday" required>
            </div>
            <div class="mb-3">
                <label for="edit_osca_id" class="form-label">OSCA ID</label>
                <input type="text" class="form-control" id="edit_osca_id" name="osca_id" required>
            </div>
            <div class="mb-3">
                <label for="edit_fcap_id" class="form-label">FCAP ID</label>
                <input type="text" class="form-control" id="edit_fcap_id" name="fcap_id" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Senior</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    }

    async function openViewModal(id) {
        const response = await fetch(`/seniors/${id}/json`);
        const senior = await response.json();

        const content = `
            <p><strong>Last Name:</strong> ${senior.lastname}</p>
            <p><strong>First Name:</strong> ${senior.firstname}</p>
            <p><strong>Middle Name:</strong> ${senior.middlename}</p>
            <p><strong>Birthday:</strong> ${senior.birthday}</p>
            <p><strong>OSCA ID:</strong> ${senior.osca_id}</p>
            <p><strong>FCAP ID:</strong> ${senior.fcap_id}</p>
        `;

        document.getElementById('viewSeniorContent').innerHTML = content;
        const viewModal = new bootstrap.Modal(document.getElementById('viewSeniorModal'));
        viewModal.show();
    }

    async function openEditModal(id) {
        const response = await fetch(`/seniors/${id}/json`);
        const senior = await response.json();

        document.getElementById('edit_lastname').value = senior.lastname;
        document.getElementById('edit_firstname').value = senior.firstname;
        document.getElementById('edit_middlename').value = senior.middlename;
        document.getElementById('edit_birthday').value = senior.birthday;
        document.getElementById('edit_osca_id').value = senior.osca_id;
        document.getElementById('edit_fcap_id').value = senior.fcap_id;

        const editForm = document.getElementById('editSeniorForm');
        editForm.action = `/seniors/${id}`;

        const editModal = new bootstrap.Modal(document.getElementById('editSeniorModal'));
        editModal.show();
    }

</script>
</body>
</html>

