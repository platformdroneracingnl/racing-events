<!-- ========== Horizontal menu Start ========== -->
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <!-- Brand logo -->
            @include('layouts.navbars.snippets.logo')

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')...">
                    <span class="uil-search"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">
                    
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('layouts.navbars.snippets.right-topbar')

        </div>
    </div>

    <!-- Menu -->
    <div class="container-fluid">
        <div class="topnav">

            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
    
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard')}}">
                                <i class="uil-home-alt me-2"></i> @lang('translation.Dashboard')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="https://rankings.platformdroneracing.nl/" target="_blank">
                                <i class="fas fa-poll-h me-2"></i> @lang('menu.results')
                            </a>
                        </li>
    
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                <i class="uil-flask me-2"></i>@lang('translation.UI_Elements') <div class="arrow-down"></div>
                            </a>

                            <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                aria-labelledby="topnav-uielement">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-alerts" class="dropdown-item">@lang('translation.Alerts')</a>
                                            <a href="ui-buttons" class="dropdown-item">@lang('translation.Buttons')</a>
                                            <a href="ui-cards" class="dropdown-item">@lang('translation.Cards')</a>
                                            <a href="ui-carousel" class="dropdown-item">@lang('translation.Carousel')</a>
                                            <a href="ui-dropdowns" class="dropdown-item">@lang('translation.Dropdowns')</a>
                                            <a href="ui-grid" class="dropdown-item">@lang('translation.Grid')</a>
                                            <a href="ui-images" class="dropdown-item">@lang('translation.Images')</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-lightbox" class="dropdown-item">@lang('translation.Lightbox')</a>
                                            <a href="ui-modals" class="dropdown-item">@lang('translation.Modals')</a>
                                            <a href="ui-rangeslider" class="dropdown-item">@lang('translation.Range_Slider')</a>
                                            <a href="ui-session-timeout" class="dropdown-item">@lang('translation.Session_Timeout')</a>
                                            <a href="ui-progressbars" class="dropdown-item">@lang('translation.Progress_Bars')</a>
                                            <a href="ui-sweet-alert" class="dropdown-item">@lang('translation.Sweet_Alert')</a>
                                            <a href="ui-tabs-accordions" class="dropdown-item">@lang('translation.Tabs_Accordions')</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-typography" class="dropdown-item">@lang('translation.Typography')</a>
                                            <a href="ui-video" class="dropdown-item">@lang('translation.Video')</a>
                                            <a href="ui-general" class="dropdown-item">@lang('translation.General')</a>
                                            <a href="ui-colors" class="dropdown-item">@lang('translation.Colors')</a>
                                            <a href="ui-rating" class="dropdown-item">@lang('translation.Rating')</a>
                                            <a href="ui-notifications" class="dropdown-item">@lang('translation.Notifications')</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li> --}}
    
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i class="uil-apps me-2"></i>@lang('translation.Apps') <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="calendar" class="dropdown-item">@lang('translation.Calendar')</a>
                                <a href="chat" class="dropdown-item">@lang('translation.Chat')</a>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                        role="button">
                                        @lang('translation.Email') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-email">
                                        <a href="email-inbox" class="dropdown-item">@lang('translation.Inbox')</a>
                                        <a href="email-read" class="dropdown-item">@lang('translation.Read_Email')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                        role="button">
                                        @lang('translation.Ecommerce') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                        <a href="ecommerce-products" class="dropdown-item">@lang('translation.Products')</a>
                                        <a href="ecommerce-product-detail" class="dropdown-item">@lang('translation.Product_Detail')</a>
                                        <a href="ecommerce-orders" class="dropdown-item">@lang('translation.Orders')</a>
                                        <a href="ecommerce-customers" class="dropdown-item">@lang('translation.Customers')</a>
                                        <a href="ecommerce-cart" class="dropdown-item">@lang('translation.Cart')</a>
                                        <a href="ecommerce-checkout" class="dropdown-item">@lang('translation.Checkout')</a>
                                        <a href="ecommerce-shops" class="dropdown-item">@lang('translation.Shops')</a>
                                        <a href="ecommerce-add-product" class="dropdown-item">@lang('translation.Add_Product')</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                        role="button">
                                        @lang('translation.Invoices') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                        <a href="invoices-list" class="dropdown-item">@lang('translation.Invoice_List')</a>
                                        <a href="invoices-detail" class="dropdown-item">@lang('translation.Invoice_Detail')</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                        role="button">
                                        @lang('translation.Contacts') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                        <a href="contacts-grid" class="dropdown-item">@lang('translation.User_Grid')</a>
                                        <a href="contacts-list" class="dropdown-item">@lang('translation.User_List')</a>
                                        <a href="contacts-profile" class="dropdown-item">@lang('translation.Profile')</a>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
    
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                <i class="uil-layers me-2"></i>@lang('translation.Components') <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                        role="button">
                                        @lang('translation.Forms') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-form">
                                        <a href="form-elements" class="dropdown-item">@lang('translation.Basic_Elements')</a>
                                        <a href="form-validation" class="dropdown-item">@lang('translation.Validation')</a></a>
                                        <a href="form-advanced" class="dropdown-item">@lang('translation.Advanced_Plugins')</a>
                                        <a href="form-editors" class="dropdown-item">@lang('translation.Editors')</a>
                                        <a href="form-uploads" class="dropdown-item">@lang('translation.File_Upload')</a>
                                        <a href="form-xeditable" class="dropdown-item">@lang('translation.Xeditable')</a>
                                        <a href="form-repeater" class="dropdown-item">@lang('translation.Repeater')</a>
                                        <a href="form-wizard" class="dropdown-item">@lang('translation.Wizard')</a>
                                        <a href="form-mask" class="dropdown-item">@lang('translation.Mask')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                        role="button">
                                        @lang('translation.Tables') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-table">
                                        <a href="tables-basic" class="dropdown-item">@lang('translation.Bootstrap_Basic')</a>
                                        <a href="tables-datatable" class="dropdown-item">@lang('translation.Datatables')</a>
                                        <a href="tables-responsive" class="dropdown-item">@lang('translation.Responsive')</a>
                                        <a href="tables-editable" class="dropdown-item">@lang('translation.Editable')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                        role="button">
                                        @lang('translation.Charts') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                        <a href="charts-apex" class="dropdown-item">@lang('translation.Apex')</a>
                                        <a href="charts-chartjs" class="dropdown-item">@lang('translation.Chartjs')</a>
                                        <a href="charts-flot" class="dropdown-item">@lang('translation.Flot')</a>
                                        <a href="charts-knob" class="dropdown-item">@lang('translation.Jquery_Knob')</a>
                                        <a href="charts-sparkline" class="dropdown-item">@lang('translation.Sparkline')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                        role="button">
                                        @lang('translation.Icons') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                        <a href="icons-unicons" class="dropdown-item">@lang('translation.Unicons')</a>
                                        <a href="icons-boxicons" class="dropdown-item">@lang('translation.Boxicons')</a>
                                        <a href="icons-materialdesign" class="dropdown-item">@lang('translation.Material_Design')</a>
                                        <a href="icons-dripicons" class="dropdown-item">@lang('translation.Dripicons')</a>
                                        <a href="icons-fontawesome" class="dropdown-item">@lang('translation.Font_Awesome')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                        role="button">
                                        @lang('translation.Maps') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-map">
                                        <a href="maps-google" class="dropdown-item">@lang('translation.Google')</a>
                                        <a href="maps-vector" class="dropdown-item">@lang('translation.Vector')</a>
                                        <a href="maps-leaflet" class="dropdown-item">@lang('translation.Leaflet')</a>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
    
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                <i class="uil-copy me-2"></i>@lang('translation.Extra_pages') <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-more">
                                
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                        role="button">
                                        @lang('translation.Authentication') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                        <a href="auth-login" class="dropdown-item">@lang('translation.Login')</a>
                                        <a href="auth-register" class="dropdown-item">@lang('translation.Register')</a>
                                        <a href="auth-recoverpw" class="dropdown-item">@lang('translation.Recover_Password')</a>
                                        <a href="auth-lock-screen" class="dropdown-item">@lang('translation.Lock_Screen')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                        role="button">
                                        @lang('translation.Utility') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                        <a href="pages-starter" class="dropdown-item">@lang('translation.Starter_Page')</a>
                                        <a href="pages-maintenance" class="dropdown-item">@lang('translation.Maintenance')</a>
                                        <a href="pages-comingsoon" class="dropdown-item">@lang('translation.Coming_Soon')</a>
                                        <a href="pages-timeline" class="dropdown-item">@lang('translation.Timeline')</a>
                                        <a href="pages-faqs" class="dropdown-item">@lang('translation.FAQs')</a>
                                        <a href="pages-pricing" class="dropdown-item">@lang('translation.Pricing')</a>
                                        <a href="pages-404" class="dropdown-item">@lang('translation.Error_404')</a>
                                        <a href="pages-500" class="dropdown-item">@lang('translation.Error_500')</a>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        <!-- Layouts -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button">
                                <i class="uil-window-section me-2"></i>@lang('translation.Layouts') <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-verti"
                                        role="button">
                                        @lang('translation.Vertical') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-verti">
                                        <a href="layouts-dark-sidebar" class="dropdown-item">@lang('translation.Dark_Sidebar')</a>
                                        <a href="layouts-compact-sidebar" class="dropdown-item">@lang('translation.Compact_Sidebar')</a>
                                        <a href="layouts-icon-sidebar" class="dropdown-item">@lang('translation.Icon_Sidebar')</a>
                                        <a href="layouts-boxed" class="dropdown-item">@lang('translation.Boxed_Width')</a>
                                        <a href="layouts-preloader" class="dropdown-item">@lang('translation.Preloader')</a>
                                        <a href="layouts-colored-sidebar" class="dropdown-item">@lang('translation.Colored_Sidebar')</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-hori"
                                        role="button">
                                        @lang('translation.Horizontal') <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-hori">
                                        <a href="layouts-horizontal" class="dropdown-item">@lang('translation.Horizontal')</a>
                                        <a href="layouts-hori-topbar-dark" class="dropdown-item">@lang('translation.Dark_Topbar')</a>
                                        <a href="layouts-hori-boxed-width" class="dropdown-item">@lang('translation.Boxed_Width')</a>
                                        <a href="layouts-hori-preloader" class="dropdown-item">@lang('translation.Preloader')</a>
                                    </div>
                                </div>
                            </div>
                        </li> --}}

                        <!-- Management -->
                        @if(auth()->user()->hasRole(['organizer','manager','supervisor']))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-management" role="button">
                                    <i class="uil-window-section me-2"></i>Management <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-management">
                                    @can('user-list')
                                        <a class="dropdown-item {{ Route::currentRouteNamed('management.users.*') ? 'active' : '' }}" href="{{ route('management.users.index') }}">
                                            @lang('menu.manage_users')
                                        </a>
                                    @endcan
                                    @can('role-list')
                                        <a class="dropdown-item {{ Route::currentRouteNamed('management.roles.*') ? 'active' : '' }}" href="{{ route('management.roles.index') }}">
                                            @lang('menu.manage_roles')
                                        </a>
                                    @endcan
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>