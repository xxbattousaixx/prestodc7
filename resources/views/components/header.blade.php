<div class="container-fluid header-home">
    <div class="row">
        <div class="col-12">
            <h1 class="text-white text-center header-title-home">  {{__('ui.welcome')}} </h1>
            <div class="row justify-content-center">
                <div class="col-8 col-md-6">
                    <form method="GET" action="{{route('search.results')}}" class="d-flex mt-4">
                        <input class="form-control me-2 shadow" type="text" name="q" placeholder="{{__('ui.research')}}" aria-label="Search">
                        <button class="btn btn-outline-success shadow" type="submit">{{__('ui.search')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>