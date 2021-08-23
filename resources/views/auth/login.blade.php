<x-layout>
    <x-slot name="title">Login</x-slot>
  
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
                 <h1>Loggati!</h1>
  
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
                 <form action="{{route('login')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" value="{{old('email')}}" type="text" class="form-control @error('email') is=invalid
                        
                    @enderror"  id="email" aria-describedby="emailHelp">                  
                  </div>
                  
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" value="{{old('password')}}" type="text" class="form-control @error('password') is=invalid
                        
                    @enderror"  id="password" aria-describedby="passwordHelp">                  
                  </div>               
                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
  
              </div>          
          </div>
        </div>
  </x-layout>