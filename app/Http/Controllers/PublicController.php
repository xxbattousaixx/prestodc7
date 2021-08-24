<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        return view('welcome', compact('articles'));
    }

    public function articlesByCategory($name, $category_id)
    {
        $category = Category::find($category_id);
        $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(5);
        return view('categories/index', compact('category','articles'));
    }
}
