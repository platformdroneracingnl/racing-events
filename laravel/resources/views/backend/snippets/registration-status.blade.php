@switch($registration->status_id)
    @case(1)
        <!-- Registered -->
        <span class="badge bg-soft-primary">{{ __($registration->status->name) }}</span>
        @break
    @case(2)
        <!-- Waiting for payment -->
        <span class="badge bg-soft-info">{{ __($registration->status->name) }}</span>
        @break
    @case(3)
        <!-- Signed up -->
        <span class="badge bg-soft-success">{{ __($registration->status->name) }}</span>
        @break
    @case(4)
        <!-- Waitlist -->
        <span class="badge bg-soft-info">{{ __($registration->status->name) }}</span>
        @break
    @default
        <!-- Canceled -->
        <span class="badge bg-soft-danger">{{ __($registration->status->name) }}</span>
@endswitch