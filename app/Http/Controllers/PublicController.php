<?php

namespace App\Http\Controllers;

use App\Mail\MailReceived;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('articles'));
    }

    public function articlesByCategory($name, $category_id)
    {
        $category = Category::find($category_id);
        $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(6);
        return view('categories/index', compact('category', 'articles'));
    }
    public function search(Request $request)
    {
        $q = $request->input('q');
        $articles = Article::search($q)->paginate(6);
        return view('search.results', compact('q', 'articles'));
    }
    public function locale($locale)
    {
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function contactUs()
    {
        return view('contactUs');
    }

    public function saveContact(Request $request)
    {
        $contact = $request->all();
        Mail::to('emailAdmin@gmail.com')->send(new MailReceived($contact));

        return redirect(route('welcome'))->with('message', 'Contatto inviato correttamente');
    }
}
