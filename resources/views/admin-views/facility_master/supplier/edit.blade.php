@extends('layouts.back-end.app')
@section('title', ui_change('edit_supplier','facility_master')  )
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
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/countries.jpg') }}" alt=""> --}}
                {{ ui_change('edit_supplier','facility_master')  }}
            </h2>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('edit_supplier','facility_master') }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="code" class="title-color">{{ ui_change('code','facility_master') }} <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="code" class="form-control"  value="{{ $supplier->code }}" >
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('name','facility_master')  }} <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="name" class="form-control"  value="{{ $supplier->name }}" >
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_contact_no"
                                            class="title-color">{{ ui_change('dail_code','facility_master')  }}
                                        </label>
                                        <input type="text" name="dail_code_contact_no"  value="{{ $supplier->dail_code_contact_no }}" class="form-control" >
                                    </div>
                                    @error('dail_code_contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="contact_no" class="title-color">{{ ui_change('contact_no','facility_master')  }}
                                        </label>
                                        <input type="text" name="contact_no"  value="{{ $supplier->contact_no }}" class="form-control" >
                                    </div>
                                    @error('contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_whatsapp_no"
                                            class="title-color">{{ ui_change('dail_code','facility_master')  }}
                                        </label>
                                        <input type="text" name="dail_code_whatsapp_no"  value="{{ $supplier->dail_code_whatsapp_no }}" class="form-control" >
                                    </div>
                                    @error('dail_code_whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="whatsapp_no"
                                            class="title-color">{{ ui_change('whatsapp_no','facility_master')  }}
                                        </label>
                                        <input type="text" name="whatsapp_no"  value="{{ $supplier->whatsapp_no }}" class="form-control" >
                                    </div>
                                    @error('whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address1" class="title-color">{{ ui_change('address1','facility_master')  }}
                                        </label>
                                        <textarea name="address1" class="form-control" cols="30" rows="2">{{ $supplier->address1 }}</textarea>
                                    </div>
                                    @error('address1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address2" class="title-color">{{ ui_change('address2','facility_master') }}
                                        </label>
                                        <textarea name="address2" class="form-control" cols="30" rows="2">{{ $supplier->address1 }}</textarea>
                                    </div>
                                    @error('address2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="city" class="title-color">{{ ui_change('city','facility_master')  }}
                                        </label>
                                        <input type="text" name="city"  value="{{ $supplier->city }}" class="form-control" >
                                    </div>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="state" class="title-color">{{ ui_change('state','facility_master')  }}
                                        </label>
                                        <input type="text" name="state"  value="{{ $supplier->state }}" class="form-control" >
                                    </div>
                                    @error('state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="country" class="title-color">{{ ui_change('country','facility_master')  }}
                                        </label>
                                        <input type="text" name="country"  value="{{ $supplier->country }}" class="form-control" >
                                    </div>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group"> {{-- property_management.contact_person --}}
                                        <label for="contact_person"
                                            class="title-color">{{ ui_change('contact_person','facility_master')  }}
                                        </label>
                                        <input type="text" name="contact_person"  value="{{ $supplier->contact_person }}" class="form-control" >
                                    </div>
                                    @error('contact_person')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('taxability','facility_master')  }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="tax_registration" required>
                                            <option value="2" {{ 2 == $supplier->tax_registration ? 'selected' : '' }}>{{ ui_change('no','facility_master')  }}</option>
                                            <option value="1" {{ 1 == $supplier->tax_registration ? 'selected' : '' }}>{{ ui_change('yes','facility_master')  }}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3  {{ 1 == $supplier->tax_registration ? '' : 'd-none' }}  tax_status_html ">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('vat_no','facility_master') }}
                                        </label>
                                        <input type="text" name="vat_no" class="form-control" value="{{ $supplier->vat_no }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ ui_change('reset','facility_master')  }}</button>
                                <button type="submit" class="btn btn--primary">{{ ui_change('submit','facility_master')  }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>


    @endsection
@push('script')
<script>
    $(document).ready(function() {
        $('select[name="tax_registration"]').on('change', function() {
            let status = $(this).val();
            if (status == 1) {
                $(".tax_status_html").removeClass('d-none');
            } else {
                $(".tax_status_html").addClass('d-none');
            }
        });
    });
</script>
@endpush