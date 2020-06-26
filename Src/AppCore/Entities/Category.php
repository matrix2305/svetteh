<?php


namespace AppCore\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\Version;

/**
 * @ORM\Entity()
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name = "created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @Version @ORM\Column(name="updated_at", type = "datetime")
     */
    private $updatedAt;
    /**
     * @ORM\Column (name="category_name", type="string", unique=true)
     */
    private string $categoryName;

    /**
     * @ORM\Column (name="category_color", type="string")
     */
    private string $categoryColor;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="categories", cascade={ "persist", "remove" }, fetch ="LAZY")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Method for get id of category
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Method for set category name
     * @param string $categoryName
     */
    public function setCategoryName(string $categoryName) : void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * Method for get category name
     * @return string
     */
    public function getCategoryName() : string
    {
        return $this->categoryName;
    }

    /**
     * Method for set category color
     * @param string $categoryColor
     */
    public function setCategoryColor(string $categoryColor) : void
    {
        $this->categoryColor = $categoryColor;
    }

    /**
     * Method for get category color
     * @return string
     */
    public function getCategoryColor() : string
    {
        return $this->categoryColor;
    }

    /**
     * Method for get last updated time category
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}