@extends('super_admin.layouts.app') 
@section('title')
    {{ __('roles.schedules_list') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ __('companies.all_companies') }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{ __('roles.schedules_list') }}
            </h2>
        </div>
        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input class="bulk_check_all" type="checkbox" /></th>
                                        <th>@lang('companies.company_id')</th>
                                        <th>@lang('companies.company_applicable_date')</th>
                                        <th>{{ __('roles.User_Count') }}</th>
                                        <th>@lang('companies.monthly_subscription_user')</th>
                                        <th>{{ __('companies.units_count') }}</th>
                                        <th>@lang('companies.monthly_subscription_units')</th>
                                        <th>{{ __('companies.buildings_count') }}</th>
                                        <th>{{ __('companies.monthly_subscription_building') }}</th>
                                        <th>@lang('companies.branches_count')</th>
                                        <th>@lang('companies.monthly_subscription_branches')</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($schedules as $key => $schedule_item)
                                        <tr>

                                            <td>
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                    value="{{ $schedule_item->id }}" />
                                                {{ $schedules->firstItem() + $key }}
                                            </td>
                                            <td class="text-center">{{ $schedule_item->company_id }}</td>
                                            <td class="text-center">{{ $schedule_item->company_applicable_date }}</td>
                                            <td class="text-center">{{ $schedule_item->user_count }}</td>  
                                            <td class="text-center">{{ $schedule_item->monthly_subscription_user }}</td>  
                                            <td class="text-center">{{ $schedule_item->units_count }}</td>  
                                            <td class="text-center">{{ $schedule_item->monthly_subscription_units }}</td>  
                                            <td class="text-center">{{ $schedule_item->building_count }}</td>  
                                            <td class="text-center">{{ $schedule_item->monthly_subscription_building }}</td>  
                                            <td class="text-center">{{ $schedule_item->branches_count }}</td>  
                                            <td class="text-center">{{ $schedule_item->monthly_subscription_branches }}</td>  
                                            
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $schedules->links() }}
                        </div>
                    </div>
                    @if (count($schedules) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
