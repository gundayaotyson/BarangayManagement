@extends('resident.resident-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome, {{ $resident->Fname }} {{ $resident->mname }} {{ $resident->lname }}</h1>
                <hr>
                <h3>Personal Information</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $resident->Fname }} {{ $resident->mname }} {{ $resident->lname }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $resident->gender }}</td>
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td>{{ $resident->birthday }}</td>
                        </tr>
                        <tr>
                            <th>Birthplace</th>
                            <td>{{ $resident->birthplace }}</td>
                        </tr>
                        <tr>
                            <th>Civil Status</th>
                            <td>{{ $resident->civil_status }}</td>
                        </tr>
                        <tr>
                            <th>Citizenship</th>
                            <td>{{ $resident->Citizenship }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $resident->contact_number }}</td>
                        </tr>
                        <tr>
                            <th>Occupation</th>
                            <td>{{ $resident->occupation }}</td>
                        </tr>
                        <tr>
                            <th>Household Number</th>
                            <td>{{ $resident->household_no }}</td>
                        </tr>
                        <tr>
                            <th>Purok Number</th>
                            <td>{{ $resident->purok_no }}</td>
                        </tr>
                        <tr>
                            <th>Sitio</th>
                            <td>{{ $resident->sitio }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
