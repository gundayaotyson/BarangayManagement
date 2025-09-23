@extends('resident.resident-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Barangay Services</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">SK Service</h5>
                    <p class="card-text">Apply for SK services.</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#skServiceModal">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>My SK Service Requests</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>School</th>
                        <th>Year</th>
                        <th>Type of Service</th>
                        <th>Status</th>
                        <th>Date Requested</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skServices as $service)
                        <tr>
                            <td>{{ $service->firstname }} {{ $service->lastname }}</td>
                            <td>{{ $service->school }}</td>
                            <td>{{ $service->school_year }}</td>
                            <td>{{ $service->type_of_service }}</td>
                            <td>{{ $service->status }}</td>
                            <td>{{ $service->created_at->format('F d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SK Service Modal -->
<div class="modal fade" id="skServiceModal" tabindex="-1" role="dialog" aria-labelledby="skServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skServiceModalLabel">SK Service Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sk-services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="school">School</label>
                        <input type="text" class="form-control" id="school" name="school" required>
                    </div>
                    <div class="form-group">
                        <label for="school_year">School Year</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>
                    <div class="form-group">
                        <label for="type_of_service">Type of Service</label>
                        <input type="text" class="form-control" id="type_of_service" name="type_of_service" required>
                    </div>
                    <div class="form-group">
                        <label for="attachment">Attachment (Optional)</label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Add these at the bottom if not already in your layout --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
