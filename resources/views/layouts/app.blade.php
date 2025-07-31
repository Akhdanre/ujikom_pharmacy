<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.header')
    @include('partials.sidebar')

    <main id="main" class="main">
        @yield('content')
    </main>

    @include('partials.footer')
    {{-- @include('partials.scripts') --}}
    
    @livewireScripts
</body>

</html>
