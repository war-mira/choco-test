<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\Library\IllnessesGroup;
use App\Models\Library\IllnessesGroupArticle;

class LibraryController
{
    public function index()
    {
        $illnessesGroups = IllnessesGroup::all();

        return view('library.index', compact('illnessesGroups'));
    }

    public function groupArticles(City $city, IllnessesGroup $illnessesGroup)
    {
    }

    public function article(City $city, IllnessesGroup $illnessesGroup, IllnessesGroupArticle $article)
    {
        return view('library.articles.item', compact('article'));
    }
}