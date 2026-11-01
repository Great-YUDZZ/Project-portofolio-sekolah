<?php

namespace App\Policies;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any posts.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, Post $post): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($post->status === PostStatus::Published) {
            return true;
        }

        if ($post->author_id === $user->id) {
            return true;
        }

        // Guru can view pending posts of students from their own major
        if ($user->isGuru() && $user->major_id && $post->major_id === $user->major_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(User $user): bool
    {
        return $user->isActive();
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        if (!$user->isActive()) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        // Must be the author
        if ($post->author_id !== $user->id) {
            return false;
        }

        // If siswa: can only edit while Draft, Pending, or Rejected. Once Published, locked!
        if ($user->isSiswa()) {
            return in_array($post->status, [
                PostStatus::Draft,
                PostStatus::Pending,
                PostStatus::Rejected,
            ]);
        }

        // Guru can edit their own posts
        if ($user->isGuru()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        if (!$user->isActive()) {
            return false;
        }

        // Admin can delete all posts
        if ($user->isAdmin()) {
            return true;
        }

        // Guru can delete their own posts
        if ($user->isGuru() && $post->author_id === $user->id) {
            return true;
        }

        // Siswa can only delete their own if not published yet
        if ($user->isSiswa() && $post->author_id === $user->id) {
            return in_array($post->status, [
                PostStatus::Draft,
                PostStatus::Pending,
                PostStatus::Rejected,
            ]);
        }

        return false;
    }

    /**
     * Determine whether the user can review / approve / reject student posts.
     */
    public function review(User $user, Post $post): bool
    {
        if (!$user->isActive()) {
            return false;
        }

        // Post must be pending
        if ($post->status !== PostStatus::Pending) {
            return false;
        }

        // Admin can review all
        if ($user->isAdmin()) {
            return true;
        }

        // Guru can only review student posts from their own major
        if ($user->isGuru() && $user->major_id) {
            $authorMajorId = $post->major_id ?: $post->author?->major_id;
            return $authorMajorId && $authorMajorId === $user->major_id;
        }

        return false;
    }

    /**
     * Determine whether the user can publish directly without review.
     */
    public function publishDirectly(User $user): bool
    {
        return $user->isAdmin() || $user->isGuru();
    }
}
