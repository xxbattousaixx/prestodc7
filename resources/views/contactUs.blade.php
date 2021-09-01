<x-layout>
    <x-headerSec></x-headerSec>
    <div class="container">
        <div class="row">
            <div class="col-12"></div>
            <h1 class="text-center mt-5">Contattaci!</h1>

            @if (session('message'))
            <div class="alert alert-success py-2 shadow my-4">
                <p>{{session('message')}}</p>
            </div>
            @endif

            @if ($errors ->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger shadow my-4 py-2">
                <p>{{$error}}</p>
            </div>
            @endforeach
            @endif

            <form action="{{route('saveContact')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input name="name" value="{{old('name')}}" type="text" class="form-control  @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Inserisci il nome">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Inserisci la mail">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Messaggio</label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Scrivi il tuo messaggio">{{old('message')}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>

</x-layout>