<?php
namespace AppCore\Interfaces;


interface IPostsService
{
    public function getAllPosts();

    public function findOnePost(int $id);

    public function addPost(array $data);

    public function deletePost(int $id);

    public function updatePost(array $data);

    public function addCategory(array $data);

    public function deleteCategory(int $id);

    public function getAllCategories();
}