@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('collections.groups'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    {{-- <style>
        .ledger-list {
            list-style-type: none;
            padding-left: 0;
        }

        .ledger-list li {
            padding: 5px 10px;
            border-bottom: 1px solid #ddd;
            position: relative;
        }

        .toggle-btn {
            cursor: pointer;
            font-weight: bold;
            margin-right: 5px;
            color: #007bff;
            user-select: none;
        }

        .toggle-btn:hover {
            color: #0056b3;
        }

        .no-toggle {
            color: #ccc;
            margin-right: 5px;
        }

        .sub-group {
            list-style-type: none;
            padding-left: 20px;
            margin-top: 5px;
            border-left: 2px solid #ddd;
        }
    </style> --}}
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">

                {{ __('collections.chart_of_account') }}
            </h2>

        </div>

        @include('admin-views.inline_menu.accounts_master.inline-menu')

        <div class="accordion" id="accordionExample">
            @foreach ($groups as $group)
                @if ($group->ledgers->isNotEmpty() || $group->sub_groups->isNotEmpty())
                    @php $groupId = 'group-' . $group->id; @endphp
                    <div class="accordion-item">
                        <h4 class="accordion-header" id="heading-{{ $groupId }}">
                            <a href="{{ route('groups.show' , $group->id) }}" class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $groupId }}" aria-expanded="false"
                                aria-controls="collapse-{{ $groupId }}">+ {{ $group->name }} <span  style="color: gray;"> ({{ str_pad($group->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('groups.show' , $group->id) }}">{{ __('collections.show_group') }}</a> | <a href="{{ route('groups.edit' , $group->id) }}">{{ __('collections.edit_group') }}</a></span>  </a>
                        </h4>
                        <div id="collapse-{{ $groupId }}" class="accordion-collapse collapse"
                            aria-labelledby="heading-{{ $groupId }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                {{-- عرض الـ Ledgers داخل الـ Group --}}
                                @if ($group->ledgers->isNotEmpty())
                                    <ul>
                                        @foreach ($group->ledgers as $ledger)
                                            <li><h4><a href="{{ route('ledgers.show' , $ledger->id) }}">{{ $ledger->name }} <span  style="color: red;"> ({{ str_pad($ledger->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('ledgers.show' , $ledger->id) }}">{{ __('collections.show_ledger') }}</a> | <a href="{{ route('ledgers.edit' , $ledger->id) }}">{{ __('collections.edit_ledger') }}</a></span></a></h4></li>
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- عرض الـ Subgroups داخل الـ Group --}}
                                @foreach ($group->sub_groups as $sub_group)
                                    @php $subGroupId = 'subgroup-' . $sub_group->id; @endphp
                                    <div class="accordion-item">
                                        <h4 class="accordion-header" id="heading-{{ $subGroupId }}">
                                            <a href="{{ route('groups.show' , $sub_group->id) }}" class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $subGroupId }}" aria-expanded="false"
                                                aria-controls="collapse-{{ $subGroupId }}">&nbsp;&nbsp;&nbsp;+
                                                {{ $sub_group->name }} <span  style="color: gray;"> ({{ str_pad($sub_group->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('groups.show' , $sub_group->id) }}">{{ __('collections.show_group') }}</a> | <a href="{{ route('groups.edit' , $sub_group->id) }}">{{ __('collections.edit_group') }}</a></span></a>
                                        </h4>
                                        <div id="collapse-{{ $subGroupId }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading-{{ $subGroupId }}">
                                            <div class="accordion-body">
 
                                                @if ($sub_group->ledgers->isNotEmpty())
                                                    <ul>
                                                        @foreach ($sub_group->ledgers as $ledger)
                                                            <li> <h4><a href="{{ route('ledgers.show' , $ledger->id) }}">{{ $ledger->name }} <span  style="color: red;"> ({{ str_pad($ledger->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('ledgers.show' , $ledger->id) }}">{{ __('collections.show_ledger') }}</a> | <a href="{{ route('ledgers.edit' , $ledger->id) }}">{{ __('collections.edit_ledger') }}</a></span></a></h4></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @foreach ($sub_group->sub_groups as $sub_sub_group)
                                                    @php $subGroupId = 'subgroup-' . $sub_sub_group->id; @endphp
                                                    <div class="accordion-item">
                                                        <h4 class="accordion-header" id="heading-{{ $subGroupId }}">
                                                            <a class="accordion-button collapsed" href="{{ route('groups.show' , $sub_sub_group->id) }}" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse-{{ $subGroupId }}"
                                                                aria-expanded="false"
                                                                aria-controls="collapse-{{ $subGroupId }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
                                                                {{ $sub_sub_group->name }} <span  style="color: gray;"> ({{ str_pad($sub_sub_group->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('groups.show' , $sub_sub_group->id) }}">{{ __('collections.show_group') }}</a> | <a href="{{ route('groups.edit' , $sub_sub_group->id) }}">{{ __('collections.edit_group') }}</a></span></a>
                                                        </h4>
                                                        <div id="collapse-{{ $subGroupId }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="heading-{{ $subGroupId }}">
                                                            <div class="accordion-body"> 
                                                                @if ($sub_sub_group->ledgers->isNotEmpty())
                                                                    <ul>
                                                                        @foreach ($sub_sub_group->ledgers as $ledger)
                                                                            <li><h4><a href="{{ route('ledgers.show' , $ledger->id) }}"> {{ $ledger->name }}  <span  style="color: red;"> {{--  ({{ str_pad($ledger->code, 3, '0', STR_PAD_LEFT) }}) --}}  <a href="{{ route('ledgers.show' , $ledger->id) }}"> | {{ __('collections.show_ledger') }}</a> | <a href="{{ route('ledgers.edit' , $ledger->id) }}">{{ __('collections.edit_ledger') }}</a></span></a></h4></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <h4><a href="{{ route('groups.show' , $group->id) }}" class="" type="button">{{ $group->name }} <span  style="color: gray;"> ({{ str_pad($group->code, 3, '0', STR_PAD_LEFT) }}) | <a href="{{ route('groups.show' , $group->id) }}">{{ __('collections.show_group') }}</a> | <a href="{{ route('groups.edit' , $group->id) }}">{{ __('collections.edit_group') }}</a></span> </a></h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>





    </div>
@endsection

@push('script')
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endpush

