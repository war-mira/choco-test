<?php

namespace App\Interfaces;


interface ISeoMetadata
{
    public function getMetaTitle();

    public function getMetaDescription();

    public function getMetaKeywords();

    public function getMetaHeader();

    public function getSeoText();
}