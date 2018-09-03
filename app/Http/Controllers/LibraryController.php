<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\Library\Illness;
use App\Models\Library\IllnessesGroup;
use App\Models\Library\IllnessesGroupArticle;

class LibraryController
{
    public function index()
    {
        $illnessesGroups = IllnessesGroup::where('active', '1')->get();

        return view('library.index', compact('illnessesGroups'));
    }

    public function groupArticles(IllnessesGroup $illnessesGroup)
    {
        $articles = IllnessesGroupArticle::where('illnesses_group_id', $illnessesGroup->id)->orderBy('created_at', 'desc')->paginate(12);

        return view('library.articles.list', compact('articles', 'illnessesGroup'));
    }

    public function article( IllnessesGroup $illnessesGroup, IllnessesGroupArticle $article)
    {
        $links = $this->getNavigationFromContent($article->description);

        return view('library.articles.item', compact('article', 'links', 'illnessesGroup'));
    }

    public function illnesses( $letter = null)
    {
        $letters = $this->getAlphabet();
        if(!$letter)
            $letter = $letters[0];

        $illnesses = Illness::getByLetter($letter)->orderBy('name', 'asc')->get();

        return view('library.illnesses.list', compact('letters', 'letter', 'illnesses'));
    }

    public function illness( Illness $illness)
    {
        $links = $this->getNavigationFromContent($illness->description);

        return view('library.illnesses.item', compact('illness', 'links'));
    }

    private function getAlphabet() {
        $letters = array();
        foreach (range(chr(0xC0), chr(0xDF)) as $b)
            $letters[] = iconv('CP1251', 'UTF-8', $b);

        return $letters;
    }

    private function getNavigationFromContent($content) {
        $regex = '#<\s*?h2\b[^>]*>(.*?)</h2\b[^>]*>#s';
        preg_match_all($regex, $content, $m);

        return $m[1];
    }
}