<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'category',
        'status',
        'major_id',
        'excerpt',
        'content',
        'featured_image',
        'is_published',
        'published_at',
        'reviewed_by',
        'reviewed_at',
        'review_note',
        'video_url',
        'video_path',
    ];

    protected function casts(): array
    {
        return [
            'status' => PostStatus::class,
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'reviewed_at' => 'datetime',
        ];
    }

    public function getBodyAttribute(): string
    {
        return (string) $this->content;
    }

    public function getThumbnailAttribute(): ?string
    {
        return $this->featured_image;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PostStatus::Published->value)
                     ->orWhere(function ($q) {
                         $q->whereNull('status')->where('is_published', true);
                     });
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', PostStatus::Pending->value);
    }

    public function scopeForReviewer(Builder $query, User $user): Builder
    {
        if ($user->isAdmin()) {
            return $query->where('status', PostStatus::Pending->value);
        }

        if ($user->isGuru() && $user->major_id) {
            return $query->where('status', PostStatus::Pending->value)
                         ->where('major_id', $user->major_id);
        }

        return $query->whereRaw('1 = 0');
    }
}
