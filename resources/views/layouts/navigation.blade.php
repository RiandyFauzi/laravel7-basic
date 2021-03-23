<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
    </a>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <form action="{{ route('search.post')}}" method="get" class="form-inline my-2 my-lg-0">
        <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>



      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item{{ request()->is('about') ? ' active' : '' }}">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item{{ request()->is('contact') ? ' active' : '' }}">
            <a class="nav-link" href="/contact">Contact</a>
          </li>
          <li class="nav-item{{ request()->is('login') ? ' active' : '' }}">
            <a class="nav-link" href="/login">Login</a>
          </li>
          <li class="nav-item{{ request()->is('post') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('posts.index')}}">Post</a>
          </li>
        </ul>
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{ route('posts.create') }}" class="dropdown-item">New Post</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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