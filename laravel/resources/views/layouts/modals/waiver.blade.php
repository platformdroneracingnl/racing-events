@php
    use Carbon\Carbon;
@endphp

<div class="modal fade" id="regModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('registration.event',$event->id) }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="">{{ $event->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center"><strong>@lang('category/events.waiver_title')</strong></h1>
                    <br>
                    <div class="row">
                        <div class="col">
                            <p>@lang('category/events.waiver_text_1')</p>
                            <p>@lang('category/events.waiver_text_2')</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="waiver-opt1" id="opt1" required>
                                <label class="form-check-label" for="opt1">
                                    @lang('category/events.waiver_opt1')
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="waiver-opt2" id="opt2" required>
                                <label class="form-check-label" for="opt2">
                                    @lang('category/events.waiver_opt2')
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="waiver-opt3" id="opt3" required>
                                <label class="form-check-label" for="opt3">
                                    @lang('category/events.waiver_opt3')
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span><strong>@lang('category/events.signed_by')</strong>: {{ Auth::user()->name }}<br>
                            <strong>@lang('category/events.date')</strong>: {{ Carbon::now()->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('button.close')</button>
                    <button type="submit" class="btn btn-info">@lang('category/events.register')</button>
                </div>
            </form>
        </div>
    </div>
</div>