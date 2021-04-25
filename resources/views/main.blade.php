<!DOCTYPE html>

    @include('partials._head')

    <body>

        @include('partials._navigation')

        <div class="container center">
            <div class="py-5 text-center">
                <h1>@yield('title')</h1>
            </div>

            @yield('content')

            @include('partials._footer')

        </div>

        @include('partials._js')

    </body>
</html>
