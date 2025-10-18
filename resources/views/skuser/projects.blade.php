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
        justify-content: right; /* Changed to distribute space */
        align-items: center;
        padding: 1rem 1.5rem;
        background-color: transparent;
        border-bottom: 1px solid var(--border-color);
        gap: 1rem; /* Add gap for spacing */
    }

    .card-header .card-title {
        margin-right: 24.7rem;
        margin-bottom: 0;
        padding-left: 0.5rem;
    }

    .card-header .search-form {
        flex-grow: 1; /* Allow search form to take available space */
        width: 200%;
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
    <h1 class="page-title">Projects list</h1>
    <nav aria-label="breadcrumb">
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('skuser.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol> -->
    </nav>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card ">
    <div class="card-header gap-2">
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            <i class="fas fa-plus"></i> Add Project
        </button>
        <div class="d-flex align-items-center gap-2">
            <select id="filterYear" class="form-select form-select-sm-0">
                <option value="">Filter by Year</option>
                @php
                    $currentYear = \Carbon\Carbon::now()->year;
                    $startYear = 2020; // Adjust as needed
                @endphp
                @for ($year = $currentYear; $year >= $startYear; $year--)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            <select id="filterMonth" class="form-select form-select-sm-0">
                <option value="">Filter by Month</option>
                @php
                    $months = [
                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                        7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                    ];
                @endphp
                @foreach ($months as $monthNumber => $monthName)
                    <option value="{{ $monthNumber }}" {{ request('month') == $monthNumber ? 'selected' : '' }}>{{ $monthName }}</option>
                @endforeach
            </select>
             <div class="search-form ">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Project Name...">
        </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-modern" id="projectsTable">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Target</th>
                    <th>Category</th>
                    <th>Possible Action</th>
                    <th>Commitee</th>
                    <th>Start Date</th>
                    <th>Target Date</th>
                    <th>Progress</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($projects->isEmpty())
                <tr>
                    <td colspan="11" class="text-center">No projects available.</td>
                </tr>
                @else
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->project_name }}</td>
                    <td>{{ $project->target }}</td>
                    <td>{{ $project->category }}</td>
                    <td>{{ $project->possible_action }}</td>
                    <td>{{ $project->commitee }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->target_date }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $project->progress }}%</div>
                        </div>
                    </td>
                    <td>{{ $project->budget }}</td>
                    <td>
                        @php
                            $statusClass = '';
                            switch($project->status) {
                                case 'Not Started':
                                    $statusClass = 'status-pending';
                                    break;
                                case 'In Progress':
                                    $statusClass = 'status-approved';
                                    break;
                                case 'Completed':
                                    $statusClass = 'status-released';
                                    break;
                                case 'On Hold':
                                    $statusClass = 'status-declined';
                                    break;
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $project->status }}</span>
                    </td>
                    <td class="actions-group">
                        <span data-bs-toggle="tooltip" data-bs-container="body" data-bs-placement="top" title="View Project">
                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewProjectModal" data-project='@json($project)'>
                                <i class="fas fa-eye"></i>
                            </button>
                        </span>
                        <span data-bs-toggle="tooltip" data-bs-container="body" data-bs-placement="top" title="Edit Project">
                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal" data-project='@json($project)'>
                                <i class="fas fa-edit"></i>
                            </button>
                        </span>
                        <span data-bs-toggle="tooltip" data-bs-container="body" data-bs-placement="top" title="Delete Project">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProjectModal" data-project-id="{{ $project->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </span>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sk.projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <input type="text" class="form-control" id="target" name="target" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="possible_action" class="form-label">Possible Action</label>
                        <input type="text" class="form-control" id="possible_action" name="possible_action" required>
                    </div>
                    <div class="mb-3">
                        <label for="commitee" class="form-label">Commitee</label>
                        <input type="text" class="form-control" id="commitee" name="commitee" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="target_date" class="form-label">Target Date</label>
                        <input type="date" class="form-control" id="target_date" name="target_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget</label>
                        <input type="number" class="form-control" id="budget" name="budget" step="0.01" required>
                    </div>
                     <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="On Hold">On Hold</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Project Modal -->
<div class="modal fade" id="viewProjectModal" tabindex="-1" aria-labelledby="viewProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProjectModalLabel">View Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Project Name:</strong> <span id="view-project-name"></span></p>
                <p><strong>Target:</strong> <span id="view-target"></span></p>
                <p><strong>Category:</strong> <span id="view-category"></span></p>
                <p><strong>Possible Action:</strong> <span id="view-possible_action"></span></p>
                <p><strong>Commitee:</strong> <span id="view-commitee"></span></p>
                <p><strong>Start Date:</strong> <span id="view-start-date"></span></p>
                <p><strong>Target Date:</strong> <span id="view-target-date"></span></p>
                <p><strong>Progress:</strong> <span id="view-progress"></span>%</p>
                <p><strong>Budget:</strong> <span id="view-budget"></span></p>
                <p><strong>Status:</strong> <span id="view-status"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProjectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-project-id" name="id">
                    <div class="mb-3">
                        <label for="edit-project-name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="edit-project-name" name="project_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-target" class="form-label">Target</label>
                        <input type="text" class="form-control" id="edit-target" name="target" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="edit-category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_possible_action" class="form-label">Possible Action</label>
                        <input type="text" class="form-control" id="edit_possible_action" name="possible_action" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_commitee" class="form-label">Commitee</label>
                        <input type="text" class="form-control" id="edit_commitee" name="commitee" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-start-date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="edit-start-date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-target-date" class="form-label">Target Date</label>
                        <input type="date" class="form-control" id="edit-target-date" name="target_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-progress" class="form-label">Progress</label>
                        <input type="number" class="form-control" id="edit-progress" name="progress" min="0" max="100" step="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-budget" class="form-label">Budget</label>
                        <input type="number" class="form-control" id="edit-budget" name="budget" step="0.01" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit-status" class="form-label">Status</label>
                        <select class="form-select" id="edit-status" name="status" required>
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="On Hold">On Hold</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Project Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProjectModalLabel">Delete Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the project <strong><span id="delete-project-name"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteProjectForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // View project modal
    var viewProjectModal = document.getElementById('viewProjectModal');
    viewProjectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var project = JSON.parse(button.getAttribute('data-project'));

        document.getElementById('view-project-name').textContent = project.project_name;
        document.getElementById('view-target').textContent = project.target;
        document.getElementById('view-category').textContent = project.category;
        document.getElementById('view-possible_action').textContent = project.possible_action;
        document.getElementById('view-commitee').textContent = project.commitee;
        document.getElementById('view-start-date').textContent = project.start_date;
        document.getElementById('view-target-date').textContent = project.target_date;
        document.getElementById('view-progress').textContent = project.progress;
        document.getElementById('view-budget').textContent = project.budget;
        document.getElementById('view-status').textContent = project.status;
    });

    // Edit project modal
    var editProjectModal = document.getElementById('editProjectModal');
    editProjectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var project = JSON.parse(button.getAttribute('data-project'));

        document.getElementById('edit-project-id').value = project.id;
        document.getElementById('edit-project-name').value = project.project_name;
        document.getElementById('edit-target').value = project.target;
        document.getElementById('edit-category').value = project.category;
        document.getElementById('edit_possible_action').value = project.possible_action;
        document.getElementById('edit_commitee').value = project.commitee;
        document.getElementById('edit-start-date').value = project.start_date;
        document.getElementById('edit-target-date').value = project.target_date;
        document.getElementById('edit-progress').value = project.progress;
        document.getElementById('edit-budget').value = project.budget;
        document.getElementById('edit-status').value = project.status;

        var form = document.getElementById('editProjectForm');
        form.action = '/sk-dashboard/projects/' + project.id;  // Update form action
    });

    // Delete project modal
    var deleteProjectModal = document.getElementById('deleteProjectModal');
    deleteProjectModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var projectId = button.getAttribute('data-project-id');
        var projectName = button.closest('tr').querySelector('td:first-child').textContent; // Assuming project name is in the first column
        var form = document.getElementById('deleteProjectForm');
        form.action = '/sk-dashboard/projects/' + projectId;
        document.getElementById('delete-project-name').textContent = projectName;
    });
});

$(document).ready(function(){
    // Search functionality
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#projectsTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Filtering functionality for year and month
    $('#filterYear, #filterMonth').on('change', function() {
        var year = $('#filterYear').val();
        var month = $('#filterMonth').val();
 var url = "{{ url('/sk-dashboard/projects') }}"; // Use full URL instead of route name
        var params = [];
        if (year) params.push('year=' + year);
        if (month) params.push('month=' + month);
        if (params.length > 0) url += '?' + params.join('&');

        window.location.href = url;
    });

    // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection
