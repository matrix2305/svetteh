<?php
namespace AppCore\Interfaces;


use AppCore\Entities\Content;

interface IContentRepository
{
    public function getContent();

    public function updateContent(Content $content) ;
}