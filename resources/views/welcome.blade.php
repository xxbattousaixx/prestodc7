<x-layout>
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Benvenuti in Presto</h1>
        </div>
    </div>

    @foreach ($articles as $article)
     <div class="row justify-content-center mb-5">
         <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">{{ $article->title }}</div>

                <div class="card-body">
                    <p>

                        <img
                             src="https://picsum.photos/300/150"
                             class="rounded float-right" alt="">
                        {{ $article->body }}
                    
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <strong>Categoria: <a href="{{route('public.articles.category', [$article->category->name, $article->category->id])}}">{{ $article->category->name }}</a></strong>
                    <i>{{ $article->created_at->format('d/m/Y') }} - {{ $article->user->name }}</i>
                </div>

            </div> 
         </div>
     </div>
     
    @endforeach
 </div>

 
    
</x-layout>