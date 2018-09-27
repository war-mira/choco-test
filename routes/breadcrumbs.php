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
    $breadcrumbs->push($group->name, route('library.illnesses-group-articles', $group->alias));
});

Breadcrumbs::register('library.illnesses-group-article', function ($breadcrumbs, $article) {
    $breadcrumbs->parent('library.illnesses-group-articles', $article->illnessesGroup);
    $breadcrumbs->push($article->name, route('library.illnesses-group-article',['illnesses_group' => $article->illnessesGroup, 'article' => $article->alias]));
});

Breadcrumbs::register('illnesses.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Справочник заболеваний', route('illnesses.index'));
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
    $city_title =  'Врачи в ' . (SeoMetadataHelper::CityPP[$city->id]??GeographicalNamesInflection::getCase($city->name, 'предложный'));
    $breadcrumbs->parent('home');
    $breadcrumbs->push($city_title,  route('doctors.list',[
        'city' => $city->alias
    ],false));
    if(!is_null($title)){
        $breadcrumbs->push($title);
    }
});
Breadcrumbs::register('doctor.profile', function ($breadcrumbs, $doctor) {

    $city_title =  'Врачи в ' . (SeoMetadataHelper::CityPP[$doctor->city->id]??GeographicalNamesInflection::getCase($doctor->city->name, 'предложный'));
    $breadcrumbs->parent('home');
    $breadcrumbs->push($city_title,  route('doctors.list',[
        'city' => $doctor->city->alias
    ],false));


    if(!is_null($doctor->main_skill)){
        $meta = SeoMetadataHelper::getMeta($doctor->main_skill, $doctor->city);
        $breadcrumbs->push($meta['h1'],  route('doctors.list',[
            'input' => $doctor->main_skill->alias
        ],false));
    }

    $breadcrumbs->push($doctor->name);
});
