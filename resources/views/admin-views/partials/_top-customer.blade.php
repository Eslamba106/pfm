<!-- Header -->
<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="{{asset('/assets/back-end/img/top-customers.png')}}" alt="">
        {{ui_change('last_Tenant' ,'dashboard')}}
    </h4>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    @if($top_customer)
    {{-- {{ dd($top_customer) }} --}}
        <div class="grid-card-wrap">
            @foreach($top_customer as $key => $item)
                @if(isset($item->name))
                    <div class="cursor-pointer"
                         onclick="location.href=''">
                        <div class="grid-card basic-box-shadow">
                            <div class="text-center">
                                <img class="avatar rounded-circle avatar-lg"
                                     {{-- onerror="this.src='{{asset('assets/back-end/img/160x160/img1.jpg')}}'" --}}
                                     src="{{asset('assets/back-end/img/160x160/img1.jpg')}}">
                            </div>

                            <h5 class="mb-0">{{$item->name??'Not exist'}}</h5>

                            <div class="orders-count d-flex gap-1">
                                {{-- <div>{{__('dashboard.total_agreements')}} : </div> --}}
                                {{-- <div>{{ isset($item->agreements) && is_countable($item->agreements) ? count($item->agreements) : 11 }}</div> --}}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="cursor-pointer"
                         onclick="location.href=''">
                        <div class="grid-card basic-box-shadow">
                            <div class="text-center">
                                <img class="avatar rounded-circle avatar-lg"
                                     {{-- onerror="this.src='{{asset('assets/back-end/img/160x160/img1.jpg')}}'" --}}
                                     src="{{asset('assets/back-end/img/160x160/img1.jpg')}}">
                            </div>

                            <h5 class="mb-0">{{$item->name??'Not exist'}}</h5>

                            <div class="orders-count d-flex gap-1">
                                <div>{{ui_change('total_agreements','dashboard')}} : </div>
                                <div>0</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center">
            <p class="text-muted">{{ui_change('no_Top_Selling_Products','dashboard')}}</p>
            <img class="w-75" src="{{asset('/assets/back-end/img/no-data.png')}}" alt="">
        </div>
    @endif
</div>
<!-- End Body -->
