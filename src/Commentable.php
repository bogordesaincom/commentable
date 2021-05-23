<?php

namespace Bogordesain\LaravelCommentable;

use Bogordesain\LaravelCommentable\Models\Comment;
use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function comment(string $comment): Comment
    {
        return $this->newComment(['comment' => $comment]);
    }

    public function commentAs(Model $user, string $comment): Comment
    {
        return $this->newComment([
            'comment' => $comment,
            'user_id' => $user->getKey(),
        ]);
    }

    private function newComment(array $data)
    {
        return $this->comments()->create(array_merge(
            $data,
            [
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]
        ));
    }
}
