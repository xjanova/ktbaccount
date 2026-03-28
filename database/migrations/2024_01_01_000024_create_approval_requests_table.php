<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('type');
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->foreignId('requested_by')->constrained('users');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['approvable_type', 'approvable_id']);
        });

        Schema::create('approval_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->cascadeOnDelete();
            $table->foreignId('committee_member_id')->constrained('committee_members');
            $table->string('action');
            $table->text('signature_data')->nullable();
            $table->timestamp('signed_at');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_signatures');
        Schema::dropIfExists('approval_requests');
    }
};
