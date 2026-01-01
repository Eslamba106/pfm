@extends('super_admin.layouts.app')
@section('title')
    {{ ui_change('schema') }}
@endsection
@php
    $lang = session()->get('locale');
@endphp
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ ui_change('schema') }}
            </h2>
        </div>


        <div class="mb-5"></div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <form id="signature-form" action="{{ route('admin.schema.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- general setup -->
                <div class="card mt-3 rest-part">
                    <div class="card-header">
                        <div class="d-flex gap-2">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('name') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_charge" class="title-color">{{ ui_change('user_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_charge" step="0.01"
                                        value="{{ old('user_charge') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_count_from" class="title-color">{{ ui_change('user_count_from') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_count_from"
                                        step="0.01" value="{{ old('user_count_from') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_count_to" class="title-color">{{ ui_change('user_count_to') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_count_to" step="0.01"
                                        value="{{ old('user_count_to') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_charge" class="title-color">{{ ui_change('unit_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_charge" step="0.01"
                                        value="{{ old('unit_charge') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_count_from" class="title-color">{{ ui_change('unit_count_from') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_count_from"
                                        step="0.01" value="{{ old('unit_count_from') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_count_to" class="title-color">{{ ui_change('unit_count_to') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_count_to" step="0.01"
                                        value="{{ old('unit_count_to') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_charge" class="title-color">{{ ui_change('building_charge') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_charge"
                                        step="0.01" value="{{ old('building_charge') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_count_from"
                                        class="title-color">{{ ui_change('building_count_from') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_count_from"
                                        step="0.01" value="{{ old('building_count_from') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_count_to"
                                        class="title-color">{{ ui_change('building_count_to') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_count_to"
                                        step="0.01" value="{{ old('building_count_to') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_charge" class="title-color">{{ ui_change('branch_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_charge"
                                        step="0.01" value="{{ old('branch_charge') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_count_from"
                                        class="title-color">{{ ui_change('branch_count_from') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_count_from"
                                        step="0.01" value="{{ old('branch_count_from') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_count_to" class="title-color">{{ ui_change('branch_count_to') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_count_to"
                                        step="0.01" value="{{ old('branch_count_to') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="setup_cost" class="title-color">{{ ui_change('setup_cost') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="setup_cost"
                                        step="0.01" value="{{ old('setup_cost') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="schema_applicable_date"
                                        class="title-color">{{ ui_change('schema_applicable_date') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control schema_applicable_date"
                                        id="schema_applicable_date" name="schema_applicable_date"
                                        value="{{ old('schema_applicable_date') }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="schema_end_date" class="title-color">{{ ui_change('schema_end_date') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control schema_end_date" id="schema_end_date"
                                        name="schema_end_date" value="{{ old('schema_end_date') }}">
                                </div>
                            </div>

                            {{-- <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('name') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_charge" class="title-color">{{ ui_change('user_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_charge"  step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_count_from" class="title-color">{{ ui_change('user_count_from') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_count_from">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="user_count_to" class="title-color">{{ ui_change('user_count_to') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="user_count_to">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_charge" class="title-color">{{ ui_change('unit_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_charge">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_count_from" class="title-color">{{ ui_change('unit_count_from') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_count_from">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="unit_count_to" class="title-color">{{ ui_change('unit_count_to') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="unit_count_to">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_charge" class="title-color">{{ ui_change('building_charge') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_charge">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_count_from"
                                        class="title-color">{{ ui_change('building_count_from') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_count_from">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="building_count_to" class="title-color">{{ ui_change('building_count_to') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="building_count_to">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_charge" class="title-color">{{ ui_change('branch_charge') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_charge">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_count_from"
                                        class="title-color">{{ ui_change('branch_count_from') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_count_from">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="branch_count_to" class="title-color">{{ ui_change('branch_count_to') }}
                                        <span class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="branch_count_to">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="setup_coust" class="title-color">{{ ui_change('setup_coust') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="number" class="form-control" required name="setup_coust">
                                </div>
                            </div>



                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ ui_change('schema_applicable_date') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control schema_applicable_date"
                                        id="schema_applicable_date"  name="schema_applicable_date">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('schema_end_date') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control schema_end_date" id="schema_end_date"
                                       name="schema_applicable_date">
                                </div>
                            </div> --}}
                            {{-- value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schema->schema_end_date)->format('d/m/Y') ?? \Carbon\Carbon::now()->format('d/m/Y')  }}" --}}
                            {{-- value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schema->schema_applicable_date)->format('d/m/Y') ?? \Carbon\Carbon::now()->format('d/m/Y')  }}" --}}
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="name" class="title-color">{{ ui_change('Display') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <div class="input-group">

                                    <input type="radio" name="display" class="mr-3 ml-3" checked value="active">
                                    <label class="title-color" for="display">
                                        {{ ui_change('display') }}
                                    </label>
                                    <input type="radio" name="display" class="mr-3 ml-3" value="inactive">
                                    <label class="title-color" for="display">
                                        {{ ui_change('hide') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="name" class="title-color">{{ ui_change('Status') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <div class="input-group">

                                    <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                    <label class="title-color" for="status">
                                        {{ ui_change('active') }}
                                    </label>
                                    <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
                                    <label class="title-color" for="status">
                                        {{ ui_change('inactive') }}
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="input-group">
                                <input type="radio" name="status" class="mr-3 ml-3"
                                    {{ isset($main->status) && $main->status == 'active' ? 'checked' : '' }}
                                    {{ !isset($main->status) ? 'checked' : '' }} value="active">
                                <label class="title-color" for="status">
                                    {{ ui_change('active', 'property_master') }}
                                </label>
                                <input type="radio" name="status" class="mr-3 ml-3"
                                    {{ isset($main->status) && $main->status == 'inactive' ? 'checked' : '' }}
                                    value="inactive">
                                <label class="title-color" for="status">
                                    {{ ui_change('inactive', 'property_master') }}
                                </label>

                            </div> --}}

                        </div>

                    </div>
                </div>

                <div class="row justify-content-end gap-3 mt-3 mx-1">
                    <button type="submit" class="btn btn--primary px-5">{{ ui_change('save') }}</button>
                </div>
            </form>
        </div>
    </div>


    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
@push('script')
    </script>
    <script>
        flatpickr("#schema_applicable_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#schema_end_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
    </script>
@endpush
