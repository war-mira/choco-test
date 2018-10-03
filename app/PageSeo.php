<?php

namespace App;

use App\Interfaces\ISeoMetadata;
use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model implements ISeoMetadata
{
    protected $table = 'page_seo';
    protected $fillable = ['title', 'description', 'keywords', 'h1', 'seo_text'];
    public $timestamps = false;

    public function getMetaTitle()
    {
        return empty($this->title) ? '' : $this->title;
    }

    public function getMetaDescription()
    {
        return empty($this->description) ? '' : $this->description;
    }

    public function getMetaKeywords()
    {
        return empty($this->keywords) ? '' : $this->keywords;
    }

    public function getMetaHeader()
    {
        return empty($this->h1) ? '' : $this->h1;
    }

    public function getSeoText()
    {
        return empty($this->seo_text) ? '' : $this->seo_text;
    }
}