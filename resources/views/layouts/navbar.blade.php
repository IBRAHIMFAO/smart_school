
<nav class="navbar navbar-expand-md navbar-light bg-light">

        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- <img class="img-fluid" src="{{ url('image/logo2.png') }}" style="width: 130px; height: 50px;"> --}}
                {{-- <img class="img-fluid" src="{{ asset('storage/logos/Albita.png') }}" alt="School Logo" class="navbar-logo" width="150px"> --}}
                {{-- <img class="img-fluid" src="{{ asset('SMART_SCHOOL_MANAGEMENT/storage/logos/Albita.png') }}" alt="School Logo" class="navbar-logo" width="150px"> --}}
                <img  class="img-fluid" src="{{ asset('storage/images/logos/LogoAlbita2.png') }}" alt="logo ecole" title="logo" width="200px"  />
                
                {{-- <span class="fw-bold" style="font-size: 20px;">EduPortail</span> --}}
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item fw-bold">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item fw-bold">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
