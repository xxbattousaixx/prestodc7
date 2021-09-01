<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearchImage;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('is_accepted', true)->paginate(6);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));

        $categories = Category::all();


        return view('articles.create', compact('categories', 'uniqueSecret'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::id()

        ]);

        $uniqueSecret = $request->input('uniqueSecret');
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
        $images = array_diff($images, $removedImages);

        foreach ($images as $image) {
            $i = new ArticleImage();
            $fileName = basename($image);
            $newFileName = "public/articles/{$article->id}/{$fileName}";
            Storage::move($image, $newFileName);

            dispatch(new ResizeImage(
                $newFileName,
                300,
                150
            ));

            $i->file = $newFileName;
            $i->article_id = $article->id;
            $i->save();

            dispatch(new GoogleVisionSafeSearchImage($i->id));
            dispatch(new GoogleVisionLabelImage($i->id));
        };

        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        return redirect()->back()->with('message', 'Articolo inserito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }
    public function getImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
        $images = array_diff($images, $removedImages);

        $data = [];
        foreach ($images as $image) {
            $data[] = [
                'id' => $image,
                'src' => ArticleImage::getUrlByFilePath($image, 120, 120)
            ];
        }

        return response()->json($data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return redirect()->back()->with('msg', 'Annuncio aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function uploadImage(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120
        ));

        session()->push("images.{$uniqueSecret}", $fileName);

        return response()->json(
            [
                'id' => $fileName
            ]
        );
    }
    public function removeImage(Request $request)
    {

        $uniqueSecret = $request->input('uniqueSecret');

        $fileName = $request->input('id');
        session()->push("removedimages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);
        return response()->json('ok');
    }
}
