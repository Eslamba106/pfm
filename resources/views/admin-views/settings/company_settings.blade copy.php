@extends('layouts.back-end.app')

@section('title', __('general_settings'))

@push('css_or_js')
    <link href="{{ asset('public/assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/custom.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/business-setup.png')}}" alt="">
                {{__('business_Setup')}}
            </h2>

            <div class="btn-group">
                <div class="ripple-animation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class="svg replaced-svg">
                        <path d="M9.00033 9.83268C9.23644 9.83268 9.43449 9.75268 9.59449 9.59268C9.75449 9.43268 9.83421 9.2349 9.83366 8.99935V5.64518C9.83366 5.40907 9.75366 5.21463 9.59366 5.06185C9.43366 4.90907 9.23588 4.83268 9.00033 4.83268C8.76421 4.83268 8.56616 4.91268 8.40616 5.07268C8.24616 5.23268 8.16644 5.43046 8.16699 5.66602V9.02018C8.16699 9.25629 8.24699 9.45074 8.40699 9.60352C8.56699 9.75629 8.76477 9.83268 9.00033 9.83268ZM9.00033 13.166C9.23644 13.166 9.43449 13.086 9.59449 12.926C9.75449 12.766 9.83421 12.5682 9.83366 12.3327C9.83366 12.0966 9.75366 11.8985 9.59366 11.7385C9.43366 11.5785 9.23588 11.4988 9.00033 11.4993C8.76421 11.4993 8.56616 11.5793 8.40616 11.7393C8.24616 11.8993 8.16644 12.0971 8.16699 12.3327C8.16699 12.5688 8.24699 12.7668 8.40699 12.9268C8.56699 13.0868 8.76477 13.1666 9.00033 13.166ZM9.00033 17.3327C7.84755 17.3327 6.76421 17.1138 5.75033 16.676C4.73644 16.2382 3.85449 15.6446 3.10449 14.8952C2.35449 14.1452 1.76088 13.2632 1.32366 12.2493C0.886437 11.2355 0.667548 10.1521 0.666992 8.99935C0.666992 7.84657 0.885881 6.76324 1.32366 5.74935C1.76144 4.73546 2.35505 3.85352 3.10449 3.10352C3.85449 2.35352 4.73644 1.7599 5.75033 1.32268C6.76421 0.88546 7.84755 0.666571 9.00033 0.666016C10.1531 0.666016 11.2364 0.884905 12.2503 1.32268C13.2642 1.76046 14.1462 2.35407 14.8962 3.10352C15.6462 3.85352 16.24 4.73546 16.6778 5.74935C17.1156 6.76324 17.3342 7.84657 17.3337 8.99935C17.3337 10.1521 17.1148 11.2355 16.677 12.2493C16.2392 13.2632 15.6456 14.1452 14.8962 14.8952C14.1462 15.6452 13.2642 16.2391 12.2503 16.6768C11.2364 17.1146 10.1531 17.3332 9.00033 17.3327ZM9.00033 15.666C10.8475 15.666 12.4206 15.0168 13.7195 13.7185C15.0184 12.4202 15.6675 10.8471 15.667 8.99935C15.667 7.15213 15.0178 5.57907 13.7195 4.28018C12.4212 2.98129 10.8481 2.33213 9.00033 2.33268C7.1531 2.33268 5.58005 2.98185 4.28116 4.28018C2.98227 5.57852 2.3331 7.15157 2.33366 8.99935C2.33366 10.8466 2.98283 12.4196 4.28116 13.7185C5.57949 15.0174 7.15255 15.6666 9.00033 15.666Z" fill="currentColor"></path>
                    </svg>
                </div>


                <div class="dropdown-menu dropdown-menu-right bg-aliceblue border border-color-primary-light p-4 dropdown-w-lg">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img width="20" src="{{asset('/public/assets/back-end/img/note.png')}}" alt="">
                        <h5 class="text-primary mb-0">{{__('note')}}</h5>
                    </div>
                    <p class="title-color font-weight-medium mb-0">{{ __('please_click_save_information_button_below_to_save_all_the_changes') }}</p>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.settings.business-setup-inline-menu')
        <!-- End Inlile Menu -->
@endsection


<!-- 
<select id="country" name="country" class="form-control  js-select2-custom">
                                    <option value="AF" {{ $cc?($cc=='AF'?'selected':''):'' }} >Afghanistan</option>
                                    <option value="AX" {{ $cc?($cc=='AX'?'selected':''):'' }} >Åland Islands</option>
                                    <option value="AL" {{ $cc?($cc=='AL'?'selected':''):'' }} >Albania</option>
                                    <option value="DZ" {{ $cc?($cc=='DZ'?'selected':''):'' }}>Algeria</option>
                                    <option value="AS" {{ $cc?($cc=='AS'?'selected':''):'' }}>American Samoa</option>
                                    <option value="AD" {{ $cc?($cc=='AD'?'selected':''):'' }}>Andorra</option>
                                    <option value="AO" {{ $cc?($cc=='AO'?'selected':''):'' }}>Angola</option>
                                    <option value="AI" {{ $cc?($cc=='AI'?'selected':''):'' }}>Anguilla</option>
                                    <option value="AQ" {{ $cc?($cc=='AQ'?'selected':''):'' }}>Antarctica</option>
                                    <option value="AG" {{ $cc?($cc=='AG'?'selected':''):'' }}>Antigua and Barbuda</option>
                                    <option value="AR" {{ $cc?($cc=='AR'?'selected':''):'' }}>Argentina</option>
                                    <option value="AM" {{ $cc?($cc=='AM'?'selected':''):'' }}>Armenia</option>
                                    <option value="AW" {{ $cc?($cc=='AW'?'selected':''):'' }}>Aruba</option>
                                    <option value="AU" {{ $cc?($cc=='AU'?'selected':''):'' }}>Australia</option>
                                    <option value="AT" {{ $cc?($cc=='AT'?'selected':''):'' }}>Austria</option>
                                    <option value="AZ" {{ $cc?($cc=='AZ'?'selected':''):'' }}>Azerbaijan</option>
                                    <option value="BS" {{ $cc?($cc=='BS'?'selected':''):'' }}>Bahamas</option>
                                    <option value="BH" {{ $cc?($cc=='BH'?'selected':''):'' }}>Bahrain</option>
                                    <option value="BD" {{ $cc?($cc=='BD'?'selected':''):'' }}>Bangladesh</option>
                                    <option value="BB" {{ $cc?($cc=='BB'?'selected':''):'' }}>Barbados</option>
                                    <option value="BY" {{ $cc?($cc=='BY'?'selected':''):'' }}>Belarus</option>
                                    <option value="BE" {{ $cc?($cc=='BE'?'selected':''):'' }}>Belgium</option>
                                    <option value="BZ" {{ $cc?($cc=='BZ'?'selected':''):'' }}>Belize</option>
                                    <option value="BJ" {{ $cc?($cc=='BJ'?'selected':''):'' }}>Benin</option>
                                    <option value="BM" {{ $cc?($cc=='BM'?'selected':''):'' }}>Bermuda</option>
                                    <option value="BT" {{ $cc?($cc=='BT'?'selected':''):'' }}>Bhutan</option>
                                    <option value="BO" {{ $cc?($cc=='BO'?'selected':''):'' }}>Bolivia, Plurinational State
                                        of
                                    </option>
                                    <option value="BQ" {{ $cc?($cc=='BQ'?'selected':''):'' }}>Bonaire, Sint Eustatius and
                                        Saba
                                    </option>
                                    <option value="BA" {{ $cc?($cc=='BA'?'selected':''):'' }}>Bosnia and Herzegovina
                                    </option>
                                    <option value="BW" {{ $cc?($cc=='BW'?'selected':''):'' }}>Botswana</option>
                                    <option value="BV" {{ $cc?($cc=='BV'?'selected':''):'' }}>Bouvet Island</option>
                                    <option value="BR" {{ $cc?($cc=='BR'?'selected':''):'' }}>Brazil</option>
                                    <option value="IO" {{ $cc?($cc=='IO'?'selected':''):'' }}>British Indian Ocean
                                        Territory
                                    </option>
                                    <option value="BN" {{ $cc?($cc=='BN'?'selected':''):'' }}>Brunei Darussalam</option>
                                    <option value="BG" {{ $cc?($cc=='BG'?'selected':''):'' }}>Bulgaria</option>
                                    <option value="BF" {{ $cc?($cc=='BF'?'selected':''):'' }}>Burkina Faso</option>
                                    <option value="BI" {{ $cc?($cc=='BI'?'selected':''):'' }}>Burundi</option>
                                    <option value="KH" {{ $cc?($cc=='KH'?'selected':''):'' }}>Cambodia</option>
                                    <option value="CM" {{ $cc?($cc=='CM'?'selected':''):'' }}>Cameroon</option>
                                    <option value="CA" {{ $cc?($cc=='CA'?'selected':''):'' }}>Canada</option>
                                    <option value="CV" {{ $cc?($cc=='CV'?'selected':''):'' }}>Cape Verde</option>
                                    <option value="KY" {{ $cc?($cc=='KY'?'selected':''):'' }}>Cayman Islands</option>
                                    <option value="CF" {{ $cc?($cc=='CF'?'selected':''):'' }}>Central African Republic
                                    </option>
                                    <option value="TD" {{ $cc?($cc=='TD'?'selected':''):'' }}>Chad</option>
                                    <option value="CL" {{ $cc?($cc=='CL'?'selected':''):'' }}>Chile</option>
                                    <option value="CN" {{ $cc?($cc=='CN'?'selected':''):'' }}>China</option>
                                    <option value="CX" {{ $cc?($cc=='CX'?'selected':''):'' }}>Christmas Island</option>
                                    <option value="CC" {{ $cc?($cc=='CC'?'selected':''):'' }}>Cocos (Keeling) Islands
                                    </option>
                                    <option value="CO" {{ $cc?($cc=='CO'?'selected':''):'' }}>Colombia</option>
                                    <option value="KM" {{ $cc?($cc=='KM'?'selected':''):'' }}>Comoros</option>
                                    <option value="CG" {{ $cc?($cc=='CG'?'selected':''):'' }}>Congo</option>
                                    <option value="CD" {{ $cc?($cc=='CD'?'selected':''):'' }}>Congo, the Democratic Republic
                                        of the
                                    </option>
                                    <option value="CK" {{ $cc?($cc=='CK'?'selected':''):'' }}>Cook Islands</option>
                                    <option value="CR" {{ $cc?($cc=='CR'?'selected':''):'' }}>Costa Rica</option>
                                    <option value="CI" {{ $cc?($cc=='CI'?'selected':''):'' }}>Côte d'Ivoire</option>
                                    <option value="HR" {{ $cc?($cc=='HR'?'selected':''):'' }}>Croatia</option>
                                    <option value="CU" {{ $cc?($cc=='CU'?'selected':''):'' }}>Cuba</option>
                                    <option value="CW" {{ $cc?($cc=='CW'?'selected':''):'' }}>Curaçao</option>
                                    <option value="CY" {{ $cc?($cc=='CY'?'selected':''):'' }}>Cyprus</option>
                                    <option value="CZ" {{ $cc?($cc=='CZ'?'selected':''):'' }}>Czech Republic</option>
                                    <option value="DK" {{ $cc?($cc=='DK'?'selected':''):'' }}>Denmark</option>
                                    <option value="DJ" {{ $cc?($cc=='DJ'?'selected':''):'' }}>Djibouti</option>
                                    <option value="DM" {{ $cc?($cc=='DM'?'selected':''):'' }}>Dominica</option>
                                    <option value="DO" {{ $cc?($cc=='DO'?'selected':''):'' }}>Dominican Republic</option>
                                    <option value="EC" {{ $cc?($cc=='EC'?'selected':''):'' }}>Ecuador</option>
                                    <option value="EG" {{ $cc?($cc=='EG'?'selected':''):'' }}>Egypt</option>
                                    <option value="SV" {{ $cc?($cc=='SV'?'selected':''):'' }}>El Salvador</option>
                                    <option value="GQ" {{ $cc?($cc=='GQ'?'selected':''):'' }}>Equatorial Guinea</option>
                                    <option value="ER" {{ $cc?($cc=='ER'?'selected':''):'' }}>Eritrea</option>
                                    <option value="EE" {{ $cc?($cc=='EE'?'selected':''):'' }}>Estonia</option>
                                    <option value="ET" {{ $cc?($cc=='ET'?'selected':''):'' }}>Ethiopia</option>
                                    <option value="FK" {{ $cc?($cc=='FK'?'selected':''):'' }}>Falkland Islands (Malvinas)
                                    </option>
                                    <option value="FO" {{ $cc?($cc=='FO'?'selected':''):'' }}>Faroe Islands</option>
                                    <option value="FJ" {{ $cc?($cc=='FJ'?'selected':''):'' }}>Fiji</option>
                                    <option value="FI" {{ $cc?($cc=='FI'?'selected':''):'' }}>Finland</option>
                                    <option value="FR" {{ $cc?($cc=='FR'?'selected':''):'' }}>France</option>
                                    <option value="GF" {{ $cc?($cc=='GF'?'selected':''):'' }}>French Guiana</option>
                                    <option value="PF" {{ $cc?($cc=='PF'?'selected':''):'' }}>French Polynesia</option>
                                    <option value="TF" {{ $cc?($cc=='TF'?'selected':''):'' }}>French Southern Territories
                                    </option>
                                    <option value="GA" {{ $cc?($cc=='GA'?'selected':''):'' }}>Gabon</option>
                                    <option value="GM" {{ $cc?($cc=='GM'?'selected':''):'' }}>Gambia</option>
                                    <option value="GE" {{ $cc?($cc=='GE'?'selected':''):'' }}>Georgia</option>
                                    <option value="DE" {{ $cc?($cc=='DE'?'selected':''):'' }}>Germany</option>
                                    <option value="GH" {{ $cc?($cc=='GH'?'selected':''):'' }}>Ghana</option>
                                    <option value="GI" {{ $cc?($cc=='GI'?'selected':''):'' }}>Gibraltar</option>
                                    <option value="GR" {{ $cc?($cc=='GR'?'selected':''):'' }}>Greece</option>
                                    <option value="GL" {{ $cc?($cc=='GL'?'selected':''):'' }}>Greenland</option>
                                    <option value="GD" {{ $cc?($cc=='GD'?'selected':''):'' }}>Grenada</option>
                                    <option value="GP" {{ $cc?($cc=='GP'?'selected':''):'' }}>Guadeloupe</option>
                                    <option value="GU" {{ $cc?($cc=='GU'?'selected':''):'' }}>Guam</option>
                                    <option value="GT" {{ $cc?($cc=='GT'?'selected':''):'' }}>Guatemala</option>
                                    <option value="GG" {{ $cc?($cc=='GG'?'selected':''):'' }}>Guernsey</option>
                                    <option value="GN" {{ $cc?($cc=='GN'?'selected':''):'' }}>Guinea</option>
                                    <option value="GW" {{ $cc?($cc=='GW'?'selected':''):'' }}>Guinea-Bissau</option>
                                    <option value="GY" {{ $cc?($cc=='GY'?'selected':''):'' }}>Guyana</option>
                                    <option value="HT" {{ $cc?($cc=='HT'?'selected':''):'' }}>Haiti</option>
                                    <option value="HM" {{ $cc?($cc=='HM'?'selected':''):'' }}>Heard Island and McDonald
                                        Islands
                                    </option>
                                    <option value="VA" {{ $cc?($cc=='VA'?'selected':''):'' }}>Holy See (Vatican City
                                        State)
                                    </option>
                                    <option value="HN" {{ $cc?($cc=='HN'?'selected':''):'' }}>Honduras</option>
                                    <option value="HK" {{ $cc?($cc=='HK'?'selected':''):'' }}>Hong Kong</option>
                                    <option value="HU" {{ $cc?($cc=='HU'?'selected':''):'' }}>Hungary</option>
                                    <option value="IS" {{ $cc?($cc=='IS'?'selected':''):'' }}>Iceland</option>
                                    <option value="IN" {{ $cc?($cc=='IN'?'selected':''):'' }}>India</option>
                                    <option value="ID" {{ $cc?($cc=='ID'?'selected':''):'' }}>Indonesia</option>
                                    <option value="IR" {{ $cc?($cc=='IR'?'selected':''):'' }}>Iran, Islamic Republic of
                                    </option>
                                    <option value="IQ" {{ $cc?($cc=='IQ'?'selected':''):'' }}>Iraq</option>
                                    <option value="IE" {{ $cc?($cc=='IE'?'selected':''):'' }}>Ireland</option>
                                    <option value="IM" {{ $cc?($cc=='IM'?'selected':''):'' }}>Isle of Man</option>
                                    <option value="IL" {{ $cc?($cc=='IL'?'selected':''):'' }}>Israel</option>
                                    <option value="IT" {{ $cc?($cc=='IT'?'selected':''):'' }}>Italy</option>
                                    <option value="JM" {{ $cc?($cc=='JM'?'selected':''):'' }}>Jamaica</option>
                                    <option value="JP" {{ $cc?($cc=='JP'?'selected':''):'' }}>Japan</option>
                                    <option value="JE" {{ $cc?($cc=='JE'?'selected':''):'' }}>Jersey</option>
                                    <option value="JO" {{ $cc?($cc=='JO'?'selected':''):'' }}>Jordan</option>
                                    <option value="KZ" {{ $cc?($cc=='KZ'?'selected':''):'' }}>Kazakhstan</option>
                                    <option value="KE" {{ $cc?($cc=='KE'?'selected':''):'' }}>Kenya</option>
                                    <option value="KI" {{ $cc?($cc=='KI'?'selected':''):'' }}>Kiribati</option>
                                    <option value="KP" {{ $cc?($cc=='KP'?'selected':''):'' }}>Korea, Democratic People's
                                        Republic of
                                    </option>
                                    <option value="KR" {{ $cc?($cc=='KR'?'selected':''):'' }}>Korea, Republic of</option>
                                    <option value="KW" {{ $cc?($cc=='KW'?'selected':''):'' }}>Kuwait</option>
                                    <option value="KG" {{ $cc?($cc=='KG'?'selected':''):'' }}>Kyrgyzstan</option>
                                    <option value="LA" {{ $cc?($cc=='LA'?'selected':''):'' }}>Lao People's Democratic
                                        Republic
                                    </option>
                                    <option value="LV" {{ $cc?($cc=='LV'?'selected':''):'' }}>Latvia</option>
                                    <option value="LB" {{ $cc?($cc=='LB'?'selected':''):'' }}>Lebanon</option>
                                    <option value="LS" {{ $cc?($cc=='LS'?'selected':''):'' }}>Lesotho</option>
                                    <option value="LR" {{ $cc?($cc=='LR'?'selected':''):'' }}>Liberia</option>
                                    <option value="LY" {{ $cc?($cc=='LY'?'selected':''):'' }}>Libya</option>
                                    <option value="LI" {{ $cc?($cc=='LI'?'selected':''):'' }}>Liechtenstein</option>
                                    <option value="LT" {{ $cc?($cc=='LT'?'selected':''):'' }}>Lithuania</option>
                                    <option value="LU" {{ $cc?($cc=='LU'?'selected':''):'' }}>Luxembourg</option>
                                    <option value="MO" {{ $cc?($cc=='MO'?'selected':''):'' }}>Macao</option>
                                    <option value="MK" {{ $cc?($cc=='MK'?'selected':''):'' }}>Macedonia, the former Yugoslav
                                        Republic of
                                    </option>
                                    <option value="MG" {{ $cc?($cc=='MG'?'selected':''):'' }}>Madagascar</option>
                                    <option value="MW" {{ $cc?($cc=='MW'?'selected':''):'' }}>Malawi</option>
                                    <option value="MY" {{ $cc?($cc=='MY'?'selected':''):'' }}>Malaysia</option>
                                    <option value="MV" {{ $cc?($cc=='MV'?'selected':''):'' }}>Maldives</option>
                                    <option value="ML" {{ $cc?($cc=='ML'?'selected':''):'' }}>Mali</option>
                                    <option value="MT" {{ $cc?($cc=='MT'?'selected':''):'' }}>Malta</option>
                                    <option value="MH" {{ $cc?($cc=='MH'?'selected':''):'' }}>Marshall Islands</option>
                                    <option value="MQ" {{ $cc?($cc=='MQ'?'selected':''):'' }}>Martinique</option>
                                    <option value="MR" {{ $cc?($cc=='MR'?'selected':''):'' }}>Mauritania</option>
                                    <option value="MU" {{ $cc?($cc=='MU'?'selected':''):'' }}>Mauritius</option>
                                    <option value="YT" {{ $cc?($cc=='YT'?'selected':''):'' }}>Mayotte</option>
                                    <option value="MX" {{ $cc?($cc=='MX'?'selected':''):'' }}>Mexico</option>
                                    <option value="FM" {{ $cc?($cc=='FM'?'selected':''):'' }}>Micronesia, Federated States
                                        of
                                    </option>
                                    <option value="MD" {{ $cc?($cc=='MD'?'selected':''):'' }}>Moldova, Republic of</option>
                                    <option value="MC" {{ $cc?($cc=='MC'?'selected':''):'' }}>Monaco</option>
                                    <option value="MN" {{ $cc?($cc=='MN'?'selected':''):'' }}>Mongolia</option>
                                    <option value="ME" {{ $cc?($cc=='ME'?'selected':''):'' }}>Montenegro</option>
                                    <option value="MS" {{ $cc?($cc=='MS'?'selected':''):'' }}>Montserrat</option>
                                    <option value="MA" {{ $cc?($cc=='MA'?'selected':''):'' }}>Morocco</option>
                                    <option value="MZ" {{ $cc?($cc=='MZ'?'selected':''):'' }}>Mozambique</option>
                                    <option value="MM" {{ $cc?($cc=='MM'?'selected':''):'' }}>Myanmar</option>
                                    <option value="NA" {{ $cc?($cc=='NA'?'selected':''):'' }}>Namibia</option>
                                    <option value="NR" {{ $cc?($cc=='NR'?'selected':''):'' }}>Nauru</option>
                                    <option value="NP" {{ $cc?($cc=='NP'?'selected':''):'' }}>Nepal</option>
                                    <option value="NL" {{ $cc?($cc=='NL'?'selected':''):'' }}>Netherlands</option>
                                    <option value="NC" {{ $cc?($cc=='NC'?'selected':''):'' }}>New Caledonia</option>
                                    <option value="NZ" {{ $cc?($cc=='NZ'?'selected':''):'' }}>New Zealand</option>
                                    <option value="NI" {{ $cc?($cc=='NI'?'selected':''):'' }}>Nicaragua</option>
                                    <option value="NE" {{ $cc?($cc=='NE'?'selected':''):'' }}>Niger</option>
                                    <option value="NG" {{ $cc?($cc=='NG'?'selected':''):'' }}>Nigeria</option>
                                    <option value="NU" {{ $cc?($cc=='NU'?'selected':''):'' }}>Niue</option>
                                    <option value="NF" {{ $cc?($cc=='NF'?'selected':''):'' }}>Norfolk Island</option>
                                    <option value="MP" {{ $cc?($cc=='MP'?'selected':''):'' }}>Northern Mariana Islands
                                    </option>
                                    <option value="NO" {{ $cc?($cc=='NO'?'selected':''):'' }}>Norway</option>
                                    <option value="OM" {{ $cc?($cc=='OM'?'selected':''):'' }}>Oman</option>
                                    <option value="PK" {{ $cc?($cc=='PK'?'selected':''):'' }}>Pakistan</option>
                                    <option value="PW" {{ $cc?($cc=='PW'?'selected':''):'' }}>Palau</option>
                                    <option value="PS" {{ $cc?($cc=='PS'?'selected':''):'' }}>Palestinian Territory,
                                        Occupied
                                    </option>
                                    <option value="PA" {{ $cc?($cc=='PA'?'selected':''):'' }}>Panama</option>
                                    <option value="PG" {{ $cc?($cc=='PG'?'selected':''):'' }}>Papua New Guinea</option>
                                    <option value="PY" {{ $cc?($cc=='PY'?'selected':''):'' }}>Paraguay</option>
                                    <option value="PE" {{ $cc?($cc=='PE'?'selected':''):'' }}>Peru</option>
                                    <option value="PH" {{ $cc?($cc=='PH'?'selected':''):'' }}>Philippines</option>
                                    <option value="PN" {{ $cc?($cc=='PN'?'selected':''):'' }}>Pitcairn</option>
                                    <option value="PL" {{ $cc?($cc=='PL'?'selected':''):'' }}>Poland</option>
                                    <option value="PT" {{ $cc?($cc=='PT'?'selected':''):'' }}>Portugal</option>
                                    <option value="PR" {{ $cc?($cc=='PR'?'selected':''):'' }}>Puerto Rico</option>
                                    <option value="QA" {{ $cc?($cc=='QA'?'selected':''):'' }}>Qatar</option>
                                    <option value="RE" {{ $cc?($cc=='RE'?'selected':''):'' }}>Réunion</option>
                                    <option value="RO" {{ $cc?($cc=='RO'?'selected':''):'' }}>Romania</option>
                                    <option value="RU" {{ $cc?($cc=='RU'?'selected':''):'' }}>Russian Federation</option>
                                    <option value="RW" {{ $cc?($cc=='RW'?'selected':''):'' }}>Rwanda</option>
                                    <option value="BL" {{ $cc?($cc=='BL'?'selected':''):'' }}>Saint Barthélemy</option>
                                    <option value="SH" {{ $cc?($cc=='SH'?'selected':''):'' }}>Saint Helena, Ascension and
                                        Tristan da Cunha
                                    </option>
                                    <option value="KN" {{ $cc?($cc=='KN'?'selected':''):'' }}>Saint Kitts and Nevis</option>
                                    <option value="LC" {{ $cc?($cc=='LC'?'selected':''):'' }}>Saint Lucia</option>
                                    <option value="MF" {{ $cc?($cc=='MF'?'selected':''):'' }}>Saint Martin (French part)
                                    </option>
                                    <option value="PM" {{ $cc?($cc=='PM'?'selected':''):'' }}>Saint Pierre and Miquelon
                                    </option>
                                    <option value="VC" {{ $cc?($cc=='VC'?'selected':''):'' }}>Saint Vincent and the
                                        Grenadines
                                    </option>
                                    <option value="WS" {{ $cc?($cc=='WS'?'selected':''):'' }}>Samoa</option>
                                    <option value="SM" {{ $cc?($cc=='SM'?'selected':''):'' }}>San Marino</option>
                                    <option value="ST" {{ $cc?($cc=='ST'?'selected':''):'' }}>Sao Tome and Principe</option>
                                    <option value="SA" {{ $cc?($cc=='SA'?'selected':''):'' }}>Saudi Arabia</option>
                                    <option value="SN" {{ $cc?($cc=='SN'?'selected':''):'' }}>Senegal</option>
                                    <option value="RS" {{ $cc?($cc=='RS'?'selected':''):'' }}>Serbia</option>
                                    <option value="SC" {{ $cc?($cc=='SC'?'selected':''):'' }}>Seychelles</option>
                                    <option value="SL" {{ $cc?($cc=='SL'?'selected':''):'' }}>Sierra Leone</option>
                                    <option value="SG" {{ $cc?($cc=='SG'?'selected':''):'' }}>Singapore</option>
                                    <option value="SX" {{ $cc?($cc=='SX'?'selected':''):'' }}>Sint Maarten (Dutch part)
                                    </option>
                                    <option value="SK" {{ $cc?($cc=='SK'?'selected':''):'' }}>Slovakia</option>
                                    <option value="SI" {{ $cc?($cc=='SI'?'selected':''):'' }}>Slovenia</option>
                                    <option value="SB" {{ $cc?($cc=='SB'?'selected':''):'' }}>Solomon Islands</option>
                                    <option value="SO" {{ $cc?($cc=='SO'?'selected':''):'' }}>Somalia</option>
                                    <option value="ZA" {{ $cc?($cc=='ZA'?'selected':''):'' }}>South Africa</option>
                                    <option value="GS" {{ $cc?($cc=='GS'?'selected':''):'' }}>South Georgia and the South
                                        Sandwich Islands
                                    </option>
                                    <option value="SS" {{ $cc?($cc=='SS'?'selected':''):'' }}>South Sudan</option>
                                    <option value="ES" {{ $cc?($cc=='ES'?'selected':''):'' }}>Spain</option>
                                    <option value="LK" {{ $cc?($cc=='LK'?'selected':''):'' }}>Sri Lanka</option>
                                    <option value="SD" {{ $cc?($cc=='SD'?'selected':''):'' }}>Sudan</option>
                                    <option value="SR" {{ $cc?($cc=='SR'?'selected':''):'' }}>Suriname</option>
                                    <option value="SJ" {{ $cc?($cc=='SJ'?'selected':''):'' }}>Svalbard and Jan Mayen
                                    </option>
                                    <option value="SZ" {{ $cc?($cc=='SZ'?'selected':''):'' }}>Swaziland</option>
                                    <option value="SE" {{ $cc?($cc=='SE'?'selected':''):'' }}>Sweden</option>
                                    <option value="CH" {{ $cc?($cc=='CH'?'selected':''):'' }}>Switzerland</option>
                                    <option value="SY" {{ $cc?($cc=='SY'?'selected':''):'' }}>Syrian Arab Republic</option>
                                    <option value="TW" {{ $cc?($cc=='TW'?'selected':''):'' }}>Taiwan, Province of China
                                    </option>
                                    <option value="TJ" {{ $cc?($cc=='TJ'?'selected':''):'' }}>Tajikistan</option>
                                    <option value="TZ" {{ $cc?($cc=='TZ'?'selected':''):'' }}>Tanzania, United Republic of
                                    </option>
                                    <option value="TH" {{ $cc?($cc=='TH'?'selected':''):'' }}>Thailand</option>
                                    <option value="TL" {{ $cc?($cc=='TL'?'selected':''):'' }}>Timor-Leste</option>
                                    <option value="TG" {{ $cc?($cc=='TG'?'selected':''):'' }}>Togo</option>
                                    <option value="TK" {{ $cc?($cc=='TK'?'selected':''):'' }}>Tokelau</option>
                                    <option value="TO" {{ $cc?($cc=='TO'?'selected':''):'' }}>Tonga</option>
                                    <option value="TT" {{ $cc?($cc=='TT'?'selected':''):'' }}>Trinidad and Tobago</option>
                                    <option value="TN" {{ $cc?($cc=='TN'?'selected':''):'' }}>Tunisia</option>
                                    <option value="TR" {{ $cc?($cc=='TR'?'selected':''):'' }}>Turkey</option>
                                    <option value="TM" {{ $cc?($cc=='TM'?'selected':''):'' }}>Turkmenistan</option>
                                    <option value="TC" {{ $cc?($cc=='TC'?'selected':''):'' }}>Turks and Caicos Islands
                                    </option>
                                    <option value="TV" {{ $cc?($cc=='TV'?'selected':''):'' }}>Tuvalu</option>
                                    <option value="UG" {{ $cc?($cc=='UG'?'selected':''):'' }}>Uganda</option>
                                    <option value="UA" {{ $cc?($cc=='UA'?'selected':''):'' }}>Ukraine</option>
                                    <option value="AE" {{ $cc?($cc=='AE'?'selected':''):'' }}>United Arab Emirates</option>
                                    <option value="GB" {{ $cc?($cc=='GB'?'selected':''):'' }}>United Kingdom</option>
                                    <option value="US" {{ $cc?($cc=='US'?'selected':''):'' }}>United States</option>
                                    <option value="UM" {{ $cc?($cc=='UM'?'selected':''):'' }}>United States Minor Outlying
                                        Islands
                                    </option>
                                    <option value="UY" {{ $cc?($cc=='UY'?'selected':''):'' }}>Uruguay</option>
                                    <option value="UZ" {{ $cc?($cc=='UZ'?'selected':''):'' }}>Uzbekistan</option>
                                    <option value="VU" {{ $cc?($cc=='VU'?'selected':''):'' }}>Vanuatu</option>
                                    <option value="VE" {{ $cc?($cc=='VE'?'selected':''):'' }}>Venezuela, Bolivarian Republic
                                        of
                                    </option>
                                    <option value="VN" {{ $cc?($cc=='VN'?'selected':''):'' }}>Viet Nam</option>
                                    <option value="VG" {{ $cc?($cc=='VG'?'selected':''):'' }}>Virgin Islands, British
                                    </option>
                                    <option value="VI" {{ $cc?($cc=='VI'?'selected':''):'' }}>Virgin Islands, U.S.</option>
                                    <option value="WF" {{ $cc?($cc=='WF'?'selected':''):'' }}>Wallis and Futuna</option>
                                    <option value="EH" {{ $cc?($cc=='EH'?'selected':''):'' }}>Western Sahara</option>
                                    <option value="YE" {{ $cc?($cc=='YE'?'selected':''):'' }}>Yemen</option>
                                    <option value="ZM" {{ $cc?($cc=='ZM'?'selected':''):'' }}>Zambia</option>
                                    <option value="ZW" {{ $cc?($cc=='ZW'?'selected':''):'' }}>Zimbabwe</option>
                                </select>
-->