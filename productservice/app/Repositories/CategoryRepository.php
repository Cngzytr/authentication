<?php

namespace App\Repositories;

use App\Models\Category;
use App\Helpers\CategoryHelper;

class CategoryRepository
{
    protected $category;
    public $categoryHelper;

    public function __construct(Category $category, CategoryHelper $categoryHelper){
        $this->category = $category;
        $this->categoryHelper = $categoryHelper;
    }

    public function getAllCategory() {
        return $this->category->get();
    }

    public function save($data) {
        // verilen parent id'ye göre ana kategorileri bulup maximum 3 çocuk kategori ekleyebilme kontrolü.
        $length = $this->categoryHelper->getHierarchy($data['parent_id']);

        if(count($length) < 4) {
            $category = new $this->category;

            $category->title = $data['title'];
            $category->parent_id = $data['parent_id'];
            $category->slug = $data['slug'];
    
            $category->save();
    
            return $category->fresh();
        }else {
            return 'Maximum 3 çocuk kategori eklenebilir.';
        }
    }

    public function update($data, $categoryId) {
        // verilen parent id'ye göre ana kategorileri bulup maximum 3 çocuk kategori ekleyebilme kontrolü.
        $length = $this->categoryHelper->getHierarchy($data['parent_id']);

        if(count($length) < 4) {
            $category = $this->category->find($categoryId);

            $category->title = $data['title'];
            $category->parent_id = $data['parent_id'];
            $category->slug = $data['slug'];

            $category->update();

            return $category;
        }else {
            return 'Maximum 3 çocuk kategori eklenebilir.';
        }
    }

    public function delete($categoryId) {
        $category = $this->category->find($categoryId);
        $category->delete();

        return $category;
    }
}
