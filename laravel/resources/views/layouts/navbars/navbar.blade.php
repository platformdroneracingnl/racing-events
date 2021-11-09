@auth()
    <!-- User must be logged in
    In the end it should be != -->
    @if (Auth::user()->email_verified_at != null)
        @if (auth()->user()->setting('layout_sidebar'))
            @include('layouts.navbars.sidebar.topbar')
            @include('layouts.navbars.sidebar.nav')
        @else
            @include('layouts.navbars.horizontal.nav')
        @endif
    @else
        <!-- Else show nav when the user must verify first -->
        {{-- @include('layouts.navbars.navs.verify_nav') --}}
        @include('layouts.navbars.guest')
    @endif
@endauth
    
@guest()
    <!-- If the user is a guest -->
    @include('layouts.navbars.guest')
@endguest