<x-layout>
    <x-headerSec></x-headerSec>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center my-5">Gli annunci della categoria <strong class="text-warning">{{$category->name}}</strong></h1>
            </div>
        </div>
    </div>
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
                                        <strong>{{__('ui.cat')}}<a href="{{route('public.articles.category', [$article->category->name, $article->category->id])}}">{{$article->category->name}}</a></strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <i>{{__('ui.inserted')}} {{ $article->created_at->format('d/m/Y') }}</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <i>{{__('ui.user')}} <strong>{{ $article->user->name }}</strong></i>
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{$articles->links()}}
        </div>
    </div>
</x-layout>