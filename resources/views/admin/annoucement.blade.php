@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 font-weight-bold text-gray-800">Announcements Management</h2>
                <a href="#" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                    <i class="fas fa-plus-circle me-2"></i> Add New Announcement
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-primary">Announcements List</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search announcements..." id="searchInput">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="announcementsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="ps-4">Title</th>
                                    <th>Content</th>
                                    <th>Type</th>
                                    <th>Audience</th>
                                    <th>Venue</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-center pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($announcements as $announcement)
                                <tr class="align-middle">
                                    <td class="ps-4 fw-semibold">{{ Str::limit($announcement->title, 20) }}</td>
                                    <td>{{ Str::limit($announcement->content, 25) }}</td>
                                    <td>
                                        @php
                                            $typeColors = [
                                                'General' => 'bg-info',
                                                'Event' => 'bg-success',
                                                'Emergency' => 'bg-danger',
                                                'Meeting' => 'bg-warning',
                                                'Program' => 'bg-primary',
                                                'Reminder' => 'bg-secondary'
                                            ];
                                            $color = $typeColors[$announcement->type] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $color }} text-white">{{ $announcement->type }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $audienceColors = [
                                                'All' => 'border border-primary text-primary',
                                                'Kabataan' => 'border border-success text-success',
                                                'Senior Citizen' => 'border border-warning text-warning',
                                                'PWD' => 'border border-info text-info',
                                                   '4ps' => 'border border-info text-info'
                                            ];
                                            $audienceClass = $audienceColors[$announcement->audience] ?? '';
                                        @endphp
                                        <span class="badge {{ $audienceClass }}">{{ $announcement->audience }}</span>
                                    </td>
                                    <td>{{ Str::limit($announcement->venue, 15) }}</td>
                                    <td>
                                        <span class="text-muted small">{{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'Active' => 'bg-success',
                                                'Inactive' => 'bg-secondary',
                                                'Archived' => 'bg-warning'
                                            ];
                                            $statusClass = $statusColors[$announcement->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $announcement->status }}</span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group" role="group" aria-label="Announcement Actions">
                                            <a href="#" class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal-{{ $announcement->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAnnouncementModal-{{ $announcement->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($announcements->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No announcements found</h5>
                        <p class="text-muted">Click "Add New Announcement" to create your first announcement.</p>
                    </div>
                    @endif
                </div>

                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing <strong>{{ $announcements->count() }}</strong> announcements
                        </div>
                        <!-- Add pagination links if you're using pagination -->
                        <!-- {{-- $announcements->links() --}} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAnnouncementModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Create New Announcement
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.announcement.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter announcement title" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter announcement content" required></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="General" selected>General</option>
                                <option value="Event">Event</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Meeting">Meeting</option>
                                <option value="Program">Program</option>
                                <option value="Reminder">Reminder</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="audience" class="form-label fw-semibold">Audience <span class="text-danger">*</span></label>
                            <select class="form-select" id="audience" name="audience" required>
                                <option value="All" selected>All</option>
                                <option value="Kabataan">Kabataan</option>
                                <option value="Senior Citizen">Senior Citizen</option>
                                <option value="4ps">4ps</option>
                                <option value="PWD">PWD</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="venue" class="form-label fw-semibold">Venue <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="venue" name="venue" placeholder="Enter venue location" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label fw-semibold">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label fw-semibold">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Announcement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($announcements as $announcement)
<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal-{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel-{{ $announcement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editAnnouncementModalLabel-{{ $announcement->id }}">
                    <i class="fas fa-edit me-2"></i>Edit Announcement
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title-{{ $announcement->id }}" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title-{{ $announcement->id }}" name="title" value="{{ $announcement->title }}" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="content-{{ $announcement->id }}" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content-{{ $announcement->id }}" name="content" rows="4" required>{{ $announcement->content }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type-{{ $announcement->id }}" class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="type-{{ $announcement->id }}" name="type" required>
                                <option value="General" {{ $announcement->type == 'General' ? 'selected' : '' }}>General</option>
                                <option value="Event" {{ $announcement->type == 'Event' ? 'selected' : '' }}>Event</option>
                                <option value="Emergency" {{ $announcement->type == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                <option value="Meeting" {{ $announcement->type == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                <option value="Program" {{ $announcement->type == 'Program' ? 'selected' : '' }}>Program</option>
                                <option value="Reminder" {{ $announcement->type == 'Reminder' ? 'selected' : '' }}>Reminder</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="audience-{{ $announcement->id }}" class="form-label fw-semibold">Audience <span class="text-danger">*</span></label>
                            <select class="form-select" id="audience-{{ $announcement->id }}" name="audience" required>
                                <option value="All" {{ $announcement->audience == 'All' ? 'selected' : '' }}>All</option>
                                <option value="Kabataan" {{ $announcement->audience == 'Kabataan' ? 'selected' : '' }}>Kabataan</option>
                                <option value="Senior Citizen" {{ $announcement->audience == 'Senior Citizen' ? 'selected' : '' }}>Senior Citizen</option>
                                <option value="PWD" {{ $announcement->audience == 'PWD' ? 'selected' : '' }}>PWD</option>
                                <option value="4ps" {{ $announcement->audience == '4ps' ? 'selected' : '' }}>4ps</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="venue-{{ $announcement->id }}" class="form-label fw-semibold">Venue <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="venue-{{ $announcement->id }}" name="venue" value="{{ $announcement->venue }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_date-{{ $announcement->id }}" class="form-label fw-semibold">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date-{{ $announcement->id }}" name="start_date" value="{{ $announcement->start_date }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date-{{ $announcement->id }}" class="form-label fw-semibold">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="end_date-{{ $announcement->id }}" name="end_date" value="{{ $announcement->end_date }}" required>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="status-{{ $announcement->id }}" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status-{{ $announcement->id }}" name="status" required>
                                <option value="Active" {{ $announcement->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $announcement->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Archived" {{ $announcement->status == 'Archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Announcement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Announcement Modal -->
<div class="modal fade" id="deleteAnnouncementModal-{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAnnouncementModalLabel-{{ $announcement->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAnnouncementModalLabel-{{ $announcement->id }}">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Are you sure?</h5>
                    <p>You are about to delete the announcement: <strong>"{{ $announcement->title }}"</strong></p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.announcement.destroy', $announcement->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Announcement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-size: 0.75em;
        padding: 0.35em 0.65em;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .card {
        border-radius: 10px;
    }
    .modal-header {
        border-radius: 10px 10px 0 0;
    }
</style>

<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#announcementsTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>

@endsection
