@extends('senior.dashboard')

@section('content')
<div class="container">
    <h1>Request Page</h1>
    <p>This is the request page for seniors.</p>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Table of senior requests --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5>Senior Service Requests</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>OSCA ID</th>
                        <th>FCAP ID</th>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Purok</th>
                        <th>Sitio</th>
                        <th>Status</th>
                        <th>Request Date</th>
                        <th>Accept Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr>
                            <td>{{ $req->oscaId }}</td>
                            <td>{{ $req->fcapId }}</td>
                            <td>{{ $req->first_name }} {{ $req->middle_name }} {{ $req->last_name }}</td>
                            <td>{{ $req->age }}</td>
                            <td>{{ $req->gender }}</td>
                            <td>{{ $req->purok }}</td>
                            <td>{{ $req->sitio }}</td>
                            <td>{{ ucfirst($req->status) }}</td>
                            <td>{{ $req->request_date->format('Y-m-d') }}</td>
                            <td>{{ $req->accept_date ? $req->accept_date->format('Y-m-d') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
