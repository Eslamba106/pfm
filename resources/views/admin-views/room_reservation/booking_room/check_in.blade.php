@extends('layouts.back-end.app')

@section('title', ui_change('booking_page', 'room_reservation'))

@push('css_or_js')
<style>
    .info-row p {
        margin-bottom: 6px;
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 18px;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .upload-btn {
        background-color: #17a2b8;
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
    }
</style>
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">Check-In</h1>
    </div>

    <!-- Booking Info -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row info-row">
                <div class="col-md-4">
                    <p><strong>Customer :</strong> David John</p>
                    <p>Kingdom of Bahrain</p>
                </div>

                <div class="col-md-4">
                    <p><strong>Booking Date :</strong> 08/08/2025</p>
                    <p><strong>Booking From :</strong> 14/08/2025</p>
                    <p><strong>Booking To :</strong> 16/08/2025</p>
                    <p><strong>Check-In Date :</strong> 19/01/2026</p>
                    <p>
                        <strong>Check-In Time :</strong>
                        <input type="time" class="form-control d-inline-block w-auto" value="16:20">
                    </p>
                </div>

                <div class="col-md-4">
                    <p><strong>Rooms :</strong> 1</p>
                    <p><strong>Adults :</strong> 2</p>
                    <p><strong>Children :</strong> 0</p>
                    <p><strong>Room(s) :</strong></p>
                    <p>1. Room 1</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Guests -->
    <div class="card">
        <div class="card-body">
            <div class="section-title">Guests</div>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Room</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>ID Type</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>David John</td>
                        <td>
                            <select class="form-control">
                                <option>Room 1</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                        <td>
                            <input type="date" class="form-control" value="1975-10-06">
                        </td>
                        <td>50</td>
                        <td>
                            <select class="form-control">
                                <option>Select</option>
                                <option>Passport</option>
                                <option>ID Card</option>
                            </select>
                        </td>
                        <td>
                            <button class="upload-btn">Upload</button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td></td>
                        <td>
                            <select class="form-control">
                                <option>Room 1</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control">
                                <option>Select</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                        <td>
                            <input type="date" class="form-control">
                        </td>
                        <td></td>
                        <td>
                            <select class="form-control">
                                <option>Select</option>
                            </select>
                        </td>
                        <td>
                            <button class="upload-btn">Upload</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Actions -->
            <div class="text-right">
                <button class="btn btn-success">
                    <i class="tio-checkmark-circle"></i> Check-In
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-danger">
                    Close
                </a>
            </div>
        </div>
    </div>

</div>
@endsection


 @push('script')
 @endpush
