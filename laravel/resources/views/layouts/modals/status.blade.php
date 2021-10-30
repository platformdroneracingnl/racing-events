<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Information about registrations') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('Explanation of the different statuses in the registration') }}:
                    <ul>
                        <li><b>{{ __('Waiting for payment') }}</b>: {{ __('registration has been received and is awaiting payment') }}</li>
                        <li><b>{{ __('Registration complete') }}</b>: {{ __('payment has been received, registration for the competition has been completed') }}</li>
                        <li><b>{{ __('Waitlist') }}</b>: {{ __('race is full and pilot is on a waiting list (if waiting list option is enabled)') }}</li>
                        <li><b>{{ __('Canceled') }}</b>: {{ __('registration has been canceled, but the pilot will not be refunded the registration fee') }}</li>
                        <li><b>{{ __('Refunded') }}</b>: {{ __('registration has been canceled and the organizer has refunded the registration fee') }}</li>
                    </ul>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
            </div>
        </div>
    </div>
</div>