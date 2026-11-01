<?php

namespace App\Services;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MediaService
{
    /**
     * Store and process an uploaded image.
     * Re-encodes to WebP (stripping EXIF/GPS and neutralizing polyglots),
     * resizes if larger than 1920x1080, and saves to secure path with UUID name.
     */
    public static function storeImage(UploadedFile $file, User $user, ?string $altText = null): Media
    {
        // 1. Validation check
        if (!$file->isValid()) {
            throw ValidationException::withMessages(['image' => 'File gambar tidak valid atau gagal diunggah.']);
        }

        // Max 5MB
        if ($file->getSize() > 5 * 1024 * 1024) {
            throw ValidationException::withMessages(['image' => 'Ukuran gambar maksimal adalah 5 MB.']);
        }

        // Allowed MIME
        $mime = $file->getMimeType();
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
            throw ValidationException::withMessages(['image' => 'Format gambar harus JPG, PNG, WebP, atau GIF.']);
        }

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());

            // Resize down if too big (scale down keeping aspect ratio)
            $image->scaleDown(width: 1920, height: 1080);

            // Encode to clean WebP format (quality 85)
            $encoded = $image->toWebp(quality: 85);

            $yearMonth = date('Y/m');
            $uuid = (string) Str::uuid();
            $filename = "{$uuid}.webp";
            $relativePath = "media/{$yearMonth}/{$filename}";

            // Store to public disk
            Storage::disk('public')->put($relativePath, (string) $encoded);

            return Media::create([
                'user_id' => $user->id,
                'disk' => 'public',
                'path' => $relativePath,
                'original_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.webp',
                'mime' => 'image/webp',
                'size' => strlen((string) $encoded),
                'width' => $image->width(),
                'height' => $image->height(),
                'kind' => 'image',
                'alt_text' => $altText ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            ]);
        } catch (\Throwable $e) {
            throw ValidationException::withMessages(['image' => 'Gagal memproses gambar: ' . $e->getMessage()]);
        }
    }

    /**
     * Store an uploaded video (MP4 only, max 50MB, admin & guru only).
     */
    public static function storeVideo(UploadedFile $file, User $user, ?string $altText = null): Media
    {
        if (!$user->isAdmin() && !$user->isGuru()) {
            throw ValidationException::withMessages(['video' => 'Hanya Admin dan Guru yang diizinkan mengunggah file video langsung.']);
        }

        if (!$file->isValid()) {
            throw ValidationException::withMessages(['video' => 'File video tidak valid atau gagal diunggah.']);
        }

        // Max 50MB
        if ($file->getSize() > 50 * 1024 * 1024) {
            throw ValidationException::withMessages(['video' => 'Ukuran file video maksimal adalah 50 MB.']);
        }

        // Verify MIME
        $mime = $file->getMimeType();
        if ($mime !== 'video/mp4') {
            throw ValidationException::withMessages(['video' => 'Format file video harus MP4 (video/mp4).']);
        }

        // Verify magic bytes: MP4 files contain 'ftyp' in the first 16 bytes
        $handle = fopen($file->getRealPath(), 'rb');
        $bytes = fread($handle, 16);
        fclose($handle);

        if (strpos($bytes, 'ftyp') === false) {
            throw ValidationException::withMessages(['video' => 'File video bukan format MP4 yang valid.']);
        }

        $yearMonth = date('Y/m');
        $uuid = (string) Str::uuid();
        $filename = "{$uuid}.mp4";
        $relativePath = "media/videos/{$yearMonth}/{$filename}";

        Storage::disk('public')->putFileAs("media/videos/{$yearMonth}", $file, $filename);

        return Media::create([
            'user_id' => $user->id,
            'disk' => 'public',
            'path' => $relativePath,
            'original_name' => $file->getClientOriginalName(),
            'mime' => 'video/mp4',
            'size' => $file->getSize(),
            'width' => null,
            'height' => null,
            'kind' => 'video',
            'alt_text' => $altText ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
        ]);
    }
}
