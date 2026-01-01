@php
    $host = request()->getHost();
    $parts = explode('.', $host);

    if (count($parts) > 1 && $parts[0] != 'pfm.finexerp.com') {
        $company_id = $parts[0];
    } else {
        $company_id = null;
    }
@endphp
{{-- @php
    $host = request()->getHost();  
    $parts = explode('.', $host); 
    if ($host === 'pfm.finexerp.com') {
        $company_id = null;
    } else { 
        $company_id = $parts[0];
    }
@endphp --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('login.login') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/finexerp_logo.png') }}">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/back-end/css/vendor.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/back-end/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-d...">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back-end/css/toastr.css') }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #f6f7f9, #e9eaea);
            height: 100vh;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            height: 100vh;
        }

        .image-section {
            flex: 2;
            max-width: 1000px;
            /* max-height: 640px; */
            background: #1d1717;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #f9f9f9;
        }


        .form-section h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .form-section p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-size: 14px;
            margin-bottom: 1px;
        }

        form input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
        }

        .password-input input {
            border-radius: 20px;
        }

        .submit-btn {
            padding: 10px 20px;
            background: #f1c40f;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 20px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        /* form input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
*/
        .password-input {
            display: flex;
            align-items: center;
        }

        .password-input input {
            flex: 1;
        }

        .password-input .toggle-password {
            background: none;
            border: none;
            margin-left: 10px;
            cursor: pointer;
        }

        /* .submit-btn {
            padding: 10px 20px;
            background: #f1c40f;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 20px;
        } */

        .social-buttons button {
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-right: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .footer-text {
            font-size: 12px;
            margin-top: 20px;
        }

        .footer-text a {
            text-decoration: none;
            color: #3498db;
        }


        .image-section img {
            width: 100%;
            height: auto;
            /* object-fit: cover; */
        }

        .schedule {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .schedule .task,
        .schedule .calendar {
            margin-bottom: 10px;
        }

        .schedule p {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }

        .schedule span {
            font-size: 12px;
            color: #555;
        }

        @media (max-width: 768px) {
            .image-section {
                display: none;
            }

            .form-section {
                flex: 1;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-section">
            <img class="z-index-2" width="250px" height="107px" src="{{ asset('assets/finexerp_logo.png') }}"
                alt="Team Meeting">
            <div class="card-body">
                <ul class="nav nav-tabs w-fit-content mb-2">
                    @if ($company_id != null)
                        <li class="nav-item">
                            <a class="nav-link type_link @if ($company_id != null) active @endif" href="#"
                                id="company-link">{{ ui_change('company', 'auth') }}</a>
                        </li>
                    @endif
                    @if ($company_id == null)
                        <li class="nav-item">
                            <a class="nav-link type_link @if ($company_id == null) active @endif" href="#"
                                id="admin-link">{{ ui_change('admin', 'auth') }}</a>
                        </li>
                    @endif
                    @if ($company_id != null)
                        <li class="nav-item">
                            <a class="nav-link type_link  " href="#"
                                id="employee-link">{{ ui_change('employee', 'auth') }}</a>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
                        <a class="nav-link  " href="{{ route('register_page') }}" >{{ ui_change('register' ,'auth') }}</a>
                    </li> --}}
                </ul>

                @if ($company_id == null)
                    <div class="col-md-12 admin_form @if ($company_id != null) d-none @endif admin-form"
                        id="admin-form">
                        <form action="{{ route('admin.login') }}" method="post">
                            @csrf
                            @include('includes.auth.admin_login')


                        </form>
                    </div>
                @endif
                @if ($company_id != null)
                    <div class="col-md-12 admin_form @if ($company_id == null) d-none @endif company-form"
                        id="company-form">
                        <form action="{{ route('company.auth.login') }}" method="post">
                            @csrf
                            @include('includes.auth.company_login')
                        </form>
                    </div>
                @endif
                @if ($company_id != null)
                    <div class="col-md-12 admin_form employee-form d-none " id="employee-form">
                        <form action="{{ route('employee_login') }}" method="post">
                            @csrf
                            @include('includes.auth.employee_login')
                        </form>
                    </div>
                @endif
                @if ($company_id == null)
                    <a class="  "
                        href="{{ route('register_page') }}">{{ ui_change('you_dont_have_account_?_register_now', 'auth') }}</a>
                @endif
            </div>


        </div>

        <div class="image-section">

            <img style="width: 100%; height: 100%; " src="{{ asset('assets/new_logo.png') }}" alt="Team Meeting">
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
    @if (Session::has('error'))
        <script>
            swal("Message", "{{ Session::get('error') }}", 'error', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    <script src="{{ asset('assets/back-end') }}/js/vendor.min.js"></script>
    <script src="{{ asset('assets/back-end') }}/js/sweet_alert.js"></script>

    <script src="{{ asset('assets/back-end') }}/js/toastr.js"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <script>
        $(".type_link").click(function(e) {
            e.preventDefault();
            $(".type_link").removeClass('active');
            $(".login_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            if (form_id === 'company-link') {
                $("#company-form").removeClass('d-none').addClass('active');
                $("#admin-form").removeClass('active').addClass('d-none');
                $("#employee-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'admin-link') {
                $("#admin-form").removeClass('d-none').addClass('active');
                $("#company-form").removeClass('active').addClass('d-none');
                $("#employee-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'employee-link') {
                $("#employee-form").removeClass('d-none').addClass('active');
                $("#admin-form").removeClass('active').addClass('d-none');
                $("#company-form").removeClass('active').addClass('d-none');
            }

        });
    </script>
</body>

</html>
