<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    
    public function getHierarchy($Id) {
        $category = Category::find($Id);

        $parentCategories = [];

        while ($category && $category->parent_id !== null) {
            $parentCategories[] = $category;

            $category = Category::where('_id', $category->parent_id)->first();
        }

        if ($category) {
            $parentCategories[] = $category;
        }

        return $parentCategories;
    }

}
