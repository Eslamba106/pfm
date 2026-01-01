<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('companies.companies')}}</h5>
        <h2 class="business-analytics__title">{{ $companies->count() ?? 0 }}</h2>
        <img src="{{asset('/assets/back-end/img/total-sale.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('Propsed Units')}}</h5>
        <h2 class="business-analytics__title">{{ $units->where('booking_status' , 'proposal')->count() ?? 0 }}</h2>
        <img src="{{asset('/assets/back-end/img/total-stores.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('Booking Units')}}</h5>
        <h2 class="business-analytics__title">{{ $units->where('booking_status' , 'booking')->count() ?? 0 }}</h2>
        <img src="{{asset('/assets/back-end/img/total-product.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('Agreement Units')}}</h5>
        <h2 class="business-analytics__title">{{ $units->where('booking_status' , 'agreement')->count() ?? 0 }}</h2>
        <img src="{{asset('/assets/back-end/img/total-customer.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>


<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_pending" href="{{ route('enquiry.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/pending.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('dashboard.enquiries_count')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$enquiries }}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_confirmed" href="{{ route('enquiry.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/confirmed.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('confirmed')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$enquiries_confirmed}}
        </span>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href='{{ route('enquiry.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('pending')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$enquiries_pending}}</span>
    </div>
</div>
<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_canceled cursor-pointer" onclick="location.href='{{ route('enquiry.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/canceled.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('canceled')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$enquiries_canceled}}</span>
    </div>
</div>

{{-- Proposals --}}

<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_pending" href="{{ route('proposal.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/pending.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('dashboard.proposals_count')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$proposals }}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_confirmed" href="{{ route('proposal.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/confirmed.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('confirmed')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$proposals_confirmed}}
        </span>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href='{{ route('proposal.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('pending')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$proposals_pending}}</span>
    </div>
</div>
<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_canceled cursor-pointer" onclick="location.href='{{ route('proposal.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/canceled.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('canceled')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$proposals_canceled}}</span>
    </div>
</div>
        {{-- Booking --}}
<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_pending" href="{{ route('booking.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/pending.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('dashboard.bookings_count')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$bookings }}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_confirmed" href="{{ route('booking.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/confirmed.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('confirmed')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$bookings_confirmed}}
        </span>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href='{{ route('booking.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('pending')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$bookings_pending}}</span>
    </div>
</div>
<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_canceled cursor-pointer" onclick="location.href='{{ route('booking.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/canceled.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('canceled')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$bookings_canceled}}</span>
    </div>
</div>

{{-- Agreements --}}
<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_pending" href="{{ route('agreement.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/pending.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('dashboard.agreements_count')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$agreements }}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <a class="order-stats order-stats_confirmed" href="{{ route('agreement.index') }}">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/confirmed.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('confirmed')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$agreements_confirmed}}
        </span>
    </a>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href='{{ route('agreement.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('pending')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$agreements_pending}}</span>
    </div>
</div>
<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_canceled cursor-pointer" onclick="location.href='{{ route('agreement.index') }}'">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/canceled.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('canceled')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$agreements_canceled}}</span>
    </div>
</div>


{{--
<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_packaging" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/packaging.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('packaging')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['processing'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_out-for-delivery" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/out-of-delivery.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('out_for_delivery')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['out_for_delivery'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>



<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_delivered cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/delivered.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('delivered')}}</h6>
        </div>
        <span class="order-stats__title">{{$data['delivered'] ?? "Es"}}</span>
    </div>
</div>



<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('returned')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$data['returned'] ?? "Es"}}</span>
    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_failed cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/assets/back-end/img/failed-to-deliver.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('failed_to_delivery')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$data['failed'] ?? "Es"}}</span>
    </div>
</div> --}}
