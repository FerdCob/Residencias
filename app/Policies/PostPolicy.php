<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function authorPost(User $user, Post $post): bool
    {
        return (int)$user->id === (int)$post->user_id;
    }
}
