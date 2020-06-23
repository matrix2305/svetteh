<?php


namespace AppCore\DTO;


class CategoriesDTO extends BaseDTO
{
    public int $id;
    public string $createdAt;
    public string $updatedAt;
    public string $categoryName;
    public string $categoryColor;
    public array  $posts;

}