<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function getAllPost() {
        return $this->post->get();
    }

    public function save($data) {
        $post = new $this->post;

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->slug = $data['slug'];

        $post->save();

        return $post->fresh();
    }

    public function update($data, $postId) {
        $post = $this->post->find($postId);

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->slug = $data['slug'];

        $post->update();

        return $post;
    }

    public function delete($postId) {
        $post = $this->post->find($postId);
        $post->delete();

        return $post;
    }
}
