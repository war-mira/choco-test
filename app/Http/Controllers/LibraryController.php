<?php

namespace App\Http\Controllers;

use App\City;
use App\Components\Longrid\Grid;
use App\Helpers\SeoMetadataHelper;
use App\Models\Library\Illness;
use App\Models\Library\IllnessesGroup;
use App\Models\Library\IllnessesGroupArticle;
use App\PageSeo;
use Illuminate\Http\Request;

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

        if(!empty($article->content)){
            $grid = new Grid($article->json_content->rows);
            $text = $grid->prepare();
        }
        $titleInDesc = $this->checkIfFirstTitleExist($text??$article->description);
        $links = $this->getNavigationFromContent($text??$article->description);

        $meta = SeoMetadataHelper::getMeta($article);

        return view('library.articles.item', compact('meta','article', 'text', 'links', 'illnessesGroup', 'titleInDesc'));
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
    public function searchIllness(Request $request)
    {
        $query = e($request->get('query'));
        $illnesses = Illness::
        where('name', 'like', "%$query%")
            ->orderBy('name')
            ->limit(50)
            ->paginate();
        $meta = [
            'h1' => 'Поиск по запросу: '.$query,
            'title' => 'Поиск по запросу: '.$query,
        ];


        return view('library.illnesses.list', compact('illnesses', 'meta','query'));
    }

    public function searchLibrary(Request $request)
    {
        $query = e($request->get('query'));
        $articles = IllnessesGroupArticle::
        where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orderBy('name')
            ->active()
            ->limit(12)
            ->paginate();
        $meta = [
            'h1' => 'Поиск по запросу: '.$query,
            'title' => 'Поиск по запросу: '.$query,
        ];


        return view('library.articles.list', compact('articles','meta','query'));
    }

    public function illness( Illness $illness)
    {

        $links = $this->getNavigationFromContent($illness->description);
        $titleInDesc = $this->checkIfFirstTitleExist($illness->description);

        $meta = SeoMetadataHelper::getMeta($illness);
        if(!empty($illness->content)){
            $grid = new Grid($illness->json_content->rows);
            $text = $grid->prepare();
        }


        return view('library.illnesses.item', compact('illness', 'links','meta', 'titleInDesc','text'));
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