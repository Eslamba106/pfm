<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ui_change('Schemas') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: "Segoe UI", sans-serif;
 
             height: 100vh;
             display: flex;
             justify-content: center;
             align-items: center;
             padding: 10px;
             background: linear-gradient(135deg, #71b7e6, #9b59b6);
         }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .pricing-green {
            color: #28a745;
            font-weight: bold;
        }

        .btn-neutral {
            background-color: #f1f3f4;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-neutral:hover {
            background-color: #e2e6ea;
        }

        .alert {
            border-radius: 12px;
        }

        .fa-check-circle {
            margin-right: 5px;
        }
    </style>
     <link rel="stylesheet" href="{{ asset('assets/back-end/vendor/icon-set/style.css') }}">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/style.css') }}">
</head>

<body>

    <div class="container py-5">
        <div class="row">
            @if (Session::has('saas_error'))
                <div class="col-sm-12 mb-3">
                    <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="fa fa-info-circle"></i></span>
                        <span class="alert-text"><strong>{{ __('!Opps ') }}</strong>
                            {{ Session::get('saas_error') }}</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @foreach ($schema as $schema)
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h2 class="pricing--primary">{{ $schema->name }}</h2>
                            <h1>{{ $schema->price }}</h1>
                            <p class="text-muted">
                                {{ ui_change('Per_Month') }}
                            </p>
                            <hr>
                            <div class="text-start">
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>
                                    {{ ui_change('user_charge').' : '. number_format($schema->user_charge , 3) }}
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>
                                    {{ ui_change('user_count').' : '. $schema->user_count_to }} 
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i> 
                                    {{ ui_change('building_charge').' : '. number_format($schema->building_charge,3) }} 
                                    
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>  
                                    {{ ui_change('building_count').' : '. $schema->building_count_to }}  
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>   
                                    {{ ui_change('units_charge').' : '. number_format($schema->unit_charge,3) }} 
                                    
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>    
                                    {{ ui_change('units_count').' : '. $schema->unit_count_to }} 
                                    
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>     
                                    {{ ui_change('branches_charge').' : '. number_format($schema->branch_charge,3) }}  
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>      
                                    {{ ui_change('branches_count').' : '. $schema->branch_count_to }}  
                                </div>
                                <div class="mt-2">  
                                    <i class="far text--primary fa-check-circle"></i>       
                                    {{ ui_change('setup_cost').' : '. number_format($schema->setup_cost,3) }}  
                                </div>
                                {{-- @foreach ($plan->data ?? [] as $key => $data)
                                <div class="mt-2">
                                    @if (planData($key, $data)['is_bool'] == true)
                                        @if (planData($key, $data)['value'] == true)
                                            <i class="far text--primary fa-check-circle"></i>
                                        @else
                                            <i class="fas text-danger fa-times-circle"></i>
                                        @endif
                                    @else
                                        <i class="far text--primary fa-check-circle"></i>
                                    @endif
                                    {{ str_replace('_', ' ', planData($key, $data)['title']) }}
                                </div>
                            @endforeach --}}
                            </div>
                            <hr>
                            <a class="btn btn-neutral w-100" href="{{ route('register_second_page', $schema->id ) }}">
                                <i class="fa fa-check "></i>
                                {{-- <i class="{{ Auth::user()->plan_id == $plan->id ? 'fa fa-check' : 'fa fa-plus-circle' }}"></i> --}}
                                {{-- {{ Auth::user()->plan_id == $plan->id ? __('Activated') : __('Subscribe') }} --}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
