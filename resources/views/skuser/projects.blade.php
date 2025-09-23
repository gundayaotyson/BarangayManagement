@extends('skuser.dashboard')

@section('content')
<div class="container">
    <h1>SK Projects</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Projects List</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                <i class="fas fa-plus"></i> Add Project
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="projectsTable">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Purok</th>
                            <th>Category</th>
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
                            <td colspan="9" class="text-center">No projects available.</td>
                        </tr>
                        @else
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->project_name }}</td>
                            <td>{{ $project->purok }}</td>
                            <td>{{ $project->category }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->target_date }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $project->progress }}%</div>
                                </div>
                            </td>
                            <td>{{ $project->budget }}</td>
                            <td>{{ $project->status }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info view-project-btn" data-bs-toggle="modal" data-bs-target="#viewProjectModal" data-project='@json($project)'>
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning edit-project-btn" data-bs-toggle="modal" data-bs-target="#editProjectModal" data-project='@json($project)'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-project-btn" data-bs-toggle="modal" data-bs-target="#deleteProjectModal" data-project-id="{{ $project->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
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
                        <label for="purok" class="form-label">Purok</label>
                        <input type="text" class="form-control" id="purok" name="purok" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
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
                <p><strong>Purok:</strong> <span id="view-purok"></span></p>
                <p><strong>Category:</strong> <span id="view-category"></span></p>
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
                    <div class="mb-3">
                        <label for="edit-project-name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="edit-project-name" name="project_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-purok" class="form-label">Purok</label>
                        <input type="text" class="form-control" id="edit-purok" name="purok" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="edit-category" name="category" required>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProjectModalLabel">Delete Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this project?</p>
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

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View Modal
        const viewProjectModal = document.getElementById('viewProjectModal');
        viewProjectModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const project = JSON.parse(button.getAttribute('data-project'));

            document.getElementById('view-project-name').textContent = project.project_name;
            document.getElementById('view-purok').textContent = project.purok;
            document.getElementById('view-category').textContent = project.category;
            document.getElementById('view-start-date').textContent = project.start_date;
            document.getElementById('view-target-date').textContent = project.target_date;
            document.getElementById('view-progress').textContent = project.progress;
            document.getElementById('view-budget').textContent = project.budget;
            document.getElementById('view-status').textContent = project.status;
        });

        // Edit Modal
        const editProjectModal = document.getElementById('editProjectModal');
        editProjectModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const project = JSON.parse(button.getAttribute('data-project'));

            document.getElementById('edit-project-name').value = project.project_name;
            document.getElementById('edit-purok').value = project.purok;
            document.getElementById('edit-category').value = project.category;
            document.getElementById('edit-start-date').value = project.start_date;
            document.getElementById('edit-target-date').value = project.target_date;
            document.getElementById('edit-progress').value = project.progress;
            document.getElementById('edit-budget').value = project.budget;
            document.getElementById('edit-status').value = project.status;

            const form = document.getElementById('editProjectForm');
            form.action = `/sk-dashboard/projects/${project.id}`;
        });

        // Delete Modal
        const deleteProjectModal = document.getElementById('deleteProjectModal');
        deleteProjectModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const projectId = button.getAttribute('data-project-id');

            const form = document.getElementById('deleteProjectForm');
            form.action = `/sk-dashboard/projects/${projectId}`;
        });
    });
</script>
@endpush
