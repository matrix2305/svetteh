<?php
namespace AppCore\Interfaces;


use AppCore\Entities\Post;
use AppCore\Entities\Category;
use AppCore\Entities\Comment;

interface IPostsRepository
{
    public function getAllPosts();

    public function getOnePosts(int $id);

    public function addPost(Post $post);

    public function updatePost(Post $post);

    public function deletePost(Post $post);

    public function getAllCategories();

    public function getOneCategory(int $id);

    public function addCategory(Category $category);

    public function updateCategory(Category $category);

    public function deleteCategory(Category $category);

    public function getComments();

    public function insertComment(Comment $comment);

    public function getOneComment(int $id);

    public function deleteComment(Comment $comment);
}