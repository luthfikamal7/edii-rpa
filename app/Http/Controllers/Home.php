<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Content\Program;
use App\Models\Content\Gallery;
use App\Models\Content\Article;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeForm;

class Home extends Controller
{

    public function __invoke(Request $request)
    {
        return view('welcome', [
            'list_program' => Program::limit(9)->get(),
            'list_gallery' => Gallery::limit(6)->get(),
            'list_article' => Article::limit(6)->get()
        ]);
    }
}
