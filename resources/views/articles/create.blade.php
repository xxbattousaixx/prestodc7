<x-layout>
    <x-headerSec></x-headerSec>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5">Scrivi un annuncio!</h1>
                
                @if (session('message'))
                <div class="alert alert-success py-2 shadow my-4">
                    <p>{{session('message')}}</p>
                </div>
                @endif
                
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger shadow my-4 py-2">
                    <p>{{$error}}</p>
                </div>
                @endforeach
                @endif

                <form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data" class="mb-5">
                    @csrf   
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input name="title" value="{{old('title')}}" type="text" class="form-control @error('title') is-invalid @enderror " id="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <textarea name="body" class="form-control @error('body') is-invalid @enderror"  placeholder="Scrivi il tuo messaggio" id="" cols="30" rows="10">{{old('body')}}</textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <input name="img" type="file" class="form-control">
                    </div> --}}

                    <div class="mb-3">
                        <select name="category_id" class="form-select" aria-label="multiple select example">
                            <option selected>Scegli la categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id }}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crea</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
