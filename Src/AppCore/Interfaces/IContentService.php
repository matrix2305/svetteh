<?php
namespace AppCore\Interfaces;


interface IContentService
{
    public function findContent();

    public function updateContent(array $data);
}