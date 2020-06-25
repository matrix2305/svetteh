<?php
namespace AppCore\Interfaces;


use AppCore\Entities\Category;

interface ICategoriesRepository
{
    public function getAllCategories();

    public function getOneCategory(int $id);

    public function addCategory(Category $category);

    public function updateCategory(array $data);

    public function deleteCategory(Category $category);
}