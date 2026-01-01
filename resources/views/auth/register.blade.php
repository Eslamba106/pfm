 <!DOCTYPE html>
 <html lang="en" dir="ltr">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ ui_change('register', 'auth') }}</title>
     <link rel="shortcut icon" href="{{ asset('assets/finexerp_logo.png') }}">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

     <link rel="stylesheet" href="{{ asset('assets/back-end/css/select2.min.css') }}">
     <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: 'Poppins', sans-serif;
         }

         body {
             height: 100vh;
             display: flex;
             justify-content: center;
             align-items: center;
             padding: 10px;
             background: linear-gradient(135deg, #71b7e6, #9b59b6);
         }

         .container {
             max-width: 700px;
             width: 100%;
             background-color: #fff;
             padding: 25px 30px;
             border-radius: 5px;
             box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
         }

         .container .title {
             font-size: 25px;
             font-weight: 500;
             position: relative;
         }

         .container .title::before {
             content: "";
             position: absolute;
             left: 0;
             bottom: 0;
             height: 3px;
             width: 30px;
             border-radius: 5px;
             background: linear-gradient(135deg, #71b7e6, #9b59b6);
         }

         .content form .user-details {
             display: flex;
             flex-wrap: wrap;
             justify-content: space-between;
             margin: 20px 0 12px 0;
         }

         form .user-details .input-box {
             margin-bottom: 15px;
             width: calc(100% / 2 - 20px);
         }

         form .user-details .input-select-box {
             margin-bottom: 15px;
             width: calc(100% / 2 - 20px);
         }

         form .input-box span.details {
             display: block;
             font-weight: 500;
             margin-bottom: 5px;
         }

         .user-details .input-box input {
             height: 45px;
             width: 100%;
             outline: none;
             font-size: 16px;
             border-radius: 5px;
             padding-left: 15px;
             border: 1px solid #ccc;
             border-bottom-width: 2px;
             transition: all 0.3s ease;
         }

         .user-details .input-box input:focus,
         .user-details .input-box input:valid {
             border-color: #9b59b6;
         }

         form .gender-details .gender-title {
             font-size: 20px;
             font-weight: 500;
         }

         form .category {
             display: flex;
             width: 80%;
             margin: 14px 0;
             justify-content: space-between;
         }

         form .category label {
             display: flex;
             align-items: center;
             cursor: pointer;
         }

         form .category label .dot {
             height: 18px;
             width: 18px;
             border-radius: 50%;
             margin-right: 10px;
             background: #d9d9d9;
             border: 5px solid transparent;
             transition: all 0.3s ease;
         }

         #dot-1:checked~.category label .one,
         #dot-2:checked~.category label .two,
         #dot-3:checked~.category label .three {
             background: #9b59b6;
             border-color: #d9d9d9;
         }

         form input[type="radio"] {
             display: none;
         }

         form .button {
             height: 45px;
             margin: 35px 0
         }

         form .button input {
             height: 100%;
             width: 100%;
             border-radius: 5px;
             border: none;
             color: #fff;
             font-size: 18px;
             font-weight: 500;
             letter-spacing: 1px;
             cursor: pointer;
             transition: all 0.3s ease;
             background: linear-gradient(135deg, #71b7e6, #9b59b6);
         }

         form .button input:hover {
             background: linear-gradient(-135deg, #71b7e6, #9b59b6);
         }

         /* Responsive media query code for mobile devices */
         @media(max-width: 584px) {
             .container {
                 max-width: 100%;
             }

             form .user-details .input-box {
                 margin-bottom: 15px;
                 width: 100%;
             }

             form .category {
                 width: 100%;
             }

             .content form .user-details {
                 max-height: 300px;
                 overflow-y: scroll;
             }

             .user-details::-webkit-scrollbar {
                 width: 5px;
             }
         }

         /* Responsive media query code for mobile devices */
         @media(max-width: 459px) {
             .container .content .category {
                 flex-direction: column;
             }
         }

         /* .input-select-box {
             display: flex;
             flex-direction: column;
             margin-bottom: 15px;
         } */

         .input-select-box label {
             font-size: 14px;
             font-weight: 600;
             margin-bottom: 6px;
             color: #333;
         }

         .input-select-box select {
             height: 45px;
             width: 100%;
             outline: none;
             font-size: 16px;
             border-radius: 5px;
             padding-left: 15px;
             border: 1px solid #ccc;
             border-bottom-width: 2px;
             transition: all 0.3s ease;
         }

         .input-select-box select:focus {
             border-color: #9b59b6;
             box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
             outline: none;
         }
     </style>
 </head>

 <body>
     <div class="container">
         <!-- Title section -->
         <div class="title">{{ ui_change('registeration', 'auth') }}</div>
         <div class="content">
             <!-- Registration form -->
             <form action="{{ route('company_registration') }}" method="POST" autocomplete="off">
                 @csrf
                 <div class="user-details">
                     <!-- Input for Full Name -->
                     <input type="hidden" name="schema_id" value="{{ $schema->id ?? null }}">
                     <div class="input-box">
                         <span class="details">{{ ui_change('company_Name', 'auth') }}</span>
                         <input type="text" name="name"
                             placeholder="{{ ui_change('Enter_your_company_name', 'auth') }}" autocomplete="off"
                             required>
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Input for Username -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('users_Count', 'auth') }}</span>
                         <input type="number" name="user_count"
                             placeholder="{{ ui_change('Enter_your_users_count', 'auth') }}" autocomplete="off"
                             required
                             @if (isset($schema->user_count_to)) value="{{ $schema->user_count_to }}"
                             max="{{ $schema->user_count_to }}"
                             oninput="if(this.value > this.max) this.value = this.max;" @endif>
                         @error('user_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="input-box">
                         <span class="details">{{ ui_change('building_Count', 'auth') }}</span>
                         <input type="number" name="building_count"
                             placeholder="{{ ui_change('Enter_your_building_count', 'auth') }}" autocomplete="off"
                             required
                             @if (isset($schema->building_count_to)) value="{{ $schema->building_count_to }}"
                             max="{{ $schema->building_count_to }}"
                             oninput="if(this.value > this.max) this.value = this.max;" @endif>
                         @error('building_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="input-box">
                         <span class="details">{{ ui_change('units_Count', 'auth') }}</span>
                         <input type="number" name="units_count"
                             placeholder="{{ ui_change('Enter_your_units_count', 'auth') }}" autocomplete="off"
                             required
                             @if (isset($schema->unit_count_to)) value="{{ $schema->unit_count_to }}"
                             max="{{ $schema->unit_count_to }}"
                             oninput="if(this.value > this.max) this.value = this.max;" @endif>
                         @error('units_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="input-select-box">
                         <span for="country" class="title-color">{{ ui_change('Country', 'auth') }}</span>
                         <select class="js-select2-custom form-control" name="country" id="countrySelect"
                             autocomplete="off">
                             <option selected value="">{{ ui_change('Select_Country', 'auth') }}</option>
                             @foreach ($country as $country_item)
                                 <option value="{{ $country_item->id }}"
                                     data-dial="{{ $country_item->country?->dial_code }}">
                                     {{ $country_item->country?->name }}
                                 </option>
                             @endforeach
                         </select>
                     </div>

                     <div class="input-select-box">
                         <span for="phone_dial_code" class="title-color">{{ ui_change('dial_Code', 'auth') }}</span>
                         <select class="form-select js-select2-custom form-control" name="phone_dial_code"
                             id="dialCodeSelect" autocomplete="off">
                             <option selected value="">{{ ui_change('Select_Dial_Code', 'auth') }}</option>
                             @foreach ($dail_code_main as $item_dail_code)
                                 <option value="{{ '+' . $item_dail_code->dial_code }}">
                                     {{ '+' . $item_dail_code->dial_code }}
                                 </option>
                             @endforeach
                         </select>
                     </div>

                     <!-- Input for Phone Number -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('Phone', 'auth') }}</span>
                         <input type="text" name="phone"
                             placeholder="{{ ui_change('Enter_your_number', 'auth') }}" autocomplete="off" required>
                         @error('phone')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="input-box">
                         <span class="details">{{ ui_change('email', 'auth') }}</span>
                         <input type="text" name="email1" placeholder="{{ ui_change('Enter_your_email', 'auth') }}"
                             autocomplete="off" required>
                         @error('email1')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="input-box">
                         <span class="details">{{ ui_change('username', 'auth') }}</span>
                         <input type="text" name="username"
                             placeholder="{{ ui_change('Enter_your_username', 'auth') }}" autocomplete="off" required>
                         @error('username')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <!-- Input for Password -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('Password', 'auth') }}</span>
                         <input type="password" name="password"
                             placeholder="{{ ui_change('Enter_your_password', 'auth') }}" autocomplete="new-password"
                             required>
                         @error('password')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>

                 <!-- Submit button -->
                 <div class="button">
                     <input type="submit" value="Register">
                 </div>
             </form>

             {{-- <form action="{{ route('company_registration') }}" method="POST">
                 @csrf
                 <div class="user-details">
                     <!-- Input for Full Name -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('company_Name', 'auth') }}</span>
                         <input type="text" name="name"
                             placeholder="{{ ui_change('Enter_your_company_name', 'auth') }}" required>
                         @error('name')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <!-- Input for Username -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('users_Count', 'auth') }}</span>
                         <input type="number" name="user_count"
                             placeholder="{{ ui_change('Enter_your_users_count', 'auth') }}" required>
                         @error('user_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="input-box">
                         <span class="details">{{ ui_change('building_Count', 'auth') }}</span>
                         <input type="number" placeholder="{{ ui_change('Enter_your_building_count', 'auth') }}"
                             required name="building_count">
                         @error('building_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="input-box">
                         <span class="details">{{ ui_change('units_Count', 'auth') }}</span>
                         <input type="number" name="units_count"
                             placeholder="{{ ui_change('Enter_your_units_count', 'auth') }}" required>
                         @error('units_count')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                    
                     <div class="input-select-box">
                         <span for="country" class="title-color">{{ ui_change('Country', 'auth') }}</span>
                         <select class="js-select2-custom form-control" name="country" id="countrySelect">
                             <option selected value="">{{ ui_change('Select_Country', 'auth') }}</option>
                             @foreach ($country as $country_item)
                                 <option value="{{ $country_item->id }}"
                                     data-dial="{{ $country_item->country?->dial_code }}">
                                     {{ $country_item->country?->name }}
                                 </option>
                             @endforeach
                         </select>
                     </div>
                     <div class="input-select-box">
                         <span for="phone_dial_code" class="title-color">{{ ui_change('dial_Code', 'auth') }}</span>
                         <select class="form-select js-select2-custom form-control" name="phone_dial_code"
                             id="dialCodeSelect">
                             <option selected value="">{{ ui_change('Select_Dial_Code', 'auth') }}</option>
                             @foreach ($dail_code_main as $item_dail_code)
                                 <option value="{{ '+' . $item_dail_code->dial_code }}">
                                     {{ '+' . $item_dail_code->dial_code }}
                                 </option>
                             @endforeach
                         </select>
                     </div>
                     <!-- Input for Phone Number -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('Phone', 'auth') }}</span>
                         <input type="text" name="phone"
                             placeholder="{{ ui_change('Enter_your_number', 'auth') }}" required>
                         @error('phone')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="input-box">
                         <span class="details">{{ ui_change('email', 'auth') }}</span>
                         <input type="text" name="email1" placeholder="{{ ui_change('Enter_your_email', 'auth') }}"
                             required>
                         @error('email1')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="input-box">
                         <span class="details">{{ ui_change('username', 'auth') }}</span>
                         <input type="text" name="username"
                             placeholder="{{ ui_change('Enter_your_username', 'auth') }}" required>
                         @error('username')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>


                     <!-- Input for Password -->
                     <div class="input-box">
                         <span class="details">{{ ui_change('Password', 'auth') }}</span>
                         <input type="password" name="password"
                             placeholder="{{ ui_change('Enter_your_password', 'auth') }}" required>
                         @error('password')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                 </div>

                 <!-- Submit button -->
                 <div class="button">
                     <input type="submit" value="Register">
                 </div>
             </form> --}}
         </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <script src="{{ asset('assets/back-end/js/select2.min.js') }}"></script>
     <script>
         $(document).ready(function() {
             $('.js-select2-custom').select2();
         });
         $(document).on('ready', function() {
             "use strict"
             $(document).ready(function() {
                 $('.js-select2-custom').select2();
             });

         });
     </script>
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
     <script>
         $(document).ready(function() {
             $('#countrySelect').on('change', function() {
                 let selectedOption = $(this).find(':selected');
                 let dialCode = selectedOption.data('dial');

                 if (dialCode) {
                     let dialSelect = $('#dialCodeSelect');
                     let valueToSelect = '+' + dialCode;

                     dialSelect.val(valueToSelect).trigger('change');
                 }
             });
         });
     </script>

 </body>

 </html>
