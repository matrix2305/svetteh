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

    public function findOneCategory(int $id);

    public function updateCategory(array $data);

    public function findComments();

    public function addComment(array $data);

    public function allowComment(int $id);

    public function deleteComment(int $id);

}