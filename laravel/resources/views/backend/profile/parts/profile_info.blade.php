<div>
    <div>
        <h5 class="font-size-16 mb-4">Deelgenomen wedstrijden</h5>
        <ul class="activity-feed mb-0 ps-2">
            @foreach ($registrations->take(5) as $registration)
                <li class="feed-item">
                    <div class="feed-item-list">
                        <p class="text-muted mb-1">{{ $registration->event->date->format('d-m-Y') }}</p>
                        <h5 class="font-size-16">{{ $registration->event->name }}</h5>
                        <p>{{ $registration->event->location->name }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- <div>
        <h5 class="font-size-16 mb-4">Projects</h5>

        <div class="table-responsive">
            <table class="table table-nowrap table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Projects</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">01</th>
                        <td><a href="#" class="text-dark">Brand Logo Design</a></td>
                        <td>
                            18 Jun, 2020
                        </td>
                        <td>
                            <span class="badge bg-soft-primary font-size-12">Open</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">02</th>
                        <td><a href="#" class="text-dark">Minible Admin</a></td>
                        <td>
                            06 Jun, 2020
                        </td>
                        <td>
                            <span class="badge bg-soft-primary font-size-12">Open</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">03</th>
                        <td><a href="#" class="text-dark">Chat app Design</a></td>
                        <td>
                            28 May, 2020
                        </td>
                        <td>
                            <span class="badge bg-soft-success font-size-12">Complete</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">04</th>
                        <td><a href="#" class="text-dark">Minible Landing</a></td>
                        <td>
                            13 May, 2020
                        </td>
                        <td>
                            <span class="badge bg-soft-success font-size-12">Complete</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">05</th>
                        <td><a href="#" class="text-dark">Authentication Pages</a></td>
                        <td>
                            06 May, 2020
                        </td>
                        <td>
                            <span class="badge bg-soft-success font-size-12">Complete</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
</div>