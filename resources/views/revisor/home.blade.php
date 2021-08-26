<x-layout>
    <x-headerSec></x-headerSec>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center mt-5">Benvenuto Revisore <strong class="text-warning">{{Auth::user()->name}}</strong></h1>
                <p class="text-center mb-5"><a href="{{route('revisor.rejected')}}">Clicca per rivedere gli annunci rifiutati</a></p>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            @if(session('access.denied.revisor.only'))
            <div class="container">
                <div class="row justify-content-center mb-5"> 
                    <div class="alert alert-danger">
                        Accesso non consentito -- Solo per revisori
                    </div>
                </div>
            </div>
            @endif

            @if($article)
                <div class="col-12 mx-5 mb-5 card-annuncio d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center">
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
                            <div class="col-4 d-flex justify-content-center">
                                <img src="https://picsum.photos/200/300" class="img-fluid rounded h-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-evenly">
                        <div class="col-6 d-flex justify-content-evenly">
                            <form action="{{route('revisor.accept',$article->id)}}" Method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Accetta</button>
                            </form>
                        </div>
                        <div class="col-6 d-flex justify-content-evenly">
                            <form action="{{route('revisor.reject',$article->id)}}" Method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rifiuta</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <h2 class="text-center my-5">Non ci sono articoli da revisionare</h2>
            @endif
    </div>
</x-layout>

{{-- <div class="col-10 mb-4">
    <div class="card">
        <div class="card-header">{{ $article->title }}</div>
        <div class="card-body">
            <p>
                <img src="https://picsum.photos/300/150" class="rounded float-right" alt="">
                {{ $article->body }}
            </p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <strong>Categoria: <a href="{{route('public.articles.category', [$article->category->name, $article->category->id])}}">{{ $article->category->name }}</a></strong>
            <i>{{ $article->created_at->format('d/m/Y') }} - {{ $article->user->name }}</i>
        </div>
    </div>
</div>
<div class="row justify-content-center mt-5"> --}}