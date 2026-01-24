 @extends('layouts.back-end.app')

 @php
     if (auth()->check()) {
         $company = App\Models\Company::where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = App\Models\User::first();
     }
     $lang = session()->get('locale');
 @endphp
 @section('title', ui_change('room_reservation', 'room_reservation'))

 @push('css_or_js')
 @endpush

 @section('content')
     <div class="content container-fluid">
         <!-- Page Title -->
         <div class="mb-3">
             <h2 class="h1 mb-0 d-flex gap-2">
                 {{-- <img width="60" src="{{asset('/public/assets/back-end/img/bookings.jpg')}}" alt=""> --}}
                 {{ ui_change('bookings', 'hierarchy') }}
             </h2>
         </div>

         <div class="row">


             <div class="col-md-12">
                 <div class="card">
                     <div class="px-3 py-4">
                         <div class="row align-items-center">
                             <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                 <h5 class="mb-0 d-flex align-items-center gap-2">
                                     {{ ui_change('booking_list', 'hierarchy') }}
                                     <span class="badge badge-soft-dark radius-50 fz-12"> </span>
                                 </h5>
                             </div>
                             <div class="col-sm-8 col-md-6 col-lg-4">
                                 <!-- Search -->
                                 
                                 <!-- End Search -->
                             </div>
                         </div>
                     </div>
                     <div style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                         <div class="table-responsive">
                             <table id="datatable"
                                 class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                 <thead class="thead-light thead-50 text-capitalize">
                                     <tr>
                                         <th>{{ ui_change('sl', 'hierarchy') }}</th>
                                         <th class="text-center">{{ ui_change('customer_name', 'hierarchy') }} </th>
                                         <th class="text-center">{{ ui_change('booking_date', 'hierarchy') }} </th>
                                         <th class="text-center">{{ ui_change('rooms', 'hierarchy') }} </th> 
                                         <th class="text-center">{{ ui_change('actions', 'hierarchy') }}</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($bookings as $key => $booking)
                                         <tr>
                                             <td>{{ $bookings->firstItem() + $key }}</td>
                                             <td class="text-center">
                                                 {{ $booking->tenant?->name ?? $booking->tenant?->company_name }}</td>
                                             <td class="text-center">
                                                 {{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->booking_date)->format('d/m/Y') }}
                                             </td>

                                             <td class="text-center">
                                                 @if ($booking->rooms->count())
                                                     <ul class="list-unstyled mb-0">
                                                         @foreach ($booking->rooms as $room)
                                                             <li class="mb-1">
                                                                 <strong>
                                                                     {{ $room->unit_management?->unit_management_main?->name ?? 'Room #' . $room->room_id }}
                                                                 </strong>
                                                                 <br>
                                                                 <small class="text-muted">
                                                                     {{ \Carbon\Carbon::parse($booking->booking_from)->format('d/m/Y') }}
                                                                     →
                                                                     {{ \Carbon\Carbon::parse($booking->booking_to)->format('d/m/Y') }}
                                                                 </small>
                                                             </li>
                                                         @endforeach
                                                     </ul>
                                                 @else
                                                     <span class="text-muted">—</span>
                                                 @endif
                                             </td>

                                             <td>
                                                 <div class="d-flex justify-content-center gap-2">
                                                     {{-- <a class="btn btn-outline-info btn-sm square-btn"
                                                         title="{{ ui_change('edit', 'hierarchy') }}"
                                                         href="{{ route('region.edit', $booking->id) }}">
                                                         <i class="tio-edit"></i>
                                                     </a> --}}
                                                     @if ($booking->status != 'check_in' && $booking->status != 'check_out') 
                                                     <a class="btn btn-outline-info   "
                                                         title="{{ ui_change('check_in', 'hierarchy') }}"
                                                         href="{{ route('booking_room.check_in', $booking->id) }}">
                                                         {{ ui_change('check_in', 'hierarchy') }}
                                                     </a>
                                                      @endif
                                                     @if ($booking->status == 'check_in') 
                                                     <a class="btn btn-outline-danger   "
                                                         title="{{ ui_change('check_in', 'hierarchy') }}"
                                                         href="{{ route('booking.checkout.submit', $booking->id) }}">
                                                         {{ ui_change('check_out', 'hierarchy') }}
                                                     </a>
                                                      @endif
                                                     {{-- <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                         title="{{ ui_change('delete', 'hierarchy') }}"
                                                         id="{{ $booking['id'] }}">
                                                         <i class="tio-delete"></i>
                                                     </a> --}}
                                                 </div>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>

                     <div class="table-responsive mt-4">
                         <div class="d-flex justify-content-lg-end">
                             <!-- Pagination -->
                             {!! $bookings->links() !!}
                         </div>
                     </div>

                     @if (count($bookings) == 0)
                         <div class="text-center p-4">
                             <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                 alt="Image Description">
                             <p class="mb-0">{{ ui_change('general.no_data_to_show', 'hierarchy') }}</p>
                         </div>
                     @endif
                 </div>
             </div>
         </div>
     </div>

 @endsection

 @push('script')

 @endpush
