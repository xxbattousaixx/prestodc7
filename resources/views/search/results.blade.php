<x-layout>
<x-headerSec></x-headerSec>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-8 col-md-6">
                        <form method="GET" action="{{route('search.results')}}" class="d-flex mt-4">
                            <input class="form-control me-2 shadow" type="text" name="q" placeholder="Cerca un altro annuncio" aria-label="Search">
                            <button class="btn btn-outline-success shadow" type="submit">Cerca</button>
                        </form>
                    </div>
                </div>
                <h1 class="text-center mt-5 mb-4">Ecco cosa ho trovato:</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        @foreach ($articles as $article)
        <div class="col-12 col-md-3 mx-5 mb-5 card-annuncio d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h3>{{$article->title}}</h3>
                        <p>{{$article->body}}</p>
                        <div class="row">
                            <div class="col-12">
                                <strong>Categoria: <a href="{{route('public.articles.category', [$article->category->name, $article->category->id])}}">{{$article->category->name}}</a></strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <i>Annuncio inserito il {{ $article->created_at->format('d/m/Y') }}</i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <i>dall'utente <strong>{{ $article->user->name }}</strong></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="https://picsum.photos/300/500" class="img-fluid rounded h-100" alt="">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{$articles->links()}}
        </div>
    </div>
</x-layout>