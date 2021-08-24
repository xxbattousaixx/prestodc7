<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand ms-3" href="#">Presto.it</a>
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
            Categorie annunci
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $category)
                <a href="{{route('public.articles.category', ['name'=>$category->name, 'id'=>$category->id])}}" class="nav link">{{$category->name}}</a>
            @endforeach
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        @auth      
        <li class="nav-item">
            <a class="nav-link" href="{{route('articles.index')}}">Guarda tutti gli annunci</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('articles.create')}}">Crea Annuncio</a>
          </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Crea Annuncio</a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Registrati</a>
          </li>
        @endauth
        
        @auth
          <li class="nav-item">
            <a class="nav-link" href="#">{{Auth::user()->name}}</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('form-logout').submit();">Logout</a>
          </li>           
            <form action="{{route('logout')}}" method="POST" id="form-logout">
              @csrf
            </form> 
        @endauth
      </ul>      
    </div>
  </nav>