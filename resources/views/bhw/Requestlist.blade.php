@extends('bhw.dashboard')
@section('content')

<style>
/* ==========================
   VARIABLES + GENERAL STYLES
========================== */
:root {
    --primary-color: #0d6efd;
    --secondary-color: #6c757d;
    --success-color: #198754;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #0dcaf0;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --header-bg: #2c3e50;
    --border-color: #dee2e6;
    --text-light: #ffffff;
    --text-muted: #6c757d;
    --shadow-lg: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

/* BODY & CONTAINER */
body {
    background: #f5f5f5;
    color: var(--dark-color);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.container-fluid {
    padding: 20px;
    max-width: 100%;
    overflow-x: hidden;
}
h1 {
    color: var(--header-bg);
    margin-bottom: 1.5rem;
    font-weight: 600;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
    font-size: 1.8rem;
}

/* ==========================
   TABLE STYLES
========================== */
.table-responsive {
    background: white;
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    margin-top: 1rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table thead th {
    background-color: var(--header-bg);
    color: white;
    padding: 14px 12px;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--border-color);
    white-space: nowrap;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid var(--border-color);
    font-size: 0.875rem;
    line-height: 1.4;
}

.table tbody tr:hover {
    background: rgba(0,123,255,0.06);
    transition: 0.2s ease;
}

/* ==========================
   STATUS BADGES
========================== */
.badge {
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    white-space: nowrap;
}

.bg-success { background-color: var(--success-color) !important; }
.bg-warning { background-color: var(--warning-color) !important; }
.bg-danger { background-color: var(--danger-color) !important; }

/* ==========================
   ACTION BUTTONS
========================== */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
    flex-wrap: nowrap;
}

.action-buttons .btn-edit,
.action-buttons .btn-delete {
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 60px;
}

/* EDIT */
.action-buttons .btn-edit {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    color: #fff;
}
.action-buttons .btn-edit:hover {
    background: linear-gradient(135deg, #0b5ed7, #094bb3);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13,110,253,0.3);
}

/* DELETE */
.action-buttons .btn-delete {
    background: linear-gradient(135deg, #dc3545, #bb2d3b);
    color: #fff;
}
.action-buttons .btn-delete:hover {
    background: linear-gradient(135deg, #bb2d3b, #a62330);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(220,53,69,0.3);
}

.action-buttons form {
    margin: 0;
    padding: 0;
    display: flex;
}

/* ==========================
   MODAL STYLING
========================== */
.modal-header {
    background: var(--header-bg);
    color: white;
    border-bottom: none;
    padding: 1rem 1.5rem;
}
.modal-title {
    font-weight: 600;
}
.modal-content {
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    border: none;
}
.modal-body {
    padding: 1.5rem;
}

/* ==========================
   RESPONSIVE STYLES
========================== */
@media (max-width: 1200px) {
    .table-responsive {
        font-size: 0.85rem;
    }

    .table thead th {
        font-size: 0.7rem;
        padding: 10px 8px;
    }

    .table tbody td {
        padding: 10px 8px;
        font-size: 0.8rem;
    }
}

@media (max-width: 992px) {
    .container-fluid {
        padding: 15px;
    }

    h1 {
        font-size: 1.5rem;
    }

    /* Hide less important columns on medium screens */
    .table thead th:nth-child(6), /* Service */
    .table tbody td:nth-child(6),
    .table thead th:nth-child(8), /* Complaint */
    .table tbody td:nth-child(8),
    .table thead th:nth-child(11), /* Philhealth */
    .table tbody td:nth-child(11) {
        display: none;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 10px;
    }

    h1 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    /* Hide more columns on small screens */
    .table thead th:nth-child(2), /* DOB */
    .table tbody td:nth-child(2),
    .table thead th:nth-child(3), /* Age */
    .table tbody td:nth-child(3),
    .table thead th:nth-child(4), /* Gender */
    .table tbody td:nth-child(4),
    .table thead th:nth-child(7), /* Contact */
    .table tbody td:nth-child(7) {
        display: none;
    }

    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }

    .action-buttons .btn-edit,
    .action-buttons .btn-delete {
        width: 100%;
        text-align: center;
        padding: 8px 0;
        font-size: 0.7rem;
    }
}

@media (max-width: 576px) {
    h1 {
        font-size: 1.2rem;
    }

    /* Mobile card layout for very small screens */
    .table thead {
        display: none;
    }

    .table tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1rem;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
        border: none;
    }

    .table tbody td:last-child {
        border-bottom: none;
        justify-content: center;
        padding-top: 12px;
    }

    .table tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: var(--header-bg);
        text-transform: uppercase;
        font-size: 0.75rem;
    }

    /* Hide schedule and philhealth on mobile */
    .table tbody td:nth-child(10),
    .table tbody td:nth-child(11) {
        display: none;
    }
}

/* ==========================
   TABLE ROW ANIMATION
========================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.table tbody tr {
    animation: fadeIn 0.4s ease-out;
}

/* ==========================
   EMPTY STATE STYLING
========================== */
.text-center.text-muted {
    padding: 2rem;
    font-style: italic;
    color: var(--text-muted) !important;
}

/* ==========================
   FORM STYLES
========================== */
.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--header-bg);
}

.form-control {
    border: 1px solid var(--border-color);
    border-radius: 6px;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    border: none;
    border-radius: 6px;
    padding: 8px 20px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7, #094bb3);
    transform: translateY(-1px);
}
</style>

<div class="container-fluid">
    <h1>BHW Requests</h1>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th><th>DOB</th><th>Age</th><th>Gender</th><th>Address</th><th>Service</th>
                    <th>Contact</th><th>Complaint</th><th>Status</th><th>Schedule</th><th>Philhealth</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($requests) && !$requests->isEmpty())
                    @foreach($requests as $request)
                        <tr>
                            <!-- <td>{{ $loop->iteration }}</td> -->
                            <td>{{ $request->fname }} {{ $request->mname }} {{ $request->lname }}</td>
                            <td>{{ $request->dob }}</td>
                            <td>{{ $request->age }}</td>
                            <td>{{ $request->gender }}</td>
                            <td> {{ $request->purok_no }}, {{ $request->sitio }}</td>
                            <td>{{ $request->service_type }}</td>
                            <td>{{ $request->contact_no }}</td>
                            <td>{{ $request->chief_complaint }}</td>
                            <td>
                                @if($request->sched_date)
                                    <span class="badge bg-success">Scheduled</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ $request->status }}</span>
                                @endif
                            </td>
                            <td>{{ $request->sched_date }}</td>
                            <td>{{ $request->phil_no }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $request->id }}"> <i class="fas fa-edit me-2"></i></button>
                                    <form action="{{ route('bhw.request.destroy', $request->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this request?')">   <i class="fas fa-trash me-1"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $request->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Set Schedule</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('bhw.request.update', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <label class="form-label">Schedule Date</label>
                                            <input type="date" name="sched_date" class="form-control" value="{{ $request->sched_date }}">

                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-primary px-4">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <tr>
                        <td colspan="13" class="text-center text-muted">No requests found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- ============================
     SCRIPT SECTION
============================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    // -------------------------
    // MOBILE TABLE DATA LABELS
    // -------------------------
    function setDataLabels() {
        const headers = document.querySelectorAll('thead th');
        const rows = document.querySelectorAll('tbody tr');

        if(window.innerWidth <= 768){
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, idx) => {
                    if(idx < headers.length-1) {
                        cell.setAttribute('data-label', headers[idx].textContent);
                    }
                });
            });
        } else {
            rows.forEach(row => {
                row.querySelectorAll('td').forEach(cell => cell.removeAttribute('data-label'));
            });
        }
    }
    setDataLabels();
    window.addEventListener('resize', setDataLabels);

    // -------------------------
    // MODAL ANIMATION
    // -------------------------
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', function(){
            const content = this.querySelector('.modal-content');
            content.style.transform = 'scale(0.9)';
            setTimeout(() => { content.style.transform = 'scale(1)'; content.style.transition = 'transform 0.3s ease'; }, 10);
        });
    });

    // -------------------------
    // FORM LOADING SPINNER
    // -------------------------
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(){
            const buttons = this.querySelectorAll('button[type="submit"]');
            buttons.forEach(button => {
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            });
        });
    });
});
</script>

@endsection
