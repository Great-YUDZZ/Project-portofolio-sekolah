<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'ip',
        'user_agent',
        'meta',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDescriptionAttribute(): string
    {
        if (is_array($this->meta) && isset($this->meta['description'])) {
            return (string) $this->meta['description'];
        }

        if (is_array($this->meta) && !empty($this->meta)) {
            return json_encode($this->meta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        return ucfirst(str_replace(['.', '_'], ' ', $this->action));
    }

    public function getIpAddressAttribute(): string
    {
        return (string) ($this->ip ?: '127.0.0.1');
    }

    public static function record(
        string $action,
        ?Model $subject = null,
        array|string|null $meta = null,
        ?Model $auditable = null,
        ?string $description = null
    ): self {
        $targetSubject = $subject ?: $auditable;
        $metaData = is_array($meta) ? $meta : [];
        if (is_string($meta)) {
            $metaData['description'] = $meta;
        }
        if ($description) {
            $metaData['description'] = $description;
        }

        return static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $targetSubject ? get_class($targetSubject) : null,
            'subject_id' => $targetSubject?->getKey(),
            'ip' => request()->ip() ?: '127.0.0.1',
            'user_agent' => substr((string) request()->userAgent(), 0, 500),
            'meta' => !empty($metaData) ? $metaData : null,
            'created_at' => now(),
        ]);
    }
}
