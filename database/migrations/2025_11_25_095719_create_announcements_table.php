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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'rejected', 'published'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->string('memo_url')->nullable();
            $table->enum('visibility_scope', ['campus_wide', 'departments', 'specific_departments', 'organization_only'])->default('organization_only');
            $table->json('visible_departments')->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('organization_id');
            $table->index('status');
            $table->index('published_at');
            $table->index('visibility_scope');
            $table->index('created_by');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
