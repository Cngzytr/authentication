<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Exception;
use invalidArgumentException;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }

    public function getAll() {
        $result = $this->postRepository->getAllPost();

        return $result;
    }

    public function savePostData($data) {
        $result = $this->postRepository->save($data);

        return $result;
    }

    public function updatePostData($data, $postId) {
        $result = $this->postRepository->update($data, $postId);

        return $result;
    }

    public function deleteById($postId) {
        $result = $this->postRepository->delete($postId);

        return $result;
    }
}
