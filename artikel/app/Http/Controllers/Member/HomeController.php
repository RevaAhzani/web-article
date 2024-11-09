<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        $articles = Article::all();
        $categories = Category::all();
        
        // Cek apakah ada kategori yang dipilih
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            // Jika kategori dipilih, ambil artikel berdasarkan kategori
            $articles = Article::where('category_id', $categoryId)->get();
        } else {
            // Jika tidak ada kategori yang dipilih, ambil semua artikel
            $articles = Article::all();
        }

        return view('member.index', compact('articles', 'categories', 'categoryId'));
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('member.show', compact('article'));
    }
}
