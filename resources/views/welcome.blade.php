<x-layout>
    <x-header />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center my-5">{{__('ui.presentation')}}</h1>
            </div>
        </div>
    </div>
    @if(session('access.denied.revisor.only'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        ACCESSO CONSENTITO AI SOLI REVISORI DEL SITO
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
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
    </div>
</x-layout>