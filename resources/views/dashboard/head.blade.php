<meta property="og:type" content="website">
	<meta name="description" content="PROJET RFID">
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

	<script
		type="application/ld+json">{"@context":"http://schema.org","@type":"WebSite","name":"SMARTTRACE","url":"https://smarttraceattendance.com"}</script>
	{{-- <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css?h=f2227b17fa6c7a34bd10412e47a7658b"> --}}
    <link rel="stylesheet" href="{{ asset('./assets/bootstrap/css/bootstrap.min.css?h=f2227b17fa6c7a34bd10412e47a7658b') }}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
	{{-- <link rel="stylesheet" href="./assets/css/styles.min.css?h=d429336141ae5a3103f8097f8d05c177"> --}}
    <link rel="stylesheet" href="{{ asset('./assets/css/styles.min.css?h=d429336141ae5a3103f8097f8d05c177') }}">

	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https:////cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Include the Virtual Keyboard library -->
    {{-- <link rel="stylesheet" href="path/to/keyboard.css"> --}}
    {{--<link href="{{ mix('/css/app.css') }}"/> --}}


    @yield('css')
