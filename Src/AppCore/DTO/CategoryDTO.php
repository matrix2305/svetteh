<?php


namespace AppCore\DTO;


use AppCore\Entities\Category;

class CategoryDTO extends BaseDTO
{
    public int $id;
    public string $createdAt;
    public string $updatedAt;
    public string $categoryName;
    public string $categoryColor;

    public static function fromEntity(Category $category){
        new self(
            [
                'id' => $category->getId(),
                'categoryName' => $category->getCategoryName(),
                'categoryColor' => $category->getCategoryColor(),
                'createdAt' => $category->getCreatedAt(),
                'updatedAt' => $category->getUpdatedAt()
            ]
        );
    }

    public static function fromCollection(array $categories){
        $categoryCollection = array();
        if(!empty($posts)){
            foreach ($categories as $category){
                if($category instanceof Category){
                    $categoryCollection[] = self::fromEntity($category);
                }
            }
        }

        return $categoryCollection;
    }

}