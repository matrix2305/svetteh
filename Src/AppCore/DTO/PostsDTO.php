<?php
namespace AppCore\DTO;


use AppCore\Entities\Post;

class PostsDTO extends BaseDTO
{
    public int $id;
    public string $tittle;
    public string $text;
    public string $image_path;
    public UsersDTO $user;

    public static function fromEntity(Post $post){
        return new self(
            [
                'id' => $post->getId(),
                'tittle' => $post->getTittle(),
                'text' => $post->getText(),
                'image_path' => $post->getImgPath(),
                'author' => UsersDTO::fromEntity($post->getUser())
            ]
        );
    }

    public static function fromCollection(array $posts){
        $postsCollection = array();
        if(!empty($posts)){
            foreach ($posts as $post){
                if($post instanceof Post){
                    $postsCollection[] = $post;
                }
            }
        }

        return $postsCollection;
    }
}