<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('category'); // draft, pending, published, rejected, archived
            $table->foreignId('major_id')->nullable()->after('status')->constrained('majors')->nullOnDelete();
            $table->foreignId('reviewed_by')->nullable()->after('featured_image')->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
            $table->text('review_note')->nullable()->after('reviewed_at');
            $table->string('video_url')->nullable()->after('review_note'); // YouTube URL only
            $table->string('video_path')->nullable()->after('video_url'); // Uploaded MP4 for admin/guru
            $table->softDeletes()->after('updated_at');
        });

        // Sync existing published posts to status = published
        DB::table('posts')->where('is_published', true)->update(['status' => 'published']);
        DB::table('posts')->where('is_published', false)->update(['status' => 'draft']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropForeign(['reviewed_by']);
            $table->dropSoftDeletes();
            $table->dropColumn([
                'status',
                'major_id',
                'reviewed_by',
                'reviewed_at',
                'review_note',
                'video_url',
                'video_path',
            ]);
        });
    }
};
