<?php


namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;
/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length = 30)
     */
    private string $name;

    /**
     * @ORM\Column(name="text", type="text")
     */
    private string $text;

    /**
     * @ORM\Column(name="email", type="string", length = 70)
     */
    private string $email;

    /**
     * @ORM\Column(name="allowed", type="integer")
     */
    private int $allowed;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name = "created_at", type="datetime")
     */
    private DateTime $createdAt;


    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment", cascade = {"persist"}, fetch="LAZY")
     */
    private Post $post;

    public function __construct()
    {
        $this->allowed = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getComment() : string
    {
        return $this->text;
    }

    public function setComment(string $comment) : void
    {
        $this->text = $comment;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }

    public function getAllowed() : int
    {
        return $this->allowed;
    }

    public function setAllowed() : void
    {
        $this->allowed = 1;
    }

    public function getPost() : Post
    {
        return $this->post;
    }

    public function setPost(Post $post) : void
    {
        $this->post = $post;
    }
}