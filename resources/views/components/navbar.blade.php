<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
       
        @auth      
        <li class="nav-item">
            <a class="nav-link" href="{{route('articles.create')}}">Crea Annuncio</a>
          </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Register</a>
          </li>
        @endauth
        <li class="nav-item">
            <a class="nav-link" href="{{route('articles.index')}}">Vedere Annunci</a>
          </li>
  
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