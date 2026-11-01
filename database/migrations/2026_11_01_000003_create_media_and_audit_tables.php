<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('original_name');
            $table->string('mime', 100);
            $table->unsignedBigInteger('size');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->enum('kind', ['image', 'video'])->default('image');
            $table->string('alt_text')->nullable();
            $table->nullableMorphs('mediable');
            $table->timestamps();

            $table->index(['kind', 'created_at']);
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 60); // post.created, post.approved, user.activated, etc.
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('ip', 45);
            $table->text('user_agent')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['action', 'created_at']);
            $table->index(['subject_type', 'subject_id']);
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->after('event_date')->constrained('majors')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->after('major_id')->constrained('users')->nullOnDelete();
        });

        Schema::table('staff_members', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_members', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['major_id', 'created_by']);
        });

        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('media');
    }
};
