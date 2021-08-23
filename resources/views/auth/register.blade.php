<x-layout>
    <x-slot name="title">Register!</x-slot>
  
    <x-slot name="style">
      <style>
        body{
          background-color: aquamarine;
        }
      </style>
    </x-slot>
  
    <x-slot name="scripts">
  
    </x-slot>
        <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                 <h1>Registrati!</h1>
  
                 @if (session('message'))
                     <div class="alert alert-success py-2 shadow my-4">
                       <p>{{session('message')}} </p>
                     </div>
                     
                 @endif
  
                 @if ($errors->any())
                   @foreach ($errors->all() as $error)
                    <div class="alert alert-danger shadow my-4 py-2">
                      <p>{{$error}} </p>
  
                    </div>
                     
                 @endforeach
                     
                 @endif
  
  
                 <!--Form -->
                 <form action="{{route('register')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input name="name" value="{{old('name')}}" type="text" class="form-control @error('name') is=invalid
                        
                    @enderror"  id="name" aria-describedby="nameHelp">                  
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" value="{{old('email')}}" type="text" class="form-control @error('email') is=invalid
                        
                    @enderror"  id="email" aria-describedby="emailHelp">                  
                  </div>
                  
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" value="{{old('password')}}" type="password" class="form-control @error('password') is=invalid
                        
                    @enderror"  id="password" aria-describedby="passwordHelp">                  
                  </div>
                  <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Conferma Password</label>
                    <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="form-control @error('password_confirmation') is=invalid
                        
                    @enderror"  id="password_confirmation" aria-describedby="password_confirmationHelp">                  
                  </div>                 
                  <button type="submit" class="btn btn-primary">Registrati</button>
                </form>
  
              </div>          
          </div>
        </div>
  </x-layout>