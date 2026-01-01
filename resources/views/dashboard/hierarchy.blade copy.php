 
    @extends('layouts.back-end.app')

    @section('title', __('general.hierarchy'))
    @php
                $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();
            $lang = session()->get('locale');
    @endphp
    @push('css_or_js')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .list-container {
            max-width: 800px;
            margin: 50px auto;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            border: none;
            border-bottom: 1px dashed #ddd;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }
        .list-group-item:hover {
            background-color: #f1f1f1;
        }
        .arrow {
            font-size: 14px;
            color: #bbb;
        }
    </style>
    @endpush
    
    @section('content')
<div class="container list-container">
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="list-group-item">Region <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Country <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Company Master <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Outlet Master <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Counter Master <span class="arrow">&rsaquo;</span></a>
        </div>
        <div class="col-md-6">
            <a href="#" class="list-group-item">Store Master <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Zone Master <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Rack Master <span class="arrow">&rsaquo;</span></a>
            <a href="#" class="list-group-item">Bin Master <span class="arrow">&rsaquo;</span></a>
        </div>
    </div>
</div>

@endsection
