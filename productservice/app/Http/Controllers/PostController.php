<?php

namespace App\Http\Controllers;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{   
    public $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function show()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->getAll();
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'body',
            'slug',
            'category_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->savePostData($data);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function destroy($postId)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->deleteById($postId);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request, $postId)
    {
        $data = $request->only([
            'title',
            'body',
            'slug',
            'category_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->updatePostData($data, $postId);
        } catch (Exception $e) {
            $result = ['status' => 500, 'error' => $e->getMessage()];
        }

        return response()->json($result, $result['status']);
    }
}
