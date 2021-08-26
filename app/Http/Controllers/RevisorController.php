<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
    }
    public function index()
    {
        $article = Article::where('is_accepted', null)->orderBy('created_at', 'desc')->first();
        return view('revisor.home', compact('article'));
    }
    private function setAccepted($article_id, $value)
    {
        $article = Article::find($article_id);
        $article->is_accepted = $value;
        $article->save();
        return redirect(route('revisor.home'));
    }
    public function accept($article_id)
    {
        return $this->setAccepted($article_id, true);
    }

    public function reject($article_id)
    {
        return $this->setAccepted($article_id, false);
    }
    public function indexRejected()
    {
        $articles = Article::where('is_accepted', false)->orderBy('created_at', 'desc')->get();
        return view('revisor.rejected', compact('articles'));
    }
}
