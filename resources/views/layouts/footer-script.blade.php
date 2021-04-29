        <!-- jQuery  -->
        <script src="{{ URL::to('assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::to('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ URL::to('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ URL::to('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ URL::to('assets/js/waves.min.js')}}"></script>

        <script src="{{ URL::to('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        @yield('script')

        <!-- App js -->
        <script src="{{ URL::to('assets/js/app.js')}}"></script>
        
        @yield('script-bottom')