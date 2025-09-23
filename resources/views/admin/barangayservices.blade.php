@extends('admin.dashboard')

@section('content')
<div class="container">
        <h2>Add New Barangay Service</h2>

        <!-- Show success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('brgyservices.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Service Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Service</button>
        </form>
    </div>
@endsection
