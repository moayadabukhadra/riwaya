<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
@include('common.head')
<style>
    @import url('https://fonts.googleapis.com/css2?family=El+Messiri&display=swap');

    body {
        font-family: 'El Messiri', sans-serif;
    }
</style>
<body>
<main class="d-flex align-items-center justify-content-center min-vh-100">
    @yield('content')
    @include('common.scripts')
</main>
</body>
</html>
