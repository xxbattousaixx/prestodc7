<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
  <a class="navbar-brand ms-3 fw-bold fs-4" href="/">Presto.it</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{__('ui.categories')}}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach ($categories as $category)
          <a href="{{route('public.articles.category', ['name'=>$category->name, 'id'=>$category->id])}}" class="nav link">{{$category->name}}</a>
          @endforeach
        </ul>
      </li>
      
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{route('articles.index')}}">{{__('ui.index')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('articles.create')}}">{{__('ui.create')}}</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">{{__('ui.create')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">{{__('ui.login')}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">{{__('ui.register')}}</a>
      </li>
      @endauth
      
      @auth
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <strong>{{Auth::user()->name}}</strong>
        </a>
        
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('form-logout').submit();">{{__('ui.logout')}}</a>
          </li>
          <form action="{{route('logout')}}" method="POST" id="form-logout">
            @csrf
          </form>
        </ul>
      </li>
      
      @if(Auth::user()->is_revisor)
        <li class="nav-item">
          <a href="{{route('revisor.home')}}" class="nav-link">
            <span class="text-danger mx-3"><strong>{{App\Models\Article::ToBeRevisionedCount()}} {{__('ui.revision')}}</strong></span>
          </a>
        </li>
        
          @endif
      @endauth
      <li class="nav-item">
        <form action="{{route('locale', 'en')}}" method="POST">
          @csrf
        <button type="submit" class="nav-link" style="background-color:transparent;border:none;">
          <span class="flag-icon flag-icon-gb"></span>
        </button>
        </form>
        </li>     <li class="nav-item">
          <form action="{{route('locale', 'it')}}" method="POST">
            @csrf
          <button type="submit" class="nav-link" style="background-color:transparent;border:none;">
            <span class="flag-icon flag-icon-it"></span>
          </button>
          </form>
          </li>     <li class="nav-item">
            <form action="{{route('locale', 'es')}}" method="POST">
              @csrf
            <button type="submit" class="nav-link" style="background-color:transparent;border:none;">
              <span class="flag-icon flag-icon-es"></span>
            </button>
            </form>
            </li>
    </ul>
  </div>
</nav>

