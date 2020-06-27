<?php


namespace AppCore\DTO;


use AppCore\Entities\Category;

class CategoryDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $color;

    public static function fromEntity(Category $category){
        return new self(
            [
                'id' => $category->getId(),
                'name' => $category->getCategoryName(),
                'color' => $category->getCategoryColor()
            ]
        );
    }

    public static function fromCollection(array $categories){
        $categoryCollection = array();
        if(!empty($categories)){
            foreach ($categories as $category){
                if($category instanceof Category){
                    $categoryCollection[] = self::fromEntity($category);
                }
            }
        }
        return $categoryCollection;
    }

}