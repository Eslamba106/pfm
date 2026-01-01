<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('ready_to_Leave')}}?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{__('Select_Logout_below_if_you_are_ready_to_end_your_current_session')}}.</div>
            <div class="modal-footer">
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-danger" type="button" data-dismiss="modal">{{__('cancel')}}</button>
                    <button class="btn btn--primary" type="submit">{{__('logout')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="popup-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h2 class="__color-8a8a8a">
                                <i class="tio-shopping-cart-outlined"></i> {{ __('you_have_new_order') }}, {{ __('check_please') }}.
                            </h2>
                            <hr>
                            <button onclick="check_order()" class="btn btn--primary">{{ __('ok') }}, {{ __('let_me_check') }}</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
