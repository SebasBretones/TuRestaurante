<!DOCTYPE html>

    @include('partials._head')
    @yield('css')

    <body>

        @include('partials._navigation')
        @yield('title')
        <div class="container">
            <div class="text-center">
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @elseif(Session::has('mensaje'))
                    <div class="alert alert-success mt-2">
                        <li>{{Session::get('mensaje')}}</li>
                    </div>
                @elseif (Session::has('aviso'))
                    <div class="alert alert-warning mt-2">
                        <li>{{Session::get('aviso')}}</li>
                    </div>
                @endif
            </div>

            @yield('content')

        </div>

        @yield('noContainer')


        @include('partials._js')
        @yield('js')

    </body>
</html>

