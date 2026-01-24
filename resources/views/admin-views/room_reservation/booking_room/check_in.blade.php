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

        .table th,
        .table td {
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

        <form method="POST" action="{{ route('booking.checkin.submit', $booking_r->id) }}" enctype="multipart/form-data">
            @csrf

            <!-- Booking Info -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row info-row">

                        {{-- Customer --}}
                        <div class="col-md-4">
                            <p>
                                <strong>Customer :</strong>
                                {{ $booking_r->tenant?->name ?? $booking_r->tenant?->company_name }}
                            </p>

                            @if ($booking_r->tenant?->country)
                                <p>{{ $booking_r->tenant->country }}</p>
                            @endif
                        </div>

                        {{-- Dates --}}
                        <div class="col-md-4">
                            <p>
                                <strong>Booking Date :</strong>
                                {{ \Carbon\Carbon::parse($booking_r->booking_date)->format('d/m/Y') }}
                            </p>

                            <p>
                                <strong>Booking From :</strong>
                                {{ \Carbon\Carbon::parse($booking_r->booking_from)->format('d/m/Y') }}
                            </p>

                            <p>
                                <strong>Booking To :</strong>
                                {{ \Carbon\Carbon::parse($booking_r->booking_to)->format('d/m/Y') }}
                            </p>

                            <p>
                                <strong>Check-In Date :</strong>
                                {{ now()->format('d/m/Y') }}
                            </p>

                            <p class="d-flex align-items-center gap-2">
                                <strong>Check-In Time :</strong>
                                <input type="time" name="checkin_time" class="form-control w-auto"
                                    value="{{ now()->format('H:i') }}">
                            </p>
                        </div>

                        {{-- Rooms --}}
                        <div class="col-md-4">
                            <p>
                                <strong>Rooms :</strong>
                                {{ $booking_r->rooms->count() }}
                            </p>

                            <p>
                                <strong>Adults :</strong>
                                {{ $booking_r->adults ?? 0 }}
                            </p>

                            <p>
                                <strong>Children :</strong>
                                {{ $booking_r->children ?? 0 }}
                            </p>

                            <p><strong>Room(s) :</strong></p>

                            <ol class="mb-0">
                                @foreach ($booking_r->rooms as $room)
                                    <li>
                                        {{ $room->unit_management?->unit_management_main?->name ?? 'Room #' . $room->room_id }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Guests -->
            <!-- Guests -->
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Guests</h5>

                    <table class="table table-bordered align-middle">
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

                            {{-- ================= Adults ================= --}}
                            <tr class="table-secondary">
                                <td colspan="8">
                                    <strong>Adults</strong>
                                </td>
                            </tr>

                            @for ($i = 0; $i < $booking_r->adults; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>

                                    <td>
                                        <input type="text" name="guests[adults][{{ $i }}][name]"
                                            class="form-control">
                                    </td>

                                    <td>
                                        <select name="guests[adults][{{ $i }}][room_id]" class="form-control">
                                            @foreach ($booking_r->rooms as $room)
                                                <option value="{{ $room->room_id }}">
                                                    {{ $room->unit_management?->unit_management_main?->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="guests[adults][{{ $i }}][gender]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="guests[adults][{{ $i }}][dob]"
                                            class="form-control dob-input date">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control age-input"  name="guests[adults][{{ $i }}][age]">
                                    </td>

                                    <td>
                                        <select name="guests[adults][{{ $i }}][id_type]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="passport">Passport</option>
                                            <option value="id_card">ID Card</option>
                                            <option value="driving_license">driving license</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="file" name="guests[adults][{{ $i }}][id_file]"
                                            class="form-control">
                                    </td>
                                </tr>
                            @endfor


                            {{-- ================= Children ================= --}}
                            <tr class="table-secondary">
                                <td colspan="8">
                                    <strong>Children</strong>
                                </td>
                            </tr>

                            @for ($i = 0; $i < $booking_r->children; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>

                                    <td>
                                        <input type="text" name="guests[children][{{ $i }}][name]"
                                            class="form-control">
                                    </td>

                                    <td>
                                        <select name="guests[children][{{ $i }}][room_id]" class="form-control">
                                            @foreach ($booking_r->rooms as $room)
                                                <option value="{{ $room->room_id }}">
                                                    {{ $room->unit_management?->unit_management_main?->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="guests[children][{{ $i }}][gender]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="guests[children][{{ $i }}][dob]"
                                            class="form-control dob-input date">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control age-input"  name="guests[children][{{ $i }}][age]" >
                                    </td>

                                    <td>
                                        <select name="guests[children][{{ $i }}][id_type]" class="form-control">
                                            <option value="">Select</option>
                                            <option value="passport">Passport</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="file" name="guests[children][{{ $i }}][id_file]"
                                            class="form-control">
                                    </td>
                                </tr>
                            @endfor

                        </tbody>
                    </table>

                    <!-- Actions -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="tio-checkmark-circle"></i> Check-In
                        </button>

                         
                    </div>

                </div>
            </div>


        </form>

    </div>
@endsection


@push('script')
 <script>
        flatpickr(".date", {
             dateFormat: "d/m/Y", 
         });
 </script>
@endpush
