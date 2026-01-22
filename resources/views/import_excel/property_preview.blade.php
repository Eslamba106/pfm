@extends('layouts.back-end.app')
@section('title', ui_change('preview_excel'))

@section('content')
    <div class="content container-fluid">

        <div class="mb-4">
            <h2 class="h1 mb-1 text-capitalize d-flex gap-2">
                {{ ui_change('Import') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.import.inline-menu')

        <!-- Content Row -->
        {{-- <div class="row" style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"> --}}

        <form action="{{ route('import.confirm_property_master') }}" method="POST">
            @csrf
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0">{{ ui_change('Preview_Imported_Data') }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">

                        <table id="datatable"
                            style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }}; table-layout: fixed; width:100%;"
                            class="table table-striped table-bordered table-hover align-middle mb-0">

                            <thead class="bg-light text-capitalize sticky-top">
                                <tr>
                                    @foreach ($data[0] as $header)
                                        <th class="text-center fw-bold" style="width:150px; white-space:nowrap;">
                                            {{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                            <tbody>
                                @foreach ($data->skip(1) as $row)
                                    <tr>
                                        @foreach ($row as $value)
                                            <td class="text-center">
                                                {{ $value }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>

                            {{-- @foreach ($data->skip(1) as $rowIndex => $row)
                                    <tr>
                                        @foreach ($row as $colIndex => $value)
                                            @php $columnName = $data[0][$colIndex]; @endphp
                                            <td>
                                                <input type="text" name="rows[{{ $rowIndex + 1 }}][{{ $columnName }}]"
                                                    value="{{ $value }}" class="form-control text-center"
                                                    style="width:150px;">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>

                    </div>
                </div>



                <div class="card-footer d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary">
                        {{ ui_change('Confirm_&_Save') }}
                    </button>
                </div>
            </div>
        </form>
        <script>
            function resizeInput(input) {
                input.style.width = "1px";
                input.style.width = (input.scrollWidth + 10) + "px";
            }

            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".auto-resize").forEach(function(input) {
                    resizeInput(input);
                });
            });
        </script>


    </div>

@endsection
