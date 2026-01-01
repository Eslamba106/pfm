@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp
@section('title', __('roles.schedules_list'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{ __('roles.schedules_list') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('roles.schedules_list') }}
                    </div>
                    <div style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ __('general.sl') }}</th> 
                                        <th class="text-center">{{ __('property_master.asset') }} </th>
                                        <th class="text-center">{{ __('Date') }} </th>
                                        <th class="text-center">{{ __('property_master.supplier_name') }} </th> 
                                        <th class="text-center">{{ __('roles.status') }} </th> 
                                        {{-- <th class="text-center">{{ __('general.actions') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>  
                                            <td class="text-center">{{ $item->asset->name }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ $item->amc->name }}</td>
                                            <td class="text-center">{{ $item->status }}</td>

                                             
                                            {{-- <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('asset.schedule' ,$item->id ) }}"
                                                        class="btn btn-outline-warning btn-sm"
                                                        title="@lang('roles.schedules_list')">
                                                        <i class="fa fa-history"></i>
                                                    </a>
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('asset.edit', $item->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $item['id'] }}">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {!! $schedules->links() !!}
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
    <script>
        flatpickr("#purchase_date_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#warranty_expiry_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#from_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#to_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
    </script>
      <script>
        function filterUnits() {
            const buildingSelect = document.getElementById('report_building');
            const unitSelect = document.getElementById('report_unit_management');
            const selectedBuildingId = buildingSelect.value;

            if (selectedBuildingId !== "-1") {
                unitSelect.disabled = false;

                unitSelect.querySelectorAll("option").forEach(option => {
                    option.hidden = option.value !== "-1" && option.getAttribute('data-building') !==
                        selectedBuildingId;
                });

            } else {
                unitSelect.disabled = true;
                unitSelect.querySelectorAll("option").forEach(option => {
                    option.hidden = false;
                });
            }
        }
    </script>
    <script>
        // function amc(){

        // }
        $(document).ready(function() {
            $(".amc_status").change(function() {
                let status = $(this).val();
                if (status === 'yes') {
                    $(".amc_status_html").removeClass('d-none');
                } else {
                    $(".amc_status_html").addClass('d-none');
                }
            });
            $(".warranty").change(function() {
                let status = $(this).val();
                if (status === 'yes') {
                    $(".warranty_html").removeClass('d-none');
                } else {
                    $(".warranty_html").addClass('d-none');
                }
            });
        });

        // });


        // $(".tenant_form").addClass('d-none');
        // $(this).addClass('active');

        // let form_id = this.id;
        // console.log(form_id)
        // if (form_id === 'personal-link') {
        //     $("#personal-form").removeClass('d-none').addClass('active');
        //     $("#company-form").removeClass('active').addClass('d-none');
        // } else if (form_id === 'company-link') {
        //     $("#company-form").removeClass('d-none').addClass('active');
        //     $("#personal-form").removeClass('active').addClass('d-none');
        // }

        // });
    </script>

@endpush
@push('script')
