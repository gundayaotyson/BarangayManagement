@extends('bhw.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregnant Records - BHW Dashboard</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #8e44ad;
            --secondary-color: #9b59b6;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(142, 68, 173, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-warning, .btn-danger {
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .table th {
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(155, 89, 182, 0.05);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            margin: 2rem 0;
            border: none;
        }

        .info-icon {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .resident-badge {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            z-index: 1060; /* Ensure it appears above modal */
        }

        .ui-menu-item {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #eee;
        }

        .ui-menu-item:last-child {
            border-bottom: none;
        }

        .ui-state-active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 10px 10px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
        }

        .search-highlight {
            background-color: #fff3cd;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn {
                padding: 0.5rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="page-title">
            <i class="fas fa-female me-2"></i>Pregnant Records Management
        </h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ count($pregnants) }}</div>
                    <div class="stats-label">Total Records</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 1)->count() }}</div>
                    <div class="stats-label">Purok 1</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 2)->count() }}</div>
                    <div class="stats-label">Purok 2</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="stats-number">{{ $pregnants->where('purok_no', 3)->count() }}</div>
                    <div class="stats-label">Purok 3</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Pregnant Records</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPregnantModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Record
            </button>
        </div>

        <!-- Pregnant Records Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>Pregnant Records List
                </div>
                <span class="resident-badge">{{ count($pregnants) }} Records</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <!-- <th>Resident ID</th> -->
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>LMP Date</th>
                                <th>EMC Date</th>
                                <th>Sitio</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pregnants as $pregnant)
                                <tr>
                                    <!-- <td>{{ $pregnant->id }}</td>
                                    <td>{{ $pregnant->resident_id }}</td> -->
                                    <td>{{ $pregnant->Fname }} {{ $pregnant->mname }} {{ $pregnant->lname }}</td>
                                    <td>{{ $pregnant->birthday }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pregnant->birthday)->age }}</td>
                                    <td>{{ $pregnant->household_no }}, Purok {{ $pregnant->purok_no }}</td>
                                    <td>{{ $pregnant->LMP_date }}</td>
                                    <td>{{ $pregnant->EMC_date }}</td>
                                    <td>{{ $pregnant->sitio }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPregnantModal" data-id="{{ $pregnant->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="#" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Pregnant Modal -->
    <div class="modal fade" id="addPregnantModal" tabindex="-1" aria-labelledby="addPregnantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('bhw.pregnant.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPregnantModalLabel">
                            <i class="fas fa-plus-circle me-2"></i>Add New Pregnant Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-user info-icon"></i>Resident Information
                                </h5>
                            </div>
                            <div class="col-md-15 mb-3">
                                <label for="resident_name" class="form-label">Search Resident</label>
                                <input type="text" id="resident_name" class="form-control" placeholder="Type resident name..." required>
                                <div class="form-text">Start typing to search for residents</div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                <label for="Fname" class="form-label">First Name</label>
                                <input type="text" name="Fname" id="Fname" class="form-control" readonly required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" name="mname" id="mname" class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" readonly required>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                    <input type="date" name="birthday" id="birthday" class="form-control" readonly required onchange="calculateAge()">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                    <input type="text" name="age" id="age" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="household_no" class="form-label">House No.</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <input type="number" name="household_no" id="household_no" class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="purok_no" class="form-label">Purok No.</label>
                                <select name="purok_no" id="purok_no" class="form-select" readonly>
                                    <option value="">Select Purok</option>
                                    <option value="1">Purok 1</option>
                                    <option value="2">Purok 2</option>
                                    <option value="3">Purok 3</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sitio" class="form-label">Sitio</label>
                                <select name="sitio" id="sitio" class="form-select" readonly>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-baby info-icon"></i>Pregnancy Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="LMP_date" class="form-label">Last Menstrual Period (LMP) Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="LMP_date" id="LMP_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="EMC_date" class="form-label">Estimated Month of Confinement (EMC) Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <input type="date" name="EMC_date" id="EMC_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Pregnant Modal (Placeholder) -->
    <div class="modal fade" id="editPregnantModal" tabindex="-1" aria-labelledby="editPregnantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPregnantModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Pregnant Record
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center py-4">Edit functionality would be implemented here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            function calculateAge() {
                var birthday = document.getElementById('birthday').value;
                if (birthday) {
                    var age = new Date().getFullYear() - new Date(birthday).getFullYear();
                    document.getElementById('age').value = age;
                }
            }

            function updateSitio() {
                var purok = document.getElementById('purok_no').value;
                var sitioDropdown = document.getElementById('sitio');
                sitioDropdown.innerHTML = '<option value="N/A">N/A</option>';

                if (purok == 1) {
                    sitioDropdown.innerHTML += '<option value="Leksab">Leksab</option>';
                } else if (purok == 2) {
                    sitioDropdown.innerHTML += '<option value="Taew">Taew</option>';
                } else if (purok == 3) {
                    sitioDropdown.innerHTML += '<option value="Pidlaoan">Pidlaoan</option>';
                }
            }

            // Initialize autocomplete when modal is shown
            $('#addPregnantModal').on('shown.bs.modal', function () {
                $("#resident_name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('bhw.search_residents') }}",
                            dataType: "json",
                            data: { query: request.term },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.fname + ' ' + item.lname,  // what appears in dropdown
                                        value: item.fname + ' ' + item.lname,  // what shows in textbox
                                        data: item                                // full resident object
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        const r = ui.item.data;

                        $("#resident_id").val(r.id);
                        $("#resident_id_display").val(r.id);
                        $("#Fname").val(r.fname);
                        $("#mname").val(r.mname);
                        $("#lname").val(r.lname);
                        $("#birthday").val(r.birthday);
                        $("#household_no").val(r.household_no);

                        $("#purok_no").val(r.purok_no);
                        // $("#purok_no_hidden").val(r.purok_no);

                        // Display sitio directly from resident record
                        $("#sitio").html(`<option value="${r.sitio}" selected>${r.sitio}</option>`);

                        calculateAge();
                    }
                });
            });

            // Reset form when modal is closed
            $('#addPregnantModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                $('#resident_id_display').val('');
                $('#Fname, #mname, #lname, #birthday, #age, #household_no').val('');
                $('#purok_no').val('');
                $('#sitio').html('<option value="N/A">N/A</option>');

                // Destroy autocomplete to prevent multiple initializations
                if ($("#resident_name").hasClass("ui-autocomplete-input")) {
                    $("#resident_name").autocomplete("destroy");
                }
            });

            // Add some visual feedback when dates are selected
            $('#LMP_date, #EMC_date').on('change', function() {
                if ($(this).val()) {
                    $(this).addClass('is-valid');
                } else {
                    $(this).removeClass('is-valid');
                }
            });
        });
    </script>
</body>
</html>
@endsection
