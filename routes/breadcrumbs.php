<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Post;

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
