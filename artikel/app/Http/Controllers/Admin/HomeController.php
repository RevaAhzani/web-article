<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        $articles = Article::all();
        $categories = Category::all();
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $articles = Article::where('category_id', $categoryId)->get();
        } else {
            $articles = Article::all();
        }

        return view('admin.index', compact('articles', 'categories', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['required','string'],
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.index')->with('status', 'Article created successfully!');
    }

    public function show($id)
    {
        $article = Article::find($id);

        return view('admin.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('admin.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['required','string'],
        ]);

        Article::find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.index')->with('status', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->route('admin.index')->with('status', 'Article deleted successfully!');
    }
}
