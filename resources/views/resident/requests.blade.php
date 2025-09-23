@extends('resident.resident-layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="h3 mb-4 text-gray-800">My Certificate Requests</h1>

            @if ($requests->isEmpty())
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p>You have not made any certificate requests yet.</p>
                    </div>
                </div>
            @else
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Request History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tracking Code</th>
                                        <th>Purpose</th>
                                        <th>Requested Date</th>
                                        <th>Status</th>
                                        <th>Pickup Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->tracking_code }}</td>
                                            <td>{{ $request->purpose }}</td>
                                            <td>{{ $request->requested_date }}</td>
                                            <td>{{ $request->status }}</td>
                                            <td>{{ $request->pickup_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection