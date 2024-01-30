<!DOCTYPE html>
<html data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Dashboard - SMARTTRACE</title>


	@include('dashboard.head')


</head>

<body id="page-top" >
	
    <div id="wrapper">

        @include('dashboard.main-sidebar')

		<div class="d-flex flex-column" id="content-wrapper">
                <div id="content" >

                @include('dashboard.main-headerbar')

                    @yield('content')

                </div>

            
            
                @include('dashboard.footer')
            

		</div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
       
    </div>
    
  

    @include('dashboard.footer-scripts')


</body>

</html>
