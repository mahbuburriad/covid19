<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
@if(Auth::user()->theme == 'vertical_rtl' || Auth::user()->theme == 'vertical_box' || Auth::user()->theme == 'vertical')
    <script src="{{asset('assets/js/vertical-sidebar-menu.js')}}"></script>
@elseif(empty(Auth::user()->theme))
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
@else
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
@endif
<!-- Plugins JS start-->
@yield('script')
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>

<!-- Plugin used-->
