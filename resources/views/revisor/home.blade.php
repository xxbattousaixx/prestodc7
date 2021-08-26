<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Benvenuto Revisore {{Auth::user()->name}}</h1>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            @if(session('access.denied.revisor.only'))
            <div class="alert alert-danger">
                Accesso non consentito -- solo per revisori
            </div>
            @endif
            @if($article)
            <div class="col-10 mb-4">
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

            <div class="row justify-content-center mt-5">
                <div class="col-3"></div>
                <div class="col-md-3">
                    <form action="{{route('revisor.reject',$article->id)}}" Method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rifiuta</button>
                    </form>
                </div>
                <div class="col-md-3 text-right">
                    <form action="{{route('revisor.accept',$article->id)}}" Method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Accetta</button>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
            @else
            <h2>Non ci sono articoli da revisionare</h2>
            @endif

        </div>


    </div>

    <hr /><a href="{{route('revisor.rejected')}}">Clicca per revisionare gli articoli rifiutati</a>



</x-layout>