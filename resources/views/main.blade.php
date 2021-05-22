<!DOCTYPE html>

    @include('partials._head')
    @yield('css')

    <body>

        @include('partials._navigation')

        <div class="container">
            <div class="text-center">
                <p class="title">@yield('title')</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @elseif(Session::has('mensaje'))
                    <div class="alert alert-success">
                        <li>{{Session::get('mensaje')}}</li>
                    </div>
                @endif
            </div>

            @yield('content')

            <!--@include('partials._footer')-->

        </div>

        @yield('noContainer')


        @include('partials._js')
        @yield('js')

    </body>
</html>

