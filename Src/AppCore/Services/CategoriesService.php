<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\Entities\Category;
use Infrastructure\Interfaces\ICategoriesRepository;
use Infrastructure\Interfaces\ILog;
use Infrastructure\Log\Log;
use Infrastructure\Repository\CategoriesRepository;

class CategoriesService
{
    /**
     * @var CategoriesRepository
     */
    private CategoriesRepository $categoriesRepository;

    /**
     * @var Log
     */
    private Log $log;

    public function __construct(ICategoriesRepository $categoriesRepository, ILog $log)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->log = $log;
    }

    public function getAllCategories() : array
    {
        return $this->categoriesRepository->getAllCategories();
    }


    public function addCategory(array $data) : void
    {
        $Category = new Category();
        $Category->setCategoryColor($data['category_color']);
        $Category->setCategoryName($data['category_name']);
        $this->categoriesRepository->addCategory($Category);
    }

    public function updateCategory(array $data) : void
    {
        $this->categoriesRepository->updateCategory($data);
    }

    public function deleteCategory(int $id) : void
    {
        $this->categoriesRepository->deleteCategory($id);
    }
}