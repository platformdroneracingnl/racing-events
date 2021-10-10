
<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/waypoints/waypoints.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/litepicker/litepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/leaflet/leaflet.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/leaflet.locatecontrol/leaflet.locatecontrol.min.js') }}"></script>

@yield('script')

<!-- App js -->
<script src="{{ URL::asset('/assets/js/app.min.js')}}"></script>

<!-- Own scripts -->
<script src="{{ asset('pdrnl')}}/js/language.js"></script>

@yield('script-bottom')