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
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('active')->after('role'); // active, pending, suspended
            $table->foreignId('major_id')->nullable()->after('status')->constrained('majors')->nullOnDelete();
            $table->text('two_factor_secret')->nullable()->after('password');
            $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            $table->timestamp('two_factor_confirmed_at')->nullable()->after('two_factor_recovery_codes');
            $table->boolean('must_change_password')->default(false)->after('two_factor_confirmed_at');
            $table->timestamp('last_login_at')->nullable()->after('must_change_password');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
            $table->foreignId('activated_by')->nullable()->after('last_login_ip')->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable()->after('activated_by');
        });

        // Ensure all existing users are set to active
        DB::table('users')->update(['status' => 'active']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropForeign(['activated_by']);
            $table->dropColumn([
                'status',
                'major_id',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'must_change_password',
                'last_login_at',
                'last_login_ip',
                'activated_by',
                'rejection_reason',
            ]);
        });
    }
};
