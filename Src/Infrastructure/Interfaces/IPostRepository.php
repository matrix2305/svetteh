<?php


namespace Infrastructure\Interfaces;


use AppCore\Entities\Post;

interface IPostRepository
{
    public function getAllPosts();

    public function getOnePosts(int $id);

    public function addPost(Post $post);

    public function updatePost(array $data);

    public function deletePost(int $id);
}