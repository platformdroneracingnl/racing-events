<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label class="form-label" for="name">@lang('auth.name') *</label>
            <input class="form-control" id="name" type="text" name="name" placeholder="Name" required>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label class="form-label" for="event_date">@lang('category/events.date') *</label>
            <input class="form-control" type="text" id="event_date" name="date" required autocomplete=“off”>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label class="form-label" for="start_registration">@lang('category/events.start_registration_from') *</label>
            <input class="form-control" type="text" id="start_registration" name="start_registration" required autocomplete=“off”>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label class="form-label" for="end_registration">@lang('category/events.end_registration_from') *</label>
            <input class="form-control" type="text" id="end_registration" name="end_registration" required autocomplete=“off”>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-2">
        <label class="form-label" for="price">@lang('category/events.price') *</label>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text" id="currency">EUR</span>
                <input type="number" class="form-control" id="price" name="price" min="0.00" step="0.05" placeholder="0.00" required aria-describedby="currency">
            </div>
            <small id="eventPrice" class="form-text text-muted mt--2"><i class="fas fa-info-circle"></i> Indien gratis vul een 0 in.</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="mb-3">
            <label class="form-label" for="max_registrations">@lang('category/events.max_attendees') *</label>
            <input class="form-control" type="number" id="max_registrations" name="max_registrations" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-2">
        <div class="mb-3">
            <label class="form-label" for="location">@lang('category/events.location') *</label>
            <select class="form-select" name="location_id" id="location" required>
                <option value="" disabled selected>--- {{__('Choose a location')}} ---</option>
                @foreach ($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
        <div class="mb-3">
            <label class="form-label" for="category">@lang('category/events.category') *</label>
            <select class="form-select" name="category" id="category" required>
                <option value="" disabled selected>--- {{__('Choose a category')}} ---</option>
                <option value="indoor">Indoor</option>
                <option value="outdoor">Outdoor</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label>@lang('category/events.information_link')</label>
            <input type="text" class="form-control" name="docs_link" id="docs_link" placeholder="https:// Google drive document etc." aria-describedby="eventInfoLink">
            <small id="eventInfoLink" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> Wanneer je naast de beschrijving gebruikers ook wel wijzen op een document.
            </small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="mb-3">
            <label>@lang('category/events.contact_email')</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="organisatie@hiertebereiken.nl" aria-describedby="eventEmail">
            <small id="eventEmail" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> Wanneer je deze optie <b>leeg houd</b>, wordt automatisch het e-mailadres gebruikt wat gekoppeld staat aan jouw account.
            </small>
        </div>
    </div>
</div>
<hr>
<div class="row mb-3">
    <h4>{{ __('Competition settings') }}</h4>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6">
        <div class="mb-3">
            <div class="square-switch">
                <input type="checkbox" id="inlineCheckbox1" switch="bool" checked />
                <label for="inlineCheckbox1" data-on-label="Yes" data-off-label="No"></label>
            </div>
            <label for="inlineCheckbox1" class="form-check-label">{{ __('Competition visible') }}?</label><br>
            {{-- <input id="inlineCheckbox1" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="online" aria-describedby="visible"> --}}
            <small id="visible" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> het aanzetten van deze optie, wordt de wedstrijd zichtbaar in het overzicht voor piloten.
            </small>
        </div>
        <div class="mb-3">
            <div class="square-switch">
                <input type="checkbox" id="inlineCheckbox2" switch="bool" checked />
                <label for="inlineCheckbox2" data-on-label="Yes" data-off-label="No"></label>
            </div>
            {{-- <input id="inlineCheckbox2" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="registration" aria-describedby="registration"> --}}
            <label for="inlineCheckbox2" class="form-check-label">{{ __('Registration open') }}?</label><br>
            <small id="registration" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> Zet deze optie aan wanneer je wil dat piloten zich kunnen inschrijven voor deze wedstrijd.
            </small>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="mb-3">
            <div class="square-switch">
                <input type="checkbox" id="inlineCheckbox3" switch="bool" checked />
                <label for="inlineCheckbox3" data-on-label="Yes" data-off-label="No"></label>
            </div>
            {{-- <input id="inlineCheckbox3" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="waitlist" aria-describedby="waitlist"> --}}
            <label for="inlineCheckbox3" class="form-check-label">{{ __('Waiting list allowed') }}?</label><br>
            <small id="waitlist" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> Wanneer je deze optie aanzet, krijgen inschrijvingen boven de maximale aantal een wachtlijst status en blijft de inschrijving geopend na bereiken van de maximale aantal.
            </small>
        </div>
        <div class="mb-3">
            <div class="square-switch">
                <input type="checkbox" id="inlineCheckbox4" switch="bool" checked />
                <label for="inlineCheckbox4" data-on-label="Yes" data-off-label="No"></label>
            </div>
            {{-- <input id="inlineCheckbox4" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="mollie_payments" aria-describedby="payments"> --}}
            <label for="inlineCheckbox4" class="form-check-label">{{ __('Payments via Mollie') }}?</label><br>
            <small id="payments" class="form-text text-muted">
                <i class="fas fa-info-circle"></i> Zet deze optie aan wanneer je wil dat PDRNL de betalingen verzorgt. Liever zelf de betaling administratie doen? Laat dan deze optie uitgeschakeld.
            </small>
        </div>
    </div>
</div>
    {{-- <div class="col-12 col-sm-12 col-md-12">
        <div class="mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Kies foto</label>
            </div>
        </div>
    </div> --}}
<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label class="form-label" for="description">@lang('pdrnl.information'): *</label>
            <textarea class="form-control" style="height:150px" id="description" name="description" placeholder="Details" required></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary btn-on-mobile">@lang('button.save')</button>
    </div>
</div>