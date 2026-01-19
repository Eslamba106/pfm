 @extends('layouts.back-end.app')

 @php
     if (auth()->check()) {
         $company = App\Models\Company::where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = App\Models\User::first();
     }
     $lang = session()->get('locale');
 @endphp
 @section('title', ui_change('room_reservation', 'room_reservation'))

 @push('css_or_js')
     <style>
         .unit-box {
             width: 70px;
             height: 50px;
             border: 1px solid #333;
             display: flex;
             align-items: center;
             justify-content: center;
             font-weight: 600;
             cursor: pointer;
             user-select: none;
         }

         .unit-box input {
             display: none;
         }

         .unit-box.selected {
             border: 3px solid #0d6efd;
         }

         .block-card {
             border: 1px solid #ccc;
             padding: 1rem;
             margin-bottom: 1.5rem;
             border-radius: 5px;
             background-color: #f9f9f9;
         }

         .floor-section {
             margin-bottom: 1rem;
         }

         .floor-label {
             font-weight: 600;
             margin-bottom: 0.5rem;
         }

         .units-container {
             display: flex;
             flex-wrap: wrap;
             gap: 0.5rem;
         }

         .context-menu {
             position: absolute;
             background: #fff;
             border: 1px solid #ccc;
             border-radius: 6px;
             box-shadow: 0 5px 15px rgba(0, 0, 0, .2);
             display: none;
             z-index: 9999;
             min-width: 140px;
         }

         .context-menu ul {
             list-style: none;
             margin: 0;
             padding: 6px 0;
         }

         .context-menu li {
             padding: 8px 12px;
             cursor: pointer;
             font-size: 14px;
         }

         .context-menu li:hover {
             background-color: #0d6efd;
             color: #fff;
         }

         .unit-box {
             width: 70px;
             height: 55px;
             border: 1px solid #333;
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: space-between;
             font-weight: 600;
             cursor: pointer;
             user-select: none;
             padding: 4px;
             position: relative;
         }

         .unit-name {
             font-size: 13px;
         }

         .unit-dots {
             display: flex;
             gap: 4px;
             margin-bottom: 2px;
         }

         .dot {
             width: 6px;
             height: 6px;
             border-radius: 50%;
             background-color: #bbb;
             cursor: pointer;
         }

         .dot-booking {
             background-color: #0d6efd;
         }

         .dot-checkin {
             background-color: #198754;
         }

         .dot-info {
             background-color: #6c757d;
         }

         .dot::after {
             content: attr(data-tooltip);
             position: absolute;
             bottom: 60px;
             background: #000;
             color: #fff;
             font-size: 11px;
             padding: 4px 6px;
             border-radius: 4px;
             white-space: nowrap;
             opacity: 0;
             transform: translateY(5px);
             pointer-events: none;
             transition: .2s;
         }

         .dot:hover::after {
             opacity: 1;
             transform: translateY(0);
         }
     </style>
 @endpush

 @section('content')
     <div class="container list-container">
         <div id="unitContextMenu" class="context-menu">
             <ul>
                 <li data-action="enquiry">{{ ui_change('enquiry') }}</li>
                 <li data-action="proposal">{{ ui_change('proposal') }}</li>
                 <li data-action="booking">{{ ui_change('booking') }}</li>
                 <li data-action="agreement">{{ ui_change('agreement') }}</li>
                 <li data-action="checkin">{{ ui_change('check_in') }}</li>
             </ul>
         </div>

         <form id="productForm" method="get" class="d-flex flex-wrap gap-2">
             <button type="submit" onclick="setFormAction('{{ route('enquiry.create_with_select_unit') }}')"
                 class="btn btn--primary createButton">
                 <i class="tio-add"></i>
                 <span class="text">{{ ui_change('create_enquiry', 'property_transaction') }}</span>
             </button>

             <button type="submit" onclick="setFormAction('{{ route('proposal.create_with_select_unit') }}')"
                 class="btn btn--primary createButton">
                 <i class="tio-add"></i>
                 <span class="text">{{ ui_change('create_proposal', 'property_transaction') }}</span>
             </button>

             <button type="submit" onclick="setFormAction('{{ route('booking.create_with_select_unit') }}')"
                 class="btn btn--primary createButton">
                 <i class="tio-add"></i>
                 <span class="text">{{ ui_change('create_booking', 'property_transaction') }}</span>
             </button>

             <button type="submit" onclick="setFormAction('{{ route('agreement.create_with_select_unit') }}')"
                 class="btn btn--primary createButton">
                 <i class="tio-add"></i>
                 <span class="text">{{ ui_change('create_agreement', 'property_transaction') }}</span>
             </button>
             <button type="button" data-check_in="" data-toggle="modal" data-target="#check_in"
                 class="btn btn--primary createButton">
                 <i class="tio-add"></i>
                 <span class="text">{{ ui_change('checkIn', 'property_transaction') }}</span>
             </button>
     </div>
     <div class="container list-container">
         @foreach ($property_items as $property)
             <h3 class="mt-3">{{ $property->name }}</h3>

             @foreach ($property->blocks_management_child as $block_item)
                 <div class="block-card">
                     <div class="block-name mb-2">Block: {{ $block_item->block->name }}</div>

                     @foreach ($block_item->floors_management_child as $floor_item)
                         <div class="floor-section">
                             <div class="floor-label">Floor: {{ $floor_item->floor_management_main->name }}</div>
                             <div class="units-container">
                                 @foreach ($floor_item->unit_management_child as $unit)
                                     <label class="unit-box" data-unit-id="{{ $unit->id }}">
                                         <input type="checkbox" name="bulk_ids[]" value="{{ $unit->id }}">
                                         {{ $unit->unit_management_main->name }}
                                         <div class="unit-dots">
                                             <span class="dot dot-booking" data-action="booking"></span>
                                             <span class="dot dot-checkin" data-action="checkin"></span>
                                             <span class="dot dot-info" data-action="info"></span>
                                         </div>
                                     </label>
                                 @endforeach
                             </div>
                         </div>
                     @endforeach
                 </div>
             @endforeach
         @endforeach
     </div>

     <div class="modal fade" id="check_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                         {{ ui_change('Generate_Invoice', 'property_report') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="{{ route('booking_room.check_in_page') }}" method="post">
                     @csrf
                     <div id="bulk-hidden-inputs"></div>

                     <div class="modal-body">
                         <div class="form-group">
                             <label for="">{{ ui_change('select', 'property_report') }}</label>
                             <select name="tenant_id" id="" class="form-control">
                                 @foreach ($tenants as $tenants_item)
                                     <option value="{{ $tenants_item->id }}">
                                         {{ $tenants_item->name ?? $tenants_item->company_name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="">{{ ui_change('Booking_From', 'property_report') }}</label>
                                     <input type="text" name="booking_from" class="form-control date">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="">{{ ui_change('Booking_to', 'property_report') }}</label>
                                     <input type="text" name="booking_to" class="form-control date">
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary"
                             data-dismiss="modal">{{ ui_change('Cancel', 'property_report') }}</button>
                         <button type="submit"
                             class="btn btn--primary">{{ ui_change('Generate', 'property_report') }}</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endsection

 @push('script')
     <script>
         flatpickr(".date", {
             dateFormat: "d/m/Y",
             defaultDate: "today",
         });
     </script>
     <script>
         function setFormAction(actionUrl) {
             document.getElementById('productForm').action = actionUrl;
         }
         const bookingCreateRoute = "{{ route('booking.create_with_select_unit') }}";
         const enquiryCreateRoute = "{{ route('enquiry.create_with_select_unit') }}";
         const proposalCreateRoute = "{{ route('proposal.create_with_select_unit') }}";
         const agreementCreateRoute = "{{ route('agreement.create_with_select_unit') }}";
     </script>

     <script>
         document.querySelectorAll('.unit-box').forEach(box => {
             const checkbox = box.querySelector('input');

             box.addEventListener('click', function() {
                 checkbox.checked = !checkbox.checked;
                 box.classList.toggle('selected', checkbox.checked);
             });
         });
     </script>
     <script>
         let currentUnitId = null;
         const menu = document.getElementById('unitContextMenu');

         document.querySelectorAll('.unit-box').forEach(box => {
             const checkbox = box.querySelector('input');

             box.addEventListener('click', function() {
                 checkbox.checked = !checkbox.checked;
                 box.classList.toggle('selected', checkbox.checked);
             });

             box.addEventListener('contextmenu', function(e) {
                 e.preventDefault();

                 currentUnitId = this.dataset.unitId;

                 menu.style.display = 'block';
                 menu.style.top = `${e.pageY}px`;
                 menu.style.left = `${e.pageX}px`;
             });
         });

         menu.querySelectorAll('li').forEach(item => {
             item.addEventListener('click', function() {
                 const action = this.dataset.action;
                 if (action === 'enquiry') {
                     window.location.href = `${enquiryCreateRoute}?bulk_ids[]=${currentUnitId}`;
                 }
                 if (action === 'proposal') {
                     window.location.href = `${proposalCreateRoute}?bulk_ids[]=${currentUnitId}`;
                 }
                 if (action === 'booking') {
                     window.location.href =
                         `${bookingCreateRoute}?bulk_ids[]=${currentUnitId}`;
                 }
                 if (action === 'agreement') {
                     window.location.href = `${agreementCreateRoute}?bulk_ids[]=${currentUnitId}`;
                 }



                 if (action === 'checkin') {
                     window.location.href = `/checkin/create?unit_id=${currentUnitId}`;
                 }

                 menu.style.display = 'none';
             });
         });

         document.addEventListener('click', () => {
             menu.style.display = 'none';
         });
     </script>
     <script>
         document.querySelector('form').addEventListener('submit', function() {
             let container = document.getElementById('bulk-hidden-inputs');
             container.innerHTML = '';

             document.querySelectorAll('.bulk-checkbox:checked').forEach(function(checkbox) {
                 let input = document.createElement('input');
                 input.type = 'hidden';
                 input.name = 'bulk_ids[]';
                 input.value = checkbox.value;
                 container.appendChild(input);
             });
         });
     </script>
 @endpush
