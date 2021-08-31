<x-layout>
    <x-headerSec></x-headerSec>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center my-5">{{__('ui.all')}}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            @foreach ($articles as $article)
            <div class="col-12 col-md-3 mx-5 mb-5 card-annuncio d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
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
                        <div class="col-6 justify-content-center">

                        <div id="cat-{{$article->id}}" class="carousel slide" data-bs-ride="carousel">
                           
                            <div class="carousel-inner">
                                @foreach($article->images as $image)
                        
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{$image->getUrl()}}">
                                      </div>
                                   
        
                                    {{-- <div class="col-8">
                                        {{$image->id}}<br />
                                        {{$image->file}}<br />
                                        {{Storage::url($image->file)}}<br />
                                    </div> --}}
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" data-bs-target="#cat-{{$article->id}}" role="button" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" data-bs-target="#cat-{{$article->id}}" role="button" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </a>
                          </div>
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