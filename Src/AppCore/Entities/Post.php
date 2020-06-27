<?php
declare(strict_types = 1);
namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;
use DateTime;

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
    private DateTime $createdAt;

    /**
     * @Version @ORM\Column(name="updated_at", type="datetime")
     */
    private DateTime $updatedAt;

    /**
     * @ORM\Column(name="title", type="string", length = 255)
     */
    private string $title;

    /**
     * @ORM\Column(name="text", type="text")
     */
    private string $text;

    /**
     * @ORM\Column(name="image_path", type="string", length = 50)
     */
    private string $imgPath;

    /**
     * @ORM\Column(name="name", type="string", nullable=true, length = 50)
     */
    private ?string $name;

    /**
     * @ORM\Column(name="lastname", type="string", nullable=true, length = 70)
     */
    private ?string $lastname;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="post", cascade={"persist"}, fetch="LAZY")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity = "Category", inversedBy = "post", cascade = {"persist"}, fetch = "EAGER")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity = "Comment", mappedBy="post", cascade = {"remove"}, fetch = "EAGER")
     */
    private $comments;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * Method for get Post id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Method for get tittle post
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * Method for set tittle post
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Method for get description(text) of post
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Method for get description(text) of post
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Method for get image path of post
     * @return string
     */
    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    /**
     * Method for set image path for post
     * @param string $img_path
     */
    public function setImgPath(string $imgPath): void
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
    public function setUser(User $user): void
    {
        $this->user = $user;
        $this->name = $user->getName();
        $this->lastname = $user->getLastname();
    }

    /**
     * Method for get all categories of post
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories->toArray();
    }

    /**
     * Method for set categories of post
     * @param ArrayCollection $collection
     */
    public function setCategories(Category $category): void
    {
        $this->categories->add($category);
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLastname() : ?string
    {
        return $this->lastname;
    }
}