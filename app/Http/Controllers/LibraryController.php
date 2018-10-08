<?php

namespace App\Http\Controllers;

use App\City;
use App\Helpers\SeoMetadataHelper;
use App\Models\Library\Illness;
use App\Models\Library\IllnessesGroup;
use App\Models\Library\IllnessesGroupArticle;
use App\PageSeo;

class LibraryController
{
    public function index()
    {
        $illnessesGroups = IllnessesGroup::where('active', '1')->get();
        $pageSeo = PageSeo::query()
            ->where('class','Library')
            ->where('action', 'index')
            ->first();
        $meta = [];
        if(!is_null($pageSeo)){
            $meta = SeoMetadataHelper::getMeta($pageSeo);
        }
        return view('library.index', compact('illnessesGroups','meta'));
    }

    public function groupArticles(IllnessesGroup $illnessesGroup)
    {
        $articles = IllnessesGroupArticle::where('illnesses_group_id', $illnessesGroup->id)
            ->active()
            ->orderBy('created_at', 'desc')->paginate(12);

        return view('library.articles.list', compact('articles', 'illnessesGroup'));
    }

    public function article( IllnessesGroup $illnessesGroup,  $article)
    {
        $article = IllnessesGroupArticle::where('alias',$article)
            ->active()
            ->firstOrFail();
        $links = $this->getNavigationFromContent($article->description);
        $titleInDesc = $this->checkIfFirstTitleExist($article->description);

        $meta = SeoMetadataHelper::getMeta($article);

        return view('library.articles.item', compact('meta','article', 'links', 'illnessesGroup', 'titleInDesc'));
    }

    public function illnesses( $letter = null)
    {
        $letters = $this->getAlphabet();
        if(!$letter)
            $letter = $letters[0];

        $illnesses = Illness::getByLetter($letter)->orderBy('name', 'asc')->get();
        $pageSeo = PageSeo::query()
            ->where('class','Illnesses')
            ->where('action', 'index')
            ->first();
        $meta = [];
        if(!is_null($pageSeo)){
            $meta = SeoMetadataHelper::getMeta($pageSeo);
        }

        return view('library.illnesses.list', compact('letters', 'letter', 'illnesses','meta'));
    }

    public function illness( Illness $illness)
    {
        $links = $this->getNavigationFromContent($illness->description);
        $titleInDesc = $this->checkIfFirstTitleExist($illness->description);

        $meta = SeoMetadataHelper::getMeta($illness);

        return view('library.illnesses.item', compact('illness', 'links','meta', 'titleInDesc'));
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

    private function checkIfFirstTitleExist($content) {
        return preg_match('#<\s*?h1\b[^>]*>(.*?)</h1\b[^>]*>#s', $content);
    }
}