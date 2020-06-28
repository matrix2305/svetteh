<?php


namespace AppCore\DTO;


use AppCore\Entities\Comment;

class CommentsDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $email;
    public string $text;
    public string $createdAt;
    public string $allowed;
    public string $posttitle;

    public static function fromEntity(Comment $comment) : CommentsDTO
    {
        return new self(
            [
                'id' => $comment->getId(),
                'name' => $comment->getName(),
                'email' => $comment->getEmail(),
                'text' => $comment->getComment(),
                'createdAt' => $comment->getCreatedAt()->format('d/m/Y  H:i:s'),
                'allowed' => $comment->getAllowed(),
                'posttitle' => $comment->getPost()->getTitle()
            ]
        );
    }

    public static function fromCollection(array $comments) : array
    {
        $commentsCollection = array();
        if(!empty($comments)){
            foreach ($comments as $comment){
                if ($comment instanceof Comment){
                    $commentsCollection[] = self::fromEntity($comment);
                }
            }
        }

        return $commentsCollection;
    }



}