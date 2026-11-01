<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaUploadController extends Controller
{
    /**
     * Async upload endpoint for Tiptap editor images.
     * Re-encodes to WebP, strips EXIF, returns JSON { url: ... }.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png,webp,gif', 'max:5120'],
        ]);

        $user = $request->user();
        $media = MediaService::storeImage($request->file('image'), $user);

        AuditLog::record(
            action: 'upload_media',
            auditable: $media,
            description: "Mengunggah gambar editor: {$media->original_name} (" . round($media->size / 1024) . " KB)"
        );

        return response()->json([
            'url' => $media->url,
            'id' => $media->id,
            'name' => $media->original_name,
        ], 201);
    }
}
