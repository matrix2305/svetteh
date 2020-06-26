<?php


namespace AppCore\Entities;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="name", type="string")
     */
    private string $name;

    /**
     * @ORM\Column(name="text", type="text")
     */
    private string $text;

    /**
     * @ORM\Column(name="email", type="string")
     */
    private string $email;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment", cascade = {"persist", "remove"}, fetch="LAZY")
     */
    private Post $post;
}