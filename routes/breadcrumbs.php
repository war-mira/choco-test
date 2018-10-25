<?php

use App\Helpers\SeoMetadataHelper;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Post;
use morphos\Russian\GeographicalNamesInflection;

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Главная', route('home'));
});

Breadcrumbs::register('library.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Библиотека', route('library.index'));
});

Breadcrumbs::register('library.illnesses-group-articles', function ($breadcrumbs, $group) {
    $breadcrumbs->parent('library.index');
    if ($group instanceof \App\Models\Library\IllnessesGroup) {
        $breadcrumbs->push($group->name, route('library.illnesses-group-articles', $group->alias));
    } else if(!empty($group)) {
        $breadcrumbs->push('Поиск по запросу: ' . $group);
    }
});

Breadcrumbs::register('library.illnesses-group-article', function ($breadcrumbs, $article) {
    $breadcrumbs->parent('library.illnesses-group-articles', $article->illnessesGroup);
    $breadcrumbs->push($article->name, route('library.illnesses-group-article', ['illnesses_group' => $article->illnessesGroup, 'article' => $article->alias]));
});

Breadcrumbs::register('illnesses.index', function ($breadcrumbs, $query = '') {

    $breadcrumbs->parent('home');
    $breadcrumbs->push('Справочник заболеваний', route('illnesses.index'));
    if (!empty($query)) {
        $breadcrumbs->push('Поиск по запросу: ' . $query);
    }
});

Breadcrumbs::register('illness', function ($breadcrumbs, $illness) {
    $breadcrumbs->parent('illnesses.index');
    $breadcrumbs->push($illness->name, route('illness', $illness->alias));
});

Breadcrumbs::register('posts', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Блог', route('posts'));
});

Breadcrumbs::register('posts.post', function ($breadcrumbs, $alias) {
    $post = Post::where('status', 1)
        ->where('alias', $alias)
        ->first();
    $breadcrumbs->parent('posts');
    $breadcrumbs->push($post->title, route('post', $post->alias));
});
Breadcrumbs::register('search.index', function ($breadcrumbs, $options) {

    $city = $options['city'];
    $title = $options['title'];
    $city_title = 'Врачи в ' . (SeoMetadataHelper::CityPP[$city->id] ?? GeographicalNamesInflection::getCase($city->name, 'предложный'));
    $breadcrumbs->parent('home');
    $breadcrumbs->push($city_title, route('doctors.list', [
        'city' => $city->alias
    ], false));
    if (!is_null($title)) {
        $breadcrumbs->push($title);
    }
});
Breadcrumbs::register('search.medcenter_type', function ($breadcrumbs, $options) {

    $city = $options['city'];
    $title = $options['title'];
    $city_title = 'Медцентры в ' . (SeoMetadataHelper::CityPP[$city->id] ?? GeographicalNamesInflection::getCase($city->name, 'предложный'));
    $breadcrumbs->parent('home');
    $breadcrumbs->push($city_title, route('medcenters.list', [
        'city' => $city->alias
    ], false));
    if (!is_null($title)) {
        $breadcrumbs->push($title);
    }
});
Breadcrumbs::register('doctor.profile', function ($breadcrumbs, $doctor) {

    $city_title = 'Врачи в ' . (SeoMetadataHelper::CityPP[$doctor->city->id] ?? GeographicalNamesInflection::getCase($doctor->city->name, 'предложный'));
    $breadcrumbs->parent('home');
    $breadcrumbs->push($city_title, route('doctors.list', [
        'city' => $doctor->city->alias
    ], false));


    if (!is_null($doctor->main_skill)) {
        $meta = SeoMetadataHelper::getMeta($doctor->main_skill, $doctor->city);
        $breadcrumbs->push($meta['h1'], route('doctors.list', [
            'city' => $doctor->city->alias,
            'input' => $doctor->main_skill->alias
        ], false));
    }

    $breadcrumbs->push($doctor->name);
});


Breadcrumbs::register('service.index', function ($breadcrumbs, $options) {


    $title = $options['title'];
    $breadcrumbs->parent('home');


    $breadcrumbs->push($title);

});
Breadcrumbs::register('service.list', function ($breadcrumbs, $options) {


    $parent = $options['parent'];
    $title = $options['title'];
    $breadcrumbs->parent('home');
    $breadcrumbs->push($parent, $options['parent_url']);
    $breadcrumbs->push($title);

});
Breadcrumbs::register('service.medcenter', function ($breadcrumbs, $options) {


    $parent = $options['parent'];
    $title = $options['title'];
    $breadcrumbs->parent('home');
    if (is_array($parent)) {
        $breadcrumbs->push($parent['parent'], $parent['parent_url']);
    }
    $breadcrumbs->push($parent['title'], $parent['url']);

    $breadcrumbs->push($title);

});