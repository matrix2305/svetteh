<?php
declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 * @package AppCore\Entities
 * @ORM\Entity
 * @ORM\(table = "posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(name = "id", type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name = "tittle", type="string")
     */
    private string $tittle;

    /**
     * @ORM\Column(name = "text", type="text")
     */
    private string $text;

    /**
     * @ORM\Column(name = "image_path", type = "string", cascade={)
     */
    private string $img_path;

    /**
     * @ManyToOne(targetEntity = "User", inversedBy="post")
     */
    private $user;




}