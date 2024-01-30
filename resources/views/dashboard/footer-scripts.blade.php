<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Include jQuery (required for Virtual Keyboard) -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{ asset('./assets/js/script.min.js?h=1f377b1554060dc8c64db4f251d4fee3') }}"></script>
    {{-- <script src="/assets/js/script.min.js?h=1f377b1554060dc8c64db4f251d4fee3"></script> --}}
   {{-- <script src="{{ mix('/js/app.js') }}"></script>--}}


    @yield('scripts')

    <!-- Include the Virtual Keyboard library -->
    <script src="path/to/jquery.keyboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/keyman/10.0.1/keyman.min.js"></script>
    <!-- END  Initialize the keyboard on the input -->

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
