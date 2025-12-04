@extends('4ps.dashboard')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>4Ps Beneficiaries
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addModal">
                                Add New
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Purok No.</th>
                                    <th>House No.</th>
                                    <th>4Ps ID</th>
                                    <th>Status</th>
                                    <th>Resident Match</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fourps as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fname }} {{ $item->mname }} {{ $item->lname }}</td>
                                        <td>{{ $item->purok_no }}</td>
                                        <td>{{ $item->house_no }}</td>
                                        <td>{{ $item->fourps_id }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if ($item->resident)
                                                <span class="badge bg-success">Matched</span>
                                            @else
                                                <span class="badge bg-danger">Not Matched</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $item->id }}" data-fname="{{ $item->fname }}" data-mname="{{ $item->mname }}" data-lname="{{ $item->lname }}" data-purok_no="{{ $item->purok_no }}" data-house_no="{{ $item->house_no }}" data-fourps_id="{{ $item->fourps_id }}" data-status="{{ $item->status }}" data-resident_id="{{ $item->resident_id }}">
                                                Edit
                                            </button>
                                            <!-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $item->id }}">
                                                Delete
                                            </button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add 4Ps Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('4ps.residentlist.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resident_id" id="resident_id">
                    <div class="modal-body">
                        <!-- <div class="mb-3">
                            <label for="resident_name" class="form-label">Search Resident</label>
                            <input type="text" id="resident_name" class="form-control" placeholder="Type resident name..." autocomplete="off">
                            <div id="resident_results" class="resident-results mt-2" style="display: none;"></div>
                            <div class="form-text">Start typing to search for residents or enter information manually</div>
                        </div> -->
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" required>
                        </div>
                        <div class="mb-3">
                            <label for="mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="mname" name="mname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                        </div>
                        <div class="mb-3">
                            <label for="purok_no" class="form-label">Purok No.</label>
                            <input type="text" class="form-control" id="purok_no" name="purok_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="house_no" class="form-label">House No.</label>
                            <input type="text" class="form-control" id="house_no" name="house_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="fourps_id" class="form-label">4Ps ID</label>
                            <input type="text" class="form-control" id="fourps_id" name="fourps_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit 4Ps Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="resident_id" id="edit_resident_id">
                        <div class="mb-3">
                            <label for="edit_resident_name" class="form-label">Search Resident</label>
                            <input type="text" id="edit_resident_name" class="form-control" placeholder="Type resident name..." autocomplete="off">
                            <div id="edit_resident_results" class="resident-results mt-2" style="display: none;"></div>
                            <div class="form-text">Start typing to search for residents or enter information manually</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_fname" name="fname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="edit_mname" name="mname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_lname" name="lname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_purok_no" class="form-label">Purok No.</label>
                            <input type="text" class="form-control" id="edit_purok_no" name="purok_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_house_no" class="form-label">House No.</label>
                            <input type="text" class="form-control" id="edit_house_no" name="house_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_fourps_id" class="form-label">4Ps ID</label>
                            <input type="text" class="form-control" id="edit_fourps_id" name="fourps_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete 4Ps Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete this beneficiary?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Search residents in add modal
    $('#resident_name').on('input', function() {
        let searchTerm = $(this).val();
        if (searchTerm.length >= 2) {
            searchResidents(searchTerm, '#resident_results', '#resident_id', '#fname', '#mname', '#lname', '#purok_no', '#house_no');
        } else {
            $('#resident_results').hide().empty();
        }
    });

    // Search residents in edit modal
    $('#edit_resident_name').on('input', function() {
        let searchTerm = $(this).val();
        if (searchTerm.length >= 2) {
            searchResidents(searchTerm, '#edit_resident_results', '#edit_resident_id', '#edit_fname', '#edit_mname', '#edit_lname', '#edit_purok_no', '#edit_house_no');
        } else {
            $('#edit_resident_results').hide().empty();
        }
    });

    // Hide results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.resident-results').length && !$(e.target).is('#resident_name, #edit_resident_name')) {
            $('.resident-results').hide();
        }
    });

    function searchResidents(searchTerm, resultsContainer, residentIdField, fnameField, mnameField, lnameField, purokField, houseField) {
        $.ajax({
            url: '{{ route("4ps.search_residents") }}',
            type: 'GET',
            data: {
                term: searchTerm
            },
            success: function(data) {
                let results = $(resultsContainer);
                results.empty();

                if (data.length > 0) {
                    data.forEach(function(resident) {
                        let residentItem = $('<div class="resident-item"></div>');
                        residentItem.html(`
                            <div class="p-2 border-bottom cursor-pointer resident-option"
                                 data-id="${resident.id}"
                                 data-fname="${resident.fname}"
                                 data-mname="${resident.mname}"
                                 data-lname="${resident.lname}"
                                 data-purok_no="${resident.purok_no}"
                                 data-house_no="${resident.house_no}">
                                <strong>${resident.fname} ${resident.mname} ${resident.lname}</strong>
                                <br>
                                <small class="text-muted">Purok: ${resident.purok_no} | House: ${resident.house_no}</small>
                            </div>
                        `);
                        results.append(residentItem);
                    });
                    results.show();
                } else {
                    results.html('<div class="p-2 text-muted">No residents found</div>').show();
                }

                // Handle resident selection
                $('.resident-option').off('click').on('click', function() {
                    let residentId = $(this).data('id');
                    let fname = $(this).data('fname');
                    let mname = $(this).data('mname');
                    let lname = $(this).data('lname');
                    let purok_no = $(this).data('purok_no');
                    let house_no = $(this).data('house_no');

                    // Set the hidden resident ID
                    $(residentIdField).val(residentId);

                    // Auto-fill the form fields
                    $(fnameField).val(fname);
                    $(mnameField).val(mname);
                    $(lnameField).val(lname);
                    $(purokField).val(purok_no);
                    $(houseField).val(house_no);

                    // Hide results and clear search
                    $(resultsContainer).hide().empty();
                    if (resultsContainer === '#resident_results') {
                        $('#resident_name').val('');
                    } else {
                        $('#edit_resident_name').val('');
                    }
                });
            },
            error: function(xhr) {
                console.error('Error searching residents:', xhr);
            }
        });
    }

    // Clear forms when modals are closed
    $('#addModal').on('hidden.bs.modal', function () {
        $('#resident_name').val('');
        $('#resident_id').val('');
        $('#resident_results').hide().empty();
        $('#fname').val('');
        $('#mname').val('');
        $('#lname').val('');
        $('#purok_no').val('');
        $('#house_no').val('');
        $('#fourps_id').val('');
        $('#status').val('active');
    });

    $('#editModal').on('hidden.bs.modal', function () {
        $('#edit_resident_name').val('');
        $('#edit_resident_id').val('');
        $('#edit_resident_results').hide().empty();
    });
});

// Edit Modal population
$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var fname = button.data('fname');
    var mname = button.data('mname');
    var lname = button.data('lname');
    var purok_no = button.data('purok_no');
    var house_no = button.data('house_no');
    var fourps_id = button.data('fourps_id');
    var status = button.data('status');
    var resident_id = button.data('resident_id');

    var modal = $(this);
    modal.find('#edit_id').val(id);
    modal.find('#edit_fname').val(fname);
    modal.find('#edit_mname').val(mname);
    modal.find('#edit_lname').val(lname);
    modal.find('#edit_purok_no').val(purok_no);
    modal.find('#edit_house_no').val(house_no);
    modal.find('#edit_fourps_id').val(fourps_id);
    modal.find('#edit_status').val(status);
    modal.find('#edit_resident_id').val(resident_id);

    // If there's a resident_id, fetch and display the resident name
    if (resident_id) {
        $.ajax({
            url: '{{ route("4ps.search_residents") }}',
            type: 'GET',
            data: { resident_id: resident_id },
            success: function(data) {
                if (data.length > 0) {
                    let resident = data[0];
                    $('#edit_resident_name').val(resident.fname + ' ' + resident.mname + ' ' + resident.lname);
                }
            }
        });
    }

    modal.find('form').attr('action', '/admin/4pslist/' + id);
});

// Delete Modal
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('form').attr('action', '/admin/4pslist/' + id);
});
</script>

<style>
.resident-results {
    border: 1px solid #ddd;
    border-radius: 4px;
    background: white;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    width: calc(100% - 30px);
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.resident-option {
    cursor: pointer;
    transition: background-color 0.2s;
}

.resident-option:hover {
    background-color: #f8f9fa;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
@endsection
