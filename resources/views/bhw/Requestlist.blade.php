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
.container-fluid { padding: 20px; }
h1 { color: var(--header-bg); margin-bottom: 1.5rem; font-weight: 600; border-bottom: 1px solid var(--border-color); padding-bottom: 10px; }

/* TABLE STYLES */
.table-responsive { background: white; border-radius: 10px; box-shadow: var(--shadow-lg); overflow: hidden; }
.table thead th { background-color: var(--header-bg); color: white; padding: 14px; text-transform: uppercase; font-size: 0.8rem; }
.table tbody tr:hover { background: rgba(0,123,255,0.06); transition: 0.2s ease; }
.table td { padding: 12px; vertical-align: middle; }

/* STATUS BADGES */
.status-pending { background-color: var(--warning-color); color: black; }
.status-approved { background-color: var(--success-color); color: white; }
.status-rejected { background-color: var(--danger-color); color: white; }

/* ==========================
   ACTION BUTTONS
========================== */
.action-buttons { display: flex; gap: 10px; justify-content: center; align-items: center; }
.action-buttons .btn-edit,
.action-buttons .btn-delete {
    padding: 7px 16px; font-size: 0.8rem; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; letter-spacing: 0.3px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08); transition: all 0.25s ease;
}

/* EDIT */
.action-buttons .btn-edit { background: linear-gradient(135deg, #0d6efd, #0b5ed7); color: #fff; }
.action-buttons .btn-edit:hover { background: linear-gradient(135deg, #0b5ed7, #094bb3); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(13,110,253,0.35); }

/* DELETE */
.action-buttons .btn-delete { background: linear-gradient(135deg, #dc3545, #bb2d3b); color: #fff; }
.action-buttons .btn-delete:hover { background: linear-gradient(135deg, #bb2d3b, #a62330); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(220,53,69,0.35); }

.action-buttons form { margin: 0; padding: 0; }

/* MODAL STYLING */
.modal-header { background: var(--header-bg); color: white; }
.modal-content { border-radius: 10px; box-shadow: var(--shadow-lg); }

/* RESPONSIVE */
@media (max-width: 576px) {
    .action-buttons { flex-direction: column; gap: 6px; }
    .action-buttons .btn-edit, .action-buttons .btn-delete { width: 100%; text-align: center; padding: 10px 0; }
}

/* TABLE ROW ANIMATION */
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.table tbody tr { animation: fadeIn 0.4s ease-out; }
</style>

<div class="container-fluid">
    <h1>BHW Requests</h1>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>DOB</th><th>Age</th><th>Gender</th><th>Address</th><th>Service</th>
                    <th>Contact</th><th>Complaint</th><th>Status</th><th>Schedule</th><th>Philhealth</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($requests) && !$requests->isEmpty())
                    @foreach($requests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->fname }} {{ $request->mname }} {{ $request->lname }}</td>
                            <td>{{ $request->dob }}</td>
                            <td>{{ $request->age }}</td>
                            <td>{{ $request->gender }}</td>
                            <td>Purok {{ $request->purok_no }}, {{ $request->sitio }}</td>
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
                                    <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $request->id }}">Edit</button>
                                    <form action="{{ route('bhw.request.destroy', $request->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
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
                                            <button type="submit" class="btn btn-primary mt-3">Save</button>
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
