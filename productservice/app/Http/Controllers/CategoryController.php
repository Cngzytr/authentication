<?php

namespace App\Http\Controllers;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function show()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->getAll();
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'parent_id',
            'slug'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->saveCategoryData($data);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function destroy($categoryId)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->deleteById($categoryId);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request, $categoryId)
    {
        $data = $request->only([
            'title',
            'parent_id',
            'slug'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->updateCategoryData($data, $categoryId);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }
}
