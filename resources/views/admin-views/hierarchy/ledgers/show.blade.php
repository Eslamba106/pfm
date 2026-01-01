@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
        $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();

@endphp
@section('title', __('collections.ledger'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                {{ __('collections.ledger') }}
            </h2>

        </div>

        <div class="row mt-20">
            <div class="col-md-12">
                <div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0 ">{{ __('collections.show_ledger') . ' ' . $ledger->name }}</h3>
                                <div>
                                    <a class="btn btn--primary"
                                        href="{{ route('ledgers.edit', ['id' => $ledger['id']]) }}">{{ __('collections.edit_ledger') }}</a>
                                     
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="width30">{{ __('roles.name') }}</td>
                                            <td>{{ $ledger->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('property_master.code') }}</td>
                                            <td>{{ $ledger->code ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('collections.display_name') }}</td>
                                            <td>{{ $ledger->display_name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('collections.nature') }}</td>
                                            <td>{{ $ledger->nature ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ ui_change('debit' , 'hierarchy') }}</td>
                                            <td>{{ $ledger->debit ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ ui_change('credit' , 'hierarchy') }}</td>
                                            <td>{{ $ledger->credit ?? '#' }}</td>
                                        </tr>
                                         
 
                                    </thead>
                                </table>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>


    
@endsection

@push('script')
    <script>
        flatpickr("#vat_applicable_from", {
            dateFormat: "d/m/Y",
        });
    </script>
   
@endpush
