 @extends('layouts.back-end.app')

 @section('title', ui_change('profile_Settings'))

 @push('css_or_js')
     <meta name="csrf-token" content="{{ csrf_token() }}">
 @endpush

 @section('content')
     <!-- Content -->
     <div class="content container-fluid">
         <!-- Page Header -->
         <div class="mb-3">
             <div class="row gy-2 align-items-center">
                 <div class="col-sm">
                     <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                         <img src="{{ asset('/assets/back-end/img/support-ticket.png') }}" alt="">
                         {{ ui_change('settings') }}
                     </h2>
                 </div>
                 <!-- End Page Title -->

                 <div class="col-sm-auto">
                     <a class="btn btn--primary" href="{{ route('main_dashboard') }}">
                         <i class="tio-home mr-1"></i> {{ ui_change('dashboard') }}
                     </a>
                 </div>
             </div>
             <!-- End Row -->
         </div>
         <!-- End Page Header -->

         <div class="row">

             <div class="col-lg-9">
                 <form action="{{ route('user.user_settings.update', $user->id) }}" method="post"
                     enctype="multipart/form-data" id="seller-profile-form">
                     @csrf
                     <!-- Card -->
                     @method('patch')

                     <!-- Card -->
                     <div class="card mb-3 mb-lg-5">
                         <div class="card-header">
                             <h5 class="mb-0">{{ ui_change('basic_Information') }}</h5>
                         </div>

                         <!-- Body -->
                         <div class="card-body">
                             <!-- Form -->
                             <!-- Form Group -->
                             <div class="row">

                                 <div class="col-sm-6">
                                     <div class="  form-group">
                                         <label for="newEmailLabel"
                                             class="col-sm-3 col-form-label input-label">{{ ui_change('name') }}</label>

                                         <input type="name" class="form-control" name="name"
                                             value="{{ $user->name }}" placeholder="{{ ui_change('enter_new_name') }}"
                                             aria-label="Enter new name">
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="  form-group">
                                         <label for="newEmailLabel"
                                             class="col-sm-3 col-form-label input-label">{{ ui_change('username') }}</label>

                                         <input type="username" class="form-control" name="username"
                                             value="{{ $user->user_name }}"
                                             placeholder="{{ ui_change('enter_new_username') }}"
                                             aria-label="Enter new username">
                                     </div>
                                 </div>

                                 <div class="col-sm-6">
                                     <div class="  form-group">
                                         <label for="newPassword" class="  col-form-label input-label">
                                             {{ ui_change('new_Password') }}</label>
                                         <input type="password" value="{{ $user->my_pass }}"
                                             class="js-pwstrength form-control" name="password" id="newPassword"
                                             placeholder="{{ ui_change('enter_new_password') }}"
                                             aria-label="Enter new password"
                                             data-hs-pwstrength-options='{
                                           "ui": {
                                             "container": "#changePasswordForm",
                                             "viewports": {
                                               "progress": "#passwordStrengthProgress",
                                               "verdict": "#passwordStrengthVerdict"
                                             }
                                           }
                                         }'>

                                         <p id="passwordStrengthVerdict" class="form-text mb-2"></p>

                                         <div id="passwordStrengthProgress"></div>
                                     </div>
                                 </div>

                                 <div class="col-sm-6">
                                     <div class="  form-group">
                                         <label for="newEmailLabel"
                                             class="col-form-label input-label">{{ ui_change('default_building') }}</label>
                                         <select id="building" name="property_id" class="js-select2-custom form-control">
                                             <option value="0">{{ ui_change('select', 'property_transaction') }}
                                             </option>
                                             @foreach ($buildings as $building)
                                                 <option value="{{ $building->id }}"
                                                     {{ $user->building_id == $building->id ? 'selected' : '' }}>
                                                     {{ $building->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                             </div>






                             <div class="d-flex justify-content-end">
                                 <button type="button"
                                     onclick="{{ env('APP_MODE') != 'demo' ? "form_alert('seller-profile-form','Want to update your info ?')" : 'call_demo()' }}"
                                     class="btn btn--primary">{{ ui_change('save_changes') }}
                                 </button>
                             </div>

                             <!-- End Form -->
                         </div>
                         <!-- End Body -->
                     </div>
                     <!-- End Card -->
                 </form>


                 <!-- End Card -->

                 <!-- Sticky Block End Point -->
                 <div id="stickyBlockEndPoint"></div>
             </div>
             <div class="col-lg-3">
                 <form action="{{ route('user.user_settings.update_buildings') }}" method="post"
                     enctype="multipart/form-data" id="seller-profile-form">
                     @csrf
                     <!-- Card -->
                     @method('patch')

                     <!-- Card -->
                     <div class="card mb-3 mb-lg-5">
                         <div class="card-header">
                             <h5 class="mb-0">{{ ui_change('basic_Information') }}</h5>
                         </div>

                         <!-- Body -->
                         <div class="card-body">
                             <!-- Form -->
                             <!-- Form Group -->
                             <div class="row">

                                 <div class="col-sm-12">
                                     <div class="  form-group">
                                         @foreach ($buildings as $building)
                                             <label class="d-flex align-items-center m-1" style="cursor:pointer">
                                                 <input type="checkbox" name="buildings[]" value="{{ $building->id }}"
                                                     {{ in_array($building->id, $selectedBuildings) ? 'checked' : '' }}
                                                     class="mr-2">

                                                 {{ $building->name }}
                                             </label>
                                         @endforeach
                                     </div>
                                 </div>
                             </div>






                             <div class="d-flex justify-content-end">
                                 <button type="submit" class="btn btn--primary">{{ ui_change('update') }}
                                 </button>
                             </div>

                             <!-- End Form -->
                         </div>
                         <!-- End Body -->
                     </div>
                     <!-- End Card -->
                 </form>


                 <!-- End Card -->

                 <!-- Sticky Block End Point -->
                 <div id="stickyBlockEndPoint"></div>
             </div>
         </div>
         <!-- End Row -->
     </div>
     <!-- End Content -->
 @endsection

 @push('script_2')
     <script>
         function readURL(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();

                 reader.onload = function(e) {
                     $('#viewer').attr('src', e.target.result);
                 }

                 reader.readAsDataURL(input.files[0]);
             }
         }

         $("#customFileUpload").change(function() {
             readURL(this);
         });
     </script>

     <script>
         $("#generalSection").click(function() {
             $("#passwordSection").removeClass("active");
             $("#generalSection").addClass("active");
             $('html, body').animate({
                 scrollTop: $("#generalDiv").offset().top
             }, 2000);
         });

         $("#passwordSection").click(function() {
             $("#generalSection").removeClass("active");
             $("#passwordSection").addClass("active");
             $('html, body').animate({
                 scrollTop: $("#passwordDiv").offset().top
             }, 2000);
         });
     </script>
 @endpush

 @push('script')
 @endpush
