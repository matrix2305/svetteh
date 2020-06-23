<?php
declare(strict_types = 1);
namespace AppCore\Services;


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

    public function getAllPosts() : array
    {
        return $this->categoriesRepository->getAllCategories();
    }

    public function findOnePost($id)
    {

    }
}