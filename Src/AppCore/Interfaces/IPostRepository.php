<?php
namespace AppCore\Interfaces;


use AppCore\Entities\Post;
use AppCore\Entities\Category;

interface IPostRepository
{
    public function getAllPosts();

    public function getOnePosts(int $id);

    public function addPost(Post $post);

    public function updatePost(array $data);

    public function deletePost(int $id);

    public function getAllCategories();

    public function getOneCategory(int $id);

    public function addCategory(Category $category);

    public function updateCategory(array $data);

    public function deleteCategory(Category $category);
}