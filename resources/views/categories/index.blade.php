<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Gli annunci della categoria {{$category->name}}</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">

    @foreach ($articles as $article)
            <div class="col-4 col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">{{ $article->title }}</div>
                    <div class="card-body">
                        <p><img src="https://picsum.photos/300/150" class="rounded float-right" alt="">{{ $article->body }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <strong>Category: <a href="#">{{ $article->category->name }}</a></strong>
                        <i>{{ $article->created_at->format('d/m/Y') }} - {{ $article->user->name }}</i>
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