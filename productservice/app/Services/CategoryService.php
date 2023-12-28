<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use invalidArgumentException;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll() {
        $result = $this->categoryRepository->getAllCategory();

        return $result;
    }

    public function saveCategoryData($data) {
        $result = $this->categoryRepository->save($data);

        return $result;
    }

    public function updateCategoryData($data, $categoryId) {
        $result = $this->categoryRepository->update($data, $categoryId);

        return $result;
    }

    public function deleteById($categoryId) {
        $result = $this->categoryRepository->delete($categoryId);

        return $result;
    }
}
