<?php
namespace AppCore\DTO;


use AppCore\Entities\Post;

class PostsDTO extends BaseDTO
{
    public int $id;
    public string $title;
    public string $text;
    public string $image_path;
    public ?string $name;
    public ?string $lastname;
    public string $createdAt;
    public string $updatedAt;
    public array $categories;

    public static function fromEntity(Post $post){
        return new self(
            [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'text' => $post->getText(),
                'image_path' => $post->getImgPath(),
                'name' => $post->getName(),
                'lastname' => $post->getLastname(),
                'createdAt' => $post->getCreatedAt()->format('d/m/Y  H:i:s'),
                'updatedAt' => $post->getUpdatedAt()->format('d/m/Y  H:i:s'),
                'categories' => CategoryDTO::fromCollection($post->getCategories()),
            ]
        );
    }

    public static function fromCollection(array $posts){
        $postsCollection = array();
        if(!empty($posts)){
            foreach ($posts as $post){
                if($post instanceof Post){
                    $postsCollection[] = self::fromEntity($post);
                }
            }
        }

        return $postsCollection;
    }
}