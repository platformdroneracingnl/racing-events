<div id="event-accordion" class="custom-accordion">
    <!-- Event settings -->
    <div class="card">
        <a href="#event-settings-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
            aria-controls="event-settings-collapse">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                01
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">{{ __('Event settings') }}</h5>
                        <p class="text-muted text-truncate mb-0">Configureer hier je wedstrijd</p>
                    </div>
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </a>

        <div id="event-settings-collapse" class="collapse show" data-bs-parent="#event-accordion">
            <div class="p-4 border-top">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <label class="form-label" for="name">@lang('auth.label_name') *</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="event_date">@lang('category/events.date') *</label>
                            <input class="form-control" type="text" id="event_date" name="date" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="location">@lang('category/events.location') *</label>
                            <select class="select2 form-select" name="location_id" id="location" required>
                                <option value="" disabled selected>--- {{__('Choose a location')}} ---</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="category">@lang('category/events.category') *</label>
                            <select class="form-select" name="category" id="category" required>
                                <option value="" disabled selected>--- {{__('Choose a category')}} ---</option>
                                <option value="training">Training</option>
                                <option value="ranking">Ranking</option>
                                <option value="fun-race">Fun Race</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="start_registration">@lang('category/events.start_registration_from') *</label>
                            <input class="form-control" type="text" id="start_registration" name="start_registration" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="end_registration">@lang('category/events.end_registration_from') *</label>
                            <input class="form-control" type="text" id="end_registration" name="end_registration" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="price">@lang('category/events.price')</label>
                            <div class="input-group">
                                <span class="input-group-text" id="currency">EUR</span>
                                <input type="number" class="form-control" id="price" name="price" min="0.00" step="any" data-type="currency" aria-describedby="eventPrice">
                            </div>
                            <small id="eventPrice" class="form-text text-muted mt--2"><i class="fas fa-info-circle"></i> Bij leeglaten is het event gratis.</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="max_registrations">@lang('category/events.max_attendees') *</label>
                            <input class="form-control" type="number" id="max_registrations" name="max_registrations" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">@lang('pdrnl.information') *</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Information about the event" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Options -->
    <div class="card">
        <a href="#event-options-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
            aria-controls="event-options-collapse">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                02
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">{{ __('Options') }}</h5>
                        <p class="text-muted text-truncate mb-0">Kies hier uit bepaalde wedstrijd opties</p>
                    </div>
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </a>

        <div id="event-options-collapse" class="collapse" data-bs-parent="#event-accordion">
            <div class="p-4 border-top">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                            <div class="square-switch">
                                <input type="checkbox" id="inlineCheckbox1" name="online" switch="bool" />
                                <label for="inlineCheckbox1" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                            </div>
                            <label for="inlineCheckbox1" class="form-check-label">{{ __('Competition visible') }}?</label><br>
                            {{-- <input id="inlineCheckbox1" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="online" aria-describedby="visible"> --}}
                            <small id="visible" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> het aanzetten van deze optie, wordt de wedstrijd zichtbaar in het overzicht voor piloten.
                            </small>
                        </div>
                        <div class="mb-3">
                            <div class="square-switch">
                                <input type="checkbox" id="inlineCheckbox2" name="registration" switch="bool" />
                                <label for="inlineCheckbox2" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
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
                                <input type="checkbox" id="inlineCheckbox3" name="waitlist" switch="bool" />
                                <label for="inlineCheckbox3" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                            </div>
                            {{-- <input id="inlineCheckbox3" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="waitlist" aria-describedby="waitlist"> --}}
                            <label for="inlineCheckbox3" class="form-check-label">{{ __('Waiting list allowed') }}?</label><br>
                            <small id="waitlist" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Wanneer je deze optie aanzet, krijgen inschrijvingen boven de maximale aantal een wachtlijst status en blijft de inschrijving geopend na bereiken van de maximale aantal.
                            </small>
                        </div>
                        <div class="mb-3">
                            <div class="square-switch">
                                <input type="checkbox" id="inlineCheckbox4" name="mollie_payments" switch="bool" />
                                <label for="inlineCheckbox4" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                            </div>
                            {{-- <input id="inlineCheckbox4" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="mollie_payments" aria-describedby="payments"> --}}
                            <label for="inlineCheckbox4" class="form-check-label">{{ __('Payments via Mollie') }}?</label><br>
                            <small id="payments" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Zet deze optie aan wanneer je wil dat PDRNL de betalingen verzorgt. Liever zelf de betaling administratie doen? Laat dan deze optie uitgeschakeld.
                            </small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="mb-">
                            <div class="square-switch">
                                <input type="checkbox" id="inlineCheckbox5" name="google_calendar" switch="bool" />
                                <label for="inlineCheckbox5" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                            </div>
                            {{-- <input id="inlineCheckbox4" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="mollie_payments" aria-describedby="payments"> --}}
                            <label for="inlineCheckbox5" class="form-check-label">{{ __('Google Calendar') }}?</label><br>
                            <small id="calendar" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Zet deze optie aan om de wedstrijd te laten zien in de PDRNL kalender. Liever niet? Laat dan deze optie uitgeschakeld.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual and contact -->
    <div class="card">
        <a href="#visual-contact-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
            aria-controls="visual-contact-collapse">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                03
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">{{ __('Vormgeving en contact') }}</h5>
                        <p class="text-muted text-truncate mb-0">Visuals van de wedstrijd op het platform</p>
                    </div>
                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                </div>
            </div>
        </a>

        <div id="visual-contact-collapse" class="collapse" data-bs-parent="#event-accordion">
            <div class="row">
                <!-- Location image -->
                <img id="img-upload" src="{{ asset('pdrnl') }}/img/image-placeholder.jpg" alt="Your event image" style="object-fit: cover; object-position: center; height: 500px;">
            </div>
            <div class="p-4 border-top">
                <div class="row text-center">
                    <div class="mb-3">
                        <p class="text-muted">
                            {{ __('Upload an image of the event here. The preview only shows a part of the image, this is not the final view everywhere on the platform.') }}
                        </p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8">
                            <div class="mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="customFile" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="mb-3">
                            <label>@lang('category/events.information_link')</label>
                            <input type="text" class="form-control" name="docs_link" id="docs_link" placeholder="https:// Google drive document etc." aria-describedby="eventInfoLink">
                            <small id="eventInfoLink" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Wanneer je naast de beschrijving gebruikers ook wel wijzen op een document.
                            </small>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="mb-3">
                            <label>@lang('category/events.contact_email')</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="organisatie@hiertebereiken.nl" aria-describedby="eventEmail">
                            <small id="eventEmail" class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> Wanneer je deze optie <b>leeg houd</b>, wordt automatisch het e-mailadres gebruikt wat gekoppeld staat aan jouw account.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>