@extends('admin.dashboard')
@section('title','Senior')
@section('content')

<div class="dashboard-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="text-align: center;">Senior Citizen List</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Birthday</th>
                    <th>OSCA ID</th>
                    <th>FCAP ID</th>
                    <th>Resident Match</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($seniors as $senior)
                    <tr>
                        <td>{{ $senior->lastname }}</td>
                        <td>{{ $senior->firstname }}</td>
                        <td>{{ $senior->middlename }}</td>
                        <td>{{ $senior->birthday }}</td>
                        <td>{{ $senior->osca_id }}</td>
                        <td>{{ $senior->fcap_id }}</td>
                        <td>
                            @if ($senior->resident)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No seniors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
