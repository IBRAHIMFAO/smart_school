<!DOCTYPE html>
<html data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Dashboard - SMARTSchool</title>


	@include('dashboard.head')

</head>

<body id="page-top">
	<div id="wrapper">


        {{-- <div class="sidebar" style="margin-top: 10%" >
            @include('dashboard.public.sidebar')
        </div> --}}

		<div class="d-flex flex-column" id="content-wrapper">
			<div id="content">

            {{-- @include('dashboard.main-headerbar') --}}
            @include('dashboard.public.navbar')


				@yield('content')

			</div>



            @include('dashboard.footer')


		</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
	</div>

    @include('dashboard.footer-scripts')

</body>

</html>
