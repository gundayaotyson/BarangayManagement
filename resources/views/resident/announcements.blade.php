@extends('resident.resident-layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 font-weight-bold text-gray-800">Announcements</h2>
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
                                                'PWD' => 'border border-info text-info'
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($announcements->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No announcements found</h5>
                    </div>
                    @endif
                </div>

                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing <strong>{{ $announcements->count() }}</strong> announcements
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
