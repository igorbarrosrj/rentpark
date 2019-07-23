<!DOCTYPE html>
<html>
<head>
    <!-- Include the head data -->
	@include('layouts.admin.styles')
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">RentPark Lite</p>
        </div>
    </div>

    <div id="main-wrapper">

        <!-- Include the Header -->

    	@include('layouts.admin.header')

    	@include('layouts.admin.sidebar')

        <div class="page-wrapper">

            <!-- Content will extend in another file -->
        	@yield('content')

            @include('notifications.notification')

            <!-- Include the footer -->
        	@include('layouts.admin.footer')

        </div>
    </div>

    <!-- Include the all scripts -->
    @include('layouts.admin.scripts')
</body>
</html>