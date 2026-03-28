<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('member_code');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('national_id_encrypted')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('occupation')->nullable();
            $table->date('joined_date');
            $table->string('status')->default('active');
            $table->decimal('membership_fee_paid', 15, 2)->default(0);
            $table->string('photo_path')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'member_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
