<?php
declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;

/**
 * Class Post
 * @package AppCore\Entities
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private string $createdAt;

    /**
     * @Version @ORM\Column(name="updated_at", type="datetime")
     */
    private string $updatedAt;

    /**
     * @ORM\Column(name="tittle", type="string")
     */
    private string $tittle;

    /**
     * @ORM\Column(name="text", type="text")
     */
    private string $text;

    /**
     * @ORM\Column(name="image_path", type="string", cascade={"persist", "remove"})
     */
    private string $imgPath;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private User $user;

    /**
     * @ORM\ManyToMany(targetEntity = "Category", inversedBy = "posts", cascade = { "persist", "remove" }, fetch = "EAGER")
     */
    private ArrayCollection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Method for get Post id
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method for get tittle post
     * @return string
     */
    public function getTittle() : string
    {
        return $this->tittle;
    }


    /**
     * Method for set tittle post
     * @param string $tittle
     */
    public function setTittle(string $tittle) : void
    {
        $this->tittle = $tittle;
    }

    /**
     * Method for get description(text) of post
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * Method for get description(text) of post
     * @param string $text
     */
    public function setText(string $text) : void
    {
        $this->text = $text;
    }

    /**
     * Method for get image path of post
     * @return string
     */
    public function getImgPath() : string
    {
        return $this->imgPath;
    }

    /**
     * Method for set image path for post
     * @param string $img_path
     */
    public function setImgPath(string $imgPath) : void
    {
        $this->imgPath = $imgPath;
    }

    /**
     * Method for get author user of Post
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * Method for set author user of Post
     * @param User $user
     */
    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    /**
     * Method for get all categories of post
     * @return ArrayCollection
     */
    public function getCategories() : ArrayCollection
    {
        return $this->categories;
    }

    /**
     * Method for set categories of post
     * @param ArrayCollection $collection
     */
    public function setCategories(Category $category) : void
    {
        $this->categories->add($category);
    }
}