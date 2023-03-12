<body id="kt_body" style="background-image: url(assets/media/patterns/header-bg.png)"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-enabled">

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('common.nav')

            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <div class="content flex-row-fluid" id="kt_content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@include('common.scripts')
</body>
