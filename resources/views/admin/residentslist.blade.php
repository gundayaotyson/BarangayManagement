@extends('admin.dashboard')

@section('title', 'Add New Resident')

@section('content')
<div class="container">


    <!-- Add Resident Modal -->
    <div class="modal fade" id="addResidentModal" tabindex="-1" aria-labelledby="addResidentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addResidentModalLabel">Add New Resident</h5>
                    <a href="{{ route('residents') }}" class="btn-close" aria-label="Close"></a>

                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('manageresidents.store') }}" method="POST">
                        @csrf

                        <!-- Row 1 -->
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-4">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="Fname" class="form-control" required>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" name="mname" class="form-control">
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-4">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row g-3 mt-2">
                            <!-- Alias -->
                            <div class="col-md-4">
                                <label for="alias" class="form-label">Alias</label>
                                <input type="text" name="alias" class="form-control">
                            </div>

                            <!-- Gender -->
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <!-- Birthday -->
                            <div class="col-md-4">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" name="birthday" class="form-control" required min="1800-01-01" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="row g-3 mt-2">
                            <!-- Birthplace -->
                            <div class="col-md-4">
                                <label for="birthplace" class="form-label">Birthplace</label>
                                <input type="text" name="birthplace" class="form-control" required>
                            </div>

                            <!-- Civil Status -->
                            <div class="col-md-4">
                                <label for="civil_status" class="form-label">Civil Status</label>
                                <select name="civil_status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="row g-3 mt-2">
                            <!-- Contact Number -->
                            <div class="col-md-4">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control">
                            </div>

                            <!-- Occupation -->
                            <div class="col-md-4">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" name="occupation" class="form-control">
                            </div>

                            <!-- Household No. -->
                            <div class="col-md-4">
                                <label for="household_no" class="form-label">Household No.</label>
                                <input type="text" name="household_no" class="form-control" required>
                            </div>
                        </div>

                        <!-- Row 5 -->
                        <div class="row g-3 mt-2">
                            <!-- Purok No -->
                            <div class="col-md-4">
                                <label for="purok_no" class="form-label">Purok No</label>
                                <select name="purok_no" id="purok_no" class="form-select" required onchange="showSitioOptions()">
                                    <option value="">Select Purok</option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                </select>
                            </div>

                            <!-- Sitio (Only Visible for Purok 2) -->
                            <div class="col-md-4" id="sitio_container" style="display: none;">
                                <label for="sitio" class="form-label">Sitio</label>
                                <select name="sitio" id="sitio" class="form-select">
                                    <option value="">Select Sitio</option>
                                    <option value="Sitio Leksab">Sitio Leksab</option>
                                    <option value="Sitio Taew">Sitio Taew</option>
                                    <option value="Pidlaoan">Pidlaoan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('residents') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Show/Hide Sitio -->




@endsection
