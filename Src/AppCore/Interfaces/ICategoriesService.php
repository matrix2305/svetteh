<?php


namespace AppCore\Interfaces;


interface ICategoriesService
{
    public function getAllCategories();

    public function addCategory(array $data);

    public function updateCategory(array $data);

    public function deleteCategory(int $id);
}