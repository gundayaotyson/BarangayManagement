@extends('resident.resident-layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 font-weight-bold text-gray-800">Announcements</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" id="filterAll">
                        <i class="fas fa-bullhorn"></i> All
                    </button>
                    <button class="btn btn-outline-success" id="filterActive">
                        <i class="fas fa-circle-check"></i> Active
                    </button>
                    <button class="btn btn-outline-secondary" id="filterInactive">
                        <i class="fas fa-circle-pause"></i> Inactive
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control" placeholder="Search announcements by title, content, or venue..." id="searchInput">
                <button class="btn btn-primary" type="button" id="searchBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="typeFilter">
                <option value="">All Types</option>
                <option value="General">General</option>
                <option value="Event">Event</option>
                <option value="Emergency">Emergency</option>
                <option value="Meeting">Meeting</option>
                <option value="Program">Program</option>
                <option value="Reminder">Reminder</option>
            </select>
        </div>
    </div>

    <!-- Announcements Grid -->
    <div class="row" id="announcementsContainer">
        @foreach($announcements as $announcement)
        <div class="col-xl-4 col-lg-6 col-md-12 mb-4 announcement-card"
             data-type="{{ $announcement->type }}"
             data-status="{{ $announcement->status }}"
             data-title="{{ strtolower($announcement->title) }}"
             data-content="{{ strtolower($announcement->content) }}"
             data-venue="{{ strtolower($announcement->venue) }}">
            <div class="card shadow-sm border-0 h-100 announcement-card-inner">
                <!-- Card Header -->
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
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
                            <span class="badge {{ $color }} text-white mb-2">{{ $announcement->type }}</span>

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
                        </div>

                        @php
                            $statusColors = [
                                'Active' => 'bg-success',
                                'Inactive' => 'bg-secondary',
                                'Archived' => 'bg-warning'
                            ];
                            $statusClass = $statusColors[$announcement->status] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $announcement->status }}</span>
                    </div>

                    <h5 class="card-title mt-3 mb-1 fw-bold text-dark">{{ $announcement->title }}</h5>
                </div>

                <!-- Photo Placeholder - Clickable -->
                <div class="announcement-photo-container position-relative"
                     onclick="showAnnouncementModal('{{ addslashes($announcement->title) }}',
                                                     '{{ addslashes($announcement->content) }}',
                                                     '{{ $announcement->venue }}',
                                                     '{{ $announcement->type }}',
                                                     '{{ $announcement->audience }}',
                                                     '{{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}',
                                                     '{{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}',
                                                     '{{ \Carbon\Carbon::parse($announcement->created_at)->diffForHumans() }}')"
                     style="cursor: pointer;">
                    @if($announcement->photo)
                        <!-- If there's an actual image -->
                        <img src="{{ asset('storage/' . $announcement->photo) }}"
                             class="card-img-top announcement-image"
                             alt="{{ $announcement->title }}"
                             style="height: 200px; object-fit: cover; width: 100%;">
                        <div class="image-overlay">
                            <div class="overlay-content">
                                <i class="fas fa-expand-arrows-alt fa-2x"></i>
                                <span class="d-block mt-2">Click to view details</span>
                            </div>
                        </div>
                    @else
                        <!-- Placeholder image -->
                        <div class="placeholder-image bg-light d-flex align-items-center justify-content-center"
                             style="height: 200px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                            <div class="text-center">
                                <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No Image Available</p>
                                <small class="text-muted">Click to view announcement details</small>
                            </div>
                        </div>
                        <div class="image-overlay">
                            <div class="overlay-content">
                                <i class="fas fa-expand-arrows-alt fa-2x"></i>
                                <span class="d-block mt-2">Click to view details</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="card-body py-3">
                    <p class="card-text text-muted mb-4">{{ \Illuminate\Support\Str::limit($announcement->content, 150) }}</p>

                    <!-- Details Section -->
                    <div class="announcement-details">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2" style="width: 20px;"></i>
                            <span class="small">{{ $announcement->venue }}</span>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-start text-success me-2" style="width: 20px;"></i>
                                    <div>
                                        <small class="text-muted d-block">Start Date</small>
                                        <span class="small fw-semibold">{{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-end text-danger me-2" style="width: 20px;"></i>
                                    <div>
                                        <small class="text-muted d-block">End Date</small>
                                        <span class="small fw-semibold">{{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i>
                            Posted {{ \Carbon\Carbon::parse($announcement->created_at)->diffForHumans() }}
                        </small>

                        <!-- Duration Badge -->
                        @php
                            $start = \Carbon\Carbon::parse($announcement->start_date);
                            $end = \Carbon\Carbon::parse($announcement->end_date);
                            $now = \Carbon\Carbon::now();

                            if ($now->between($start, $end)) {
                                $durationColor = 'bg-success';
                                $durationText = 'Ongoing';
                            } elseif ($now->lt($start)) {
                                $durationColor = 'bg-info';
                                $durationText = 'Upcoming';
                            } else {
                                $durationColor = 'bg-secondary';
                                $durationText = 'Ended';
                            }
                        @endphp
                        <span class="badge {{ $durationColor }}">{{ $durationText }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($announcements->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-bullhorn fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">No announcements available</h4>
                    <p class="text-muted mb-0">Check back later for updates.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Announcements Count -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="alert alert-light border" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Showing <span class="fw-bold" id="visibleCount">{{ $announcements->count() }}</span>
                        of <span class="fw-bold">{{ $announcements->count() }}</span> announcements
                    </div>
                    <div class="text-muted small">
                        @php
                            $activeCount = $announcements->where('status', 'Active')->count();
                        @endphp
                        <i class="fas fa-circle-check text-success me-1"></i>
                        {{ $activeCount }} active announcement{{ $activeCount != 1 ? 's' : '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Announcement Modal -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge" id="modalTypeBadge"></span>
                            <span class="badge" id="modalAudienceBadge"></span>
                            <span class="badge" id="modalStatusBadge"></span>
                        </div>
                        <div class="content-container">
                            <p id="modalContent" class="mb-4"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <h6 class="text-muted mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Venue</h6>
                            <p id="modalVenue" class="fw-semibold"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <h6 class="text-muted mb-2"><i class="fas fa-calendar-start text-success me-2"></i>Start Date</h6>
                            <p id="modalStartDate" class="fw-semibold"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <h6 class="text-muted mb-2"><i class="fas fa-calendar-end text-danger me-2"></i>End Date</h6>
                            <p id="modalEndDate" class="fw-semibold"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card mb-3">
                            <h6 class="text-muted mb-2"><i class="far fa-clock text-info me-2"></i>Posted</h6>
                            <p id="modalPosted" class="fw-semibold"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print
                </button>
            </div> -->
        </div>
    </div>
</div>

<style>
    .announcement-card-inner {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }

    .announcement-card-inner:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }

    .card-header {
        border-bottom: 2px solid #f8f9fa;
    }

    .card-body {
        min-height: 150px;
    }

    .announcement-details {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
    }

    .announcement-photo-container {
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .placeholder-image {
        transition: all 0.3s ease;
    }

    .announcement-photo-container:hover .placeholder-image {
        transform: scale(1.05);
    }

    .announcement-photo-container:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .overlay-content {
        text-align: center;
        color: white;
        padding: 20px;
    }

    .overlay-content i {
        color: white;
        margin-bottom: 10px;
    }

    .info-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        border-left: 4px solid #0d6efd;
    }

    .badge {
        font-size: 0.75em;
        padding: 0.35em 0.65em;
        font-weight: 500;
    }

    .card-title {
        font-size: 1.1rem;
        line-height: 1.4;
    }

    .card-text {
        line-height: 1.6;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    #searchInput {
        border-right: 0;
    }

    #searchBtn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    /* Type-specific card borders */
    .announcement-card-inner[data-type="Emergency"] {
        border-left: 4px solid #dc3545;
    }

    .announcement-card-inner[data-type="Event"] {
        border-left: 4px solid #198754;
    }

    .announcement-card-inner[data-type="Meeting"] {
        border-left: 4px solid #ffc107;
    }

    .announcement-card-inner[data-type="Program"] {
        border-left: 4px solid #0d6efd;
    }

    .announcement-card-inner[data-type="General"] {
        border-left: 4px solid #0dcaf0;
    }

    .announcement-card-inner[data-type="Reminder"] {
        border-left: 4px solid #6c757d;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const filterAll = document.getElementById('filterAll');
    const filterActive = document.getElementById('filterActive');
    const filterInactive = document.getElementById('filterInactive');
    const announcementCards = document.querySelectorAll('.announcement-card');
    const visibleCount = document.getElementById('visibleCount');

    let currentStatusFilter = 'all';

    // Search functionality
    function filterAnnouncements() {
        const searchTerm = searchInput.value.toLowerCase();
        const typeValue = typeFilter.value;

        let visible = 0;

        announcementCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const content = card.getAttribute('data-content');
            const venue = card.getAttribute('data-venue');
            const type = card.getAttribute('data-type');
            const status = card.getAttribute('data-status');

            const matchesSearch = searchTerm === '' ||
                title.includes(searchTerm) ||
                content.includes(searchTerm) ||
                venue.includes(searchTerm);

            const matchesType = typeValue === '' || type === typeValue;
            const matchesStatus = currentStatusFilter === 'all' ||
                (currentStatusFilter === 'active' && status === 'Active') ||
                (currentStatusFilter === 'inactive' && status !== 'Active');

            const shouldShow = matchesSearch && matchesType && matchesStatus;

            if (shouldShow) {
                card.style.display = 'block';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        visibleCount.textContent = visible;
    }

    // Event listeners
    searchInput.addEventListener('keyup', filterAnnouncements);
    typeFilter.addEventListener('change', filterAnnouncements);

    // Status filter buttons
    filterAll.addEventListener('click', function() {
        currentStatusFilter = 'all';
        updateStatusButtons();
        filterAnnouncements();
    });

    filterActive.addEventListener('click', function() {
        currentStatusFilter = 'active';
        updateStatusButtons();
        filterAnnouncements();
    });

    filterInactive.addEventListener('click', function() {
        currentStatusFilter = 'inactive';
        updateStatusButtons();
        filterAnnouncements();
    });

    function updateStatusButtons() {
        // Reset all buttons
        [filterAll, filterActive, filterInactive].forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
        });

        // Activate current filter button
        switch(currentStatusFilter) {
            case 'all':
                filterAll.classList.remove('btn-outline-primary');
                filterAll.classList.add('btn-primary');
                break;
            case 'active':
                filterActive.classList.remove('btn-outline-primary');
                filterActive.classList.add('btn-primary');
                break;
            case 'inactive':
                filterInactive.classList.remove('btn-outline-primary');
                filterInactive.classList.add('btn-primary');
                break;
        }
    }

    // Initialize status filter
    updateStatusButtons();

    // Search button click
    document.getElementById('searchBtn').addEventListener('click', filterAnnouncements);

    // Press Enter to search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterAnnouncements();
        }
    });
});

// Function to show announcement modal
function showAnnouncementModal(title, content, venue, type, audience, startDate, endDate, postedTime) {
    const modal = new bootstrap.Modal(document.getElementById('announcementModal'));

    // Set modal content
    document.getElementById('announcementModalTitle').textContent = title;
    document.getElementById('modalContent').textContent = content;
    document.getElementById('modalVenue').textContent = venue;
    document.getElementById('modalStartDate').textContent = startDate;
    document.getElementById('modalEndDate').textContent = endDate;
    document.getElementById('modalPosted').textContent = postedTime;

    // Set badges with appropriate colors
    const typeBadge = document.getElementById('modalTypeBadge');
    const audienceBadge = document.getElementById('modalAudienceBadge');

    // Type badge colors
    const typeColors = {
        'General': 'bg-info text-white',
        'Event': 'bg-success text-white',
        'Emergency': 'bg-danger text-white',
        'Meeting': 'bg-warning text-dark',
        'Program': 'bg-primary text-white',
        'Reminder': 'bg-secondary text-white'
    };

    // Audience badge colors
    const audienceColors = {
        'All': 'border border-primary text-primary',
        'Kabataan': 'border border-success text-success',
        'Senior Citizen': 'border border-warning text-warning',
        'PWD': 'border border-info text-info',
        '4ps': 'border border-info text-info'
    };

    typeBadge.className = `badge ${typeColors[type] || 'bg-secondary text-white'}`;
    typeBadge.textContent = type;

    audienceBadge.className = `badge ${audienceColors[audience] || ''}`;
    audienceBadge.textContent = audience;

    // Show modal
    modal.show();
}
</script>

@endsection
