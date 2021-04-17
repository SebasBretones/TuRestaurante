<!DOCTYPE html>

    @include('partials._head')

    <body>

        @include('partials._navigation')

        <div class="container">

            @yield('content')

            @include('partials._footer')

        </div>

        @include('partials._js')

        @yield('scripts')

    </body>
</html>
